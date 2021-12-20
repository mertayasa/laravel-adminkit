@extends('layouts.app')

@section('content')
<div class="container-fluid p-0">
    <h1 class="h3 mb-3">Pengumuman</h1>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Empty card</h5>
                </div>
                <div class="card-header d-flex justify-content-end">
                    <a href="{{ route('pengumuman.create') }}" class="btn btn-primary add" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Tambah Pengumuman"> <i class="fas fa-folder-plus"></i> Pengumuman Baru</a>
                </div>
                <div class="card-body">
                    <div class="card-header d-flex justify-content-between">
                        @include('pengumuman.datatable')
                </div>
                @foreach ($pengumuman as $data)
                    {{$data->konten}}
                @endforeach
                </div>
            </div>
        </div>
    </div>

</div>
@endsection