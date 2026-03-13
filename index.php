<?php
session_start();
require_once 'db.php'; // Certifique-se de que o ficheiro de conexão existe
?>
<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>AVPS-TECH | Soluções Tecnológicas</title>
    <link rel="stylesheet" href="style.css">
    <!-- Removi o defer para garantir que as funções de toggle funcionem prontamente -->
    <script src="script.js"></script> 
</head>
<body>

<header>
    <nav class="navbar">
        <div class="logo" style="display:flex; align-items: center;">
            <!-- Campo de imagem da empresa conforme solicitado -->
            <img src="Imagens/LOGO-AVPSTECH.png" alt="AVPS-TECH Logo" id="empresa-logo" style="height: 50px;">
            <h1 id="logo" style="margin-left: 10px;">AVPS-TECH</h1>
        </div>
        <ul type="none" class="nav-links">
            <li><a href="index.php" id="link">Home</a></li>
            <li><a href="#produtos" id="link">Produtos</a></li>
            <li><a href="#servicos" id="link">Serviços</a></li>
            <li><a href="carrinho.php" id="link">Carrinho</a></li>
            
            <?php if(isset($_SESSION['usuario_id'])): ?>
                <li><button onclick="window.location='logout.php'" class="btn-login" style="background:#ff4b2b;">Sair (<?php echo $_SESSION['usuario_nome']; ?>)</button></li>
                <?php if($_SESSION['usuario_tipo'] == 'adm'): ?>
                    <li><button onclick="window.location='painel_adm.php'" class="btn-login" style="background:#4caf50;">Painel ADM</button></li>
                <?php endif; ?>
            <?php else: ?>
                <li><button onclick="toggleLogin()" class="btn-login">Login / Registar</button></li>
            <?php endif; ?>
        </ul>
    </nav>
</header>

<!-- Secção Login / Registo (Modificada para ser funcional) -->
<section id="login-modal" class="modal" style="display:none; position: fixed; z-index: 999; left: 0; top: 0; width: 100%; height: 100%; background-color: rgba(0,0,0,0.7);">
    <div class="modal-content" style="background: white; margin: 10% auto; padding: 20px; width: 320px; border-radius: 10px;">
        <h2 style="text-align:center;">ACESSO AVPS-TECH</h2>
        <form action="processar_autenticacao.php" method="POST">
            <input type="hidden" name="acao" value="login">
            <div style="text-align:center; display: flex; flex-direction: column; gap: 10px;">
                <input type="email" name="email" placeholder="E-mail" required style="padding: 10px;">
                <input type="password" name="senha" placeholder="Senha" required style="padding: 10px;">
                <button type="submit" class="btn-e" style="padding: 10px; background: #004aad; color: white; border: none; cursor: pointer;">Entrar</button>
                <p style="font-size: 0.8rem;">Não tem conta? <a href="login.php">Registe-se aqui</a></p>
                <button type="button" onclick="toggleLogin()" class="btn-c" style="padding: 10px; background: #ccc; border: none; cursor: pointer;">Fechar</button>
            </div>
        </form>
    </div>
</section>

