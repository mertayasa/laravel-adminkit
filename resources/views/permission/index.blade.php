@extends('layouts.app')
@push('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('plugin/datatables/datatables.min.css') }}"/>
@endpush

@section('content')
<div class="container-fluid p-0">
    <h1 class="h3 mb-3">Permission 💂‍♂️</h1>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header text-right mb-0 pb-0">
                    <a href="{{ route('permission.refresh') }}" class="btn btn-primary"><i class="fas fa-sync"></i> Refresh Permission</a>
                    <a href="{{ route('permission.refresh_and_assign') }}" class="btn btn-danger"><i class="fas fa-magic"></i> Refresh & Assign All Permission To Admin</a>
                </div>
                <div class="card-body">
                    @include('permission.datatable')
                </div>
            </div>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="permissionModal" tabindex="-1" aria-labelledby="permissionModalLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content">
        <div class="modal-header">
            <h5 class="modal-title" id="permissionModalLabel">Edit Permission</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
        </div>
        <div class="modal-body">
            {!! Form::hidden('id', null, ['id' => 'permissionId']) !!}
            {!! Form::label('permissionAlias', 'Alias', []) !!}
            {!! Form::text('alias', null, ['class' => 'form-control', 'id' => 'permissionAlias']) !!}
        </div>
        <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
            <button type="button" id="btnUpdatePermission" onclick="updatePermission(this)" data-url="" class="btn btn-primary">Update</button>
        </div>
        </div>
    </div>
</div>

@endsection

@push('scripts')
    <script>
        const permissionAlias = document.getElementById('permissionAlias')
        const permissionId = document.getElementById('permissionId')
        const btnUpdatePermission = document.getElementById('btnUpdatePermission')
        
        function editPermission(permission){
            const alias = permission.getAttribute('data-alias')
            const id = permission.getAttribute('data-id')
            const url = permission.getAttribute('data-url')

            permissionAlias.value = alias
            permissionId.value = id
            btnUpdatePermission.setAttribute('data-url', url)
        }

        function updatePermission(){
            if(permissionAlias.value == null || permissionAlias.value == undefined || permissionAlias.value == ''){
                return showToast(0, 'Alias could not be empty')
            }

            const url = btnUpdatePermission.getAttribute('data-url') + '?_method=PATCH'
            const formData = new FormData()
            formData.append('permission_id', permissionId.value)
            formData.append('alias', permissionAlias.value)
            formData.append('_method', 'PATCH')

            fetch(url, {
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content'),
                },
                method: 'POST',
                body: formData,
            })
            .then(response => response.json())
            .then(data => {
                showToast(data.code, data.message)
                if(data.code == 1){
                    $('table').DataTable().ajax.reload()
                    setTimeout(() => {
                        initCheckbox()
                    }, 500);
                }
            })
            .catch((error) => {
                showToast(0, 'Something went wrong')
            });
        }
    </script>    
@endpush
