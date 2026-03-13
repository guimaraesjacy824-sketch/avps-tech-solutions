<?php
session_start();
// Configuração da conexão
$host = "localhost";
$user = "root";
$pass = "";
$db   = "avps_tech_db";

$conn = new mysqli($host, $user, $pass, $db);

if ($conn->connect_error) { die("Erro: " . $conn->connect_error); }

$acao = $_POST['acao'];

if ($acao == 'registo') {
    $nome = $_POST['nome'];
    $email = $_POST['email'];
    $telefone = $_POST['telefone'];
    $senha = password_hash($_POST['senha'], PASSWORD_DEFAULT); // Encriptação de segurança

    $sql = "INSERT INTO clientes (nome, email, telefone, senha) VALUES (?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssss", $nome, $email, $telefone, $senha);

    if ($stmt->execute()) {
        echo "<script>alert('Conta criada com sucesso!'); window.location='login.php';</script>";
    } else {
        echo "Erro ao registar: " . $conn->error;
    }
}

if ($acao == 'login') {
    $email = $_POST['email'];
    $senha = $_POST['senha'];

    $sql = "SELECT id, nome, senha, tipo FROM clientes WHERE email = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $resultado = $stmt->get_result();

    if ($user = $resultado->fetch_assoc()) {
        if (password_verify($senha, $user['senha'])) {
            $_SESSION['usuario_id'] = $user['id'];
            $_SESSION['usuario_nome'] = $user['nome'];
            $_SESSION['usuario_tipo'] = $user['tipo'];

            // Redireciona conforme o cargo
            if ($user['tipo'] == 'adm') {
                header("Location: painel_adm.php");
            } else {
                header("Location: index.php");
            }
        } else {
            echo "<script>alert('Senha incorreta!'); window.history.back();</script>";
        }
    } else {
        echo "<script>alert('Utilizador não encontrado!'); window.history.back();</script>";
    }
}
?>
