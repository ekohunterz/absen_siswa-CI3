<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DataJurusan extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model(array('user_m', 'admin_m', 'kelas_m', 'siswa_m'));
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
      'content' => 'backend/admin/dataJurusan',
      'title'   => 'Data Jurusan',
      'profile' => $this->user_m->profile($id),
      'userdata' => $id
    ], FALSE);
  }

  public function saveJurusan()
  {
    $id = $this->session->userdata('id_user');
    $input = $this->input->post();
    $this->form_validation->set_rules('kode_jurusan', 'Kode Jurusan', 'required|is_unique[jurusan.kode_jurusan]');
    if ($this->form_validation->run() == FALSE) {
      $this->form_validation->set_message('is_unique', '%s sudah ada');
      echo json_encode(array('status' => FALSE));
    } else {
      $data = [
        'kode_jurusan' => $input['kode_jurusan'],
        'nama_jurusan' => $input['nama'],
        'keterangan' => $input['keterangan']
      ];

      $this->admin_m->saveJurusan($data);
      echo json_encode(['status' => TRUE]);
    }
  }

  public function saveEditJurusan()
  {
    $id = $this->session->userdata('id_user');
    $input = $this->input->post();
    $id_jurusan = $input['id'];
    $this->form_validation->set_rules('kode_jurusan2', 'Kode Jurusan', 'required');
    if ($this->form_validation->run() == FALSE) {
      $this->form_validation->set_message('is_unique', '%s sudah ada');
      echo json_encode(array('status' => FALSE));
    } else {
      $data = [
        'kode_jurusan' => $input['kode_jurusan2'],
        'nama_jurusan' => $input['nama2'],
        'keterangan' => $input['keterangan2']
      ];

      $this->admin_m->saveEditJurusan($data, $id_jurusan);
      echo json_encode(['status' => TRUE]);
    }
  }


  public function getJurusan()
  {
    $data = $this->admin_m->dataJurusan();
    $peg = [];
    $no = 1;
    foreach ($data as $jurusan) {
      $temp = [];
      $temp[] = htmlspecialchars($no++, ENT_QUOTES, 'UTF-8');
      $temp[] = htmlspecialchars($jurusan->kode_jurusan, ENT_QUOTES, 'UTF-8');
      $temp[] = htmlspecialchars($jurusan->nama_jurusan, ENT_QUOTES, 'UTF-8');
      $temp[] = htmlspecialchars($jurusan->keterangan, ENT_QUOTES, 'UTF-8');
      $temp[] = '<div class="dropdown">
                          <button type="button" id="aksi" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                            <i class="bx bx-dots-vertical-rounded"></i>
                          </button>
                          <div class="dropdown-menu">
                            <button type="button" id="btn-edit" class="dropdown-item btn-edit" data-bs-toggle="modal" data-id="' . $jurusan->id_jurusan . '" data-nama="' . $jurusan->nama_jurusan . '" data-kode="' . $jurusan->kode_jurusan . ' " data-keterangan="' . $jurusan->keterangan . '" data-bs-target="#modalUpdate"><i class="bx bx-edit-alt me-1"></i> Edit</button>
                            <a class="dropdown-item" href="javascript:void(0)" onclick="hapusJurusan(' . "'" . $jurusan->id_jurusan . "'" . ')"><i class="bx bx-trash me-1"></i> Hapus</a>
                          </div>
                        </div>';
      $peg[] = $temp;
    }

    $output['draw'] = intval($this->input->get('draw'));
    $output['recordsTotal'] = $this->admin_m->countAllJurusan();
    $output['recordsFiltered'] = $this->admin_m->filteredJurusan();
    $output['data'] = $peg;

    echo json_encode($output);
  }


  public function hapusJurusan($id)
  {
    $this->admin_m->hapusJurusan($id);
    echo json_encode(array("status" => TRUE));
  }
}

/* End of file DataSiswa.php */
