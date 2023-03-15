<div class="row">
  <div class="col-md-12">
    <div class="card">
      <div class="row">
        <div class="col">
          <h5 class="card-header">Data Tahun Akademik</h5>
        </div>
        <div class="col">
          <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-3 me-4">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCenter"><i class="bx bx-plus-circle"></i> Tambah Data</button>
          </div>
        </div>
      </div>
      <!-- /.box-header -->

      <div class="p-4">

        <table class="table table-hover table-striped " id="datatahun" style="width: 100%;">
          <thead>
            <!--<th>Aksi</th>-->
            <th>No.</th>
            <th>Tahun Ajaran</th>
            <th>Semester</th>
            <th>Keterangan</th>
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
            <h5 class="modal-title" id="modalCenterTitle">Tambah Tahun</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="" method="post" id="form-tahun">
            <div class="modal-body">
              <div class="row">
                <div class="col mb-3">
                  <label for="nama" class="form-label">Tahun Ajaran</label>
                  <input type="text" id="tahun" name="tahun" class="form-control" placeholder="Masukan Tahun Ajaran" />
                </div>
              </div>
              <div class="row g-2">
                <div class="col mb-0">
                  <label for="kode_jurusan" class="form-label">Semester</label>
                  <select name="semester" class="form-select" id="semester" aria-label="Default select example">
                    <option value="" selected hidden>--Pilih Semester--</option>
                    <option value="Ganjil">Ganjil</option>
                    <option value="Genap">Genap</option>
                  </select>
                </div>
                <div class="col mb-0">
                  <label for="keterangan" class="form-label">Status</label>
                  <select name="status" class="form-select" id="status" aria-label="Default select example">
                    <option value="" selected hidden>--Pilih Status--</option>
                    <option value="Aktif">Aktif</option>
                    <option value="Tidak Aktif">Tidak Aktif</option>
                  </select>
                </div>
              </div>
              <div class="row mt-2">
                <div class="col mb-3">
                  <label for="keterangan" class="form-label">Keterangan</label>
                  <input type="text" id="keterangan" name="keterangan" class="form-control" placeholder="Masukan Keterangan" />
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
            <h5 class="modal-title" id="modalCenterTitle">Edit Tahun Akademik</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="" method="post" id="edit-tahun">
            <input type="hidden" name="id" id="id" />
            <div class="modal-body">
              <div class="row">
                <div class="col mb-3">
                  <label for="nama" class="form-label">Tahun Ajaran</label>
                  <input type="text" id="tahun2" name="tahun2" class="form-control" placeholder="Masukan Tahun Ajaran" />
                </div>
              </div>
              <div class="row g-2">
                <div class="col mb-0">
                  <label for="kode_jurusan" class="form-label">Semester</label>
                  <select name="semester2" class="form-select" id="semester2" aria-label="Default select example">
                    <option value="" selected hidden>--Pilih Semester--</option>
                    <option value="Ganjil">Ganjil</option>
                    <option value="Genap">Genap</option>
                  </select>
                </div>
                <div class="col mb-0">
                  <label for="keterangan" class="form-label">Status</label>
                  <select name="status2" class="form-select" id="status2" aria-label="Default select example">
                    <option value="" selected hidden>--Pilih Status--</option>
                    <option value="Aktif">Aktif</option>
                    <option value="Tidak Aktif">Tidak Aktif</option>
                  </select>
                </div>
              </div>
              <div class="row mt-2">
                <div class="col mb-3">
                  <label for="keterangan" class="form-label">Keterangan</label>
                  <input type="text" id="keterangan2" name="keterangan2" class="form-control" placeholder="Masukan Keterangan" />
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
    tableSiswa = $('#datatahun').DataTable({

      "processing": true,
      "serverSide": true,
      "scrollX": true,
      "autoWidth": true,
      // "scrollY": "200px",
      "order": [],
      "ajax": {
        url: "<?= site_url('admin/DataTahunAkademik/getTahunAkademik') ?>",
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
    var data = new FormData($('#form-tahun')[0]);
    var tahun = $('input[name="tahun"]').val();
    var semester = $('input[name="semester"]').val();
    var status = $('input[name="status"]').val();
    var keterangan = $('input[name="keterangan"]').val();
    $.ajax({
      type: 'post',
      url: '<?= site_url('admin/DataTahunAkademik/saveTahun') ?>',
      contentType: false,
      processData: false,
      dataType: 'json',
      data: data,
      success: function(data) {
        console.log(data);
        if (data.status == true) {
          swal.fire({
            title: 'Tambah Tahun Akademik Berhasil',
            text: 'Tahun Akademik berhasil ditambahkan',
            icon: 'success'
          });
          reload_table();
        } else {
          if (kode_jurusan == '') {
            swal.fire({
              title: 'Gagal',
              text: 'Harap isi Nama Tahun Akademik',
              icon: 'error',
              dangerMode: 'true'
            })
          } else {
            swal.fire({
              title: 'Gagal',
              text: 'Tahun Akademik Sudah Ada',
              icon: 'error',
              dangerMode: 'true'
            })

          }
        }
      }
    })
  });



  function hapusTahun(id) {
    swal.fire({
        title: "Yakin hapus Tahun Akademik?",
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
            url: "<?= site_url('admin/DataTahunAkademik/hapusTahun/') ?>" + id,
            type: "post",
            dataType: "json",
            success: function(data) {
              swal.fire("Sukses", "Satu Tahun Akademik telah dihapus!", {
                icon: "success",
              });
              reload_table();
            }
          });
        } else {
          swal.fire("Batal", "Satu Tahun Akademik batal dihapus!", "error");
        }
      });
  }

  $(document).ready(function() {
    // get Edit Product
    $("#datatahun").on('click', '.btn-edit', function(e) {
      e.preventDefault();
      // get data from button edit
      const id = $(this).data('id');
      const tahun = $(this).data('tahun');
      const semester = $(this).data('semester');
      const keterangan = $(this).data('keterangan');
      const status = $(this).data('status');
      // Set data to Form Edit
      $('#tahun2').val(tahun);
      $('#semester2').val(semester);
      $('#keterangan2').val(keterangan);
      $('#id').val(id);
      $('#status2').val(status).change();
      // Call Modal Edit
      //$('#modalUpdate').modal('show');
    });
  });

  //saveKelas
  $('#update').click(function() {
    var data = new FormData($('#edit-tahun')[0]);
    var tahun = $('input[name="tahun2"]').val();
    var semester = $('input[name="semester2"]').val();
    var status = $('input[name="status2"]').val();
    var keterangan = $('input[name="keterangan2"]').val();
    var id = $('input[name="id"]').val();
    $.ajax({
      type: 'post',
      url: '<?= site_url('admin/DataTahunAkademik/saveEditTahun') ?>',
      contentType: false,
      processData: false,
      dataType: 'json',
      data: data,
      success: function(data) {
        console.log(data);
        if (data.status == true) {
          swal.fire({
            title: 'Edit Tahun Akademik Berhasil',
            text: 'Tahun Akademik berhasil diubah',
            icon: 'success'
          });
          reload_table();
        } else {
          if (kode_jurusan == '') {
            swal.fire({
              title: 'Gagal',
              text: 'Harap isi Tahun Akademik',
              icon: 'error',
              dangerMode: 'true'
            })
          } else {
            swal.fire({
              title: 'Gagal',
              text: 'Tahun Akademik Sudah Ada',
              icon: 'error',
              dangerMode: 'true'
            })

          }
        }
      }
    })
  });
</script>