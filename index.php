<!DOCTYPE html>
<html >
<?php include 'head.php'; ?>
<body>    
<?php
include 'crud.php'; 

if (!isset($_SESSION['usuario'])) { ?>
  <div class="login">
    <div class="img-index"><img src="css/img/logo_lotus_big.png" /></div>
    <form method="POST" name="formDefault" action="crud.php" class="form-home">
      <input type="text" placeholder="User" name="usuario" class="usuario"/>
      <input type="password" placeholder="Password" name="senha" class="senha"/>
      <input type="submit" value="Log in" name="login" class="enviar-home"/>
    </form>
  </div>
<?php
    } else {
       header("location:crud.php");
    }
?>
    
</body>
</html>