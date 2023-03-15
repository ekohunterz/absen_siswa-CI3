<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="row">
        <div class="col">
          <h5 class="card-header">Data Jurusan</h5>
        </div>
        <div class="col">
          <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-3 me-4">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCenter"><i class="bx bx-plus-circle"></i> Tambah Jurusan</button>
          </div>
        </div>
      </div>
      <!-- /.box-header -->

      <div class="p-4">

        <table class="table table-hover table-striped " id="datajurusan" style="width: 100%;">
          <thead>
            <!--<th>Aksi</th>-->
            <th>No.</th>
            <th>Kode Jurusan</th>
            <th>Nama Jurusan</th>
            <th>Keterangan</th>
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
            <h5 class="modal-title" id="modalCenterTitle">Tambah Jurusan</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="" method="post" id="form-jurusan">
            <div class="modal-body">
              <div class="row">
                <div class="col mb-3">
                  <label for="nama" class="form-label">Nama Jurusan</label>
                  <input type="text" id="nama" name="nama" class="form-control" placeholder="Masukan Nama Jurusan" />
                </div>
              </div>
              <div class="row g-2">
                <div class="col mb-0">
                  <label for="kode_jurusan" class="form-label">Kode Jurusan</label>
                  <input type="text" id="kode_jurusan" name="kode_jurusan" class="form-control" placeholder="Masukan Kode Jurusan" />
                </div>
                <div class="col mb-0">
                  <label for="keterangan" class="form-label">Keterangan</label>
                  <input type="text" name="keterangan" id="keterangan" class="form-control" placeholder="Masukan Keterangan" />
                </div>
              </div>
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

<!--Modal Update -->
<div class="col-lg-4 col-md-6">
  <div class="mt-3">
    <!-- Modal -->
    <div class="modal fade" id="modalUpdate" tabindex="-1" aria-hidden="true">
      <div class="modal-dialog modal-dialog-centered" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="modalCenterTitle">Edit Jurusan</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="" method="post" id="edit-jurusan">
            <input type="hidden" name="id" id="id_jurusan2" />
            <div class="modal-body">
              <div class="row">
                <div class="col mb-3">
                  <label for="nama" class="form-label">Nama Jurusan</label>
                  <input type="text" id="nama2" name="nama2" class="form-control" placeholder="Masukan Nama Jurusan" />
                </div>
              </div>
              <div class="row g-2">
                <div class="col mb-0">
                  <label for="kode_jurusan" class="form-label">Kode Jurusan</label>
                  <input type="text" id="kode_jurusan2" name="kode_jurusan2" class="form-control" placeholder="Masukan Kode Jurusan" />
                </div>
                <div class="col mb-0">
                  <label for="keterangan" class="form-label">Keterangan</label>
                  <input type="text" name="keterangan2" id="keterangan2" class="form-control" placeholder="Masukan Keterangan" />
                </div>
              </div>
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
    tableSiswa = $('#datajurusan').DataTable({

      "processing": true,
      "serverSide": true,
      "scrollX": true,
      "autoWidth": true,
      // "scrollY": "200px",
      "order": [],
      "ajax": {
        url: "<?= site_url('admin/DataJurusan/getJurusan') ?>",
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

  //saveKelas
  $('#save').click(function() {
    var data = new FormData($('#form-jurusan')[0]);
    var nama_jurusan = $('input[name="nama"]').val();
    var kode_jurusan = $('input[name="kode_jurusan"]').val();
    var keterangan = $('input[name="keterangan"]').val();
    $.ajax({
      type: 'post',
      url: '<?= site_url('admin/DataJurusan/saveJurusan') ?>',
      contentType: false,
      processData: false,
      dataType: 'json',
      data: data,
      success: function(data) {
        console.log(data);
        if (data.status == true) {
          swal.fire({
            title: 'Tambah Jurusan Berhasil',
            text: 'Jurusan berhasil ditambahkan',
            icon: 'success'
          });
          reload_table();
          $('input[name="kode_jurusan"]').val('');
        } else {
          if (kode_jurusan == '') {
            swal.fire({
              title: 'Gagal',
              text: 'Harap isi Nama Jurusan',
              icon: 'error',
              dangerMode: 'true'
            })
          } else {
            swal.fire({
              title: 'Gagal',
              text: 'Jurusan Sudah Ada',
              icon: 'error',
              dangerMode: 'true'
            })

          }
        }
      }
    })
  });



  function hapusJurusan(id) {
    swal.fire({
        title: "Yakin hapus Jurusan?",
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
            url: "<?= site_url('admin/DataJurusan/hapusJurusan/') ?>" + id,
            type: "post",
            dataType: "json",
            success: function(data) {
              swal.fire("Sukses", "Satu Jurusan telah dihapus!", {
                icon: "success",
              });
              reload_table();
            }
          });
        } else {
          swal.fire("Batal", "Satu Jurusan batal dihapus!", "error");
        }
      });
  }

  $(document).ready(function() {
    // get Edit Product
    $("#datajurusan").on('click', '.btn-edit', function(e) {
      e.preventDefault();
      // get data from button edit
      const id = $(this).data('id');
      const nama = $(this).data('nama');
      const kode_jurusan = $(this).data('kode');
      const keterangan = $(this).data('keterangan');
      // Set data to Form Edit
      $('#nama2').val(nama);
      $('#kode_jurusan2').val(kode_jurusan);
      $('#keterangan2').val(keterangan);
      $('#id_jurusan2').val(id);
      // Call Modal Edit
      //$('#modalUpdate').modal('show');
    });
  });

  //saveKelas
  $('#update').click(function() {
    var data = new FormData($('#edit-jurusan')[0]);
    var nama_jurusan = $('input[name="nama2"]').val();
    var kode_jurusan = $('input[name="kode_jurusan2"]').val();
    var keterangan = $('input[name="keterangan2"]').val();
    var id = $('input[name="id"]').val();
    $.ajax({
      type: 'post',
      url: '<?= site_url('admin/DataJurusan/saveEditJurusan') ?>',
      contentType: false,
      processData: false,
      dataType: 'json',
      data: data,
      success: function(data) {
        console.log(data);
        if (data.status == true) {
          swal.fire({
            title: 'Edit Jurusan Berhasil',
            text: 'Jurusan berhasil diubah',
            icon: 'success'
          });
          reload_table();
          $('input[name="kode_jurusan2"]').val('');
        } else {
          if (kode_jurusan == '') {
            swal.fire({
              title: 'Gagal',
              text: 'Harap isi Nama Jurusan',
              icon: 'error',
              dangerMode: 'true'
            })
          } else {
            swal.fire({
              title: 'Gagal',
              text: 'Jurusan Sudah Ada',
              icon: 'error',
              dangerMode: 'true'
            })

          }
        }
      }
    })
  });
</script>