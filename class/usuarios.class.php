<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/supersuspect/core/class.php';
    class Usuario extends Model{
        
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
            
            $sql = $this->db->prepare("SELECT id, idtipousuario FROM usuarios WHERE email = :email AND senha = :senha");
            $sql->bindValue(":email", $email);
            $sql->bindValue(":senha", md5($senha));
            $sql->execute();

            if($sql->rowCount() > 0){
                $dado = $sql->fetch();
                $_SESSION['cLogin'] = $dado['id'];
                $_SESSION['cTipoLogin'] = $dado['idtipousuario'];
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
                $array = $sql->fetchAll(PDO::FETCH_ASSOC);            
            }
            return $array;
        }

        public function getusuarioNome($id){
        
            $array = array();
            $sql = $this->db->prepare("SELECT nome FROM usuarios WHERE id = :id");
            $sql->bindValue(":id", $id);
            $sql->execute();
    
            if($sql->rowCount() > 0){
                $array = $sql->fetch();            
            }
            return $array;
        }

        public function getEndereco(){
            $array = array();
            $sql = $this->db->prepare("SELECT endereco FROM usuarios WHERE id = :id");
            $sql->bindValue(":id", $_SESSION['cLogin']);
            $sql->execute();
    
            if($sql->rowCount() > 0){
                $array = $sql->fetch();            
            }
            return $array;
        }

        
    }
?>