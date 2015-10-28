<?php $consulta = odbc_exec($connect,"SELECT idCategoria, nomeCategoria FROM Categoria");?>
<div class="div-center">
	<form action="crud.php" method="POST" class="formulario" enctype="multipart/form-data">
	   	<p>Nome: <input type="text" name="nomeProduto"/></p>
	   	<p>Foto: <input type="file" name="imagemProduto" class="p-img"></p>
	   	<p>Preço: <input type="text" name="precoProduto" size="4"/></p>
	   	<p>Desconto: <input type="text" name="descontoProduto" size="4"/></p>	   	
		<p>Categoria:   
		   <select name="categoriaProduto">
				<?php
				while ($resultado = odbc_fetch_array($consulta)) {
					echo "<option value='". $resultado['idCategoria'] ."'>".$resultado['nomeCategoria']."</option>";
					}						
				?>
			</select>
		</p>
		<p>Descrição: <input type="text" name="descProduto"/></p>
		<p>Status do Produto:
		   <select name="statusProduto">
				<option value="1">Ativo</option>
				<option value="0">Inativo</option>
		  </select>
		</p>
		<p>Estoque mínimo: <input type="text" name="estoqueMinProduto" size="4"/></p>
		<input type="submit" value="Enviar">
		<input type="reset" value="Limpar dados">
	</form>
</div>