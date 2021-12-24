<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PasswordController extends Controller
{
    public function edit()
    {
        $user = Auth::user();
        $include_page = 'setting.password.edit';
        $page_title = 'Change Password';

        $data = [
            'user' => $user,
            'page_title' => $page_title,
            'include_page' => $include_page,
        ];

        return view('setting.index', $data);
    }
}
