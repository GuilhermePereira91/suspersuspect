<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/supersuspect/core/class.php';
    class Carrinho extends Model{
        
        public function cadastrar($idproduto, $qtdcompra, $idusuario){
            
            $sql = $this->db->prepare("SELECT * FROM carrinho WHERE idusuario = :idusuario AND idproduto=:idproduto");
            $sql->bindValue(":idproduto", $idproduto);
            $sql->bindValue(":idusuario", $idusuario);
            $sql->execute();
            
            if($sql->rowCount() == 0){
                $sql = $this->db->prepare("INSERT INTO carrinho (idproduto, qtdcompra, idusuario) VALUES (:idproduto, :qtdcompra, :idusuario)");
                $sql->bindValue(":idproduto", $idproduto);
                $sql->bindValue(":qtdcompra", $qtdcompra);
                $sql->bindValue(":idusuario", $idusuario);
                if($sql->execute()){
                    return true;
                }else{
                    return false;
                }
            }else{
                return false;
            }

                              
            
        }

        public function getCarrinho($idusuario){
        
            $array = array();
            $sql = $this->db->prepare("SELECT carrinho.id, carrinho.idproduto, produtos.nome AS 'Produto', carrinho.qtdcompra AS 'Quantidade', produtos.valor AS 'Valor' FROM carrinho INNER JOIN produtos ON produtos.id = carrinho.idproduto WHERE idusuario = :idusuario");
            $sql->bindValue(":idusuario", $idusuario); 
            $sql->execute();
    
            if($sql->rowCount() > 0){
                $array = $sql->fetchAll(PDO::FETCH_ASSOC);            
            }
            return $array;
        }
        
        public function excluir(){
        
            $sql = $this->db->prepare("DELETE FROM carrinho WHERE idusuario = :idusuario");
            $sql->bindValue(":idusuario", $_SESSION['cLogin']);
            $sql->execute();
        }

        public function excluirProduto($id){
        
            $sql = $this->db->prepare("DELETE FROM carrinho WHERE id = :id");
            $sql->bindValue(":id", $id);
            if($sql->execute()){
                return true;
            }else{
                return false;
            }

        }

        public function alterar($idusuario,$idproduto, $qtdcompra){
            
            $sql = $this->db->prepare("UPDATE carrinho SET qtdcompra = :qtdcompra WHERE idproduto = :idproduto AND idusuario = :idusuario");
            $sql->bindValue(":idproduto", $idproduto);
            $sql->bindValue(":idusuario", $idusuario);
            $sql->bindValue(":qtdcompra", $qtdcompra);             
            if($sql->execute()){
                return true;
            }else{
                return false;
            }
        }

        public function getformpagamento(){
            $array = array();
            $sql = $this->db->prepare("SELECT * FROM formapagamento");
            $sql->execute();

            if($sql->rowCount() > 0){
                $array = $sql->fetchAll(PDO::FETCH_ASSOC);            
            }
            return $array;
        }

    }
?>