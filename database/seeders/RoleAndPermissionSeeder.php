<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class RoleAndPermissionSeeder extends Seeder
{
    public function run()
    {
        // Ruxsatlar yaratish
        Permission::create(['name' => 'create news']);
        Permission::create(['name' => 'edit news']);
        Permission::create(['name' => 'delete news']);

        // Rollar yaratish va ularga ruxsatlarni biriktirish
        $adminRole = Role::create(['name' => 'admin']);
        $adminRole->givePermissionTo(['create news', 'edit news', 'delete news']);
    }
}