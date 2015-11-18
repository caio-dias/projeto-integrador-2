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
			<h1>Cadastro de Usuário</h1>
			<form action="cadastro-usuario.php" method="POST" class="formulario">
			   	<p><label for="loginNUsuario">Login:</label>
                  <input type="text" name="loginNUsuario" id="loginNUsuario" required/></p>
			   	<p><label for="senhaNUsuario">Senha:</label>
                  <input type="password" name="senhaNUsuario" id="senhaNUsuario" required/></p>
			   	<p><label for="nomeNUsuario">Nome:</label>
                  <input type="text" name="nomeNUsuario" id="nomeNUsuario" required/></p>
			   	<p><label for="usuarioNPerfil">Tipo de perfil:</label>
			   	   <select name="usuarioNPerfil" id="usuarioNPerfil">
			   			<option value="A">Administrador</option>
			   			<option value="U">Usuário</option>
			   	  </select>
			   	  <p><label for="statusNUsuario">Usuário ativo:</label>
			   	     <select name="statusNUsuario" id="statusNUsuario">
			   	  		<option value="1">Ativo</option>
			   	  		<option value="0">Inativo</option>
			   	    </select>
			   	  </p>
			   	</p>
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