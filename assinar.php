<?php

require_once("./config.php");

if (isset($_POST["cd_usuario"]) && isset($_POST["senha"]) && isset($_POST["assinar"])) {

    $params = array(
        'codigo' => $_POST["cd_usuario"],
        'senha' => $_POST["senha"],
        'tipo' => null
    );

    $url = 'https://minha.unifebe.edu.br/cursos/inscricao/servicos/validarLogin';
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
    curl_setopt(
        $ch,
        CURLOPT_POSTFIELDS,
        http_build_query($params)
    );

    $response = curl_exec($ch);

    mb_convert_encoding($response, 'ISO-8859-1', 'UTF-8');
    $httpCode = curl_getinfo($ch, CURLINFO_HTTP_CODE);

    curl_close($ch);

    if ($httpCode === 200) {
        $oXML = new SimpleXMLElement($response);
        $responseJson = json_encode($oXML);
        $responseDecode = json_decode($responseJson);


        $assinatura = $_POST["cd_usuario"] . " - " . $responseDecode->nome;

        date_default_timezone_set('America/Sao_Paulo');
        $agora = date("Y-m-d H:i");

        $sql = "UPDATE perdido 
        SET devolvido = 1, entregado_para = '$assinatura', data_entrega= '$agora'
        WHERE id = " . $_POST["id"];

        mysqli_query($conn, $sql);

        if (mysqli_error($conn)) {
            echo json_encode(["error" => true, "msg" => mysqli_error($conn)]);
            die();
        }

        header("Location: ./index.php?page=perdidos");
    }

    echo json_encode(["error" => true, "msg" => "Erro ao tentar autenticar."]);
    die();
}
