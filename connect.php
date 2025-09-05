<?php
$server = 'localhost';
$user = 'root';
$psw = '';
$dbname = 'db_dos_guri';

$conn = mysqli_connect($server, $user, $psw, $dbname);

if(!$conn){
    die("Erro na conexão: " . mysqli_connect_error());
}
?>