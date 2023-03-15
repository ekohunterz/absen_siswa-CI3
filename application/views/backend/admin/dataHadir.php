<div class="row">
  <div class="col-md-12">
    <div class="card mb-4">
      <h5 class="card-header">Data Absensi</h5>
      <div class="card-body">
        <div class="mb-3">
          <form method="post" id="rekapabsensiswa">
            <div class="row justify-content-md-center">
              <center>
                <b>Data Absen</b>
                <p class="text-muted" for="kelas">Pilih kelas dan tanggal</p>
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
                  <input type="date" class="form-control w-100" id="tgl" name="tgl" value="<?php echo isset($_POST["tgl"]) ? $_POST["tgl"] : "--Pilih Tanggal--"; ?>" required="" autofocus="" data-errormessage-value-missing="isi bulan!">
                </div>
                <div class="col-xs-12 col-md-2">
                  <select class="form-select" id="mapel" name="mapel" autofocus="" data-errormessage-value-missing="isi mapel!" disabled>
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
                <a href="<?= site_url('data-hadir'); ?>" class="btn btn-warning">Reset</a>
              </div>
              <?php if (count($siswa) > 0) : ?>
                <div class="col-auto">
                  <button class="btn btn-primary" formaction="<?= site_url('export'); ?>"><i class="fa fa-print"></i> Export</button>
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
      <h5 class="card-header">List Absensi</h5>
      <div class="card-body">
        <div class="mb-3">
          <form action="" method="post" id="absen">
            <div class="table-responsive">
              <table class="table table-hover table-striped" id="list-absen">
                <thead>
                  <th>No</th>
                  <th>Nama</th>
                  <th>NIS</th>
                  <th>Hari/Tanggal</th>
                  <th>Status</th>
                </thead>
                <tbody>
                  <small hidden>
                    <?= $no = 1; ?>
                  </small>
                  <?php foreach ($siswa as $sis) : ?>
                    <input hidden name="id_siswa[]" value="<?= $sis->id_siswa; ?>">
                    <input hidden name="id_kelas" value="<?= $id_kelas; ?>">
                    <input hidden name="kode_absen[]" value="<?= $sis->id_absen; ?>">
                    <input hidden name="time_in[]" value="<?= $sis->time_in; ?>">
                    <input hidden name="tanggal1[]" value="<?= $sis->tanggal; ?>">
                    <input hidden name="bulan1[]" value="<?= $sis->bulan; ?>">
                    <input hidden name="tahun1[]" value="<?= $sis->tahun; ?>">
                    <tr>
                      <td><?= $no++ ?></td>
                      <td><?= $sis->nama; ?></td>
                      <td><?= $sis->nis; ?></td>
                      <td><?= $sis->tanggal_absen; ?></td>
                      <td><select id="keterangan[]" class="form-control" style="width:auto" name="keterangan[]" disabled>
                          <option value="<?= $sis->keterangan; ?>" selected hidden><?= $sis->keterangan; ?></option>
                          <option value="Sakit">Sakit</option>
                          <option value="Hadir">Hadir</option>
                          <option value="Izin">Izin</option>
                          <option value="Alpha">Alpha</option>
                      </td>
                    </tr>
                  <?php endforeach; ?>
                </tbody>
              </table>
              <br />
              <?php if ($this->input->post('kelas') == "") { ?>
                <button class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Pilih kelas dahulu" disabled>Ubah Absen</button>
              <?php } else { ?>
                <a href="#absen" id="edit" class="btn btn-primary">Ubah Absen</a>
                <button id="verif" class="btn btn-success" hidden>Simpan Absen</button>
                <a href="#absen" id="batal" class="btn btn-warning" hidden>Batal</a>
              <?php } ?>

          </form>

        </div>
        <!-- /.tab-pane -->
      </div>
      <!-- /.tab-content -->
    </div>
    <!-- nav-tabs-custom -->


    <h5 class="card-header">Rekap</h5>
    <div class="card-body">
      <div class="mb-3">
        <form action="" method="post" id="absen">
          <div class="table-responsive text-nowrap">
            <table class="table table-hover" style="width:100%">
              <thead>
                <th>Tanggal</th>
                <!-- <th>NIS</th> -->
                <!-- <th>Nama</th> -->
                <th>Sakit</th>
                <th>Ijin</th>
                <th>Alpha</th>
                <th>Hadir</th>
                <th>Jumlah tidak hadir</th>
              </thead>
              <?php if ($_SERVER['REQUEST_METHOD'] === 'POST') { ?>
                <tbody>

                  <?php
                  foreach ($absensi as $val) :
                    $tot = $val->tSakit + $val->tIjin + $val->tAlpha;
                  ?>
                    <input type="hidden" name="kelas" value="<?= $id_kelas ?>">
                    <tr>
                      <td><?= $val->tanggal_absen; ?></td>
                      <td><?= $val->tSakit; ?></td>
                      <td><?= $val->tIjin; ?></td>
                      <td><?= $val->tAlpha; ?></td>
                      <td><?= $val->tHadir; ?></td>
                      <td><?= $tot; ?></td>
                    </tr>
                  <?php endforeach; ?>

                </tbody>
              <?php } else { ?>
                <tbody>
                  <tr>
                    <td colspan=6>
                      <center>
                        <small class="text-muted"><i>Pilih Kelas dan Tanggal</i></small>
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
  $(function() {
    tableRekap = $('#list-absen').DataTable({
      "order": [],
      "processing": true,
      "language": {
        "emptyTable": "Pilih Kelas "
      },
      "columnDefs": [{
        // "targets": [4, 6, 8, 9],
        "visible": false,
        "searchable": true
      }],
    });
  });
</script>

<script>
  $(document).ready(function() {

    $("#edit").click(function() {
      $('select').removeAttr('disabled');
      $('#verif').removeAttr('hidden');
      $('#batal').removeAttr('hidden');
      $('#edit').attr('hidden', true);

      // $("input[type=submit]").removeAttr('disabled') You can enable the button from this code
    });

    $("#batal").click(function() {
      location.reload(true);

      // $("input[type=submit]").removeAttr('disabled') You can enable the button from this code
    });

  });
</script>

<script>
  //ajax save
  $('#verif').click(function() {
    var data = new FormData($('#absen')[0]);
    $.ajax({
      type: 'post',
      url: '<?= site_url('admin/DataKehadiran/updateAbsen') ?>',
      contentType: false,
      processData: false,
      dataType: 'json',
      data: data,
      success: function(data) {
        console.log(data);
        if (data.status == true) {
          swal.fire({
            title: 'Edit Absen',
            text: 'Absen berhasil diedit',
            icon: 'success'
          });
        } else {
          swal.fire({
            title: 'Gagal',
            text: 'Tidak diketahui',
            icon: 'error',
            dangerMode: 'true'
          })
        }
      }

    })
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
          url: "<?php echo site_url('admin/DataKehadiran/get_jadwal'); ?>",
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