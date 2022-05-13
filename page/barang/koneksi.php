<?php 
 error_reporting(E_ALL ^ (E_NOTICE | E_WARNING));  
define("HOST", "localhost");
define("USER", "root");
define("PASS", "");
define("DB", "db_web");

$koneksi = new mysqli(HOST, USER, PASS, db_web);
if ($koneksi->connect_error) {
	trigger_error('maaf koneksi gagal:' . $koneksi->connect_error, E_USER_ERROR);
}
 ?>