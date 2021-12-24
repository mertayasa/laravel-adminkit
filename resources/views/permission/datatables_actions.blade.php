<div class="form-group">
    <a href="#" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#permissionModal" onclick="editPermission(this)" data-alias="{{ $alias }}" data-id="{{ $id }}" data-url="{{ route('permission.update', $id) }}" data-bs-placement="bottom" title="Edit" ><i class="menu-icon fa fa-pencil-alt"></i></a>
    {{-- <a href="{{ route('permission.edit', $id) }}" class="btn btn-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit" ><i class="menu-icon fa fa-pencil-alt"></i></a> --}}
    @if (!Route::has($name))
        <a href="#" onclick="deleteModel('{{ route('permission.destroy', $id) }}', 'permissionDatatable', 'permission', 'all user will unable to access route {{ $name }} again, data could be restored by clicking refresh permission')" class="btn btn-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hapus"><i class="menu-icon fa fa-trash"></i></a>
    @endif
</div>