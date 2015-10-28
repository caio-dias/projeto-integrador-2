<!DOCTYPE html>
<html >
  <head>
    <meta charset="UTF-8">
    <title>Index</title>
    <link rel="stylesheet" href="css/style.css">
</head>

<body>    
<?php
include 'crud.php'; 

if (!isset($_SESSION['usuario'])) { ?>    
  <span href="#" class="button" id="toggle-login">Log in</span>
  <div id="login">
    <div id="triangle"></div>
    <h1>Log in</h1>
    <form method="POST" name="formDefault" action="crud.php" class="form-home">
      <input type="text" placeholder="User" name="usuario" class="usuario"/>
      <input type="password" placeholder="Password" name="senha" class="senha"/>
      <input type="submit" value="Log in" name="login" class="enviar-home"/>
    </form>
  </div>
  <script src='http://cdnjs.cloudflare.com/ajax/libs/jquery/2.1.3/jquery.min.js'></script>
  <script src="js/index.js"></script>    
<?php
    } else {
       header("location:crud.php");
    }
?>
    
</body>
</html>