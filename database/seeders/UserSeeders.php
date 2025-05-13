<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeders extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            "name" => "Superadmin",
            "email" => "superadmin@gmail.com",
            "password" => Hash::make("admin123"),
            "id_no" => "123",
            "birthday" => "1994-10-27",
            "address" => "Sidoarjo",
        ]);
    }
}
