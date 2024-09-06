<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


        Permission::updateOrCreate(['name' => 'Role access'], ['role_name' => 'Role', 'guard_name' => "admin"]);
        Permission::updateOrCreate(['name' => 'Role delete'], ['role_name' => 'Role', 'guard_name' => "admin"]);
        Permission::updateOrCreate(['name' => 'Role edit'], ['role_name' => 'Role', 'guard_name' => "admin"]);
        Permission::updateOrCreate(['name' => 'Role create'], ['role_name' => 'Role', 'guard_name' => "admin"]);


        Permission::updateOrCreate(['name' => 'Permission access'], ['role_name' => 'Permission', 'guard_name' => "admin"]);
        Permission::updateOrCreate(['name' => 'Permission edit'], ['role_name' => 'Permission', 'guard_name' => "admin"]);
        Permission::updateOrCreate(['name' => 'Permission delete'], ['role_name' => 'Permission', 'guard_name' => "admin"]);
        Permission::updateOrCreate(['name' => 'Permission create'], ['role_name' => 'Permission', 'guard_name' => "admin"]);

        Permission::updateOrCreate(['name' => 'Rolehaspermission access'], ['role_name' => 'Rolehaspermission', 'guard_name' => "admin"]);
        Permission::updateOrCreate(['name' => 'Rolehaspermission edit'], ['role_name' => 'Rolehaspermission', 'guard_name' => "admin"]);

        Permission::updateOrCreate(['name' => 'Users access'], ['role_name' => 'Users', 'guard_name' => "admin"]);
        Permission::updateOrCreate(['name' => 'Users create'], ['role_name' => 'Users', 'guard_name' => 'admin']);
        Permission::UpdateOrCreate(['name' => 'Users edit'], ['role_name' => 'Users', 'guard_name' => 'admin']);
        Permission::updateOrCreate(['name' => 'Users delete'], ['role_name' => 'Users', 'guard_name' => 'admin']);
    }
}




// public function run(): void
// {
//     $permissions = [
//         'role-list',
//         'role-create',
//         'role-edit',
//         'role-delete',
//     ];
//     foreach ($permissions as $permission) {

//         Permission::create(['name' => $permission]);
//     }
// }