<?php $consulta = odbc_exec($connect,"SELECT idProduto, nomeProduto FROM Produto");?>
<div class="div-center">
	<form action="crud.php" method="POST" class="formulario">   	
		<p>Produto:   
		   <select name="produtoExcluido">
				<?php
				while ($resultado = odbc_fetch_array($consulta)) {
					echo "<option value='". $resultado['idProduto'] ."'>".$resultado['nomeProduto']."</option>";
					}						
				?>
			</select></br></br>	
		<input type="submit" value="Excluir">
	</form>
</div>