<?php
//DEBUGGING
ini_set('error_reporting',E_ALL);
//INFO DATABASE
define('DATABASE_HOST','localhost');
define('DATABASE_NAME','mjt_database');
define('DATABASE_USER','root');
define('DATABASE_PASS', '');
//INFORMASI PERUSAHAAN
define('LOGO_PERUSAHAAN','img/logo.png');
define('LEBAR_LOGO','350');
define('TINGGI_LOGO','125');
define('NAMA_PERUSAHAAN','PT.MJT');
define('ALAMAT_PERUSAHAAN','Jalan Cemara No,325');
define('KOTA_PERUSAHAAN','Medan');
define('NOMOR_PERUSAHAAN','081212343322');

//SETTING LAINNYA
DEFINE('INVOICE_THEME','#222222');
DEFINE('TIMEZONE','Asia/Jakarta');
DEFINE('DATE_FORMAT','DD/MM/YYYY');
DEFINE('CURRENCY','Rp');
DEFINE('FOOTER_NOTE','PT.MJT');
 //eksekusi si query dan simpan data di database
 $koneksi = new mysqli(DATABASE_HOST, DATABASE_USER, DATABASE_PASS, DATABASE_NAME);
 if(!$koneksi) {
    die("koneksi gagal : " .mysqli_connect_error());
}
?>