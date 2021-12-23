<?php

namespace App\Http\Controllers;

use App\DataTables\PermissionDataTable;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Role;

class PermissionController extends Controller
{
    public function index(PermissionDataTable $permissionDataTable)
    {
        return $permissionDataTable->render('permission.index');
    }

    public function assignRevoke(Request $request)
    {
        try{
            $role = Role::find($request->role_id);
            if($role->hasPermissionTo($request->permission)){
                $role->revokePermissionTo($request->permission);
            }else{
                $role->givePermissionTo($request->permission);
            }
        }catch(Exception $e){
            Log::info($e->getMessage());
            return response(['code' => 0, 'toast_message' => 'Unable to update permission']);
        }
        return response(['code' => 1, 'toast_message' => 'Permission updated']);
    }
}
