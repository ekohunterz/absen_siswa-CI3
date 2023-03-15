<input type="hidden" name="id_jadwal" value="<?= $jadwal->id_jadwal; ?>">
<div class="row mb-3">
  <label class="col-sm-2 form-label" for="jurusan">Jurusan</label>
  <div class="col-sm-10">
    <div class="input-group input-group-merge">
      <span id="jurusan" class="input-group-text"><i class="bx bx-chalkboard"></i></span>
      <select name="jurusan" class="form-select" id="jurusan" aria-label="Default select example">
        <option value="" selected hidden>--Pilih Jurusan--</option>
        <?php foreach ($jurusan as $val) : ?>
          <option value="<?= $val->kode_jurusan ?>" <?php if ($jadwal->kode_jurusan == $val->kode_jurusan) {
                                                      echo 'selected';
                                                    } ?>><?= $val->nama_jurusan; ?></option>
        <?php endforeach; ?>
      </select>
    </div>
  </div>
</div>
<div class="row mb-3">
  <label class="col-sm-2 form-label" for="mapel">Nama Mapel</label>
  <div class="col-sm-10">
    <div class="input-group input-group-merge">
      <span id="mapel" class="input-group-text"><i class="bx bx-book-content"></i></span>
      <select name="mapel" class="form-select" id="mapel" aria-label="Default select example">
        <option value="" selected hidden>--Pilih Nama Mapel--</option>
        <?php foreach ($mapel as $val) : ?>
          <option value="<?= $val->id_mapel ?>" <?php if ($jadwal->id_mapel == $val->id_mapel) {
                                                    echo 'selected';
                                                  } ?>><?= $val->nama_mapel; ?></option>
        <?php endforeach; ?>
      </select>
    </div>
  </div>
</div>
<div class="row mb-3">
  <label class="col-sm-2 form-label" for="guru">Guru</label>
  <div class="col-sm-10">
    <div class="input-group input-group-merge">
      <span id="guru" class="input-group-text"><i class="bx bx-user"></i></span>
      <select class="form-select" name="guru">
        <option value="" selected hidden>--Pilih Guru--</option>
        <?php foreach ($guru as $val) : ?>
          <option value="<?= $val->id_user ?>" <?php if ($jadwal->id_guru == $val->id_user) {
                                                  echo 'selected';
                                                } ?>><?= $val->nama ?></option>
        <?php endforeach; ?>
      </select>
    </div>
  </div>
</div>
<div class="row mb-3">
  <label class="col-sm-2 form-label" for="basic-icon-default-kelas">Kelas</label>
  <div class="col-sm-10">
    <div class="input-group input-group-merge">
      <span id="basic-icon-default-kelas" class="input-group-text"><i class="bx bx-building"></i></span>
      <select name="kelas" class="form-select" id="basic-icon-default-kelas" aria-label="Default select example">
        <option value="" selected hidden>--Pilih Kelas--</option>
        <?php foreach ($kelas as $val) : ?>
          <option value="<?= $val->id_kelas ?>" <?php if ($jadwal->id_kelas == $val->id_kelas) {
                                                  echo 'selected';
                                                } ?>><?= $val->kelas ?></option>
        <?php endforeach; ?>
      </select>
    </div>
  </div>
</div>
<div class="row mb-3">
  <label class="col-sm-2 form-label" for="basic-icon-default-agama">Hari</label>
  <div class="col-sm-10">
    <div class="input-group input-group-merge">
      <span id="basic-icon-default-agama" class="input-group-text"><i class="bx bx-calendar"></i></span>
      <select class="form-select" name="hari" id="hari">
        <option value="" selected hidden>--Pilih Hari--</option>
        <?php
        $hari = array('Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu');
        foreach ($hari as $day) : ?>
          <option value="<?= $day; ?>" <?php if ($jadwal->hari == $day) {
                                          echo 'selected';
                                        } ?>><?= $day; ?></option>
        <?php endforeach; ?>
      </select>
    </div>
  </div>
</div>
<div class="row mb-3">
  <label class="col-sm-2 form-label" for="basic-icon-default-address">Jam Mulai</label>
  <div class="col-sm-10">
    <div class="input-group input-group-merge">
      <span id="basic-icon-default-address" class="input-group-text"><i class="bx bx-time"></i></span>
      <input type="time" class="form-control" name="mulai" placeholder="Jam Mulai" value="<?= $jadwal->jam_mulai; ?>">
    </div>
  </div>
</div>
<div class="row mb-3">
  <label class="col-sm-2 form-label" for="basic-icon-default-address">Jam Selesai</label>
  <div class="col-sm-10">
    <div class="input-group input-group-merge">
      <span id="basic-icon-default-address" class="input-group-text"><i class="bx bxs-time"></i></span>
      <input type="time" class="form-control" name="selesai" placeholder="Jam Selesai" value="<?= $jadwal->jam_selesai; ?>">
    </div>
  </div>
</div>
<div class="row mb-3">
  <label class="col-sm-2 form-label" for="guru">Tahun Ajaran</label>
  <div class="col-sm-10">
    <div class="input-group input-group-merge">
      <span id="guru" class="input-group-text"><i class="bx bx-calendar-star"></i></span>
      <select class="form-select" id="tahun" name="tahun" style="width:auto">
        <option value="" selected hidden>--Tahun Ajaran--</option>
        <?php foreach ($tahun as $val) :
        ?>
          <option value="<?= $val->tahun_ajaran; ?>" <?php if ($jadwal->tahun_ajaran == $val->tahun_ajaran) {
                                                        echo 'selected';
                                                      } ?>><?= $val->tahun_ajaran; ?></option>
        <?php endforeach; ?>
      </select>
    </div>
  </div>
</div>
<div class="row mb-3">
  <label class="col-sm-2 form-label" for="basic-icon-default-address">Semester</label>
  <div class="col-sm-10">
    <div class="input-group input-group-merge">
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="semester" value="Ganjil" id="inlineRadio2" <?php echo ($jadwal->semester == 'Ganjil') ?  "checked" : "";  ?> />
        <label class="form-check-label" for="inlineRadio2">Ganjil</label>
      </div>
      <div class="form-check form-check-inline ms-3">
        <input class="form-check-input" type="radio" id="inlineRadio3" name="semester" value="Genap" <?php echo ($jadwal->semester == 'Genap') ?  "checked" : "";  ?> />
        <label class="form-check-label" for="inlineRadio3">Genap</label>
      </div>
    </div>
  </div>
</div>
</div>


<script>
  var tableSiswa;

  function reload_table() {
    tableSiswa.ajax.reload(null, false); //reload datatable ajax 
  }

  $(function() {
    //ajax save
    $('#update').click(function() {
      var data = new FormData($('#edit-jadwal')[0]);
      $.ajax({
        type: 'post',
        url: '<?= site_url('admin/Jadwal/saveEdit') ?>',
        contentType: false,
        processData: false,
        dataType: 'json',
        data: data,
        success: function(data) {
          console.log(data);
          if (data.status == true) {
            swal.fire({
              title: 'Ubah Jadwal',
              text: 'Jadwal berhasil diubah',
              icon: 'success'
            }).then(function() {
              tableJadwal.draw();
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