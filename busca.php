<html>
<?php include 'head.php';?>
<body>
<div class="container">
	<?php
		session_start();
		ini_set('odbc.defaultlrl',9000000);
		include 'funcoes.php';
		include 'menu.php';
	if (isset($_SESSION['usuario'])) { ?>
		<div class="div-center">
			<h1>Busca de Produtos</h1>
			<form action="busca.php" method="POST" class="formulario">
			   	<p><label for="nomeProdutoBusca">Nome:</label>
                <input type="text" name="nomeProdutoBusca" required/></p>
				<input type="submit" value="Enviar" class="btn-forms" id="submit">
				<input type="reset" value="Limpar dados" class="btn-forms" id="submit">
			</form>			
			<?php
				if (isset($_POST['nomeProdutoBusca'])){ 
					$pesquisa = $_POST['nomeProdutoBusca'];	
     				$consulta = odbc_exec($connect,"SELECT idProduto, nomeProduto, descProduto, precProduto, qtdMinEstoque, imagem, nomeCategoria FROM Produto inner join Categoria on (produto.idCategoria = categoria.idCategoria) WHERE nomeProduto LIKE '%".$pesquisa."%'");
					?>
					<table class="tabela">
					    <thead>
					        <tr>
					            <th>Nome</th>
					            <th>Imagem</th>
					            <th>Preço</th>
  					            <th>Categoria</th>
					            <th>Estoque</th>
					        </tr>     
					    </thead>
					    <tbody>
					      <?php
					      while ($resultado = odbc_fetch_array($consulta)) {
					        if ($resultado['imagem'] <> NULL) { 
					          $imagemDoProduto = "<img src='data:image/jpeg;base64,".base64_encode($resultado['imagem'])."' width='30' heigth='30' />";
					        } else {
					          $imagemDoProduto = "<img src='css/img/logo_lotus_padrao.png' width='30' heigth='30' />";
					        }
					        echo "
					        <tr>
					          <td>".utf8_encode($resultado['nomeProduto'])."</td>
					          <td>".$imagemDoProduto."</td>
					          <td>R$".number_format($resultado['precProduto'], 2, ',','.')."</td>
					          <td>".$resultado['nomeCategoria']."</td>
					          <td>".$resultado['qtdMinEstoque']."</td>
					        </tr>";
					        }           
					      ?>        
					    </tbody>
					</table>
				<?php } ?>
		</div>
 	<?php  } else {
	   header("location:index.php");
	} ?>
</div>
</body>
</html>