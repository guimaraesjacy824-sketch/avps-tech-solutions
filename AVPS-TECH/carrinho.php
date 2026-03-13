<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <title>AVPS-TECH | Meu Carrinho</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .cart-container { max-width: 800px; margin: 30px auto; background: white; padding: 20px; border-radius: 10px; box-shadow: 0 5px 15px rgba(0,0,0,0.1); }
        .cart-item { display: flex; justify-content: space-between; border-bottom: 1px solid #eee; padding: 10px 0; }
        .total-box { text-align: right; margin-top: 20px; font-size: 1.2rem; font-weight: bold; color: #004aad; }
        .btn-checkout { background: #28a745; color: white; border: none; padding: 15px; width: 100%; border-radius: 5px; cursor: pointer; font-size: 1rem; }
    </style>
</head>
<body>

<div class="cart-container">
    <h2>Seu Carrinho - AVPS-TECH</h2>
    <div id="itens-carrinho">
        <!-- Itens serão carregados aqui pelo JS -->
    </div>
    
    <div class="total-box">
        Total: <span id="valor-total">0</span> Kz
    </div>

    <hr>
    
    <h3>Finalizar Pedido</h3>
    <form action="finalizar_venda.php" method="POST">
        <input type="hidden" name="total" id="input-total">
        <input type="hidden" name="itens_json" id="input-itens">
        
        <label>Método de Pagamento:</label>
        <select name="metodo_pagamento" required style="width: 100%; padding: 10px; margin: 10px 0;">
            <option value="Transferencia">Transferência Bancária (IBAN)</option>
            <option value="Multicaixa Express">Multicaixa Express</option>
            <option value="Cash">Pagamento no Local</option>
        </select>
        
        <button type="submit" class="btn-checkout">Confirmar Compra (Kwanzas)</button>
    </form>
    <br>
    <a href="index.php">← Continuar a Comprar</a>
</div>

<script>
    function carregarCarrinho() {
        // Simulando dados do localStorage (onde os produtos foram adicionados no index.php)
        const carrinho = JSON.parse(localStorage.getItem('carrinho')) || [];
        const container = document.getElementById('itens-carrinho');
        let total = 0;

        if(carrinho.length === 0) {
            container.innerHTML = "<p>O seu carrinho está vazio.</p>";
            return;
        }

        container.innerHTML = "";
        carrinho.forEach((item, index) => {
            total += item.preco;
            container.innerHTML += `
                <div class="cart-item">
                    <span>${item.nome}</span>
                    <span>${item.preco.toLocaleString()} Kz</span>
                </div>
            `;
        });

        document.getElementById('valor-total').innerText = total.toLocaleString();
        document.getElementById('input-total').value = total;
        document.getElementById('input-itens').value = JSON.stringify(carrinho);
    }

    carregarCarrinho();
</script>
</body>
</html>
