<?php
require_once $_SERVER['DOCUMENT_ROOT'].'/supersuspect/core/class.php';
class Produtos extends Model{
    private $nome;
    private $categoria;
    private $descricao;
    private $quantidade;
    private $supermercado;
    private $valor;
    private $validade;

    public function getNome(){
        return $this->nome;
    }

    public function setNome($nome){
        $this->nome = $nome;
    }

    public function getCategoria(){
        return $this->categoria;
    }

    public function setCategoria($categoria){
        $this->categoria = $categoria;
    }

    public function getDescricao(){
        return $this->descricao;
    }

    public function setDescricao($descricao){
        $this->descricao = $descricao;
    }

    public function getQuantidade(){
        return $this->quantidade;
    }

    public function setQuantidade($quantidade){
        $this->quantidade = $quantidade;
    }

    public function getSupermercado(){
        return $this->supermercado;
    }

    public function setSupermercado($supermercado){
        $this->supermercado = $supermercado;
    }

    public function getValor(){
        return $this->valor;
    }

    public function setValor($valor){
        $this->valor = $valor;
    }

    public function getValidade(){
        return $this->validade;
    }

    public function setValidade($validade){
        $this->validade = $validade;
    }

    public function cadastrar($nome, $categoria, $descricao,  $quantidade, $idsupermercado, $valor, $validade){
            
        $sql = $this->db->prepare("SELECT id FROM produtos WHERE nome = :nome AND idsupermercado = :idsupermercado");
        $sql->bindValue(":nome", $nome);
        $sql->bindValue(":idsupermercado", $idsupermercado);
        $sql->execute();

        if($sql->rowCount() == 0){
            $sql = $this->db->prepare("INSERT INTO produtos (nome, categoria, descricao, quantidade, idsupermercado, valor, validade) VALUES (:nome, :categoria, :descricao, :quantidade, :idsupermercado, :valor, :validade)");
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
            
        $sql = $this->db->prepare("UPDATE supermercados SET (nome, categoria, descricao, quantidade, idsupermercado, valor, validade) VALUES (:nome, :categoria, :descricao, :quantidade, :idsupermercado, :valor, :validade) WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->bindValue(":nome", $nome);
        $sql->bindValue(":categoria", $categoria);
        $sql->bindValue(":descricao", $descricao);
        $sql->bindValue(":quantidade", $quantidade);
        $sql->bindValue(":idsupermercado", $idsupermercado);  
        $sql->bindValue(":valor", $valor);  
        $sql->bindValue(":validade", $validade);                
        $sql->execute();
        return true;
    }

    public function excluir($id){
        
        $sql = $this->db->prepare("DELETE FROM produtos WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();
    }

    public function getProduto($id){
        
        $array = array();
        $sql = $this->db->prepare("SELECT * FROM produtos WHERE id = :id");
        $sql->bindValue(":id", $id);
        $sql->execute();

        if($sql->rowCount() > 0){
            $array = $sql->fetch();            
        }
        return $array;
    }
    public function getProdutos(){
        
        $array = array();
        $sql = $this->db->prepare("SELECT * FROM produtos");
        $sql->execute();

        if($sql->rowCount() > 0){
            $array = $sql->fetch();            
        }
        return $array;
    }

    public function getCategorias(){
        
        $array = array();
        $sql = $this->db->prepare("SELECT * FROM produtoscategorias");
        $sql->execute();

        if($sql->rowCount() > 0){
            $array = $sql->fetch();            
        }
        return $array;
    }
}

?>