<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DataKehadiran extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model(array('user_m', 'kelas_m', 'absensi_m', 'siswa_m', 'guru_m', 'mapel_m'));
    if ($this->session->userdata('is_login') !== TRUE || $this->session->userdata('tipe') != 88) {
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
    $id_kelas = $this->input->post('kelas');
    $date = $this->input->post('tgl');
    $tanggal = strtotime($date);
    $mapel = $this->input->post('mapel');
    $no = 1;
    $this->load->view('backend/layouts/wrapper', [
      'content' => 'backend/guru/dataHadir',
      'title' => 'Data Absensi',
      'profile' => $this->user_m->profile($id),
      'kelas' => $this->kelas_m->getKelasRekap($id),
      'jadwal' => $this->mapel_m->getJadwal($id, $id_kelas),
      'siswa' => $this->absensi_m->getSiswaAbsen($id_kelas, $tanggal, $mapel, $id),
      'absensi' => $this->absensi_m->getRekap($id_kelas, $tanggal, $mapel, $id),
      'userdata' => $id,
      'id_kelas' => $id_kelas
    ], FALSE);
  }


  public function export()
  {
    $id_kelas = $this->input->post('kelas');
    $date = $this->input->post('tgl');
    $tanggal = strtotime($date);
    $mapel = $this->input->post('mapel');
    $querydata = $this->db->select('*')
      ->from('absensi a')
      ->join('siswa s', 'a.id_siswa = s.id_siswa')
      ->join('kelas k', 'a.id_kelas = k.id_kelas')
      ->like('a.time_in', $tanggal)
      ->where('a.id_kelas', $id_kelas)->get()->result();

    $querydata1 = $this->db->select("m.nama_mapel, k.kelas")
      ->from('absensi a')
      ->join('kelas k', 'a.id_kelas = k.id_kelas')
      ->join('jadwal j', 'a.id_mapel = j.id_mapel')
      ->join('mapel m', 'j.id_mapel = m.id_mapel')
      ->where('a.id_kelas', $id_kelas)
      ->where('a.id_mapel', $mapel)->get()->row_array();


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
    $sheet->setCellValue('A1', 'Rekap Data Absensi');
    $sheet->mergeCells('A1:G2');
    $sheet->getStyle('A1')->applyFromArray($styleJudul);
    $sheet->setCellValue('A3', 'Excel was generated on ' . date("Y-m-d H:i:s") . '');
    $sheet->setCellValue('A4', 'Mata Pelajaran: ' . $datamapel['nama_mapel'] . '');
    $sheet->setCellValue('D4', 'Kelas: ' . $datamapel['kelas'] . '');
    $sheet->mergeCells('A3:G3');
    $sheet->getStyle('A3')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);

    $sheet->setCellValue('A5', 'No');
    $sheet->setCellValue('B5', 'Nama Lengkap');
    $sheet->setCellValue('C5', 'Tanggal Absen');
    $sheet->setCellValue('D5', 'Kelas');
    $sheet->setCellValue('E5', 'Semester');
    $sheet->setCellValue('F5', 'Tahun Ajaran');
    $sheet->setCellValue('G5', 'Keterangan Absen');
    $sheet->setCellValue('I5', 'Data Rekap');
    $sheet->mergeCells('I5:M5');
    $sheet->setCellValue('I6', 'Hadir');
    $sheet->setCellValue('J6', 'Sakit');
    $sheet->setCellValue('K6', 'Izin');
    $sheet->setCellValue('L6', 'Alpha');
    $sheet->setCellValue('M6', 'Jumlah Tidak Hadir');

    $dataabsensi = $querydata;
    $no = 1;
    $rowx = 6;

    foreach ($dataabsensi as $rowabsen) {
      $sheet->setCellValue('A' . $rowx, $no++);
      $sheet->setCellValue('B' . $rowx, $rowabsen->nama);
      $sheet->setCellValue('C' . $rowx, $rowabsen->tanggal_absen);
      $sheet->setCellValue('D' . $rowx, $rowabsen->kelas);
      $sheet->setCellValue('E' . $rowx, $rowabsen->semester);
      $sheet->setCellValue('F' . $rowx, $rowabsen->tahun_ajaran);
      $sheet->setCellValue('G' . $rowx, $rowabsen->keterangan);
      $rowx++;
    }
    $sheet->setCellValue('I7', '=COUNTIF(G6:F1000,"Hadir")');
    $sheet->setCellValue('J7', '=COUNTIF(G6:F1000,"Sakit")');
    $sheet->setCellValue('K7', '=COUNTIF(G6:F1000,"Izin")');
    $sheet->setCellValue('L7', '=COUNTIF(G6:F1000,"Alpha")');
    $sheet->setCellValue('M7', '=SUM(J7:L7)');
    $sheet->getStyle('A5:N5')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('I6:N6')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_CENTER);
    $sheet->getStyle('I7:N7')->getAlignment()->setHorizontal(\PhpOffice\PhpSpreadsheet\Style\Alignment::HORIZONTAL_LEFT);
    $spreadsheet->getActiveSheet()->getColumnDimension('A')->setWidth(5);
    $spreadsheet->getActiveSheet()->getColumnDimension('B')->setWidth(30);
    $spreadsheet->getActiveSheet()->getColumnDimension('C')->setWidth(28);
    $spreadsheet->getActiveSheet()->getColumnDimension('D')->setWidth(20);
    $spreadsheet->getActiveSheet()->getColumnDimension('E')->setWidth(20);
    $spreadsheet->getActiveSheet()->getColumnDimension('F')->setWidth(20);
    $spreadsheet->getActiveSheet()->getColumnDimension('G')->setWidth(20);
    $spreadsheet->getActiveSheet()->getColumnDimension('I')->setWidth(10);
    $spreadsheet->getActiveSheet()->getColumnDimension('J')->setWidth(10);
    $spreadsheet->getActiveSheet()->getColumnDimension('K')->setWidth(10);
    $spreadsheet->getActiveSheet()->getColumnDimension('L')->setWidth(10);
    $spreadsheet->getActiveSheet()->getColumnDimension('M')->setWidth(20);



    $writer = new PhpOffice\PhpSpreadsheet\Writer\Xlsx($spreadsheet);
    $filename = "absensisiswa_" . time()  . "_download";

    header('Content-Type: application/vnd.ms-excel');
    header('Content-Disposition: attachment;filename="' . $filename . '.xlsx"');
    header('Cache-Control: max-age=0');
    ob_end_clean();
    $writer->save('php://output');
  }

  function get_jadwal()
  {
    $id = $this->session->userdata('id_user');
    $id_kelas = $this->input->post('id', TRUE);
    $data = $this->mapel_m->getJadwal($id, $id_kelas);
    echo json_encode($data);
  }
}

/* End of file Absensi.php */
