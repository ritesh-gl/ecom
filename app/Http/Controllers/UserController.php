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

class Usercontroller extends Controller
{
    function login(Request $req)
    {
        $validated = Validator::make($req->all(), [
            'email' => 'required|email',
            'password' => 'required',
        ]);
        if($validated->fails())
        {
             return view('login',['errors'=>$validated->errors()]);

        }
        else {
        $user= User::where(['email'=>$req->email])->first();
        if(!$user || !Hash::check($req->password,$user->password))
        {
            return "username or password is not matched";

        }
        else{
            $req->session()->put('user',$user);
            return redirect('/');
            }
        }   
    }

    function register(request $req)
    {
        $validated = Validator::make($req->all(), [
            'email' => 'required|email',
            'name' =>'required',
            'contact'=>'required',
            'password' => 'required',
            'password_repeat'=>'required'
        ]);
        if($validated->fails())
        {
            //echo "error";
            return view('register',['errors'=>$validated->errors()]);
        }
        else {
            $name=$req->name;
            $email=$req->email;
            $pass=$req->password;
            $contact=$req->contact;
            $check= User::where(['email'=>$req->email])->first();
            if(!$check){
            DB::insert('insert into users (name, email, password, contact) values (?, ?, ?,?)', [$name, $email, Hash::make($pass),$contact]);
            return redirect('/login');
            }
            else {
            echo "User already exists. <a href='/login'> Click here </a> to login." ;
            }
        }
    $req->input();
}
}
