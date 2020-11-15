<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/supersuspect/core/class.php';
    class Supermercados extends Model{
        private $cnpj;
        private $razaosocial;
        private $endereco;
        private $telefone;

        public function getCnpj(){
            return $this->cnpj;
        }

        public function setCnpj($cnpj){
            $this->cnpj = $cnpj;
        }

        public function getRazaosocial(){
            return $this->razaosocial;
        }

        public function setRazaosocial($razaosocial){
            $this->razaosocial = $razaosocial;
        }

        public function getEndereco(){
            return $this->endereco;
        }

        public function setEndereco($endereco){
            $this->endereco = $endereco;
        }

        public function getTelefone(){
            return $this->telefone;
        }

        public function setTelefone($telefone){
            $this->telefone = $telefone;
        }

        public function cadastrar($razaosocial, $cnpj, $telefone,  $endereco){
            
            $sql = $this->db->prepare("SELECT id FROM supermercados WHERE cnpj = :cnpj");
            $sql->bindValue(":cnpj", $cnpj);
            $sql->execute();

            if($sql->rowCount() == 0){
                $sql = $this->db->prepare("INSERT INTO supermercados (cnpj, razaosocial, endereco, telefone) VALUES (:cnpj, :razaosocial, :endereco, :telefone)");
                $sql->bindValue(":cnpj", $cnpj);
                $sql->bindValue(":razaosocial", $razaosocial);
                $sql->bindValue(":endereco", $endereco);
                $sql->bindValue(":telefone", $telefone);              
                $sql->execute();
                return true;

            }else{
                return false;
            }
        }

        public function getSupermercado($id){
            $array = array();
            $sql = $this->db->prepare("SELECT * FROM supermercados WHERE id = :id");
            $sql->bindValue(":id", $id);
            $sql->execute();
    
            if($sql->rowCount() > 0){
                $array = $sql->fetch();            
            }
            return $array;
        }

        public function getSupermercados(){
        
            $array = array();
            $sql = $this->db->prepare("SELECT id, razaosocial FROM supermercados");
            $sql->execute();
    
            if($sql->rowCount() > 0){
                $array = $sql->fetchAll(PDO::FETCH_ASSOC);            
            }
            return $array;
        }
    }
?>