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
		$datos1 =  $Sentencia ->fetch(PDO::FETCH_ASSOC);

		$Sentencia = $conexion->prepare('SELECT IdCategoria,Nombre FROM categorias');
		$Sentencia ->execute(); 
		$Categorias =  $Sentencia ->fetchAll(PDO::FETCH_ASSOC);
	}else {
		echo "Error en la variable";
	}


    if  (isset($_GET['Id_Articulo'])) {
        $Id = $_GET['Id_Articulo'];
        $Sentencia = $conexion->prepare('select * from articulos where Id_Articulo = ?;');
        $Sentencia ->execute([$Id]); 
        $datos =  $Sentencia ->fetch(PDO::FETCH_ASSOC);
        if ($Sentencia-> rowCount() > 0) {
			$Codigo = $datos['Codigo'];
            $Nombre = $datos['Nombre'];
            $Cantidad = $datos['Cantidad'];
            $Marca = $datos['Marca'];
            $PrecioCosto = $datos['PrecioCosto'];
            $PrecioVenta = $datos['PrecioVenta'];
            $StockIdeal = $datos['StockIdeal'];
			$Descripcion =$datos['Descripcion'];
        }
      }
      if (isset($_POST['Enviar'])) { 
		$Codigo = $_POST['Codigo'];
		$Nombre = $_POST['Nombre'];
		$Cantidad= $_POST['Cantidad']; 
		$Marca= $_POST['Marca']; 
		$PrecioCosto= $_POST['PrecioCosto']; 
		$PrecioVenta= $_POST['PrecioVenta']; 
		$StockIdeal= $_POST['StockIdeal']; 
		$Categoria = $_POST['Categoria'];
		$Descripcion = $_POST['Descripcion'];
        $Sentencia = $conexion->prepare('UPDATE articulos set  Codigo =?,Id_Categoria = ?,Nombre = ?,Descripcion = ? ,Cantidad = ?, Marca = ?, PrecioCosto = ?, PrecioVenta = ?, StockIdeal = ? where Id_Articulo = ?');
        $arrParams=array($Codigo,$Categoria,$Nombre,$Descripcion,$Cantidad,$Marca, $PrecioCosto, $PrecioVenta, $StockIdeal, $Id);
        if ($Sentencia->execute($arrParams)) {
          header('Location:Productos.php');
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
			<div class="logo-header bg-info">
				
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
												<h4><?php echo $datos1['Nombre_Usuario']?></h4>
												<p class="text-muted"><?php echo $datos1['Correo']?></p><a href="profile.html" class="btn btn-xs btn-secondary btn-sm">Ver Perfil</a>
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
									<?php echo $datos1['Nombre_Usuario']?>
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
								<h2 class="text-white pb-2 fw-bold">Productos y articulos</h2>
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
									<div class="card-title">Editar Producto</div>
								</div>
								<div class="card-body">
									<form action="EditarProducto.php?Id_Articulo=<?php echo $_GET['Id_Articulo']; ?>" method="post">
												<div class="row">
												<div class="col-md-4 col-lg-4">
														<div class="form-group">
															<label for="email2">Codigo</label>
															<input type="text" class="form-control" name="Codigo"  value="<?php echo $datos['Codigo'];?>" >
														</div>
													</div>
													<div class="col-md-4 col-lg-4">
														<div class="form-group">
															<label for="email2">Nombre</label>
															<input type="text" class="form-control" name="Nombre"  value="<?php echo $datos['Nombre'];?>" >
														</div>
													</div>
													<div class="col-md-4 col-lg-4">
														<div class="form-group">
															<label for="email2">Cantidad</label>
															<input type="number" class="form-control" name="Cantidad" value="<?php echo $datos['Cantidad'];?>">
														</div>
													</div>			
												</div>
												<div class="row">
													<div class="col-md-6 col-lg-6">
														<div class="form-group">
															<label for="email2">Marca</label>
															<input type="text" class="form-control" name="Marca"  value="<?php echo $datos['Marca'];?>">
														</div>
													</div>
													<div class="col-md-6 col-lg-6">
														<div class="form-group">
															<label for="email2">Stock Ideal</label>
															<input type="number" class="form-control" name="StockIdeal" value="<?php echo $datos['StockIdeal'];?>">
														</div>
													</div>	
																
												</div>
												<div class="row">
													<div class="col-md-4 col-lg-4">
														<div class="form-group">
															<label for="email2">Precio de venta</label>
															<input type="number" class="form-control" name="PrecioVenta"  value="<?php echo $datos['PrecioVenta'];?>">
														</div>
													</div>
													<div class="col-md-4 col-lg-4">
														<div class="form-group">
															<label for="email2">Precio de costo</label>
															<input type="number" class="form-control" name="PrecioCosto" value="<?php echo $datos['PrecioCosto'];?>" >
														</div>
													</div>
													<div class="col-md-4 col-lg-4">
														<div class="form-group">
															<label for="email2">Categoria</label>
															<select name="Categoria" id="" class="form-control">
															<option value="0">N/A</option>
															<?php 
															 foreach ($Categorias as $Cat ) {
																 $seleccion = "";
																 if ($Cat['IdCategoria'] == $datos['Id_Categoria']) {
																	$seleccion = 'Selected';
																 }else{
																	$seleccion = '';
																 }
																 echo "<option $seleccion value=".$Cat['IdCategoria'].">".$Cat['Nombre']."</option>";
															 }
															?>
															
															</select>
														</div>
													</div>			
												</div>

												<div class="row">
													<div class="col-md-12 col-lg-12">
														<div class="form-group">
															<label for="Descripcion">Descripcion</label>
															
															  <textarea class="form-control" name="" id="" rows="3"><?php echo $Descripcion  ?></textarea>
															
														</div>
													</div>			
												</div>
										</div>
										<div class="card-action">
											<button name="Enviar" class="btn btn-success">Modificar articulo</button>
											<button class="btn btn-danger">Borrar Campos</button>
										</div>
							        </form>
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