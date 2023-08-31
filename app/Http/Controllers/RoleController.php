<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Validator;
use Spatie\Permission\Models\Role;

class RoleController extends Controller
{

    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $roles = Role::with('permissions')->whereNotIn('name', ['admin'])->orderBy('name')->get();
        return $this->showAll($roles);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
       $data = $request->all();

        $validator = Validator::make($data, [
            'name' => 'required|string',
            'permissions' => 'required|array',
            'permissions.*' => 'string|exists:permissions,name',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        return DB::transaction(function() use ($data) {
        try{
            $role = Role::create(['name' => $data['name']]);
            $role->givePermissionTo($data['permissions']);

            return response()->json(['status' => false, 'message' => 'Role created'], 201);
                
        } catch (\Exception $ex) {
            DB::rollback();
            // throw $ex;
            return response()->json(['status' => false, 'message' => 'something went wrong registro role'.$ex], 400);
        }
    });
    }
    
    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\User  $idRole
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $idRole)
    {
        $role = Role::findOrFail($idRole);

        $data = $request->all();

        $validator = Validator::make($data, [
            'name' => 'required|string',
            'permissions' => 'required|array',
            'permissions.*' => 'string|exists:permissions,name',
        ]);

        if ($validator->fails()) {
            return response()->json($validator->errors(), 400);
        }

        return DB::transaction(function() use ($data, $role) {
            try{
                $role->name = $data['name'];

                $role->syncPermissions($data['permissions']);

                $role->update();
                return response()->json(['status' => true, 'message' => 'Role updated'], 200);
                    
            } catch (\Exception $ex) {
                DB::rollback();
                // throw $ex;
                return response()->json(['status' => false, 'message' => 'something went wrong registro role'.$ex], 400);
            }
        });
    }

       /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Role  $role_id
     * @return \Illuminate\Http\Response
     */
    public function destroy($role_id)
    {
        $role = Role::findOrFail($role_id);


        if($role){
            $users = User::get();

            $usersFound = $users->filter(function($user) use ($role){
                if($user->hasAnyRole([$role->name])){
                    return $user;
                }
            })->values();

            if(count($usersFound) > 0){
                return response()->json([
                    'status' => false, 
                    'message' => 'The are users with this role assigned',
                    'usersFound' => $usersFound
                ], 422);
            }
            $role->syncPermissions([]);
            
            $role->delete();
            
            
            return response()->json([
                'status' => true, 
                'message' => 'Rol deleted successfully'
            ], 200);


        }


    }
}
