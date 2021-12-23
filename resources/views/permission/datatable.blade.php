{!! $dataTable->table(['width' => '100%']) !!}

@push('scripts')
    <script type="text/javascript" src="plugin/datatables/datatables.min.js"></script>
    {!! $dataTable->scripts() !!}

    <script>
        window.addEventListener("load", function(){
            initCheckbox()
        })

        function initCheckbox(){
            const checkBox = document.querySelectorAll('input[type="checkbox"].permission')
            for(let i=0; i<checkBox.length; i++){
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

        function updateRolePermission(roleId, permission){
            const url = "{{ route('permission.assign_revoke') }}"
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
@endpush