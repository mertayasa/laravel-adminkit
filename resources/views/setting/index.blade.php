@extends('layouts.app')
@push('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('plugin/datatables/datatables.min.css') }}"/>
@endpush

@section('content')
<div class="container-fluid p-0">
    <h1 class="h3 mb-3">{{ $page_title }} 💂‍♂️</h1>
    <div class="row">
        <div class="col-md-3 col-xl-2">
            <div class="card">
                <div class="list-group list-group-flush" role="tablist">
                    <a class="list-group-item list-group-item-action {{ isActive('profile') }}" href="{{ route('setting.profile.index') }}">
                        Profile
                    </a>
                    <a class="list-group-item list-group-item-action {{ isActive('role') }}" href="{{ route('setting.role.index') }}">
                        Role
                    </a>
                    <a class="list-group-item list-group-item-action {{ isActive('permission') }}" href="{{ route('setting.permission.index') }}">
                        Permission
                    </a>
                </div>
            </div>
        </div>

        <div class="col-md-9 col-xl-10">
            <div class="tab-content">
                <div class="tab-pane fade active show" id="password" role="tabpanel">
                    @include($include_page)
                </div>
            </div>
        </div>

    </div>
</div>

@endsection

@push('scripts')
 
@endpush
