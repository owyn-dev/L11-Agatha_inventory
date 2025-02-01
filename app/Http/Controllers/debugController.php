<?php

namespace App\Http\Controllers;

use App\Models\InventoryIn;

class debugController extends Controller
{
    public function index()
    {
        function matchBatchCode($sourceData, $targetData)
        {
            $result = [];

            foreach ($targetData as $target) {
                [$targetTransactionDate, $targetProduct, $targetVariant, $targetQuantity, $targetPrice, $targetTotal] = $target;
                $targetDate = \Carbon\Carbon::createFromFormat('d/m/Y', $targetTransactionDate);

                $id_product = 'NOT_FOUND';
                $matchedBatchCode = 'NOT_FOUND';

                foreach ($sourceData as $source) {
                    $inventoryIn = InventoryIn::whereHas('product', function ($query) use ($targetProduct, $targetVariant) {
                        $query->where('name', $targetProduct);
                        $query->where('variant', $targetVariant);
                    })
                        ->whereYear('transaction_date', $targetDate->year)
                        ->whereMonth('transaction_date', $targetDate->month)
                        ->first();

                    if (
                        $targetDate->month == \Carbon\Carbon::parse($inventoryIn->transaction_date)->format('n') &&
                        $targetDate->year == \Carbon\Carbon::parse($inventoryIn->transaction_date)->format('Y') &&
                        strtolower(trim($inventoryIn->product->name)) === strtolower(trim($targetProduct)) &&
                        strtolower(trim($inventoryIn->product->variant->value)) === strtolower(trim($targetVariant))
                    ) {

                        $id_product = $inventoryIn->product->id;
                        $matchedBatchCode = $inventoryIn->batch_code;
                        break;
                    }
                }

                $result[] = [
                    $targetTransactionDate,
                    $matchedBatchCode,
                    $id_product,
                    $targetProduct,
                    $targetVariant,
                    (string) $targetQuantity,
                    (string) $targetPrice,
                    (string) $targetTotal,
                ];
            }

            return $result;
        }

        $sourceData = [
            ['01/07/2023', '30/08/2023', '7844410279', 'Snow Cashew', 'tabung_m', 12],
            ['01/07/2023', '30/08/2023', '9544944549', 'Choco Cashew', 'tabung_m', 15],
            ['02/07/2023', '01/08/2023', '8338856254', 'Mawar Vanilla', 'kotak', 12],
            ['02/07/2023', '31/08/2023', '1041846724', 'Choco Chips', 'tabung_m', 6],
            ['02/07/2023', '01/08/2023', '0629064785', 'Sea Salt Cookies', 'tabung_m', 12],
            ['03/07/2023', '02/08/2023', '1144419104', 'Nastar', 'tabung_m', 12],
            ['03/07/2023', '02/08/2023', '1709984738', 'Nastar', 'tabung_s', 18],
            ['04/07/2023', '02/09/2023', '8708164198', 'Choco Chips', 'kotak', 6],
            ['04/07/2023', '03/08/2023', '8655772124', 'Cornflakes', 'tabung_m', 12],
            ['05/07/2023', '04/08/2023', '5848374840', 'Lidah Kucing', 'tabung_s', 12],
            ['06/07/2023', '05/08/2023', '6488317414', 'Lidah Kucing', 'tabung_m', 35],
            ['07/07/2023', '05/09/2023', '9547714538', 'Kastengel', 'tabung_s', 28],
            ['07/07/2023', '05/09/2023', '8418042191', 'Peanut Butter Cookies', 'tabung_m', 12],
            ['08/07/2023', '06/09/2023', '4876431741', 'Cheese Sagoo', 'tabung_s', 12],
            ['09/07/2023', '07/09/2023', '8873764659', 'Cheese Sagoo', 'tabung_m', 18],
            ['09/07/2023', '07/09/2023', '3189344757', 'Cheese Sagoo', 'kotak', 12],
            ['10/07/2023', '09/08/2023', '4354154383', 'Cornflakes', 'kotak', 6],
            ['11/07/2023', '10/08/2023', '3754458041', 'Mawar Vanilla', 'kotak', 45],
            ['23/07/2023', '21/09/2023', '0925494865', 'Kastengel', 'tabung_m', 42],
            ['25/07/2023', '23/09/2023', '8998378478', 'Choco Cashew', 'kotak', 6],
        ];

        $targetData = [
            ['01/07/2023', 'Snow Cashew', 'tabung_m', '1', '70000', '70000'],
            ['01/07/2023', 'Choco Cashew', 'tabung_m', '1', '70000', '70000'],
            ['02/07/2023', 'Mawar Vanilla', 'kotak', '1', '40000', '40000'],
            ['02/07/2023', 'Choco Cashew', 'tabung_m', '2', '70000', '140000'],
            ['03/07/2023', 'Choco Cashew', 'tabung_m', '1', '70000', '70000'],
            ['03/07/2023', 'Nastar', 'tabung_m', '1', '100000', '100000'],
            ['04/07/2023', 'Choco Chips ', 'tabung_m', '1', '65000', '65000'],
            ['04/07/2023', 'Nastar', 'tabung_s', '3', '80000', '240000'],
            ['05/07/2023', 'Sea Salt Cookies', 'tabung_m', '4', '80000', '320000'],
            ['05/07/2023', 'Nastar', 'tabung_s', '1', '80000', '80000'],
            ['06/07/2023', 'Nastar', 'tabung_m', '2', '100000', '200000'],
            ['07/07/2023', 'Choco Cashew', 'tabung_m', '1', '70000', '70000'],
            ['07/07/2023', 'Mawar Vanilla', 'kotak', '1', '40000', '40000'],
            ['08/07/2023', 'Nastar', 'tabung_m', '6', '100000', '600000'],
            ['08/07/2023', 'Lidah Kucing', 'tabung_m', '30', '55000', '1650000'],
            ['09/07/2023', 'Sea Salt Cookies', 'tabung_m', '1', '80000', '80000'],
            ['09/07/2023', 'Kastengel', 'tabung_s', '20', '120000', '2400000'],
            ['10/07/2023', 'Peanut Butter Cookies', 'tabung_m', '1', '55000', '55000'],
            ['11/07/2023', 'Choco Cashew', 'tabung_m', '6', '70000', '420000'],
            ['11/07/2023', 'Choco Chips ', 'kotak', '1', '50000', '50000'],
            ['12/07/2023', 'Mawar Vanilla', 'kotak', '40', '40000', '1600000'],
            ['13/07/2023', 'Snow Cashew', 'tabung_m', '1', '70000', '70000'],
            ['14/07/2023', 'Nastar', 'tabung_s', '1', '80000', '80000'],
            ['14/07/2023', 'Snow Cashew', 'tabung_m', '1', '70000', '70000'],
            ['15/07/2023', 'Nastar', 'tabung_s', '1', '80000', '80000'],
            ['15/07/2023', 'Lidah Kucing', 'tabung_s', '1', '45000', '45000'],
            ['16/07/2023', 'Cheese Sagoo', 'kotak', '6', '53000', '318000'],
            ['16/07/2023', 'Cheese Sagoo', 'tabung_m', '4', '65000', '260000'],
            ['17/07/2023', 'Cheese Sagoo', 'tabung_s', '6', '47000', '282000'],
            ['17/07/2023', 'Kastengel', 'tabung_s', '1', '120000', '120000'],
            ['18/07/2023', 'Sea Salt Cookies', 'tabung_m', '4', '80000', '320000'],
            ['18/07/2023', 'Mawar Vanilla', 'kotak', '4', '40000', '160000'],
            ['19/07/2023', 'Snow Cashew', 'tabung_m', '1', '70000', '70000'],
            ['20/07/2023', 'Cheese Sagoo', 'kotak', '5', '53000', '265000'],
            ['21/07/2023', 'Peanut Butter Cookies', 'tabung_m', '1', '55000', '55000'],
            ['22/07/2023', 'Cornflakes', 'kotak', '3', '60000', '180000'],
            ['22/07/2023', 'Mawar Vanilla', 'kotak', '4', '40000', '160000'],
            ['23/07/2023', 'Snow Cashew', 'tabung_m', '1', '70000', '70000'],
            ['24/07/2023', 'Nastar', 'tabung_m', '1', '100000', '100000'],
            ['25/07/2023', 'Kastengel', 'tabung_m', '30', '155000', '4650000'],
            ['25/07/2023', 'Nastar', 'tabung_s', '6', '80000', '480000'],
            ['26/07/2023', 'Peanut Butter Cookies', 'tabung_m', '1', '55000', '55000'],
            ['27/07/2023', 'Kastengel', 'tabung_m', '4', '155000', '620000'],
            ['27/07/2023', 'Choco Chips ', 'tabung_m', '4', '65000', '260000'],
            ['28/07/2023', 'Sea Salt Cookies', 'tabung_m', '2', '80000', '160000'],
            ['29/07/2023', 'Cheese Sagoo', 'tabung_m', '1', '65000', '65000'],
            ['30/07/2023', 'Snow Cashew', 'tabung_m', '1', '70000', '70000'],
            ['30/07/2023', 'Cornflakes', 'tabung_m', '6', '75000', '450000'],
            ['31/07/2023', 'Choco Cashew', 'kotak', '3', '56000', '168000'],
            ['31/07/2023', 'Cornflakes', 'kotak', '1', '60000', '60000'],
        ];

        $matchedData = matchBatchCode($sourceData, $targetData);

        return dd(count($matchedData));
    }

    public function testing_sale() {}
}
