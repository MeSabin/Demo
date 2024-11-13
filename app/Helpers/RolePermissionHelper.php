<?php

namespace App\Helpers;

use Illuminate\Support\Facades\Auth;
use App\Models\UserRole;

class RolePermissionHelper
{
    public static function checkPermission(string $permission = 'view dashboard'): bool
    {
        if (!Auth::check()) {
            return false;
        }

        $user = Auth::user();

        $role = $user->userRole?->role;

        if (!$role) {
            abort(403);
        }

        $permissions = $role->permissions()->pluck('permissions.title')->toArray();

        // $permission_one = $role->permissions()->pluck('title');
        // $permission_one = $role->permissions->pluck('title');
        // $permission_one = $role->permissions()->pluck('permissions.title');

        return in_array($permission, $permissions);
    }
}
