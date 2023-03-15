  <div class="row">
    <div class="col-md-12">
      <div class="card mb-4">
        <!--<h5 class="card-header">Data Jadwal</h5> -->
        <div class="card-body">
          <div class="mb-3">
            <form method="post" id="filter">
              <div class="row justify-content-md-center">
                <center>
                  <p class="text-muted" for="kelas">Cari Jadwal Berdasarkan:</p>
                </center>
                <div class="col-auto">
                  <select class="form-select" id="kelas" name="kelas">
                    <option value="" selected hidden>--Kelas--</option>
                    <?php foreach ($kelas as $val) :
                    ?>
                      <option value="<?= $val->id_kelas ?>"><?= $val->kelas; ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="col-auto">
                  <select class="form-select" id="hari" name="hari">
                    <option value="" selected hidden>--Hari--</option>
                    <?php $hari = array('Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu');
                    foreach ($hari as $day) : ?>
                      <option value="<?= $day; ?>"><?= $day; ?></option>
                    <?php endforeach;  ?>
                  </select>
                </div>
                <div class="col-xs-12 col-md-2">
                  <select class="form-select" id="smt" name="smt" required="" autofocus="" data-errormessage-value-missing="isi kelas!">
                    <option value="" selected hidden>--Semester--</option>
                    <option value="Ganjil" <?php if ($this->input->post('smt') == 'Ganjil') {
                                              echo 'selected';
                                            } ?>>Ganjil</option>
                    <option value="Genap" <?php if ($this->input->post('smt') == 'Genap') {
                                            echo 'selected';
                                          } ?>>Genap</option>
                  </select>
                </div>
                <div class="col-xs-12 col-md-2">
                  <select class="form-select" id="thn" name="thn" required="" autofocus="" data-errormessage-value-missing="isi kelas!">
                    <option value="" selected hidden>--Tahun Ajaran--</option>
                    <?php foreach ($tahun as $val) :
                      if ($this->input->post('thn') == $val->tahun_ajaran) {
                        $selected = "selected";
                      } else {
                        $selected = '';
                      }
                    ?>
                      <option value="<?= $val->tahun_ajaran; ?>" <?= $selected ?>><?= $val->tahun_ajaran; ?></option>
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
        <h5 class="card-header">Jadwal Mengajar</h5>
        <div class="card-body">
          <div class="mb-3">
            <form action="" method="post" id="absen">
              <div class="table-responsive">
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
                  </thead>
                </table>
                <br />

            </form>

          </div>
          <!-- /.tab-pane -->
        </div>
        <!-- /.tab-content -->
      </div>
      <!-- nav-tabs-custom -->
    </div>
  </div>
  </div>
  <script>
    function reload_table() {
      tableJadwal.ajax.reload(null, false); //reload datatable ajax 
    }
    $(document).ready(function() {
      var data = new FormData($('#filter')[0]);
      let kelas = $("#hari").val();
      tableJadwal = $('#dataJadwal').DataTable({
        "processing": true,
        "serverSide": true,
        "scrollX": true,
        "autoWidth": true,
        // "scrollY": "200px",
        "order": [],
        "ajax": {
          url: "<?= site_url('guru/Jadwal/getJadwal') ?>",
          "data": function(d) {
            return $.extend({}, d, {
              "kelas": $("#kelas").val(),
              "hari": $("#hari").val(),
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
  </script>