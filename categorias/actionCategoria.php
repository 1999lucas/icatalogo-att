 <?php
 session_start();
  include("../database/conexao.php");

function validarCampos(){
  $erros = [];
  if(!isset($_POST["descricao"]) || $_POST["descricao"] == ""){
    $erros[] = "O campo descrição é obrigatório!";  
  }
  return $erros;
}

  switch($_POST['acao']){
    case 'inserir':
      $erros = validarCampos();
      
      if(count($erros) > 0){
        $_SESSION["erros"] = $erros;

        header("location: index.php");
      }
        if(isset($_POST['descricao'])){
          $descricao = $_POST['descricao'];
          $sqlInsert = "INSERT INTO tbl_categoria (descricao) VALUES ('$descricao');";

          $resultado = mysqli_query($conexao, $sqlInsert);
          if($resultado){
            $_SESSION["mensagem"] = "Categoria inserida com sucesso!";
          }else{
            $_SESSION["mensagem"] = "Ops, houve algum erro!";
          }

          header('location: index.php');
        }

      break;
    
    case 'deletar':
      if(isset($_POST['categoriaId'])){
        $categoriaId = $_POST['categoriaId'];
        $sqlDelete = "DELETE FROM tbl_categoria WHERE id = $categoriaId";

        $resultado = mysqli_query($conexao, $sqlDelete);
        header('location: index.php');
      }
  }
?>