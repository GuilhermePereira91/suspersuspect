<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/supersuspect/config.php';
    if (!isset($_SESSION['cLogin']) && empty($_SESSION['cLogin'])){
        header("Location: /supersuspect/view/login.php");
    }
    require_once $_SERVER['DOCUMENT_ROOT'].'/supersuspect/class/carrinho.class.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/supersuspect/class/envios.class.php';
    $carrinho = new Carrinho();
    $envio = new Envios();
    $listaen = $envio->getformEnvio();
    $listac = $carrinho->getCarrinho($_SESSION['cLogin']);
    $listafp = $carrinho->getformpagamento();

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
            <hr/><br>
            Forma de pagamento:
            <select name="formpagamento">
                <?php foreach($listafp as $fp): ?>
                    <option value="<?php echo $fp['id']; ?>"><?php echo utf8_encode($fp['descricao']); ?></option>
                <?php endforeach; ?>
            </select><br>
            Forma de envio:
            <select name="formenvio">
                <?php foreach($listaen as $en): ?>
                    <option value="<?php echo $en['id']; ?>"><?php echo utf8_encode($en['descricao']); ?></option>
                <?php endforeach; ?>
            </select><br><br>
            <input type="submit" value="Gerar Pedido">       
        </form>
        
    </body>
</html>