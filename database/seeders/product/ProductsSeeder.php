<?php

namespace Database\Seeders\product;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductsSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {

        // Setup Data Products
        $products = [
            ['code' => 'NTR-TS', 'name' => 'Nastar', 'image' => 'nastar.jpg', 'variant' => 'tabung_s', 'price' => '80000', 'expired_day' => '30', 'stock' => '7'],
            ['code' => 'NTR-TM', 'name' => 'Nastar', 'image' => 'nastar.jpg', 'variant' => 'tabung_m', 'price' => '110000', 'expired_day' => '30', 'stock' => '5'],
            ['code' => 'KST-TS', 'name' => 'Kastengel', 'image' => 'kastangel.jpg', 'variant' => 'tabung_s', 'price' => '132000', 'expired_day' => '60', 'stock' => '2'],
            ['code' => 'KST-TM', 'name' => 'Kastengel', 'image' => 'kastangel.jpg', 'variant' => 'tabung_m', 'price' => '170500', 'expired_day' => '60', 'stock' => '9'],
            ['code' => 'CLK-TM', 'name' => 'Choco Chips', 'image' => 'choco_chips.jpg', 'variant' => 'tabung_m', 'price' => '71500', 'expired_day' => '30', 'stock' => '3'],
            ['code' => 'CLK-KT', 'name' => 'Choco Chips', 'image' => 'choco_chips.jpg', 'variant' => 'kotak', 'price' => '55000', 'expired_day' => '30', 'stock' => '4'],
            ['code' => 'MVN-KT', 'name' => 'Mawar Vanilla', 'image' => 'mawar_vanilla.jpg', 'variant' => 'kotak', 'price' => '44000', 'expired_day' => '30', 'stock' => '11'],
            ['code' => 'SCS-TM', 'name' => 'Snow Cashew', 'image' => 'snow_cashew.jpg', 'variant' => 'tabung_m', 'price' => '77000', 'expired_day' => '60', 'stock' => '4'],
            ['code' => 'CHC-TM', 'name' => 'Choco Cashew', 'image' => 'choco_cashew.jpg', 'variant' => 'tabung_m', 'price' => '77000', 'expired_day' => '60', 'stock' => '7'],
            ['code' => 'CHC-KT', 'name' => 'Choco Cashew', 'image' => 'choco_cashew.jpg', 'variant' => 'kotak', 'price' => '61600', 'expired_day' => '60', 'stock' => '3'],
            ['code' => 'CRF-TM', 'name' => 'Cornflakes', 'image' => 'cornflakes.jpg', 'variant' => 'tabung_m', 'price' => '82500', 'expired_day' => '30', 'stock' => '6'],
            ['code' => 'CRF-KT', 'name' => 'Cornflakes', 'image' => 'cornflakes.jpg', 'variant' => 'kotak', 'price' => '66000', 'expired_day' => '30', 'stock' => '2'],
            ['code' => 'LDK-TS', 'name' => 'Lidah Kucing', 'image' => 'lidah_kucing.jpg', 'variant' => 'tabung_s', 'price' => '49500', 'expired_day' => '30', 'stock' => '3'],
            ['code' => 'LDK-TM', 'name' => 'Lidah Kucing', 'image' => 'lidah_kucing.jpg', 'variant' => 'tabung_m', 'price' => '60500', 'expired_day' => '30', 'stock' => '3'],
            ['code' => 'CHS-TS', 'name' => 'Cheese Sagoo', 'image' => 'cheese_sagoo.jpg', 'variant' => 'tabung_s', 'price' => '51700', 'expired_day' => '60', 'stock' => '4'],
            ['code' => 'CHS-TM', 'name' => 'Cheese Sagoo', 'image' => 'cheese_sagoo.jpg', 'variant' => 'tabung_m', 'price' => '71500', 'expired_day' => '60', 'stock' => '5'],
            ['code' => 'CHS-KT', 'name' => 'Cheese Sagoo', 'image' => 'cheese_sagoo.jpg', 'variant' => 'kotak', 'price' => '58300', 'expired_day' => '60', 'stock' => '6'],
            ['code' => 'PBC-TM', 'name' => 'Peanut Butter Cookies', 'image' => 'peanut_butter.jpg', 'variant' => 'tabung_m', 'price' => '60500', 'expired_day' => '60', 'stock' => '1'],
            ['code' => 'SSC-TM', 'name' => 'Sea Salt Cookies', 'image' => 'sea_salt_cookies.jpg', 'variant' => 'tabung_m', 'price' => '88000', 'expired_day' => '30', 'stock' => '9'],
        ];

        // Factory Data Products
        foreach ($products as $productData) {
            Product::factory()->create([
                'code' => $productData['code'],
                'name' => $productData['name'],
                'image' => $productData['image'],
                'variant' => $productData['variant'],
                'price' => $productData['price'],
                'expired_day' => $productData['expired_day'],
                'stock' => $productData['stock'],
            ]);
        }
    }
}
