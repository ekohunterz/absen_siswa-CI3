<input type="hidden" name="id_siswa" value="<?= $dataSiswa->id_siswa; ?>">
<div class="row mb-3">
  <label class="col-sm-2 col-form-label" for="nis">NIS</label>
  <div class="col-sm-10">
    <div class="input-group input-group-merge">
      <span id="nis" class="input-group-text"><i class="bx bx-id-card"></i></span>
      <input type="text" class="form-control" maxlength="10" name="nis" id="nis" onblur="nisAvail()" placeholder="NIS 10 digit" value="<?= $dataSiswa->nis; ?>">
    </div>
    <small class="nis"></small>
  </div>
</div>
<div class="row mb-3">
  <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Nama</label>
  <div class="col-sm-10">
    <div class="input-group input-group-merge">
      <span id="basic-icon-default-fullname2" class="input-group-text"><i class="bx bx-user"></i></span>
      <input type="text" class="form-control" name="nama" id="basic-icon-default-fullname" placeholder="Nama Lengkap" aria-label="Nama Lengkap" value="<?= $dataSiswa->nama; ?>" aria-describedby="basic-icon-default-fullname2" />
    </div>
  </div>
</div>
<div class="row mb-3">
  <label class="col-sm-2 form-label" for="basic-icon-default-phone">No. HP</label>
  <div class="col-sm-10">
    <div class="input-group input-group-merge">
      <span id="basic-icon-default-phone2" class="input-group-text"><i class="bx bx-phone"></i></span>
      <input type="text" id="basic-icon-default-phone" class="form-control phone-mask" name="no_hp" placeholder="+628353353451" aria-label="+628353353451" aria-describedby="basic-icon-default-phone2" value="<?= $dataSiswa->no_hp; ?>" />
    </div>
  </div>
</div>
<div class="row mb-3">
  <label class="col-sm-2 col-form-label" for="basic-icon-default-email">Email</label>
  <div class="col-sm-10">
    <div class="input-group input-group-merge">
      <span class="input-group-text"><i class="bx bx-envelope"></i></span>
      <input type="text" id="basic-icon-default-email" class="form-control" name="email" placeholder="E-Mail" aria-label="E-Mail" aria-describedby="basic-icon-default-email2" value="<?= $dataSiswa->email; ?>" />
    </div>
  </div>
</div>
<div class="row mb-3">
  <label class="col-sm-2 form-label" for="basic-icon-default-address">Alamat</label>
  <div class="col-sm-10">
    <div class="input-group input-group-merge">
      <span id="basic-icon-default-address" class="input-group-text"><i class="bx bx-building-house"></i></span>
      <input type="text" id="basic-icon-default-address" class="form-control" name="alamat" placeholder="Alamat Lengkap" aria-label="Alamat Lengkap" aria-describedby="basic-icon-default-address" value="<?= $dataSiswa->alamat; ?>" />
    </div>
  </div>
</div>
<div class="row mb-3">
  <label class="col-sm-2 form-label" for="basic-icon-default-born-city">Tempat/ Tanggal Lahir</label>
  <div class="col-sm-5">
    <div class="input-group input-group-merge">
      <span id="basic-icon-default-born-city" class="input-group-text"><i class="bx bx-location-plus"></i></span>
      <input type="text" id="basic-icon-default-born-city" class="form-control" name="tempat_lahir" placeholder="Tempat Lahir" aria-label="Tempat Lahir" aria-describedby="basic-icon-default-born-city" value="<?= $dataSiswa->tempat_lahir; ?>" />
    </div>
  </div>
  <div class="col-sm-5">
    <div class="input-group input-group-merge">
      <input type="date" id="basic-icon-default-born-city" class="form-control" name="tanggal_lahir" placeholder="" aria-label="Tanggal Lahir" aria-describedby="basic-icon-default-born-city" value="<?= $dataSiswa->tanggal_lahir; ?>" />
    </div>
  </div>
