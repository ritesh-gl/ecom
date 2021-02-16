<?php

namespace App\Http\Controllers;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation;
use Illuminate\Support\Facades\Redirect;
use Illuminate\Foundation\Validation\ValidatesRequests;
use App\User;
use App\Http\Requests\UserLoginRequest;
use App\Http\Requests\UserRegisterRequest;


class Usercontroller extends Controller
{
    function login(UserLoginRequest $req)
    {
        // $validated = Validator::make($req->all(), [
        //     'email' => 'required|email',
        //     'password' => 'required',
        // ]);
        // if($validated->fails())
        // {
        //      return view('login',['errors'=>$validated->errors()]);

        // }
        // else {
            $userobj=new User();
           

        $user= $userobj->findByEmail($req);
        

        if(!$user || !Hash::check($req->password,$user->password))
        {
            echo '<script>alert("User does not exits!")</script>';
            return view('login');
        }
        else{ 
            $req->session()->put('user',$user);
            return redirect('/');
            }
        //}   
    }

    function register(UserRegisterRequest $req)
    {
        // $validated = Validator::make($req->all(), [
        //     'email' => 'required|email',
        //     'name' =>'required',
        //     'contact'=>'required',
        //     'password' => 'required',
        //     'password_repeat'=>'required'
        // ]);
        // if($validated->fails())
        // {
        //     //echo "error";
        //     return view('register',['errors'=>$validated->errors()]);
        // }
        // else {
          
            $userobj=new User();
            $user= $userobj->findByEmail($req);
            
            if(!$user){
                $userobj->rsave($req);
           
           return redirect('/login');
            }
            else {
            echo '<script> alert ("user already exists.");  window.location="/login" </script>' ;
            }
       // }
    $req->input();
}
}
