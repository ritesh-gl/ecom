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
        $probj=new Product();
 
        $data=$probj->allPr();
        
        return view('product',['products'=>$data]);
    }
    

    function detail($id)
    {
        $probj=new Product();
        $data=$probj->detail($id);
        if($data['quantity']==0)
        {
            return redirect('/products');
            echo '<script>alert("Not Enough Item in stock.");
            window.location = /products;
            </script>';
            
        }
        else{
        return view('detail',['products'=>$data]);
        }
    }

    function search(Request $req)
    {
        $probj=new Product();
       
        $data= $probj->search($req);
       return view('search',['products'=>$data]);
        
    }

    function addToCart(Request $req)    
    {
       if($req->session()->has('user'))
       { 
        
        $probj=new Product();
        $data=$probj->detail($req->product_id);
       
        $leftq= $data['quantity']-$req->quant;

        if($leftq>=0)
        {
        $cart=new cart;
        $cart=$cart->saveVal($req,$data);
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
        $cart=new cart;
        return $cart->num($userid);
    }

    function cartList()
    {   
        $userId=Session::get('user')['id'];
        $cart=new cart;
       $products=$cart->cartList($userId);

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
        $cart=new cart;
        $allcart=$cart->orderNow($userId);
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
        $cart=new cart;
        $cart->orderPlace($userId,$req);
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
        $probj=new Product();
        $probj->buyPlace($id,$leftqn,$userId,$req,$qtn);
        $req->input();
        return redirect('/');  
        }
    }


    function myOrders()
    {
        $userId=Session::get('user')['id'];
        $ordobj=new orders();
        $orders=$ordobj->myOrders($userId);
        $quant=cart::where('user_id',$userId)->get();
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
        if($req->ct)
        {
            $s1=Session::put('ct',$req->ct);
            $cat=$req->ct;
        }
        else 
        $cat=Session::get('ct');
        
        if($req->pr)
        {
            $s2=Session::put('pr',$req->pr);
            $price=$req->pr;
        }
        else 
        $price=Session::get('pr');
       
        if($req->paginate)
        {
           if($req->paginate<=0)
            {
                echo "<script>alert('Please enter valid pagination value!');</script>";
            }
            else 
            {           
               $ss=Session::put('pgn',$req->paginate);
               $pg=$req->paginate;
            }
        }
        else 
        $pg=Session::get('pgn');

        if($cat=="all")
        {
            $data= Product::
            paginate($pg);
        }
        else if($cat=="" && $price=="")
        {
            $data= Product::
            paginate($pg);
        }
        else if($cat=="" && $price!="")
        {
            $data= Product::
            orderBy('price',$price)->paginate($pg);
        }

       else if($price=="" && $cat!="" )
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
