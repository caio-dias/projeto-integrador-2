<?php $consulta = odbc_exec($connect,"SELECT idCategoria, nomeCategoria FROM Categoria");?>
<div class="div-center">
	<form action="crud.php" method="POST" class="formulario">   	
		<p>Categoria:   
		   <select name="categoriaExcluida">
				<?php
				while ($resultado = odbc_fetch_array($consulta)) {
					echo "<option value='". $resultado['idCategoria'] ."'>".$resultado['nomeCategoria']."</option>";
					}						
				?>
			</select></br></br>	
		<input type="submit" value="Excluir">
	</form>
</div>