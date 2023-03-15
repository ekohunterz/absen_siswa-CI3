<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kelas extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model(array('user_m', 'admin_m', 'kelas_m'));
    $this->load->library('form_validation');
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

    $this->load->view('backend/layouts/wrapper', [
      'content' => 'backend/admin/kelas',
      'title'   => 'Kelas',
      'profile' => $this->user_m->profile($id),
      'jurusan' => $this->admin_m->dataJurusan(),
      'userdata' => $id
    ], FALSE);
  }

  public function saveKelas()
  {
    $id = $this->session->userdata('id_user');
    $input = $this->input->post();
    $this->form_validation->set_rules('kelas', 'Kelas', 'required|is_unique[kelas.kelas]');
    if ($this->form_validation->run() == FALSE) {
      $this->form_validation->set_message('is_unique', '%s sudah ada');
      echo json_encode(array('status' => FALSE));
    } else {
      $data = [
        'kelas' => $input['kelas'],
        'jurusan' => $input['jurusan']
      ];

      $this->kelas_m->saveKelas($data);
      echo json_encode(['status' => TRUE]);
    }
  }

  public function getKelas()
  {
    $data = $this->kelas_m->dataKelas();
    $peg = [];
    $no = 1;
    foreach ($data as $pegKelas) {
      $temp = [];
      $temp[] = htmlspecialchars($no++, ENT_QUOTES, 'UTF-8');
      $temp[] = htmlspecialchars($pegKelas->kelas, ENT_QUOTES, 'UTF-8');
      $temp[] = htmlspecialchars($pegKelas->jurusan, ENT_QUOTES, 'UTF-8');
      // if ($pegKelas->id_user == 0) {
      //   $temp[] = '<span class="badge "><i>' . htmlspecialchars('Belum Tersedia', ENT_QUOTES, 'UTF-8') . '</i></span>';
      // } else {
      //   $temp[] = '<span class="badge bg-green"><i>' . htmlspecialchars($pegKelas->nama, ENT_QUOTES, 'UTF-8') . '</i></span>';
      // }
      $temp[] = '<div class="dropdown">
                          <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                            <i class="bx bx-dots-vertical-rounded"></i>
                          </button>
                          <div class="dropdown-menu">
                            <button type="button" id="btn-edit" class="dropdown-item btn-edit" data-bs-toggle="modal" data-id="' . $pegKelas->id_kelas . '" data-nama="' . $pegKelas->kelas . '" data-jurusan="' . $pegKelas->jurusan . '"  data-bs-target="#modalUpdate"><i class="bx bx-edit-alt me-1"></i> Edit</button>
                            <a class="dropdown-item" href="javascript:void(0)" onclick="hapusKelas(' . "'" . $pegKelas->id_kelas . "'" . ')"
                              ><i class="bx bx-trash me-1"></i> Hapus</a
                            >
                          </div>
                        </div>';
      $peg[] = $temp;
    }

    $output['draw'] = intval($this->input->get('draw'));
    $output['recordsTotal'] = $this->kelas_m->countAll();
    $output['recordsFiltered'] = $this->kelas_m->filtered();
    $output['data'] = $peg;

    echo json_encode($output);
  }

  public function hapusKelas($id)
  {
    $this->kelas_m->hapusKelas($id);
    echo json_encode(array("status" => TRUE));
  }

  public function saveEditKelas()
  {
    $id = $this->session->userdata('id_user');
    $input = $this->input->post();
    $id_kelas = $input['id_kelas'];
    $this->form_validation->set_rules('kelas2', 'Nama Jurusan', 'required');
    if ($this->form_validation->run() == FALSE) {
      echo json_encode(array('status' => FALSE));
    } else {
      $data = [
        'jurusan' => $input['jurusan2'],
        'kelas' => $input['kelas2']
      ];
      $this->kelas_m->saveEditKelas($data, $id_kelas);
      echo json_encode(['status' => TRUE]);
    }
  }
}

/* End of file Controllername.php */
