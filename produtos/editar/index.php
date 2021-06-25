<?php
  session_start();
  include ("../../database/conexao.php");
  //Estamos pegando isso via GET (pela url), através da javascript (onclick):
  /*<img onclick="javascript: window.location = './editar?id=<?= $produtos['id'] ?>'" src="../imgs/edit.svg" alt=""> */
  $produtoId = $_GET['id'];
  //Selecionamos o produto pelo id informado:
  $sqlProduto = "SELECT * FROM tbl_produto WHERE id = $produtoId";
  //Fizemos uma requisição:
  $resultado = mysqli_query($conexao, $sqlProduto);
  //Demos um fetch array, que serve para ir diretamente no mysql e capiturar dados
  $produto = mysqli_fetch_array($resultado);
  //Se retornar falso, ou seja, se retornar que não há nenhum produto aqui dentro, então façã o seguinte:
  if(!$produto){
    die("Ops, esse produto não existe, acesso negado.");
    /*Ou, podemos fazer dessa forma: 
      echo "Ops, esse produto não existe, acesso negado.";
      exit();  
    */
  }


  $sqlSelect = "SELECT * FROM tbl_categoria;";
  $resultado = mysqli_query($conexao, $sqlSelect);

?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <link rel="stylesheet" href="../../styles-global.css" />
  <link rel="stylesheet" href="./editar.css" />
  <title>Editar Produtos</title>
</head>

<body>
  <header>
    <input type="search" placeholder="Pesquisar" />
  </header>
  <div class="content">
    <section class="produtos-container">
      <main>
        <form method="POST" class="form-produto" action="../novo/icatalogoActions.php" enctype="multipart/form-data">
          <h1>Editar produto</h1>
          <ul>
          <?php
          //Se tiver erros na função, então faça:
            if(isset($_SESSION["erros"])){
              //Percorrer todas as Strings que estão dentro de erros
              foreach($_SESSION["erros"] as $erros){    
          ?>
          <!--  para cada erro, haverá uma <li> -->
                <li><?= $erros ?></li>
          <?php
               
              }
              //Eliminação do(s) erro(s) que permanece(m) na tela:
              unset($_SESSION["erros"]);
            }

          ?>

        </ul>
          <div class="input-group span2">
            <input type="hidden" name="acao" value="editar"/>
            <!-- Deve-se também pegar o id para a edição de tal produto -->
            <input type="hidden" name="produtoId" value="<?=$produto['id']?>">
            <label for="descricao">Descrição</label>
            <!-- Através do value da input retornamos o dado que queremos editar. Graças ao fetch array que fizemos em $resultado, dando determinado valor da requisição a $produto -->
            <input type="text" name="descricaoInserir" id="descricao" placeholder="Digite a descrição do produto" required value="<?= $produto['descricao'] ?>">

          </div>
          <div class="input-group">
            <label for="peso">Peso</label>
            <input type="text" name="pesoInserir" id="peso" required value="<?=$produto['peso']?>">
          </div>
          <div class="input-group">
            <label for="quantidade">Quantidade</label>
            <input type="text" name="quantidadeInserir" id="quantidade" required value="<?=$produto['quantidade']?>">
          </div>
          <div class="input-group">
            <label for="cor">Cor</label>
            <input type="text" name="corInserir" id="cor" required value="<?=$produto['cor']?>">
          </div>
          <div class="input-group">
            <label for="tamanho">Tamanho</label>
            <input type="text" name="tamanhoInserir" id="tamanho" value="<?=$produto['tamanho']?>">
          </div>
          <div class="input-group">
            <label for="valor">Valor</label>
            <input type="text" name="valorInserir" id="valor" required value="<?= $produto['valor']?>">
          </div>
          <div class="input-group">
            <label for="desconto">Desconto</label>
            <input type="text" name="descontoInserir" id="desconto" value="<?= $produto['desconto'] ?>">
          </div>
          <div class="input-group">
           <label for="categoria">Categoria</label>
           <select name="categoria" id="categorias" required>
           <?php
            while($categoria = mysqli_fetch_array($resultado)){ 
           ?>
             <option value="<?=$categoria["id"]?>"<?= $categoria['id'] == $produto['categoria_id'] ? "selected" : ""?>>
              <?= $categoria ["descricao"]?>
            </option>
          <?php
            }
           ?>
           </select>
          </div>
          <!-- upload: enviar um arquivo para a nuvem -->
          <div class="input-group">
            <label for="categoria"></label>
            <input type="file" name="foto" id="foto" accept="image/*">
          </div>
          <button onclick="javascript:window.location.href = '../'">Cancelar</button>
          <button>Salvar</button>
        </form>
      </main>
    </section>
  </div>
  <footer>
    SENAI 2021 - Todos os direitos reservados
  </footer>
</body>

</html>