<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DataRekap extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model(array('user_m', 'absensi_m', 'kelas_m', 'mapel_m', 'siswa_m'));
    if ($this->session->userdata('is_login') !== TRUE || $this->session->userdata('tipe') != 99) {
      $this->session->set_flashdata('failed', '<div class="alert alert-danger" role="alert">
                                       Maaf, Anda harus login!
                                       </div>');
      redirect('login');
    }
    //Do your magic here
  }

  public function index()
  {
    $id = $this->session->userdata('id_user');
    $kelas = $this->input->post('kelas');
    $bulan = $this->input->post('smt');
    $tahun = $this->input->post('thn');
    $mapel = $this->input->post('mapel');
    $data = [
      'content' => 'backend/admin/dataRekap',
      'title'   => 'Rekap Absensi',
      'profile' => $this->user_m->profile($id),
      'userdata' => $id,
      'jadwal' => $this->mapel_m->getMapelByKelas($kelas),
      'tahun' => $this->user_m->dataTahun(),
      'siswa' => $this->absensi_m->getLaporanPerSiswaAdmin($kelas, $bulan, $tahun, $mapel),
      'absensi' => $this->absensi_m->getLaporanPerKelasAdmin($kelas, $mapel),
      'kelas' => $this->kelas_m->getKelas(),
      'kelask' => $kelas
    ];
    $this->load->view('backend/layouts/wrapper', $data, FALSE);
    // die();
    // $kelas = 2;
    // $mapel = 1;
  }

  public function cetakrekap()
  {
    $id_kelas = $this->input->post('kelas');
    $smt = $this->input->post('smt');
    $tahun_ajaran = $this->input->post('thn');
    $mapel = $this->input->post('mapel');

    $querydata = $this->db->select("count(case when a.keterangan = 'Sakit' then 1 else null end) as tSakit,
              count(case when a.keterangan = 'Izin' then 1 else null end) as tIjin,
              count(case when a.keterangan = 'Hadir' then 1 else null end) as tHadir,
              count(case when a.keterangan != 'Hadir' then 1 else null end) as total,
              count(case when a.keterangan = 'Alpha' then 1 else null end) as tAlpha,s.nama,s.id_siswa,s.nis, j.nama_mapel")
      ->from('absensi a')
      ->join('siswa s', 'a.id_siswa = s.id_siswa')
      ->join('jadwal j', 'a.id_mapel = j.id_mapel')
      ->like('a.semester', $this->input->post('smt'))
      ->like('a.tahun_ajaran', $this->input->post('thn'))
      ->where('a.id_kelas', $id_kelas)
      ->where('a.id_mapel', $mapel)
      ->group_by("s.nama")->get()->result();

    $querydata1 = $this->db->select("j.nama_mapel, k.kelas")
      ->from('absensi a')
      ->join('kelas k', 'a.id_kelas = k.id_kelas')
      ->join('jadwal j', 'a.id_mapel = j.id_mapel')
      ->where('a.id_kelas', $id_kelas)
      ->where('a.id_mapel', $mapel)->get()->row_array();


    //$querydata = $this->db->query('SELECT siswa.nama,  siswa.nis, absensi.*  FROM siswa LEFT JOIN absensi on absensi.id_siswa = siswa.id_siswa WHERE absensi.tanggal = "'.$tanggal.'" AND absensi.bulan = "'.$bulan.'" AND absensi.tahun = "'.$tahun.'" AND siswa.id_kelas= "'.$id_kelas.'"')->result();
    //$querydata = $this->db->join('siswa', 'siswa.id_siswa = absensi.id_siswa')->like('absensi.tanggal', htmlspecialchars($this->input->post('tgl', true)))->like('absensi.bulan', htmlspecialchars($this->input->post('bulan', true)))->like('absensi.tahun', htmlspecialchars($this->input->post('tahun', true)))->get_where('absensi', ['absensi.id_kelas' => htmlspecialchars($this->input->post('kelas', true))])->result();

    $spreadsheet = new PhpOffice\PhpSpreadsheet\Spreadsheet();
    $sheet = $spreadsheet->getActiveSheet();

    $styleJudul = [
      'font' => [
        'bold' => true,
        'size' => 15,
      ],
      'alignment' => [
        'vertical' => \PhpOffice\PhpSpreadsheet\Style\Alignment::VERTICAL_CENTER,
        'horizontal' => \PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER,
        'wrap' => true,
      ],
    ];
    $datamapel = $querydata1;
    $sheet->setCellValue('A1', 'Rekap Data Absensi: SMK Negeri 4 Kota Serang');
    $sheet->mergeCells('A1:H2');
    $sheet->getStyle('A1')->applyFromArray($styleJudul);
    $sheet->setCellValue('A3', 'Excel was generated on ' . date("Y-m-d H:i:s") . '');
    $sheet->setCellValue('A4', 'Mata Pelajaran: ' . $datamapel['nama_mapel'] . '');
    $sheet->setCellValue('D4', 'Kelas: ' . $datamapel['kelas'] . '');
    $sheet->mergeCells('A3:H3');
    $sheet->getStyle('A3')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

    $sheet->setCellValue('A5', 'No');
    $sheet->setCellValue('B5', 'Nama Lengkap');
    $sheet->setCellValue('C5', 'Semester/Tahun Ajaran');
    $sheet->setCellValue('D5', 'Hadir');
    $sheet->setCellValue('E5', 'Sakit');
    $sheet->setCellValue('F5', 'Izin');
    $sheet->setCellValue('G5', 'Alpha');
    $sheet->setCellValue('H5', 'Total Tidak Hadir');
    $sheet->setCellValue('M5', 'Data Rekap');
    $sheet->mergeCells('M5:Q5');
    $sheet->setCellValue('M6', 'Hadir');
    $sheet->setCellValue('N6', 'Sakit');
    $sheet->setCellValue('O6', 'Izin');
    $sheet->setCellValue('P6', 'Alpha');
    $sheet->setCellValue('Q6', 'Jumlah Tidak Hadir');

    $dataabsensi = $querydata;

    $no = 1;
    $rowx = 6;

    foreach ($dataabsensi as $rowabsen) {
      $sheet->setCellValue('A' . $rowx, $no++);
      $sheet->setCellValue('B' . $rowx, $rowabsen->nama);
      $sheet->setCellValue('C' . $rowx, $smt . ', ' . $tahun_ajaran);
      $sheet->setCellValue('D' . $rowx, $rowabsen->tHadir);
      $sheet->setCellValue('E' . $rowx, $rowabsen->tSakit);
      $sheet->setCellValue('F' . $rowx, $rowabsen->tIjin);
      $sheet->setCellValue('G' . $rowx, $rowabsen->tAlpha);
      $sheet->setCellValue('H' . $rowx, $rowabsen->total);
      $rowx++;
    }
    $sheet->setCellValue('M7', '=SUM(D6:D50)');
    $sheet->setCellValue('N7', '=SUM(E6:E50)');
    $sheet->setCellValue('O7', '=SUM(F6:F50)');
    $sheet->setCellValue('P7', '=SUM(G6:G50)');
    $sheet->setCellValue('Q7', '=SUM(N7:Q7)');
    $sheet->getStyle('A5:Q5')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('M6:Q6')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('M7:Q7')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(5);
    $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(30);
    $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(20);
    $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(10);
    $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(10);
    $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(10);
    $spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(10);
    $spreadsheet->getActiveSheet()->getColumnDimension('H')->setWidth(20);
    $spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(10);
    $spreadsheet->getActiveSheet()->getColumnDimension('J')->setWidth(10);
    $spreadsheet->getActiveSheet()->getColumnDimension('K')->setWidth(10);
    $spreadsheet->getActiveSheet()->getColumnDimension('L')->setWidth(10);
    $spreadsheet->getActiveSheet()->getColumnDimension('M')->setWidth(10);
    $spreadsheet->getActiveSheet()->getColumnDimension('N')->setWidth(10);
    $spreadsheet->getActiveSheet()->getColumnDimension('O')->setWidth(10);
    $spreadsheet->getActiveSheet()->getColumnDimension('P')->setWidth(10);
    $spreadsheet->getActiveSheet()->getColumnDimension('Q')->setWidth(20);



    $writer = new PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
    $filename = "rekapabsensisiswa_" . time()  . "_download";

    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
    header('Cache-Control: max-age=0');
    ob_end_clean();
    $writer->save('php://output');
  }

  function get_jadwal()
  {
    $id_kelas = $this->input->post('id', TRUE);
    $data = $this->mapel_m->getMapelByKelas($id_kelas);
    echo json_encode($data);
  }
}

/* End of file DataRekap.php */
