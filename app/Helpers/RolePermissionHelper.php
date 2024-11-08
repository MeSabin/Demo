<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;

class RolePermissionHelper
{
    public static function checkPermission(string $permission): bool
    {
        if (!Auth::check()) {
            return false;
        }
        
        $user = Auth::user();
        $role = $user->userRole->role;
        $permissions = $role->permissions()->pluck('permissions.title')->toArray();
        return in_array($permission, $permissions);
    }
}
