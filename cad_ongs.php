<?php

$hostname = "localhost";
$usuario = "root";
$senha = ""; // se tiver senha, coloque aqui
$bancodedados = "diogo";



// Criando conexão
$conn = mysqli_connect($hostname, $usuario, $senha, $bancodedados);

// Verificando a conexão
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

echo "Connected successfully";

$nomee = $_POST['nomee'];
$cnpj = $_POST['cnpj'];
$emaill = $_POST['emaill'];
$senhaa = md5($_POST['senhaa']);
$sql ="INSERT INTO ongs (nomee,cnpj,emaill,senhaa) VALUES('$nomee','$cnpj','$emaill','$senhaa')";
if($conn->query($sql) ===TRUE) {
    echo "usuário cadastrado!";
} else{
    echo "Não foi possivel cadastrar usuário!".$conn->error;
}

$conn->close();
?>