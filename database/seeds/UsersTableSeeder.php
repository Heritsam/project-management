<?php

use App\UserGroup;
use App\User;
use Illuminate\Database\Seeder;
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
        UserGroup::create([
            'name' => 'Project Manager',
            'status' => 1,
        ]);
        
        User::create([
            'name' => 'Ariq Heritsa',
            'email' => 'ariqhm@gmail.com',
            'username' => 'heritsam',
            'password' => Hash::make('heritsam'),
            'user_group_id' => 1,
            'email_verified_at' => now(),
            'status' => 1,
        ]);
    }
}
