<?php

namespace App\Http\Controllers;

use App\DataTables\UserDataTable;
use App\Http\Requests\UserRequest;
use App\Models\User;
use Exception;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Log;

class UserController extends Controller{

    public function index(){
        return view('user.index');
    }

    public function datatable(){
        $users = User::all();

        return UserDataTable::set($users);
    }

    public function create(){
        $levels = [User::$staff => User::$staff, User::$admin => User::$admin, User::$kades => User::$kades];

        return view('user.create', compact('levels'));
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
        $levels = [User::$staff => User::$staff, User::$admin => User::$admin, User::$kades => User::$kades];

        return view('user.edit', compact('user', 'levels'));
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

            // $base_64_foto = json_decode($request['foto'], true);
            // $upload_image = uploadFile($base_64_foto);

            // if($upload_image == 0){
            //     return redirect()->back()->withInput()->with('error', 'Gagal mengupload gambar!');
            // }

            // $data['foto'] = $upload_image;

        }catch(Exception $e){
            Log::info($e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Gagal mengubah profile pengguna');
        }

        return redirect()->route('user.index')->with('success','Profile pengguna berhasil diubah!');
    }

    public function destroy(User $user){
        try{
            $user->delete();
        }catch(Exception $e){
            Log::info($e->getMessage());
            return response(['code' => 0, 'message' => 'Gagal menghapus user']);
        }

        return response(['code' => 1, 'message' => 'Berhasil menghapus user']);
    }
}
