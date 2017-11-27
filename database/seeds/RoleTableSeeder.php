<?php

use Illuminate\Database\Seeder;
use App\Role;

class RoleTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $roles = [
            [
                'name' => "admin",
                'display_name' => 'Application admin',
                'description' => 'Can manage everything'
            ],
            [
                'name' => "agent",
                'display_name' => 'Can manage customers',
                'description' => 'See all customers'
            ],
            [
                'name' => "customer",
                'display_name' => 'Can manage customer profile',
                'description' => 'Can manage customer profile'
            ],
        ];

        foreach ($roles as $key=>$value){
            Role::create($value);
        }

    }
}
