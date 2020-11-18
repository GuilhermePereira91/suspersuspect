<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/supersuspect/core/class.php';
class Produtos extends Model{

    public function cadastrar($nome, $categoria, $descricao,  $quantidade, $idsupermercado, $valor, $validade){
            
        $sql = $this->db->prepare("SELECT id FROM produtos WHERE nome = :nome AND idsupermercado = :idsupermercado");
        $sql->bindValue(":nome", $nome);
        $sql->bindValue(":idsupermercado", $idsupermercado);
        $sql->execute();

        if($sql->rowCount() == 0){
            $sql = $this->db->prepare("INSERT INTO produtos (nome, idcategoria, descricao, quantidade, idsupermercado, valor, validade) VALUES (:nome, :categoria, :descricao, :quantidade, :idsupermercado, :valor, :validade)");
            $sql->bindValue(":nome", $nome);
            $sql->bindValue(":categoria", $categoria);
            $sql->bindValue(":descricao", $descricao);
            $sql->bindValue(":quantidade", $quantidade);
            $sql->bindValue(":idsupermercado", $idsupermercado);  
            $sql->bindValue(":valor", $valor);  
            $sql->bindValue(":validade", $validade);                
            $sql->execute();
            return true;

        }else{
            return false;
            
        }
    }

    public function alterar($id, $nome, $categoria, $descricao,  $quantidade, $idsupermercado, $valor, $validade){
            
        try {
            $sql = $this->db->prepare("UPDATE produtos SET nome = :nome, idcategoria = :categoria, descricao = :descricao, quantidade = :quantidade, idsupermercado = :idsupermercado, valor = :valor, validade = :validade WHERE id = :id");
            $sql->bindValue(":nome", utf8_encode($nome));
            $sql->bindValue(":categoria", $categoria);
            $sql->bindValue(":descricao", utf8_encode($descricao));
            $sql->bindValue(":quantidade", $quantidade);
            $sql->bindValue(":idsupermercado", $idsupermercado);  
            $sql->bindValue(":valor", $valor);  
            $sql->bindValue(":validade", $validade);                
            $sql->bindValue(":id", $id);
            $sql->execute();
            print_r($sql);
            return true;
        }catch(PDOException $e) {
            echo $sql . "<br>" . $e->getMessage();
        }

    }

    public function excluir($id){
        
        $sql = $this->db->prepare("DELETE FROM produtos WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();
        return true;
    }

    public function getProduto($id){
        
        $array = array();
        $sql = $this->db->prepare("SELECT produtos.id as 'id', produtos.nome as 'Nome', descricao as 'Descrição', Categoria.nome as 'Categoria', supermercados.razaosocial as 'SuperMercado', quantidade as 'Quantidade', valor as 'Valor', DATE_FORMAT(validade, '%Y-%m-%d') as 'Validade' FROM produtos INNER JOIN produtoscategorias AS Categoria ON Categoria.id = produtos.idcategoria INNER JOIN supermercados ON supermercados.id = produtos.idsupermercado WHERE produtos.id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        if($sql->rowCount() > 0){
           $array = $sql->fetch();            
        }

        return $array;
    }
    public function getProdutos(){
        
        $array = array();
        $sql = $this->db->prepare("SELECT produtos.id, produtos.nome as Nome, descricao as 'Descrição', Categoria.nome as 'Categoria', supermercados.razaosocial as 'SuperMercado', quantidade as 'Quantidade', valor as 'Valor', DATE_FORMAT(validade, '%Y-%m-%d') as 'Validade' FROM produtos INNER JOIN produtoscategorias AS Categoria ON Categoria.id = produtos.idcategoria INNER JOIN supermercados ON supermercados.id = produtos.idsupermercado ORDER BY Nome ASC");
        $sql->execute();

        if($sql->rowCount() > 0){
            $array = $sql->fetchAll(PDO::FETCH_ASSOC);            
        }
        return $array;
    }

    public function existeProduto($nome, $idsupermercado){
        
        $array = array();
        $sql = $this->db->prepare("SELECT * FROM produtos WHERE nome = :nome AND idsupermercado = :idsupermercado");
        $sql->bindValue(":idsupermercado", $idsupermercado);
        $sql->bindValue(":nome", $nome);
        $sql->execute();

        if($sql->rowCount() > 0){
            return true;  
        }         
        else{
            return false;
        }
    }

    public function getCategorias(){
        
        $array = array();
        $sql = $this->db->prepare("SELECT * FROM produtoscategorias");
        $sql->execute();

        if($sql->rowCount() > 0){
            $array = $sql->fetchAll(PDO::FETCH_ASSOC);           
        }
        return $array;
    }

    public function getUltimosprodutos(){
        
        $array = array();
        $sql = $this->db->prepare("SELECT produtos.nome as Nome, descricao as 'Descrição', Categoria.nome as 'Categoria', supermercados.razaosocial as 'SuperMercado', quantidade as 'Quantidade', valor as 'Valor', DATE_FORMAT(validade, '%Y-%m-%d') as 'Validade' FROM produtos INNER JOIN produtoscategorias AS Categoria ON Categoria.id = produtos.idcategoria INNER JOIN supermercados ON supermercados.id = produtos.idsupermercado ORDER BY produtos.datacadastro DESC LIMIT 10");
        $sql->execute();

        if($sql->rowCount() > 0){
            $array = $sql->fetchAll(PDO::FETCH_ASSOC);            
        }
        return $array;
    }
}

?>