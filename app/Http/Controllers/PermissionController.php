<?php

namespace App\Http\Controllers;

use App\DataTables\PermissionDataTable;
use App\Models\Permission;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;
use App\Models\Role;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Route;

class PermissionController extends Controller
{
    public function index(PermissionDataTable $permissionDataTable)
    {
        $include_page = 'setting.permission.datatable';
        $page_title = 'Permission';

        $data = [
            'include_page' => $include_page,
            'page_title' => $page_title,
        ];
        return $permissionDataTable->render('setting.index', $data);
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
            return response(['code' => 0, 'message' => 'Unable to update permission']);
        }
        return response(['code' => 1, 'message' => 'Permission updated']);
    }

    public function refresh()
    {
        try{
            Artisan::call('db:seed --class="PermissionSeeder"');
        }catch(Exception $e){
            Log::info($e->getMessage());
            return redirect()->back()->with('error', 'Unable to refresh permissions');
        }

        return redirect()->back()->with('success', 'Permission refreshed successfully');
    }

    public function refreshAndAssign()
    {
        try{
            Artisan::call('db:seed --class="PermissionSeeder"');
            Artisan::call('db:seed --class="RoleHasPermissionSeeder"');
        }catch(Exception $e){
            Log::info($e->getMessage());
            return redirect()->back()->with('error', 'Unable to refresh and assign permissions');
        }

        return redirect()->back()->with('success', 'Permission refreshed and assigned successfully');
    }

    public function update(Request $request, Permission $permission)
    {
        try{
            $permission->update($request->all());
        }catch(Exception $e){
            Log::info($e->getMessage());
            return response(['code' => 0, 'message' => 'Unable to update permission']);
        }

        return response(['code' => 1, 'message' => 'Permission updated successfully']);
    }

    public function destroy(Permission $permission)
    {
        try{
            if(Route::has($permission->name)){
                return response(['code' => 0, 'message' => 'Route Exists and can not be deleted']);
            }

            $permission->delete();
        }catch(Exception $e){
            Log::info($e->getMessage());
            return response(['code' => 0, 'message' => 'Unable to delete permission']);
        }

        return response(['code' => 1, 'message' => 'Permission deleted successfully']);
    }
}
