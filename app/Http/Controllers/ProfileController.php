<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class ProfileController extends Controller
{
    public function index()
    {
        $user = Auth::user();
        $include_page = 'setting.profile.edit';
        $page_title = 'Profile';

        $data = [
            'user' => $user,
            'page_title' => $page_title,
            'include_page' => $include_page,
        ];

        return view('setting.index', $data);
    }
}
