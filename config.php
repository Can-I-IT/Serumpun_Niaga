<?php
$host = 'localhost';
$user = 'root';
$pass = 'Safwan1234.';
$dbname = 'serumpun_db';

$conn = mysqli_connect($host, $user, $pass, $dbname);

if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}
?>
