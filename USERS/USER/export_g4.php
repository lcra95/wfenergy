<html>
	<head>
		<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
		<title></title>
	</head>
	<body>
		<?php
		include("conexion.php");
		$ano='2017-08';
		?>
		<table>
			<tr>
				<td>ID</td>
				<td>PERIODO</td>
				<td>ENERGIA</td>
				<TD>RADIACION</TD>
			</tr>
			<?php 
			$sel=mysql_query("SELECT * FROM energia_periodo WHERE periodo LIKE '$ano'");
			while($row=mysql_fetch_array($sel))
			{
			?>
			<tr>
				<td><?php echo $row[0];?></td>
				<td><?php echo $row[1];?></td>
				<td><?php echo $row[2];?></td>
				<td><?php echo $row[3];?></td>
			</tr>
			<?php
			}
			?>
 		</table>
  	</body>
</html>

<?PHP 
    header('Content-Type: application/vnd.ms-excel');
    header('Expires: 0');
    header('Cache-Control: must-revalidate, post-check=0, pre-check=0');
    header('content-disposition: attachment;filename=Energia_Periodo.xls');
?>