</div>
<div class="row mb-3">
  <label class="col-sm-2 form-label" for="basic-icon-default-agama">Agama</label>
  <div class="col-sm-10">
    <div class="input-group input-group-merge">
      <span id="basic-icon-default-agama" class="input-group-text"><i class="bx bx-building"></i></span>
      <select name="agama" class="form-select" id="basic-icon-default-agama" aria-label="Default select example">
        <option value="" selected hidden>--Pilih Agama--</option>
        <?php foreach ($agama as $val) : ?>
          <option value="<?= $val->id_agama ?>" <?php if ($dataSiswa->id_agama == $val->id_agama) {
                                                  echo 'selected';
                                                } ?>><?= $val->agama; ?></option>
        <?php endforeach; ?>
      </select>
    </div>
  </div>
</div>
<div class="row mb-3">
  <label class="col-sm-2 form-label" for="basic-icon-default-address">Jenis Kelamin</label>
  <div class="col-sm-10">
    <div class="input-group input-group-merge">
      <div class="form-check form-check-inline">
        <input class="form-check-input" type="radio" name="gender" value="Laki-laki" <?php echo ($dataSiswa->jenis_kelamin == 'Laki-laki') ?  "checked" : "";  ?> id="inlineRadio2" />
        <label class="form-check-label" for="inlineRadio2">Laki-Laki</label>
      </div>
      <div class="form-check form-check-inline ms-3">
        <input class="form-check-input" type="radio" id="inlineRadio3" name="gender" value="Perempuan" <?php echo ($dataSiswa->jenis_kelamin == 'Perempuan') ?  "checked" : "";  ?> />
        <label class="form-check-label" for="inlineRadio3">Perempuan</label>
      </div>
    </div>
  </div>
</div>
<div class="row mb-3">
  <label class="col-sm-2 form-label" for="basic-icon-default-kelas">Kelas</label>
  <div class="col-sm-10">
    <div class="input-group input-group-merge">
      <span id="basic-icon-default-kelas" class="input-group-text"><i class="bx bx-chalkboard"></i></span>
      <select name="kelas" class="form-select" id="basic-icon-default-kelas" aria-label="Default select example">
        <option value="" selected hidden>--Pilih Kelas--</option>
        <?php foreach ($kelas as $val) : ?>
          <option value="<?= $val->id_kelas ?>" <?php if ($dataSiswa->id_kelas == $val->id_kelas) {
                                                  echo 'selected';
                                                } ?>><?= $val->kelas ?></option>
        <?php endforeach; ?>
      </select>
    </div>
  </div>
</div>
</div>


<script>
  $(function() {
    //ajax save
    $('#update').click(function() {
      var data = new FormData($('#edit-siswa')[0]);
      $.ajax({
        type: 'post',
        url: '<?= site_url('admin/DataSiswa/saveEdit') ?>',
        contentType: false,
        processData: false,
        dataType: 'json',
        data: data,
        success: function(data) {
          console.log(data);
          if (data.status == true) {
            swal.fire({
              title: 'Edit Siswa',
              text: 'Data siswa berhasil diubah',
              icon: 'success'
            }).then(function() {
              reload_table();
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



  $("#nis").inputFilter(function(value) {
    return /^\d*$/.test(value) && (value === "" || parseInt(value.length) <= 10);
  });

  function nisAvail() {
    var nis = $('input[name="nis"]').val();
    $.ajax({
      type: "post",
      url: "<?= site_url('admin/DataSiswa/nisValid') ?>",
      data: {
        nis: nis
      },
      success: function(response) {
        if (nis == '') {
          $('.nis').html('<b><i style="color:red">Nis wajib diisi</i></b>');
        } else {
          if (nis.length < 10) {
            $('.nis').html('<b><i style="color:red">Nis tidak lengkap</i></b>');
          } else {
            if (response == true) {
              $('.nis').html('<b><i style="color:green">Nis dapat digunakan</i></b>');
            } else {
              $('.nis').html('<b><i style="color:red">Nis sudah terdaftar</i></b>');
            }
          }

        }
      }
    });
  }
</script>