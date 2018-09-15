<html lang="es">
<head>
  <link rel="stylesheet" type="text/css" href="style.css">
  <script type="text/javascript" src="jquery.js"></script>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/css/bootstrap.min.css">
  <script src="//code.jquery.com/jquery-1.12.4.js"></script>
  <meta charset="UTF-8">
  <title>WF ENERGY</title>
</head>
<body>
<div class="container-fluid">
  
  <div class="row" id="pw-container" >
    <div class="col-md-4"></div>
    
    <div class="col-md-4">
      <section class="login-form">
        <form method="get" action="validar.php" role="login">
          <img src="wf.png" class="img-responsive" alt="" width="30%" heigth="30%" />
          <input type="text" name="us" placeholder="Indicador" required class="form-control input-lg"/>
          
          <input type="password" class="form-control input-lg" name="pas" placeholder="Password" required="" />
          
          
          <div class="pwstrength_viewport_progress"></div>
          
          
          <button type="submit" name="go" class="btn btn-lg btn-primary btn-block">Sign in</button>
          <div>
           
          </div>
          
        </form>

      </section>  
      </div>
      
      <div class="col-md-4"></div>
  </div>  
</div>
</body>
</html>