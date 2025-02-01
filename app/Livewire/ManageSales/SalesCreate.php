<?php

namespace App\Livewire\ManageSales;

use App\Models\InventoryIn;
use App\Models\InventoryOut;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Support\Facades\DB;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Create Sales')]
class SalesCreate extends Component
{
    public $title = 'Create Sales';

    public $text_subtitle = 'This page displays for create data sales.';

    public $transaction_date;

    public $total_amount = 0;

    public $productList = [];

    public $batch_code;

    public $quantity;

    public function products()
    {
        return Product::select('id', 'code', 'name', 'variant', 'price', 'expired_day')->get();
    }

    public function render()
    {
        return view('livewire.manage-sales.sales-create');
    }

    public function save()
    {
        DB::beginTransaction();

        if (empty($this->productList)) {
            DB::rollBack();

            return flash()->warning('The Product List is still empty!');
        }

        $this->validate([
            'transaction_date' => ['required', 'date'],
            'total_amount' => ['required', 'numeric', 'min:1'],
        ]);

        try {
            $sales = Sale::create([
                'sales_user_id' => auth()->user()->id,
                'transaction_date' => $this->transaction_date,
                'total_amount' => $this->total_amount,
            ]);

            foreach ($this->productList as $product) {
                $totalAvailableStock = InventoryIn::where('batch_code', $product['batch_code'])
                    ->where('current_stock', '>', 0)
                    ->sum('current_stock');

                if ($totalAvailableStock < $product['quantity']) {
                    DB::rollBack();

                    return flash()->error("Not enough inventory stock for product: {$product['name']}");
                }

                $sales->detailSales()->create([
                    'product_id' => $product['product_id'],
                    'quantity' => $product['quantity'],
                    'price' => $product['price'],
                    'sub_total' => $product['sub_total'],
                ]);

                $remainingQuantity = $product['quantity'];
                $inventoryInRecords = InventoryIn::where('batch_code', $product['batch_code'])
                    ->where('current_stock', '>', 0)
                    ->orderBy('transaction_date', 'asc') // FIFO
                    ->get();

                foreach ($inventoryInRecords as $inventory) {
                    if ($remainingQuantity <= 0) {
                        break;
                    }

                    $deductedStock = min($inventory->current_stock, $remainingQuantity);

                    $inventory->current_stock -= $deductedStock;
                    $inventory->save();

                    InventoryOut::create([
                        'inventory_in_id' => $inventory->id,
                        'batch_code' => $inventory->batch_code,
                        'transaction_date' => now(),
                        'shelf_name' => $inventory->shelf_name,
                        'stock_out' => $deductedStock,
                    ]);

                    $remainingQuantity -= $deductedStock;
                }

                $productModel = Product::find($product['product_id']);
                if ($productModel) {
                    $productModel->stock -= $product['quantity'];
                    $productModel->save();
                }
            }

            DB::commit();

            $this->reset();

            return flash()->success('Data Saved Successfully.');
        } catch (\Exception $e) {
            DB::rollBack();
            dd($e);

            return flash()->error('An error occurred while saving the sales. Please try again.');
        }
    }

    public function calculateTotalAmount()
    {
        $this->total_amount = 0;

        foreach ($this->productList as $product) {
            $this->total_amount += $product['sub_total'];
        }
    }

    public function addProductList()
    {
        $this->validate([
            'batch_code' => ['required'],
            'quantity' => ['required', 'numeric'],
        ]);

        $inventory = InventoryIn::with('product')->where('batch_code', $this->batch_code)->first();

        if (! $inventory) {
            return flash()->error('Batch code not found!');
        }

        if ($this->quantity > $inventory->current_stock) {
            return flash()->warning('Insufficient Stock!');
        }

        if (isset($this->productList[$inventory->product->id])) {
            $this->productList[$inventory->product->id]['quantity'] = $this->quantity;
            $this->productList[$inventory->product->id]['sub_total'] = $this->quantity * $inventory->unit_price;
        } else {
            $this->productList[$inventory->product->id] = [
                'product_id' => $inventory->product->id,
                'code' => $inventory->product->code,
                'name' => $inventory->product->name,
                'variant' => $inventory->product->variant->label(),
                'price' => $inventory->unit_price,
                'batch_code' => $inventory->batch_code,
                'shelf_name' => $inventory->shelf_name,
                'quantity' => $this->quantity,
                'sub_total' => $this->quantity * $inventory->unit_price,
            ];
        }

        $this->calculateTotalAmount();

        $this->reset(['batch_code', 'quantity']);
    }

    public function removeProduct($product_id)
    {
        unset($this->productList[$product_id]);

        $this->calculateTotalAmount();
    }

    public function focusQuantity()
    {
        $this->dispatch('focus-quantity');
    }
}
