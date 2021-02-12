<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation;
use Illuminate\Http\Request;
use App\Product;
use App\cart;
use App\orders;

use Session;
use Illuminate\Support\Facades\DB;



class ProductController extends Controller
{
    //
    function index()
    {
        $data=Product::all();
        
        return view('product',['products'=>$data]);
    }
    

    function detail($id)
    {
        $data=Product::find($id);
        return view('detail',['products'=>$data]);
    }

    function search(Request $req)
    {

       
        $data= Product::
       where('name','like','%'.$req->input('query').'%')->get() ;
       return view('search',['products'=>$data]);
        
    }

    function addToCart(Request $req)    
    {
       if($req->session()->has('user'))
       { 
       
        $data=Product::find($req->product_id);
        $leftq= $data['quantity']-$req->quant;

        if($leftq>=0)
        {
        $cart=new cart;
           $cart->user_id=$req->session()->get('user')['id'];
           $cart->product_id=$req->product_id;
           $cart->cart_quantity=$req->quant;
           $cart->item_price=$data['price'];
            $cart->save();

            return redirect('/cartList');
        }
        else {
            echo '<script>alert("Not Enough Item in stock.\n Only '.$data['quantity'].' left.")</script>';
            return view('detail',['products'=>$data]);        }
       }

       else
       {
           return redirect('/login');
       }
    
    }


    static function cartItem()
    {
        $userid=Session::get('user')['id'];
        return cart::where('user_id',$userid)->count();
    }

    function cartList()
    {   
        $userId=Session::get('user')['id'];
       $products=DB::table('cart')
       ->join('products','cart.product_id','=','products.id')
       ->where('cart.user_id',$userId)
    ->select('products.*','cart.*','cart.id as cart_id')
    ->get();

    
    

    return view('cartList',['products'=>$products]);

    }

    function removeCart($id)
    {
        cart::destroy($id);
        return redirect('cartList');
    }

    function orderNow()
    {   
        $userId=Session::get('user')['id'];
        $allcart=cart::where('user_id',$userId)->get();
        $total_sum=0;
        foreach($allcart as $cart)
        {
            $total_sum=$total_sum+($cart['cart_quantity']*$cart['item_price']);
        }
      return view('ordernow',['total'=>$total_sum]);
    }

    function orderPlace(Request $req)
    {
     
        $userId=Session::get('user')['id'];
        $allcart=cart::where('user_id',$userId)->get();
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
        $req->input();
        return redirect('/');      
    }

function buyNow(Request $req )
{   
    if($req->session()->has('user'))
    { 
       
        $userId=Session::get('user')['id'];
        $id1=Session::put('pid',$req->product_id);
        $data=Product::find($req->product_id);
        $qtn=Session::put('qtn',$req->quant);
        $leftqn=$data['quantity']-$req->quant;
        if($leftqn>=0)
        {
            $tot=$data['price']*$req->quant;
            return view('buyPlace',['total'=>$tot]);
        }
        else{
            echo '<script>alert("Not Enough Item in stock.\n Only '.$data['quantity'].' left.")</script>';
            return view('detail',['products'=>$data]);
        } 
    }
    else
    {
       return redirect('/login');
    }

}

    function buyPlace(Request $req)
    { $id=Session::get('pid');
        $data=Product::find($id);
        $validated = Validator::make($req->all(), [
            'payment' => 'required',
            'address' => 'required',
        ]);
        if($validated->fails())
        {
             return view('buyPlace',['errors'=>$validated->errors(),'total'=>$data->price]);
        }
        else {
        $userId=Session::get('user')['id'];
        $qtn=Session::get('qtn');
        $leftqn=$data['quantity']-$qtn;
        
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
    
        $req->input();
        return redirect('/');  
        }
    }


    function myOrders()
    {
        $userId=Session::get('user')['id'];
        $orders= DB::table('orders')
        ->join('products','orders.product_id','=','products.id')
        ->where('orders.user_id',$userId)
        ->select('products.*','orders.*')
        ->get();
       // $quant=cart::where('user_id',$userId)->get();
     return view('myorders',['orders'=>$orders]); 
    }


    function allProduct()
    {
        if(Session::get('pgn'))
        $pg=Session::get('pgn');
        else $pg=6;

        $data= Product::
            paginate($pg);
        return view('allProduct',['products'=>$data]);

    }

    function proCat(Request $req)
    {


        $cat=$req->ct;
        $price=$req->pr;
        
        if($req->paginate)
      {
           if($req->paginate<=0)
        {
            echo "<script>alert('Please enter valid pagination value!');</script>";
        }
        else {           $ss=Session::put('pgn',$req->paginate);
            $pg=$req->paginate;
    }
    }
else $pg=Session::get('pgn');

        // echo $price;
        // echo $cat;
        if($cat=="" && $price=="")
        {
            $data= Product::
            paginate($pg);
        }
        else if($cat=="" && $price!="")
        {
            $data= Product::
            orderBy('price',$price)->paginate($pg);
        }

       else if($price=="" && $cat!="")
        { 
            $data= Product::
            where('category','like',$cat)->paginate($pg);
        }
        else
        {
        $data= Product::
        where('category','like',$cat)->orderBy('price',$price)->paginate($pg) ;
        }
      return view('allProduct',['products'=>$data]);

    }

  

}
