<?php

namespace App\DataTables;

use Yajra\DataTables\DataTables;

class KelasDataTable
{

    static public function set($kelas)
    {
        // 
        return Datatables::of($kelas)

            ->addColumn('action', function ($kelas) {
                $deleteUrl = "'" . route('kelas.destroy', $kelas->id) . "', 'kelasDatatable'";
                return
                    '<div class="btn-group">' .
                    '<a href="' . route('kelas.edit', $kelas->id) . '" class="btn btn-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit" style="margin-right: 5px" ><i class="menu-icon fa fa-pencil-alt"></i></a>' .
                    '<a href="#" onclick="deleteModel(' . $deleteUrl . ',)" class="btn btn-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit" style="margin-right: 5px"><i class="menu-icon fa fa-trash"></i></a>' .

                    '</div>';
            })->addIndexColumn()->rawColumns(['action'])->make(true);
    }
}
