<?php

namespace Database\Seeders\production;

use App\Models\DetailProduction;
use App\Models\InventoryIn;
use App\Models\Product;
use App\Models\Production;
use Illuminate\Database\Seeder;
use Illuminate\Support\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class ProductionsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $csvDataProduction = [
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

            // ['01/08/2023', '30/09/2023', '2142140108', 'Snow Cashew', 'tabung_m', 40],
            // ['01/08/2023', '30/09/2023', '3174403927', 'Choco Cashew', 'tabung_m', 16],
            // ['02/08/2023', '30/09/2023', '8338328084', 'Mawar Vanilla', 'kotak', 10],
            // ['02/08/2023', '30/09/2023', '8902595547', 'Choco Chips', 'tabung_m', 8],
            // ['03/08/2023', '30/09/2023', '2393473744', 'Sea Salt Cookies', 'tabung_m', 15],
            // ['03/08/2023', '02/10/2023', '0371948286', 'Nastar', 'tabung_m', 10],
            // ['04/08/2023', '03/10/2023', '3116098947', 'Nastar', 'tabung_s', 18],
            // ['04/08/2023', '04/10/2023', '1140869240', 'Choco Chips', 'kotak', 9],
            // ['05/08/2023', '05/10/2023', '5315304090', 'Cornflakes', 'tabung_m', 10],
            // ['05/08/2023', '05/10/2023', '7408940879', 'Lidah Kucing', 'tabung_s', 14],
            // ['06/08/2023', '06/10/2023', '7181945809', 'Lidah Kucing', 'tabung_m', 32],
            // ['07/08/2023', '07/10/2023', '4060193770', 'Kastengel', 'tabung_s', 25],
            // ['08/08/2023', '08/10/2023', '2481844732', 'Peanut Butter Cookies', 'tabung_m', 46],
            // ['09/08/2023', '09/10/2023', '8612923459', 'Cheese Sagoo', 'tabung_s', 15],
            // ['10/08/2023', '10/10/2023', '1791468736', 'Cheese Sagoo', 'tabung_m', 18],
            // ['10/08/2023', '10/10/2023', '9638300843', 'Cheese Sagoo', 'kotak', 10],
            // ['11/08/2023', '11/10/2023', '8356703475', 'Cornflakes', 'kotak', 8],
            // ['20/08/2023', '20/10/2023', '8838333441', 'Kastengel', 'tabung_m', 38],
            // ['25/08/2023', '25/10/2023', '3337849706', 'Choco Cashew', 'kotak', 9],

            // ['01/09/2023', '01/11/2023', '9627395408', 'Snow Cashew', 'tabung_m', 60],
            // ['01/09/2023', '01/11/2023', '4229329438', 'Choco Cashew', 'tabung_m', 26],
            // ['02/09/2023', '02/11/2023', '6790096744', 'Mawar Vanilla', 'kotak', 12],
            // ['02/09/2023', '02/11/2023', '5019697964', 'Choco Chips', 'tabung_m', 8],
            // ['03/09/2023', '03/11/2023', '3208223642', 'Sea Salt Cookies', 'tabung_m', 120],
            // ['04/09/2023', '04/11/2023', '8442025214', 'Nastar', 'tabung_m', 55],
            // ['04/09/2023', '04/11/2023', '5072405405', 'Nastar', 'tabung_s', 20],
            // ['05/09/2023', '05/11/2023', '3358856408', 'Choco Chips', 'kotak', 10],
            // ['05/09/2023', '05/11/2023', '1057014922', 'Cornflakes', 'tabung_m', 12],
            // ['06/09/2023', '06/11/2023', '7149958468', 'Lidah Kucing', 'tabung_s', 15],
            // ['06/09/2023', '06/11/2023', '6110236343', 'Lidah Kucing', 'tabung_m', 30],
            // ['07/09/2023', '07/11/2023', '5508942093', 'Kastengel', 'tabung_s', 26],
            // ['08/09/2023', '08/11/2023', '1426282841', 'Peanut Butter Cookies', 'tabung_m', 50],
            // ['09/09/2023', '09/11/2023', '8487534071', 'Cheese Sagoo', 'tabung_s', 14],
            // ['10/09/2023', '10/11/2023', '1726937051', 'Cheese Sagoo', 'tabung_m', 16],
            // ['11/09/2023', '11/11/2023', '2706530447', 'Cheese Sagoo', 'kotak', 12],
            // ['12/09/2023', '12/11/2023', '7827238346', 'Cornflakes', 'kotak', 8],
            // ['22/09/2023', '22/11/2023', '5135078493', 'Kastengel', 'tabung_m', 40],
            // ['25/09/2023', '25/11/2023', '3579423946', 'Choco Cashew', 'kotak', 9],

            // ['01/10/2023', '01/12/2023', '7186273474', 'Snow Cashew', 'tabung_m', 16],
            // ['01/10/2023', '01/12/2023', '0412501794', 'Choco Cashew', 'tabung_m', 25],
            // ['02/10/2023', '02/12/2023', '8442194208', 'Mawar Vanilla', 'kotak', 48],
            // ['02/10/2023', '02/12/2023', '0227486944', 'Choco Chips', 'tabung_m', 42],
            // ['03/10/2023', '03/12/2023', '8723217546', 'Sea Salt Cookies', 'tabung_m', 15],
            // ['04/10/2023', '04/12/2023', '3189823743', 'Nastar', 'tabung_m', 11],
            // ['04/10/2023', '04/12/2023', '9758402471', 'Nastar', 'tabung_s', 6],
            // ['05/10/2023', '05/12/2023', '0758400654', 'Choco Chips', 'kotak', 30],
            // ['05/10/2023', '05/12/2023', '2571575947', 'Cornflakes', 'tabung_m', 12],
            // ['06/10/2023', '06/12/2023', '3612075742', 'Lidah Kucing', 'tabung_s', 60],
            // ['06/10/2023', '06/12/2023', '2901962478', 'Lidah Kucing', 'tabung_m', 5],
            // ['07/10/2023', '07/12/2023', '8464721442', 'Kastengel', 'tabung_s', 22],
            // ['08/10/2023', '08/12/2023', '0788448222', 'Peanut Butter Cookies', 'tabung_m', 10],
            // ['09/10/2023', '09/12/2023', '9258504404', 'Cheese Sagoo', 'tabung_s', 16],
            // ['10/10/2023', '10/12/2023', '9622404171', 'Cheese Sagoo', 'tabung_m', 18],
            // ['11/10/2023', '11/12/2023', '1238406348', 'Cheese Sagoo', 'kotak', 10],
            // ['12/10/2023', '12/12/2023', '5864661548', 'Cornflakes', 'kotak', 6],
            // ['22/10/2023', '22/12/2023', '2609296019', 'Kastengel', 'tabung_m', 10],
            // ['25/10/2023', '25/12/2023', '9161888849', 'Choco Cashew', 'kotak', 9],

            // ['01/11/2023', '01/01/2024', '2291055464', 'Snow Cashew', 'tabung_m', 57],
            // ['01/11/2023', '01/01/2024', '9138453664', 'Choco Cashew', 'tabung_m', 12],
            // ['02/11/2023', '02/01/2024', '0166052498', 'Mawar Vanilla', 'kotak', 15],
            // ['02/11/2023', '02/01/2024', '5014653740', 'Choco Chips', 'tabung_m', 50],
            // ['03/11/2023', '03/01/2024', '0170167142', 'Sea Salt Cookies', 'tabung_m', 16],
            // ['04/11/2023', '04/01/2024', '7014214141', 'Nastar', 'tabung_m', 30],
            // ['04/11/2023', '04/01/2024', '2617036448', 'Nastar', 'tabung_s', 20],
            // ['05/11/2023', '05/01/2024', '0455514721', 'Choco Chips', 'kotak', 8],
            // ['05/11/2023', '05/01/2024', '4426654945', 'Cornflakes', 'tabung_m', 14],
            // ['06/11/2023', '06/01/2024', '2720394910', 'Lidah Kucing', 'tabung_s', 13],
            // ['06/11/2023', '06/01/2024', '2093534909', 'Lidah Kucing', 'tabung_m', 3],
            // ['07/11/2023', '07/01/2024', '0126397348', 'Kastengel', 'tabung_s', 14],
            // ['08/11/2023', '08/01/2024', '6394864362', 'Peanut Butter Cookies', 'tabung_m', 40],
            // ['09/11/2023', '09/01/2024', '1597051347', 'Cheese Sagoo', 'tabung_s', 2],
            // ['10/11/2023', '10/01/2024', '0596448854', 'Cheese Sagoo', 'tabung_m', 18],
            // ['11/11/2023', '11/01/2024', '6681004468', 'Cheese Sagoo', 'kotak', 10],
            // ['12/11/2023', '12/01/2024', '3613814621', 'Cornflakes', 'kotak', 9],
            // ['22/11/2023', '22/01/2024', '8106747341', 'Kastengel', 'tabung_m', 5],
            // ['25/11/2023', '25/01/2024', '8368909404', 'Choco Cashew', 'kotak', 10],

            // ['01/12/2023', '01/02/2024', '2724462527', 'Snow Cashew', 'tabung_m', 18],
            // ['01/12/2023', '01/02/2024', '4976934301', 'Choco Cashew', 'tabung_m', 30],
            // ['02/12/2023', '02/02/2024', '9584794143', 'Mawar Vanilla', 'kotak', 12],
            // ['02/12/2023', '02/02/2024', '6660414558', 'Choco Chips', 'tabung_m', 5],
            // ['03/12/2023', '03/02/2024', '4185073914', 'Sea Salt Cookies', 'tabung_m', 20],
            // ['04/12/2023', '04/02/2024', '0395168694', 'Nastar', 'tabung_m', 15],
            // ['04/12/2023', '04/02/2024', '6661505684', 'Nastar', 'tabung_s', 3],
            // ['05/12/2023', '05/02/2024', '2348693457', 'Choco Chips', 'kotak', 9],
            // ['05/12/2023', '05/02/2024', '1461114268', 'Cornflakes', 'tabung_m', 14],
            // ['06/12/2023', '06/02/2024', '5347922164', 'Lidah Kucing', 'tabung_s', 12],
            // ['06/12/2023', '06/02/2024', '5911334949', 'Lidah Kucing', 'tabung_m', 12],
            // ['07/12/2023', '07/02/2024', '0971574783', 'Kastengel', 'tabung_s', 0],
            // ['08/12/2023', '08/02/2024', '8933965839', 'Peanut Butter Cookies', 'tabung_m', 12],
            // ['09/12/2023', '09/02/2024', '1424721242', 'Cheese Sagoo', 'tabung_s', 0],
            // ['10/12/2023', '10/02/2024', '5483504421', 'Cheese Sagoo', 'tabung_m', 0],
            // ['11/12/2023', '11/02/2024', '5557461906', 'Cheese Sagoo', 'kotak', 0],
            // ['12/12/2023', '12/02/2024', '7940217159', 'Cornflakes', 'kotak', 5],
            // ['22/12/2023', '22/02/2024', '3742462815', 'Kastengel', 'tabung_m', 5],
            // ['25/12/2023', '25/02/2024', '4958861451', 'Choco Cashew', 'kotak', 12],
        ];

        $groupedProductions = [];

        foreach ($csvDataProduction as $row) {
            [$productionDate, $expirationDate, $batchCode, $menu, $variant, $quantity] = $row;

            $productionDate = Carbon::createFromFormat('d/m/Y', trim($productionDate));
            $expirationDate = Carbon::createFromFormat('d/m/Y', trim($expirationDate));

            $product = Product::where('name', trim($menu))
                ->where('variant', strtolower(str_replace(' ', '_', trim($variant))))
                ->first();

            if (! $product) {
                continue;
            }

            $groupedProductions[$productionDate->toDateString()][] = [
                'product_id' => $product->id,
                'batch_code' => $batchCode,
                'expiration_date' => $expirationDate,
                'variant' => $variant,
                'quantity' => $quantity,
            ];
        }

        DB::transaction(function () use ($groupedProductions) {
            foreach ($groupedProductions as $date => $details) {
                $production = Production::create([
                    'inventory_user_id' => 1,
                    'production_request_date' => Carbon::parse($date),
                    'production_user_id' => 1,
                    'production_date' => Carbon::parse($date),
                    'status' => 'approved',
                    'note' => 'Data Csv',
                ]);

                foreach ($details as $detail) {
                    $quantity = $detail['quantity'];

                    DetailProduction::create([
                        'production_id' => $production->id,
                        'product_id' => $detail['product_id'],
                        'batch_code' => $detail['batch_code'],
                        'shelf_name' => '-',
                        'quantity' => $quantity,
                    ]);

                    InventoryIn::create([
                        'product_id' => $detail['product_id'],
                        'batch_code' => $detail['batch_code'],
                        'transaction_date' => Carbon::parse($date),
                        'shelf_name' => '-',
                        'stock_start' => $quantity,
                        'current_stock' => $quantity,
                        'unit_price' => Product::find($detail['product_id'])->price,
                        'expiration_date' => $detail['expiration_date'],
                    ]);

                    $product = Product::find($detail['product_id']);
                    $product->increment('stock', $quantity);
                }
            }
        });
    }

    public static function generateBatchCode()
    {
        $uuid = Str::uuid()->toString();
        $barcode = substr(preg_replace('/[^0-9]/', '', $uuid), 0, 10);

        return str_pad($barcode, 10, '0', STR_PAD_LEFT);
    }
}
