<?php
$hostname = 'localhost';
$db = 'srichaitanya';
$username='root';
$password= 'ritik';

$conn = new mysqli($hostname, $username, $password, $db);

if($conn->connect_error) {
    die("Connection failed: " . $db->connect_error);
}
?>