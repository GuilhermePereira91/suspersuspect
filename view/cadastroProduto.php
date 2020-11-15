<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/supersuspect/config.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/supersuspect/class/produtos.class.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/supersuspect/class/supermercados.class.php';
    $produto = new Produtos();
    $supermercado = new Supermercados();
    $listasm = $supermercado->getSupermercados();


?>
<!DOCTYPE HTML>
<html lang="pt-br">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" type="text/css" href="assets/css/style.css">
        <link rel="stylesheet" type="text/css" href="assets/css/bootstrap.min.css" />
        <script type="text/javascript" src="assets/js/bootstrap.min.js" ></script>
        <title>Cadastrar Produtos</title>
    </head>
    <body>
        <h1><strong>Cadastro de Produto</strong></h1>
        <form method="POST" action="cadastroProduto.php">
            <label for="nome">Nome:</label><br/>
            <input type="text" name="nome" /><br/>
            <label for="supermercado">Super Mercado:</label><br/>
            <select name="supermercado">
                <?php foreach($listasm as $sm): ?>
                    <option value="<?php echo $sm['id']; ?>"><?php echo $sm['razaosocial'];?></option>
                <?php endforeach; ?>            
            </select><br/>
            <label for="quantidade">Quantidade:</label><br/>
            <input type="number" name="quantidade"/><br/>
            <label for="descricao">Descricao:</label><br/>
            <input type="text" name="descricao"/><br/>
            <label for="valor">Valor:</label><br/>
            <input type="number" name="valor"/><br/>
            <label for="validade">Validade:</label><br/>
            <input type="date" name="validade"/><br/>
            <input type="submit" value="Cadastrar">
        </form>
    </body>
</html>