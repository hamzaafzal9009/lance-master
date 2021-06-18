<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UsersTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        // User::truncate();
        // DB::table('role_user')->truncate();

        $adminRole = Role::where('name','admin')->first();
        $userRole = Role::where('name','user')->first();

        $admin = User::create([
            'name'      => 'Admin',
            'email'     => 'admin@admin.com',
            'password'  => Hash::make('admin'),
            'is_active' => 1,
            'user_type' => 'admin'
        ]);

        $user = User::create([
            'name'      => 'User',
            'email'     => 'user@user.com',
            'password'  => Hash::make('user'),
            'is_active' => 1,
            'user_type' => 'business_user'
        ]);

        $admin->roles()->attach($adminRole);
        $user->roles()->attach($userRole);
    
    }
}
