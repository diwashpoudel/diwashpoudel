<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role',
        'status'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function user_info(){
        return $this->hasOne("App\Models\UserInfo",'User_id' ,'id');
    }

    public function validateUserData($act='add')
    {
            $rules = array(
                    'name'=> 'required|string|max:50',
                    'phone'=>'nullable|string|max:25',
                    'shipping_address'=>'required|string',
                     'billing_address' => 'required|string',
                     'image'=>'sometimes|image|max:'.env('MAX_UPLOAD_SIZE',5000)

            );
            if($act == 'add')
            {
                $rules = array(
                    'status'=>'required|in:active, inactive',
                    'role'=>'required|in:admin,seller,customer',
                    'email'=>'required|unique:users,email',
                    'password'=>'required|confirmed|string|min:8'
                    //'password_conformation'=>'required|confirmed|string|min:8'
                );
            }
            return $rules;
    }

    public function getUserByType($type)
    {
        return $this->where('role',$type)->get();
    }
}
