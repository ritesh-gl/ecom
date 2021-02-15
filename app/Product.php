<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\orders;
use Illuminate\Support\Facades\DB;


class Product extends Model
{
    public $table="products";



    public function allPr()
    {
        
       return Product::all();

    }

    public function detail($id)
    {
        return Product::find($id);
    }

    public function search($req)
    {
        return Product::where('name','like','%'.$req->input('query').'%')->get() ;
    }

    public function buyPlace($id,$leftqn,$userId,$req,$qtn)
    {
        DB::table('products')
        ->where('id', $id)  // find your user by their email
        ->limit(1)  // optional - to ensure only one record is updated.
        ->update(array('quantity' => $leftqn));  // update the record in the DB.
       
        $order=new orders;
        $order->product_id=$id;
        $order->user_id=$userId;
        $order->status="pending";
        $order->payment_method=$req->payment;
        $order->payment_status="pending";
        $order->address=$req->address;
        $order->order_quantity=$qtn;
        $order->save();
    }
}
