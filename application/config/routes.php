<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/userguide3/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'auth';

//auth
$route['login'] = 'auth';
$route['logout'] = 'auth/logout';

//admin
$route['admin'] = 'admin/home';
$route['kelas'] = 'admin/kelas';
$route['mapel'] = 'admin/mapel';
$route['data-guru'] = 'admin/DataGuru';
$route['add-guru'] = 'admin/DataGuru/addGuru';
$route['profile'] = 'admin/Profile';
$route['tambah-siswa'] = 'admin/DataSiswa/tambahSiswa';
$route['data-siswa'] = 'admin/DataSiswa';
$route['add-siswa'] = 'admin/DataSiswa/addSiswa';
$route['editPass'] = 'admin/Profile/editPass';
$route['data-rekap'] = 'admin/DataRekap';
$route['data-hadir'] = 'admin/DataKehadiran';
$route['pengaturan'] = 'admin/Pengaturan';
$route['export'] = 'admin/DataKehadiran/export';
$route['cetakrekap'] = 'admin/DataRekap/cetakrekap';
$route['jadwal'] = 'admin/Jadwal';
$route['jurusan'] = 'admin/DataJurusan';
$route['tahun_akademik'] = 'admin/DataTahunAkademik';
$route['add-jadwal'] = 'admin/Jadwal/tambah';
$route['updateAbsen'] = 'admin/DataKehadiran/updateAbsen';

//guru
$route['guru'] = 'guru/home';
$route['saveAbsen'] = 'guru/Absensi/saveAbsensi';
$route['gr/absensi'] = 'guru/absensi';
$route['gr/data-siswa'] = 'guru/DataSiswa';
$route['gr/data-jadwal'] = 'guru/Jadwal';
$route['gr/data-hadir'] = 'guru/DataKehadiran';
$route['gr/export'] = 'guru/DataKehadiran/export';
$route['gr/cetakrekap'] = 'guru/DataRekap/cetakrekap';
$route['gr/add-siswa'] = 'guru/DataSiswa/addSiswa';
$route['gr/data-rekap'] = 'guru/DataRekap';


$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
