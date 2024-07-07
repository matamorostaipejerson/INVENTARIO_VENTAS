<?php

echo
"
<ul class='nav nav-primary'>

						<li class='nav-item active'>
							<a href ='index.php'>
								<i class='fas fa-home'></i>
								<p>Pagina principal</p>
							</a>
						</li>
						<li class='nav-section'>
							<span class='sidebar-mini-icon'>
								<i class='fa fa-ellipsis-h'></i>
							</span>
							<h4 class='text-section'>Componentes</h4>
						</li>
						
						<li class='nav-item'>
							<a data-toggle='collapse' href=#base>
								<i class='fas fa-layer-group'></i>
								<p>Inventario</p>
								<span class='caret'></span>
							</a>
							<div class='collapse' id='base'>
								<ul class='nav nav-collapse'>
									<li>
										<a href='Productos.php'>
											<span class='sub-item'>Articulos</span>
										</a>
									</li>
									<li>
										<a href='RevisarStock.php'>
											<span class='sub-item'>Revisar Stock</span>
										</a>
									</li>
									<li>
										<a href='Categorias.php'>
											<span class='sub-item'>Categorias</span>
										</a>
									</li>
								</ul>
							</div>
						</li>
						<li class='nav-item'>
							<a data-toggle='collapse' href=#forms1>
								<i class='fas fa-pen-square'></i>
								<p>Entradas</p>
								<span class='caret'></span>
							</a>
							<div class='collapse' id='forms1'>
								<ul class='nav nav-collapse'>
									<li>
										<a href='AgregarEntrada.php'>
											<span class='sub-item'>Agregar Entrada</span>
										</a>
									</li>
									<li>
										<a href='RevisarEntradas.php'>
											<span class='sub-item'>Revisar Entradas</span>
										</a>
									</li>
									<li>
										<a href='Proveedores.php'>
											<span class='sub-item'>Agregar Proveedor</span>
										</a>
									</li>

								</ul>
							</div>
						</li>
						<li class='nav-item'>
							<a data-toggle='collapse' href=#forms>
								<i class='fas fa-pen-square'></i>
								<p>Salidas</p>
								<span class='caret'></span>
							</a>
							<div class='collapse' id='forms'>
								<ul class='nav nav-collapse'>
									
									<li>
										<a href='AgregarSalida.php'>
											<span class='sub-item'>Ingresar Salidas</span>
										</a>
									</li>
									<li>
										<a href='RevisarSalidas.php'>
											<span class='sub-item'>Revisar Salidas</span>
										</a>
									</li>

								</ul>
							</div>
						</li>
						<li class='nav-item'>
							<a data-toggle='collapse' href=#tables>
								<i class='fas fa-table'></i>
								<p>Reportes</p>
								<span class='caret'></span>
							</a>
							<div class='collapse' id='tables'>
								<ul class='nav nav-collapse'>
									<li>
										<a href='ReporteEgresos.php'>
											<span class='sub-item'>Reporte Egresos</span>
										</a>
									</li>
									<li>
										<a href='ReporteIngresos.php'>
											<span class='sub-item'>Reporte Ingresos</span>
										</a>
									</li>
									<li>
										<a href='ReporteGlobal.php'>
											<span class='sub-item'>Reporte Global</span>
										</a>
									</li>
									<li>
										<a href='Utilidad.php'>
											<span class='sub-item'>Utilidad</span>
										</a>
									</li>
								</ul>
							</div>
						</li>
						<li class='nav-item'>
							<a data-toggle='collapse' href=#base1>
								<i class='fas fa-user'></i>
								<p>Configuracion</p>
								<span class='caret'></span>
							</a>
							<div class='collapse' id='base1'>
								<ul class='nav nav-collapse'>
									<li>
										<a href='AdminUsuarios.php'>
											<span class='sub-item'>Gestion Usuarios</span>
										</a>
									</li>
									<li>
										<a href='AcercaDe.php'>
											<span class='sub-item'>AcercaDe</span>
										</a>
									</li>
								</ul>
							</div>
						</li>
						<li class='nav-section'>
							<span class='sidebar-mini-icon'>
								<i class='fa fa-ellipsis-h'></i>
							</span>
							<h4 class='text-section'>Kapri Technology</h4>
							<img src='./../assets/img/LogoKapri.png'/ width='90%'>
						</li>
					</ul>
"






?>