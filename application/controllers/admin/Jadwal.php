<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Jadwal extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->library('form_validation');
    $this->load->model(array('user_m', 'kelas_m', 'absensi_m', 'siswa_m', 'guru_m', 'mapel_m', 'admin_m'));
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
    $smt = $this->input->post('smt');
    $id_kelas = $this->input->post('kelas');
    $tahun = $this->input->post('thn');
    $no = 1;
    // echo $id_kelas;
    // // die();
    $this->load->view('backend/layouts/wrapper', [
      'content' => 'backend/admin/dataJadwal',
      'title' => 'Data Jadwal Pelajaran',
      'profile' => $this->user_m->profile($id),
      'kelas' => $this->kelas_m->getKelas(),
      'tahun' => $this->admin_m->dataTahun(),
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
      $temp[] = '<div class="dropdown">
                          <button type="button" id="aksi" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                            <i class="bx bx-dots-vertical-rounded"></i>
                          </button>
                          <div class="dropdown-menu">
                            <button type="button" id="btn-edit" class="dropdown-item btn-edit" data-bs-toggle="modal"  onclick="editJadwal(' . "'" . $pegMapel->id_jadwal . "'" . ')"  data-bs-target="#modalUpdate"><i class="bx bx-edit-alt me-1"></i> Edit</button>
                            <a class="dropdown-item" href="javascript:void(0)" onclick="hapusJadwal(' . "'" . $pegMapel->id_jadwal . "'" . ')"><i class="bx bx-trash me-1"></i> Hapus</a>
                          </div>
                        </div>';
      $peg[] = $temp;
    }

    $output['draw'] = intval($this->input->get('draw'));
    $output['recordsTotal'] = $this->mapel_m->countAllJadwal();
    $output['recordsFiltered'] = $this->mapel_m->filteredJadwal();
    $output['data'] = $peg;

    echo json_encode($output);
  }

  public function tambah_jadwal()
  {
    $id = $this->session->userdata('id_user');
    $reponse = [
      'csrfName' => $this->security->get_csrf_token_name(),
      'csrfHash' => $this->security->get_csrf_hash()
    ];
    $data = [
      'profile' => $this->user_m->profile($id),
      'tahun' => $this->admin_m->dataTahun(),
      'mapel' => $this->mapel_m->getMapel(),
      'guru' => $this->admin_m->getGuru(),
      'jurusan' => $this->admin_m->dataJurusan(),
      'kelas' => $this->kelas_m->getKelas()
    ];

    $html = $this->load->view('backend/admin/modal/addJadwal', $data);
    $reponse = [
      'html' => $html,
      'csrfName' => $this->security->get_csrf_token_name(),
      'csrfHash' => $this->security->get_csrf_hash(),
      'success' => true
    ];
  }

  public function addJadwal()
  {
    $id = $this->session->userdata('id_user');
    $input = $this->input->post();
    $this->form_validation->set_rules('mapel', 'Mapel', 'required');
    $this->form_validation->set_rules('guru', 'Guru', 'required');
    $this->form_validation->set_rules('hari', 'Hari', 'required');
    if ($this->form_validation->run() == FALSE) {
      echo json_encode(['status' => FALSE]);
    } else {
      $data = [
        'id_mapel' => $input['mapel'],
        'id_guru' => $input['guru'],
        'id_kelas' => $input['kelas'],
        'jam_mulai' => $input['mulai'],
        'jam_selesai' => $input['selesai'],
        'hari' => $input['hari'],
        'kode_jurusan' => $input['jurusan'],
        'semester' => $input['semester'],
        'tahun_ajaran' => $input['tahun']
      ];
      $this->admin_m->saveJadwal($data);
      echo json_encode(['status' => TRUE]);
    }
  }


  public function editJadwal($id_jadwal)
  {
    $id = $this->session->userdata('id_user');
    $reponse = [
      'csrfName' => $this->security->get_csrf_token_name(),
      'csrfHash' => $this->security->get_csrf_hash()
    ];
    $data = [
      'profile' => $this->user_m->profile($id),
      'tahun' => $this->admin_m->dataTahun(),
      'mapel' => $this->mapel_m->getMapel(),
      'guru' => $this->admin_m->getGuru(),
      'jurusan' => $this->admin_m->dataJurusan(),
      'jadwal' => $this->mapel_m->getDataJadwalEdit($id_jadwal),
      'kelas' => $this->kelas_m->getKelas()
    ];

    $html = $this->load->view('backend/admin/modal/ubahJadwal', $data);
    $reponse = [
      'html' => $html,
      'csrfName' => $this->security->get_csrf_token_name(),
      'csrfHash' => $this->security->get_csrf_hash(),
      'success' => true
    ];
  }

  public function saveEdit()
  {
    $input = $this->input->post();
    $id_jadwal = $input['id_jadwal'];

    // var_dump($id_siswa);die();
    // $this->form_validation->set_rules('nis', 'NIS', 'required|min_length[10]|is_unique[siswa.nis]');
    // if (!$this->form_validation->run()) {
    //   echo json_encode(['status' => FALSE]);
    // } else {
    $data = [
      'id_mapel' => $input['mapel'],
      'id_guru' => $input['guru'],
      'id_kelas' => $input['kelas'],
      'jam_mulai' => $input['mulai'],
      'jam_selesai' => $input['selesai'],
      'hari' => $input['hari'],
      'kode_jurusan' => $input['jurusan'],
      'semester' => $input['semester'],
      'tahun_ajaran' => $input['tahun']
    ];

    $this->mapel_m->saveEditJadwal($data, $id_jadwal);
    echo json_encode(['status' => TRUE]);
    // var_dump($data);
    // }

  }

  public function hapusJadwal($id)
  {
    $this->mapel_m->hapusJadwal($id);
    echo json_encode(array("status" => TRUE));
  }
}

/* End of file Absensi.php */
