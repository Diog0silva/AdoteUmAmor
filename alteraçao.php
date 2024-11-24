<?php
$hostname = "mysql.freehostia.com";
$usuario = "slasla11_adote";
$senha = "ajuda3439";
$bancodedados = "slasla11_adote";

// Conexão com o banco de dados
$conn = mysqli_connect($hostname, $usuario, $senha, $bancodedados);

if (!$conn) {
    die("Erro de conexão: " . mysqli_connect_error());
}

// Verificar se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'] ?? '';
    $senha = $_POST['senha'] ?? '';
    $cpf = $_POST['cpf'] ?? '';

    // Validar os campos
    if (empty($email) || empty($senha) || empty($cpf)) {
        echo "Todos os campos são obrigatórios!";
        exit;
    }

    // Verificar se o CPF existe no banco de dados
    $query = "SELECT * FROM pessoas WHERE cpf = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $cpf);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // CPF encontrado, atualizar o e-mail e a senha
        $updateQuery = "UPDATE pessoas SET email = ?, senha = ? WHERE cpf = ?";
        $updateStmt = $conn->prepare($updateQuery);
        $updateStmt->bind_param("sss", $email, $senha, $cpf);

        if ($updateStmt->execute()) {
            echo "Dados atualizados com sucesso!";
        } else {
            echo "Erro ao atualizar os dados: " . $conn->error;
        }

        $updateStmt->close();
    } else {
        echo "CPF não encontrado.";
    }

    $stmt->close();
}

$conn->close();
?>