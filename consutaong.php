<?php
// Conectar ao banco de dados
$conexao = new mysqli("mysql.freehostia.com", "slasla11_adote", "ajuda3439", "slasla11_adote");

// Verificando a conexão
if ($conexao->connect_error) {
    die("Falha na conexão: " . $conexao->connect_error);
}

// Receber os dados do formulário
$emaill = trim($_POST['emaill']); // Remover espaços extras
$senhaa = trim($_POST['senhaa']); // Remover espaços extras

// Validar o email
if (!filter_var($emaill, FILTER_VALIDATE_EMAIL)) {
    echo "Email inválido.";
    exit;
}

// Preparar a consulta SQL para verificar o email
$sql = "SELECT email, senha FROM ongs WHERE email = ?";
$stmt = $conexao->prepare($sql);

// Verificar se a consulta foi preparada corretamente
if ($stmt === false) {
    die('Erro ao preparar a consulta: ' . $conexao->error);
}

// Associar o parâmetro e executar a consulta
$stmt->bind_param("s", $emaill);
$stmt->execute();
$result = $stmt->get_result();


if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
  
    // Comparar a senha inserida com a senha armazenada no banco
    if ($senhaa == $row['senha']) {
        header("location:index-com-login.html");
    } else {
        header("location:tela-erro-login.html");
    }
} else {
    header("location:tela-erro-login.html");
}

$stmt->close();
$conexao->close();
?>