<?php

namespace Database\Seeders;
use App\Models\User;
use App\Models\Role;
use Hash;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name'              => 'admin',
                'email'             => 'admin@gmail.com',
                'email_verified_at' => now(),
                'password'          => Hash::make('12345'),
                'role'              => 1,
            ]
        ];
        foreach($data as $newuser){
            $user = User::create($newuser);
        } 
        $roles = [
            [
                'name'              => 'admin'
            ],
            [
                'name'              => 'user'
            ],
            [
                'name'              => 'developer'
            ]
        ];
        foreach($roles as $role){
             Role::create($role);
        } 
    }
}
