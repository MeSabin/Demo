<?php

namespace App\Http\Controllers;

use App\Http\Requests\AssignRoleRequest;
use App\Http\Requests\UpdateRoleRequest;
use App\Models\Permission;
use App\Models\Role;
use App\Models\RolePermission;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use App\Helpers\RolePermissionHelper;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        if(!RolePermissionHelper::checkPermission('manage role')){
            abort(403);
        }
        $roles = Role::with('permissions')->paginate(3);
        // return $roles;
        return view('admin.role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        if(!RolePermissionHelper::checkPermission('manage role')){
            abort(403);
        }
        $permissions = Permission::orderBy('group', 'ASC')->get();
        $groupedPermissions = $permissions->groupBy('group');  
        // return $groupedPermissions;
        return view('admin.role.form', compact('groupedPermissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AssignRoleRequest $request)
    {
        if(!RolePermissionHelper::checkPermission('manage role')){
            abort(403);
        }
       $role = Role::create([
            'name' => $request->name,
        ]);


        $permissions = $request->input('permissions');


        $role->permissions()->sync($permissions);

        return redirect()->route('roles.index')->with('create_roles_perm', 'Permissions assigned to the role');
    //     foreach($permissions as $permission) {
    //         $role_permission = new RolePermission;
    //         $role_permission->permission_id = $permission;
    //         $role_permission->save();
    //     }

    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        if(!RolePermissionHelper::checkPermission('manage role')){
            abort(403);
        }
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        if(!RolePermissionHelper::checkPermission('manage role')){
            abort(403);
        }
        $role = Role::with('permissions')->find( $role->id );
        // return $role;
        $update = 'update_form';
     
        $permissions = Permission::orderBy('group', 'ASC')->get();
        $groupedPermissions = $permissions->groupBy('group');  
     
        return view('admin.role.form', compact('role', 'groupedPermissions', 'update'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(UpdateRoleRequest $request, Role $role)
    {
        if(!RolePermissionHelper::checkPermission('manage role')){
            abort(403);
        }

        $role = Role::find( $role->id );
        $role->name = $request->name;
        $role->save();
        $permissions = $request->input('permissions');
        $role->permissions()->sync($permissions);

        return redirect()->route('roles.index')->with('update_roles_perm','Permissions updated for role');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        if(!RolePermissionHelper::checkPermission('manage role')){
            abort(403);
        }
        $roles = Role::find( $role->id );
        $permissions =  $roles->permissions;
        $assigned_permissions = [];
                foreach($permissions as $role){
                    // $assigned_permissions =  $role->id ;
                    array_push($assigned_permissions, $role->id);
                }
                // return $assigned_permissions;
        $roles->permissions()->detach($assigned_permissions);

        $roles->delete();

        return redirect()->route('roles.index')->with('delete_roles_perm', 'Permissions deleted for the role');
    }
}
