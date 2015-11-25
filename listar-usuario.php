<html>
<?php include 'head.php';?>
<body>
  <div class="container">
    <?php
      session_start();
      include 'funcoes.php';
      $consulta = odbc_exec($connect,"SELECT idUsuario, loginUsuario, nomeUsuario, tipoPerfil, usuarioAtivo FROM Usuario");
      include 'menu.php';
    if (isset($_SESSION['usuario'])) { ?>
      <div class="div-center">
        <h1>Listagem de usuários</h1>
        <table class="tabela">
          <thead>
            <tr>
              <th>Login</th>
              <th>Nome</th>
              <th>Tipo de Perfil</th>
              <th>Usuario Ativo</th>
              <th>Excluir</th>
              <th>Editar</th>
            </tr>     
          </thead>
          <tbody>
            <?php
            while ($resultado = odbc_fetch_array($consulta)) {
              if ($resultado['usuarioAtivo'] == 1) { 
                $statusUsuario = "Sim";
              } else {
                $statusUsuario = "Não";
              }
              if ($resultado['tipoPerfil'] == 'A') { 
                $tipoPerfil = "Admin";
              } else {
                $tipoPerfil = "Editor";
              }

              echo"
              <tr>
                <td>".$resultado['loginUsuario']."</td>
                <td>".$resultado['nomeUsuario']."</td>
                <td>".$tipoPerfil."</td>
                <td>".$statusUsuario."</td>
                <td><form class='form-btn-tabela' action='listar-usuario.php' method='POST'><button type='submit' name='excluirUsuario' value=".$resultado['idUsuario']." class='btn-tabela'>Excluir</button><form/></td>
                <td><a name='editarCategoria' value=".$resultado['idUsuario']." class='btn-tabela' onclick='PreencheCampos(\"".$resultado['idUsuario']."\", \"".$resultado['nomeUsuario']."\");'>Editar</a></td>
              </tr>";
            }           
            ?>        
          </tbody>
        </table>
        <div id="form-editar">
          <h3>Editando o Usuário <span id="span-cat"></span></h3>
          <span id="close-form" title="Fechar">X</span>
          <form action="listar-usuario.php" method="POST" class="formulario">
              <p style="display:none;"><input id="id-cat" type="number" name="idAtCat"/></p>
              <p>Novo Login: <input id="nome-cat" type="text" name="loginAtUsu"/></p>
              <p>Novo Nome: <input id="nome-cat" type="text" name="nomeAtUsu"/></p>              
              <p>Nova Senha: <input id="desc-cat"type="password" name="senhaAtUsu"/></p>
              <p>Tipo de perfil:
                <select name="perfilAtUsu">
                  <option value="A">Administrador</option>
                  <option value="U">Usuário</option>
                </select>
                <p>Usuário ativo:
                  <select name="statusAtUsu">
                    <option value="1">Ativo</option>
                    <option value="0">Inativo</option>
                  </select>
                </p>
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