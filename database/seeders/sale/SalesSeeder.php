<?php

namespace Database\Seeders\sale;

use App\Models\DetailSales;
use App\Models\InventoryIn;
use App\Models\InventoryOut;
use App\Models\Product;
use App\Models\Sale;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class SalesSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csvDataSales = [
            ['01/07/2023', '7844410279', 8, 'Snow Cashew', 'tabung_m', 1, 70000, 70000],
            ['01/07/2023', '9544944549', 9, 'Choco Cashew', 'tabung_m', 1, 70000, 70000],
            ['02/07/2023', '8338856254', 7, 'Mawar Vanilla', 'kotak', 1, 40000, 40000],
            ['02/07/2023', '9544944549', 9, 'Choco Cashew', 'tabung_m', 2, 70000, 140000],
            ['03/07/2023', '9544944549', 9, 'Choco Cashew', 'tabung_m', 1, 70000, 70000],
            ['03/07/2023', '1144419104', 2, 'Nastar', 'tabung_m', 1, 100000, 100000],
            ['04/07/2023', '1041846724', 5, 'Choco Chips', 'tabung_m', 1, 65000, 65000],
            ['04/07/2023', '1709984738', 1, 'Nastar', 'tabung_s', 3, 80000, 240000],
            ['05/07/2023', '0629064785', 19, 'Sea Salt Cookies', 'tabung_m', 4, 80000, 320000],
            ['05/07/2023', '1709984738', 1, 'Nastar', 'tabung_s', 1, 80000, 80000],
            ['06/07/2023', '1144419104', 2, 'Nastar', 'tabung_m', 2, 100000, 200000],
            ['07/07/2023', '9544944549', 9, 'Choco Cashew', 'tabung_m', 1, 70000, 70000],
            ['07/07/2023', '8338856254', 7, 'Mawar Vanilla', 'kotak', 1, 40000, 40000],
            ['08/07/2023', '1144419104', 2, 'Nastar', 'tabung_m', 6, 100000, 600000],
            ['08/07/2023', '6488317414', 14, 'Lidah Kucing', 'tabung_m', 30, 55000, 1650000],
            ['09/07/2023', '0629064785', 19, 'Sea Salt Cookies', 'tabung_m', 1, 80000, 80000],
            ['09/07/2023', '9547714538', 3, 'Kastengel', 'tabung_s', 20, 120000, 2400000],
            ['10/07/2023', '8418042191', 18, 'Peanut Butter Cookies', 'tabung_m', 1, 55000, 55000],
            ['11/07/2023', '9544944549', 9, 'Choco Cashew', 'tabung_m', 6, 70000, 420000],
            ['11/07/2023', '8708164198', 6, 'Choco Chips', 'kotak', 1, 50000, 50000],
            ['12/07/2023', '8338856254', 7, 'Mawar Vanilla', 'kotak', 40, 40000, 1600000],
            ['13/07/2023', '7844410279', 8, 'Snow Cashew', 'tabung_m', 1, 70000, 70000],
            ['14/07/2023', '1709984738', 1, 'Nastar', 'tabung_s', 1, 80000, 80000],
            ['14/07/2023', '7844410279', 8, 'Snow Cashew', 'tabung_m', 1, 70000, 70000],
            ['15/07/2023', '1709984738', 1, 'Nastar', 'tabung_s', 1, 80000, 80000],
            ['15/07/2023', '5848374840', 13, 'Lidah Kucing', 'tabung_s', 1, 45000, 45000],
            ['16/07/2023', '3189344757', 17, 'Cheese Sagoo', 'kotak', 6, 53000, 318000],
            ['16/07/2023', '8873764659', 16, 'Cheese Sagoo', 'tabung_m', 4, 65000, 260000],
            ['17/07/2023', '4876431741', 15, 'Cheese Sagoo', 'tabung_s', 6, 47000, 282000],
            ['17/07/2023', '9547714538', 3, 'Kastengel', 'tabung_s', 1, 120000, 120000],
            ['18/07/2023', '0629064785', 19, 'Sea Salt Cookies', 'tabung_m', 4, 80000, 320000],
            ['18/07/2023', '8338856254', 7, 'Mawar Vanilla', 'kotak', 4, 40000, 160000],
            ['19/07/2023', '7844410279', 8, 'Snow Cashew', 'tabung_m', 1, 70000, 70000],
            ['20/07/2023', '3189344757', 17, 'Cheese Sagoo', 'kotak', 5, 53000, 265000],
            ['21/07/2023', '8418042191', 18, 'Peanut Butter Cookies', 'tabung_m', 1, 55000, 55000],
            ['22/07/2023', '4354154383', 12, 'Cornflakes', 'kotak', 3, 60000, 180000],
            ['22/07/2023', '8338856254', 7, 'Mawar Vanilla', 'kotak', 4, 40000, 160000],
            ['23/07/2023', '7844410279', 8, 'Snow Cashew', 'tabung_m', 1, 70000, 70000],
            ['24/07/2023', '1144419104', 2, 'Nastar', 'tabung_m', 1, 100000, 100000],
            ['25/07/2023', '0925494865', 4, 'Kastengel', 'tabung_m', 30, 155000, 4650000],
            ['25/07/2023', '1709984738', 1, 'Nastar', 'tabung_s', 6, 80000, 480000],
            ['26/07/2023', '8418042191', 18, 'Peanut Butter Cookies', 'tabung_m', 1, 55000, 55000],
            ['27/07/2023', '0925494865', 4, 'Kastengel', 'tabung_m', 4, 155000, 620000],
            ['27/07/2023', '1041846724', 5, 'Choco Chips', 'tabung_m', 4, 65000, 260000],
            ['28/07/2023', '0629064785', 19, 'Sea Salt Cookies', 'tabung_m', 2, 80000, 160000],
            ['29/07/2023', '8873764659', 16, 'Cheese Sagoo', 'tabung_m', 1, 65000, 65000],
            ['30/07/2023', '7844410279', 8, 'Snow Cashew', 'tabung_m', 1, 70000, 70000],
            ['30/07/2023', '8655772124', 11, 'Cornflakes', 'tabung_m', 6, 75000, 450000],
            ['31/07/2023', '8998378478', 10, 'Choco Cashew', 'kotak', 3, 56000, 168000],
            ['31/07/2023', '4354154383', 12, 'Cornflakes', 'kotak', 1, 60000, 60000],
        ];

        $groupedSales = [];
        $totalAmountPerDate = [];

        foreach ($csvDataSales as $row) {
            [$transactionDate, $batchCode, $idProduct, $name, $variant, $quantity, $price, $total] = $row;

            $inventoryIn = InventoryIn::where('batch_code', $batchCode)->first();

            if (! $inventoryIn) {
                continue;
            }

            $dateKey = \Carbon\Carbon::createFromFormat('d/m/Y', $transactionDate)->toDateString();

            if (! isset($totalAmountPerDate[$dateKey])) {
                $totalAmountPerDate[$dateKey] = 0;
            }

            $totalAmountPerDate[$dateKey] += $total;

            $groupedSales[$dateKey][] = [
                'batch_code' => $batchCode,
                'product_id' => $idProduct,
                'quantity' => $quantity,
                'price' => $price,
                'sub_total' => $total,
            ];
        }

        DB::transaction(function () use ($groupedSales) {
            foreach ($groupedSales as $date => $details) {
                $totalAmount = 0;

                $sales = Sale::create([
                    'sales_user_id' => 1,
                    'transaction_date' => \Carbon\Carbon::parse($date),
                    'total_amount' => $totalAmount,
                ]);

                foreach ($details as $detail) {
                    $quantity = $detail['quantity'];

                    DetailSales::create([
                        'sales_id' => $sales->id,
                        'product_id' => $detail['product_id'],
                        'quantity' => $detail['quantity'],
                        'price' => $detail['price'],
                        'sub_total' => $detail['sub_total'],
                    ]);

                    $totalAmount += $detail['sub_total'];

                    $inventoryIn = InventoryIn::where('batch_code', $detail['batch_code'])->first();

                    InventoryOut::create([
                        'inventory_in_id' => $inventoryIn->id,
                        'batch_code' => $detail['batch_code'],
                        'transaction_date' => \Carbon\Carbon::parse($date),
                        'shelf_name' => '-',
                        'stock_out' => $detail['quantity'],
                    ]);

                    $deductedStock = min($inventoryIn->current_stock, $detail['quantity']);

                    $inventoryIn->current_stock -= $deductedStock;
                    $inventoryIn->save();

                    $product = Product::find($detail['product_id']);
                    $product->decrement('stock', $quantity);
                }

                $sales->total_amount = $totalAmount;
                $sales->save();
            }
        });
    }
}
