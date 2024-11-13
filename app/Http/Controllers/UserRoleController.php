<?php

namespace App\Http\Controllers;

use App\Helpers\RolePermissionHelper;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Role ;
use App\Models\UserRole;
use GuzzleHttp\Psr7\Response;
use Illuminate\Contracts\View\View;
use Illuminate\Database\Eloquent\Casts\Json;
use Illuminate\Http\JsonResponse;
use Illuminate\Support\Facades\Validator;

class UserRoleController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index(): View
    {
       
        if(!RolePermissionHelper::checkPermission('manage role')){
            abort(403);
        }
        $users = User::with('userRole.role')->paginate(10);
        
        // // return $users;
        $roles = Role::all();
        // if($roles){
        //     $userHasNoRole = 'User has no role';
        // }
        return view('admin.user-role.index', compact('users', 'roles'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request): JsonResponse | Response
    {
        if(!RolePermissionHelper::checkPermission('manage role')){
            abort(403);
        }
        $validator = Validator::make($request->all(), [
            'user_id'=> 'required',
            'role_id'=> 'required',
        ]);
        if($validator->fails()){
            return response($validator->message(), 200);
        }

        // $user =  User::with('userRole.role')->find($request->user_id); 
        
        $user_id = UserRole::where('user_id', $request->user_id)->first();

        if($user_id){
            $user_id->user_id = $request->user_id;
            $user_id->role_id = $request->role_id;
            $user_id->update();
        }
        else{
            UserRole::create($request->all());
        }
            return response()->json([
                'message'=> 'Role is assigned to the user',
            ]);
       
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
