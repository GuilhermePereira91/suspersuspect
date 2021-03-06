<?php
    require_once $_SERVER['DOCUMENT_ROOT'].'/supersuspect/config.php';
    if (!isset($_SESSION['cLogin']) && empty($_SESSION['cLogin'])){
        header("Location: /supersuspect/view/login.php");
    }
    require_once $_SERVER['DOCUMENT_ROOT'].'/supersuspect/class/produtos.class.php';
    require_once $_SERVER['DOCUMENT_ROOT'].'/supersuspect/class/supermercados.class.php';
    
    $produto = new Produtos();
    $supermercado = new Supermercados();
    
    $listasm = $supermercado->getSupermercados();
    $listact = $produto->getCategorias();
    
    if(isset($_POST['nome']) && isset($_POST['supermercado'])){
        $nome = utf8_encode($_POST['nome']);
        $supermercado = $_POST['supermercado'];
        $categoria = $_POST['categoria'];
        $quantidade = $_POST['quantidade'];        
        $descricao = utf8_encode($_POST['descricao']);
        $valor = $_POST['valor'];
        $validade = $_POST['validade'];
        if($produto->existeProduto($nome,$supermercado)){
            echo "Produto ja cadastrado!";
        }else{
            if($produto->cadastrar($nome, $categoria, $descricao, $quantidade, $supermercado, $valor, $validade)){
                echo "Produto Cadastrado com sucesso!<br/>";
            }else{
                echo "Erro ao cadastrar!<br/>";
            }
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
        <form method="POST" action="cadastroProduto.php">
            <label for="nome">Nome:</label><br/>
            <input type="text" name="nome" /><br/>
            <label for="supermercado">Super Mercado:</label><br/>
            <select name="supermercado">
                <?php foreach($listasm as $sm): ?>
                    <option value="<?php echo $sm['id']; ?>"><?php echo utf8_encode($sm['razaosocial']);?></option>
                <?php endforeach; ?>            
            </select><br/>
            <label for="categoria">Categoria:</label><br/>
            <select name="categoria">
                <?php foreach($listact as $ct): ?>
                    <option value="<?php echo $ct['id']; ?>"><?php echo utf8_encode($ct['nome']);?></option>
                <?php endforeach; ?>            
            </select><br/>
            <label for="quantidade">Quantidade:</label><br/>
            <input type="number" name="quantidade"/><br/>
            <label for="descricao">Descricao:</label><br/>
            <input type="text" name="descricao"/><br/>
            <label for="valor">Valor:</label><br/>
            <input type="number" step="0.01" name="valor"/><br/>
            <label for="validade">Validade:</label><br/>
            <input type="date" name="validade"/><br/>
            <input type="submit" value="Cadastrar">
        </form>
    </body>
</html>