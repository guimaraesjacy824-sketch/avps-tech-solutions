<?php
session_start();
require_once 'db.php'; // Ficheiro de conexão criado anteriormente

if (!isset($_SESSION['usuario_id'])) {
    die("<script>alert('Precisa fazer login para finalizar a compra!'); window.location='login.php';</script>");
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $cliente_id = $_SESSION['usuario_id'];
    $total = $_POST['total'];
    $metodo = $_POST['metodo_pagamento'];

    // Inserir na tabela de vendas
    $sql = "INSERT INTO vendas (cliente_id, total_pago, metodo_pagamento) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ids", $cliente_id, $total, $metodo);

    if ($stmt->execute()) {
        // Aqui você poderia inserir também os itens detalhados numa tabela 'itens_venda'
        echo "<script>
                alert('Pedido recebido com sucesso! A AVPS-TECH agradece.');
                localStorage.removeItem('carrinho');
                window.location='index.php';
              </script>";
    } else {
        echo "Erro ao processar venda: " . $conn->error;
    }
}
?>
