<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
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
        $this->createUser('ejemplo1@example.com', 'Juan', 'Pérez', 'somePassword');
        $this->createUser('ejemplo2@example.com', 'María', 'González', 'someOtherPassword');
    }

    private function createUser($email, $name, $lastName, $password)
    {
        DB::table('users')->upsert([
                'email' => $email,
                'name' => $name,
                'lastName' => $lastName,
                'password' => Hash::make($password),
                'created_at' => now(),
                'updated_at' => now(),
            ],
            ['email'],
            ['name', 'lastName', 'password', 'created_at', 'updated_at'] 
        );
    }
}