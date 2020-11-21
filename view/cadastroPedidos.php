<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/supersuspect/config.php';
    if (!isset($_SESSION['cLogin']) && empty($_SESSION['cLogin'])){
        header("Location: /supersuspect/view/login.php");
    }
    require_once $_SERVER['DOCUMENT_ROOT'].'/supersuspect/class/pedidos.class.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/supersuspect/class/carrinho.class.php';
    
    $pedidos = new Pedidos();
    $carrinho = new Carrinho();

    $carrprod = array();
    $valores = array();

    $idproduto = array_map('intval',$_POST['idproduto']);
    $quantidade = array_map('intval',$_POST['quantidade']);
    $valor = array_map('floatval',str_replace('R$','',$_POST['valor']));
        
    $tam = count($idproduto)-1;
    
    for ($j = 0; $j <= $tam; $j++){
        $valores[] = $valor[$j] * $quantidade[$j];
    }
    
    for ($i = 0; $i <= $tam; $i++){
        
        $carrprod[$i] = array('id'=>$idproduto[$i],'quantidade'=>$quantidade[$i], 'valor'=>$valor[$i]);
    }
    
    $valortotal = strval(str_replace(',','.',array_sum($valores)));
    
    if($pedidos->cadastrar($_SESSION['cLogin'], $valortotal)){
        foreach($carrprod as $prod){
            $pedidos->cadastrarDetalhes($prod['id'], $prod['quantidade']);
        }
        $carrinho->excluir();
        header("Location: /supersuspect/view/pedidos.php");
    }else{
        echo 'Falha ao cadastra pedido';
    }  
    

    
?>