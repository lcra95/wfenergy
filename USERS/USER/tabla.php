<?php include("head.php");?>

<?php 
function tabla()
{

include("conexion.php");
$sql=mysql_query("SELECT * FROM empresa");
?>
<table id="example" class="display" cellspacing="0" width="100%">
        <thead>
            <tr>
                <th>Sel</th>
                <th>Razón</th>
                <th>ID</th>
                <th>RUT</th>

            </tr>
        </thead>

        <tbody>
            <?php while($row=mysql_fetch_array($sql)){ ?>
            <tr>
                <td><a href="nfactura.php?empresa=<?php echo $row[0];?>" class="fa fa-check-square-o"></a></td>
                <td><?php echo $row[2];?></td>
                <td><?php echo $row[0];?></td>
                <td><?php echo $row[1];?></td>
                
            </tr>
            <?php } ?>
        </tbody>
    </table>
<?php }?>
