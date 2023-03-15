<div class="row">
  <div class="col-xxl">
    <div class="card mb-4">
      <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="mb-0">Profil</h5>
        <small class="text-muted float-end">Ubah Data Diri</small>
      </div>
      <div class="card-body">
        <form action="" method="post" id="form-guru" enctype="multipart/form-data">
          <input type="hidden" name="id_user" value="<?= $profile->id_user; ?>">
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="nip">NIP/NUPTK</label>
            <div class="col-sm-10">
              <div class="input-group input-group-merge">
                <span id="nip" style="background:#ebebeb;" class="input-group-text"><i class="bx bx-id-card"></i></span>
                <input type="text" id="nip" name="nip" class="form-control" style="background:#ebebeb;" value="<?= $profile->nip; ?>" placeholder="NIP/NUPTK" aria-label="NIP/NUPTK" aria-describedby="nip" readonly />
              </div>
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-icon-default-username">Username</label>
            <div class="col-sm-10">
              <div class="input-group input-group-merge">
                <span id="basic-icon-default-username" style="background:#ebebeb;" class="input-group-text"><i class="bx bx-user-pin"></i></span>
                <input type="text" class="form-control" style="background:#ebebeb;" value="<?= $profile->username; ?>" name="username" id="basic-icon-default-username" placeholder="Username" aria-label="Username" aria-describedby="basic-icon-default-username" readonly />
              </div>
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Nama</label>
            <div class="col-sm-10">
              <div class="input-group input-group-merge">
                <span id="basic-icon-default-fullname2" class="input-group-text"><i class="bx bx-user"></i></span>
                <input type="text" class="form-control" value="<?= $profile->nama; ?>" name="nama" id="basic-icon-default-fullname" placeholder="Nama Lengkap" aria-label="Nama Lengkap" aria-describedby="basic-icon-default-fullname2" />
              </div>
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 form-label" for="basic-icon-default-phone">No. HP</label>
            <div class="col-sm-10">
              <div class="input-group input-group-merge">
                <span id="basic-icon-default-phone2" class="input-group-text"><i class="bx bx-phone"></i></span>
                <input type="text" id="basic-icon-default-phone" class="form-control phone-mask" value="<?= $profile->no_hp; ?>" name="no_hp" placeholder="+628353353451" aria-label="+628353353451" aria-describedby="basic-icon-default-phone2" />
              </div>
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 form-label" for="basic-icon-default-address">Alamat</label>
            <div class="col-sm-10">
              <div class="input-group input-group-merge">
                <span id="basic-icon-default-address" class="input-group-text"><i class="bx bx-building-house"></i></span>
                <input type="text" id="basic-icon-default-address" class="form-control" value="<?= $profile->alamat; ?>" name="alamat" placeholder="Alamat Lengkap" aria-label="Alamat Lengkap" aria-describedby="basic-icon-default-address" />
              </div>
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 form-label" for="basic-icon-default-born-city">Tempat/Tanggal Lahir</label>
            <div class="col-sm-5">
              <div class="input-group input-group-merge">
                <span id="basic-icon-default-born-city" class="input-group-text"><i class="bx bx-location-plus"></i></span>
                <input type="text" id="basic-icon-default-born-city" class="form-control" value="<?= $profile->tempat_lahir; ?>" name="tempat_lahir" placeholder="Tempat Lahir" aria-label="Tempat Lahir" aria-describedby="basic-icon-default-born-city" />
              </div>
            </div>
            <div class="col-sm-5">
              <div class="input-group input-group-merge">
                <input type="date" id="basic-icon-default-born-city" class="form-control" name="tanggal_lahir" placeholder="" value="<?= $profile->tanggal_lahir; ?>" aria-label="Tanggal Lahir" aria-describedby="basic-icon-default-born-city" />
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
                    <option value="<?= $val->id_agama ?>" <?php if ($profile->id_agama == $val->id_agama) {
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
                  <input class="form-check-input" type="radio" name="gender" value="Laki-laki" <?php echo ($profile->jenis_kelamin == 'Laki-laki') ?  "checked" : "";  ?> id="inlineRadio2" />
                  <label class="form-check-label" for="inlineRadio2">Laki-Laki</label>
                </div>
                <div class="form-check form-check-inline ms-3">
                  <input class="form-check-input" type="radio" id="inlineRadio3" name="gender" value="Perempuan" <?php echo ($profile->jenis_kelamin == 'Perempuan') ?  "checked" : "";  ?> />
                  <label class="form-check-label" for="inlineRadio3">Perempuan</label>
                </div>
              </div>
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 form-label" for="basic-icon-default-address">Status</label>
            <div class="col-sm-10">
              <div class="input-group input-group-merge">
                <div class="form-check form-check-inline">
                  <input class="form-check-input" type="radio" name="status" value="2" value="2" <?php echo ($profile->id_status == '2') ?  "checked" : "";  ?> id="inlineRadio2" />
                  <label class="form-check-label" for="inlineRadio2">PNS</label>
                </div>
                <div class="form-check form-check-inline ms-5">
                  <input class="form-check-input" type="radio" id="inlineRadio3" name="status" value="3" <?php echo ($profile->id_status == '3') ?  "checked" : "";  ?> />
                  <label class="form-check-label" for="inlineRadio3">Honorer</label>
                </div>
              </div>
            </div>
          </div>
          <div class="row mb-3">
            <label class="col-sm-2 form-label" for="basic-icon-default-address">Foto</label>
            <div class="col-sm-10">
              <div class="d-flex align-items-start align-items-sm-center gap-4">
                <img src="<?= (empty($profile->file) == 'default-profile' ? base_url('assets/img/avatars/1.png') : base_url('assets/foto/' . $profile->file)); ?>" alt="user-avatar" class="d-block rounded" height="100" width="100" id="uploadedAvatar" />
                <div class="button-wrapper">
                  <input class="form-control" type="hidden" id="upload" name="foto2" value="<?= $profile->file; ?>" />
                  <input class="form-control" type="file" max="2097152" accept="image/png, image/jpeg" id="upload" name="foto" value="<?= $profile->file; ?>" />
                  <p class="text-muted mb-0">Allowed JPG, GIF or PNG. Max size of 800K</p>

                </div>
              </div>
            </div>
          </div>
          <hr>
          <div class="row justify-content-end">
            <div class="col-sm-10">
              <button type="submit" id="save" class="btn btn-success">Simpan</button>
            </div>
          </div>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  //ajax save
  $('#save').click(function() {
    var data = new FormData($('#form-guru')[0]);
    $.ajax({
      type: 'post',
      url: '<?= site_url('admin/Profile/saveEdit') ?>',
      contentType: false,
      processData: false,
      dataType: 'json',
      data: data,
      success: function(data) {
        console.log(data);
        if (data.status == true) {
          swal.fire({
            title: 'Edit Profil',
            text: 'Profil berhasil diedit',
            icon: 'success',
            timer : 5000
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
  })
</script>