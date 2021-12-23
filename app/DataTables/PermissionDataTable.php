<?php

namespace App\DataTables;

use App\Models\Permission;
use App\Models\Role;
use Yajra\DataTables\Services\DataTable;
use Illuminate\Support\Str;
use Yajra\DataTables\EloquentDataTable;

class PermissionDataTable extends DataTable
{
    public function dataTable($query){
        $dataTable = new EloquentDataTable($query);

        return $dataTable
            ->editColumn('class',function ($permission){
                $raw = explode('.',$permission->name)[0];
                $replace_underscore = str_replace('_', ' ', $raw);
                return Str::title($replace_underscore);
            })
            ->editColumn('roles', function ($permission) {
                return json_encode(['permissionId' => $permission->id, 'permission' => $permission->name, 'roles' => $permission->roles->pluck('name')->toArray()]);
            })
            ->addColumn('action', 'permission.datatables_actions');
    }

    public function query(Permission $model){
        return $model->newQuery()->with('roles');
    }

    public function html(){
        return $this->builder()
                    ->searching(false)
                    ->setTableId('permissionDatatable')
                    ->columns($this->getColumns())
                    ->addAction(['title' => 'Aksi', 'width' => '150px', 'printable' => false, 'responsivePriority' => '100', 'id' => 'actionColumn'])
                    ->minifiedAjax()
                    ->orderBy(0, 'DESC')
                    ->parameters([
                        'rowGroup'=> [
                            'dataSrc' => ['class'],
                        ],
                    ]);
    }

    protected function getColumns(){
        $columns = [
            [
                'data' => 'name',
                'visible' => false,
                'searchable' => true
            ],
            [
                'data' => 'alias',
                'title' => 'Permission',
                'searchable' => true
            ],
            [
                'data' => 'name',
                'title' => 'Route Name',
                'searchable' => true
            ],
            [
                'data' => 'class',
                'title' => 'model_id',
                'visible' => false,
                'className' => "hide",
                'searchable' => false,
                'printable' => false,
                'exportable' => false,
            ],
        ];

        $roles = Role::select('id', 'name')->get();
        foreach ($roles as $role) {
            $newColumn['data'] = 'roles';
            $newColumn['title'] = str_replace('-', ' ', ucfirst($role->name));
            $newColumn['searchable'] = false;
            $newColumn['exportable'] = false;
            $newColumn['orderable'] = false;
            $newColumn['printable'] = false;
            $newColumn['render'] = 'function(){return "<div class=\'checkbox icheck\'><label><input  type=\'checkbox\' name=\'namehere\' class=\'permission\' data-role-name=\'' . $role->name . '\' data-role-id=\'' . $role->id . '\' data-permission=\'"+data+"\'></label></div>"}';
            $columns[] = $newColumn;
        }

        return $columns;
    }
}
