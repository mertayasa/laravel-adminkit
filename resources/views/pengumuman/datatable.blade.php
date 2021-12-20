<table class="table table-hover table-striped" width="100%" id="PengumumanDataTable">
    <thead>
        <tr>
        <th>No</th>
        <th></th>
        <th>Tanggal Publish</th>
        <th>Perihal</th>
        <th>Keterangan</th>
        </tr>
    </thead>
    <tbody></tbody>
</table>

@push('scripts')

<script>

    let table
    let url = "{{ route('pengumuman.datatable') }}"

    datatable(url)
    function datatable (url){

        table = $('#PengumumanDataTable').DataTable({
            processing: true,
            serverSide: true,
            responsive: true,
            ajax: url,
            columns: [ 
                {
                    data: 'DT_RowIndex',
                    name: 'no',
                    orderable: false,
                    searchable: false
                },
                {
                    data: 'updated_at', 
                    name: 'updated_at'
                },
                {
                    data: 'judul', 
                    name: 'judul'
                },
                {
                    data: 'deskripsi', 
                    name: 'deskripsi'
                },
                {
                    data: 'konten', 
                    name: 'konten'
                },
                {
                    data: 'lampiran', 
                    name: 'lampiran'
                }
            ],
            order: [[ 1, "DESC" ]],
            columnDefs: [
                // { width: 300, targets: 1 },
                {
                    targets:  '_all',
                    className: 'align-middle'
                },
                {
                    responsivePriority: 1, targets: 1
                },
            ],
            language: {
                search: "",
                searchPlaceholder: "Cari"
            },
        });
    }

</script>

@endpush
