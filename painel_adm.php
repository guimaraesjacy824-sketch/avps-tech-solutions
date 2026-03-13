<?php
session_start();
require_once 'db.php';

// Segurança: Só permite acesso se for ADM
if (!isset($_SESSION['usuario_tipo']) || $_SESSION['usuario_tipo'] !== 'adm') {
    die("Acesso negado. Apenas administradores podem ver esta página.");
}

// Lógica para apagar produto se solicitado
if (isset($_GET['eliminar_produto'])) {
    $id = $_GET['eliminar_produto'];
    $conn->query("DELETE FROM produtos WHERE id = $id");
}
?>

<!DOCTYPE html>
<html lang="pt-pt">
<head>
    <meta charset="UTF-8">
    <title>ADM | AVPS-TECH</title>
    <link rel="stylesheet" href="style.css">
    <style>
        .admin-grid { display: grid; grid-template-columns: 1fr 1fr; gap: 20px; padding: 20px; }
        .admin-card { background: white; padding: 20px; border-radius: 10px; box-shadow: 0 4px 10px rgba(0,0,0,0.1); }
        table { width: 100%; border-collapse: collapse; margin-top: 10px; }
        th, td { padding: 12px; text-align: left; border-bottom: 1px solid #ddd; font-size: 0.9rem; }
        th { background: #004aad; color: white; }
        .status-badge { padding: 4px 8px; border-radius: 4px; font-size: 0.8rem; background: #e1f5fe; color: #01579b; }
        .btn-delete { color: #dc3545; text-decoration: none; font-weight: bold; }
    </style>
</head>
<body>

<header class="navbar">
    <div class="logo">Panel Administrativo AVPS-TECH</div>
    <div>
        <span>Olá, <?php echo $_SESSION['usuario_nome']; ?></span> | 
        <a href="logout.php" style="color: white;">Sair</a>
    </div>
</header>

<div class="admin-grid">
    
    <!-- Gestão de Stock -->
    <div class="admin-card">
        <h3>📦 Gestão de Inventário</h3>
        <table>
            <thead>
                <tr>
                    <th>Produto</th>
                    <th>Preço (Kz)</th>
                    <th>Stock</th>
                    <th>Ações</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $res = $conn->query("SELECT * FROM produtos");
                while($row = $res->fetch_assoc()) {
                    echo "<tr>
                            <td>{$row['nome']}</td>
                            <td>".number_format($row['preco'], 2, ',', '.')."</td>
                            <td>{$row['stock']}</td>
                            <td><a href='?eliminar_produto={$row['id']}' class='btn-delete'>Remover</a></td>
                          </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Últimas Vendas -->
    <div class="admin-card">
        <h3>💰 Últimas Vendas (Kwanzas)</h3>
        <table>
            <thead>
                <tr>
                    <th>ID</th>
                    <th>Valor</th>
                    <th>Método</th>
                    <th>Data</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $vendas = $conn->query("SELECT * FROM vendas ORDER BY data_venda DESC LIMIT 5");
                while($v = $vendas->fetch_assoc()) {
                    echo "<tr>
                            <td>#{$v['id']}</td>
                            <td>".number_format($v['total_pago'], 2, ',', '.')." Kz</td>
                            <td>{$v['metodo_pagamento']}</td>
                            <td>".date('d/m/H:i', strtotime($v['data_venda']))."</td>
                          </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

    <!-- Clientes Registados -->
    <div class="admin-card" style="grid-column: span 2;">
        <h3>👥 Clientes Inscritos</h3>
        <table>
            <thead>
                <tr>
                    <th>Nome</th>
                    <th>Email</th>
                    <th>Telefone</th>
                    <th>Data de Registo</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $clientes = $conn->query("SELECT nome, email, telefone, data_registo FROM clientes WHERE tipo = 'cliente'");
                while($c = $clientes->fetch_assoc()) {
                    echo "<tr>
                            <td>{$c['nome']}</td>
                            <td>{$c['email']}</td>
                            <td>{$c['telefone']}</td>
                            <td>".date('d/m/Y', strtotime($c['data_registo']))."</td>
                          </tr>";
                }
                ?>
            </tbody>
        </table>
    </div>

</div>

</body>
</html>
