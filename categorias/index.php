<?php
    session_start();
     include("../database/conexao.php");
     $sqlSelect = "SELECT * FROM tbl_categoria;";
     $resultado = mysqli_query($conexao, $sqlSelect) or die(mysqli_error($conexao));
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles-global.css" />
    <link rel="stylesheet" href="./style_categoria.css" />
    <title>Administrar Categorias</title>
</head>

<body>
    <?php
    include("../componentes/header/header.php");
    ?>
    <div class="content">
        <section class="categorias-container">
            <main>
                <form method="POST" class="form-categoria" action="actionCategoria.php">
                    <h1 class="span2">Adicionar Categorias</h1>
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
                        <label for="descricao">Descrição</label>
                        <input type="hidden" name="acao" value="inserir">
                        <input type="text" name="descricao" id="descricao" placeholder="Insira a descrição" required/>
                    </div>
                    <button type="button" onclick="javascript:window.location.href = '../../icatalogo-parte1/categorias/index.php'">Cancelar</button>
                    <button>Salvar</button>
                </form>
                <h1>Lista de Categorias</h1>
                <!--Percorrer os resultados da consulta-->
                <?php
                //Se o número de resultados de linhas for igual a zero, então exibe o erro: "Nenhuma categoria cadastrada"
                if(mysqli_num_rows($resultado) == 0){
                                    //Centralizamos o texto
                    echo "<p style='text-align: center'>Nenhuma categoria cadastrada</p>";
                }
                //Listagem: 
                    while($categoria = mysqli_fetch_array($resultado)){
                ?>
                <div class="card-categorias">
                    <?= $categoria['descricao']?>
                        <img onclick="deletar(<?= $categoria['id']?>)" src="https://icons.veryicon.com/png/o/construction-tools/coca-design/delete-189.png"/>
                </div>
                <?php
                    }
                ?>
                <form id="form-deletar" method="POST" action="./actionCategoria.php" >
                    <input type="hidden" name="acao" value="deletar">
                    <input type="hidden" id="categoriaId" name="categoriaId" value="<?= $categoria['id'] ?>"/>
                </form>
            </main>
        </section>
    </div>
    <script lang="javascritp">
        function deletar(categoriaId){
            document.querySelector('#categoriaId').value = categoriaId;
            document.querySelector('#form-deletar').submit();
        }
    </script>
</body>

</html>