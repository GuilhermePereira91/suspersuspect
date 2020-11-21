<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/supersuspect/config.php';
    if (!isset($_SESSION['cLogin']) && empty($_SESSION['cLogin'])){
        header("Location: /supersuspect/view/login.php");
    }
    require_once $_SERVER['DOCUMENT_ROOT'].'/supersuspect/class/carrinho.class.php';
    $carrinho = new Carrinho();
    $listac = $carrinho->getCarrinho($_SESSION['cLogin']);

?>
<!DOCTYPE HTML>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="assets/css/style.css">
        <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css" />
        <script type="text/javascript" src="assets/js/bootstrap.min.js" ></script>
        <title>Carrinho</title>
    </head>
    <body>
        <?php require_once $_SERVER['DOCUMENT_ROOT'].'/supersuspect/view/template.php'; ?>
        <h1><strong>Carrinho:</strong></h1>
        <form method="POST" action="cadastropedidos.php">
            <table style="width:100%">
                <tr>
                    <th>Produto</th>
                    <th>Quantidade</th>
                    <th>Valor</th>
                    <th>Ação</th>
                </tr>
                <?php foreach($listac as $produto): ?>
                    <tr>
                        <td><input type="hidden" name="idproduto[]" value="<?php echo utf8_encode($produto['idproduto']);?>"><input type="text" name="nome" value="<?php echo utf8_encode($produto['Produto']);?>" readonly></td>
                        <td><input type="number" name="quantidade[]" value="<?php echo $produto['Quantidade'];?>"></td>
                        <td><input type="text" name="valor[]" value="<?php echo "R$".$produto['Valor'];?>" readonly></td>
                        <td>
                            <a href="excluircarrinho.php?id=<?php echo $produto['id'];?>">[Excluir]</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </table>
            <hr/>
            <input type="submit" value="Gerar Pedido">       
        </form>
        
    </body>
</html>