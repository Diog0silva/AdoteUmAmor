<?php
$hostname = "mysql.freehostia.com";
$usuario = "slasla11_adote";
$senha = "ajuda3439"; // se tiver senha, coloque aqui
$bancodedados = "slasla11_adote";
// Criando conexão
$conn = mysqli_connect($hostname, $usuario, $senha, $bancodedados);

// Verificando a conexão
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$nomee = $_POST['nomee'];
$cnpj= $_POST['cnpj'];
$emaill = $_POST['emaill'];
$senhaa = $_POST['senhaa']; // Senha em texto simples

// Inserir os dados no banco (com senha em texto simples)
$sql = "INSERT INTO ongs (nome, cnpj, email, senha) VALUES ('$nomee', '$cnpj', '$emaill', '$senhaa')";
if ($conn->query($sql) === TRUE) {
    echo "Usuário cadastrado!";
    header("location:index-com-login.html");
    exit();
} else {
    echo "Não foi possível cadastrar o usuário! " . $conn->error;
}

$conn->close();
?>