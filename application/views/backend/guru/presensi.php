<div class="row">
  <!-- Layout Demo -->
  <div class="col-md-12">
    <div class="card mb-4">
      <h5 class="card-header">Absen</h5>
      <center>
        <form method="post">
          <div class="card-body">
            <div class="mb-3">
              <label for="kelas" class="form-label">Jadwal saat ini: <span id="datenow" class="fw-semibold d-block"></span> <?php echo $jadwal['nama_mapel']; ?> <span class="badge rounded-pill bg-primary"><?php echo $jadwal['jam_mulai']; ?> - <?php echo $jadwal['jam_selesai']; ?></span></label>
              <select style="width:30%" class="form-select" id="kelas" aria-label="Pilih Kelas" name="kelas">
                <option value="0" selected hidden>--Pilih Kelas--</option>
                <?php foreach ($kelas as $val) :
                  if ($this->input->post('kelas') == $val->id_jadwal ||  $jadwal['id_jadwal'] == $val->id_jadwal) {
                    $selected = "selected";
                  } else {
                    $selected = '';
                  }
                ?>
                  <option value="<?= $val->id_jadwal ?>" <?= $selected ?>>
                    <?= $val->kelas; ?> - <?= $val->nama_mapel;
                                          $hari_ini = date("H:i:s");
                                          if ($hari_ini > $val->jam_mulai && $hari_ini < $val->jam_selesai) {
                                            echo " (Jadwal Sekarang)";
                                          } ?>
                  </option>
                <?php endforeach; ?>
              </select>
            </div>
            <div id="floatingInputHelp" class="form-text">
              <button class="btn btn-success">Pilih</button>
            </div>
          </div>
        </form>
      </center>
      <div class="p-3">
        <?php if ($this->session->flashdata('success')) : ?>
          <div class="alert alert-success" role="alert">
            <?php echo $this->session->flashdata('success'); ?>
          </div>
        <?php endif; ?>
      </div>
      <h5 class="card-header">List Siswa</h5>
      <div class="card-body">
        <div class="mb-3">
          <div class="table-responsive">
            <form method="post" id="absen">
              <table class="table table-hover table-striped" id="list-absen">
                <thead>
                  <th>No</th>
                  <th>Nama</th>
                  <th>NIS</th>
                  <th>Keterangan</th>
                </thead>
                <tbody>
                  <small hidden>
                    <?= $no = 1; ?>
                  </small>
                  <?php foreach ($siswa as $sis) : ?>
                    <input type="hidden" name="id_siswa[]" value="<?= $sis->id_siswa; ?>">
                    <input type="hidden" name="id_kelas" value="<?= $sis->id_kelas; ?>">
                    <input type="hidden" name="semester" value="<?= $sis->semester; ?>">
                    <input type="hidden" name="tahun_ajaran" value="<?= $sis->tahun_ajaran; ?>">
                    <input type="hidden" name="id_mapel" value="<?= $sis->id_mapel; ?>">
                    <input type="hidden" name="kode_absen[]" value="absen_<?= $sis->id_siswa . date('Ymd') . $id_jadwal; ?>">
                    <tr>
                      <td><?= $no++ ?></td>
                      <td><?= $sis->nama; ?></td>
                      <td><?= $sis->nis; ?></td>
                      <td><select class="form-select" style="width:auto" name="keterangan[]">
                          <option value="<?= $sis->keterangan; ?>" selected hidden><?= $sis->keterangan; ?></option>
                          <option value="Sakit">Sakit</option>
                          <option value="Hadir">Hadir</option>
                          <option value="Izin">Izin</option>
                          <option <?php if ($sis->keterangan == '') {
                                    echo 'selected';
                                  } ?> value="Alpha">Alpha</option>
                      </td>
                    </tr>
                  <?php endforeach; ?>

                </tbody>
              </table>
          </div>
          <br>
          <div class="row">
            <div class="col-auto"><?php if ($id_jadwal == '') { ?>
                <button class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Pilih kelas dahulu" disabled>Absen</button>
              <?php } else { ?>
                <button id="verif" class="btn btn-primary">Absen</button>
              <?php } ?>
            </div>


          </div>
          </form>
        </div>
      </div>
    </div>
  </div>
</div>


<script>
  $(function() {
    //ajax save
    $('#verif').click(function() {
      var data = new FormData($('#absen')[0]);
      $.ajax({
        type: 'post',
        url: '<?= site_url('guru/Absensi/saveAbsensi') ?>',
        contentType: false,
        processData: false,
        dataType: 'json',
        data: data,
        success: function(data) {
          console.log(data);
          if (data.status == true) {
            swal.fire({
              title: 'Verifikasi Absen',
              text: 'Absensi berhasil diverifikasi',
              icon: 'success'
            }).then(function() {
              //window.location = "<?= site_url('guru/Absensi'); ?>";
            });
          } else {
            swal.fire({
              title: 'Gagal',
              text: 'Periksa lagi',
              icon: 'error',
              dangerMode: 'true'
            })
          }
        }

      })
    });
  });
</script>

<script type='text/javascript'>
  var hari = document.getElementById('datenow');
  var months = ['Januari', 'Februari', 'Maret', 'April', 'Mei', 'Juni', 'Juli', 'Agustus', 'September', 'Oktober', 'November', 'Desember'];
  var myDays = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
  var date = new Date();
  var day = date.getDate();
  var month = date.getMonth();
  var thisDay = date.getDay(),
    thisDay = myDays[thisDay];
  var yy = date.getYear();
  var year = (yy < 1000) ? yy + 1900 : yy;
  hari.textContent = thisDay + ', ' + day + ' ' + months[month] + ' ' + year;
</script>
<script>
  $(document).ready(function() {
    $('#list-absen').DataTable({
      scrollX: false,
      scrollCollapse: true,
      paging: false,
    });
  });
</script>