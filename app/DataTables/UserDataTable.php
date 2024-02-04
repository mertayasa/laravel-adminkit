<?php

namespace App\DataTables;

use App\Models\User;
use Yajra\DataTables\Html\Button;
use Yajra\DataTables\Html\Column;
use Yajra\DataTables\Html\Editor\Editor;
use Yajra\DataTables\Html\Editor\Fields;
use Yajra\DataTables\Services\DataTable;

class UserDataTable extends DataTable
{
    /**
     * Build DataTable class.
     *
     * @param mixed $query Results from query() method.
     * @return \Yajra\DataTables\DataTableAbstract
     */
    public function dataTable($query)
    {
        return datatables()
            ->eloquent($query)
            ->editColumn('jabatan', function ($user){
                return $user->userjabatan()->get()->pluck('nama_jabatan')->implode(', ');
            })
            ->addColumn('action', 'user.datatable-action')
            ->rawColumns(['action']);
    }

    /**
     * Get query source of dataTable.
     *
     * @param \App\Models\UserDataTable $model
     * @return \Illuminate\Database\Eloquent\Builder
     */
    public function query(User $model)
    {
        return $model->with('unit')->with('userjabatan')->role(User::$karyawan)->newQuery();
    }

    /**
     * Optional method if you want to use html builder.
     *
     * @return \Yajra\DataTables\Html\Builder
     */
    public function html()
    {
        return $this->builder()
                    ->setTableId('userDatatable')
                    ->columns($this->getColumns())
                    ->addAction(['title' => 'Action', 'width' => '150px', 'printable' => false, 'responsivePriority' => '100', 'id' => 'actionColumn'])
                    ->minifiedAjax()
                    ->dom('Bfrtip')
                    ->orderBy(1, 'DESC');
    }

    /**
     * Get columns.
     *
     * @return array
     */
    protected function getColumns()
    {
        return [
            [
                'data' => 'updated_at',
                'visible' => false,
                'searchable' => true
            ],
            [
                'name' => 'nama',
                'data' => 'nama',
                'title' => 'Nama',
            ],
            [
                'username' => 'username',
                'data' => 'username',
                'title' => 'Username',
            ],
            [
                'name' => 'unit.nama',
                'data' => 'unit.nama',
                'title' => 'Unit',
            ],
            [
                'name' => 'jabatan',
                'data' => 'jabatan',
                'title' => 'Jabatan',
            ],
            [
                'name' => 'tanggal_bergabung',
                'data' => 'tanggal_bergabung',
                'title' => 'Tanggal Bergabung',
            ]
        ];
    }

    /**
     * Get filename for export.
     *
     * @return string
     */
    protected function filename()
    {
        return 'User_' . date('YmdHis');
    }
}
