<section class="content">
  <div class="box box-danger">
    <div class="box-header with-border">
      <h3 class="box-title">Edit Pengaturan</h3>

      <div class="box-tools pull-right">
        <button type="button" class="btn btn-box-tool" data-widget="collapse"><i class="fa fa-minus"></i></button>
      </div>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <form action="" method="post" id="form-siswa">
        <div class="form-group row">
          <label for="nis" class=" col-sm-2">Latitude</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="latitude" id="latitude" placeholder="Laitude" value="<?= $dataapp['latitude']; ?>">
            <small class="nis"></small>
          </div>
        </div>
        <div class="form-group row">
          <label for="nama" class=" col-sm-2">Longitude</label>
          <div class="col-sm-10">
            <input type="text" class="form-control" name="longitude" placeholder="Longitude" value="<?= $dataapp['longitude']; ?>">
          </div>
        </div>
        <div class="form-group row">
          <label for="no_hp" class=" col-sm-2">Jam Masuk</label>
          <div class="col-sm-10">
            <input type="time" class="form-control" name="jam_masuk" placeholder="" value="<?= $dataapp['absen_mulai']; ?>">
          </div>
        </div>

        <div class="form-group row">
          <label for="alamat" class=" col-sm-2">Batas Jam Masuk</label>
          <div class="col-sm-10">
            <input type="time" class="form-control" name="batas_jam_masuk" placeholder="" value="<?= $dataapp['absen_mulai_to']; ?>">
          </div>
        </div>
        <div class="form-group row">
          <div class="col-sm-12 d-flex justify-content-center">
            <div class="col-sm-2 ">
              <a class="btn btn-success btn-block " id="save">Simpan <i class="fa fa-send"></i></a>
              <!-- <button class="btn btn-success btn-block">Save</button> -->
            </div>
          </div>
        </div>
      </form>
    </div>
    <!-- /.box-body -->
  </div>

  <!-- ============================= -->

</section>
<script>
  //siswa borndate

  $(function() {
    //ajax save
    $('#save').click(function() {
      var data = new FormData($('#form-siswa')[0]);
      $.ajax({
        type: 'post',
        url: '<?= site_url('admin/Pengaturan/saveEdit') ?>',
        contentType: false,
        processData: false,
        dataType: 'json',
        data: data,
        success: function(data) {
          console.log(data);
          if (data.status == true) {
            swal.fire({
              title: 'Pengaturan',
              text: 'Pengaturan Berhasil Disimpan',
              icon: 'success'
            }).then(function() {
              window.location = "<?= site_url('admin/Pengaturan'); ?>";
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