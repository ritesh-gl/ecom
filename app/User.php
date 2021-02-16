<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable;
    public $timestamps=true;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
         'remember_token',
    ];

    public function findByEmail($req)
    {

       return User::where(['email'=>$req->email])->first();

    }

    public function rsave($req)
    {
        $userobj=new User();
        $userobj->name=$req->name;
           $userobj->email=$req->email;
           $userobj->password=Hash::make($req->password);
           $userobj->contact=$req->contact;;
           $userobj->save();
    }
}
