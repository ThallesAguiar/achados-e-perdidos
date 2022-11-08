<?php
require_once("./config.php");

$achado  = @$_REQUEST["nome_achado"];
$data    = @$_REQUEST["data_achado"];
$horario    = @$_REQUEST["horario_achado"];
$imagem  = @$_REQUEST["img_achado"];
$nome    = @$_REQUEST["nome_pessoa"];
$local   = @$_REQUEST["local"];

$datetime= $data." ".$horario;

$sql = "INSERT INTO perdido (nome_achado, data_achado, nome_pessoa, local) VALUES ('{$achado}','{$datetime}', '{$nome}', '{$local}')";

$result = $conn->query($sql);

if($result==true){
	print "<div class='alert alert-success'>Cadastrou com sucesso!</div>";
	header("Location: ./index.php");
}else{
	print "<div class='alert alert-danger'>Não foi possível cadastrar</div>"; 
}
