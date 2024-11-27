<?php
$host = "localhost";
$user = "root";
$pass = "";
$db = "free_practice";

$mahasiswaAll = "SELECT a.nim, a.nama, c.nama AS fakultas, b.nama AS prodi FROM mahasiswa a INNER JOIN prodi b ON a.prodi_id = b.id INNER JOIN fakultas c ON b.fakultas_id = c.id";
$mahasiswaById = "SELECT a.nim AS nim, a.nama as nama, c.nama AS fakultas, b.nama AS prodi, b.id AS prodi_id FROM mahasiswa a INNER JOIN prodi b ON a.prodi_id = b.id INNER JOIN fakultas c ON b.fakultas_id = c.id where a.nim = ?";
$mahasiswaUpdate = "Update mahasiswa set nim = ?, nama = ?, prodi_id = ? where nim = ?";
$prodiOption = "Select id, nama from prodi";
$mahasiswaDelete = "DELETE FROM `mahasiswa` WHERE nim = ?";
$mahasiswaInsert = "INSERT INTO `mahasiswa`(`nama`, `nim`, `prodi_id`) VALUES (?,?,?)";

$mysqli = new mysqli($host, $user, $pass, $db);
if ($mysqli->connect_error) {
    die("tidak bisa terhubung ke database");
}
