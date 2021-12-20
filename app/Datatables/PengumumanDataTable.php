<?php

namespace App\DataTables;

use Illuminate\Support\Facades\Cache;
use Yajra\DataTables\DataTables;

class PengumumanDataTable
{

    // 
    static public function set($pengumuman)
    {
        return Datatables::of($pengumuman)
            ->addColumn('action', function ($pengumuman) {
                $deleteUrl = "'" . route('pengumuman.destroy', $pengumuman->id) . "', 'pengumumanDataTable'";

                return
                    '<div class="btn-group">' .
                    '<a href="' . route('pengumuman.edit', $pengumuman->id) . '" class="btn btn-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit" style="margin-right: 5px" ><i class="menu-icon fa fa-pencil-alt"></i></a>' .
                    '<a href="#" onclick="deleteModel(' . $deleteUrl . ',)" class="btn btn-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hapus" style="margin-right: 5px"><i class="menu-icon fa fa-trash"></i></a>' .
                    '</div>';
            })->addIndexColumn()->rawColumns(['action'])->make(true);
    }
}
