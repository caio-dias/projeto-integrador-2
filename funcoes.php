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

	if(	substr($_FILES['imagemProduto']['type'], 0, 5) == 'image' && $_FILES['imagemProduto']['error'] == 0 && ($_FILES['imagemProduto']['size'] > 0 )){
		$file = fopen($_FILES['imagemProduto']['tmp_name'],'rb');
		$fileParaDB = fread($file, filesize($_FILES['imagemProduto']['tmp_name']));
		fclose($file);
	}

	$produto = odbc_prepare($connect, "INSERT INTO Produto (nomeProduto,precProduto,descontoPromocao,idCategoria,descProduto,ativoProduto,qtdMinEstoque,imagem) VALUES (?,?,?,?,?,?,?,?)");
	
	if (odbc_execute($produto,array($nomeProduto,$precoProduto,$descontoProduto,$categoriaProduto, $descricaoProduto,$statusProduto,$estoqueMinProduto,$fileParaDB))) {
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
if (isset($_POST['excluirCategoria'])){
	$excluirCategoria = $_POST['excluirCategoria'];
	$consulta = odbc_exec($connect,"SELECT count(*) as QTD FROM Produto WHERE idCategoria = '".$excluirCategoria."'");
	$produtoNaCategoria = odbc_result($consulta, "QTD");

	if ($produtoNaCategoria > 0){
		echo "<script>alert('Não foi possível excluir a categoria pois há produtos cadastrados na mesma')</script>";		
	}
	else if (odbc_exec($connect,"DELETE categoria WHERE idCategoria =".$excluirCategoria)){
		echo "<script>alert('Categoria excluída com sucesso')</script>";
	}

}
/*---------------------*/

/*Excluir produto*/
if (isset($_GET['acao']) AND $_GET['acao'] == 'excluirProduto'){
	$excluirProduto = $_GET['idProduto'];

	$consulta = odbc_exec($connect,"SELECT count(*) as QTD FROM Estoque WHERE idProduto = '".$excluirProduto."'");
	$qtdEstoque = odbc_result($consulta, "QTD");
	
	if ($qtdEstoque > 0 ) {
		odbc_exec($connect,"DELETE Estoque WHERE idProduto =".$excluirProduto);		
		if (odbc_exec($connect,"DELETE produto WHERE idProduto =".$excluirProduto)) {
			echo "<script>alert('Produto excluído com sucesso')</script>";
		}
	} else {
		if (odbc_exec($connect,"DELETE produto WHERE idProduto =".$excluirProduto)) {
			echo "<script>alert('Produto excluído com sucesso')</script>";
		}		
	}
}
/*--------------------*/

/*Excluir usuario*/
if (isset($_POST['excluirUsuario'])){
	$excluirUsuario = $_POST['excluirUsuario'];
	
	if (odbc_exec($connect,"DELETE Usuario WHERE idUsuario =".$excluirUsuario)){
		echo "<script>alert('Usuário excluído com sucesso')</script>";
	}

}
/*---------------------*/

/*Atualizar Categoria*/
if ((isset($_POST['idAtCat'])) AND $_POST['idAtCat'] <> null){
	$idAtCat = $_POST['idAtCat'];
	$nomeAtCat = $_POST['nomeAtCat'];
	$descAtCat = $_POST['descAtCat'];
	
	if (odbc_exec($connect, "UPDATE Categoria set nomeCategoria='".$nomeAtCat."', descCategoria='".$descAtCat."' WHERE idCategoria = ".$idAtCat)) {
		echo "<script>alert('Categoria atualizada com sucesso')</script>";
	}
}
/*--------------------*/

/*Atualizar Produto*/
if ((isset($_POST['nomeAtProd'])) AND $_POST['idAtProd'] <> null){
	$idAtProd = $_POST['idAtProd'];
	$nomeAtProduto = $_POST['nomeAtProd'];
	$precoAtProduto = (float) $_POST['precoAtProd'];
	$descontoAtProduto = (float) $_POST['descontoAtProd'];
	$descricaoAtProduto = $_POST['descAtProd'];
	$statusAtProduto = (bool) $_POST['statusAtProduto'];
	$estoqueMinAtProduto = $_POST['estoqueMinAtProd'];	

	if((substr($_FILES['imagemAtProd']['type'], 0, 5) == 'image') && ($_FILES['imagemAtProd']['error'] == 0) && (($_FILES['imagemAtProd']['size'] > 0) )){
		$file = fopen($_FILES['imagemAtProd']['tmp_name'],'rb');
		$fileAtParaDB = fread($file, filesize($_FILES['imagemAtProd']['tmp_name']));
		fclose($file);
	}

	$updateProduto = odbc_prepare($connect, "UPDATE Produto SET nomeProduto = ? ,precProduto = ?,descontoPromocao = ?,descProduto = ?,ativoProduto = ?,qtdMinEstoque = ?,imagem  = ? WHERE idProduto = ? ");

	if (odbc_execute($updateProduto,array($nomeAtProduto,$precoAtProduto,$descontoAtProduto, $descricaoAtProduto,$statusAtProduto,$estoqueMinAtProduto,$fileAtParaDB, $idAtProd))) {
		echo "<script>alert('Produto atualizado com sucesso')</script>";
	} 

}


/*---------------------*/
?>
