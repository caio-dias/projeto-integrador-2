<html>
<head>
<link rel="stylesheet" type="text/css" href="css/style.css">
<meta charset="utf-8">
</head>
<body>
<div class="container">
	<?php
	session_start();
    $usuario = (isset($_POST['usuario'])) ? $_POST['usuario'] : "";
    $senha = (isset($_POST['senha'])) ? $_POST['senha'] : "";

	include 'funcoes.php';

	if (!isset($_SESSION['usuario'])) {
		if ($senha == $senhaBanco && $usuarioAtivo == "1") {
		  $_SESSION['usuario'] = $usuario;
		  	echo "<script>alert('Logado com sucesso')</script>";
		} else { if (isset($_POST['senha'])) {
				echo "<script>alert('Usuario ou senha incorretos')</script>";
			}
		}
	}
	?>

	<?php if (isset($_SESSION['usuario'])) {?>
		<nav class="menu-crud">
			<div class="logo"><img src="img/logo_lotus.jpg"></div>
			<div class="container-menu">
				<form method="GET" action="crud.php" class="main-menu">
					<button class="btn-menu btn-main" type="submit" name="acao" value="a1">Cadastrar</button> 
					<button class="btn-menu btn-main" type="submit" name="acao" value="a2">Listar</button> 
				</form>
				<?php $selec = isset($_GET['acao']) ? $_GET['acao'] : false; ?>
				<?php if ($selec == 'a1'){?>
					<form method="GET" action="crud.php">
						<button class="btn-menu" type="submit" name="pagina" value="p1">Cadastrar produto</button>
						<button class="btn-menu" type="submit" name="pagina" value="p2">Cadastrar categoria</button>
						<button class="btn-menu" type="submit" name="pagina" value="p3">Cadastrar usuario</button>
					</form>
				<?php }?>	

				<?php if ($selec == 'a2'){?>
					<form method="GET" action="crud.php">
						<button class="btn-menu" type="submit" name="pagina" value="p4">Listar produtos</button>
						<button class="btn-menu" type="submit" name="pagina" value="p5">Listar categorias</button>
						<button class="btn-menu" type="submit" name="pagina" value="p6">Listar usuarios</button>
					</form>
				<?php }?>
			</div>
			<div class="logout"><a href="logout.php">Sair</a></div>
		</nav>
	<?php }?>

	<?php $selected = isset($_GET['pagina']) ? $_GET['pagina'] : false; ?>
		<?php 		 
			if($selected == 'p1') {
				 if (isset($_SESSION['usuario'])) {	
						require ('templates/form-produto.php');	
				 }
			}			
			if($selected == 'p2') {
				 if (isset($_SESSION['usuario'])) {	
						require ('templates/form-categoria.php');	
				 }
			}
			if($selected == 'p3') {
				 if (isset($_SESSION['usuario'])) {	
						require ('templates/form-usuario.php');	
				 }
			}
			if($selected == 'p4') {
				 if (isset($_SESSION['usuario'])) {	
						require ('templates/form-listar-produto.php');	
				 }
			}
			if($selected == 'p5') {
				 if (isset($_SESSION['usuario'])) {	
						require ('templates/form-listar-categoria.php');	
				 }
			}
            if($selected == 'p6') {
				 if (isset($_SESSION['usuario'])) {	
						require ('templates/form-listar-usuario.php');	
				 }
			}
		?>
</div>
</body>
</html>