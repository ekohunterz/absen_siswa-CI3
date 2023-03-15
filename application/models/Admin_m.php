<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Admin_m extends CI_Model
{
  public function getAgama()
  {
    return $this->db->get('agama')->result();
  }

  //Guru
  public function saveGuru($data)
  {
    $this->db->insert('user', $data);
    return $this->db->insert_id();
  }

  /**
   * Hapus Guru
   */
  public function hapusGuru($id)
  {
    $this->db->where('id_user', $id);
    $this->db->delete('user');
  }

  public function hapusTahun($id)
  {
    $this->db->where('id', $id);
    $this->db->delete('tahun_akademik');
  }

  /**
   * Siswa
   */
  public function saveSiswa($data)
  {
    $this->db->insert('siswa', $data);
    return $this->db->insert_id();
  }

  public function saveJadwal($data)
  {
    return $this->db->insert('jadwal', $data);
  }


  public function addSek()
  {
  }

  /**
   * Hapus Siswa
   */
  public function hapusSiswa($id)
  {
    $this->db->where('id_siswa', $id);
    $this->db->delete('siswa');
  }

  public function hapusJurusan($id)
  {
    $this->db->where('id_jurusan', $id);
    $this->db->delete('jurusan');
  }

  //nis
  public function nisExist($nis)
  {
    $this->db->select('nis')
      ->from('siswa')
      ->where('nis', $nis);
    $query = $this->db->get();
    $result = $query->result_array();
    return $result;
  }

  //nip
  public function nipExist($nip)
  {
    $this->db->select('nip')
      ->from('user')
      ->where('nip', $nip);
    $query = $this->db->get();
    $result = $query->result_array();
    return $result;
  }

  public function pwExist($id, $current_password)
  {
    $this->db->select('password')
      ->from('user')
      ->where('id_user', $id)
      ->where('password', $current_password);
    $query = $this->db->get();
    $result = $query->result_array();
    return $result;
  }

  public function usernameExist($username)
  {
    $this->db->select('username')
      ->from('user')
      ->where('username', $username);
    $query = $this->db->get();
    $result = $query->result_array();
    return $result;
  }

  private function queryGuru()
  {
    $this->db->select('*');
    $this->db->from('user u');
    $this->db->join('status s', 'u.id_status = s.id_status');
    $this->db->join('agama a', 'u.id_agama = a.id_agama');
    $this->db->where('tipe', 88);

    if ($this->input->get('search')['value']) {
      $this->db->like('nama', $this->input->get('search')['value']);
      $this->db->or_like('tanggal_lahir', $this->input->get('search')['value']);
      $this->db->or_like('jenis_kelamin', $this->input->get('search')['value']);
      $this->db->or_like('nip', $this->input->get('search')['value']);
      $this->db->or_like('s.status', $this->input->get('search')['value']);
    }

    if ($this->input->get('order')) {
      $this->db->order_by(
        $this->input->get('order')['0']['column'],
        $this->input->get('order')['0']['dir']
      );
    } else {
      $this->db->order_by('submit_at', 'desc');
    }
  }

  public function dataGuru()
  {
    self::queryGuru();
    if ($this->input->get('length') !== -1) {
      $this->db->limit($this->input->get('length'), $this->input->get('start'));
    }
    return $this->db->get()->result();
  }

  public function getGuru()
  {
    $this->db->where('tipe', 88);
    return $this->db->get('user')->result();
  }

  public function filtered()
  {
    self::queryGuru();
    $this->db->where('tipe', 88);
    return $this->db->get()->num_rows();
  }

  public function countAll()
  {
    $this->db->from('user');
    $this->db->where('tipe', 88);
    return $this->db->count_all_results();
  }

  /**
   * Query Siswa
   */
  private function querySiswa()
  {
    $id_kelas = $this->session->userdata('id_kelas');
    $this->db->select('*');
    $this->db->from('siswa s');
    $this->db->join('agama a', 's.id_agama = a.id_agama', 'left');
    $this->db->join('kelas k', 's.id_kelas = k.id_kelas', 'left');
    // $this->db->where('s.id_kelas', $id_kelas);

    if ($this->input->get('search')['value']) {
      $this->db->like('nama', $this->input->get('search')['value']);
      $this->db->or_like('tanggal_lahir', $this->input->get('search')['value']);
      $this->db->or_like('jenis_kelamin', $this->input->get('search')['value']);
      $this->db->or_like('k.kelas', $this->input->get('search')['value']);
      $this->db->or_like('no_hp', $this->input->get('search')['value']);
      $this->db->or_like('a.agama', $this->input->get('search')['value']);
    }

    if ($this->input->get('order')) {
      $this->db->order_by(
        $this->input->get('order')['0']['column'],
        $this->input->get('order')['0']['dir']
      );
    } else {
      $this->db->order_by('k.kelas', 'asc');
    }
  }

  private function queryJurusan()
  {
    $this->db->select('*');
    $this->db->from('jurusan');

    if ($this->input->get('search')['value']) {
      $this->db->like('nama_jurusan', $this->input->get('search')['value']);
      $this->db->or_like('kode_jurusan', $this->input->get('search')['value']);
    }

    if ($this->input->get('order')) {
      $this->db->order_by(
        $this->input->get('order')['0']['column'],
        $this->input->get('order')['0']['dir']
      );
    } else {
      $this->db->order_by('kode_jurusan', 'asc');
    }
  }

  private function queryTahun()
  {
    $this->db->select('*');
    $this->db->from('tahun_akademik');

    if ($this->input->get('search')['value']) {
      $this->db->like('tahun_ajaran', $this->input->get('search')['value']);
      $this->db->or_like('semester', $this->input->get('search')['value']);
    }

    if ($this->input->get('order')) {
      $this->db->order_by(
        $this->input->get('order')['0']['column'],
        $this->input->get('order')['0']['dir']
      );
    } else {
      $this->db->order_by('tahun_ajaran', 'asc');
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

  public function dataJurusan()
  {
    self::queryJurusan();
    if ($this->input->get('length') !== -1) {
      $this->db->limit($this->input->get('length'), $this->input->get('start'));
    }
    return $this->db->get()->result();
  }

  public function countAllJurusan()
  {
    $this->db->from('jurusan');
    return $this->db->count_all_results();
  }

  public function dataTahun()
  {
    self::queryTahun();
    if ($this->input->get('length') !== -1) {
      $this->db->limit($this->input->get('length'), $this->input->get('start'));
    }
    return $this->db->get()->result();
  }

  public function countAllTahun()
  {
    $this->db->from('tahun_akademik');
    return $this->db->count_all_results();
  }
  public function saveTahun($data)
  {
    $this->db->insert('tahun_akademik', $data);
    return $this->db->insert_id();
  }

  public function saveJurusan($data)
  {
    $this->db->insert('jurusan', $data);
    return $this->db->insert_id();
  }

  public function filteredJurusan()
  {
    $this->db->select('*');
    $this->db->from('jurusan');
    return $this->db->get()->num_rows();
  }

  public function filteredTahun()
  {
    $this->db->select('*');
    $this->db->from('tahun_akademik');
    return $this->db->get()->num_rows();
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

  public function jmlguru()
  {
    $query = $this->db->get('user');
    if ($query->num_rows() > 0) {
      return $query->num_rows();
    } else {
      return 0;
    }
  }

  public function saveEditGuru($data, $id_user)
  {
    $this->db->set($data);
    $this->db->where('id_user', $id_user);
    $this->db->update('user');
  }

  public function saveEditJurusan($data, $id_jurusan)
  {
    $this->db->set($data);
    $this->db->where('id_jurusan', $id_jurusan);
    $this->db->update('jurusan');
  }
  public function saveEditTahun($data, $id)
  {
    $this->db->set($data);
    $this->db->where('id', $id);
    $this->db->update('tahun_akademik');
  }

  public function updateAbsen($data, $kode_absen)
  {
    $this->db->set($data);
    $this->db->where('id_absen', $kode_absen);
    $this->db->update('absensi');
    //return $this->db->replace('absensi', $data);
    //return $this->db->replace('user', $data, $id_user);

  }
  public function saveAbsen($data)
  {
    return $this->db->replace('absensi', $data);
  }

}

/* End of file Admin_m.php */
