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

    // Validar o CPF, que é obrigatório
    if (empty($cpf)) {
        echo "<script>alert('O CPF é obrigatório!'); window.location.href='conta.html';</script>";
        exit;
    }

    // Verificar se o CPF existe no banco de dados
    $query = "SELECT * FROM pessoas WHERE cpf = ?";
    $stmt = $conn->prepare($query);
    $stmt->bind_param("s", $cpf);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result->num_rows > 0) {
        // CPF encontrado, atualizar o e-mail e/ou a senha se fornecido
        if (!empty($email) && !empty($senha)) {
            // Se o e-mail e a senha foram fornecidos
            $updateQuery = "UPDATE pessoas SET email = ?, senha = ? WHERE cpf = ?";
            $updateStmt = $conn->prepare($updateQuery);
            $updateStmt->bind_param("sss", $email, $senha, $cpf);

            if ($updateStmt->execute()) {
                echo "<script>alert('Dados atualizados com sucesso!'); window.location.href='conta.html';</script>";
            } else {
                echo "<script>alert('Erro ao atualizar os dados: " . $conn->error . "'); window.location.href='conta.html';</script>";
            }

            $updateStmt->close();
        } elseif (!empty($email)) {
            // Se apenas o e-mail foi fornecido
            $updateQuery = "UPDATE pessoas SET email = ? WHERE cpf = ?";
            $updateStmt = $conn->prepare($updateQuery);
            $updateStmt->bind_param("ss", $email, $cpf);

            if ($updateStmt->execute()) {
                echo "<script>alert('E-mail atualizado com sucesso!'); window.location.href='conta.html';</script>";
            } else {
                echo "<script>alert('Erro ao atualizar o e-mail: " . $conn->error . "'); window.location.href='conta.html';</script>";
            }

            $updateStmt->close();
        } elseif (!empty($senha)) {
            // Se apenas a senha foi fornecida
            $updateQuery = "UPDATE pessoas SET senha = ? WHERE cpf = ?";
            $updateStmt = $conn->prepare($updateQuery);
            $updateStmt->bind_param("ss", $senha, $cpf);

            if ($updateStmt->execute()) {
                echo "<script>alert('Senha atualizada com sucesso!'); window.location.href='conta.html';</script>";
            } else {
                echo "<script>alert('Erro ao atualizar a senha: " . $conn->error . "'); window.location.href='conta.html';</script>";
            }

            $updateStmt->close();
        } else {
            // Caso o e-mail e a senha não sejam fornecidos
            echo "<script>alert('Nenhuma alteração foi feita.'); window.location.href='conta.html';</script>";
        }
    } else {
        echo "<script>alert('CPF não encontrado.'); window.location.href='conta.html';</script>";
    }

    $stmt->close();
}

$conn->close();
?>