<?php

namespace App\Http\Controllers;
use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
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

}
