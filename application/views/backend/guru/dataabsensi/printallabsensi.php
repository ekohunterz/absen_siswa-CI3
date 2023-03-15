<div class="container">
    <div class="jumbotron shadow-lg">
        <div class="text-center">
            <img src="<?= (empty($dataapp['logo_instansi'])) ? FCPATH . 'assets/img/clock-image.png' : (($dataapp['logo_instansi'] == 'default-logo.png') ? FCPATH . 'assets/img/clock-image.png' : FCPATH . 'storage/setting/' . $dataapp['logo_instansi']); ?>" style="width:20%;">
            <h3>
                <?= (empty($dataapp['nama_instansi'])) ? '[Nama Instansi Belum Disetting]' : $dataapp['nama_instansi']; ?>
            </h3>
        </div>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th scope="col">No</th>
                <th scope="col">Nama Pegawai</th>
                <th scope="col">Tanggal Absen</th>
                <th scope="col">Jam Datang</th>
                <th scope="col">Jam Pulang</th>
                <th scope="col">Status Kehadiran</th>
                <th scope="col">Keterangan Absen</th>
                <th scope="col">Titik Lokasi Maps</th>
            </tr>
        </thead>
        <tbody>
            <?php
            $no = 1;
            foreach ($dataabsensi as $absen) : ?>
                <tr>
                    <th scope="row"><?= $no++; ?></th>
                    <td><?= $absen->nama_lengkap; ?></td>
                    <td><?= $absen->tanggal_presensi; ?></td>
                    <td><?= $absen->presensi_masuk; ?></td>
                    <td><?= (empty($absen->presensi_keluar)) ? 'Belum Absen Pulang' : $absen->presensi_keluar; ?></td>
                    <td><?= ($absen->status_pegawai == 1) ? 'Sudah Absen' : (($absen->status_pegawai == 2) ? 'Absen Terlambat' : 'Belum Absen'); ?></td>
                    <td><?= $absen->tipe; ?></td>
                </tr>
            <?php endforeach; ?>
        </tbody>
    </table>
    <div class="small">
        PDF was generated on <?= date("Y-m-d H:i:s"); ?>
    </div>
</div>