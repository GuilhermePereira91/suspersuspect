<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/supersuspect/config.php';
    if (!isset($_SESSION['cLogin']) && empty($_SESSION['cLogin'])){
        header("Location: /supersuspect/view/login.php");
    }
    require_once $_SERVER['DOCUMENT_ROOT'].'/supersuspect/class/produtos.class.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/supersuspect/class/supermercados.class.php';
    
    $produto = new Produtos();
    $supermercado = new Supermercados();
    
    $id = $_GET['id'];

    $listasm = $supermercado->getSupermercados();
    $listact = $produto->getCategorias();
    $prod = $produto->getProduto($id);
    
    if(isset($_POST['nome']) && isset($_POST['supermercado'])){
        $nome = utf8_encode($_POST['nome']);
        $supermercado = $_POST['supermercado'];
        $categoria = $_POST['categoria'];
        $quantidade = $_POST['quantidade'];        
        $descricao = utf8_encode($_POST['descricao']);
        $valor = $_POST['valor'];
        $validade = $_POST['validade'];
        if($produto->alterar($id, $nome, $categoria, $descricao, $quantidade, $supermercado, $valor, $validade)){
            header("Location: alterarproduto.php?id=".$prod['id']);
            echo "Produto alterado com sucesso!<br/>";
        }else{
            echo "Erro ao Alterar!<br/>";
        }

        
            
    }
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
        <?php require_once $_SERVER['DOCUMENT_ROOT'].'/supersuspect/view/template.php'; ?>
        <h1><strong>Cadastro de Produto</strong></h1>
        <form method="POST" action="alterarproduto.php?id=<?php echo utf8_encode($prod['id']);?>">
            <label for="nome">Nome:</label><br/>
            <input type="text" name="nome" value="<?php echo utf8_encode($prod['Nome']); ?>" /><br/>
            <label for="supermercado">Super Mercado:</label><br/>
            <select name="supermercado">
                <?php foreach($listasm as $sm): ?>
                    <option value="<?php echo $sm['id']; ?>" <?php echo($sm['razaosocial']==$prod['SuperMercado']) ?  'selected' : ''; ?>><?php echo utf8_encode($sm['razaosocial']);?></option>
                <?php endforeach; ?>            
            </select><br/>
            <label for="categoria">Categoria:</label><br/>
            <select name="categoria">
                <?php foreach($listact as $ct): ?>
                    <option value="<?php echo $ct['id']; ?>" <?php echo ($ct['nome']==$prod['Categoria']) ? 'selected' : ''; ?>><?php echo utf8_encode($ct['nome']);?></option>
                <?php endforeach; ?>            
            </select><br/>
            <label for="quantidade">Quantidade:</label><br/>
            <input type="number" name="quantidade" value="<?php echo $prod['Quantidade']; ?>"/><br/>
            <label for="descricao">Descricao:</label><br/>
            <input type="text" name="descricao" value="<?php echo utf8_encode($prod['Descrição']); ?>"/><br/>
            <label for="valor">Valor:</label><br/>
            <input type="number" step="0.01" name="valor" value="<?php echo $prod['Valor']; ?>"/><br/>
            <label for="validade">Validade:</label><br/>
            <input type="date" name="validade" value="<?php echo $prod['Validade']; ?>"/><br/>
            <input type="submit" value="Alterar">
        </form>
    </body>
</html>