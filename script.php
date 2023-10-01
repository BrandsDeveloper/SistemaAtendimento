<?php
// Recupera os dados enviados pelo aplicativo
$nome = $_POST['nome'];
$ddd = $_POST['ddd'];
$telefone = $_POST['telefone'];
$endereco = $_POST['endereco'];
$cep = $_POST['cep'];
$entrega = $_POST['entrega'];
$pagamento = $_POST['pagamento'];
$pizza = $_POST['pizza'];
$valor = $_POST['valor'];
$codigo = $_POST['codigo'];

// Faça a conexão com o banco de dados
$servername = "host";
$username = "user";
$password = "pass";
$dbname = "banco";

$conn = new mysqli($servername, $username, $password, $dbname);

// Verifica se a conexão foi estabelecida corretamente
if ($conn->connect_error) {
    die("Falha na conexão: " . $conn->connect_error);
}

// Insere os dados na tabela do banco de dados
$sql = "INSERT INTO forms (nome, ddd, telefone, endereco, cep, entrega, pagamento, nome_pizza, valor, codigo)
        VALUES ('$nome', '$ddd', '$telefone', '$endereco', '$cep', '$entrega', '$pagamento', '$pizza', '$valor', '$codigo')";

if ($conn->query($sql) === TRUE) {
    echo "Dados inseridos com sucesso.";
} else {
    echo "Erro ao inserir os dados: " . $conn->error;
}

// Fecha a conexão com o banco de dados
$conn->close();
?>

