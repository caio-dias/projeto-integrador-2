<?php
/* Servico de login*/
include 'conexao.php';
if (isset($_POST['usuario'])) {
	$consulta = odbc_exec($connect,"SELECT senhaUsuario, tipoPerfil, idUsuario, usuarioAtivo FROM usuario WHERE loginUsuario = '".$usuario."'");
	$senhaBanco = 	odbc_result($consulta, "senhaUsuario");
	$tipoPerfil = 	odbc_result($consulta, "tipoPerfil");
	$idUsuario = 	odbc_result($consulta, "idUsuario");
	$usuarioAtivo = odbc_result($consulta, "usuarioAtivo");
}else{
  $usuarioAtivo = "";
  $senhaBanco = "";
}
/*-----------------*/

/* Cadastro de produtos */
if (isset($_POST['nomeProduto'])){
	$nomeProduto = $_POST['nomeProduto'];
	$precoProduto = (float) $_POST['precoProduto'];
	$descontoProduto = (float) $_POST['descontoProduto'];
	$categoriaProduto = $_POST['categoriaProduto'];
	$descricaoProduto = $_POST['descProduto'];
	$statusProduto = (bool) $_POST['statusProduto'];
	$estoqueMinProduto = $_POST['estoqueMinProduto'];
	//print_r($_FILES);

	//if ('image/' != substr($_FILES['imagemProduto']['type'],0,6)) {
		//echo "<script>alert('Insira um arquivo de imagem')</script>";
	//}

	$produto = odbc_prepare($connect, "INSERT INTO Produto (nomeProduto,precProduto,descontoPromocao,idCategoria,descProduto,ativoProduto,qtdMinEstoque) VALUES (?,?,?,?,?,?,?)");
	
	if (odbc_execute($produto,array($nomeProduto,$precoProduto,$descontoProduto,$categoriaProduto, $descricaoProduto,$statusProduto,$estoqueMinProduto))) {
		echo "<script>alert('Produto cadastrado com sucesso')</script>";
	} 
}
/*---------------------*/

/* Cadastro de categorias */
if (isset($_POST['nomeCategoria'])){
	$nomeCat = $_POST['nomeCategoria'];
	$descCat = $_POST['descricaoCategoria'];

	$categoria = odbc_prepare($connect, "INSERT INTO Categoria (nomeCategoria,descCategoria) VALUES (?,?)");
	
	if (odbc_execute($categoria,array($nomeCat,$descCat))) {
		echo "<script>alert('Categoria cadastrada com sucesso')</script>";
	}
}
/*---------------------*/

/*Cadastro de usuario*/
if (isset($_POST['loginNUsuario'])){
	$NUlogin = $_POST['loginNUsuario'];
	$NUsenha = $_POST['senhaNUsuario'];
	$NUnome = $_POST['nomeNUsuario'];
	$NUtipo = $_POST['usuarioNPerfil'];
	$NUstatus = (integer) $_POST['statusNUsuario'];

	$novoUsuario = odbc_prepare($connect, "INSERT INTO Usuario (loginUsuario, senhaUsuario, nomeUsuario, tipoPerfil, usuarioAtivo) VALUES (?,?,?,?,?)");

	if (odbc_execute($novoUsuario,array($NUlogin, $NUsenha, $NUnome, $NUtipo, $NUstatus))) {
		echo "<script>alert('Novo usuário cadastrado com sucesso')</script>";
	}
}
/*---------------------*/

/*Excluir categoria*/
if (isset($_POST['categoriaExcluida'])){
	$categoriaExcluida = $_POST['categoriaExcluida'];

	if (odbc_exec($connect,"DELETE categoria WHERE idCategoria =".$categoriaExcluida)) {
		echo "<script>alert('Categoria excluída com sucesso')</script>";
	}
}
/*---------------------*/

/*Excluir produto*/
if (isset($_POST['produtoExcluido'])){
	$produtoExcluido = $_POST['produtoExcluido'];

	$consulta = odbc_exec($connect,"SELECT count(*) as QTD FROM Estoque WHERE idProduto = '".$produtoExcluido."'");
	$qtdEstoque = odbc_result($consulta, "QTD");
	
	if ($qtdEstoque > 0 ) {
		odbc_exec($connect,"DELETE Estoque WHERE idProduto =".$produtoExcluido);		
		if (odbc_exec($connect,"DELETE produto WHERE idProduto =".$produtoExcluido)) {
			echo "<script>alert('Produto excluído com sucesso')</script>";
		}
	} else {
		if (odbc_exec($connect,"DELETE produto WHERE idProduto =".$produtoExcluido)) {
			echo "<script>alert('Produto excluído com sucesso')</script>";
		}		
	}
}
/*--------------------*/

?>
