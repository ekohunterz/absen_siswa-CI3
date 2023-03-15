<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="row">
        <div class="col">
          <h5 class="card-header">Data Siswa</h5>
        </div>
        <div class="col">
          <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-3 me-4">
            <button type="button" id="tambahsiswa" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCenter"><i class="bx bx-plus-circle"></i> Tambah Siswa</button>
          </div>
        </div>
      </div>
      <!-- /.box-header -->

      <div class="p-4">

        <table class="table table-hover table-striped" id="dataSiswa" style="width: 100%;">
          <thead>
            <!--<th>Aksi</th>-->
            <th>No.</th>
            <th>Kelas</th>
            <th>NIS</th>
            <th>Nama</th>
            <th>No. HP</th>
            <th>Alamat</th>
            <th>Agama</th>
            <!-- <th>Tempat Lahir</th> -->
            <th>TTL</th>
            <th>Jenis Kelamin</th>
            <th>Aksi</th>
          </thead>
        </table>
      </div>
      <!-- /.box-body -->
    </div>
  </div>
</div>

<!--Modal Insert -->
<div class="col-lg-4 col-md-6">
  <div class="mt-3">
    <!-- Modal -->
    <div class="modal fade" id="modalCenter" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalCenterTitle">Tambah Siswa</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="" method="post" id="form-siswa">
            <div class="modal-body">
              <div id="tambah"></div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                Close
              </button>
              <button type="button" id="save" class="btn btn-primary" data-bs-dismiss="modal">Simpan</button>
            </div>
        </div>
        </form>
      </div>
    </div>
  </div>
</div>

<!--Modal Edit -->
<div class="col-lg-4 col-md-6">
  <div class="mt-3">
    <!-- Modal -->
    <div class="modal fade" id="modalUpdate" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalCenterTitle">Edit Siswa</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="" method="post" id="edit-siswa">
            <div class="modal-body">
              <div id="modal_edit"></div>
            </div>
            <div class="modal-footer">
              <button type="button" class="btn btn-outline-secondary" data-bs-dismiss="modal">
                Close
              </button>
              <button type="button" id="update" class="btn btn-primary" data-bs-dismiss="modal">Simpan</button>
            </div>
        </div>
        </form>
      </div>
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

      "processing": true,
      "serverSide": true,
      "scrollX": true,
      "autoWidth": true,
      // "scrollY": "200px",
      "order": [],
      "ajax": {
        url: "<?= site_url('admin/DataSiswa/getSiswa') ?>",
      },
      //dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>tr<"row mt-3"<"col-sm-8 col-md-5"i><"col-sm-6 col-md-3"B><"col-sm-6 col-md-4"p>>',
      buttons: ['excel', 'pdf'],
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

  function hapusSiswa(id) {
    swal.fire({
        title: "Yakin hapus Siswa?",
        text: "Jika sudah terhapus maka, tidak dapat dikembalikan!",
        icon: "warning",
        showCancelButton: true,
        confirmButtonColor: '#3085d6',
        cancelButtonColor: '#d33',
        confirmButtonText: 'Ya, hapus!'
      })
      .then((result) => {
        if (result.isConfirmed) {
          $.ajax({
            url: "<?= site_url('admin/DataSiswa/hapusSiswa/') ?>" + id,
            type: "post",
            dataType: "json",
            success: function(data) {
              swal.fire("Sukses", "Satu Siswa telah dihapus!", {
                icon: "success",
              });
              reload_table();
            }
          });
        } else {
          swal.fire("Batal", "Satu Siswa batal dihapus!", "error");
        }
      });
  }
</script>
<script>
  function editSiswa(id_siswa) {
    $("#dataSiswa").on('click', '.btn-edit', function(e) {
      e.preventDefault();
      var id = $(e.currentTarget).attr('data-id');
      if (id === '') return;
      $.ajax({
        type: "POST",
        url: "<?= site_url('admin/DataSiswa/siswa_edit/'); ?>" + id_siswa,
        data: {
          id: id
        },
        success: function(data) {
          swal.close();
          $('#modalUpdate').modal('show');
          $('#modal_edit').html(data);
        },
        error: function() {
          swal.fire("Preview Siswa Gagal", "Ada Kesalahan Saat menampilkan data siswa!", "error");
        }
      });
    });
  }
</script>
<script>
  $("#tambahsiswa").on('click', function(e) {
    e.preventDefault();
    $.ajax({
      type: "POST",
      url: "<?= site_url('admin/DataSiswa/tambah_siswa'); ?>",
      success: function(data) {
        $('#modalCenter').modal('show');
        $('#tambah').html(data);
      }
    });
  });
</script>