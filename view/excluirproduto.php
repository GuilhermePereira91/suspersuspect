<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/supersuspect/config.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/supersuspect/class/produtos.class.php';
    if (!isset($_SESSION['cLogin']) && empty($_SESSION['cLogin'])){
        header("Location: /supersuspect/view/login.php");
    }
    $produtos = new Produtos();
    $id = $_GET['id'];
    if($produtos->excluir($id)){
        header("Location: /supersuspect/view/produtos.php");
    }else{
        echo 'Erro!';
    }
?>