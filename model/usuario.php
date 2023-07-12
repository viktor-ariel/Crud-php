<?php
    class Usuarios{
        public $nome;
        public $email;
        public $senha;

        function __construct($atrib = array()){
            if(!empty($atrib)){
                $this->nome = $atrib['nome'];
                $this->email = $atrib['email'];
                $this->senha = $atrib['senha'];
            }
        }

        public function verificaUsuario($pdo,$email,$senha){
            $sth = $pdo->prepare("SELECT * FROM usuarios WHERE email=:email AND senha=:senha");
            $sth -> BindValue(':email',$email);
            $sth -> BindValue(':senha',md5($senha));
            $sth -> execute();
            $login = $sth->fetch(PDO::FETCH_ASSOC);

            if($login){
                $_SESSION['login']=true;
                return true;
            }else {
                return false;
            }

        }


        public function mostrarUsuario($pdo){
            $sth = $pdo->query("SELECT * FROM usuarios");
            $sth->execute();
            return $user = $sth->fetchAll(PDO::FETCH_ASSOC);
        }

        public function cadastrarUsuarios($pdo){
            $sth = $pdo->prepare("INSERT INTO usuarios (nome,email,senha) value (:nome,:email,:senha)");
            $sth->BindValue(':nome', $this->nome);
            $sth->BindValue(':email', $this->email);
            $sth->BindValue(':senha', md5($this->senha));
            return $sth->execute();
        } 

        static function deletarUsuario($pdo,$id){
            $sth = $pdo -> prepare("DELETE FROM usuarios WHERE id=:id LIMIT 1");
            $sth -> BindValue(':id',$id);
            return $sth->execute(); 
        }

        static function pesquisarUsuario($pdo,$id){
            $sth = $pdo -> prepare("SELECT * FROM usuarios WHERE id=:id LIMIT 1");
            $sth -> BindValue(':id',$id);
            $sth->execute();
            return $user = $sth->fetch(PDO::FETCH_ASSOC); 
        }

        public function editarUsuario($pdo,$id){
            $sth = $pdo->prepare("UPDATE usuarios SET nome=:nome,email=:email,senha=:senha WHERE id=:id");
            $sth->BindValue(':nome', $this->nome);
            $sth->BindValue(':email', $this->email);
            $sth->BindValue(':senha', $this->senha);
            $sth->BindValue(':id', $id);
            return $sth->execute();
        }
        public function ativar_sessao(){
            return $_SESSION['login'];
        }
        public function fazer_logof(){
            $_SESSION['login'] = false;
            session_destroy();
        }


    }
?>