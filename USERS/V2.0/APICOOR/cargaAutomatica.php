<?php 
include_once ("Config.php");

$sql="SELECT * FROM periodo ORDER BY id DESC ";
$result = $mysqli->query($sql);
?>

<form action="cargaAutomatica.php" method="get">
    <label for="periodo">Periodo</label>
    <select name="periodo" id="periodo">
        <?php while( $row = mysqli_fetch_assoc($result)){?>
            <option value="<?php echo $row['id'] ?>"><?php echo $row['id'] ?></option>
        <?php }?>
    </select>
    <input type="submit" value="Enviar">
</form>

<?php 
@$periodo = $_GET['periodo'];


if(!empty($periodo)){
?>
<table border="1" cellspacing="0" cellspading="0" width=80%>
    <tr>
        <td>Id</td>
        <td>Key</td>
        <td>Tipo Facturacion</td>
        <td><a>Descargar</a></td>    
    </tr>
    <?php 
        $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB);
        $sqlVentana = "SELECT vf.ID, vf.KEY, tf.TITULO 
        FROM ventana_facturacion vf 
        JOIN tipo_facturacion tf ON vf.id_tipo_facturacion = tf.id
        WHERE vf.periodo = '$periodo'";
        $result = $mysqli->query($sqlVentana);
        while( $row = mysqli_fetch_assoc($result)){
    ?>
    <tr>
        <td><?php echo $row['ID'];?></td>
        <td><?php echo $row['KEY'];?></td>
        <td><?php echo $row['TITULO'];?></td>
        <td><a href="cargarMatriz.php?periodo=<?php echo $periodo?>&id=<?php echo $row['ID']?>">Descargar</a></td>    
    </tr>
    <?php  } ?>

</table>
<?php } ?>