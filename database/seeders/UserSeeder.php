<?php

namespace Database\Seeders;
use App\Models\User;
use App\Models\Role;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        User::updateOrCreate([
            'role_id' => Role::where('slug','admin')->first()->id,
            'name' => 'Admin',
            'email' => 'hemel.1997@gmail.com',
            'password' => Hash::make('password'),
            'status' => true
        ]);

        User::updateOrCreate([
            'role_id' => Role::where('slug','user')->first()->id,
            'name' => 'User',
            'email' => 'raihanhemel.aiub@gmail.com',
            'password' => Hash::make('password'),
            'status' => true
        ]);
    }
}
