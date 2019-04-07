<!DOCTYPE html>
<html lang="es">
<head>
  <meta charset="UTF-8">
  <title>Web Billing</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="shortcut icon" href="images/ico.ico">
    <link rel="stylesheet" type="text/css" href="css/bootstrap.css">
    <link rel="stylesheet" href="../../font-awesome/css/font-awesome.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.datatables.net/1.10.15/css/jquery.dataTables.min.css">
    <script src="//code.jquery.com/jquery-1.12.4.js"></script>
    <script src="https://cdn.datatables.net/1.10.15/js/jquery.dataTables.min.js"></script>

    <script type="text/javascript">
      $(document).ready(function() {
          $('#example').DataTable();
      } );

    function getXML() {

        var id = $("#IDFOLIO").val();
        var url = '../API/xmlSend.php';
        var data = {"id" : id};
        $.ajax({
          type: "POST",
          url: url,
          data: data,
          beforeSend: function () {
            $("#resultado").html("Procesando, espere por favor...");
          },
          success:  function (response) {
            $("#resultado").html(response);
          }
        });

        }
    </script>
    <style>
        #tel{
          margin-right: 16px;
        }
    </style>

</head>