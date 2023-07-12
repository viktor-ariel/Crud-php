<?php
    session_start();
    include_once('config/conexao.php');
    include_once('model/usuario.php');

    if(isset($_REQUEST['enviarLogin'])){
        extract($_REQUEST);
        $email = $_POST['email'];
        $senha = $_POST['senha'];
        
        $user = new Usuarios();
        $login = $user->verificaUsuario($pdo,$email,$senha);

        if($login){
            header("location:view/ver.php");
        }else{
            ?>
                <script>
                    alert("Senha ou Usuário incorretos");
                </script>


            <?php
        }
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="">
    <title>CRUD 2023</title>
</head>
<body>
    <form actiom="" method="POST">

        <label for="">E-mail</label>
        <input type="text" name="email"><br><br>
        
        <label for="">Senha</label>
        <input type="password" name="senha"><br><br>
        
        <input type="submit" value="logar" name="enviarLogin">
    </form>
</body>
</html>