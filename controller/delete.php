<?php
    session_start();
    include('../config/conexao.php');  
    include('../model/usuario.php');
        
        
    $id = $_GET['id'];

    $user = new Usuarios();
        if(!$user->ativar_sessao()){
            header("location:../");
        }
        if(isset($_GET['sair'])){
            $user->fazer_logof();
            header("location:../");
        }

    if(!empty($id)){
        Usuarios::deletarUsuario($pdo,$id);
        echo"
            <script>
                alert('Usuario deletado com sucesso');
                window.location.href='../view/ver.php';
            </script>
        ";
    }







?>