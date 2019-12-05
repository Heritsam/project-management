<?php

use App\UserGroup as Group;
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
        $administrator = Group::create([
            'name' => 'Administrator',
            'status' => 1,
        ]);
        
        $project_manager = Group::create([
            'name' => 'Project Manager',
            'status' => 1,
        ]);

        User::create([
            'name' => 'Administrator',
            'email' => 'admin@gmail.com',
            'username' => 'administrator',
            'password' => Hash::make('administrator'),
            'user_group_id' => $administrator->id,
            'email_verified_at' => now(),
            'status' => 1,
        ]);
        
        User::create([
            'name' => 'Ariq Heritsa',
            'email' => 'ariqhm@gmail.com',
            'username' => 'heritsam',
            'password' => Hash::make('heritsam'),
            'user_group_id' => $project_manager->id,
            'email_verified_at' => now(),
            'status' => 1,
        ]);
    }
}
