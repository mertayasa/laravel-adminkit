<div class="form-group">
    <a href="#" class="btn btn-warning" data-bs-toggle="modal" data-bs-target="#permissionModal" onclick="editPermission(this)" data-alias="{{ $alias }}" data-id="{{ $id }}" data-url="{{ route('permission.update', $id) }}" data-bs-placement="bottom" title="Edit" ><i class="menu-icon fa fa-pencil-alt"></i></a>
    {{-- <a href="{{ route('permission.edit', $id) }}" class="btn btn-warning" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Edit" ><i class="menu-icon fa fa-pencil-alt"></i></a> --}}
    <a href="#" onclick="deleteModel(' . $deleteUrl . ',)" class="btn btn-danger" data-bs-toggle="tooltip" data-bs-placement="bottom" title="Hapus"><i class="menu-icon fa fa-trash"></i></a>
</div>