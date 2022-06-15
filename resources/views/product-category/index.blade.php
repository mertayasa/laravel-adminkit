@extends('layouts.app')
@push('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('plugin/datatables/datatables.min.css') }}" />
@endpush

@section('content')
<div class="container-fluid p-0">
    <h1 class="h3 mb-3">Blank Page</h1>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <div class="row">
                        <div class="col-6">
                            <h5 class="card-title mb-0">Product Category</h5>
                        </div>
                        <div class="col-6 text-right">
                            <a href="{{ route('product-category.create') }}" class="btn btn-sm btn-primary">Add new</a>
                        </div>
                    </div>
                </div>
                <div class="card-body">
                    @include('layouts.flash')
                    {!! $dataTable->table(['width' => '100%']) !!}
                </div>
            </div>
        </div>
    </div>

</div>
@endsection

@push('scripts')
    <script type="text/javascript" src="{{ asset('plugin/datatables/datatables.min.js') }}"></script>
    {!! $dataTable->scripts() !!}
@endpush