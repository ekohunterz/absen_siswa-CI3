<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Mapel_m extends CI_Model
{
  /**
   * @author Taraz14(Meliodas)
   * Save Mapel
   */
  public function saveMapel($data)
  {
    $this->db->insert('mapel', $data);
    return $this->db->insert_id();
  }

  /**
   * Hapus Mapel
   */
  public function hapusMapel($id)
  {
    $this->db->where('id_mapel', $id);
    $this->db->delete('mapel');
  }

  public function saveEditMapel($data, $id_mapel)
  {
    $this->db->set($data);
    $this->db->where('id_mapel', $id_mapel);
    $this->db->update('mapel');
  }

  public function getMapel()
  {
    return $this->db->get('mapel')->result();
  }

  public function getMapelByKelas($id_kelas)
  {
    $this->db->where('jadwal.id_kelas', $id_kelas);
    $this->db->join('kelas', 'jadwal.id_kelas=kelas.id_kelas', 'left');
    $this->db->join('mapel', 'jadwal.id_mapel=mapel.id_mapel', 'left');
    $this->db->group_by('jadwal.id_mapel');
    return $this->db->get('jadwal')->result();
  }

  public function getJadwal($id, $id_kelas)
  {
    $this->db->where('jadwal.id_guru', $id);
    $this->db->where('jadwal.id_kelas', $id_kelas);
    $this->db->join('kelas', 'jadwal.id_kelas=kelas.id_kelas', 'left');
    $this->db->join('mapel', 'jadwal.id_mapel=mapel.id_mapel', 'left');
    $this->db->group_by('jadwal.id_mapel');
    return $this->db->get('jadwal')->result();
  }


  public function getDataJadwalEdit($id_jadwal)
  {
    $this->db->select('*');
    $this->db->from('jadwal');
    $this->db->where('id_jadwal', $id_jadwal);
    return $this->db->get()->row();
  }

  public function saveEditJadwal($data, $id_jadwal)
  {
    $this->db->set($data);
    $this->db->where('id_jadwal', $id_jadwal);
    $this->db->update('jadwal');
  }

  public function hapusJadwal($id)
  {
    $this->db->where('id_jadwal', $id);
    $this->db->delete('jadwal');
  }

  /**
   * Datatables Query
   */
  private function queryMapel()
  {
    $this->db->select('*');
    $this->db->from('mapel');

    if ($this->input->get('search')['value']) {
      $this->db->like('nama_mapel', $this->input->get('search')['value']);
    }

    if ($this->input->get('order')) {
      $this->db->order_by(
        $this->input->get('order')['0']['column'],
        $this->input->get('order')['0']['dir']
      );
    } else {
      $this->db->order_by('id_mapel', 'desc');
    }
  }

  private function queryJadwal()
  {
    $id = $this->session->userdata('id_user');
    $userdataTipe = $this->session->userdata('tipe');
    $semester = $_GET['smt'];
    $tahun = $_GET['thn'];
    $kelas = $_GET['kelas'];
    $hari = $_GET['hari'];
    $this->db->select('*');
    $this->db->from('jadwal');
    $this->db->join('kelas', 'jadwal.id_kelas=kelas.id_kelas', 'left');
    $this->db->join('mapel', 'jadwal.id_mapel=mapel.id_mapel', 'left');
    $this->db->join('user', 'jadwal.id_guru=user.id_user', 'left');

    if ($userdataTipe == 88) {
      $this->db->where('jadwal.id_guru', $id);
    }
    if ($this->input->get('search')['value']) {
      $this->db->like('nama_mapel', $this->input->get('search')['value']);
    }

    if (!empty($kelas)) {
      $this->db->where('jadwal.id_kelas', $kelas);
    }

    if (!empty($hari)) {
      $this->db->where('jadwal.hari', $hari);
    }

    if (!empty($semester)) {
      $this->db->like('semester', $semester);
    }

    if (!empty($tahun)) {
      $this->db->like('tahun_ajaran', $tahun);
    }


    if ($this->input->get('order')) {
      $this->db->order_by(
        $this->input->get('order')['0']['column'],
        $this->input->get('order')['0']['dir']
      );
    } else {
      $this->db->order_by('id_jadwal', 'desc');
    }
  }

  public function dataMapel()
  {
    self::queryMapel();
    if ($this->input->get('length') !== -1) {
      $this->db->limit($this->input->get('length'), $this->input->get('start'));
    }
    return $this->db->get()->result();
  }

  public function dataJadwal()
  {
    self::queryJadwal();
    if ($this->input->get('length') !== -1) {
      $this->db->limit($this->input->get('length'), $this->input->get('start'));
    }
    return $this->db->get()->result();
  }

  public function filtered()
  {
    self::queryMapel();
    return $this->db->get()->num_rows();
  }

  public function filteredJadwal()
  {
    self::queryJadwal();
    return $this->db->get()->num_rows();
  }

  public function countAll()
  {
    $this->db->from('mapel');
    return $this->db->count_all_results();
  }


  public function countAllJadwal()
  {
    $this->db->from('jadwal');
    return $this->db->count_all_results();
  }
}

/* End of file Mapel_m.php */
