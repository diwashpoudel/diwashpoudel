<?php

namespace Database\Seeders;
use Illuminate\Database\Seeder;
use App\Models\User;

class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_list=  array(
            array(
                    'name'=>"Admin User",
                    'email'=>"admin@test.com",
                    'password'=>bcrypt('admin123'),
                    'status'=>"active",
                    'role'=>"admin"
            ),
            array(
                'name' => "Seller User",
                'email' => "seller@test.com",
                'password' => bcrypt('seller123'),
                'status' => "active",
                'role' => "seller"
            ),
            array(
                'name' => "Customer User",
                'email' => "customer@test.com",
                'password' => bcrypt('customer123'),
                'status' => "active",
                'role' => "customer"
            )
        );

        foreach ($user_list as $user_info) 
        {
                if(User::where('email',$user_info['email'])->count()<= 0)
                {
                        User::insert($user_info);
                }
        }
    }
}
