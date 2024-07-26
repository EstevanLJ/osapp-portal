<?php

use Illuminate\Support\Facades\Hash;
use App\User;
use Illuminate\Database\Seeder;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::create([
            'name' => 'Admin',
            'email' => 'admin@admin.com',
            'password' => Hash::make('admin'),
            'type' => 'ADMIN',
            'enabled' => 1
        ]);

        User::create([
            'name' => 'User',
            'email' => 'user@user.com',
            'password' => Hash::make('user'),
            'type' => 'DEFAULT',
            'enabled' => 1
        ]);
    }
}
