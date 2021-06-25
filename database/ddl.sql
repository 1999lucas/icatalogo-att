create database icatalogo;

use icatalogo;

create table tbl_produto(
    id int primary key auto_increment,
    descricao varchar(255) not null,
    peso decimal not null,
    quantidade int not null,
    cor varchar(100) not null,
    tamanho varchar(100),
    valor decimal not null,
    desconto int,
    imagem varchar(500)
);




--Lógica de consulta e inserção: 

/*$query = " SELECT * FROM tbl_produto ";

$resultado = mysqli_query($conexao, $query) or die(mysqli_error($conexao)); 
//$linha1 = mysqli_fetch_array($resultado);
//$linha2 = mysqli_fetch_array($resultado);
//print_r($linha1);
//echo("<br>A descrição é: " . $linha2['descricao']);
$Descricao = "Terceira descrição";
$Peso = 9.4;
$Quantidade = 99;
$Cor = "Vermelho";

$sqlInsert = " INSERT tbl_produto (descricao, peso, quantidade, cor, tamanho, valor, desconto) VALUES ('descricao do produto três', 1.2, 100, 'Preto', 'P', 30.72, 12); "; 

$resultadoInsert = mysqli_query($conexao, $sqlInsert);

 
?>


<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Document</title>
</head>
<body>
  <table border="1">
    <tr>
      <th>ID</th>
      <th>DESCRIÇÂO</th>
    </tr>
    <?php
      while($linha = mysqli_fetch_array($resultado)){
    ?>
    <tr>
      <td><?=$linha['id']?></td>
      <td><?=$linha['descricao']?></td>
    </tr>
    <?php
      }
    ?>
  </table>
</body>
</html>

<?php
  mysqli_close($conexao);
?>*/
