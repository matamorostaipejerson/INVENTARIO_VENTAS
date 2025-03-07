<?php 

	require('../php/db.php');
	$objeto = new Conexion();  
	$conexion =$objeto-> Conectar();
	session_start();

	if (!isset($_SESSION['Id_Usuario'])) {
		header("Location: ../../../Login/index.php");
	}
	if (!isset($_SESSION['Estado'])) {
	  header('../Login/index.php');
	  if($_SESSION['Estado']!='1'){
		  header('location:../../../Login/index.php');
	  } 
	}
	if (isset($_SESSION['Id_Usuario'])) {
		$Id=$_SESSION['Id_Usuario'];
		$Sentencia = $conexion->prepare('select * from usuarios where Id_Usuario = ?;');
		$Sentencia ->execute([$Id]); 
		$datos =  $Sentencia ->fetch(PDO::FETCH_ASSOC);
	}else {
		echo "Error en la variable";
	}

	if (isset($_GET['FechaInicio']) && isset($_GET['FechaFinal'])  ) { 
		$validacion = true;
		$fechaInicio =$_GET['FechaInicio'];
		$fechaFinal =$_GET['FechaFinal'];
		$Sentencia = $conexion->prepare("SELECT * from entradas WHERE Fecha BETWEEN '$fechaInicio' and '$fechaFinal' AND Procesado=0 AND Estado=1");
		$Sentencia ->execute(); 
		$Entradas =  $Sentencia ->fetchAll(PDO::FETCH_ASSOC);
	}else{
		$validacion=false;
	}

?>


<!DOCTYPE html>
<html lang="en">

<head>
	<meta http-equiv="X-UA-Compatible" content="IE=edge" />
	<title>Software Kardex</title>
	<meta content='width=device-width, initial-scale=1.0, shrink-to-fit=no' name='viewport' />
	<link href="../assets/img/favicon.png" rel="icon">

	<!-- Fonts and icons -->
	<script src="../assets/js/plugin/webfont/webfont.min.js"></script>
	<script>
		WebFont.load({
			google: {
				"families": ["Lato:300,400,700,900"]
			},
			custom: {
				"families": ["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands",
					"simple-line-icons"
				],
				urls: ['../assets/css/fonts.min.css']
			},
			active: function () {
				sessionStorage.fonts = true;
			}
		});
	</script>

	<!-- CSS Files -->
	<link rel="stylesheet" href="../assets/css/bootstrap.min.css">
	<link rel="stylesheet" href="../assets/css/atlantis.min.css">

	<!-- CSS Just for demo purpose, don't include it in your project -->
	<link rel="stylesheet" href="../assets/css/demo.css">
</head>

