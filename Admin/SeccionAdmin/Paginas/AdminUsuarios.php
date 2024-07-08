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

	if (isset($_POST['Registrar'])) { 
		$NombreEmpresa = $_POST['NombreTienda'];
		$NitEmpresa= $_POST['NitTienda']; 
		$Sentencia = $conexion->prepare('insert into empresa(Nombre,NIT) values (?, ?);');
		$arrParams=array($NombreEmpresa , $NitEmpresa);
		if ($Sentencia->execute($arrParams)) {
			header('Location:index.php');
		}else {
			echo '<script type="text/javascript">alert("Registro no modificado");</script>';
		}
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
			google: {"families":["Lato:300,400,700,900"]},
			custom: {"families":["Flaticon", "Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons"], urls: ['../assets/css/fonts.min.css']},
			active: function() {
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
			<div class="logo-header bg-info " >
				
				<a href="index.php" class="logo" style="color:white;">
				Software Kardex
				</a>
				<button class="navbar-toggler sidenav-toggler ml-auto" type="button" data-toggle="collapse" data-target="collapse" aria-expanded="false" aria-label="Toggle navigation">
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
							<a class="nav-link" data-toggle="collapse" href="#search-nav" role="button" aria-expanded="false" aria-controls="search-nav">
								<i class="fa fa-search"></i>
							</a>
						</li>
						<li class="nav-item dropdown hidden-caret">
							<a class="dropdown-toggle profile-pic" data-toggle="dropdown" href="#" aria-expanded="false">
								<div class="avatar-sm">
									<img src="../assets/img/Perfil/perfil.png" alt="..." class="avatar-img rounded-circle">
								</div>
							</a>
							<ul class="dropdown-menu dropdown-user animated fadeIn">
								<div class="dropdown-user-scroll scrollbar-outer">
									<li>
										<div class="user-box">
											<div class="avatar-lg"><img src="../assets/img/Perfil/perfil.png" alt="image profile" class="avatar-img rounded"></div>
											<div class="u-text">
												<h4><?php echo $datos['Nombre_Usuario']?></h4>
												<p class="text-muted"><?php echo $datos['Correo']?></p><a href="profile.html" class="btn btn-xs btn-secondary btn-sm">Ver Perfil</a>
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
		</div>
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
									<span class="user-level"><?php echo $datos['Nombre']." ".$datos['Apellido'];?></span>
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
				<div class="panel-header bg-info ">
					<div class="page-inner py-5">
						<div class="d-flex align-items-left align-items-md-center flex-column flex-md-row">
							<div>
								<h2 class="text-white pb-2 fw-bold">Administracion de usuarios</h2>
								<h5 class="text-white op-7 mb-2">Aplicativo web</h5>
							</div>
						</div>
					</div>
				</div>
				<div class="page-inner mt--5"><div class="col-md-12">
							<div class="card">
								<div class="card-header">
									<div class="d-flex align-items-center">
										<h4 class="card-title">Tabla de usuarios</h4>
										<a href="AgregarUsuario.php" class="btn btn-primary btn-round ml-auto" >
											<i class="fa fa-plus"></i>
											 Añadir nuevo usuario	
										</a>
									</div>	
								</div>
								<div class="card-body">
									<div class="table-responsive">
										<table id="add-row" class="display table table-striped table-hover" >
											<thead>
												<tr>
													<th>Id Usuario</th>
													<th>Cedula</th>
													<th>Nickname</th>
                                                    <th>Nombre</th>
													<th>Apellido</th>
													<th>Correo</th>
													<th>Contraseña</th>
                                                    <th>Estado</th>
													<th style="width: 10%">Accion</th>
												</tr>
											</thead>
											<tbody>
											<?php 
													$Sentencia = $conexion->prepare('select * from usuarios');
													$Sentencia ->execute(); 
													$resultado1 = $Sentencia -> fetchAll(PDO::FETCH_ASSOC);
															foreach ($resultado1 as $Array) {?>
																<tr align="center">
																<td align="center"><?php echo $Array['Id_Usuario'];?></td>
																<td align="center"><?php echo $Array['Cedula'];?></td>
																<td align="center"><?php echo $Array['Nombre_Usuario'];?></td>
																<td align="center"><?php echo $Array['Nombre'];?></td>
																<td align="center"><?php echo $Array['Apellido'];?></td>
																<td align="center"><?php echo $Array['Correo'];?></td>
																<td align="center"><?php echo $Array['Contraseña'];?></td>
															<?php 
																if ($Array['Id_Usuario']==$_SESSION['Id_Usuario']) { ?>
																		<td> <span class="badge badge-dot mr-3">
																			<i style=" color:#72F20E; padding-top:2px;" class="fas fa-check"></i>
																			<span class="status">Tu</span>
																			</span>
																		</td>
																<?php } elseif ($Array['Estado']==1) { ?>
																	<td>  <span class="badge badge-dot mr-3">
																		<i style=" color:#72F20E; padding-top:2px;" class="fas fa-check"></i>
																		<span class="status">Activo</span>
																		</span>
																	</td>
																	<?php }?>
																	<?php 
																		if ($Array['Id_Usuario']==$_SESSION['Id_Usuario']) { ?>
																		<td align="center">
																		<a  href="EditarUsuario.php?Id_Usuario=<?php echo $Array['Id_Usuario']?>" class="btn  btn-outline-danger btn-sm">
																			Editar</i>
																		</a>
																		</td>
																		<?php } elseif ($Array['Estado']==1) {?>
																		<td align="center">
																			<div class="dropdown">
																				<button class="btn btn-outline-primary btn-sm" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
																					<i class="fas fa-ellipsis-v"></i>
																				</button>
																				<div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
																					<a class="dropdown-item" href="EditarUsuario.php?Id_Usuario=<?php echo $Array['Id_Usuario']?>">Editar</a>
																					<a class="dropdown-item" href="EliminarUsuario.php?Id_Usuario=<?php echo $Array['Id_Usuario']?>">Eliminar</a>
																				</div>
																			</div>
																		</td>
																	<?php }?>  
															</tr>
												<?php  }?>
											</tbody>
										</table>
									</div>
								</div>
							</div>
						</div>
				</div>
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
							<br/>
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
							<br/>
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
			id:'circles-1',
			radius:45,
			value:60,
			maxValue:100,
			width:7,
			text: 5,
			colors:['#f1f1f1', '#FF9E27'],
			duration:400,
			wrpClass:'circles-wrp',
			textClass:'circles-text',
			styleWrapper:true,
			styleText:true
		})

		Circles.create({
			id:'circles-2',
			radius:45,
			value:70,
			maxValue:100,
			width:7,
			text: 36,
			colors:['#f1f1f1', '#2BB930'],
			duration:400,
			wrpClass:'circles-wrp',
			textClass:'circles-text',
			styleWrapper:true,
			styleText:true
		})

		Circles.create({
			id:'circles-3',
			radius:45,
			value:40,
			maxValue:100,
			width:7,
			text: 12,
			colors:['#f1f1f1', '#F25961'],
			duration:400,
			wrpClass:'circles-wrp',
			textClass:'circles-text',
			styleWrapper:true,
			styleText:true
		})

		var totalIncomeChart = document.getElementById('totalIncomeChart').getContext('2d');

		var mytotalIncomeChart = new Chart(totalIncomeChart, {
			type: 'bar',
			data: {
				labels: ["S", "M", "T", "W", "T", "F", "S", "S", "M", "T"],
				datasets : [{
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
						gridLines : {
							drawBorder: false,
							display : false
						}
					}],
					xAxes : [ {
						gridLines : {
							drawBorder: false,
							display : false
						}
					}]
				},
			}
		});

		$('#lineChart').sparkline([105,103,123,100,95,105,115], {
			type: 'line',
			height: '70',
			width: '100%',
			lineWidth: '2',
			lineColor: '#ffa534',
			fillColor: 'rgba(255, 165, 52, .14)'
		});
	</script>
</body>
</html>