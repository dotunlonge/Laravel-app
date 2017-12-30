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
        $role_user = new Role();
        $role_user->name = 'Administrator';
        $role_user->description = 'An Administrator';
        $role_user->save();

        $role_user = new Role();
        $role_user->name = 'API User';
        $role_user->description = 'An API User';
        $role_user->save();

        $role_user = new Role();
        $role_user->name = 'Authenticated User';
        $role_user->description = 'An Authenticated User';
        $role_user->save();
        
    }
}