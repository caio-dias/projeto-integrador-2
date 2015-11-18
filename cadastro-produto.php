<html>
<?php include 'head.php';?>
<body>
<div class="container">
	<?php
		session_start();
		include 'funcoes.php';
		$consulta = odbc_exec($connect,"SELECT idCategoria, nomeCategoria FROM Categoria");
		include 'menu.php';
	if (isset($_SESSION['usuario'])) { ?>
		<div class="div-center">
			<h1>Cadastro de Produto</h1>
			<form action="cadastro-produto.php" method="POST" class="formulario" enctype="multipart/form-data">
			   	<p><label for="nomeProduto">Nome:</label>
                  <input type="text" id="nomeProduto" name="nomeProduto" required/></p>
			   	<p><label for="imagemProduto">Foto:</label>
                  <input type="file" id="imagemProduto" name="imagemProduto" class="p-img"></p>
			   	<p><label for="precoProduto">Preço:</label>
                  <input type="number" id="precoProduto" name="precoProduto" required/></p>
			   	<p><label for="descontoProduto">Desconto:</label>
                  <input type="text" id="descontoProduto" name="descontoProduto" /></p>	   	
				<p><label for="categoriaProduto">Categoria:</label>  
				   <select name="categoriaProduto" id="categoriaProduto" required>
						<?php
						while ($resultado = odbc_fetch_array($consulta)) {
							echo "<option value='". $resultado['idCategoria'] ."'>".$resultado['nomeCategoria']."</option>";
							}						
						?>
					</select>
				</p>
				<p><label for="descProduto">Descrição:</label>
                  <input type="text" id="descProduto" name="descProduto" required/></p>
				<p><label for="statusProduto">Status do Produto:</label>
				   <select name="statusProduto" id="statusProduto">
						<option value="1">Ativo</option>
						<option value="0">Inativo</option>
				  </select>
				</p>
				<p> <label for="estoqueMinProduto">Estoque mínimo:</label>
                  <input type="number" name="estoqueMinProduto" id="estoqueMinProduto" required/></p>
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