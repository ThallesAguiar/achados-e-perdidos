<?php
require_once("./config.php");

if ($admin && isset($_POST["atualizar"]) && !empty($_POST)) {
  $sql = "UPDATE perdido 
	SET nome_achado = '{$_POST['nome_achado']}', data_achado = '{$_POST['data_achado']}', nome_pessoa = '{$_POST['nome_pessoa']}', `local`= '{$_POST['local']}'
	WHERE id = " . $_POST["id"];

  mysqli_query($conn, $sql);

  if (mysqli_error($conn)) {
    echo json_encode(["error" => true, "msg" => mysqli_error($conn)]);
    die();
  }

  header("Location: ./index.php?page=perdidos");
}

$sql = "SELECT * FROM perdido WHERE id= {$_GET['id']} ";

$query = mysqli_query($conn, $sql);
if (mysqli_error($conn)) {
  echo json_encode(["error" => true, "msg" => mysqli_error($conn)]);
  die();
}

$perdido = mysqli_fetch_assoc($query);
