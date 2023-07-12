<?php 
    class Arquivo{
        function uploadArquivo($pdo,$arquivo,$arqtipo,$arqtam){
            $sth = $pdo->prepare("INSERT INTO tabela1 (arquivo,tipo,tamanho) VALUES (:arquivo,:tipo,:tamanho)");
            $sth->BindValue(':arquivo',$arquivo);
            $sth->BindValue(':tipo',$arqtipo);
            $sth->BindValue(':tamanho',$arqtam);
            return $sth->execute();
        }
        static function verArquivos($pdo){
            $sth = $pdo -> prepare("SELECT * FROM tabela1");
            $sth->execute();
            return $sth->fetchAll(PDO::FETCH_ASSOC);
        }
    }
?>