<div class="row">
  <div class="col-md-12">
    <div class="card mb-4">
      <h5 class="card-header">Data Siswa</h5>
      <!-- /.box-header -->
      <div class="p-4">
        <table class="table table-hover table-striped " id="dataSiswa" style="width: 100%;">
          <thead>
            <!--<th>Aksi</th>-->
            <th>No.</th>
            <th>Nama</th>
            <th>NIS</th>
            <th>Kelas</th>
            <th>No. HP</th>
            <th>Alamat</th>
            <th>Agama</th>
            <th>TTL</th>
            <!-- <th>Tanggal Lahir</th> -->
            <th>Jenis Kelamin</th>
          </thead>
        </table>
      </div>
      <!-- /.box-body -->
    </div>
  </div>
</div>
<script>
  var tableSiswa;

  function reload_table() {
    tableSiswa.ajax.reload(null, false); //reload datatable ajax 
  }
  $(document).ready(function() {
    tableSiswa = $('#dataSiswa').DataTable({
      'responsive': true,
      "processing": true,
      "serverSide": true,
      "scrollX": true,
      "autoWidth": true,
      // "scrollY": "200px",
      "order": [],
      "ajax": {
        url: "<?= site_url('guru/DataSiswa/getSiswa') ?>",
      },
      buttons: [
        'excel'
      ],
      "columnDefs": [{
        "targets": 0,
        // "data": "download_link",
        // "render": function(data, type, row, meta) {
        //   return '<a href="' + data + '">Download</a>';
        // }
      }, {
        // "width": "10%",
        // "targets": 8
      }],
    });
  });
</script>