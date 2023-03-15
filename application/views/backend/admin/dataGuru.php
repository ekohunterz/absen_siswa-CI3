<div class="row">
  <div class="col-md-12">
    <div div class="card">

      <div class="row">
        <div class="col">
          <h5 class="card-header">Data Guru</h5>
        </div>
        <div class="col">
          <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-3 me-4">
            <button type="button" id="tambahguru" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCenter"><i class="bx bx-plus-circle"></i> Tambah Guru</button>
          </div>
        </div>
      </div>
      <!-- /.box-header -->
      <div class="p-4">
        <table class="table table-hover table-striped " id="guru" style="width: 100%;">
          <thead>
            <!--<th>Aksi</th>-->
            <th>No.</th>
            <!--<th>Username</th>-->
            <th>NIP</th>
            <th>Nama</th>
            <th>No.HP</th>
            <th>Alamat</th>
            <th>Agama</th>
            <th>TTL</th>
            <th>Jenis Kelamin</th>
            <th>Status</th>
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
            <h5 class="modal-title" id="modalCenterTitle">Tambah Guru</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="" method="post" id="form-guru">
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
            <h5 class="modal-title" id="modalCenterTitle">Edit Guru</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="" method="post" id="edit-guru">
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
  var tableGuru;

  function reload_table() {
    tableGuru.ajax.reload(null, false); //reload datatable ajax 
  }

  $(function() {
    tableGuru = $('#guru').DataTable({
      "processing": true,
      "serverSide": true,
      "scrollX": true,
      // "scrollY": "200px",
      "order": [],
      "ajax": {
        url: "<?= site_url('admin/DataGuru/getGuru') ?>",
        'responsive': true
      },
      //dom: '<"row"<"col-sm-12 col-md-6"l><"col-sm-12 col-md-6"f>>tr<"row mt-3"<"col-sm-8 col-md-5"i><"col-sm-6 col-md-3"B><"col-sm-6 col-md-4"p>>',
      buttons: ['excel', 'pdf'],

      "columnDefs": [{
        // "targets": [4, 6, 8, 9],
        "visible": false,
        "searchable": true
      }],
    });
  });

  function hapusGuru(id) {
    swal.fire({
        title: "Yakin hapus Guru?",
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
            url: "<?= site_url('admin/DataGuru/hapusGuru/') ?>" + id,
            type: "post",
            dataType: "json",
            success: function(data) {
              swal.fire("Sukses", "Satu Guru telah dihapus!", {
                icon: "success",
              });
              reload_table();
            }
          });
        } else {
          swal.fire("Batal", "Satu Guru batal dihapus!", "error");
        }
      });
  }
</script>

<script>
  function editGuru(id_guru) {
    $("#guru").on('click', '.btn-edit', function(e) {
      e.preventDefault();
      var id = $(e.currentTarget).attr('data-id');
      if (id === '') return;
      $.ajax({
        type: "POST",
        url: "<?= site_url('admin/DataGuru/guru_edit/'); ?>" + id_guru,
        data: {
          id: id
        },
        success: function(data) {
          swal.close();
          $('#modalUpdate').modal('show');
          $('#modal_edit').html(data);
        },
        error: function() {
          swal.fire("Preview Siswa Gagal", "Ada Kesalahan Saat menampilkan data guru!", "error");
        }
      });
    });
  }
</script>
<script>
  $("#tambahguru").on('click', function(e) {
    e.preventDefault();
    $.ajax({
      type: "POST",
      url: "<?= site_url('admin/DataGuru/tambah_guru'); ?>",
      success: function(data) {
        $('#modalCenter').modal('show');
        $('#tambah').html(data);
      }
    });
  });
</script>