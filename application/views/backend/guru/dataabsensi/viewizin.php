<div class="row detail">
    <div class="col-md-10 col-sm-8 col-6">
        <dl class="row">
            <dt class="col-sm-5">Alasan:</dt>
            <dd class="col-sm-7"><?= (empty($perizinan['alasan'])) ? ' - ' : $perizinan['alasan']; ?></dd>
            <dt class="col-sm-5">Tanggal Izin:</dt>
            <dd class="col-sm-7"><?= (empty($perizinan['tanggal_izin'])) ? ' - ' : $perizinan['tanggal_izin']; ?></dd>
            <dt class="col-sm-5">Keterangan Absen:</dt>
            <dd class="col-sm-7"><?= (empty($perizinan['keterangan'])) ? '-' : $perizinan['keterangan']; ?></dd>
        </dl>
    </div>
</div>
<div class="text-center">
    <h4 class="my-2">Bukti Pendukung</h4>
    <img class="img my-2 img-rounded" src="<?= (empty($perizinan['berkas']) == 'default-profile' ? base_url('assets/img/default-profile.png') : base_url('upload/photo/' . $perizinan['berkas'])); ?>" style="width:100%;">
</div>
