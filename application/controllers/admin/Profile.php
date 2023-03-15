<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Profile extends CI_Controller
{

  public function __construct()
  {
    parent::__construct();
    $this->load->model('user_m');
    $this->load->model('admin_m');
    $this->load->model('mapel_m');

    $this->load->library('form_validation');
    if ($this->session->userdata('is_login') !== TRUE) {
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
      'content' => 'backend/admin/profil',
      'title'   => 'Profil',
      'profile' => $this->user_m->profile($id),
      'agama' => $this->admin_m->getAgama(),
      'mapel' => $this->mapel_m->getMapel(),
      'userdata' => $id
    ], FALSE);
  }

  public function saveEdit()
  {

    $id = $this->session->userdata('id_user');
    $input = $this->input->post();
    $id_user = $input['id_user'];
    if ($this->input->method() === 'post') {
      // the user id contain dot, so we must remove it
      $file_name = str_replace('.', '', $id);
      $config['upload_path']          = FCPATH . '/assets/foto/';
      $config['allowed_types']        = 'gif|jpg|jpeg|png';
      $config['file_name']            = $file_name;
      $config['overwrite']            = true;
      $config['max_size']             = 5000;


      $this->load->library('upload', $config);

      if ($this->upload->do_upload('foto')) {
        $uploaded_data = $this->upload->data();

        $new_data = [
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
          'file'        => $uploaded_data['file_name'],
          'submit_at'     => time()
        ];

        $this->admin_m->saveEditGuru($new_data, $id_user);
        echo json_encode(['status' => TRUE]);
       
      } else {
        $new_data = [
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
          'file'        => $input['foto2'],
          'submit_at'     => time()
        ];

        $this->admin_m->saveEditGuru($new_data, $id_user);
        echo json_encode(['status' => TRUE]);
      }
    }
  }

  public function editPass()
  {
    $id = $this->session->userdata('id_user');
    // var_dump($id_siswa);die();
    $this->load->view('backend/layouts/wrapper', [
      'content' => 'backend/admin/editPass',
      'title'   => 'Edit Password',
      'profile' => $this->user_m->profile($id),
      'userdata' => $id
    ], FALSE);
  }


  public function change_password()
  {

    $id = $this->session->userdata('id_user');
    $input = $this->input->post();
    // Set validation rules
    $this->form_validation->set_rules('password-sekarang', 'Current Password', 'required|callback_password_check');
    $this->form_validation->set_rules('password-baru', 'New Password', 'required');
    $this->form_validation->set_rules('password-confirm', 'Confirm Password', 'required|matches[password-baru]');

    if ($this->form_validation->run() == FALSE) {
      // Validation failed, load the change password view
      $this->editPass();
    } else {
      // Validation succeeded, update the password in the database
      $data = [
        'password'      => password_hash($input['password-baru'], PASSWORD_DEFAULT)
      ];

      $this->admin_m->saveEditGuru($data, $id);

      // Display success message
      $this->session->set_flashdata('success', '<div class="alert alert-success alert-dismissible" role="alert">
                       Password Berhasil Diubah!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>');
      redirect('Admin/Profile/editPass');
    }
  }

  public function password_check()
  {
    // Check if the current password matches the one in the database
    $current_password = $this->input->post('password-sekarang');
    $user_id = $this->session->userdata('id_user');
    $hashed_password = $this->db->get_where('user', array('id_user' => $user_id))->row()->password;

    if (password_verify($current_password, $hashed_password)) {
      return true;
    } else {
      $this->form_validation->set_message('password_check', '<div class="alert alert-warning alert-dismissible" role="alert">
                       Password lama Salah!
                        <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
                      </div>');
      return false;
    }
    if ($result) {
    }
  }
}

/* End of file Home.php */
