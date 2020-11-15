<?php
    class Usuario extends Model{
        private $nome;
        private $endereco;
        private $email;
        private $cartaodecredito;
        private $cpf;
        private $telefone;
        private $senha;
        private $tipousuario;

        public function getNome(){
            return $this->nome;
        }

        public function setNome($nome){
            $this->nome = $nome;
        }

        public function getEndereco(){
            return $this->endereco;
        }

        public function setEndereco($endereco){
            $this->endereco = $endereco;
        }

        public function getEmail(){
            return $this->email;
        }

        public function setEmail($email){
            $this->email = $email;
        }

        public function getCartaodecredito(){
            return $this->cartaodecredito;
        }

        public function setCartaodecredito($cartaodecredito){
            $this->cartaodecredito = $cartaodecredito;
        }

        public function getCpf(){
            return $this->cpf;
        }

        public function setCpf($cpf){
            $this->cpf = $cpf;
        }

        public function getTelefone(){
            return $this->telefone;
        }

        public function setTelefone($telefone){
            $this->telefone = $telefone;
        }

        public function getSenha(){
            return $this->senha;
        }

        public function setSenha($senha){
            $this->senha = $senha;
        }

        public function getTipo(){
            return $this->tipousuario;
        }

        public function setTipousuario($tipousuario){
            $this->tipousuario = $tipousuario;
        }

        public function cadastrar($nome, $email, $senha, $telefone,  $endereco, $cpf, $cartaocredito, $idtipousuario){
            
            $sql = $this->db->prepare("SELECT id FROM usuarios WHERE cpf = :cpf");
            $sql->bindValue(":cpf", $cpf);
            $sql->execute();

            if($sql->rowCount() == 0){
                $sql = $this->db->prepare("INSERT INTO usuarios (nome, endereco, cpf, cartaocredito, email, senha, telefone, idtipousuario) VALUES (:nome, :endereco, :cpf, :cartaocredito, :email, :senha, :telefone, :idtipousuario)");
                $sql->bindValue(":nome", $nome);
                $sql->bindValue(":endereco", $endereco);
                $sql->bindValue(":cpf", $cpf);
                $sql->bindValue(":cartaocredito", $cartaocredito);
                $sql->bindValue(":email", $email);
                $sql->bindValue(":senha", md5($senha));
                $sql->bindValue(":telefone", $telefone);
                $sql->bindValue(":idtipousuario", $idtipousuario);                
                $sql->execute();
                return true;

            }else{
                return false;
            }
        }

        public function login($email, $senha){
            
            $sql = $this->db->prepare("SELECT id FROM usuarios WHERE email = :email AND senha = :senha");
            $sql->bindValue(":email", $email);
            $sql->bindValue(":senha", md5($senha));
            $sql->execute();

            if($sql->rowCount() > 0){
                $dado = $sql->fetch();
                $_SESSION['cLogin'] = $dado['id'];
                return true;
            }else{
                return false;
            }

        }

        public function gettipoUsuario(){
        
            $array = array();
            $sql = $this->db->prepare("SELECT * FROM usuariostipo");
            $sql->execute();
    
            if($sql->rowCount() > 0){
                $array = $sql->fetch();            
            }
            return $array;
        }

        
    }
?>