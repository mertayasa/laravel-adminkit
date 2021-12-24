@push('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('plugin/datatables/datatables.min.css') }}" />
@endpush

<div class="card">
    <div class="card-header text-right mb-0 pb-0">
        <a href="#" class="btn btn-primary"><i class="fas fa-folder-plus"></i> Create New</a>
    </div>
    
    <div class="card-body">
        {!! $dataTable->table(['width' => '100%']) !!}
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
                <button type="button" id="btnUpdatePermission" onclick="updatePermission(this)" data-url=""
                    class="btn btn-primary">Update</button>
            </div>
        </div>
    </div>
</div>

@push('scripts')
    <script type="text/javascript" src="{{ asset('plugin/datatables/datatables.min.js') }}"></script>
    {!! $dataTable->scripts() !!}
@endpush