<?php
session_start();
include "../../database/conexao.php";
$_SESSION['logged'] = false;
///Implementação da autenticação: verifica se o usuário e a senha são autenticos
//O fluxo de autorização é quando verificamos se determinado usuário tem acesso a alguma funcionalidade
  switch(isset($_POST["acao"])){
    case "login":
        if(isset($_POST['usuario']) && isset($_POST['senha'])){
          $usuario = $_POST['usuario'];
          $senha = $_POST['senha'];
          $query = "SELECT * FROM tbl_administrador;";
          $usuario = mysqli_fetch_array($query);
          $verificaUsuario = mysqli_query($conexao, "SELECT usuario FROM tbl_administrador WHERE usuario = '$usuario' AND senha = $senha;");
          // $verificaSenha = mysqli_query($conexao, "SELECT senha FROM tbl_administrador WHERE senha = '$senha';");
          if(mysqli_num_rows($verificaUsuario) == 1){
            //se estiver correta, salvar o id e o nome do usuário na sessão com session: não feito, pois não consegui, ainda.
            $_SESSION['usuarioId'] = $usuario['id'];
            $_SESSION['usuarioNome'] = $usuario['nome'];
            $_SESSION['logged'] = true;
            //Salvando o nome do usuário:
            header("location: ../../produtos/index.php");
          }else{
            
          }
        }
        //receber os campos do fomulário: feito

        //montar o sql select na tabela tbl_administrador
        //SELECT * FROM tbl_adminitrador WHERE usuario = $usuario; -> vai procurar se o usuario do mysql é igual ao usuario do form ou se ele existe
        
        //verificar se o usuário existe e se a senha está correta: feito

      
        //redirecionar para tela de listagem de produtos, onde haverão os "novos botôes": feito

        break;

    case "logout":
        //implementar o logout
        
        break;

    
  }
 header("location: ../../produtos/index.php");
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
 
  </body>
  </html>