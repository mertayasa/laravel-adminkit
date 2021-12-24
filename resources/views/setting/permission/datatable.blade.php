@push('styles')
    <link rel="stylesheet" type="text/css" href="{{ asset('plugin/datatables/datatables.min.css') }}" />
@endpush

<div class="card">
    <div class="card-header text-right mb-0 pb-0">
        <a href="{{ route('setting.permission.refresh') }}" class="btn btn-primary"><i class="fas fa-sync"></i> Refresh Permission</a>
        <a href="{{ route('setting.permission.refresh_and_assign') }}" class="btn btn-danger"><i class="fas fa-magic"></i> Refresh & Assign All Permission To Admin</a>
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

    <script>
        function initCheckbox() {
            const checkBox = document.querySelectorAll('input[type="checkbox"].permission')

            for (let i = 0; i < checkBox.length; i++) {
                const roleName = checkBox[i].getAttribute('data-role-name')
                const roleId = checkBox[i].getAttribute('data-role-id')
                const permission = JSON.parse(checkBox[i].getAttribute('data-permission'))
                if (permission.roles.indexOf(roleName) > -1) {
                    checkBox[i].checked = true
                }

                checkBox[i].addEventListener('click', target => {
                    updateRolePermission(roleId, permission.permission)
                })
            }
        }

        $("#permissionDatatable").on('draw.dt', function() {
            initCheckbox();
        });

        function updateRolePermission(roleId, permission) {
            const url = "{{ route('setting.permission.assign_revoke') }}"
            const formData = new FormData()
            formData.append('role_id', roleId)
            formData.append('permission', permission)

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
                })
                .catch((error) => {
                    showToast(0, 'Something went wrong')
                });
        }

        function showToast(code, text) {
            if (code == 1) {
                toastr.success(text)
            }
            if (code == 0) {
                toastr.error(text)
            }
        }
    </script>

    <script>
        const permissionAlias = document.getElementById('permissionAlias')
        const permissionId = document.getElementById('permissionId')
        const btnUpdatePermission = document.getElementById('btnUpdatePermission')

        function editPermission(permission) {
            const alias = permission.getAttribute('data-alias')
            const id = permission.getAttribute('data-id')
            const url = permission.getAttribute('data-url')

            permissionAlias.value = alias
            permissionId.value = id
            btnUpdatePermission.setAttribute('data-url', url)
        }

        function updatePermission() {
            if (permissionAlias.value == null || permissionAlias.value == undefined || permissionAlias.value == '') {
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
                    if (data.code == 1) {
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
