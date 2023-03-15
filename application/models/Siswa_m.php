<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Siswa_m extends CI_Model
{

  public function __construct()
  {
    parent::__construct();
  }
  /**
   * Query Siswa
   */
  private function querySiswa()
  {
    $id_kelas = $this->session->userdata('id_kelas');
    $this->db->select('*');
    $this->db->from('siswa s');
    $this->db->join('agama a', 's.id_agama = a.id_agama');
    $this->db->join('kelas k', 's.id_kelas = k.id_kelas');
    $this->db->where('s.id_kelas', $id_kelas);

    if ($this->input->get('search')['value']) {
      $this->db->like('nama', $this->input->get('search')['value']);
      $this->db->or_like('tanggal_lahir', $this->input->get('search')['value']);
      $this->db->or_like('jenis_kelamin', $this->input->get('search')['value']);
      $this->db->or_like('no_hp', $this->input->get('search')['value']);
      $this->db->or_like('a.agama', $this->input->get('search')['value']);
    }

    if ($this->input->get('order')) {
      $this->db->order_by(
        $this->input->get('order')['0']['column'],
        $this->input->get('order')['0']['dir']
      );
    } else {
      $this->db->order_by('s.id_siswa', 'desc');
    }
  }


  public function dataSiswa()
  {
    self::querySiswa();
    if ($this->input->get('length') !== -1) {
      $this->db->limit($this->input->get('length'), $this->input->get('start'));
    }
    return $this->db->get()->result();
  }


  public function filteredSiswa()
  {
    self::querySiswa();
    return $this->db->get()->num_rows();
  }


  public function countAllSiswa()
  {
    $this->db->from('siswa');
    return $this->db->count_all_results();
  }

  public function getDataSiswa($id_siswa)
  {
    $this->db->select('*');
    $this->db->from('siswa');
    $this->db->where('id_siswa', $id_siswa);
    return $this->db->get()->row();
  }

  public function saveEditSiswa($data, $id_siswa)
  {
    //return $this->db->replace('siswa', $data, $id_siswa);
    $this->db->set($data);
    $this->db->where('id_siswa', $id_siswa);
    $this->db->update('siswa');
  }

  public function getSiswaAbsen($jadwal)
  {
    $this->db->select('s.nama, s.id_siswa, s.nis, s.id_kelas, j.id_jadwal, j.id_mapel, j.semester, j.tahun_ajaran, a.keterangan');
    $this->db->from('siswa s');
    $this->db->join('jadwal j', 's.id_kelas = j.id_kelas', 'left');
    $this->db->join('absensi a', 's.id_siswa = a.id_siswa and a.id_mapel = j.id_mapel', 'left');
    $this->db->join('mapel m', 'j.id_mapel=m.id_mapel', 'left');
    $this->db->where('j.id_jadwal', $jadwal);
    $this->db->order_by('s.nama', 'ASC');
    return $this->db->get()->result();
  }


  public function getSiswa($id_kelas)
  {
    $this->db->select('*');
    $this->db->from('siswa');
    $this->db->where('id_kelas', $id_kelas);
    return $this->db->get()->result();
  }
}

/* End of file Siswa_m.php */
