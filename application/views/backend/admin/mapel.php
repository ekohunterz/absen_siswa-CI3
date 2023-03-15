<div class="row">
  <div class="col-md-12">
    <div div class="card">

      <div class="row">
        <div class="col">
          <h5 class="card-header">Data Mata Pelajaran</h5>
        </div>
        <div class="col">
          <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-3 me-4">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCenter"><i class="bx bx-plus-circle"></i> Tambah Mapel</button>
          </div>
        </div>
      </div>

      <div class="p-4">
        <table class="table table-hover table-striped " id="dataMapel" style="width: 100%;">
          <thead>
            <!--<th>Aksi</th>-->
            <th>No.</th>
            <th>Nama Mata Pelajaran</th>
            <th>Jurusan</th>
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
            <h5 class="modal-title" id="modalCenterTitle">Tambah Mapel</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="" method="post" id="form-mapel">
            <div class="modal-body">
              <div class="row">
                <div class="col mb-3">
                  <label for="mapel" class="form-label">Nama Mata Pelajaran</label>
                  <input type="text" id="mapel" name="mapel" class="form-control" placeholder="Masukan Nama Mapel" />
                </div>
              </div>
              <div class="row g-2">
                <div class="col mb-0">
                  <label for="jurusan" class="form-label">Jurusan</label>
                  <select name="jurusan" class="form-select" id="basic-icon-default-jurusan" aria-label="Default select example">
                    <option value="" selected hidden>--Pilih Jurusan--</option>
                    <option value="Semua Jurusan">Semua Jurusan</option>
                    <?php foreach ($jurusan as $val) : ?>
                      <option value="<?= $val->kode_jurusan ?>"><?= $val->nama_jurusan; ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="col mb-0">
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
            <h5 class="modal-title" id="modalCenterTitle">Edit Kelas</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="" method="post" id="edit-mapel">
            <input type="hidden" name="id_mapel" id="id_mapel" />
            <div class="modal-body">
              <div class="row">
                <div class="col mb-3">
                  <label for="mapel" class="form-label">Nama Mata Pelajaran</label>
                  <input type="text" id="mapel2" name="mapel2" class="form-control" placeholder="Masukan Nama Mapel" />
                </div>
              </div>
              <div class="row g-2">
                <div class="col mb-0">
                  <label for="jurusan" class="form-label">Jurusan</label>
                  <select name="jurusan2" class="form-select" id="jurusan2" aria-label="Default select example">
                    <option value="" selected hidden>--Pilih Jurusan--</option>
                    <option value="Semua Jurusan">Semua Jurusan</option>
                    <?php foreach ($jurusan as $val) : ?>
                      <option value="<?= $val->kode_jurusan ?>"><?= $val->nama_jurusan; ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="col mb-0">
                  <label for="keterangan2" class="form-label">Keterangan</label>
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
  var tbMapel;

  function reload_table() {
    tbMapel.ajax.reload(null, false); //reload datatable ajax 
  }

  $(function() {
    tbMapel = $('#dataMapel').DataTable({
      "processing": true,
      "serverSide": true,
      "scrollX": true,
      "order": [],
      "ajax": {
        url: "<?= site_url('admin/Mapel/getMapel') ?>",
        'responsive': true
      },
      buttons: [
        'excel'
      ],
      "columnDefs": [{
        // "targets": [4, 6, 8, 9],
        "visible": false,
        "searchable": true
      }],
      "bInfo": false
    });

    //save Mapel
    $('#save').click(function() {
      var data = new FormData($('#form-mapel')[0]);
      var mapel = $('input[name="mapel"]').val();
      var jurusan = $('input[name="jurusan"]').val();
      var keterangan = $('input[name="keterangan"]').val();
      $.ajax({
        type: 'post',
        url: '<?= site_url('admin/Mapel/saveMapel') ?>',
        contentType: false,
        processData: false,
        dataType: 'json',
        data: data,
        success: function(data) {
          console.log(data);
          if (data.status == true) {
            swal.fire({
              title: 'Tambah Mata Pelajaran',
              text: 'Mata Pelajaran berhasil ditambahkan',
              icon: 'success'
            });
            reload_table();
            $('input[name="mapel"]').val('');
          } else {
            if (mapel == '') {
              swal.fire({
                title: 'Gagal',
                text: 'Harap isi Mata Pelajaran',
                icon: 'error',
                dangerMode: 'true'
              })
            } else {
              swal.fire({
                title: 'Gagal',
                text: 'Mata Pelajaran Sudah Ada',
                icon: 'error',
                dangerMode: 'true'
              })

            }
          }
        }

      })
    });
  });

  function hapusMapel(id) {
    swal.fire({
        title: "Yakin hapus Mata Pelajaran?",
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
            url: "<?= site_url('admin/Mapel/hapusMapel/') ?>" + id,
            type: "post",
            dataType: "json",
            success: function(data) {
              swal.fire("Sukses", "Satu Mata Pelajaran telah dihapus!", {
                icon: "success",
              });
              reload_table();
            }
          });
        } else {
          swal.fire("Batal", "Satu Mata Pelajaran batal dihapus!", "error");
        }
      });
  }

  $(document).ready(function() {
    // get Edit Product
    $("#dataMapel").on('click', '.btn-edit', function(e) {
      e.preventDefault();
      // get data from button edit
      const id = $(this).data('id');
      const nama = $(this).data('nama');
      const jurusan = $(this).data('kode');
      const keterangan = $(this).data('keterangan');
      // Set data to Form Edit
      $('#mapel2').val(nama);
      $('#keterangan2').val(keterangan);
      $('#jurusan2').val(jurusan).change();
      $('#id_mapel').val(id);
      // Call Modal Edit
      //$('#modalUpdate').modal('show');
    });
  });

  //saveKelas
  $('#update').click(function() {
    var data = new FormData($('#edit-mapel')[0]);
    var mapel = $('input[name="mapel"]').val();
    var jurusan = $('input[name="jurusan"]').val();
    var keterangan = $('input[name="keterangan"]').val();
    $.ajax({
      type: 'post',
      url: '<?= site_url('admin/Mapel/saveEditMapel') ?>',
      contentType: false,
      processData: false,
      dataType: 'json',
      data: data,
      success: function(data) {
        console.log(data);
        if (data.status == true) {
          swal.fire({
            title: 'Edit Mapel Berhasil',
            text: 'Mapel berhasil diubah',
            icon: 'success'
          });
          reload_table();
        } else {
          if (mapel == '') {
            swal.fire({
              title: 'Gagal',
              text: 'Harap isi Nama Mapel',
              icon: 'error',
              dangerMode: 'true'
            })
          } else {
            swal.fire({
              title: 'Gagal',
              text: 'Mapel Sudah Ada',
              icon: 'error',
              dangerMode: 'true'
            })

          }
        }
      }
    })
  });
</script>