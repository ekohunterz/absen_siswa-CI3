<div class="row mb-3">
  <label class="col-sm-2 col-form-label" for="nip">NIP/NUPTK</label>
  <div class="col-sm-10">
    <div class="input-group input-group-merge">
      <span id="basic-icon-default-fullname2" class="input-group-text"><i class="bx bx-id-card"></i></span>
      <input type="text" class="form-control" maxlength="18" name="nip" id="nip" onblur="nipAvail()" placeholder="NIP/NUPTK 18 digit">
    </div>
    <small class="nip"><i class="text-muted">Jika NUPTK kurang dari 18, tambahkan digit 0 di bagian depan.</i></small>
  </div>
</div>
<div class="row mb-3">
  <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Nama</label>
  <div class="col-sm-10">
    <div class="input-group input-group-merge">
      <span id="basic-icon-default-fullname2" class="input-group-text"><i class="bx bx-user"></i></span>
      <input type="text" class="form-control" name="nama" id="basic-icon-default-fullname" placeholder="Nama Lengkap" aria-label="Nama Lengkap" aria-describedby="basic-icon-default-fullname2" />
    </div>
  </div>
</div>
<div class="row mb-3">
  <label class="col-sm-2 col-form-label" for="basic-icon-default-fullname">Username</label>
  <div class="col-sm-10">
    <div class="input-group input-group-merge">
      <span id="basic-icon-default-username2" class="input-group-text"><i class="bx bx-user-circle"></i></span>
      <input type="text" class="form-control" name="username" id="username" onblur="userNameAvail()" placeholder="Username" aria-label="Username" aria-describedby="basic-icon-default-fullname2" />
    </div>
    <small class="uname"></small>
  </div>
</div>
<div class="row mb-3">
  <label class="col-sm-2 form-label" for="basic-icon-default-phone">No. HP</label>
  <div class="col-sm-10">
    <div class="input-group input-group-merge">
      <span id="basic-icon-default-phone2" class="input-group-text"><i class="bx bx-phone"></i></span>
      <input type="text" id="basic-icon-default-phone" class="form-control phone-mask" name="no_hp" placeholder="+628353353451" aria-label="+628353353451" aria-describedby="basic-icon-default-phone2" />
    </div>
  </div>
</div>
<div class="row mb-3">
  <label class="col-sm-2 form-label" for="basic-icon-default-address">Alamat</label>
  <div class="col-sm-10">
    <div class="input-group input-group-merge">
      <span id="basic-icon-default-address" class="input-group-text"><i class="bx bx-building-house"></i></span>
      <input type="text" id="basic-icon-default-address" class="form-control" name="alamat" placeholder="Alamat Lengkap" aria-label="Alamat Lengkap" aria-describedby="basic-icon-default-address" />
    </div>
  </div>
</div>
<div class="row mb-3">
  <label class="col-sm-2 form-label" for="basic-icon-default-born-city">Tempat/ Tanggal Lahir</label>
  <div class="col-sm-5">
    <div class="input-group input-group-merge">
      <span id="basic-icon-default-born-city" class="input-group-text"><i class="bx bx-location-plus"></i></span>
      <input type="text" id="basic-icon-default-born-city" class="form-control" name="tempat_lahir" placeholder="Tempat Lahir" aria-label="Tempat Lahir" aria-describedby="basic-icon-default-born-city" />
    </div>
  </div>
  <div class="col-sm-5">
    <div class="input-group input-group-merge">
      <input type="date" id="basic-icon-default-born-city" class="form-control" name="tanggal_lahir" placeholder="" aria-label="Tanggal Lahir" aria-describedby="basic-icon-default-born-city" />
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
          <option value="<?= $val->id_agama ?>"><?= $val->agama; ?></option>
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
        <input class="form-check-input" type="radio" name="gender" value="Laki-laki" id="inlineRadio2" />
        <label class="form-check-label" for="inlineRadio2">Laki-Laki</label>
      </div>
      <div class="form-check form-check-inline ms-3">
        <input class="form-check-input" type="radio" id="inlineRadio3" name="gender" value="Perempuan" />
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
        <input class="form-check-input" type="radio" name="status" value="2" id="inlineRadio2" />
        <label class="form-check-label" for="inlineRadio2">PNS</label>
      </div>
      <div class="form-check form-check-inline ms-3">
        <input class="form-check-input" type="radio" id="inlineRadio3" name="status" value="3" />
        <label class="form-check-label" for="inlineRadio3">Honorer</label>
      </div>
    </div>
  </div>
</div>
</div>


<script>
  var tableGuru;

  function reload_table() {
    tableGuru.ajax.reload(null, false); //reload datatable ajax 
  }

  $('#nip').keyup(function() {
    var inputVal = $(this).val();
    $(this).val(inputVal.replace(/[^0-9]/g, ''));
  });

  $(function() {
    //ajax save
    $('#save').click(function() {
      var data = new FormData($('#form-guru')[0]);
      $.ajax({
        type: 'post',
        url: '<?= site_url('admin/DataGuru/saveGuru') ?>',
        contentType: false,
        processData: false,
        dataType: 'json',
        data: data,
        success: function(data) {
          console.log(data);
          if (data.status == true) {
            swal.fire({
              title: 'Tambah Guru',
              text: 'Guru berhasil ditambahkan',
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


  function userNameAvail() {
    var username = $('input[name="username"]').val();
    $.ajax({
      type: "post",
      url: "<?= site_url('admin/DataGuru/unameValid') ?>",
      data: {
        username: username
      },
      success: function(response) {
        if (username == '') {
          $('.uname').html('<b><i style="color:red">Username wajib diisi</i></b>');
        } else {
          if (response == true) {
            $('.uname').html('<b><i style="color:green">Username dapat digunakan</i></b>');
          } else {
            $('.uname').html('<b><i style="color:red">Username sudah terdaftar</i></b>');
          }

        }
      }
    });
  }

  function nipAvail() {
    var nip = $('input[name="nip"]').val();
    $.ajax({
      type: "post",
      url: "<?= site_url('admin/DataGuru/nipValid') ?>",
      data: {
        nip: nip
      },
      success: function(response) {
        if (nip == '') {
          $('.nip').html('<b><i style="color:red">Nip wajib diisi</i></b>');
        } else {
          if (nip.length < 18) {
            $('.nip').html('<b><i style="color:red">Nip tidak lengkap</i></b>');
          } else {
            if (response == true) {
              $('.nip').html('<b><i style="color:green">Nip dapat digunakan</i></b>');
            } else {
              $('.nip').html('<b><i style="color:red">Nip sudah terdaftar</i></b>');
            }
          }

        }
      }
    });
  }
</script>