<body>
	<div class="wrapper">
		<div class="main-header">
			<!-- Logo Header -->
			<div class="logo-header bg-info">

				<a href="index.php" class="logo" style="color:white;">
					Software Kardex
				</a>
				<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse"
					data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
					<span class="navbar-toggler-icon">
						<i class="icon-menu"></i>
					</span>
				</button>
				<button class="topbar-toggler more"><i class="icon-options-vertical"></i></button>
				<div class="nav-toggle">
					<button class="btn btn-toggle toggle-sidebar">
						<i class="icon-menu"></i>
					</button>
				</div>
			</div>
			<!-- End Logo Header -->

			<!-- Navbar Header -->
			<nav class="navbar navbar-header navbar-expand-lg" data-background-color="blue2">

				<div class="container-fluid">
					<div class="collapse" id="search-nav">
						<form class="navbar-left navbar-form nav-search mr-md-3">
							<div class="input-group">
								<div class="input-group-prepend">
									<button type="submit" class="btn btn-search pr-1">
										<i class="fa fa-search search-icon"></i>
									</button>
								</div>
								<input type="text" placeholder="Buscar" class="form-control">
							</div>
						</form>
					</div>
					<ul class="navbar-nav topbar-nav ml-md-auto align-items-center">
						<li class="nav-item toggle-nav-search hidden-caret">
							<a class="nav-link" data-toggle="collapse" href="#search-nav" role="button"
								aria-expanded="false" aria-controls="search-nav">
								<i class="fa fa-search"></i>
							</a>
						</li>
						<li class="nav-item dropdown hidden-caret">
							<a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#"
								aria-expanded="false">
								<div class="avatar-sm">
									<img src="../assets/img/Perfil/perfil.png" alt="..."
										class="avatar-img rounded-circle">
								</div>
							</a>
							<ul class="dropdown-menu dropdown-user animated fadeIn">
								<div class="dropdown-user-scroll scrollbar-outer">
									<li>
										<div class="user-box">
											<div class="avatar-lg"><img src="../assets/img/Perfil/perfil.png"
													alt="image profile" class="avatar-img rounded"></div>
											<div class="u-text">
												<h4><?php echo $datos['Nombre_Usuario']?></h4>
												<p class="text-muted"><?php echo $datos['Correo']?></p><a
													href="profile.html" class="btn btn-xs btn-secondary btn-sm">Ver
													Perfil</a>
											</div>
										</div>
									</li>
									<li>
										<div class="dropdown-divider"></div>
										<a class="dropdown-item" href="#">Mi Perfil</a>
										<div class="dropdown-divider"></div>
										<a class="dropdown-item" href="#">Configuracion</a>
										<div class="dropdown-divider"></div>
										<a class="dropdown-item" href="CerrarSesion.php">Cerrar sesion</a>
									</li>
								</div>
							</ul>
						</li>
					</ul>
				</div>
			</nav>
			<!-- End Navbar -->
		</div>

		<!-- Sidebar -->
		<div class="sidebar sidebar-style-2">
			<div class="sidebar-wrapper scrollbar scrollbar-inner">
				<div class="sidebar-content">
					<div class="user">
						<div class="avatar-sm float-left mr-2">
							<img src="../assets/img/Perfil/perfil.png" alt="..." class="avatar-img rounded-circle">
						</div>
						<div class="info">
							<a data-toggle="collapse" href="#collapseExample" aria-expanded="true">
								<span>
									<?php echo $datos['Nombre_Usuario']?>
									<span class="user-level">Perfil</span>
									<span class="caret"></span>
								</span>
							</a>
							<div class="clearfix"></div>
							<div class="collapse in" id="collapseExample">
								<ul class="nav">
									<li>
										<a href="#profile">
											<span class="link-collapse">Mi perfil</span>
										</a>
									</li>
									<li>
										<a href="#edit">
											<span class="link-collapse">Editar perfil</span>
										</a>
									</li>
									<li>
										<a href="#settings">
											<span class="link-collapse">Configuracion</span>
										</a>
									</li>
								</ul>
							</div>
						</div>
					</div>
					<?php  include "./../Modelosphp/MenuLateral.php" ?>
				</div>
			</div>
		</div>

		<div class="main-panel">
			<div class="content">
				<div class="panel-header bg-info">
					<div class="page-inner py-5">
						<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
							<div>
								<h2 class="text-white pb-2 fw-bold">REPORTE DE EGRESOS POR DIA</h2>
								<h5 class="text-white op-7 mb-2">Aplicativo web</h5>
							</div>
						</div>
					</div>
				</div>
				<div class="page-inner mt--5">
					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<div class="card-title">Consultar Egresos</div>
								</div>
								<div class="card-body">
									<form method="GET" action="<?php echo $_SERVER['PHP_SELF'];  ?>">
										<div class="row">
											<div class="col-md-5 col-lg-5">
												<div class="form-group">
													<label for="FechaInicial">Fecha Inicial</label>
													<input type="date" class="form-control" id="FechaInicial"
														name="FechaInicio">
												</div>
											</div>
											<div class="col-md-5 col-lg-5">
												<div class="form-group">
													<label for="FechaFinal">Fecha Final</label>
													<input type="date" class="form-control" id="Fecha"
														name="FechaFinal">
												</div>
											</div>
											<div class="col-md-2 col-lg-2">
												<div class="form-group mt-4">
													<button class="btn btn-success" type="submit">Consultar</button>
												</div>
											</div>
										</div>
									</form>

								</div>
								<div class="card-action">


								</div>
							</div>
						</div>
					</div>

					<?php if ($validacion) {   $Vtotal=0;?>


					<div class="row">
						<div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<h4 class="card-title">Tabla de Egresos de: <span
											id="FechaIncial"><?php echo $fechaInicio?><strong>&nbsp; A &nbsp;</strong>
										</span><?php echo $fechaFinal?><span id="FechaFinal"></span></h4>
									<div class="row">
										<div class="col-md-6 col-lg-6">
											<div class="form-group ">
												<input type="text" value="Nombre" class="form-control" id="Nombre">
											</div>
										</div>
										<div class="col-md-4 col-lg-4">
											<div class="form-group ">
												<button class="btn btn-success form-control"
													id="BtnAdd">Ingresar</button>
											</div>
										</div>
									</div>
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table id="tblAdministracion" class="display table table-striped table-hover">
											<thead>
												<tr>
													<th>Id Entrada</th>
													<th>Fecha</th>
													<th>Nombre Entrada</th>
													<th>Valor Total</th>

												</tr>
											</thead>
											<tbody>
												<?php foreach ($Entradas as $Entrada ) {?>
												<tr>
													<td><?php echo $Entrada['Id_Entrada'] ?></td>
													<td><?php echo $Entrada['Fecha'] ?></td>
													<td><?php echo $Entrada['Nombre'] ?></td>
													<td><?php echo $Entrada['ValorTotal'] ?></td>
												</tr>
												<?php  $Vtotal += $Entrada['ValorTotal'];  } ?>

											</tbody>
										</table>
										
									</div>
									<div class="row">
											<div class="col-md-6 col-lg-6">
												
											</div>
											<div class="col-md-4 col-lg-4">
												<div class="form-group ">
													
												</div>
											</div>
											<div class="col-md-2 col-lg-2">
												<div class="form-group ">
												<label for="Total de egresos">Valor Total de egresos</label>
													<input type="text" disabled class="form-control" id="VTotal" style="text-align: right;"
														value="<?php echo $Vtotal  ?>">
												</div>
											</div>
										</div>
								</div>
							</div>
						</div>
					</div>
					<?php  } ?>


				</div>
				<footer class="footer">
					<div class="container-fluid">
						<div class="copyright ml-auto">
							Fundacion Universitaria Uninpahu
						</div>
					</div>
				</footer>
			</div>
			<div class="custom-template">
				<div class="title">Settings</div>
				<div class="custom-content">
					<div class="switcher">
						<div class="switch-block">
							<h4>Logo Header</h4>
							<div class="btnSwitch">
								<button type="button" class="changeLogoHeaderColor" data-color="dark"></button>
								<button type="button" class="selected changeLogoHeaderColor" data-color="blue"></button>
								<button type="button" class="changeLogoHeaderColor" data-color="purple"></button>
								<button type="button" class="changeLogoHeaderColor" data-color="light-blue"></button>
								<button type="button" class="changeLogoHeaderColor" data-color="green"></button>
								<button type="button" class="changeLogoHeaderColor" data-color="orange"></button>
								<button type="button" class="changeLogoHeaderColor" data-color="red"></button>
								<button type="button" class="changeLogoHeaderColor" data-color="white"></button>
								<br />
								<button type="button" class="changeLogoHeaderColor" data-color="dark2"></button>
								<button type="button" class="changeLogoHeaderColor" data-color="blue2"></button>
								<button type="button" class="changeLogoHeaderColor" data-color="purple2"></button>
								<button type="button" class="changeLogoHeaderColor" data-color="light-blue2"></button>
								<button type="button" class="changeLogoHeaderColor" data-color="green2"></button>
								<button type="button" class="changeLogoHeaderColor" data-color="orange2"></button>
								<button type="button" class="changeLogoHeaderColor" data-color="red2"></button>
							</div>
						</div>
						<div class="switch-block">
							<h4>Navbar Header</h4>
							<div class="btnSwitch">
								<button type="button" class="changeTopBarColor" data-color="dark"></button>
								<button type="button" class="changeTopBarColor" data-color="blue"></button>
								<button type="button" class="changeTopBarColor" data-color="purple"></button>
								<button type="button" class="changeTopBarColor" data-color="light-blue"></button>
								<button type="button" class="changeTopBarColor" data-color="green"></button>
								<button type="button" class="changeTopBarColor" data-color="orange"></button>
								<button type="button" class="changeTopBarColor" data-color="red"></button>
								<button type="button" class="changeTopBarColor" data-color="white"></button>
								<br />
								<button type="button" class="changeTopBarColor" data-color="dark2"></button>
								<button type="button" class="selected changeTopBarColor" data-color="blue2"></button>
								<button type="button" class="changeTopBarColor" data-color="purple2"></button>
								<button type="button" class="changeTopBarColor" data-color="light-blue2"></button>
								<button type="button" class="changeTopBarColor" data-color="green2"></button>
								<button type="button" class="changeTopBarColor" data-color="orange2"></button>
								<button type="button" class="changeTopBarColor" data-color="red2"></button>
							</div>
						</div>
						<div class="switch-block">
							<h4>Sidebar</h4>
							<div class="btnSwitch">
								<button type="button" class="selected changeSideBarColor" data-color="white"></button>
								<button type="button" class="changeSideBarColor" data-color="dark"></button>
								<button type="button" class="changeSideBarColor" data-color="dark2"></button>
							</div>
						</div>
						<div class="switch-block">
							<h4>Background</h4>
							<div class="btnSwitch">
								<button type="button" class="changeBackgroundColor" data-color="bg2"></button>
								<button type="button" class="changeBackgroundColor selected" data-color="bg1"></button>
								<button type="button" class="changeBackgroundColor" data-color="bg3"></button>
								<button type="button" class="changeBackgroundColor" data-color="dark"></button>
							</div>
						</div>
					</div>
				</div>
				<div class="custom-toggle">
					<i class="flaticon-settings"></i>
				</div>
			</div>
			<!-- End Custom template -->
		</div>
		<!--   Core JS Files   -->
		<script src="../assets/js/core/jquery.3.2.1.min.js"></script>
		<script src="../assets/js/core/popper.min.js"></script>
		<script src="../assets/js/core/bootstrap.min.js"></script>

		<!-- jQuery UI -->
		<script src="../assets/js/plugin/jquery-ui-1.12.1.custom/jquery-ui.min.js"></script>
		<script src="../assets/js/plugin/jquery-ui-touch-punch/jquery.ui.touch-punch.min.js"></script>

		<!-- jQuery Scrollbar -->
		<script src="../assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js"></script>


		<!-- Chart JS -->
		<script src="../assets/js/plugin/chart.js/chart.min.js"></script>

		<!-- jQuery Sparkline -->
		<script src="../assets/js/plugin/jquery.sparkline/jquery.sparkline.min.js"></script>

		<!-- Chart Circle -->
		<script src="../assets/js/plugin/chart-circle/circles.min.js"></script>

		<!-- Datatables -->
		<script src="../assets/js/plugin/datatables/datatables.min.js"></script>

		<!-- Bootstrap Notify -->
		<script src="../assets/js/plugin/bootstrap-notify/bootstrap-notify.min.js"></script>

		<!-- jQuery Vector Maps -->
		<script src="../assets/js/plugin/jqvmap/jquery.vmap.min.js"></script>
		<script src="../assets/js/plugin/jqvmap/maps/jquery.vmap.world.js"></script>

		<!-- Sweet Alert -->
		<script src="../assets/js/plugin/sweetalert/sweetalert.min.js"></script>

		<!-- Atlantis JS -->
		<script src="../assets/js/atlantis.min.js"></script>

		<!-- Atlantis DEMO methods, don't include it in your project! -->
		<script src="../assets/js/setting-demo.js"></script>
		<script src="../assets/js/demo.js"></script>
		<script>
			Circles.create({
				id: 'circles-1',
				radius: 45,
				value: 60,
				maxValue: 100,
				width: 7,
				text: 5,
				colors: ['#f1f1f1', '#FF9E27'],
				duration: 400,
				wrpClass: 'circles-wrp',
				textClass: 'circles-text',
				styleWrapper: true,
				styleText: true
			})

			Circles.create({
				id: 'circles-2',
				radius: 45,
				value: 70,
				maxValue: 100,
				width: 7,
				text: 36,
				colors: ['#f1f1f1', '#2BB930'],
				duration: 400,
				wrpClass: 'circles-wrp',
				textClass: 'circles-text',
				styleWrapper: true,
				styleText: true
			})

			Circles.create({
				id: 'circles-3',
				radius: 45,
				value: 40,
				maxValue: 100,
				width: 7,
				text: 12,
				colors: ['#f1f1f1', '#F25961'],
				duration: 400,
				wrpClass: 'circles-wrp',
				textClass: 'circles-text',
				styleWrapper: true,
				styleText: true
			})

			var totalIncomeChart = document.getElementById('totalIncomeChart').getContext('2d');

			var mytotalIncomeChart = new Chart(totalIncomeChart, {
				type: 'bar',
				data: {
					labels: ["S", "M", "T", "W", "T", "F", "S", "S", "M", "T"],
					datasets: [{
						label: "Total Income",
						backgroundColor: '#ff9e27',
						borderColor: 'rgb(23, 125, 255)',
						data: [6, 4, 9, 5, 4, 6, 4, 3, 8, 10],
					}],
				},
				options: {
					responsive: true,
					maintainAspectRatio: false,
					legend: {
						display: false,
					},
					scales: {
						yAxes: [{
							ticks: {
								display: false //this will remove only the label
							},
							gridLines: {
								drawBorder: false,
								display: false
							}
						}],
						xAxes: [{
							gridLines: {
								drawBorder: false,
								display: false
							}
						}]
					},
				}
			});

			$('#lineChart').sparkline([105, 103, 123, 100, 95, 105, 115], {
				type: 'line',
				height: '70',
				width: '100%',
				lineWidth: '2',
				lineColor: '#ffa534',
				fillColor: 'rgba(255, 165, 52, .14)'
			});
		</script>
		<script src="./../Js/moment.js"></script>
		<script src="./../Js/moment-with-locales.js"></script>
		<script src="./../Js/Administracion.js"></script>
</body>

</html>