<!-- Interface Cliente -->
<main class="container">
    <section id="produtos">
        <h2 style="margin: 20px 0;">Produtos Informáticos</h2>
        <div class="grid-container" id="lista-produtos" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(220px, 1fr)); gap: 20px;">
            
            <!-- Os cards agora chamam a função JS que salva no localStorage -->
            <div class="card">
                <img src="Imagens/Pro 15.jpeg" alt="Computador">
                <h3>Laptop Pro 15"</h3>
                <p class="preco">750.000 Kz</p>
                <button onclick="adicionarAoCarrinho('Laptop Pro 15', 750000)" class="btn-buy">Adicionar ao Carrinho</button>
            </div>

            <div class="card">
                <img src="Imagens/All in one.jpeg" alt="Computador">
                <h3>Desktop All in One HP</h3>
                <p class="preco">500.000 Kz</p>
                <button onclick="adicionarAoCarrinho('Desktop All in One HP', 500000)" class="btn-buy">Adicionar ao Carrinho</button>
            </div>

            <div class="card">
                <img src="Imagens/PC gammer.jpg" alt="Computador">
                <h3>PC Gamer Pro</h3>
                <p class="preco">900.000 Kz</p>
                <button onclick="adicionarAoCarrinho('PC Gamer Pro', 900000)" class="btn-buy">Adicionar ao Carrinho</button>
            </div>

            <div class="card">
                <img src="Imagens/Kit de acessórios .jpg" alt="Acessórios">
                <h3>Kit Gamer The G-LAB</h3>
                <p class="preco">35.000 Kz</p>
                <button onclick="adicionarAoCarrinho('Kit Gamer The G-LAB', 35000)" class="btn-buy">Adicionar ao Carrinho</button>
            </div>

            <div class="card">
                <img src="Imagens/Mouse The-G Lab.jpg" alt="Mouse">
                <h3>Mouse The-G Lab</h3>
                <p class="preco">7.000 Kz</p>
                <button onclick="adicionarAoCarrinho('Mouse The-G Lab', 7000)" class="btn-buy">Adicionar ao Carrinho</button>
            </div>

            <div class="card">
                <img src="Imagens/Router 5G.jpg" alt="Rede">
                <h3>Router Universal 5G</h3>
                <p class="preco">150.000 Kz</p>
                <button onclick="adicionarAoCarrinho('Router Universal 5G', 150000)" class="btn-buy">Adicionar ao Carrinho</button>
            </div>
            <!-- Adicione os restantes cards seguindo o mesmo padrão de onclick -->
        </div>
    </section>

    <section id="servicos" style="margin-top: 50px;">
        <h2>Nossos Serviços Especializados</h2>
        <div class="grid-container" style="display: grid; grid-template-columns: repeat(auto-fit, minmax(280px, 1fr)); gap: 20px;">
            <div class="card-servico" style="border: 1px solid #ddd; padding: 20px; border-radius: 8px;">
                <h3>Manutenção de Hardware</h3>
                <p>Reparação e limpeza de equipamentos.</p>
                <button onclick="solicitarServico('Manutenção')" class="btn-service">Solicitar Orçamento</button>
            </div>

            <div class="card-servico" style="border: 1px solid #ddd; padding: 20px; border-radius: 8px;">
                <h3>Desenvolvimento Mobile (Android/iOS)</h3>
                <p>Apps intuitivos e modernos.</p>
                <button onclick="solicitarServico('App Mobile')" class="btn-service">Solicitar Orçamento</button>
            </div>

            <div class="card-servico" style="border: 1px solid #ddd; padding: 20px; border-radius: 8px;">
                <h3>Criação de Páginas Web</h3>
                <p>Sites profissionais para a sua empresa.</p>
                <button onclick="solicitarServico('Website')" class="btn-service">Solicitar Orçamento</button>
            </div>
        </div>
    </section>
</main>

<footer style="background: #1a1a1a; color: white; padding: 30px; text-align: center; margin-top: 50px;">
    <p><strong>AVPS-TECH - Soluções Tecnológicas</strong></p>
    <p>Localização: Luanda, Angola - Rua de Tecnologia, Edifício AVPS</p>
    <p>Contacto: +244 946 697 568| info@avps-tech.ao</p>
</footer>






<script>
// Funções essenciais integradas
function toggleLogin() {
    var modal = document.getElementById('login-modal');
    modal.style.display = (modal.style.display === 'none' || modal.style.display === '') ? 'block' : 'none';
}

function adicionarAoCarrinho(nome, preco) {
    let carrinho = JSON.parse(localStorage.getItem('carrinho')) || [];
    carrinho.push({nome: nome, preco: preco});
    localStorage.setItem('carrinho', JSON.stringify(carrinho));
    alert(nome + " foi adicionado ao seu carrinho!");
}

function solicitarServico(servico) {
    alert("Pedido de orçamento para '" + servico + "' enviado. A AVPS-TECH entrará em contacto!");
}
</script>

</body>
</html>
