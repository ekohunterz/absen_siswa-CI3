<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mapel extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model(array('user_m', 'admin_m', 'mapel_m'));
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
      'content' => 'backend/admin/mapel',
      'title'   => 'Mata Pelajaran',
      'profile' => $this->user_m->profile($id),
      'jurusan' => $this->admin_m->dataJurusan(),
      'userdata' => $id
    ], FALSE);
  }

  public function saveMapel()
  {
    $id = $this->session->userdata('id_user');
    $input = $this->input->post();
    $this->form_validation->set_rules('mapel', 'Mata Pelajaran', 'required|is_unique[mapel.nama_mapel]');
    if ($this->form_validation->run() == FALSE) {
      $this->form_validation->set_message('is_unique', '%s sudah ada');
      echo json_encode(array('status' => FALSE));
    } else {
      $data = [
        'nama_mapel' => $input['mapel'],
        'kode_jurusan' => $input['jurusan'],
        'keterangan' => $input['keterangan']
      ];

      $this->mapel_m->saveMapel($data);
      echo json_encode(['status' => TRUE]);
    }
  }

  public function getMapel()
  {
    $data = $this->mapel_m->dataMapel();
    $peg = [];
    $no = 1;
    foreach ($data as $pegMapel) {
      $temp = [];
      $temp[] = htmlspecialchars($no++, ENT_QUOTES, 'UTF-8');
      $temp[] = htmlspecialchars($pegMapel->nama_mapel, ENT_QUOTES, 'UTF-8');
      $temp[] = htmlspecialchars($pegMapel->kode_jurusan, ENT_QUOTES, 'UTF-8');
      $temp[] = htmlspecialchars($pegMapel->keterangan, ENT_QUOTES, 'UTF-8');
      $temp[] = '<div class="dropdown">
                          <button type="button" id="aksi" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                            <i class="bx bx-dots-vertical-rounded"></i>
                          </button>
                          <div class="dropdown-menu">
                            <button type="button" id="btn-edit" class="dropdown-item btn-edit" data-bs-toggle="modal" data-id="' . $pegMapel->id_mapel . '" data-nama="' . $pegMapel->nama_mapel . '" data-kode="' . $pegMapel->kode_jurusan . '" data-keterangan="' . $pegMapel->keterangan . '" data-bs-target="#modalUpdate"><i class="bx bx-edit-alt me-1"></i> Edit</button>
                            <a class="dropdown-item" href="javascript:void(0)" onclick="hapusMapel(' . "'" . $pegMapel->id_mapel . "'" . ')"><i class="bx bx-trash me-1"></i> Hapus</a>
                          </div>
                        </div>';
      $peg[] = $temp;
    }

    $output['draw'] = intval($this->input->get('draw'));
    $output['recordsTotal'] = $this->mapel_m->countAll();
    $output['recordsFiltered'] = $this->mapel_m->filtered();
    $output['data'] = $peg;

    echo json_encode($output);
  }

  public function hapusMapel($id)
  {
    $this->mapel_m->hapusMapel($id);
    echo json_encode(array("status" => TRUE));
  }

  public function saveEditMapel()
  {
    $id = $this->session->userdata('id_user');
    $input = $this->input->post();
    $id_mapel = $input['id_mapel'];
    $this->form_validation->set_rules('mapel2', 'Nama Mapel', 'required');
    if ($this->form_validation->run() == FALSE) {
      echo json_encode(array('status' => FALSE));
    } else {
      $data = [
        'nama_mapel' => $input['mapel2'],
        'kode_jurusan' => $input['jurusan2'],
        'keterangan' => $input['keterangan2']
      ];

      $this->mapel_m->saveEditMapel($data, $id_mapel);
      echo json_encode(['status' => TRUE]);   
    }
  }
}

/* End of file Controllername.php */
