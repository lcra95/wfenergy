<nav class="navbar navbar-inverse navbar-fixed-top">
		<div class="container" >
 <!--Aqui empieza el encabezado de menu para que se adapte a moviles-->
			<div class="navbar-header" valign="top">
			      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#ejemplo">
			        <span class="sr-only">Toggle navigation</span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			        <span class="icon-bar"></span>
			      </button>
			      <a class="navbar-brand" href="inicio.php">        <img src="images/wf.png" class="img-responsive" width="80" heigth="35">
</a>
			</div>

 <!--Aqui termina el encabezado de menu para que se adapte a moviles-->
 
<!--Aqui comienza el menu visible en pc y se relaciona con moviles a traves del id ejemplo-->			
				    <div class="collapse navbar-collapse" id="ejemplo">
				      <ul class="nav navbar-nav">
				      	
				      <li><a href="#menu-toggle" class="btn fa fa-exchange" id="menu-toggle"></a></li>
				        <li><a href="registro.php"><i class="fa fa-balance-scale" aria-hidden="true"></i> Balances</a></li>
 <!--Aqui comienza el menu con sub obciones-->
						<?php 
						@session_start();
						if($_SESSION['rol']==1){?>
						<li class="dropdown">
				          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
				          	<i class="glyphicon glyphicon-cog" aria-hidden="true"></i>
											Administrar <span class="caret"></span></a>

				          <ul class="dropdown-menu" role="menu">
				          	<li><a href="tablas.php"><span class="glyphicon glyphicon-list-alt" aria-hidden="true"></span> Gestionar Tablas</a></li>
				          </ul>
				    </li>
						<?php } ?>
				    <li class="dropdown">
				          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
				          	<i class="fa fa-file-text" aria-hidden="true"></i> Facturas<span class="caret"></span></a>

				          <ul class="dropdown-menu" role="menu">
										<li><a href="../API/Facturacion/" ><span class="fa fa-file-text" aria-hidden="true"></span> Nueva Factura</a></li>
				           	<li><a href="../API/Facturacion/pfactura.php" ><span class="fa fa-file-text" aria-hidden="true"></span> Emitir Factura</a></li>
				         		<li><a href="../API/Facturacion/listafacturas.php" ><span class="fa fa-file-text" aria-hidden="true"></span> Facturas Emitidas</a></li>
		  							<li><a href="../API/Facturacion/listarecibo.php" ><span class="fa fa-file-text" aria-hidden="true"></span>Facturas Recibidas</a></li>
						         

				           </ul>
				        </li>
				        <li class="dropdown">
				          <a href="#" class="dropdown-toggle" data-toggle="dropdown">
				          	<i class="fa fa-money" aria-hidden="true"></i> Pagos<span class="caret"></span></a>

				          <ul class="dropdown-menu" role="menu">
				          	<li><a href="procesodepago.php" ><span class="fa fa-money" aria-hidden="true"></span> Procesos de Pago</a></li>
				          </ul>
				        </li>
				      </ul>
 <!--Aqui termina el menu con sub obciones-->				      
 <!--Aqui comienza el menu alineado a la derecha-->
				      <ul class="nav navbar-nav navbar-right">
				    
 <!--Aqui comienza el menu con sub obciones alineado a la derecha-->
				        <li class="dropdown">
				          <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-user" aria-hidden="true"></i> <?php @include("sesion.php");?> <span class="caret"></span></a>
				          <ul class="dropdown-menu" role="menu">
				            <li><a href="#"><i class="fa fa-pencil-square-o" aria-hidden="true"></i> Editar Perfil</a></li>
				            <li><a href="#"><i class="fa fa-unlock" aria-hidden="true"></i> Cambiar Contraseña</a></li>
				            <li class="divider"></li>
				            <li><a href="fin.php"><i class="fa fa-sign-out" aria-hidden="true"></i> Salir</a></li>
				          </ul>
				        </li>
				      </ul>
				    </div> 
		</div>
  
	</nav>
<br><br>


