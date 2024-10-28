<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;
use Hash;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $password = Hash::make('12345678');

        $adminRecords = [
            ['name' => 'Admin', 'email' => 'admin@main.com', 'password' => $password, 'type' => 'admin', 'mobile' => '1234567890', 'image' => '', 'status' => 1],
        ];
        Admin::insert($adminRecords);
    }
}
