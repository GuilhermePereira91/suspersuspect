<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/supersuspect/config.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/supersuspect/class/produtos.class.php';
    if (!isset($_SESSION['cLogin']) && empty($_SESSION['cLogin'])){
        header("Location: /supersuspect/view/login.php");
    }
    $produto = new Produtos();
    $ultimosprodutos = $produto->getUltimosprodutos();

    
?>
<!DOCTYPE HTML>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="assets/css/style.css">
        <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css" />
        <script type="text/javascript" src="assets/js/bootstrap.min.js" ></script>
        <title>Home</title>
    </head>
    <body>
        
    <?php require_once $_SERVER['DOCUMENT_ROOT'].'/supersuspect/view/template.php'; ?>
        <h1><strong>Ultimos produtos:</strong></h1>
        <table style="width:100%">
            <tr>
                <th>Nome</th>
                <th>Decrição</th>
                <th>Categoria</th>
                <th>Supermercado</th>
                <th>Estoque</th>
                <th>Valor</th>
                <th>Validade</th>
            </tr>
            <?php foreach($ultimosprodutos as $produto): ?>
                <tr>
                    <td><?php echo utf8_encode($produto['Nome']);?></td>
                    <td><?php echo utf8_encode($produto['Descrição']);?></td>
                    <td><?php echo utf8_encode($produto['Categoria']);?></td>
                    <td><?php echo utf8_encode($produto['SuperMercado']);?></td>
                    <td><?php echo $produto['Quantidade'];?></td>
                    <td><?php echo "R$".$produto['Valor'];?></td>
                    <td><?php echo $produto['Validade'];?></td>
                </tr>
            <?php endforeach; ?>
        </table>
    </body>
</html>