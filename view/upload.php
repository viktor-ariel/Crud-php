<?php
      include('../config/conexao.php');
      include('../model/arquivo.php');

      if(isset($_POST['uploadArq'])){
        $arquivo = $_FILES['arq']['name'];
        $nomearq = $_FILES['arq']['tmp_name'];
        $arqtam = $_FILES['arq']['size']/1024;
        $arqtipo = $_FILES['arq']['type'];
        $local = "../arquivos/";

        $up = new Arquivo();
        if(move_uploaded_file($nomearq,$local.$arquivo)){
            if($up->uploadArquivo($pdo,$arquivo,$arqtipo,$arqtam)){
                echo"
                <script>
                    alert('Arquivo Enviado Com Sucesso');
                    window.location.href = 'upload.php';
                </script>
                ";
            }
        }
      }
?>
<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style type="text/css">
        table,tr,td, tbody, thead{
            border: 1px solid #666;
            border-collapse: collapse;
            padding: 4px;
        }
        thead{
            background: #eee;
        }
        .cor{
            color: blueviolet;
            padding-left: 10px;
        }
    </style>
    <title>Upload de Arquivo</title>
</head>
<body>
    <h2>Upload de Arquivo</h2>
    <form action="" method="POST" enctype="multipart/form-data">
        <label for="">Arquivo:</label>
        <input type="file" name="arq"><br><br>
        <input type="submit" value="enviar" name="uploadArq">
    </form>
    <table>
    <thead>
        <tr>
            <td>ID</td>
            <td>Nome do Arquivo</td>
            <td>Tamanho</td>
            <td>Tipo</td>
            <td>Link arquivo</td>
            <td>imagem</td>
        </tr>
    </thead>
    <tbody>
        <?php
            $up= new Arquivo();
            $row = $up->verArquivos($pdo);
            foreach ($row as $linha) {
                echo "<tr>
                    <td>".$linha['id']."</td>
                    <td>".$linha['arquivo']."</td>
                    <td>".$linha['tamanho']." KB</td>
                    <td>".$linha['tipo']."</td>
                    <td><a href='../arquivos/".$linha['arquivo']."'>link</a></td>
                    <td><img width='50px' src='../arquivos/".$linha['arquivo']."'></td>
                </tr>";
            }
        ?>
    </tbody>
    </table>

</body>
</html>