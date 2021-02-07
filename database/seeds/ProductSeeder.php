<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        DB::table('products')->insert([

            [
            'name'=>"Oneplus Mobile",
            "price"=>"25000",
            "description"=>"Smart Phone with 6gb Ram and many morer",
            'category'=>"Mobile",
            'gallery'=>"https://images-na.ssl-images-amazon.com/images/I/71m05O2uNdL._SX679_.jpg",


           // "password"=>Hash::make('12345')
        ],
        [

        
            'name'=>"Apple Mobile",
            "price"=>"50000",
            "description"=>"Updated camera with latest Processor",
            'category'=>"Mobile",
            'gallery'=>"data:image/webp;base64,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",


           // "password"=>Hash::make('12345')
        ],
        [


        
            'name'=>"Lg Tv",
            "price"=>"50000",
            "description"=>"Smart TV",
            'category'=>"Tv",
            'gallery'=>"https://images-na.ssl-images-amazon.com/images/I/81TjMVoja4L._SL1500_.jpg",


           // "password"=>Hash::make('12345')
        ],
        [

        
            'name'=>"Apple TV",
            "price"=>"100000",
            "description"=>"Best Resolution Tv",
            'category'=>"Tv",
            'gallery'=>"https://m.media-amazon.com/images/G/01/img15/brawner/apple-tv-4k-overview_1._CB479652502_.jpg",


           // "password"=>Hash::make('12345')
        ],
        [

        
            'name'=>"Samsung watch",
            "price"=>"30000",
            "description"=>"Smart watch with heartbeat sensorr",
            'category'=>"Watch",
            'gallery'=>"https://images.samsung.com/is/image/samsung/in-watch-active2-r825fs-sm-r825fssainu-frontsilver-200031287?$684_547_PNG$",


           // "password"=>Hash::make('12345')
        ]
    
    
    
    
    
    ]);
    
}

}
