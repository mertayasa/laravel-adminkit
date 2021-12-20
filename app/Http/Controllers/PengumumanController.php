<?php

namespace App\Http\Controllers;

use App\Models\Pengumuman;
use App\Models\Kelas;
use Illuminate\Http\Request;
use App\DataTables\PengumumanDataTable;
use Exception;
use Illuminate\Support\Facades\Log;

class PengumumanController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Pengumuman $pengumuman)
    {
        $pengumuman = Pengumuman::all();
        // dd($pengumuman);
        return view('pengumuman.index', compact('pengumuman'));
    }

    public function datatable()
    {
        // Log::info($approval_status);
        $pengumuman = Pengumuman::all();
        return PengumumanDataTable::set($pengumuman);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pengumuman.create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $pengumuman = new Pengumuman;
            $pengumuman->judul = $request->judul;
            $pengumuman->deskripsi = $request->deskripsi;
            $pengumuman->konten = $request->konten;
            $pengumuman->lampiran = $request->lampiran;
            $pengumuman->status = 'aktif';

            // dd($pengumuman);
            $pengumuman->save();
        } catch (Exception $e) {
            Log::info($e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Data Pengumumann Gagal Ditambahkan');
        }

        return redirect('pengumuman')->with('info', 'Data Pengumumann Berhasil Ditambahkan & Menunggu Verifikasi');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Pengumuman  $pengumuman
     * @return \Illuminate\Http\Response
     */
    public function show(Pengumuman $pengumuman)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Pengumuman  $pengumuman
     * @return \Illuminate\Http\Response
     */
    public function edit(Pengumuman $pengumuman)
    {
        return view('pengumuman.edit', compact('pengumuman'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Pengumuman  $pengumuman
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        try {
            $update = Pengumuman::find($id);
            $update->title = $request->title;
            $update->description = $request->description;
            $update->approval_status = 0;

            $update->save();
        } catch (Exception $e) {
            Log::info($e->getMessage());
            return redirect()->back()->withInput()->with('error', 'Data Pengumuman Gagal Di Edit');
        }

        return redirect('pengumuman')->with('info', 'Data Pengumuman Berhasil Diedit  & Menunggu Verifikasi');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Pengumuman  $pengumuman
     * @return \Illuminate\Http\Response
     */
    public function destroy(Pengumuman $pengumuman)
    {
        try {
            $pengumuman->delete();
        } catch (Exception $e) {
            Log::info($e->getMessage());
            return response(['code' => 0, 'message' => 'Gagal menghapus data pengumuman']);
        }

        return response(['code' => 1, 'message' => 'Berhasil menghapus data pengumuman']);
    }
}
