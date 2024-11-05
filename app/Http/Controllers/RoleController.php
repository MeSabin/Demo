<?php

namespace App\Http\Controllers;

use App\Http\Requests\AssignRoleRequest;
use App\Models\Permission;
use App\Models\Role;
use App\Models\RolePermission;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
        $roles = Role::with('permissions')->paginate();
        return view('admin.role.index', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(): View
    {
        $permissions = Permission::orderBy('group', 'ASC')->get();
        $groupedPermissions = $permissions->groupBy('group');  
        // dd($groupedPermissions);

        return view('admin.role.create', compact('groupedPermissions'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(AssignRoleRequest $request)
    {
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
    //    $data = $request->all();
    //    dd($data);

    }

    /**
     * Display the specified resource.
     */
    public function show(Role $role)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(Role $role)
    {
        $role = Role::find($role->id);
        return view('admin.role.edit', compact('role'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Role $role)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Role $role)
    {
        //
    }
}
