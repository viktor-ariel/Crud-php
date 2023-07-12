<?php
        session_start();
        include('../config/conexao.php');
        include('../model/usuario.php');

        if(!empty($_REQUEST['enviarDados'])){
            extract($_REQUEST);
            $user = new Usuarios($_POST);
            $user -> cadastrarUsuarios($pdo);
            if ($user){
                echo "<script> 
                    alert('Usuário cadastrado com sucesso!');
                    window.location.href = 'ver.php';
                </script>
                ";
            }
 
        }
        $user = new Usuarios();
        if(!$user->ativar_sessao()){
            header("location:../");
        }
        if(isset($_GET['sair'])){
            $user->fazer_logof();
            header("location:../");
        }


?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cadastrar Usuário</title>
</head>
<body>
    <h2>Cadastrar Usuário</h2>
    <a href="ver.php?sair" style="float:right">Sair</a>
    <form action="" method="POST">
       <label>Nome:</label>
        <input type="text" name="nome"><br><br>
       <label>Email:</label>
        <input type="email" name="email"><br><br>
       <label>Senha:</label>
        <input type="password" name="senha"><br><br>
        <input type="submit" name="enviarDados" value="Cadastrar"><br>
    </form>
</body>
</html>