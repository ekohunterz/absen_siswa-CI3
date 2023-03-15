<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Guru_m extends CI_Model
{
  public function saveAbsen($data)
  {
    $this->db->replace('absensi', $data);
  }


  public function jmlsiswa()
  {
    $query = $this->db->get('siswa');
    if ($query->num_rows() > 0) {
      return $query->num_rows();
    } else {
      return 0;
    }
  }

  public function jmlkelas()
  {
    $query = $this->db->get('kelas');
    if ($query->num_rows() > 0) {
      return $query->num_rows();
    } else {
      return 0;
    }
  }

  public function getDataGuru($id_user)
  {
    $this->db->select('*');
    $this->db->from('user');
    $this->db->where('id_user', $id_user);
    return $this->db->get()->row();
  }
}

/* End of file Guru_m.php */
