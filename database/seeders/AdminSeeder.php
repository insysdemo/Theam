<?php

namespace Database\Seeders;

use App\Models\Admin;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;


class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {


            Role::firstOrCreate(
                [
                    'name' => 'Admin',
                ],
                [
                    'id'   => 1,
                    'name' => 'Admin',
                    'guard_name' => 'admin',
                    // 'is_editable' => '0',
                ]
            );

            Admin::firstOrCreate(
                [
                    'email'     => 'admin@gmail.com',
                ],
                [
                    'id'        => 1,
                    'name'      => 'Admin',
                    'email'     => 'admin@gmail.com',
                    'role_id'   => 1,
                    'password'  => Hash::make(123456789)
                ]
            );


        // $user = Admin::create([
        //     'name' => 'ketan',
        //     'email' => 'k@gmail.com',
        //     'password' => bcrypt('123456')
        // ]);

        // $role = Role::create(['name' => 'Admin']);

        // $permissions = Permission::pluck('id', 'id')->all();

        // $role->syncPermissions($permissions);

        // $user->assignRole([$role->id]);



        $admin = Admin::where('role_id', 1)->first();
   
        $Role = Role::where('id', 1)->first();
        $admin->assignRole($Role);
        $Role->givePermissionTo(Permission::all());
    }
}
