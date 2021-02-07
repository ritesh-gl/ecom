<?php

namespace App\Http\Controllers;

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
           $cart=new cart;
           $cart->user_id=$req->session()->get('user')['id'];
           $cart->product_id=$req->product_id;
            $cart->save();
            return redirect('/');
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
    ->select('products.*','cart.id as cart_id')
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
       $total= DB::table('cart')
       ->join('products','cart.product_id','=','products.id')
       ->where('cart.user_id',$userId)
    ->sum('products.price');

    return view('ordernow',['total'=>$total]);

    }

    function orderPlace(Request $req)
    {
        $userId=Session::get('user')['id'];
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
            $order->save();
            $allcart=cart::where('user_id',$userId)->delete();

        }
        $req->input();
        return redirect('/');      
    }

    function myOrders()
    {
        $userId=Session::get('user')['id'];
        $orders= DB::table('orders')
        ->join('products','orders.product_id','=','products.id')
        ->where('orders.user_id',$userId)
        ->get();
 
     return view('myorders',['orders'=>$orders]); 
    }

    function allProduct()
    {
        $data=Product::all();
        return view('allProduct',['products'=>$data]);
    }

    function proCat(Request $req)
    {
        $cat=$req->ct;
        $price=$req->pr;
        // echo $price;
        // echo $cat;
        if($cat=="" && $price=="")
        {
            $data= Product::
            all();
        }
        else if($cat=="" && $price!="")
        {
            $data= Product::
            orderBy('price',$price)->get() ;
        }

       else if($price=="" && $cat!="")
        { 
            $data= Product::
            where('category','like',$cat)->get() ;
        }
        else
        {
        $data= Product::
        where('category','like',$cat)->orderBy('price',$price)->get() ;
        }
      return view('allProduct',['products'=>$data]);

    }

  

}
