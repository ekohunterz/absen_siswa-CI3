  <div class="row">
    <div class="col-md-12">
      <div class="card mb-4">
        <!--<h5 class="card-header">Data Jadwal</h5> -->
        <div class="card-body">
          <div class="mb-3">
            <form method="post" id="filter">
              <div class="row justify-content-md-center">
                <center>
                  <b>Data Jadwal</b>
                  <p class="text-muted" for="kelas">Cari Jadwal Berdasarkan:</p>
                </center>
                <div class="col-auto">
                  <select class="form-select" id="kelas" name="kelas" style="width:auto">
                    <option value="" selected hidden>--Kelas--</option>
                    <?php foreach ($kelas as $val) :
                    ?>
                      <option value="<?= $val->id_kelas ?>"><?= $val->kelas; ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="col-auto">
                  <select class="form-select" id="hari" name="hari" style="width:auto">
                    <option value="" selected hidden>--Hari--</option>
                    <?php $hari = array('Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu');
                    foreach ($hari as $day) : ?>
                      <option value="<?= $day; ?>"><?= $day; ?></option>
                    <?php endforeach;  ?>
                  </select>
                </div>
                <div class="col-auto">
                  <select class="form-select" id="smt" name="smt" style="width:auto">
                    <option value="" selected hidden>--Semester--</option>
                    <option value="ganjil">Ganjil</option>
                    <option value="genap">Genap</option>
                  </select>
                </div>
                <div class="col-auto">
                  <select class="form-select" id="thn" name="thn" style="width:auto">
                    <option value="" selected hidden>--Tahun Ajaran--</option>
                    <?php foreach ($tahun as $val) :
                    ?>
                      <option value="<?= $val->tahun_ajaran ?>"><?= $val->tahun_ajaran; ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="col-auto d-flex justify-content-center align-items-center">
                  <a href="#" onclick="reset();" class="btn btn-warning btn-sm">Reset</a>
                </div>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>


    <div class="col-md-12">
      <div class="card mb-4">
        <div class="row">
          <div class="col">
            <h5 class="card-header">Data Jadwal</h5>
          </div>
          <div class="col">
            <div class="d-grid gap-2 d-md-flex justify-content-md-end mt-3 me-4">
              <button type="button" id="tambahjadwal" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#modalCenter"><i class="bx bx-plus-circle"></i> Tambah Jadwal</button>
            </div>
          </div>

        </div>
        <div class="p-4">
          <table class="table table-hover table-striped" id="dataJadwal" style="width:100%;">
            <thead>
              <th>No</th>
              <th>Hari</th>
              <th>Mata Pelajaran</th>
              <th>Kelas</th>
              <th>Guru</th>
              <th>Jam Mulai</th>
              <th>Jam Selesai</th>
              <th>Semester</th>
              <th>Tahun Ajaran</th>
              <th>Aksi</th>
            </thead>

          </table>
          <!-- /.tab-pane -->
        </div>
        <!-- /.tab-content -->
      </div>
      <!-- nav-tabs-custom -->
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
              <h5 class="modal-title" id="modalCenterTitle">Tambah Jadwal</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="post" id="form-jadwal">
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
              <h5 class="modal-title" id="modalCenterTitle">Edit Jadwal</h5>
              <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form action="" method="post" id="edit-jadwal">
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
    var tableJadwal;

    function reload_table() {
      tableJadwal.ajax.reload(null, false); //reload datatable ajax 
    }
    $(document).ready(function() {
      var data = new FormData($('#filter')[0]);
      let kelas = $("#kelas").val();
      tableJadwal = $('#dataJadwal').DataTable({
        "processing": true,
        "serverSide": true,
        "scrollX": true,
        "autoWidth": true,
        // "scrollY": "200px",
        "order": [],
        "ajax": {
          url: "<?= site_url('admin/Jadwal/getJadwal') ?>",
          "data": function(d) {
            return $.extend({}, d, {
              "hari": $("#hari").val(),
              "kelas": $("#kelas").val(),
              "smt": $("#smt").val(),
              "thn": $("#thn").val()
            });
          }
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


    function hapusJadwal(id) {
      swal.fire({
          title: "Yakin hapus Jadwal?",
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
              url: "<?= site_url('admin/Jadwal/hapusJadwal/') ?>" + id,
              type: "post",
              dataType: "json",
              success: function(data) {
                swal.fire("Sukses", "Satu Jadwal telah dihapus!", {
                  icon: "success",
                });
                window.location = "<?= site_url('admin/Jadwal'); ?>";
              }
            });
          } else {
            swal.fire("Batal", "Satu Guru batal dihapus!", "error");
          }
        });
    }

    $("#smt, #thn, #hari, #kelas").on('change', function() {
      tableJadwal.draw();
    })

    function reset() {
      document.getElementById('kelas').value = "";
      document.getElementById('smt').value = "";
      document.getElementById('hari').value = "";
      document.getElementById('thn').value = "";
      tableJadwal.draw();
    }

    $("#tambahjadwal").on('click', function(e) {
      e.preventDefault();
      $.ajax({
        type: "POST",
        url: "<?= site_url('admin/Jadwal/tambah_jadwal'); ?>",
        success: function(data) {
          $('#modalCenter').modal('show');
          $('#tambah').html(data);
        }
      });
    });

    function editJadwal(id_jadwal) {
      $("#dataJadwal").on('click', '.btn-edit', function(e) {
        e.preventDefault();
        var id = $(e.currentTarget).attr('data-id');
        if (id === '') return;
        $.ajax({
          type: "POST",
          url: "<?= site_url('admin/Jadwal/editJadwal/'); ?>" + id_jadwal,
          data: {
            id: id
          },
          success: function(data) {
            swal.close();
            $('#modalUpdate').modal('show');
            $('#modal_edit').html(data);
          },
          error: function() {
            swal.fire("Preview Jadwal Gagal", "Ada Kesalahan Saat menampilkan data jadwal!", "error");
          }
        });
      });
    }
  </script>