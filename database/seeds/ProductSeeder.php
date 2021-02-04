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
            'name'=>"Samsung Mobile",
            "price"=>"20000",
            "description"=>"Smart Phone with 6gb Ram and many morer",
            'category'=>"Mobile",
            'gallery'=>"https://images-na.ssl-images-amazon.com/images/I/710weRkP-nL._SY606_.jpg",


           // "password"=>Hash::make('12345')
        ],
        [

        
            'name'=>"Apple Watch",
            "price"=>"11000",
            "description"=>"Smart watch with Facetime and many morer",
            'category'=>"Watch",
            'gallery'=>"https://images-na.ssl-images-amazon.com/images/I/71fwbMm1NBL._AC_SL1500_.jpg",


           // "password"=>Hash::make('12345')
        ],
        [


        
            'name'=>"Samsung Tv",
            "price"=>"50000",
            "description"=>"Smart TV",
            'category'=>"Tv",
            'gallery'=>"https://images-na.ssl-images-amazon.com/images/I/71SJZ2F9YLL._SL1500_.jpg",


           // "password"=>Hash::make('12345')
        ],
        [

        
            'name'=>"LG washing Machine",
            "price"=>"25000",
            "description"=>"Automatic Washing Machine",
            'category'=>"Washing Machine",
            'gallery'=>"https://www.lg.com/in/images/washing-machines/md07520882/gallery/THD11STM-Washing-Machines-Front-View-MZ-01.jpg",


           // "password"=>Hash::make('12345')
        ],
        [

        
            'name'=>"HP Printer",
            "price"=>"30000",
            "description"=>"WIFI Printer",
            'category'=>"Printer",
            'gallery'=>"https://images-na.ssl-images-amazon.com/images/I/612SY5kuGBL._SL1500_.jpg",


           // "password"=>Hash::make('12345')
        ]
    
    
    
    
    
    ]);
    
}

}
