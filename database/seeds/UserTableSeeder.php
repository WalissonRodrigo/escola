<?php

use Illuminate\Database\Seeder;

use App\User;
use Laracasts\TestDummy\Factory as TestDummy;

class UserTableSeeder extends Seeder
{
    public function run()
    {
        User::truncate();
        User::create([
            'name' => 'Administrador',
            'email' => 'admin@admin.com',
            'password' => bcrypt('admin')
        ]);
    }
}
