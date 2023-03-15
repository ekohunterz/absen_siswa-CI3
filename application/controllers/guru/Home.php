<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Home extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('user_m');
    $this->load->model('guru_m');
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
    if ($jadwal_mapel == 0) {
      $id_jadwal = 0;
    } else {
      $id_jadwal = $jadwal_mapel['id_jadwal'];
    }
    $this->load->view('backend/layouts/wrapper', [
      'content' => 'backend/guru/home',
      'title'   => 'Home',
      'jadwal' => $this->user_m->jadwal($id),
      'profile' => $this->user_m->profile($id),
      'jmlsiswa' => $this->guru_m->jmlsiswa(),
      'jmlkelas' => $this->guru_m->jmlkelas(),
      'userdata' => $id
    ], FALSE);
  }
}

/* End of file Home.php */
