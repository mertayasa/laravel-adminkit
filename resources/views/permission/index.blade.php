@extends('layouts.app')
@push('styles')
    <link rel="stylesheet" type="text/css" href="plugin/datatables/datatables.min.css"/>
@endpush

@section('content')
<div class="container-fluid p-0">
    <h1 class="h3 mb-3">Blank Page</h1>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Empty card</h5>
                </div>
                <div class="card-body">
                    @include('permission.datatable')
                </div>
            </div>
        </div>
    </div>
</div>
@endsection