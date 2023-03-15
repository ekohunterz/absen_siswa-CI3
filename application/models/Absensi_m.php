<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Absensi_m extends CI_Model
{
  /**
   * Minimal Limit
   */
  const MIN_LIMIT = 1;

  /**
   * Instansiasi variable $db
   * 
   * @var object
   */
  private static $db;

  /**
   * Instansiasi variable input
   * 
   * @var array
   */
  private static $input;

  /**
   * Magic constructor
   */
  public function __construct()
  {
    parent::__construct();
    $bulan = array(1 => "Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember");
    $hari = array("Minggu", "Senin", "Selasa", "Rabu", "Kamis", "Jumat", "Sabtu");
    $this->get_today_date = $hari[(int)date("w")] . ', ' . date("j ") . $bulan[(int)date('m')] . date(" Y");

    /**
     * Set value varible $db
     * @var object
     */
    self::$db = &get_instance()->db;

    /**
     * Set value varible $input
     * @var array
     */
    self::$input = &get_instance()->input;
  }



  //kode tambahan
  public function getLaporanPerKelas($kelas, $mapel, $id)
  {


    $this->db->distinct('keterangan');
    // $this->db->select('count(keterangan == "sakit") as jmlketerangansakit, keterangan, bulan,tahun');
    // $this->db->where(array('id_kelas' => $kelas, 'id_mapel' => $mapel, 'keterangan !='=>"Hadir"));
    // $this->db->group_by(array("bulan", "tahun", "keterangan"));
    // return $this->db->get('absensi')->result();


    $this->db->select("count(case when keterangan = 'Sakit' then 1 else null end) as tSakit,
                        count(case when keterangan = 'Izin' then 1 else null end) as tIjin,
                        count(case when keterangan = 'Hadir' then 1 else null end) as tHadir,
                        count(case when keterangan = 'Alpha' then 1 else null end) as tAlpha,time_in,keterangan")
      ->from('absensi')
      ->like('semester', htmlspecialchars($this->input->post('smt', true)))
      ->like('tahun_ajaran', htmlspecialchars($this->input->post('thn', true)))
      ->where(array('id_kelas' => $kelas))->where(array('id_guru' => $id))->where(array('id_mapel' => $mapel));
    return $this->db->get()->result();
  }
  //end kode tambahan

  public function getLaporanPerSiswa($kelas, $semester, $tahun, $mapel, $id)
  {


    $this->db->distinct('keterangan');
    $this->db->select("count(case when a.keterangan = 'Sakit' then 1 else null end) as tSakit,
                        count(case when a.keterangan = 'Izin' then 1 else null end) as tIjin,
                        count(case when a.keterangan = 'Hadir' then 1 else null end) as tHadir,
                        count(case when a.keterangan != 'Hadir' then 1 else null end) as total,
                        count(case when a.keterangan = 'Alpha' then 1 else null end) as tAlpha,s.nama,s.id_siswa,s.nis")
      ->from('absensi a')
      ->join('siswa s', 'a.id_siswa = s.id_siswa')
      ->like('a.semester', $semester)
      ->like('a.tahun_ajaran', $tahun)
      ->where(array('a.id_kelas' => $kelas))->where(array('a.id_guru' => $id))->where(array('a.id_mapel' => $mapel));
    $this->db->group_by(array("s.nama"));
    return $this->db->get()->result();
  }
  public function getLaporanPerSiswaAdmin($kelas, $bulan, $tahun, $mapel)
  {


    $this->db->distinct('keterangan');
    // $this->db->select('count(keterangan == "sakit") as jmlketerangansakit, keterangan, bulan,tahun');
    // $this->db->where(array('id_kelas' => $kelas, 'id_mapel' => $mapel, 'keterangan !='=>"Hadir"));
    // $this->db->group_by(array("bulan", "tahun", "keterangan"));
    // return $this->db->get('absensi')->result();


    $this->db->select("count(case when a.keterangan = 'Sakit' then 1 else null end) as tSakit,
                        count(case when a.keterangan = 'Izin' then 1 else null end) as tIjin,
                        count(case when a.keterangan = 'Hadir' then 1 else null end) as tHadir,
                        count(case when a.keterangan != 'Hadir' then 1 else null end) as total,
                        count(case when a.keterangan = 'Alpha' then 1 else null end) as tAlpha,s.nama,s.id_siswa,s.nis")
      ->from('absensi a')
      ->join('siswa s', 'a.id_siswa = s.id_siswa')
      ->like('a.semester', htmlspecialchars($this->input->post('smt', true)))
      ->like('a.tahun_ajaran', htmlspecialchars($this->input->post('thn', true)))
      ->where(array('a.id_kelas' => $kelas))->where(array('a.id_mapel' => $mapel));
    $this->db->group_by(array("s.nama"));
    return $this->db->get()->result();
  }

  public function getLaporanPerKelasAdmin($kelas, $mapel)
  {


    $this->db->distinct('keterangan');
    // $this->db->select('count(keterangan == "sakit") as jmlketerangansakit, keterangan, bulan,tahun');
    // $this->db->where(array('id_kelas' => $kelas, 'id_mapel' => $mapel, 'keterangan !='=>"Hadir"));
    // $this->db->group_by(array("bulan", "tahun", "keterangan"));
    // return $this->db->get('absensi')->result();


    $this->db->select("count(case when keterangan = 'Sakit' then 1 else null end) as tSakit,
                        count(case when keterangan = 'Izin' then 1 else null end) as tIjin,
                        count(case when keterangan = 'Hadir' then 1 else null end) as tHadir,
                        count(case when keterangan = 'Alpha' then 1 else null end) as tAlpha,time_in,keterangan")
      ->from('absensi')
      ->like('semester', htmlspecialchars($this->input->post('smt', true)))
      ->like('tahun_ajaran', htmlspecialchars($this->input->post('thn', true)))
      ->where(array('id_kelas' => $kelas))->where(array('id_mapel' => $mapel));
    return $this->db->get()->result();
  }



  public function getSiswaAbsen($id_kelas, $tanggal, $mapel, $id)
  {
    $this->db->select('siswa.nama, siswa.nis, absensi.*');
    $this->db->from('siswa');
    $this->db->join('absensi', 'absensi.id_siswa = siswa.id_siswa');
    $this->db->where('absensi.time_in', $tanggal);
    $this->db->where('siswa.id_kelas', $id_kelas);
    $this->db->where('absensi.id_guru', $id);
    $this->db->where('absensi.id_mapel', $mapel);
    $this->db->order_by('time_in, nama', 'ASC');
    return $this->db->get()->result();
  }


  public function getSiswaAbsenAdmin($id_kelas, $tanggal, $mapel)
  {
    $this->db->select('siswa.nama, siswa.nis, absensi.*');
    $this->db->from('siswa');
    $this->db->join('absensi', 'absensi.id_siswa = siswa.id_siswa');
    $this->db->where('absensi.time_in', $tanggal);
    $this->db->where('siswa.id_kelas', $id_kelas);
    $this->db->where('absensi.id_mapel', $mapel);
    $this->db->order_by('time_in, nama', 'ASC');
    return $this->db->get()->result();
  }

  public function getRekap($id_kelas, $tanggal, $mapel, $id)
  {

    $this->db->distinct('keterangan');
    $this->db->select("count(case when keterangan = 'Hadir' then 1 else null end) as tHadir, count(case when keterangan = 'Sakit' then 1 else null end) as tSakit,
                        count(case when keterangan = 'Izin' then 1 else null end) as tIjin,
                        count(case when keterangan = 'Alpha' then 1 else null end) as tAlpha,tanggal_absen");
    $this->db->like('time_in', $tanggal);
    $this->db->where(array('id_kelas' => $id_kelas))->where(array('id_guru' => $id))->where(array('id_mapel' => $mapel));
    return $this->db->get('absensi')->result();
  }

  public function getRekapAdmin($id_kelas, $tanggal, $mapel)
  {

    $this->db->distinct('keterangan');
    $this->db->select("count(case when keterangan = 'Hadir' then 1 else null end) as tHadir, count(case when keterangan = 'Sakit' then 1 else null end) as tSakit,
                        count(case when keterangan = 'Izin' then 1 else null end) as tIjin,
                        count(case when keterangan = 'Alpha' then 1 else null end) as tAlpha,tanggal_absen");
    $this->db->like('time_in', $tanggal);
    $this->db->where(array('id_kelas' => $id_kelas))->where(array('id_mapel' => $mapel));
    return $this->db->get('absensi')->result();
  }
}

/* End of file Absensi_m.php */
