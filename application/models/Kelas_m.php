<?php
defined('BASEPATH') or exit('No direct script access allowed');

class Kelas_m extends CI_Model
{

  /**
   * @author Taraz14(Meliodas)
   * Save Kelas
   */
  public function saveKelas($data)
  {
    $this->db->insert('kelas', $data);
    return $this->db->insert_id();
  }

  /**
   * Hapus Kelas
   */
  public function hapusKelas($id)
  {
    $this->db->where('id_kelas', $id);
    $this->db->delete('kelas');
  }

  /**
   * Get Kelas
   */
  public function getKelas()
  {
    $this->db->order_by('kelas', 'asc');
    return $this->db->get('kelas')->result();
  }

  public function getKelasFilter($id)
  {
    $hari = array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu");
    $hari_ini = $hari[(int)date("w")];
    $jam = date("H:i:s");
    $this->db->select('*');
    $this->db->from('kelas k');
    $this->db->join('jadwal j', 'k.id_kelas = j.id_kelas');
    $this->db->join('tahun_akademik t', 't.tahun_ajaran = j.tahun_ajaran AND t.semester = j.semester');
    $this->db->join('mapel m', 'j.id_mapel=m.id_mapel', 'left');
    $this->db->where('j.id_guru', $id);
    $this->db->where('j.hari', $hari_ini);
    $this->db->where('t.status', 'Aktif');
    $this->db->order_by('k.kelas', 'ASC');
    return $this->db->get()->result();
  }

  public function getKelasRekap($id)
  {
    $this->db->select('*');
    $this->db->from('kelas k');
    $this->db->join('jadwal m', 'k.id_kelas = m.id_kelas');
    $this->db->where('m.id_guru', $id);
    $this->db->group_by('k.kelas');
    $this->db->order_by('k.kelas', 'ASC');
    return $this->db->get()->result();
  }

  /**
   * Datatables Query
   */
  private function queryKelas()
  {
    $this->db->select('*');
    $this->db->from('kelas k');
    // $this->db->join('user u', 'k.id_user = u.id_user', 'left');

    if ($this->input->get('search')['value']) {
      $this->db->like('kelas', $this->input->get('search')['value']);
      // $this->db->or_like('u.nama', $this->input->get('search')['value']);
    }

    if ($this->input->get('order')) {
      $this->db->order_by(
        $this->input->get('order')['0']['column'],
        $this->input->get('order')['0']['dir']
      );
    } else {
      $this->db->order_by('k.id_kelas', 'desc');
    }
  }

  public function dataKelas()
  {
    $this->queryKelas();
    // self::queryKelas();
    if ($this->input->get('length') !== -1) {
      $this->db->limit($this->input->get('length'), $this->input->get('start'));
    }
    return $this->db->get()->result();
  }

  public function filtered()
  {
    $this->queryKelas();
    // self::queryKelas();
    return $this->db->get()->num_rows();
  }

  public function countAll()
  {
    $this->db->from('kelas');
    return $this->db->count_all_results();
  }

  public function saveEditKelas($data, $id_kelas)
  {
    $this->db->set($data);
    $this->db->where('id_kelas', $id_kelas);
    $this->db->update('kelas');
    //return $this->db->replace('user', $data, $id_user);

  }
}

/* End of file Kelas_m.php */
