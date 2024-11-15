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

echo "Connected successfully";

$nome = $_POST['nome'];
$email = $_POST['email'];
$senha = md5($_POST['senha']);
$sql ="INSERT INTO pessoas (nome,email,senha) VALUES('$nome','$email','$senha')";
if($conn->query($sql) ===TRUE) {
    echo "usuário cadastrado!";
} else{
    echo "Não foi possivel cadastrar usuário!".$conn->error;
}

$conn->close();
?>