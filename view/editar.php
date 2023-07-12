<?php
        session_start();
        include('../config/conexao.php');
        include('../model/usuario.php');

        
        
        $user = new Usuarios();
        if(!$user->ativar_sessao()){
            header("location:../");
        }
        
        $id = $_GET['id'];
        if(!empty($id)){
            $user = Usuarios::pesquisarUsuario($pdo,$id);
        }
   


        if(!empty($_REQUEST['enviarDados'])){
            extract($_REQUEST);
            $user = new Usuarios($_POST);
            $user -> editarUsuario($pdo,$id);
            if ($user){
                echo "<script> 
                    alert('Editado com sucesso!');
                    window.location.href = 'ver.php';
                </script>
                ";
            }
        }

        
    

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Editar Usuário</title>
</head>
<body>
    <h2>Editar Usuário</h2>
   
    <form action="" method="POST">
       <label>Nome:</label>
        <input type="text" name="nome" value="<?php echo $user['nome']?>"><br><br>
       <label>Email:</label>
        <input type="email" name="email" value="<?php echo $user['email']?>"><br><br>
       <label>Senha:</label>
        <input type="password" name="senha" value="<?php echo $user['senha']?>"><br><br>
        <input type="submit" name="enviarDados" value="Atualizar"><br>
    </form>
</body>
</html>