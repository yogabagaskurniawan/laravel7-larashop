<?php

use App\Models\User;
use Illuminate\Database\Seeder;

class UsersTableSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $adminUser = [
            'name' => 'admin',
            'status' => 1,
            'email' => 'admin@excemple.com',
            'password' => bcrypt('admin'),
        ];

        if (!User::where('email', $adminUser['email'])->exists()){
            User::create($adminUser);
        }
    }
}
