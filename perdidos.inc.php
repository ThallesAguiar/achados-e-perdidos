<?php

if ($admin && isset($_GET["id"]) && isset($_GET["delete"])) {
	$sql = "DELETE FROM perdido WHERE id = " . $_GET["id"];

	mysqli_query($conn, $sql);

	if (mysqli_error($conn)) {
		echo json_encode(["error" => true, "msg" => mysqli_error($conn)]);
		die();
	}
} else if ($admin && isset($_GET["id"]) && isset($_GET["entregar"])) {
	date_default_timezone_set('America/Sao_Paulo');
	$agora = date("Y-m-d H:i");

	$sql = "UPDATE perdido 
	SET devolvido = 1, entregado_para = '{$_GET['dono']}', data_entrega= '$agora'
	WHERE id = " . $_GET["id"];

	mysqli_query($conn, $sql);

	if (mysqli_error($conn)) {
		echo json_encode(["error" => true, "msg" => mysqli_error($conn)]);
		die();
	}
} else if ($admin && isset($_GET["id"]) && isset($_GET["retornar"])) {
	$sql = "UPDATE perdido 
	SET devolvido = 0, entregado_para = null, data_entrega = null
	WHERE id = " . $_GET["id"];

	mysqli_query($conn, $sql);

	if (mysqli_error($conn)) {
		echo json_encode(["error" => true, "msg" => mysqli_error($conn)]);
		die();
	}
}


$sql = "SELECT * FROM perdido WHERE devolvido = 0 OR devolvido IS NULL AND entregado_para IS NULL ";
if ($admin) {
	// $sql = "SELECT * FROM perdido";

	$sql = "SELECT * FROM perdido WHERE 1=1 ";

	if (isset($_POST) && !empty($_POST)  && !isset($_POST["limpar"])) {
		if (!empty($_POST["devolvido"])) {
			$sql .= "AND devolvido = '{$_POST["devolvido"]}' ";
		} else {
			$sql .= "AND devolvido IS NULL ";
		}

		if (!empty($_POST["data_inicial_encontrado"]) || !empty($_POST["data_final_encontrado"])) {
			$data_inicial_encontrado = !empty($_POST["data_inicial_encontrado"]) ? date("Y-m-d", strtotime($_POST["data_inicial_encontrado"])) : date("Y-m-d", strtotime($_POST["data_final_encontrado"]));
			$data_final_encontrado = !empty($_POST["data_final_encontrado"]) ? date("Y-m-d", strtotime($_POST["data_final_encontrado"])) : date("Y-m-d", strtotime($_POST["data_inicial_encontrado"]));

			$sql .= "AND data_achado BETWEEN DATE('$data_inicial_encontrado') AND DATE('$data_final_encontrado') + INTERVAL 1 DAY ";
		}
		if (!empty($_POST["data_inicial_devolvido"]) || !empty($_POST["data_final_devolvido"])) {
			$data_inicial_devolvido = !empty($_POST["data_inicial_devolvido"]) ? date("Y-m-d", strtotime($_POST["data_inicial_devolvido"])) : date("Y-m-d", strtotime($_POST["data_final_devolvido"]));
			$data_final_devolvido = !empty($_POST["data_final_devolvido"]) ? date("Y-m-d", strtotime($_POST["data_final_devolvido"])) : date("Y-m-d", strtotime($_POST["data_inicial_devolvido"]));

			$sql .= "AND data_entrega BETWEEN DATE('$data_inicial_devolvido') AND DATE('$data_final_devolvido') + INTERVAL 1 DAY ";
		}
	}
}

$query = mysqli_query($conn, $sql);
if (mysqli_error($conn)) {
	echo json_encode(["error" => true, "msg" => mysqli_error($conn)]);
	die();
}

$perdidos = [];
while ($row = mysqli_fetch_array($query, true)) {
	$perdidos[] = $row;
}
