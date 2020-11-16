<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/supersuspect/core/class.php';
    class Carrinho extends Model{
        
        public function cadastrar($idproduto, $qtdcompra, $idusuario){
            $sql = $this->db->prepare("INSERT INTO pedidos (idproduto, qtdcompra, idusuario) VALUES (:idproduto, :qtdcompra, :idusuario)");
            $sql->bindValue(":idproduto", $idproduto);
            $sql->bindValue(":qtdcompra", $qtdcompra);
            $sql->bindValue(":idusuario", $idusuario);                  
            if($sql->execute()){
                return true;
            }else{
                return false;
            }
        }

        public function getCarrinho($idusuario){
        
            $array = array();
            $sql = $this->db->prepare("SELECT * FROM carrinho WHERE idusuario = :idusuario");
            $sql->bindValue(":idusuario", $idusuario); 
            $sql->execute();
    
            if($sql->rowCount() > 0){
                $array = $sql->fetch();            
            }
            return $array;
        }
        
        public function excluir($id){
        
            $sql = $this->db->prepare("DELETE FROM carrinho WHERE id = :id");
            $sql->bindValue(":id", $id);
            if($sql->execute()){
                return true;
            }else{
                return false;
            }
        }

        public function alterar($id, $qtdcompra){
            
            $sql = $this->db->prepare("UPDATE carrinho SET (qtdcompra) VALUES (:qtdcompra) WHERE id = :id");
            $sql->bindValue(":id", $id);
            $sql->bindValue(":qtdcompra", $qtdcompra);             
            if($sql->execute()){
                return true;
            }else{
                return false;
            }
        }

    }
?>