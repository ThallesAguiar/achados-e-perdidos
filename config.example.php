<?php

define("PRODUCAO", false);

$host = "localhost";
$user = "root";
$pass = "";
$base = "achados_e_perdidos_dev";

if (PRODUCAO) {
	$base = "achados_e_perdidos";
}

$conn = new mysqli($host, $user, $pass, $base);

if ($conn->connect_error) {
	die("Erro: " . $conn->connect_error);
}

$conn->set_charset("utf8");
