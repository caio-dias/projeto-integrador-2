<html>
<?php include 'head.php';?>
<body>
<div class="container">
	<?php
		session_start();
		include 'funcoes.php';
		include 'menu.php';
	if (isset($_SESSION['usuario'])) { ?>
		<div class="div-center">
			<h1>Cadastro de Categoria</h1>
			<form action="cadastro-categoria.php" method="POST" class="formulario">
			   	<p><label for="nomeCategoria">Nome:</label>
                  <input type="text" name="nomeCategoria" id="nomeCategoria" required/></p>
			   	<p><label for="descricaoCategoria">Descrição:</label>
                  <input type="text" name="descricaoCategoria" id="descricaoCategoria"required/></p>
				<input type="submit" value="Enviar" class="btn-forms" id="submit">
				<input type="reset" value="Limpar dados" class="btn-forms" id="submit">
			</form>
		</div>
	<?php } else {
	   header("location:index.php");
	} ?>
</div>
</body>
</html>