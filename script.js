let carrinho = [];

function adicionarAoCarrinho(nome, preco) {
    carrinho.push({nome, preco});
    alert(`${nome} adicionado ao carrinho! Total: ${carrinho.length} itens.`);
}

function solicitarServico(tipo) {
    alert(`Pedido de serviço enviado: ${tipo}. A nossa equipa entrará em contacto.`);
}

function toggleLogin() {
    const modal = document.getElementById('login-modal');
    modal.style.display = (modal.style.display === 'block') ? 'none' : 'block';
}

// Simulação básica de login para mostrar painel ADM
document.getElementById('form-login').onsubmit = function(e) {
    e.preventDefault();
    alert("Login efectuado como Administrador!");
    document.getElementById('login-modal').style.display = 'none';
    document.getElementById('admin-panel').style.display = 'block';
};
