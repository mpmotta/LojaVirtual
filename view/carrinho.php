<?php
require_once('../controller/carrinhoController.php');

$carrinhoCtrl = new CarrinhoController();

if (isset($_GET['acao']) && isset($_GET['id'])) {
    $acao = $_GET['acao'];
    $id = $_GET['id'];
    if ($acao == 'add') { $carrinhoCtrl->adicionar($id); }
    elseif ($acao == 'remove') { $carrinhoCtrl->remover($id); }
    header("Location: carrinho.php");
    exit();
}

$dados = $carrinhoCtrl->listarItens();
$itens = $dados['itens'];
$total = $dados['total'];

// Contagem para o badge
$qtdCarrinho = 0;
if (isset($_SESSION['carrinho'])) {
    $qtdCarrinho = array_sum($_SESSION['carrinho']);
}
?>

<!DOCTYPE html>
<html lang="pt-BR">
<head>
    <meta charset="UTF-8">
    <title>Meu Carrinho</title>
    <link rel="stylesheet" href="css/style.css">
</head>
<body id="page-carrinho">

  <header class="banner" id="main-header">
    <div class="header-content" id="header-content">
        <form action="index.php" method="GET" class="search-form" id="form-busca-carrinho">
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

  <h1 id="titulo-carrinho">Carrinho de Compras</h1>

  <div class="container" id="container-carrinho">
      
      <?php if (count($itens) == 0): ?>
          <div id="msg-carrinho-vazio" style="grid-column: 1 / -1; text-align: center; padding: 50px; background: #fff; border-radius: 8px;">
              <h2 style="color: #555;">Seu carrinho está vazio :(</h2>
              <p>Navegue pela loja e adicione produtos.</p>
              <a href="index.php" class="btn-buy" id="btn-voltar-loja" style="display:inline-block; width:auto; margin-top:20px; background-color:#333;">
                  Voltar para a Loja
              </a>
          </div>
      <?php else: ?>

          <table class="cart-table" id="tabela-carrinho">
              <thead>
                  <tr>
                      <th>Produto</th>
                      <th style="text-align: center;">Qtd</th>
                      <th style="text-align: right;">Preço Unit.</th>
                      <th style="text-align: right;">Subtotal</th>
                      <th style="text-align: center;">Excluir</th>
                  </tr>
              </thead>
              <tbody>
                  <?php foreach ($itens as $item): ?>
                  <tr id="item-carrinho-<?php echo $item['id']; ?>">
                      <td>
                          <div style="display: flex; align-items: center; gap: 15px;">
                              <img src="img/<?php echo !empty($item['imagem']) ? $item['imagem'] : 'no-image.jpg'; ?>" id="img-carrinho-<?php echo $item['id']; ?>" style="width: 50px; height: 50px; object-fit: contain;">
                              <span style="font-weight: bold; color: #333;" id="nome-carrinho-<?php echo $item['id']; ?>"><?php echo $item['nome']; ?></span>
                          </div>
                      </td>
                      <td style="text-align: center;">
                          <span style="background: #eee; padding: 5px 10px; border-radius: 4px;" id="qtd-carrinho-<?php echo $item['id']; ?>"><?php echo $item['quantidade']; ?></span>
                      </td>
                      <td style="text-align: right;">
                          R$ <span id="valor-unit-<?php echo $item['id']; ?>"><?php echo number_format($item['valor'], 2, ',', '.'); ?></span>
                      </td>
                      <td style="text-align: right; color: #dc3545;">
                          <strong>R$ <span id="subtotal-<?php echo $item['id']; ?>"><?php echo number_format($item['subtotal'], 2, ',', '.'); ?></span></strong>
                      </td>
                      <td style="text-align: center;">
                          <a href="carrinho.php?acao=remove&id=<?php echo $item['id']; ?>" class="btn-remove" id="btn-remover-<?php echo $item['id']; ?>" title="Remover item">✖</a>
                      </td>
                  </tr>
                  <?php endforeach; ?>
              </tbody>
          </table>

          <div class="cart-footer" id="rodape-carrinho">
              <div class="total-label">TOTAL DO PEDIDO</div>
              <div class="total-price" id="preco-total">R$ <?php echo number_format($total, 2, ',', '.'); ?></div>
              
              <div style="margin-top: 30px; display: flex; justify-content: flex-end; gap: 20px;" id="area-botoes-acao">
                  
                  <a href="index.php" class="btn-secondary" id="btn-continuar-comprando" style="width: auto; padding: 15px 40px;">
                      ❮ Continuar Comprando
                  </a>

                  <button class="btn-buy" id="btn-finalizar-pedido" style="width: auto; padding: 15px 40px;" onclick="alert('Sistema de checkout ainda não implementado!')">
                      FINALIZAR PEDIDO
                  </button>

              </div>
          </div>

      <?php endif; ?>

  </div>

</body>
</html>