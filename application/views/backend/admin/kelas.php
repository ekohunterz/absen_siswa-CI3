<div class="row">
  <div class="col-md-12">
    <div div class="card">

      <div class="row">
        <div class="col">
          <h5 class="card-header">Data Kelas</h5>
        </div>
        <div class="col">
          <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-3 me-4">
            <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCenter"><i class="bx bx-plus-circle"></i> Tambah Kelas</button>
          </div>
        </div>
      </div>

      <div class="p-4">
        <table class="table table-hover table-striped " id="dataKelas" style="width: 100%;">
          <thead>
            <!--<th>Aksi</th>-->
            <th>No.</th>
            <!-- <th>Kelas</th> -->
            <th>Kelas</th>
            <th>Jurusan</th>
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
            <h5 class="modal-title" id="modalCenterTitle">Tambah Kelas</h5>
            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
          </div>
          <form action="" method="post" id="form-kelas">
            <div class="modal-body">
              <div class="row">
                <div class="col mb-3">
                  <label for="nama" class="form-label">Nama Kelas</label>
                  <input type="text" id="kelas" name="kelas" class="form-control" placeholder="Masukan Nama Kelas" />
                </div>
              </div>
              <div class="row g-2">
                <div class="col mb-0">
                  <label for="jurusan" class="form-label">Jurusan</label>
                  <select name="jurusan" class="form-select" id="basic-icon-default-jurusan" aria-label="Default select example">
                    <option value="" selected hidden>--Pilih Jurusan--</option>
                    <?php foreach ($jurusan as $val) : ?>
                      <option value="<?= $val->nama_jurusan ?>"><?= $val->nama_jurusan; ?></option>
                    <?php endforeach; ?>
                  </select>
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
          <form action="" method="post" id="edit-kelas">
            <input type="hidden" name="id_kelas" id="id_kelas" />
            <div class="modal-body">
              <div class="row">
                <div class="col mb-3">
                  <label for="kelas2" class="form-label">Nama Kelas</label>
                  <input type="text" id="kelas2" name="kelas2" class="form-control" placeholder="Masukan Nama Kelas" />
                </div>
              </div>
              <div class="row g-2">
                <div class="col mb-0">
                  <label for="jurusan" class="form-label">Jurusan</label>
                  <select name="jurusan2" class="form-select" id="jurusan2" aria-label="Default select example">
                    <option value="" selected hidden>--Pilih Jurusan--</option>
                    <?php foreach ($jurusan as $val) : ?>
                      <option value="<?= $val->nama_jurusan ?>"><?= $val->nama_jurusan; ?></option>
                    <?php endforeach; ?>
                  </select>
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
  var tbKelas;

  function reload_table() {
    tbKelas.ajax.reload(null, false); //reload datatable ajax 
  }

  $(function() {
    //datatables
    tbKelas = $('#dataKelas').DataTable({
      "processing": true,
      "serverSide": true,
      "scrollX": true,
      "autoWidth": true,
      "order": [],
      "ajax": {
        url: "<?= site_url('admin/Kelas/getKelas') ?>",
        'responsive': true
      },
      buttons: [
        'excel'
      ],
      "columnDefs": [{
        "targets": 0,
        "visible": true,
        "searchable": true
      }],
      "bInfo": true
    });

    //saveKelas
    $('#save').click(function() {
      var data = new FormData($('#form-kelas')[0]);
      var kelas = $('input[name="kelas"]').val();
      var jurusan = $('input[name="jurusan"]').val();
      $.ajax({
        type: 'post',
        url: '<?= site_url('admin/Kelas/saveKelas') ?>',
        contentType: false,
        processData: false,
        dataType: 'json',
        data: data,
        success: function(data) {
          console.log(data);
          if (data.status == true) {
            swal.fire({
              title: 'Tambah Kelas',
              text: 'Kelas berhasil ditambahkan',
              icon: 'success'
            });
            reload_table();
            $('input[name="kelas"]').val('');
          } else {
            if (kelas == '') {
              swal.fire({
                title: 'Gagal',
                text: 'Harap isi Nama Kelas',
                icon: 'error',
                dangerMode: 'true'
              })
            } else {
              swal.fire({
                title: 'Gagal',
                text: 'Kelas Sudah Ada',
                icon: 'error',
                dangerMode: 'true'
              })

            }
          }
        }
      })
    });
  });

  function hapusKelas(id) {
    swal.fire({
        title: "Yakin hapus Kelas?",
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
            url: "<?= site_url('admin/Kelas/hapusKelas/') ?>" + id,
            type: "post",
            dataType: "json",
            success: function(data) {
              swal.fire("Sukses", "Satu Kelas telah dihapus!", {
                icon: "success",
              });
              reload_table();
            }
          });
        } else {
          swal.fire("Batal", "Satu Kelas batal dihapus!", "error");
        }
      });
  }

  $(document).ready(function() {
    // get Edit Product
    $("#dataKelas").on('click', '.btn-edit', function(e) {
      e.preventDefault();
      // get data from button edit
      const id = $(this).data('id');
      const nama = $(this).data('nama');
      const jurusan = $(this).data('jurusan');
      // Set data to Form Edit
      $('#kelas2').val(nama);
      $('#jurusan2').val(jurusan).change();
      $('#id_kelas').val(id);
      // Call Modal Edit
      //$('#modalUpdate').modal('show');
    });
  });

  //saveKelas
  $('#update').click(function() {
    var data = new FormData($('#edit-kelas')[0]);
    var nama_jurusan = $('input[name="nama2"]').val();
    var kode_jurusan = $('input[name="jurusan2"]').val();
    var id = $('input[name="id_kelas"]').val();
    $.ajax({
      type: 'post',
      url: '<?= site_url('admin/Kelas/saveEditKelas') ?>',
      contentType: false,
      processData: false,
      dataType: 'json',
      data: data,
      success: function(data) {
        console.log(data);
        if (data.status == true) {
          swal.fire({
            title: 'Edit Kelas Berhasil',
            text: 'Kelas berhasil diubah',
            icon: 'success'
          });
          reload_table();
        } else {
          if (kode_jurusan == '') {
            swal.fire({
              title: 'Gagal',
              text: 'Harap isi Nama Kelas',
              icon: 'error',
              dangerMode: 'true'
            })
          } else {
            swal.fire({
              title: 'Gagal',
              text: 'Kelas Sudah Ada',
              icon: 'error',
              dangerMode: 'true'
            })

          }
        }
      }
    })
  });
</script>