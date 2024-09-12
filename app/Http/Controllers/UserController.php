<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Spatie\Permission\Models\Role;
use Spatie\Permission\Models\Permission;

class UserController extends Controller
{
    public function assignRole(Request $request, $userId )
    {
        $user = User::find($userId);

        // Validate the request to ensure valid role
        $request->validate([
            'role' => 'required|string|exists:roles,name'
        ]);

        // Assign the role to the user
        $user->assignRole($request->input('role'));

        return response()->json(['message' => 'Role assigned successfully.']);
    }

    public function createRoleAndPermission()
    {
        // Create role
        $admin_role = Role::create(['name' => 'admin']);
        $user_role = Role::create(['name' => 'user']);


        // Create permission
        $user_list = Permission::create(['name' => 'user.list']);
        $user_view = Permission::create(['name' => 'user.view']);
        $user_create = Permission::create(['name' => 'user.create']);
        $user_edit = Permission::create(['name' => 'user.edit']);
        $user_delete = Permission::create(['name' => 'user.delete']);

        // Assign permission to role
        $admin_role->givePermissionTo($view_permission,$create_permission);
        $user_role->givePermissionTo($view_permission,$update_permission);

    }
}

