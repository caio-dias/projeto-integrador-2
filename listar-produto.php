<html>
<?php include 'head.php';?>
<body>
  <div class="container">
    <?php
      session_start();
      ini_set('odbc.defaultlrl',9000000);
      include 'funcoes.php';
      $consulta = odbc_exec($connect,"SELECT idProduto, nomeProduto, descProduto, precProduto, qtdMinEstoque, imagem, nomeCategoria FROM Produto inner join Categoria on (produto.idCategoria = categoria.idCategoria)");
      include 'menu.php';
    if (isset($_SESSION['usuario'])) { ?>
      <div class="div-center listas">
        <h1>Listagem de produtos</h1>
        <table class="tabela">
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Imagem</th>
                    <th>Preço</th>
                    <th>Categoria</th>
                    <th>Estoque</th>
                    <th>Excluir</th>
                    <th>Editar</th>
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
                  <td>".utf8_encode($resultado['nomeCategoria'])."</td>
                  <td>".$resultado['qtdMinEstoque']."</td>
                  <td><a href='listar-produto.php?acao=excluirProduto&idProduto=".$resultado['idProduto']."' class='btn-tabela'>Excluir<a/></td>
                  <td><a name='editarCategoria' value=".$resultado['idProduto']." class='btn-tabela' onclick='PreencheCampos(\"".$resultado['idProduto']."\", \"".$resultado['nomeProduto']."\");'>Editar</a></td>
                </tr>";
                }           
              ?>        
            </tbody>
        </table>
        <div id="form-editar">
          <h3>Editando o Produto <span id="span-cat"></span></h3>
          <span id="close-form" title="Fechar">X</span>
          <form action="listar-produto.php" method="POST" class="formulario"  enctype="multipart/form-data">
              <p style="display:none;"><input id="id-cat" type="number" name="idAtProd"/></p>
              <p>Novo nome: <input type="text" name="nomeAtProd"/></p>
              <p>Nova foto: <input type="file" name="imagemAtProd" class="p-img"></p>
              <p>Novo preço: <input type="text" name="precoAtProd" size="4"/></p>
              <p>Novo desconto: <input type="text" name="descontoAtProd" size="4"/></p>     
              <p>Nova descrição: <input type="text" name="descAtProd"/></p>
              <p>Status do Produto:
               <select name="statusAtProduto">
                  <option value="1">Ativo</option>
                  <option value="0">Inativo</option>
              </select>
            </p>
            <p>Estoque mínimo: <input type="text" name="estoqueMinAtProd" size="4"/></p>
            <input type="submit" value="Enviar" class="btn-forms" id="submit">
            <input type="reset" value="Limpar dados" class="btn-forms" id="submit">
          </form>
        </div>
      </div>
    <?php } else {
       header("location:index.php");
    } ?>
  </div>
</body>
</html>