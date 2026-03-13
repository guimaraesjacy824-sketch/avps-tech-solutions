<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <title>AVPS-TECH | Acesso</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .auth-container { max-width: 400px; margin: 50px auto; background: white; padding: 30px; border-radius: 12px; box-shadow: 0 10px 25px rgba(0,0,0,0.1); }
        .tab-btn { width: 48%; padding: 10px; border: none; cursor: pointer; background: #eee; font-weight: bold; }
        .tab-btn.active { background: #004aad; color: white; }
        form { display: flex; flex-direction: column; gap: 15px; margin-top: 20px; }
        input { padding: 12px; border: 1px solid #ddd; border-radius: 5px; }
        .hidden { display: none; }
    </style>
</head>
<body style="background: #f0f2f5;">

<div class="auth-container">
    <div style="text-align: center; margin-bottom: 20px;">
        <h2>AVPS-TECH</h2>
    </div>
    
    <div class="tabs">
        <button class="tab-btn active" onclick="showTab('login')">Login</button>
        <button class="tab-btn" onclick="showTab('registo')">Registo</button>
    </div>

    <!-- Formulário de Login -->
    <form id="login-form" action="processar_autenticacao.php" method="POST">
        <input type="hidden" name="acao" value="login">
        <input type="email" name="email" placeholder="Seu E-mail" required>
        <input type="password" name="senha" placeholder="Sua Senha" required>
        <button type="submit" class="btn-submit">Entrar no Site</button>
    </form>

    <!-- Formulário de Registo -->
    <form id="registo-form" action="processar_autenticacao.php" method="POST" class="hidden">
        <input type="hidden" name="acao" value="registo">
        <input type="text" name="nome" placeholder="Nome Completo" required>
        <input type="email" name="email" placeholder="E-mail" required>
        <input type="text" name="telefone" placeholder="Telefone (9xx...)" required>
        <input type="password" name="senha" placeholder="Criar Senha" required>
        <button type="submit" class="btn-submit" style="background: #28a745;">Criar Minha Conta</button>
    </form>
</div>

<script>
    function showTab(tab) {
        document.getElementById('login-form').classList.toggle('hidden', tab !== 'login');
        document.getElementById('registo-form').classList.toggle('hidden', tab !== 'registo');
        document.querySelectorAll('.tab-btn').forEach(btn => btn.classList.toggle('active', btn.innerText.toLowerCase() === tab));
    }
</script>
</body>
</html>
