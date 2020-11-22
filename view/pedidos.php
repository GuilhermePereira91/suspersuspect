<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/supersuspect/config.php';
    if (!isset($_SESSION['cLogin']) && empty($_SESSION['cLogin'])){
        header("Location: /supersuspect/view/login.php");
    }
    require_once $_SERVER['DOCUMENT_ROOT'].'/supersuspect/class/pedidos.class.php';
    $pedidos = new Pedidos();
    $meuspedidos = $pedidos->getPedidos();

?>
<!DOCTYPE HTML>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="assets/css/style.css">
        <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css" />
        <script type="text/javascript" src="assets/js/bootstrap.min.js" ></script>
        <title>Pedidos</title>
    </head>
    <body>
        <?php require_once $_SERVER['DOCUMENT_ROOT'].'/supersuspect/view/template.php'; ?>
        <h1><strong>Meus Pedidos:</strong></h1>
        <table style="width:100%">
            <tr>
                <th>Numero do pedido</th>
                <th>Status</th>
                <th>Valor Total</th>
                <th>Forma de pagamento</th>
                <th>Data do pedido</th>
                <th>Ação</th>
            </tr>
            <?php foreach($meuspedidos as $pedido): ?>
                <tr>
                    <td><?php echo $pedido['id'];?></td>
                    <td><?php echo utf8_encode($pedido['pdstatus']);?></td>
                    <td><?php echo "R$".$pedido['valortotal'];?></td>
                    <td><?php echo utf8_encode($pedido['formpagamento']);?></td>
                    <td><?php echo $pedido['datapedido'];?></td>
                    <td>
                        <a href="pedidosdetalhes.php?id=<?php echo $pedido['id'];?>">[Ver Detalhes]</a>
                    </td>
                </tr>
            <?php endforeach; ?>
        </table>
    </body>
</html>