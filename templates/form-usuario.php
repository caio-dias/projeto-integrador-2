<div class="div-center">
	<form action="crud.php" method="POST" class="formulario">
	   	<p>Login: <input type="text" name="loginNUsuario"/></p>
	   	<p>Senha: <input type="password" name="senhaNUsuario"/></p>
	   	<p>Nome: <input type="text" name="nomeNUsuario"/></p>
	   	<p>Tipo de perfil:
	   	   <select name="usuarioNPerfil">
	   			<option value="A">Administrador</option>
	   			<option value="U">Usuário</option>
	   	  </select>
	   	  <p>Usuário ativo:
	   	     <select name="statusNUsuario">
	   	  		<option value="1">Ativo</option>
	   	  		<option value="0">Inativo</option>
	   	    </select>
	   	  </p>
	   	</p>
		<input type="submit" value="Enviar">
		<input type="reset" value="Limpar dados">
	</form>
</div>