<html>
    <head>
        <meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <title></title>
    </head>
    <body>
        <?php 
        include("conexion.php");
        $i=0;
        $dia=1;
        $sql=mysql_query("SELECT * FROM costo_marginal");
        ?>
        <table>
            <tr>
            	<td>Id</td>
            	<td>Perido</td>
            	<td>Valor</td>
            </tr>
            <?php
            while($row=mysql_fetch_row($sql))
            {
            $i++;
            ?>
            <tr>
            	<td><?php echo $row[0];?></td>
            	<td><?php echo $row[1];?></td>
            	<td><?php echo $row[2];?></td>
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
    header('content-disposition: attachment;filename=Costo_Marginal.xls');
?>