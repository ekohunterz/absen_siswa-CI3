<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jadwal extends CI_Controller
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
    $smt = $this->input->post('smt');
    $tahun = $this->input->post('thn');
    $no = 1;
    // echo $id_kelas;
    // // die();
    $this->load->view('backend/layouts/wrapper', [
      'content' => 'backend/guru/dataJadwal',
      'title' => 'Jadwal Mengajar',
      'tahun' => $this->user_m->dataTahun(),
      'profile' => $this->user_m->profile($id),
      'kelas' => $this->kelas_m->getKelas(),
      'userdata' => $id
    ], FALSE);
  }

  public function getJadwal()
  {
    $data = $this->mapel_m->dataJadwal();
    $peg = [];
    $no = 1;
    foreach ($data as $pegMapel) {
      $temp = [];
      $temp[] = htmlspecialchars($no++, ENT_QUOTES, 'UTF-8');
      $temp[] = htmlspecialchars($pegMapel->hari, ENT_QUOTES, 'UTF-8');
      $temp[] = htmlspecialchars($pegMapel->nama_mapel, ENT_QUOTES, 'UTF-8');
      $temp[] = htmlspecialchars($pegMapel->kelas, ENT_QUOTES, 'UTF-8');
      $temp[] = htmlspecialchars($pegMapel->nama, ENT_QUOTES, 'UTF-8');
      $temp[] = htmlspecialchars($pegMapel->jam_mulai, ENT_QUOTES, 'UTF-8');
      $temp[] = htmlspecialchars($pegMapel->jam_selesai, ENT_QUOTES, 'UTF-8');
      $temp[] = htmlspecialchars($pegMapel->semester, ENT_QUOTES, 'UTF-8');
      $temp[] = htmlspecialchars($pegMapel->tahun_ajaran, ENT_QUOTES, 'UTF-8');
      $peg[] = $temp;
    }

    $output['draw'] = intval($this->input->get('draw'));
    $output['recordsTotal'] = $this->mapel_m->countAllJadwal();
    $output['recordsFiltered'] = $this->mapel_m->filteredJadwal();
    $output['data'] = $peg;

    echo json_encode($output);
  }
}

/* End of file Absensi.php */
