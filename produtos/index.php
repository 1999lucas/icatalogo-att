<?php
session_start();
    require("../database/conexao.php");
    if(isset($_GET['pesquisar'])){
        $consulta = $_GET['pesquisar']; 
        $sql = "SELECT p.*, c.descricao as categoria FROM tbl_produto p
        INNER JOIN tbl_categoria c ON p.categoria_id = c.id
        WHERE p.descricao LIKE '%$consulta%'
        OR c.descricao LIKE '%$consulta%'
        ORDER BY p.id DESC";
        $resultado = mysqli_query($conexao, $sql);
    }else{ 
        $sql = " SELECT p.*, c.descricao as categoria FROM tbl_produto p INNER JOIN tbl_categoria c ON p.categoria_id = c.id ORDER BY p.id DESC ";
    }

    $resultado = mysqli_query($conexao, $sql) or die(mysqli_error($conexao));

    //percorrer os resultado, mostrando um card para cada produto

    //mostrar a imagem do produto (que veio do banco)

    //mostrar o valor do produto//mostrar a descricao do produto
    
    //mostrar a categoria do produto
    
    //DESAFIO: mostrar a opção de parcelamento
    
    //SE O VALOR > 1000, PARCELAR EM ATÉ 12x
    
    //SE NÃO, PARCELAR EM ATÉ 6x
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../styles-global.css" />
    <link rel="stylesheet" href="./produtos.css" />
    <title>Administrar Produtos</title>
</head>

<body>
    <?php
        include "../componentes/header/header.php";
    ?>
    <div class="content">
        <section class="produtos-container">
        <?php
            //Autorização:
            //if(isset($_SESSION['logged'])){
            if(isset($_SESSION["usuarioId"])){
            //Se o usuário estiver logado, mostrar os botôes Novo produto e adicionar categoria
            //Se estiver correto, salvar no session o id e o nome do usuario cadastrado
        ?>
            <header>
                    <button onclick="javascript:window.location.href ='./novo/'">Novo Produto</button>
                    <button onclick="javascript:window.location.href ='../categorias/'">Adicionar Categoria</button>
            </header>
        <?php
            }
            //unset($_SESSION["logged"]);
        ?>
            <main>
                <?php
                    while($produtos = mysqli_fetch_array($resultado)){
                    $parcelas = $produtos['valor'] > 1000 ? 12 : 6;
                    $valorParcelas = $produtos['valor'] / $parcelas;
                    $valorDescontado = ($produtos['valor'] - $produtos['desconto']); 
                ?>
                <article class="card-produto">
                    <?php
                        if(isset($_SESSION['usuarioId'])){
                    ?>
                    <div class="acoesProdutos">
                        <img onclick="javascript: window.location = './editar?id=<?= $produtos['id'] ?>'" src="../imgs/edit.svg" alt="">
                        <img onclick="deletar(<?= $produtos['id'] ?>)" src="../imgs/trash.png" alt="">
                    </div>
                    <?php
                        }
                    ?>
                    <figure>
                        <img src="../produtos/novo/fotos/<?= $produtos['imagem'] ?>"/>
                    </figure>
                    
                    <section>                                                 
                                                                        <!-- duas casas decimais após a vígula. A vírgula será o separadomr de milhar e o ponto de centavos -->
                        <span class="preco">R$: <?= number_format($valorDescontado, 2, ",", ".")?></span>
                        <span class="parcelamento">ou em <em>R$: <?= number_format($valorParcelas, 2, ",", ".")?>x</em></span>

                        <span class="descricao"><?= $produtos['descricao'] ?></span>
                        <span class="categoria">
                            <em><?= $produtos['categoria'] ?></em>
                        </span>
                    </section>
                    <footer>

                    </footer>
                </article>
                <?php
                    }
                ?>
                <form id="formDeletar" method="POST" action="./novo/icatalogoActions.php">
                    <input type="hidden" name="acao" value="deletar"/>
                    <input type="hidden" name="produtoId" id="produtoId"/>
                </form>
            </main>
        </section>
    </div>
    <footer>
        SENAI 2021 - Todos os direitos reservados
    </footer>
    <script Lang="javascript">
        function deletar(id){
            if(confirm("Tem certeza que deseja deletar este produto?")){    
                document.querySelector('#produtoId').value = id;
                document.querySelector('#formDeletar').submit();
            }
        }
    </script>
</body>

</html>