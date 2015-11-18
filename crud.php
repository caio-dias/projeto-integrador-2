<html>
<?php include 'head.php';?>
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
		} else { if (isset($_POST['senha'])) {
				echo "<script>alert('Usuario ou senha incorretos')</script>";
				header("location:index.php");
			}
		}
	}
	?>

	<?php if (isset($_SESSION['usuario'])) {?>
	<?php include 'menu.php' ?>
	<div class="div-center">
		<div class="texto-home"> 
			<p>A Lotus Cosméticos é uma loja fictícia, criada pelos alunos do segundo semestre, do Curso de Sistemas para Internet 
			do Senac.</p>

			<p>A loja foi fundada em São Paulo (SP), no ano de 2004, por Vera Lúcia Mendes, uma dona de 
			casa, que tinha o sonho de abrir um próprio negócio, de cosméticos e artigos de beleza em 
			geral.</p></p>

			<p>Neste ano de 2015, a empresa investiu grande capital para a reformulação de sua marca.
			Nosso maior projeto é a criação de uma loja virtual para competir no mercado internacional, 
			com o objetivo de estabelecer a Lotus como uma das maiores empresas na categoria de 
			vendas e variedades em cosméticos.</p>

			<img src="css/img/logo_lotus_big.png">
		</div>
	</div>
	<?php }?>

</div>
</body>
</html>