<?php
// Conectar ao banco de dados
$conexao = new mysqli("mysql.freehostia.com", "slasla11_adote", "ajuda3439", "slasla11_adote");

// Verificando a conexão
if ($conexao->connect_error) {
    die("Falha na conexão: " . $conexao->connect_error);
}

// Receber os dados do formulário
$email = trim($_POST['email']); // Remover espaços extras
$senha = trim($_POST['senha']); // Remover espaços extras

// Validar o email
if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
    echo "Email inválido.";
    exit;
}

// Preparar a consulta SQL para verificar o email
$sql = "SELECT email, senha FROM pessoas WHERE email = ?";
$stmt = $conexao->prepare($sql);

// Verificar se a consulta foi preparada corretamente
if ($stmt === false) {
    die('Erro ao preparar a consulta: ' . $conexao->error);
}

// Associar o parâmetro e executar a consulta
$stmt->bind_param("s", $email);
$stmt->execute();
$result = $stmt->get_result();


if ($result && $result->num_rows > 0) {
    $row = $result->fetch_assoc();
  
    // Comparar a senha inserida com a senha armazenada no banco
    if ($senha == $row['senha']) {
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