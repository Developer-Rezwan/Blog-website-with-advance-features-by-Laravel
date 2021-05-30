<?php

namespace Database\Seeders;

use App\Models\User;
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
        User::create([
            'fullName'  => 'Developer-Rezwan',
            'email'     => 'rezwanhossainsajeeb@gmail.com',
            'password'  => Hash::make('password'),
            'photo'     => 'photo_607e7f3a9bf4b4.345608964wZDRynhq9.png',
            'phone'     => '01797840513'
        ]);
    }
}