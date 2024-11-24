<?php
$hostname = "mysql.freehostia.com";
$usuario = "slasla11_adote";
$senha = "ajuda3439"; // se tiver senha, coloque aqui
$bancodedados = "slasla11_adote";

// Conexão com o banco de dados
$conn = mysqli_connect($hostname, $usuario, $senha, $bancodedados);

// Verificar a conexão
if (!$conn) {
    die("Erro de conexão: " . mysqli_connect_error());
}

$mensagem = ""; // Variável para armazenar mensagens de feedback

// Verificar se o formulário foi enviado
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Capturar os valores enviados pelo formulário
    $email = $_POST['email'];
    $senha = $_POST['senha'];
    $cpf = $_POST['cpf'];

    // Validar os campos
    if (empty($email) || empty($senha) || empty($cpf)) {
        $mensagem = "Todos os campos são obrigatórios!";
    } else {
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
                $mensagem = "Dados atualizados com sucesso!";
            } else {
                $mensagem = "Erro ao atualizar os dados.";
            }

            $updateStmt->close();
        } else {
            $mensagem = "CPF não encontrado.";
        }

        $stmt->close();
    }
}

$conn->close();
?>
