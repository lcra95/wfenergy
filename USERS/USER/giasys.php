<!DOCTYPE HTML>
<!--
	Arcana by HTML5 UP
	html5up.net | @ajlkn
	Free for personal and commercial use under the CCA 3.0 license (html5up.net/license)
-->
<html>
<?php include("header.php");?>
	<body>
		<div id="page-wrapper">

			<!-- Header -->
				<div id="header">

					<!-- Logo -->
<?php include("head.php");
include("conexion_giasys.php");
?>
					<!-- Nav -->
	<?php include("nav.php"); $nav=nav(2)?>

				</div>

			<!-- Main -->
				<section class="wrapper style1">
					<div class="container">
						<div class="row 200%">
							<div class="3u 12u(narrower)">
								<div id="sidebar1">

									<!-- Sidebar 1 -->

										<section>
											<h3>Giasys Financial</h3>
											<p>Phasellus quam turpis, feugiat sit amet ornare in, hendrerit in lectus.
											Praesent semper mod quis eget mi. Etiam eu ante risus. Aliquam erat volutpat.
											Aliquam luctus et mattis lectus sit amet pulvinar. Nam turpis et nisi etiam.</p>
										
										</section>

										<section>
											<h3>¿Por qué Giasys Financial?</h3>
											<ul class="links">
												<li><a href="#">Amet turpis, feugiat sit amet</a></li>
												<li><a href="#">Ornare in hendrerit lectus</a></li>
												<li><a href="#">Semper mod quis eget dolore</a></li>
												<li><a href="#">Consequat lorem phasellus</a></li>
												<li><a href="#">Amet turpis feugiat amet</a></li>
												<li><a href="#">Semper mod quisturpis nisi</a></li>
											</ul>
											<footer>
												<a href="#" class="button">Mas Información</a>
											</footer>
										</section>

								</div>
							</div>
							<div class="6u 12u(narrower) important(narrower)">
								<div id="content">

									
									<!-- <h2>Inicia Sessión en Giasys</h2> Content -->

										<article>
											<header>
												
												<img src="images/b.png" class="img-responsive">
											</header>
<BR>
								<form action="GIASYS/validar.php" class="login" method="GET">
									<div class="row 100%">
										<div class="12u 12u(mobilep)">
										<select name="filial" id="sel" class="form-control">
								          <?php 
								          $conp=mysql_query("SELECT * FROM Filial");
								          while($roo=mysql_fetch_array($conp))
								          {
								            ?>
								          <option value="<?php echo $roo[0];?>"><?php echo $roo[1];?></option>
								          <?php
								        	}
								          ?>
								          </select>				
								      </div>
									</div>
									<div class="row 100%">
										<div class="12u 12u(mobilep)">
											<input type="text" name="us" id="name" placeholder="User" />
										</div>
									</div>
									<div class="row 100%">

										<div class="12u 12u(mobilep)">
											<input type="password" name="pas" id="email" placeholder="Password" />
										</div>
									</div>
									<div class="row 100%">
										<div class="12u">
											<ul class="actions">
												<li><input type="submit" class="btn btn-primary btn-sm" value="Iniciar Sessión" /></li>
											</ul>
										</div>
									</div>
								</form><br>

											
											<h5>Indicadores de Interés</h5>
		<table class="table table-striped table-bordered table-hover">
  		<thead>
        <tr class="success">
        <th><b>Indicador</b></th>
          <th><b>Valor</b></th>
          <th><b>Indicador</b></th>
          <th><b>Valor</b></th>
        </tr>
      </thead>
      <tbody>
      	        <tr>
          <td>UF</td>
          <td align="right"> 26632.70$</td>
          <td>UTM</td>
          <td align="right"> 46740$</td>
        </tr>
        <tr>
		  <td>US$</td>
          <td align="right">672.35$</td>
          <td>EUR</td>
          <td align="right">755.45$</td>
        </tr>
       <!-- <tr >
          <td>Energia Kw/h</td>
          <td align="right">48358$</td>
          <td>Potencia Kw/h</td>
          <td align="right">36584$</td>
        </tr>-->
      </tbody>
		</table>
											</article>

								</div>
							</div>
							<div class="3u 12u(narrower)">
								<div id="sidebar2">

									<!-- Sidebar 2 -->


										<section>
											<h4>Giasys Energy</h4>
											<p>Phasellus quam turpis, feugiat sit amet ornare in, hendrerit in lectus.
											Praesent semper mod quis eget mi. Etiam eu ante risus. Aliquam erat volutpat.
											Aliquam luctus et mattis lectus sit amet pulvinar. Nam turpis et nisi etiam.</p>
									
										</section>

										<section>
											<h3>¿Por qué Giasys Energy?</h3>
											<ul class="links">
												<li><a href="#">Amet turpis, feugiat sit amet</a></li>
												<li><a href="#">Ornare in hendrerit lectus</a></li>
												<li><a href="#">Semper mod quis eget dolore</a></li>
												<li><a href="#">Consequat lorem phasellus</a></li>
												<li><a href="#">Amet turpis feugiat amet</a></li>
												<li><a href="#">Semper mod quisturpis nisi</a></li>
											</ul>
											<footer>
												<a href="#" class="button">Mas Información</a>
											</footer>
										</section>

								</div>
							</div>
						</div>
					</div>
				</section>

			<!-- Footer -->
<?php include("footer.php");?>

		<!-- Scripts -->
			<script src="assets/js/jquery.min.js"></script>
			<script src="assets/js/jquery.dropotron.min.js"></script>
			<script src="assets/js/skel.min.js"></script>
			<script src="assets/js/util.js"></script>
			<!--[if lte IE 8]><script src="assets/js/ie/respond.min.js"></script><![endif]-->
			<script src="assets/js/main.js"></script>

	</body>
</html>