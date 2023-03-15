<div class="row">
  <!-- Layout Demo -->
  <div class="col-md-12">
    <div class="card mb-4">
      <h5 class="card-header">Absen</h5>
      <center>
        <form method="post">
          <div class="card-body">
            <div class="mb-3">
              <label for="kelas" class="form-label">Pilih Kelas</label>
              <select style="width:30%" class="form-select" id="kelas" aria-label="Pilih Kelas" name="kelas">
                <option value="" selected>--Pilih Kelas--</option>
                <?php foreach ($kelas as $val) :
                  if ($this->input->post('kelas') == $val->id_kelas) {
                    $selected = "selected";
                  } else {
                    $selected = '';
                  }
                ?>
                  <option value="<?= $val->id_kelas ?>" <?= $selected ?>><?= $val->kelas; ?> - <?= $val->nama_mapel; ?></option>
                <?php endforeach; ?>
              </select>
            </div>
            <div id="floatingInputHelp" class="form-text">
              <button class="btn btn-success">Pilih</button>
            </div>
          </div>
        </form>
      </center>
      <?php if ($this->session->flashdata('success')) : ?>
        <div class="alert alert-success" role="alert">
          <?php echo $this->session->flashdata('success'); ?>
        </div>
      <?php endif; ?>
      <h5 class="card-header">List Siswa</h5>
      <div class="card-body">
        <div class="mb-3">
          <div class="table-responsive text-nowrap">
            <form method="post" id="absen">
              <table class="table table-hover" id="list-absen">
                <thead>
                  <th>No</th>
                  <th>Tanggal</th>
                  <th>Nama</th>
                  <th>NIS</th>
                  <th>Keterangan</th>
                </thead>
              </table>
          </div>
          <br>

          <?php if ($this->input->post('kelas') == "") { ?>
            <button class="btn btn-primary" data-toggle="tooltip" data-placement="top" title="Pilih kelas dahulu" disabled>Absen</button>
          <?php } else { ?>
            <button id="verif" class="btn btn-primary">Absen</button>
          <?php } ?>

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
              window.location = "<?= site_url('guru/datakehadiran'); ?>";
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

  var tableSiswa;

  function reload_table() {
    tableSiswa.ajax.reload(null, false); //reload datatable ajax 
  }

  $(document).ready(function() {
    tableSiswa = $('#list-absen').DataTable({

      "processing": true,
      "serverSide": true,
      "scrollX": true,
      "autoWidth": true,
      // "scrollY": "200px",
      "order": [],
      "ajax": {
        url: "<?= site_url('admin/Absensi/getSiswaAbsen') ?>",
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
</script>

<script>
  $(document).ready(function() {
    $('#list-absen').DataTable();
  });
</script>