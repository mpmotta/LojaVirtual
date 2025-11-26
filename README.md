# 🛒 Loja Virtual MVC (PHP Puro)

![PHP](https://img.shields.io/badge/PHP-777BB4?style=for-the-badge&logo=php&logoColor=white)
![MySQL](https://img.shields.io/badge/MySQL-00000F?style=for-the-badge&logo=mysql&logoColor=white)
![HTML5](https://img.shields.io/badge/HTML5-E34F26?style=for-the-badge&logo=html5&logoColor=white)
![CSS3](https://img.shields.io/badge/CSS3-1572B6?style=for-the-badge&logo=css3&logoColor=white)

Um sistema de E-commerce desenvolvido do zero utilizando **PHP Nativo** e arquitetura **MVC (Model-View-Controller)**. O projeto foca em boas práticas de organização de código, IDs semânticos no HTML e responsividade.

---

## 📸 Screenshots

<div align="center">
  <img src="https://github.com/user-attachments/assets/6d3613ed-b962-4960-ba31-04eb92d3dca6" alt="Tela Inicial" width="700">
</div>

---

## 🚀 Funcionalidades

- **Catálogo de Produtos:** Listagem dinâmica vinda do banco de dados MySQL.
- **Sistema de Busca:** Pesquisa de produtos por nome (barra de busca no header).
- **Filtro por Categorias:** Navegação filtrada (Celulares, Eletrônicos, etc).
- **Detalhes do Produto:** Página individual com descrição, preço e botão de ação.
- **Carrinho de Compras:** Sistema funcional utilizando **Sessões do PHP** (adicionar, visualizar, remover itens e cálculo de subtotal/total).
- **Arquitetura MVC:** Separação clara entre Lógica (Controller), Dados (Model) e Visualização (View).
- **Design Responsivo:** Layout fluido que se adapta a computadores e celulares.
- **HTML Semântico:** Uso correto de IDs e tags para acessibilidade e SEO.

---

## 📂 Estrutura de Pastas

```text
/
├── controller/        # Lógica de negócio (Ponte entre View e Model)
│   ├── carrinhoController.php
│   └── produtoController.php
├── model/             # Acesso ao Banco de Dados (SQL)
│   ├── Conexao.php
│   └── Produto.php
├── view/              # Interface do Usuário (HTML/PHP)
│   ├── css/
│   │   └── style.css
│   ├── img/           # Imagens dos produtos e banner
│   ├── index.php      # Home
│   ├── categoria.php  # Listagem filtrada
│   ├── produto.php    # Detalhes do item
│   └── carrinho.php   # Carrinho de compras
└── README.md
````

-----

## 🛠️ Como Rodar o Projeto

### Pré-requisitos

  * Um servidor local (XAMPP, WAMP, ou USBWebserver).
  * PHP 7.4 ou superior.
  * MySQL.

### Passo 1: Configurar o Banco de Dados

1.  Abra seu gerenciador de banco de dados (ex: PHPMyAdmin).
2.  Crie um banco de dados chamado **`loja_db`**.
3.  Execute o seguinte script SQL na aba "SQL" para criar a tabela e inserir produtos de exemplo:

<!-- end list -->

```sql
CREATE TABLE produtos (
  id INT AUTO_INCREMENT PRIMARY KEY,
  nome VARCHAR(100) NOT NULL,
  categoria VARCHAR(50) NOT NULL,
  valor DECIMAL(10, 2) NOT NULL,
  imagem VARCHAR(255),
  descricao TEXT,
  data_criado DATETIME DEFAULT CURRENT_TIMESTAMP
);

-- Inserindo dados de teste
INSERT INTO produtos (nome, categoria, valor, imagem, descricao, data_criado) VALUES
('iPhone 14 Pro', 'Celulares', 7999.00, 'iphone14.jpg', 'Smartphone Apple com câmera de 48MP.', NOW()),
('Samsung Galaxy S23', 'Celulares', 4500.00, 's23.jpg', 'O melhor Android do mercado.', NOW()),
('Notebook Dell', 'Informática', 3200.00, 'dell.jpg', 'Notebook rápido para trabalho e estudos.', DATE_SUB(NOW(), INTERVAL 10 DAY)),
('Fone Bluetooth', 'Eletrônicos', 150.00, 'fone.jpg', 'Som de alta qualidade sem fios.', NOW()),
('Geladeira Frost Free', 'Eletrodomésticos', 2800.00, 'geladeira.jpg', 'Geladeira econômica e espaçosa.', DATE_SUB(NOW(), INTERVAL 20 DAY));
```

### Passo 2: Configurar a Conexão

Abra o arquivo `model/Conexao.php` e verifique se as credenciais batem com as do seu servidor local:

```php
private $host = "localhost";
private $db_name = "loja_db";
private $username = "root";
private $password = "usbw"; // Se usar XAMPP, geralmente a senha é vazia ""
```

### Passo 3: Imagens

Certifique-se de colocar imagens reais na pasta `view/img/` com os mesmos nomes que estão no banco de dados (ex: `iphone14.jpg`, `banner.png`).

### Passo 4: Acessar

Coloque a pasta do projeto dentro do diretório do seu servidor (`htdocs` ou `root`) e acesse pelo navegador:
`http://localhost/nome-da-pasta/view/index.php`

-----

## 🤝 Contribuição

Sinta-se à vontade para fazer um fork deste projeto e enviar pull requests.

## 📝 Licença

Este projeto é de código aberto e está disponível sob a licença [MIT](https://opensource.org/licenses/MIT).

```
```
