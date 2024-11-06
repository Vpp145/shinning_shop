<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use App\Models\AdminsRole;

class AdminsRolesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $admin_records = [
            ['subadmin_id' => '3', 'module' => 'cms_pages', 'view_access' => 1, 'edit_access' => 1, 'full_access' => 1],
            ['subadmin_id' => '4', 'module' => 'cms_pages', 'view_access' => 1, 'edit_access' => 1, 'full_access' => 1],
        ];

        AdminsRole::insert($admin_records);
    }
}
