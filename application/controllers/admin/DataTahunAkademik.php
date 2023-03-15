<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DataTahunAkademik extends CI_Controller
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
      'content' => 'backend/admin/dataTahun',
      'title'   => 'Data Tahun Akademik',
      'profile' => $this->user_m->profile($id),
      'userdata' => $id
    ], FALSE);
  }

  public function saveTahun()
  {
    $id = $this->session->userdata('id_user');
    $input = $this->input->post();
    $this->form_validation->set_rules('tahun', 'Tahun Ajaran', 'required');
    $this->form_validation->set_rules('semester', 'Tahun Ajaran', 'required');
    $this->form_validation->set_rules('status', 'Tahun Ajaran', 'required');
    if ($this->form_validation->run() == FALSE) {
      echo json_encode(array('status' => FALSE));
    } else {
      $data = [
        'tahun_ajaran' => $input['tahun'],
        'semester' => $input['semester'],
        'status' => $input['status'],
        'keterangan' => $input['keterangan']
      ];

      $this->admin_m->saveTahun($data);
      echo json_encode(['status' => TRUE]);
    }
  }

  public function saveEditTahun()
  {
    $id = $this->session->userdata('id_user');
    $input = $this->input->post();
    $id_ = $input['id'];
    $this->form_validation->set_rules('tahun2', 'Tahun Ajaran', 'required');
    $this->form_validation->set_rules('semester2', 'Tahun Ajaran', 'required');
    $this->form_validation->set_rules('status2', 'Tahun Ajaran', 'required');
    if ($this->form_validation->run() == FALSE) {
      echo json_encode(array('status' => FALSE));
    } else {
      $data = [
        'tahun_ajaran' => $input['tahun2'],
        'semester' => $input['semester2'],
        'status' => $input['status2'],
        'keterangan' => $input['keterangan2']
      ];

      $this->admin_m->saveEditTahun($data, $id);
      echo json_encode(['status' => TRUE]);
    }
  }


  public function getTahunAkademik()
  {
    $data = $this->admin_m->dataTahun();
    $peg = [];
    $no = 1;
    foreach ($data as $tahun) {
      $temp = [];
      $temp[] = htmlspecialchars($no++, ENT_QUOTES, 'UTF-8');
      $temp[] = htmlspecialchars($tahun->tahun_ajaran, ENT_QUOTES, 'UTF-8');
      $temp[] = htmlspecialchars($tahun->semester, ENT_QUOTES, 'UTF-8');
      $temp[] = htmlspecialchars($tahun->keterangan, ENT_QUOTES, 'UTF-8');
      $temp[] = htmlspecialchars($tahun->status, ENT_QUOTES, 'UTF-8');
      $temp[] = '<div class="dropdown">
                          <button type="button" id="aksi" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                            <i class="bx bx-dots-vertical-rounded"></i>
                          </button>
                          <div class="dropdown-menu">
                            <button type="button" id="btn-edit" class="dropdown-item btn-edit" data-bs-toggle="modal" data-id="' . $tahun->id . '" data-tahun="' . $tahun->tahun_ajaran . '" data-semester="' . $tahun->semester . '" data-keterangan="' . $tahun->keterangan . '" data-status="' . $tahun->status . '" data-bs-target="#modalUpdate"><i class="bx bx-edit-alt me-1"></i> Edit</button>
                            <a class="dropdown-item" href="javascript:void(0)" onclick="hapusTahun(' . "'" . $tahun->id . "'" . ')"><i class="bx bx-trash me-1"></i> Hapus</a>
                          </div>
                        </div>';
      $peg[] = $temp;
    }

    $output['draw'] = intval($this->input->get('draw'));
    $output['recordsTotal'] = $this->admin_m->countAllTahun();
    $output['recordsFiltered'] = $this->admin_m->filteredTahun();
    $output['data'] = $peg;

    echo json_encode($output);
  }


  public function hapusTahun($id)
  {
    $this->admin_m->hapusTahun($id);
    echo json_encode(array("status" => TRUE));
  }
}

/* End of file DataSiswa.php */
