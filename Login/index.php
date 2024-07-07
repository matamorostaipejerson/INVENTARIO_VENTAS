<?php
require ('php/db.php');
$objeto = new Conexion();
$conexion = $objeto->Conectar();
$error = '';
session_start();
if (isset($_POST['submit'])) {
	$Nombre = $_POST['Nombre'];
	$Contraseña = $_POST['Contraseña'];
	$Sentencia = $conexion->prepare('select * from usuarios where Nombre_Usuario = ? and Contraseña = ?;');
	$Sentencia->execute([$Nombre, $Contraseña]);
	$datos = $Sentencia->fetch(PDO::FETCH_OBJ);
	if ($Sentencia->rowCount() == 0) {
		$error = "Error de usuario";
		header('location:index.php');
	} elseif ($Sentencia->rowCount() == 1) {
		$_SESSION['Id_Usuario'] = $datos->Id_Usuario;
		$_SESSION['Estado'] = $datos->Estado;
		$Estado = $_SESSION['Estado'];
		header('location:../Admin/SeccionAdmin/Paginas/loader.php');
	}
}
?>

<html lang="en">

<head>
	<title>Ingresar</title>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<link href="img/favicon.png" rel="icon">
	<link href="https://fonts.googleapis.com/css?family=Lato:300,400,700,900&display=swap" rel="stylesheet">

	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">

	<link rel="stylesheet" href="css/style.css">

</head>

<body>
	<section class="ftco-section">
		<div class="container">
			<div class="row justify-content-center">
			</div>
			<div class="row justify-content-center">
				<div class="col-md-12 col-lg-10">
					<div class="wrap d-md-flex">
						<div class="text-wrap p-4 p-lg-5 text-center d-flex align-items-center">
							<div class="text w-100">
								<img src="./img/LogoKapri.png" alt="" width="100%">
								<h2>Bienvenido al sistema de control de inventario</h2>
							</div>
						</div>
						<div class="login-wrap p-4 p-lg-5">
							<div class="d-flex">

								<div class="w-100">
									<h3 class="mb-4">Ingresar a la plataforma</h3>
								</div>
							</div>
							<form action="" method="POST" class="signin-form">
								<div class="form-group mb-3">
									<label class="label" for="name">Nombre de usuario</label>
									<input type="text" class="form-control" name="Nombre" placeholder="Nombre" required>
								</div>
								<div class="form-group mb-3">
									<label class="label" for="password">Contraseña</label>
									<input type="password" class="form-control" name="Contraseña"
										placeholder="Contraseña" required>
								</div>
								<div class="form-group">
									<button name="submit"
										class="form-control btn btn-primary submit px-3">Ingresar</button>
								</div>
								<div class="form-group d-md-flex">
									<div class="w-50 text-center">
										<label class="checkbox-wrap checkbox-primary mb-0">
											<?php echo $error;?>
										</label>
									</div>
								</div>

							</form>
						</div>
					</div>
				</div>
			</div>
		</div>
	</section>

	<script src="js/jquery.min.js"></script>
	<script src="js/popper.js"></script>
	<script src="js/bootstrap.min.js"></script>
	<script src="js/main.js"></script>

</body>

</html>