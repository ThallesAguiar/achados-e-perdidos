<?php
session_start();

$admin = false;
if (isset($_SESSION) && isset($_SESSION["admin"])) {
	$admin = $_SESSION["admin"];
}

?>

<!doctype html>
<html>

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>Achados e perdidos</title>
	<link rel="stylesheet" href="fonts/fontawesome/css/all.css">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
	<link rel="stylesheet" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
	<link rel="stylesheet" href="https://cdn.datatables.net/buttons/2.2.2/css/buttons.dataTables.min.css">
	<link href="./components/modal-assinatura/style.css" rel="stylesheet" type="text/css">
	<!-- JQUERY UI -->
	<link href="./assets/jquery-ui/jquery-ui.css" rel="stylesheet" type="text/css">
	<!-- ./JQUERY UI -->
</head>
<style>
	body {
		background: url("https://minha.unifebe.edu.br/images/background_unifebe.png") no-repeat fixed;
	}

	.btn-group,
	.btn-group-vertical,
	.ui-datepicker-trigger {
		display: none !important;
	}

	.container {
		background-color: #f8f9fa;
		border: 2px solid rgba(28, 110, 164, 0.15);
		border-radius: 7px 7px 7px 7px;
		margin-top: 10px;
	}
</style>

<body>

	<!-- Image and text -->
	<nav class="navbar navbar-light bg-light">
		<a class="navbar-brand" href="index.php?page=home.php">
			<img src="https://www.unifebe.edu.br/site/wp-content/uploads/unifebe.png" width="40" height="40" class="d-inline-block align-top" alt="">
			Achados e Perdidos<i style="color: #001b9fe6;" class="fa fa-home ml-5" aria-hidden="true"></i>
		</a>
		<?php if (isset($_SESSION) && isset($_SESSION["sistema"]) && $_SESSION["sistema"] == "achados_e_perdidos") : ?>
			<a class="navbar-brand" href="logout.php" style="color: #001b9fe6;"><i class="fa fa-right-from-bracket" aria-hidden="true"></i></a>
		<?php else : ?>
			<a class="navbar-brand" href="index.php?page=login" style="color: #001b9fe6;"><i class="fa fa-right-to-bracket" aria-hidden="true"></i></a>
		<?php endif ?>
	</nav>

	<div class="container">
		<div class="row">
			<div class="col-sm-12">
				<?php

				require_once("config.php");

				switch (@$_REQUEST["page"]) {
					case "achados":
						include("achados.php");
						break;
					case "perdidos":
						include("perdidos.php");
						break;
					case "info":
						include("cadastro.php");
						break;
					case "login":
						include("login.php");
						break;
					default:
						include("home.php");
				}
				?>
			</div>
		</div>
	</div>

	<!-- <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script> -->
	<script type="text/javascript" charset="utf8" src="./assets/ajax/index.js"></script>
	<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
	<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.js"></script>
	<!-- <script type="text/javascript" src="https://cdn.datatables.net/buttons/2.2.2/js/dataTables.buttons.min.js"></script> -->
	<script type="text/javascript" src="./assets/datatables/dataTables.bootstrap4.min.js"></script>
	<script type="text/javascript" src="./assets/datatables/dataTables.buttons.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
	<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
	<script type="text/javascript" src="./assets/datatables/buttons/buttons.html5.min.js"></script>
	<script type="text/javascript" src="./assets/datatables/buttons/buttons.print.min.js"></script>
	<script type="text/javascript" src="./assets/datatables/buttons/buttons.colVis.min.js"></script>

	<!-- JQUERY UI -->
	<script type="text/javascript" src="./assets/jquery-ui/jquery-ui.js"></script>
	<!-- ./JQUERY UI -->

	<script>
		$(document).ready(function() {
			const admin = '<?php echo $admin ?>';
			console.log(admin)

			if (admin) {
				let dNow = new Date();
				let localdate = dNow.getDate() + '/' + (dNow.getMonth() + 1) + '/' + dNow.getFullYear() + ' ' + dNow.getHours() + ':' + dNow.getMinutes();

				$('#tabela').DataTable({
					dom: 'Bfrtip',
					lengthMenu: [
						[10, 25, 50, -1],
						['10 linhas', '25 linhas ', '50 linhas', 'Mostrar tudo']
					],
					buttons: ['pageLength',
						{
							extend: 'excelHtml5',
							title: 'Relatório ',
							exportOptions: {
								columns: ':visible'
							}
						},
						// {
						// 	extend: 'csvHtml5',
						// 	title: 'Relatório ',
						// 	exportOptions: {
						// 		columns: ':visible'
						// 	}
						// },
						{
							extend: 'pdfHtml5',
							title: 'Relatório ',
							download: 'open',
							// orientation: 'landscape',
							// pageSize: 'LEGAL',
							customize: function(doc) {
								// Here's where you can control the cell padding
								// doc.styles.tableHeader.margin =
								doc.styles.tableBodyOdd.padding = [20, 20, 20, 20]
								doc.styles.tableBodyEven.padding = [20, 20, 20, 20];
							},
							messageTop: 'Relatório Achados e perdidos  , Relatório gerado na data ' + localdate,
							exportOptions: {
								columns: ':visible'
							}
						},
						{
							extend: 'print',
							title: 'Relatório Achados e perdidos ',
							messageTop: 'Relatório Tabela , Relatório gerado na data ' + localdate,
							exportOptions: {
								columns: ':visible'
							}
						}, 'colvis',
					],
					"language": {
						"url": "./assets/language/datatable_portuguese.json"
					}
				});
			} else {
				$('#tabela').DataTable({
					"language": {
						"url": "./assets/language/datatable_portuguese.json"
					}
				});
			}

		});

		$(`.datas`).datepicker({
			changeMonth: true,
			changeYear: true,
			showOn: "both",
			dateFormat: 'dd-mm-yy',
			defaultDate: new Date(),
			dayNames: ['Domingo', 'Segunda', 'Terça', 'Quarta', 'Quinta', 'Sexta', 'Sábado'],
			dayNamesMin: ['D', 'S', 'T', 'Q', 'Q', 'S', 'S', 'D'],
			dayNamesShort: ['Dom', 'Seg', 'Ter', 'Qua', 'Qui', 'Sex', 'Sáb', 'Dom'],
			monthNames: ['Janeiro', 'Fevereiro', 'Março', 'Abril', 'Maio', 'Junho', 'Julho', 'Agosto', 'Setembro', 'Outubro', 'Novembro', 'Dezembro'],
			monthNamesShort: ['Jan', 'Fev', 'Mar', 'Abr', 'Mai', 'Jun', 'Jul', 'Ago', 'Set', 'Out', 'Nov', 'Dez'],
			nextText: "Mês seguinte",
			prevText: "Mês anterior",
		});
	</script>
</body>

</html>
