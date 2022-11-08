<?php
session_start();

if (isset($_POST["cd_usuario"]) && isset($_POST["senha"]) && isset($_POST["login"])) {

  $url = 'https://plus-api.unifebe.edu.br/api/login';
  $ch = curl_init($url);
  curl_setopt($ch, CURLOPT_HEADER, false);
  curl_setopt($ch, CURLOPT_NOBODY, false);
  curl_setopt($ch, CURLOPT_URL, $url);
  curl_setopt($ch, CURLOPT_SSL_VERIFYHOST, 0);
  curl_setopt($ch, CURLOPT_COOKIE, "cookiename=0");
  curl_setopt(
    $ch,
    CURLOPT_USERAGENT,
    "Mozilla/5.0 (Windows; U; Windows NT 5.0; en-US; rv:1.7.12) Gecko/20050915 Firefox/1.0.7"
  );
  curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
  curl_setopt($ch, CURLOPT_REFERER, $_SERVER['REQUEST_URI']);
  curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, 0);
  curl_setopt($ch, CURLOPT_FOLLOWLOCATION, 0);

  curl_setopt($ch, CURLOPT_CUSTOMREQUEST, "POST");
  curl_setopt($ch, CURLOPT_POST, 1);
  curl_setopt($ch, CURLOPT_POSTFIELDS, ['cd_usuario' => $_POST["cd_usuario"], 'senha' => $_POST["senha"]]);
  $logado = json_decode(curl_exec($ch));
  curl_close($ch);

  $_SESSION["cd_usuario"] = $logado->usuario->cd_usuario;
  $_SESSION["nome"] = $logado->usuario->nome;
  $_SESSION["setor"] = $logado->usuario->setor_id;
  $_SESSION["sistema"] = "achados_e_perdidos";

  //                   NI                                   SOAE                         
  if ($logado->usuario->setor_id === 77 || $logado->usuario->setor_id === 171) {
    $_SESSION["admin"] = true;
  } else {
    $_SESSION["admin"] = false;
  }

  header("Location: ./index.php");
}
