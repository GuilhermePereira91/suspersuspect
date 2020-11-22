<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/supersuspect/config.php';
    if (!isset($_SESSION['cLogin']) && empty($_SESSION['cLogin'])){
        header("Location: /supersuspect/view/login.php");
    }
    require_once $_SERVER['DOCUMENT_ROOT'].'/supersuspect/class/pedidos.class.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/supersuspect/class/carrinho.class.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/supersuspect/class/envios.class.php';
    
    $pedidos = new Pedidos();
    $carrinho = new Carrinho();
    $envio = new Envios();

    $carrprod = array();
    $valores = array();

    $idproduto = array_map('intval',$_POST['idproduto']);
    $quantidade = array_map('intval',$_POST['quantidade']);
    $valor = array_map('floatval',str_replace('R$','',$_POST['valor']));
    $formpagamento = $_POST['formpagamento'];
    $formenvio = $_POST['formenvio'];
    $tam = count($idproduto)-1;
    
    for ($j = 0; $j <= $tam; $j++){
        $valores[] = $valor[$j] * $quantidade[$j];
    }
    
    for ($i = 0; $i <= $tam; $i++){
        
        $carrprod[$i] = array('id'=>$idproduto[$i],'quantidade'=>$quantidade[$i], 'valor'=>$valor[$i]);
    }
    
    $valortotal = strval(str_replace(',','.',array_sum($valores)));
    
    if($pedidos->cadastrar($_SESSION['cLogin'], $formpagamento, $valortotal)){
        foreach($carrprod as $prod){
            $pedidos->cadastrarDetalhes($prod['id'], $prod['quantidade']);
        }
        $carrinho->excluir();
        $envio->cadastrar($formenvio);
        header("Location: /supersuspect/view/pedidos.php");
    }else{
        echo 'Falha ao cadastra pedido';
    }  
    

    
?>