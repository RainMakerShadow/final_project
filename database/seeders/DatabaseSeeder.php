<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $admin=User::create([
            'name' => 'admin',
            'email' => 'nechay2112@gmail.com',
            'email_verified_at' => now(),
            'password' => Hash::make('21121985'), // password
        ]);

        Role::create([
       'name' =>'admin',

    ]);
            $admin->assignRole('admin');
    }
}
