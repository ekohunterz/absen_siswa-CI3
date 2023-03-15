<?php
defined('BASEPATH') or exit('No direct script access allowed');

class DataGuru extends CI_Controller
{
  public function __construct()
  {
    parent::__construct();
    $this->load->model(array('guru_m', 'user_m', 'admin_m', 'mapel_m'));
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
      'content' => 'backend/admin/dataGuru',
      'title' => 'Data Guru',
      'profile' => $this->user_m->profile($id),
      'userdata' => $id
    ], FALSE);
  }

  public function unameValid()
  {
    $username = $this->input->post('username');
    $exists = $this->admin_m->usernameExist($username);
    $count = count($exists);
    if (empty($count)) {
      echo true;
    } else {
      echo false;
    }
  }

  public function nipValid()
  {
    $nip = $this->input->post('nip');
    $exists = $this->admin_m->nipExist($nip);
    $count = count($exists);
    if (empty($count)) {
      echo true;
    } else {
      echo false;
    }
  }

  public function saveGuru()
  {
    $id = $this->session->userdata('id_user');
    $input = $this->input->post();
    // $getTanggal = explode('-', $input['tanggal_lahir']);
    // $pass = $getTanggal['0'] . $getTanggal['1'] . $getTanggal['2'];
    $this->form_validation->set_rules('username', 'Username', 'required|is_unique[user.username]');
    $this->form_validation->set_rules('nip', 'NIP', 'required|min_length[18]|is_unique[user.nip]');
    if ($this->form_validation->run() == FALSE) {
      $this->form_validation->set_message('is_unique', '%s sudah ada');
      echo json_encode(array('status' => FALSE));
    } else {
      $data = [
        'id_agama'      => $input['agama'],
        'id_status'     => $input['status'],
        'nip'           => $input['nip'],
        'nama'          => $input['nama'],
        'username'      => $input['username'],
        'password'      => password_hash($input['nip'], PASSWORD_DEFAULT),
        // 'password'      => $input['nip'],
        'no_hp'         => $input['no_hp'],
        'alamat'        => $input['alamat'],
        'tempat_lahir' => $input['tempat_lahir'],
        'tanggal_lahir' => $input['tanggal_lahir'],
        'jenis_kelamin' => $input['gender'],
        'file'        => 'user.png',
        'tipe'        => 88,
        'submit_at'     => time()
      ];

      $this->admin_m->saveGuru($data);
      //var_dump($data);
      echo json_encode(['status' => TRUE]);
    }
  }


  public function saveEdit()
  {
    $id = $this->session->userdata('id_user');
    $input = $this->input->post();
    $id_user = $input['id_user'];
    $this->form_validation->set_rules('nip', 'NIP', 'required|min_length[18]');
    $this->form_validation->set_rules('username', 'Username', 'required');
    if (!$this->form_validation->run()) {
      $data = [
        'nip' => form_error('nip'),
        'username' => form_error('username')
      ];
      echo json_encode(['status' => FALSE]);
    } else {
      $data = [
        'id_agama'      => $input['agama'],
        'id_status'     => $input['status'],
        'nip'           => $input['nip'],
        'nama'          => $input['nama'],
        'username'      => $input['username'],
        'no_hp'         => $input['no_hp'],
        'alamat'        => $input['alamat'],
        'tempat_lahir' => $input['tempat_lahir'],
        'tanggal_lahir' => $input['tanggal_lahir'],
        'jenis_kelamin' => $input['gender'],
        'file'        => NULL,
        'tipe'        => 88,
        'submit_at'     => time()
      ];

      $this->admin_m->saveEditGuru($data, $id_user);
      // var_dump($data);
      echo json_encode(['status' => TRUE]);
    }
  }


  public function getGuru()
  {
    $data = $this->admin_m->dataGuru();
    $peg = [];
    $no = 1;
    foreach ($data as $pegGuru) {
      $explode = explode('-', $pegGuru->tanggal_lahir);
      // $tgl = $explode[2] . '-' . $explode[1] . '-' . $explode[0];
      $temp = [];
      $temp[] = htmlspecialchars($no++, ENT_QUOTES, 'UTF-8');
      //$temp[] = htmlspecialchars($pegGuru->username, ENT_QUOTES, 'UTF-8');
      $temp[] = htmlspecialchars($pegGuru->nip, ENT_QUOTES, 'UTF-8');
      $temp[] = htmlspecialchars($pegGuru->nama, ENT_QUOTES, 'UTF-8');
      $temp[] = htmlspecialchars($pegGuru->no_hp, ENT_QUOTES, 'UTF-8');
      $temp[] = htmlspecialchars($pegGuru->alamat, ENT_QUOTES, 'UTF-8');
      $temp[] = htmlspecialchars($pegGuru->agama, ENT_QUOTES, 'UTF-8');
      $temp[] = htmlspecialchars($pegGuru->tempat_lahir . ', ' . $pegGuru->tanggal_lahir, ENT_QUOTES, 'UTF-8');
      $temp[] = htmlspecialchars($pegGuru->jenis_kelamin, ENT_QUOTES, 'UTF-8');
      $temp[] = htmlspecialchars($pegGuru->status, ENT_QUOTES, 'UTF-8');

      // $temp[] = htmlspecialchars(date('d-m-Y / H:i', $pegGuru->submit_at), ENT_QUOTES, 'UTF-8');
      $temp[] = '<div class="dropdown">
                          <button type="button" class="btn p-0 dropdown-toggle hide-arrow" data-bs-toggle="dropdown">
                            <i class="bx bx-dots-vertical-rounded"></i>
                          </button>
                          <div class="dropdown-menu">
                            <button type="button" id="btn-edit" onclick="editGuru(' . "'" .  $pegGuru->id_user . "'" . ')" class="dropdown-item btn-edit" data-bs-toggle="modal"  data-bs-target="#modalUpdate"><i class="bx bx-edit-alt me-1"></i> Edit</button>
                            <a class="dropdown-item" href="javascript:void(0)" onclick="hapusGuru(' . "'" . $pegGuru->id_user . "'" . ')"
                              ><i class="bx bx-trash me-1"></i> Hapus</a
                            >
                          </div>
                        </div>';
      $peg[] = $temp;
    }

    $output['draw'] = intval($this->input->get('draw'));
    $output['recordsTotal'] = $this->admin_m->countAll();
    $output['recordsFiltered'] = $this->admin_m->filtered();
    $output['data'] = $peg;

    echo json_encode($output);
  }

  public function hapusGuru($id)
  {
    $this->admin_m->hapusGuru($id);
    echo json_encode(array("status" => TRUE));
  }

  public function tambah_guru()
  {
    $id = $this->session->userdata('id_user');
    $reponse = [
      'csrfName' => $this->security->get_csrf_token_name(),
      'csrfHash' => $this->security->get_csrf_hash()
    ];
    $data = [
      'profile' => $this->user_m->profile($id),
      'agama' => $this->admin_m->getAgama()
    ];

    $html = $this->load->view('backend/admin/modal/addGuru', $data);
    $reponse = [
      'html' => $html,
      'csrfName' => $this->security->get_csrf_token_name(),
      'csrfHash' => $this->security->get_csrf_hash(),
      'success' => true
    ];
  }

  public function guru_edit($id_guru)
  {
    $id = $this->session->userdata('id_user');

    $reponse = [
      'csrfName' => $this->security->get_csrf_token_name(),
      'csrfHash' => $this->security->get_csrf_hash()
    ];
    $data = [
      'profile' => $this->user_m->profile($id),
      'agama' => $this->admin_m->getAgama(),
      'dataGuru' => $this->guru_m->getDataGuru($id_guru)
    ];

    $html = $this->load->view('backend/admin/modal/ubahGuru', $data);
    $reponse = [
      'html' => $html,
      'csrfName' => $this->security->get_csrf_token_name(),
      'csrfHash' => $this->security->get_csrf_hash(),
      'success' => true
    ];
  }
}

/* End of file DataGuru.php */
