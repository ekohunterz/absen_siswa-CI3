<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Absensi extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->helper('url');
    $bulan = array(1 => "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
    $hari = array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu");
    $this->get_today_date = $hari[(int)date("w")] . ', ' . date("j ") . $bulan[(int)date('m')] . date(" Y");
    $this->load->model(array('user_m', 'kelas_m', 'siswa_m', 'guru_m'));
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
    $jadwal_mapel = $this->user_m->jadwal($id);
    $jadwal = $this->input->post('kelas');

    if ($jadwal == false) {
      if ($jadwal_mapel == 0) {
        $jadwal = 0;
      } else {
        $jadwal = $jadwal_mapel['id_jadwal'];
      }
    }

    $no = 1;
    // echo $id_kelas;
    // // die();
    $this->load->view('backend/layouts/wrapper', [
      'content' => 'backend/guru/presensi',
      'title' => 'Absensi',
      'profile' => $this->user_m->profile($id),
      'jadwal' => $this->user_m->jadwal($id),
      'kelas' => $this->kelas_m->getKelasFilter($id),
      'siswa' => $this->siswa_m->getSiswaAbsen($jadwal),
      'userdata' => $id,
      'id_jadwal' => $jadwal
    ], FALSE);
  }


  public function saveAbsensi()
  {
    $id = $this->session->userdata('id_user');
    $today = $this->get_today_date;
    $input = $this->input->post();
    $kode = $input['kode_absen'];
    $id_kelas = $input['id_kelas'];
    $index = 0;
    foreach ($input['id_siswa'] as $key => $val) {
      // array_push($data, [
      // $time = array(time());
      $data = [
        'id_siswa' => $input['id_siswa'][$key],
        'id_absen' => $input['kode_absen'][$key],
        'id_mapel' => $input['id_mapel'],
        'id_guru' => $id,
        'tanggal_absen' => $today,
        'id_kelas' => $input['id_kelas'],
        'time_in' => strtotime(date("Y-m-d")),
        'tanggal' => date("d"),
        'bulan' => date("m"),
        'tahun' => date("Y"),
        'semester' => $input['semester'],
        'tahun_ajaran' => $input['tahun_ajaran'],
        'keterangan' => $input['keterangan'][$key]
      ];
      // $index++;
      // $json = json_encode($data);
      // echo $json;
      // var_dump($data);

      $this->guru_m->saveAbsen($data);
      $this->session->set_flashdata('success', 'Absensi berhasil disimpan');
      echo json_encode(['status' => TRUE]);
    }
  }
}

/* End of file Absensi.php */
