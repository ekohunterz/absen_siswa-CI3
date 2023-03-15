<div class="row">
  <div class="col-xxl">
    <div class="card mb-4">
      <div class="card-header d-flex align-items-center justify-content-between">
        <h5 class="mb-0">Ubah Password</h5>
        <small class="text-muted float-end">Ubah Password</small>
      </div>
      <div class="card-body">

        <form action="<?= site_url('admin/Profile/change_password') ?>" method="post" id="form-guru">
          <?php echo validation_errors(); ?>
          <?php echo $this->session->flashdata('success'); ?>
          <?php echo form_open(); ?>
          <input type="hidden" name="id_user" value="<?= $profile->id_user; ?>">
          <div class="mb-3 row">
            <label for="password-sekarang" class="col-md-2 col-form-label">Password Lama</label>
            <div class="col-md-10">
              <input class="form-control" type="password" name="password-sekarang" placeholder="Masukkan Password Saat Ini" id="password-sekarang" />
            </div>
          </div>
          <div class="mb-3 row">
            <label for="password-baru" class="col-md-2 col-form-label">Password Baru</label>
            <div class="col-md-10">
              <input class="form-control" type="password" name="password-baru" placeholder="Masukkan Password Baru" id="password-baru" />

            </div>
          </div>
          <div class="mb-3 row">
            <label for="password-confirm" class="col-md-2 col-form-label">Konfirmasi Password Baru</label>
            <div class="col-md-10">
              <input class="form-control" type="password" name="password-confirm" placeholder="Konfirmasi Password Baru" id="password-confirm" />
              <span id='message'></span>
            </div>
          </div>
          <div class="row justify-content-end">
            <div class="col-sm-10">
              <button type="submit" id="save" class="btn btn-success">Simpan</button>
            </div>
          </div>
          <?php echo form_close(); ?>
        </form>
      </div>
    </div>
  </div>
</div>

<script>
  $('#password-confirm').on('keyup', function() {
    if ($('#password-baru').val() == $('#password-confirm').val()) {
      $('#message').html('Password Sesuai').css('color', 'green');
    } else
      $('#message').html('Password Tidak Sesuai!').css('color', 'red');
  });
</script>