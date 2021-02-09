<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

use App\User;

class Usercontroller extends Controller
{
    function login(request $req)
    {
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

    function register(request $req)
    {
        $name=$req->name;
        $email=$req->email;
        $pass=$req->password;
        $check= User::where(['email'=>$req->email])->first();
        if(!$check){
        DB::insert('insert into users (name, email, password) values (?, ?, ?)', [$name, $email, Hash::make($pass)]);
        return redirect('/login');
        }
        else {
           echo "User already exists. <a href='/login'> Click here </a> to login." ;
        }
        $req->input();
        
      
    }

}
