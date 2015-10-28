<html>
  <head>
    <meta charset="UTF-8" />
    <title>Filtros agrupados</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <script src="js/index.js"></script>
    <script type="text/javascript" src="http://code.jquery.com/jquery-1.7.2.min.js"></script>
  </head>
  
  <body>
  <?php $consulta = odbc_exec($connect,"SELECT idProduto, nomeProduto, descProduto, precProduto, qtdMinEstoque, imagem FROM Produto");?>
  <div class="div-center">
    <table class="tabela">
        <thead>
            <tr>
                <th>Código</th>
                <th>Nome</th>
                <th>Descricao</th>
                <th>Preco</th>
                <th>Estoque Minimo</th>
            </tr>			
        </thead>
        <tbody>
          <?php
          while ($resultado = odbc_fetch_array($consulta)) {
            echo "
            <tr>
              <td>". $resultado['idProduto']."</td>
              <td>".$resultado['nomeProduto']."</td>
              <td>".$resultado['descProduto']."</td>
              <td>".$resultado['precProduto']."</td>
              <td>".$resultado['qtdMinEstoque']."</td>
            </tr>";
            }						
          ?>				
        </tbody>
    </table>
  </div>

</body>
</html>