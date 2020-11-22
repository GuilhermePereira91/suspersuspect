<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/supersuspect/config.php';
    if (!isset($_SESSION['cLogin']) && empty($_SESSION['cLogin'])){
        header("Location: /supersuspect/view/login.php");
    }
    require_once $_SERVER['DOCUMENT_ROOT'].'/supersuspect/class/pedidos.class.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/supersuspect/class/envios.class.php';
    $pedidos = new Pedidos();
    $envio = new Envios();
    $idpedido = $_GET['id'];
    $listadt = $pedidos->getDetalhes($idpedido);
    $dadosenvio = $envio->getEnvio($idpedido);

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
        <h1><strong><a href="pedidos.php">[<=]</a>Detalhes</strong></h1>
        <h2><strong>Produtos:</strong></h2>
        <table style="width:100%">
            <tr>
                <th>Nome</th>
                <th>Quantidade</th>
                <th>Valor</th>
            </tr>
            <?php foreach($listadt as $dt): ?>
                <tr>
                    <td><?php echo utf8_encode($dt['nome']); ?></td>
                    <td><?php echo $dt['quantidade']; ?></td>
                    <td><?php echo 'R$'.$dt['valor']; ?></td>
                </tr>
            <?php endforeach; ?>
        </table>
        <h2><strong>Rastreio:</strong></h2>
        <ul>
            <li>Codigo Rastreio: <strong><?php echo $dadosenvio['Codigo Rastreio']; ?></strong></li>
            <li>Forma de envio: <strong><?php echo utf8_encode($dadosenvio['Forma de envio']); ?></strong></li>
            <li>Para: <strong><?php echo utf8_encode($dadosenvio['Nome']); ?></strong></li>
            <li>Endereço: <strong><?php echo utf8_encode($dadosenvio['Endereco']); ?></strong></li>
            <li>Custo: <strong><?php echo 'R$'.$dadosenvio['Custo']; ?></strong></li>
            <li>Data entrega: <strong><?php echo (isset($dadosenvio['Data Entrega']))? $dadosenvio['Data Entrega'] : 'Não confirmado' ; ?></strong></li>
            <li>Status: <strong><?php echo utf8_encode($dadosenvio['Status']); ?></strong></li>           
        </ul>
        <?php echo ($dadosenvio['idenviostatus'] == 1)? '<a href="confirmarenvios.php?iden='.$dadosenvio['Codigo Rastreio'].'&idpd='.$idpedido.'">[Confirmar]</a>' : ''; ?>
        <?php echo ($dadosenvio['idenviostatus'] != 4 and $dadosenvio['idenviostatus'] != 3)? '<a href="cancelarenvio.php?iden='.$dadosenvio['Codigo Rastreio'].'&idpd='.$idpedido.'">[Cancelar]</a>' : ''; ?>
        <?php echo ($dadosenvio['idenviostatus'] == 2)? '<a href="receberenvio.php?iden='.$dadosenvio['Codigo Rastreio'].'&idpd='.$idpedido.'">[Recebido]</a>' : ''; ?>
    </body>
</html>