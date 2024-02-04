<?php

namespace App\Http\Controllers;

use App\DataTables\UserDataTable;
use App\Http\Requests\UserRequest;
use App\Models\Jabatan;
use App\Models\Unit;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserController extends Controller{

    public function index(UserDataTable $userDataTable){
        return $userDataTable->render('user.index');
    }
    
    public function create(){
        $jabatan = Jabatan::pluck('nama', 'id');
        $unit = Unit::pluck('nama', 'id');

        $data = [
            'jabatan' => $jabatan,
            'unit' => $unit
        ];

        return view('user.create', $data);
    }

    public function store(UserRequest $request){
        try{
            User::create($request->validated());
        }catch(Exception $e){
            Log::info($e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Gagal menambahkan data pengguna');
        }

        return redirect()->route('user.index')->with('success', 'Berhasil menambahkan data pengguna');
    }

    public function edit(User $user){
        $jabatan = Jabatan::pluck('nama', 'id');
        $unit = Unit::pluck('nama', 'id');

        $data = [
            'user' => $user,
            'jabatan' => $jabatan,
            'unit' => $unit
        ];

        return view('user.create', $data);
    }

    public function update(UserRequest $request, User $user){
        try{
            $data = $request->all();

            if($data['password']){
                $data['password'] = bcrypt($data['password']);
            }else{
                unset($data['password']);
            }

            $user->update($data);
        }catch(Exception $e){
            Log::info($e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Gagal mengubah profile karyawan');
        }

        return redirect()->route('user.index')->with('success','Profile karyawan berhasil diubah!');
    }

    public function destroy(User $user){
        try{
            $user->delete();
        }catch(Exception $e){
            Log::info($e->getMessage());
            return response(['code' => 0, 'message' => 'Gagal menghapus profile karyawan']);
        }

        return response(['code' => 1, 'message' => 'Berhasil menghapus profile karyawan']);
    }
}
