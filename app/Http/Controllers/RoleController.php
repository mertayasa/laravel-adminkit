<?php

namespace App\Http\Controllers;

use App\DataTables\RoleDataTable;
use Illuminate\Http\Request;

class RoleController extends Controller
{
    public function index(RoleDataTable $roleDataTable)
    {
        $include_page = 'setting.role.datatable';
        $page_title = 'Role';

        $data = [
            'include_page' => $include_page,
            'page_title' => $page_title,
        ];
        return $roleDataTable->render('setting.index', $data);
    }
}
