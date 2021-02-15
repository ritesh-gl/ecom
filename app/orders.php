<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

use Illuminate\Support\Facades\DB;
use App\Product;

class orders extends Model
{
   // public $timestamps=false;
    //protected $connection="mysql_1";
    public function myOrders($userId)
    {
      return  DB::table('orders')
        ->join('products','orders.product_id','=','products.id')
        ->where('orders.user_id',$userId)
        ->select('products.*','orders.*')
        ->get();
    }

}
