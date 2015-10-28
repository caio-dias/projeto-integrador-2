<html>
  <head>
    <meta charset="UTF-8" />
    <title>Filtros agrupados</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="js/index.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
  </head>
  
  <body>
  <?php $consulta = odbc_exec($connect,"SELECT idUsuario, loginUsuario, senhaUsuario, nomeUsuario, tipoPerfil, usuarioAtivo FROM Usuario");
    ?>
  <div class="div-center">
      <table class="tabela">
        <thead>
          <tr>
            <th>Código</th>
            <th>Login</th>
            <th>Senha</th>
            <th>Nome</th>
            <th>Tipo de Perfil</th>
            <th>Usuario Ativo</th>
          </tr>			
        </thead>
        <tbody>
          <?php
          while ($resultado = odbc_fetch_array($consulta)) {
            echo"
            <tr>
              <td>". $resultado['idUsuario']."</td>
              <td>".$resultado['loginUsuario']."</td>
              <td>".$resultado['senhaUsuario']."</td>
              <td>".$resultado['nomeUsuario']."</td>
              <td>".$resultado['tipoPerfil']."</td>
              <td>".$resultado['usuarioAtivo'] = ($resultado['usuarioAtivo'] == 1)? "Sim" : "Não"."</td>
            </tr>";
          }						
          ?>				
        </tbody>
      </table>
  </div>

</body>
</html>