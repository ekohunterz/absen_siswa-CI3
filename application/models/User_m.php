<?php
defined('BASEPATH') or exit('No direct script access allowed');

class User_m extends CI_Model
{
  public function profile($id)
  {
    $this->db->select('*');
    $this->db->from('user');
    $this->db->where('id_user', $id);
    return $this->db->get()->row();
  }
  public function jadwal($id)
  {
    $jadwal = $this->input->post('kelas');
    if ($jadwal == TRUE){
      $hari = array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu");
      $hari_ini = $hari[(int)date("w")];
      $jam = date("H:i:s");
      $this->db->select('*');
      $this->db->from('jadwal j');
      $this->db->join('tahun_akademik t', 't.tahun_ajaran = j.tahun_ajaran');
      $this->db->join('mapel m', 'j.id_mapel=m.id_mapel', 'left');
      $this->db->where('j.id_jadwal', $jadwal);
      $this->db->where('t.status', 'Aktif');
      return $this->db->get()->row_array();
    }else{
      $hari = array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu");
      $hari_ini = $hari[(int)date("w")];
      $jam = date("H:i:s");
      $this->db->select('*');
      $this->db->from('jadwal j');
      $this->db->join('tahun_akademik t', 't.tahun_ajaran = j.tahun_ajaran');
      $this->db->join('mapel m', 'j.id_mapel=m.id_mapel', 'left');
      $this->db->where('j.id_guru', $id);
      $this->db->where('j.hari',  $hari_ini);
      $this->db->where("'$jam' BETWEEN j.jam_mulai AND j.jam_selesai");
      $this->db->where('t.status', 'Aktif');
      return $this->db->get()->row_array();
    }
    
  }

  public function dataTahun()
  {
    return $this->db->get('tahun_akademik')->result();
  }
}
/* End of file Admin_m.php */
