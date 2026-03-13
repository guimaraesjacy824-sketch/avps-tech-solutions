<?php
$host = "localhost";
$user = "root";
$pass = "";
$db   = "avps_tech_db";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Exemplo de Query para listar produtos
// $sql = "SELECT * FROM produtos";
// $result = $conn->query($sql);
?>
