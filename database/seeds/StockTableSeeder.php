<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class StockTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('stocks')->truncate(); //2回目実行の際にシーダー情報をクリア
        DB::table('stocks')->insert([
            'name' => 'NIKE - AirForce 1',
            'detail' => 'sample text.sample text.sample text.',
            'fee' => 11000,
            'imgpath' => 'sample_1.jpg',
        ]);
 
        DB::table('stocks')->insert([
            'name' => 'NIKE - AirJordan 1',
            'detail' => 'sample text.sample text.sample text.',
            'fee' => 40000,
            'imgpath' => 'sample_2.jpg',
        ]);
 
        DB::table('stocks')->insert([
            'name' => 'adidas - yeezy boost 350',
            'detail' => 'sample text.sample text.sample text.',
            'fee' => 25000,
            'imgpath' => 'sample_3.jpg',
        ]);
 
        DB::table('stocks')->insert([
            'name' => 'Vans - old skool',
            'detail' => 'sample text.sample text.sample text.',
            'fee' => 12000,
            'imgpath' => 'sample_4.jpg',
        ]);
 
        DB::table('stocks')->insert([
            'name' => 'NIKE - AirJordan 1',
            'detail' => 'sample text.sample text.sample text.',
            'fee' => 50000,
            'imgpath' => 'sample_5.jpg',
        ]);

        DB::table('stocks')->insert([
            'name' => 'CONVERSE - ALL STAR',
            'detail' => 'sample text.sample text.sample text.',
            'fee' => 11000,
            'imgpath' => 'sample_6.jpg',
        ]);
 
        DB::table('stocks')->insert([
            'name' => 'ASICS Tiger - GEL-LYTE III',
            'detail' => 'sample text.sample text.sample text.',
            'fee' => 10000,
            'imgpath' => 'sample_7.jpg',
        ]);
 
        DB::table('stocks')->insert([
            'name' => 'adidas - NMD',
            'detail' => 'sample text.sample text.sample text.',
            'fee' => 25000,
            'imgpath' => 'sample_8.jpg',
        ]);
 
        DB::table('stocks')->insert([
            'name' => 'adidas - yeezy boost 700',
            'detail' => 'sample text.sample text.sample text.',
            'fee' => 40000,
            'imgpath' => 'sample_9.jpg',
        ]);
 
 
        DB::table('stocks')->insert([
            'name' => 'adidas - Stan Smith',
            'detail' => 'sample text.sample text.sample text.',
            'fee' => 10000,
            'imgpath' => 'sample_10.jpg',
        ]);
 
       
        
    }
}
