<?php

use Illuminate\Database\Seeder;
use App\User;
use App\Role;
class UserTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $role_admin = Role::where('name', 'Administrator')->first();
        $role_api_user  = Role::where('name', 'API User')->first();
        $role_auth_user  = Role::where('name', 'Authenticated User')->first();

        $admin = new User();
        $admin->name = 'Administrator';
        $admin->email = 'admin@example.com';
        $admin->password = bcrypt('secret');
        $admin->email_token = str_random(10);
        $admin->verified = 1;
        $admin->save();

        $admin->roles()->attach($role_admin);

        $api_user = new User();
        $api_user->name = 'API User';
        $api_user->email = 'api_user@example.com';
        $api_user->password = bcrypt('secret');
        $api_user->email_token = str_random(10);
        $api_user->verified = 1;
        
        $api_user->save();
        $api_user->roles()->attach($role_api_user);

        $auth_user = new User();
        $auth_user->name = 'Authenticated User';
        $auth_user->email = 'auth_user@example.com';
        $auth_user->password = bcrypt('secret');
        $auth_user->email_token = str_random(10);
        $auth_user->verified = 1;
          
        $auth_user->save();
        $auth_user->roles()->attach($role_auth_user);
        


    }
}