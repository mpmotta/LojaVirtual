<?php
// Inicia sessão
if (session_status() === PHP_SESSION_NONE) { session_start(); }
// Conta itens
$qtdCarrinho = 0;
if (isset($_SESSION['carrinho'])) {
    $qtdCarrinho = array_sum($_SESSION['carrinho']);
}
?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Categoria - Loja Virtual</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body id="page-categoria">

  <header class="banner" id="main-header">
    <div class="header-content" id="header-content">
        <form action="index.php" method="GET" class="search-form" id="form-busca-categoria">
            <input type="text" name="busca" id="input-busca" placeholder="Buscar..." required>
            <button type="submit" id="btn-submit-busca">
                <svg width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round"><circle cx="11" cy="11" r="8"></circle><line x1="21" y1="21" x2="16.65" y2="16.65"></line></svg>
            </button>
        </form>
        
        <a href="carrinho.php" class="cart-link" id="link-carrinho" title="Ir para o Carrinho">
            🛒
            <?php if($qtdCarrinho > 0): ?>
                <span class="cart-count" id="badge-carrinho-qtd"><?php echo $qtdCarrinho; ?></span>
            <?php endif; ?>
        </a>
    </div>
  </header> 

  <?php
      require_once('../controller/produtoController.php');
      $controller = new ProdutoController();

      if (isset($_GET['categoria'])) {
          $catNome = $_GET['categoria'];
          $consulta = $controller->consultaPorCategoria($catNome);
          $titulo = "Categoria: " . htmlspecialchars($catNome);
      } else {
          header("Location: index.php");
          exit();
      }
  ?>

  <h1 id="titulo-categoria"><?php echo $titulo; ?></h1>

  <nav class="category-menu" id="nav-categorias">
    <ul id="lista-categorias">
      <li><a href="index.php" id="link-voltar">❮ VOLTAR</a></li>
      <li><a href="categoria.php?categoria=Celulares" id="link-cat-celulares">CELULARES</a></li>
      <li><a href="categoria.php?categoria=Eletrônicos" id="link-cat-eletronicos">ELETRÔNICOS</a></li>
      <li><a href="categoria.php?categoria=Informática" id="link-cat-informatica">INFORMÁTICA</a></li>
      <li><a href="categoria.php?categoria=Perfumes" id="link-cat-perfumes">PERFUMES</a></li>
      <li><a href="categoria.php?categoria=Eletrodomésticos" id="link-cat-eletro">ELETRODOMÉSTICOS</a></li>
    </ul>
  </nav>

  <div class="container" id="grid-produtos-categoria">
    <?php
        if (!is_array($consulta) || count($consulta) == 0) {
            echo "<p id='msg-sem-produtos' style='grid-column: 1/-1; text-align: center;'>Nenhum produto nesta categoria.</p>";
        } else {
            foreach($consulta as $linha){
                $id = $linha['id'];
                $nome = $linha['nome'];
                $categoria = $linha['categoria'];
                $imagem = !empty($linha['imagem']) ? $linha['imagem'] : 'no-image.jpg';
                $valor = number_format($linha['valor'], 2, ',', '.');
                
                $badgeNew = '';
                if (isset($linha['data_criado'])) {
                    $d1 = new DateTime($linha['data_criado']);
                    $d2 = new DateTime();
                    if ($d2->diff($d1)->days <= 7) $badgeNew = "<span class='badge badge-new' id='badge-new-$id'>NEW</span>";
                }

                echo "
                <div class='product-card' id='produto-$id'>
                    <a href='produto.php?id=$id' class='product-link-wrapper' id='link-wrapper-$id'>
                        <div class='product-image-container' id='img-container-$id'>
                            <img src='img/$imagem' alt='$nome' class='product-image' id='img-produto-$id'>
                            <div class='product-badges'>$badgeNew</div>
                        </div>
                    </a>
                    <div class='product-info' id='info-produto-$id'>
                        <div>
                            <div class='product-category' id='cat-produto-$id'>$categoria</div>
                            <h3 class='product-name' title='$nome'>
                                <a href='produto.php?id=$id' id='nome-produto-$id'>$nome</a>
                            </h3>
                            <div class='product-price'>
                                <span class='current-price' id='preco-produto-$id'>R$ $valor</span>
                            </div>
                        </div>
                        <div class='product-actions' id='actions-produto-$id'>
                            <a href='produto.php?id=$id' class='action-icon' id='btn-ver-detalhes-$id'>👁 Ver Detalhes</a>
                        </div>
                    </div>
                </div>
                ";
            }
        }
    ?>
  </div>
</body>
</html>