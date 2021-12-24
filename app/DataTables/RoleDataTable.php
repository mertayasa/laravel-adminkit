<?php

namespace App\DataTables;

use App\Models\Role;
use Yajra\DataTables\Services\DataTable;

class RoleDataTable extends DataTable
{
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->addColumn('action', 'setting.role.datatable_actions');
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\RoleDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(Role $model)
    {
        return $model->newQuery();
    }

    public function html()
    {
        return $this->builder()
                    ->setTableId('roleDatatable')
                    ->columns($this->getColumns())
                    ->addAction(['title' => 'Aksi', 'width' => '150px', 'printable' => false, 'responsivePriority' => '100', 'id' => 'actionColumn'])
                    ->minifiedAjax()
                    ->orderBy(1, 'DESC');
    }

    protected function getColumns()
    {
        return [
            [
                'data' => 'name',
                'title' => 'Role',
                'searchable' => true
            ],
            [
                'data' => 'updated_at',
                'visible' => false,
                'searchable' => true
            ],
        ];
    }
}
