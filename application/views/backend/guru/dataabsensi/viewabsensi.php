<div class="row detail">
    <div class="col-md-10 col-sm-8 col-6">
        <dl class="row">
            <dt class="col-sm-5">Nama Siswa:</dt>
            <dd class="col-sm-7"><?= (empty($dataabsensi['nama'])) ? ' - ' : $dataabsensi['nama']; ?></dd>
            <dt class="col-sm-5">Kode Absensi:</dt>
            <dd class="col-sm-7"><?= (empty($dataabsensi['kode_absen'])) ? ' - ' : $dataabsensi['kode_absen']; ?></dd>
            <dt class="col-sm-5">Tanggal Absen:</dt>
            <dd class="col-sm-7"><?= (empty($dataabsensi['tanggal_presensi'])) ? ' - ' : $dataabsensi['tanggal_presensi']; ?></dd>
            <dt class="col-sm-5">Waktu Datang:</dt>
            <dd class="col-sm-7"><?= (empty($dataabsensi['presensi_masuk'])) ? 'Belum Absen' : $dataabsensi['presensi_masuk']; ?></dd>
            <dt class="col-sm-5">Waktu Pulang:</dt>
            <dd class="col-sm-7"><?= (empty($dataabsensi['presensi_keluar'])) ? 'Belum Absen Pulang' : $dataabsensi['presensi_keluar']; ?></dd>
            <dt class="col-sm-5">Status Kehadiran:</dt>
            <dd class="col-sm-7"><?= (empty($dataabsensi['status_absen'])) ? '<span class="badge badge-success">Belum Absen</span>' : (($dataabsensi['status_absen'] == 2) ? '<span class="badge badge-danger">Absen Terlambat</span>' : '<span class="badge badge-primary">Sudah Absen</span>'); ?></dd>
        </dl>
    </div>
</div>
<div class="text-center">
    <dt class="col-sm-6">
    <h4 class="my-2">Selfie</h4>
    <img class="img my-2 img-rounded" src="<?= (empty($dataabsensi['selfy']) == 'default-profile' ? base_url('assets/img/default-profile.png') : base_url('upload/photo/' . $dataabsensi['selfy'])); ?>" style="width:40%;">
    </dt>
    <dd class="col-sm-6">
    <h4 class="my-2">Selfie Pulang</h4>
    <img class="img my-2 img-rounded" src="<?= (empty($dataabsensi['selfy_pulang']) == 'default-profile' ? base_url('assets/img/default-profile.png') : base_url('upload/photo/' . $dataabsensi['selfy_pulang'])); ?>" style="width:40%;">
    </dd>
</div>
