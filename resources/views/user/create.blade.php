@extends('layouts.app')
@section('content')
<div class="container-fluid p-0">
    <h1 class="h3 mb-3">User</h1>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h5 class="card-title mb-0">Create User</h5>
                </div>
                <div class="card-body">
                    @include('layouts.flash')
                    {!! Form::open(['route' => 'user.store', 'enctype' => 'multipart/form-data']) !!}
                        @include('user.form')

                        <div class="mt-3">
                            <a href="{{ route('user.index') }}" class="btn btn-sm btn-danger">Cancel</a>
                            <button class="btn btn-sm btn-primary" type="submit">Save</button>
                        </div>
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>

</div>
@endsection