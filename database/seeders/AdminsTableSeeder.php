<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\Admin;
use Illuminate\Support\Facades\Hash;

class AdminsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $password = Hash::make('12345678');

        $adminRecords = [
            ['name' => 'Amit', 'email' => 'amit@sub.com', 'password' => $password, 'type' => 'subadmin', 'mobile' => '9876543210', 'image' => '', 'status' => 1],
            ['name' => 'John', 'email' => 'john@sub.com', 'password' => $password, 'type' => 'subadmin', 'mobile' => '9876543210', 'image' => '', 'status' => 1],
        ];
        Admin::insert($adminRecords);
    }
}
