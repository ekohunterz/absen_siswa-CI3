<div class="row">
    <div class="col-md-12">
      <div class="card mb-4">
        <h5 class="card-header">Data Rekap</h5>
        <div class="card-body">
          <div class="mb-3">
            <form method="post" id="rekapabsensiswa">
              <div class="row justify-content-md-center">
                <center>
                  <b>Data Rekap</b>
                  <p class="text-muted" for="kelas">Pilih kelas, semester & tahun ajaran</p>
                </center>
                <div class="col-xs-12 col-md-2">
                  <select class="form-select" id="kelas" name="kelas" required="" autofocus="" data-errormessage-value-missing="isi kelas!">
                    <option value="" selected hidden>--Pilih Kelas--</option>
                    <?php foreach ($kelas as $val) :
                      if ($this->input->post('kelas') == $val->id_kelas) {
                        $selected = "selected";
                      } else {
                        $selected = '';
                      }
                    ?>
                      <option value="<?= $val->id_kelas ?>" <?= $selected ?>><?= $val->kelas; ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
                <div class="col-xs-12 col-md-2">
                  <select class="form-select" id="smt" name="smt" required="" autofocus="" data-errormessage-value-missing="isi kelas!">
                    <option value="" selected hidden>--Pilih Semester--</option>
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
                    <option value="" selected hidden>--Pilih Tahun Ajaran--</option>
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
                <div class="col-xs-12 col-md-2">
                  <select class="form-select" id="mapel" name="mapel" required="" autofocus="" disabled data-errormessage-value-missing="isi mapel!">
                    <option value="" selected hidden>--Pilih Mapel--</option>
                    <?php foreach ($jadwal as $val) :
                      if ($this->input->post('mapel') == $val->id_mapel) {
                        $selected = "selected";
                      } else {
                        $selected = '';
                      }
                    ?>
                      <option value="<?= $val->id_mapel ?>" <?= $selected ?>><?= $val->nama_mapel; ?></option>
                    <?php endforeach; ?>
                  </select>
                </div>
              </div>
              <div class="d-flex justify-content-md-center mt-3">
                <div class="col-auto me-2">
                  <button class="btn btn-success">Pilih</button>
                </div>
                <div class="col-auto me-2">
                  <a href="<?= site_url('gr/data-rekap'); ?>" class="btn btn-warning">Reset</a>
                </div>
                <?php if (count($siswa) > 0) : ?>
                  <div class="col-auto">
                    <button class="btn btn-primary" formaction="<?= site_url('cetakrekap'); ?>"><i class="fa fa-print"></i> Export</button>
                  </div>
                <?php endif; ?>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>


    <div class="col-md-12">
      <div class="card mb-4">
        <h5 class="card-header">Rekap Absensi Siswa</h5>
        <div class="card-body">
          <div class="mb-3">
            <form action="" method="post" id="absen">
              <div class="table-responsive">
                <table class="table table-hover table-striped" id="list-rekap">
                  <thead>
                    <th>No</th>
                    <th>NIS</th>
                    <th>Nama</th>
                    <th>Hadir</th>
                    <th>Izin</th>
                    <th>Sakit</th>
                    <th>Alpha</th>
                    <th>Jumlah Tidak Hadir</th>
                  </thead>
                  <tbody>
                    <small hidden>
                      <?= $no = 1; ?>
                    </small>
                    <?php foreach ($siswa as $sis) : ?>
                      <input type="hidden" name="id_siswa[]" value="<?= $sis->id_siswa; ?>">
                      <input type="hidden" name="id_kelas" value="<?= $kelask; ?>">
                      <tr>
                        <td><?= $no++ ?></td>
                        <td><?= $sis->nis; ?></td>
                        <td><?= $sis->nama; ?></td>
                        <td><?= $sis->tHadir; ?></td>
                        <td><?= $sis->tIjin; ?></td>
                        <td><?= $sis->tSakit; ?></td>
                        <td><?= $sis->tAlpha; ?></td>
                        <td><?= $sis->total; ?></td>
                      </tr>
                    <?php endforeach; ?>
                  </tbody>
                </table>
                <br />

            </form>

          </div>
          <!-- /.tab-pane -->
        </div>
        <!-- /.tab-content -->
      </div>
      <!-- nav-tabs-custom -->

      <!-- <?php foreach ($absensi as $val) :
              echo date("M", $val->time_in);
              echo $val->keterangan;
            endforeach; ?> -->

      <h5 class="card-header">Data Rekap Absensi</h5>
      <div class="card-body">
        <div class="mb-3">
          <form action="<?= site_url('gr/cetak-rekap'); ?>" method="post" id="absen">
            <div class="table-responsive text-nowrap">
              <table class="table table-hover" style="width:100%">
                <thead>
                  <th>Semester/Tahun Ajaran</th>
                  <!-- <th>NIS</th> -->
                  <!-- <th>Nama</th> -->
                  <th>Hadir</th>
                  <th>Sakit</th>
                  <th>Ijin</th>
                  <th>Alpha</th>
                  <th>Jumlah tidak hadir</th>
                </thead>
                <?php if ($_SERVER['REQUEST_METHOD'] === 'POST') { ?>
                  <tbody>

                    <?php
                    foreach ($absensi as $val) :
                      $tot = $val->tSakit + $val->tIjin + $val->tAlpha;
                    ?>
                      <input type="hidden" name="kelas" value="<?= $kelask ?>">
                      <tr>
                        <td><?= $this->input->post('smt') . ', ' . $this->input->post('thn'); ?></td>
                        <td><?= $val->tHadir; ?></td>
                        <td><?= $val->tSakit; ?></td>
                        <td><?= $val->tIjin; ?></td>
                        <td><?= $val->tAlpha; ?></td>
                        <td><?= $tot; ?></td>
                      </tr>
                    <?php endforeach; ?>

                  </tbody>
                <?php } else { ?>
                  <tbody>
                    <tr>
                      <td colspan=6>
                        <center>
                          <small class="text-muted"><i>Pilih Kelas</i></small>
                        </center>
                      </td>
                    </tr>
                  </tbody>
                <?php } ?>
              </table>
          </form>

        </div>
        <!-- /.tab-pane -->
      </div>
      <!-- /.tab-content -->
    </div>
  </div>
  </div>
  </div>
  <script>
    $(document).ready(function() {
      $('#list-rekap').DataTable();
    });
  </script>

  <script type="text/javascript">
    $(document).ready(function() {
      var kelas = $('#kelas').val();
      if (kelas != '') {
        $('#mapel').removeAttr('disabled');
      }
      $("#kelas").on('change', function() {
        var id = $(this).val();
        $.ajax({
          url: "<?php echo site_url('admin/DataRekap/get_jadwal'); ?>",
          method: "POST",
          data: {
            id: id
          },
          async: true,
          dataType: 'json',
          success: function(data) {

            var html = '';
            var i;
            for (i = 0; i < data.length; i++) {
              html += '<option value=' + data[i].id_mapel + '>' + data[i].nama_mapel + '</option>';
            }
            $('#mapel').html(html);
            $('#mapel').removeAttr('disabled');

          }
        });
        return false;
      });

    });
  </script>