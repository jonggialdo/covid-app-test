<div class="card-body table-responsive">
    <table id="data_table" class="hover:table-auto dataTable">
        <thead>
        <tr>
            <th>Nama RS</th>
            <th>Kode RS</th>
            <th>Tempat Tidur</th>
            <th>No Telepon</th>
            <th>Alamat</th>
            <th>Wilayah</th>
            <th>Lokasi</th>
        </tr>
        </thead>
    </table>
</div>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/jquery.dataTables.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>
<script src="https://cdn.datatables.net/1.10.21/js/dataTables.bootstrap4.min.js"></script>
<script type="text/javascript">
  $(function () {

    var table = $('#data_table').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('datatables.data') }}",
        columns: [
            {data: 'nama'},
            {data: 'kode_rs'},
            {data: 'tempat_tidur'},
            {data: 'telepon'},
            {data: 'alamat'},
            {data: 'wilayah'},
            {
                data: 'coordinate',
                orderable: false,
                searchable: false,
                render : function ( data, type, row ) {
                    return '<a class="btn btn-primary" href="http://maps.google.co.uk/maps?q='+data+'" target=”_blank”>GMap!</a>';
                }
            },
        ]
    });


  });
</script>
