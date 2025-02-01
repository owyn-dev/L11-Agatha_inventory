<?php

namespace App\Livewire\ManageInventory\InventoryRequest;

use App\Models\Product;
use App\Models\Production;
use Illuminate\Support\Str;
use Livewire\Attributes\Title;
use Livewire\Component;

#[Title('Create Production Request')]
class InventoryRequestCreate extends Component
{
    public $title = 'Create Production Request';

    public $text_subtitle = 'This page displays for create data production request.';

    public $production_request_date;

    public $note = '';

    public $productList = [];

    public $product;

    public $quantity_production;

    public $shelf_name;

    public function products()
    {
        return Product::select('id', 'code', 'name', 'variant', 'price', 'expired_day')->get();
    }

    public function render()
    {
        return view('livewire.manage-inventory.inventory-request.inventory-request-create');
    }

    public function save()
    {
        if (empty($this->productList)) {
            return flash()->warning('The Product Production List is still empty!');
        }

        $this->validate([
            'production_request_date' => ['required', 'date'],
            'note' => ['required'],
        ]);

        $production = Production::create([
            'inventory_user_id' => auth()->user()->id,
            'production_request_date' => $this->production_request_date,
            'note' => $this->note,
        ]);

        foreach ($this->productList as $product) {
            $production->detailProductions()->create([
                'product_id' => $product['product_id'],
                'batch_code' => $product['batch_code'],
                'shelf_name' => $product['shelf_name'],
                'quantity' => $product['quantity'],
            ]);
        }

        flash()->success('Data Saved Successfully.');

        $this->dispatch('select-2');
        $this->reset();
    }

    public function addProductList()
    {

        $this->validate([
            'product' => ['required'],
            'quantity_production' => ['required', 'numeric'],
            'shelf_name' => ['required'],
        ]);

        $product = Product::find($this->product);

        if (isset($this->productList[$product->id])) {
            $this->productList[$product->id]['quantity'] += $this->quantity_production;
            $this->productList[$product->id]['shelf_name'] = $this->shelf_name;
        } else {
            $this->productList[$product->id] = [
                'product_id' => $product->id,
                'code' => $product->code,
                'name' => $product->name,
                'variant' => $product->variant->label(),
                'price' => $product->price,
                'batch_code' => $this->generateBatchCode(),
                'shelf_name' => $this->shelf_name,
                'quantity' => $this->quantity_production,
            ];
        }

        $this->dispatch('select-2');
        $this->reset(['product', 'quantity_production', 'shelf_name']);
    }

    public function removeProduct($product_id)
    {
        unset($this->productList[$product_id]);
    }

    public static function generateBatchCode()
    {
        $uuid = Str::uuid()->toString();
        $barcode = substr(preg_replace('/[^0-9]/', '', $uuid), 0, 10);

        return str_pad($barcode, 10, '0', STR_PAD_LEFT);
    }
}
