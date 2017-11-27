<?php

use Illuminate\Database\Seeder;
use App\Permission;

class PermissionTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        $permissions = [
          [
              'name' => "user-manage",
              'display_name' => 'Manage Users',
              'description' => 'Manage all users'
          ],
          [
              'name' => "customer-read",
              'display_name' => 'Customer Listing',
              'description' => 'See all customers'
          ],
        ];

        foreach ($permissions as $key=>$value){
            Permission::create($value);
        }

    }
}
