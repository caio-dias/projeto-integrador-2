<html>

<?php include 'head.php';?>
<body>
  <div class="container">
    <?php
      session_start();
      include 'funcoes.php';
      $consulta = odbc_exec($connect,"SELECT idCategoria, nomeCategoria, descCategoria FROM Categoria");
      include 'menu.php';    
      if (isset($_SESSION['usuario'])) { ?>
        <div class="div-center listas">
          <h1>Listagem de categorias</h1>
          <table class="tabela">
              <thead>
                  <tr>
                      <th>Código</th>
                      <th>Nome</th>
                      <th>Descrição</th>
                      <th>Excluir</th>
                      <th>Editar</th>
                  </tr>     
              </thead>
              <tbody>
                <?php
                while ($resultado = odbc_fetch_array($consulta)) {
                  echo "
                  <tr>
                    <td>".$resultado['idCategoria']."</td>
                    <td id='nome-cat'>".$resultado['nomeCategoria']."</td>
                    <td>".$resultado['descCategoria']."</td>
                    <td><form class='form-btn-tabela' action='listar-categoria.php' method='POST'><button type='submit' name='excluirCategoria' value=".$resultado['idCategoria']." class='btn-tabela'>Excluir</button><form/></td>
                    <td><a name='editarCategoria' value=".$resultado['idCategoria']." class='btn-tabela' onclick='PreencheCampos(\"".$resultado['idCategoria']."\", \"".$resultado['nomeCategoria']."\");'>Editar</a></td>
                  </tr>";
                  }           
                ?>
              </tbody>
          </table>
          <div id="form-editar">
            <h3>Editando a Categoria <span id="span-cat"></span></h3>
            <span id="close-form" title="Fechar">X</span>
            <form action="listar-categoria.php" method="POST" class="formulario">
                <p style="display:none;"><input id="id-cat" type="number" name="idAtCat"/></p>
                <p>Novo nome: <input id="nome-cat" type="text" name="nomeAtCat"/></p>
                <p>Nova descrição: <input id="desc-cat"type="text" name="descAtCat"/></p>
              <input type="submit" value="Enviar" class="btn-forms" id="submit">
              <input type="reset" value="Limpar dados" class="btn-forms" id="submit">
            </form>
          </div>
        </div>
      <?php } else {
         header("location:index.php");
      } ?>
    </div>
  </div>
</body>

</html>