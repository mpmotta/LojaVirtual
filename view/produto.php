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
    <title>Detalhes do Produto</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body id="page-detalhe">

  <header class="banner" id="main-header">
    <div class="header-content" id="header-content">
        <form action="index.php" method="GET" class="search-form" id="form-busca-detalhe">
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
      
      if (!isset($_GET['id'])) { header("Location: index.php"); exit(); }

      $id = $_GET['id'];
      $controller = new ProdutoController();
      $produto = $controller->buscarPorId($id);

      if (!$produto) {
          echo "<div class='container' id='msg-erro'><p style='text-align:center'>Produto não encontrado.</p><a href='index.php' id='link-voltar-erro'>Voltar</a></div>";
          exit();
      }

      $nome = $produto['nome'];
      $categoria = $produto['categoria'];
      $descricao = isset($produto['descricao']) ? $produto['descricao'] : "Descrição indisponível.";
      $imagem = !empty($produto['imagem']) ? $produto['imagem'] : 'no-image.jpg';
      $valor = number_format($produto['valor'], 2, ',', '.');
  ?>

  <nav class="category-menu" id="nav-breadcrumbs">
    <ul id="lista-breadcrumbs">
      <li><a href="index.php" id="link-voltar-loja">❮ VOLTAR PARA A LOJA</a></li>
      <li><a href="categoria.php?categoria=Celulares" id="link-cat-celulares">CELULARES</a></li>
      <li><a href="categoria.php?categoria=Eletrônicos" id="link-cat-eletronicos">ELETRÔNICOS</a></li>
    </ul>
  </nav>

  <div class="container detail-page-container" id="container-detalhe-produto">
      <div class="detail-image-box" id="box-imagem">
          <img src="img/<?php echo $imagem; ?>" alt="<?php echo $nome; ?>" id="img-detalhe-principal">
      </div>
      
      <div class="detail-info-box" id="box-info">
          <span class="product-category" id="detalhe-categoria"><?php echo $categoria; ?></span>
          <h1 class="detail-title" id="detalhe-nome"><?php echo $nome; ?></h1>
          
          <div class="product-rating" id="detalhe-rating" style="font-size: 20px;">
             <span>★</span><span>★</span><span>★</span><span>★</span><span>☆</span>
             <span style="font-size: 12px; color: #777;" id="detalhe-cod">(Cód: <?php echo $id; ?>)</span>
          </div>
          
          <div class="detail-price" id="detalhe-preco">R$ <?php echo $valor; ?></div>
          
          <hr style="border:0; border-top:1px solid #eee; margin:20px 0;">
          
          <p class="detail-description" id="detalhe-descricao"><?php echo nl2br($descricao); ?></p>
          
          <a href="carrinho.php?acao=add&id=<?php echo $id; ?>" class="btn-buy" id="btn-adicionar-carrinho">
              COLOCAR NO CARRINHO
          </a>
      </div>
  </div>

</body>
</html>