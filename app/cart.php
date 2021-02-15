<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;
use App\orders;
use Illuminate\Support\Facades\DB;

class cart extends Model
{
    //
    public $table="cart";

    public function saveVAl($req,$data)
    {   
        $cart=new cart();
        $cart->user_id=$req->session()->get('user')['id'];
           $cart->product_id=$req->product_id;
           $cart->cart_quantity=$req->quant;
           $cart->item_price=$data['price'];
            $cart->save(); 
    }

    public function num($userid)
    {
        return cart::where('user_id',$userid)->count();
    }

    public function cartList($userId)
    {
       return DB::table('cart')
       ->join('products','cart.product_id','=','products.id')
       ->where('cart.user_id',$userId)
    ->select('products.*','cart.*','cart.id as cart_id')
    ->get();
    }

    public function orderNow($userId)
    {
        return cart::where('user_id',$userId)->get();
    }


    public function orderPlace($userId,$req)
    {
      $products=DB::table('cart')
        ->join('products','cart.product_id','=','products.id')
        ->where('cart.user_id',$userId)
     ->select('products.*','cart.*','cart.id as cart_id')
     ->get();

     foreach ($products as $item)
     {
         
       $leftqn=$item->quantity-$item->cart_quantity;
       //echo $item->quantity;

       DB::table('products')
       ->where('id', $item->product_id)  // find your user by their email
       ->limit(1)  // optional - to ensure only one record is updated.
       ->update(array('quantity' => $leftqn));  // update the record in the DB.
      
            
      }

      $allcart=cart::where('user_id',$userId)->get();
      foreach($allcart as $cart)
      {
          $order=new orders;
          $order->product_id=$cart['product_id'];
          $order->user_id=$cart['user_id'];
          $order->status="pending";
          $order->payment_method=$req->payment;
          $order->payment_status="pending";
          $order->payment_method=$req->payment;
          $order->address=$req->address;
          $order->order_quantity=$cart['cart_quantity'];
          $order->save();
          $allcart= DB::table('cart')
          ->orderBy('id')
          ->limit(1)
          ->delete();
         // $allcart=cart::where('user_id',$userId)->delete();

      }

    }
}
