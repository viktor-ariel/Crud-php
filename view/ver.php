<?php
    session_start();
    include('../config/conexao.php');
    include('../model/usuario.php');

    $users = new Usuarios();
    $mostrar = $users->mostrarUsuario($pdo);

    if(!$users->ativar_sessao()){
        header("location:../");
    }
    if(isset($_GET['sair'])){
        $users->fazer_logof();
        header("location:../");
    }

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>MOSTRAR USUARIO</title>
</head>
<body>
    <a href="ver.php?sair" style="float:right">Sair</a>
    
    <H2>Usuários cadastrados: </H2>
    <table border="1px">
        <thead></thead>
        <tr>
            <td>ID</td>
            <td>Nome</td>
            <td>E-mail</td>
            <td colspan="2">Ações</td>
        </tr>
        <tbody>
            <?php
                foreach($mostrar as $linha){
                echo"
                    <tr>
                        <td>".$linha['id']."</td>
                        <td>".$linha['nome']."</td>
                        <td>".$linha['email']."</td>
                        <td><a href='editar.php?id=".$linha['id']."'>Editar</a></td>
                        <td><a href='../controller/delete.php?id=".$linha['id']."'onClick=\"return confirm('Tem certeza que quer excluir usuário ".$linha['nome']."?')\"> Deletar </a></td>
                    </tr>
                ";
                }
            ?>
        </tbody>
    </table>  
    <a href="inserir.php">Cadastrar Usuário</a> 
</body>
</html>