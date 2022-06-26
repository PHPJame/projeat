<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class CreateUsersSeed extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UserSeeder::class);
        $user = new \App\User();
        $user->name = 'admin';
        $user->id_role = 1;
        $user->email = 'admin@gmail.com';
        $user->password = Hash::make('1234');
        $user->save();
    }
}