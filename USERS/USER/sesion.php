<?php 
session_start();

if(isset($_SESSION['id']))
{
echo $_SESSION['name'];	
}
else
{
header("location: ../../index.php");
}
?>
</HTML>