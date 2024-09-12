<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;
use App\Models\User;


class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $user_list = Permission::create(['name' => 'user.list']);
        $user_view = Permission::create(['name' => 'user.view']);
        $user_create = Permission::create(['name' => 'user.create']);
        $user_edit = Permission::create(['name' => 'user.edit']);
        $user_delete = Permission::create(['name' => 'user.delete']);

        $admin_role = Role::create(['name' => 'admin']);
        $admin_role->givePermissionTo([
            $user_list,
            $user_view,
            $user_create,
            $user_edit,
            $user_delete,
        ]);

        $user_role = Role::create(['name' => 'user']);
        $user_role->givePermissionTo([
            $user_list,
            // $user_view,
            // $user_create,
            // $user_edit,
            // $user_delete,
        ]);
    }
}
