<?php 
include_once ("Config.php");

$sql="SELECT * FROM periodo ORDER BY id DESC ";
$result = $mysqli->query($sql);
?>

<form action="cargaInstruccion.php" method="get">
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
        <td>Referencia</td>
        <td>Carta</td>
        <td>Pulicacion</td>
        <td>Codigo</td>
        <td>Titulo</td>
        <td><a>Descargar</a></td>    
    </tr>
    <?php 
        $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB);
        $sqlVentana = "SELECT m.id, m.referencia, m.numeroCarta, m.fechaPublicacion, m.codigo, tf.titulo
        FROM ventana_facturacion vf 
        JOIN tipo_facturacion tf ON vf.id_tipo_facturacion = tf.id
        JOIN matriz m on m.ventanafactura = vf.id
        WHERE vf.periodo = '$periodo'";
        $result = $mysqli->query($sqlVentana);
        while( $row = mysqli_fetch_assoc($result)){
    ?>
    <tr>
        <td><?php echo $row['id'];?></td>
        <td><?php echo $row['referencia'];?></td>
        <td><?php echo $row['numeroCarta'];?></td>
        <td><?php echo $row['fechaPublicacion'];?></td>
        <td><?php echo $row['codigo'];?></td>
        <td><?php echo $row['titulo'];?></td>
        <td><a href="registraInstruccion.php?periodo=<?php echo $periodo?>&id=<?php echo $row['id']?>">Descargar</a></td>    
    </tr>
    <?php  } ?>

</table>
<?php } ?>