<?php

namespace App\Http\Controllers;

use App\Http\Requests\UpdateProfileRequest;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Log;

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

    public function update(UpdateProfileRequest $request)
    {
        $user = Auth::user();
        $data = $request->validated();

        Log::info($data);

        try{
            if(isset($data['password'])){
                $data['password'] = bcrypt($data['password']);
            }else{
                unset($data['password']);
            }
    
            $user->update($data);
        }catch(Exception $e){
            Log::error($e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Gagal mengubah data pengguna');
        }


        return redirect()->route('setting.profile.index')->with('success', 'Berhasil mengubah data profile');
    }
}
