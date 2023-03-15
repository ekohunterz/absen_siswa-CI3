<section class="content">
  <div class="box box-primary">
    <div class="box-header with-border">
      <h1 class="box-title">Selamat Datang, <?= $profile->nama; ?></h1>
    </div>
    <!-- /.box-header -->
    <div class="box-body">
      <div class="col-lg-12 col-md-12 order-1">
        <div class="row">
          <div class="col-lg-6 col-md-12 col-6 mb-4">
            <div class="card">
              <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between">
                  <div class="avatar flex-shrink-0 me-3">
                    <span class="avatar-initial rounded bg-label-success"><i class="bx bx-user"></i></span>
                  </div>
                  <div class="dropdown">
                    <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                      <a class="dropdown-item" href="<?= base_url('gr/data-siswa'); ?>">Lihat Selengkapnya</a>
                    </div>
                  </div>
                </div>
                <span class="fw-semibold d-block mb-1">Jumlah Siswa</span>
                <h3 class="card-title mb-2"><?= $jmlsiswa ?></h3>
                <span class="fw-semibold text-success d-block">Siswa</span>
              </div>
            </div>
          </div>
          <div class="col-lg-6 col-md-12 col-6 mb-4">
            <div class="card">
              <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between">
                  <div class="avatar flex-shrink-0 me-3">
                    <span class="avatar-initial rounded bg-label-danger"><i class="bx bx-building"></i></span>
                  </div>
                </div>
                <span class="fw-semibold d-block mb-1">Jumlah Kelas</span>
                <h3 class="card-title mb-2"><?= $jmlkelas ?></h3>
                <span class="fw-semibold text-danger d-block">Kelas</span>
              </div>
            </div>
          </div>
          <div class="col-lg-6 col-md-12 col-6 mb-4">
            <div class="card">
              <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between">
                  <div class="avatar flex-shrink-0 me-3">
                    <span class="avatar-initial rounded bg-label-primary"><i class="bx bx-time"></i></span>
                  </div>
                  <div class="dropdown">
                    <button class="btn p-0" type="button" id="cardOpt3" data-bs-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <i class="bx bx-dots-vertical-rounded"></i>
                    </button>
                    <div class="dropdown-menu dropdown-menu-end" aria-labelledby="cardOpt3">
                      <a class="dropdown-item" href="<?= base_url('gr/absensi'); ?>">Absen Sekarang</a>
                    </div>
                  </div>
                </div>
                <span class="fw-semibold d-block mb-1">Jadwal Sekarang</span>
                <h3 class="card-title mb-2"><?= (empty($jadwal['nama_mapel'])) ? 'Tidak Ada Jadwal' : $jadwal['nama_mapel']; ?></h3>
                <span class="fw-semibold text-primary d-block"><?= (empty($jadwal['nama_mapel'])) ? '-' : $jadwal['jam_mulai'] . "-" . $jadwal['jam_selesai']; ?></span>
              </div>
            </div>
          </div>
          <div class="col-lg-6 col-md-12 col-6 mb-4">
            <div class="card">
              <div class="card-body">
                <div class="card-title d-flex align-items-start justify-content-between">
                  <div class="avatar flex-shrink-0 me-3">
                    <span class="avatar-initial rounded bg-label-alert"><i class="bx bx-time-five"></i></span>
                  </div>
                </div>
                <span class="fw-semibold d-block mb-1">Hari ini</span>
                <h3 id="clocknow" class="card-title mb-2">-</h3>
                <span id="datenow" class="fw-semibold d-block">-</span>
              </div>
            </div>
          </div>

        </div>
        <!-- /.box-body -->
      </div>
</section>

<script type="text/javascript">
  var span = document.getElementById('clocknow');

  function time() {
    var d = new Date();
    var s = d.getSeconds();
    var m = d.getMinutes();
    var h = d.getHours();
    span.textContent =
      ("0" + h).substr(-2) + ":" + ("0" + m).substr(-2) + ":" + ("0" + s).substr(-2);
  }

  setInterval(time, 1000);
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