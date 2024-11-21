<?php
$hostname = "localhost";
$usuario = "root";
$senha = ""; // se tiver senha, coloque aqui
$bancodedados = "cad_usuario";

// Criando conexão
$conn = mysqli_connect($hostname, $usuario, $senha, $bancodedados);

// Verificando a conexão
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$nome = $_POST['nome'];
$cpf = $_POST['cpf'];
$email = $_POST['email'];
$senha = $_POST['senha']; // Senha em texto simples

// Inserir os dados no banco (com senha em texto simples)
$sql = "INSERT INTO pessoas (nome, cpf, email, senha) VALUES ('$nome', '$cpf', '$email', '$senha')";
if ($conn->query($sql) === TRUE) {
    echo "Usuário cadastrado!";
    header("location:index-com-login.html");
    exit();
} else {
    echo "Não foi possível cadastrar o usuário! " . $conn->error;
}

$conn->close();
?>