<?php
// Faça a conexão com o banco de dados
$servername = "host";
$username = "user";
$password = "pass";
$dbname = "banco";

// Conexão com o banco de dados
$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
    die("Erro na conexão com o banco de dados: " . $conn->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    if (isset($_POST['confirmar_pedido'])) {
        $id = $_POST['id'];

        // Consulta SQL para selecionar os dados do pedido com base no ID
        $sql = "SELECT * FROM forms WHERE id = $id";

        // Executa a consulta
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Obtém os dados do pedido
            $row = $result->fetch_assoc();

            // Armazena os dados em variáveis
            $nome = $row["nome"];
            $ddd = $row["ddd"];
            $telefone = $row["telefone"];
            $endereco = $row["endereco"];
            $cep = $row["cep"];
            $entrega = $row["entrega"];
            $pagamento = $row["pagamento"];
            $pizza = $row["nome_pizza"];
            $valor = $row["valor"];
            $codigo = $row["codigo"];

            // Insere os dados na tabela "forms_confirmados"
            $mudar = "INSERT INTO forms_confirmados (nome, ddd, telefone, endereco, cep, entrega, pagamento, nome_pizza, valor, codigo)
                  VALUES ('$nome', '$ddd', '$telefone', '$endereco', '$cep', '$entrega', '$pagamento', '$pizza', '$valor', '$codigo')";

            if ($conn->query($mudar) === TRUE) {
                // Exclui os dados da tabela "forms" com base no ID
                $excluir = "DELETE FROM forms WHERE id = $id";
                $conn->query($excluir);?>

                <div class="modal fade show d-block" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog">
                        <div class="modal-content">
                        <div class="modal-header">
                            <h1 class="modal-title fs-5" id="exampleModalLabel">Mensagem</h1>
                            <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                        </div>
                        <div class="modal-body">
                            Pedido confirmado com sucesso!
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-primary fechar">Fechar</button>
                        </div>
                        </div>
                    </div>
                </div>


            <?php } else {
                echo "Erro ao confirmar o pedido: " . $conn->error;
            }
        } else {
            echo "";
        }
    }
}

// Consulta SQL para obter todos os pedidos da tabela "forms"
$sql = "SELECT * FROM forms";
$result = $conn->query($sql);

// Fecha a conexão com o banco de dados
$conn->close();
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Sistema Pizzaria Madri - Acompanhamento de Pedidos</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css"
          rel="stylesheet" integrity="sha384-9ndCyUaIbzAi2FUVXJi0CjmCapSmO7SnpJef0486qhLnuZ2cdeRhO02iuK6FUUVM"
          crossorigin="anonymous">
    <link rel="shortcut icon" href="img/favicon.ico" type="image/x-icon">

    <style>
        .text-primary {
            color: #F28705 !important;
        }

        .bg-primary {
            background: #F28705 !important;
        }

        .btn-primary {
            background: #F28705 !important;
            border-color: #F28705 !important;
            border-radius: 30px !important;
        }
    </style>
</head>
<body>

<section class="position-absolute start-0 left-0 ps-5 d-none d-md-block">
    <button type="button" class="btn btn-primary rounded" onClick="window.location.reload()">Atualizar Pedidos
    </button>
</section>

<section class="position-absolute end-0 right-0 pe-5 d-none d-md-block">
    <img src="img/pizzaria-logo_fulllaranja.png" alt="Logo Pizzaria" class="img-fluid" width="200">
</section>

<section class="mt-md-5">
    <div class="container py-5">
        <div class="row mb-3">

            <div class="d-block d-md-none text-center">
                <button type="button" class="btn btn-primary rounded" onClick="window.location.reload()">Atualizar
                    Pedidos
                </button>
            </div>

            <div class="d-block d-md-none text-center my-3">
                <img src="img/pizzaria-logo_fulllaranja.png" alt="Logo Pizzaria" class="img-fluid" width="200">
            </div>

            <div class="col text-center">
                <h1 class="text-primary">Sistema de Pedidos</h1>
            </div>

        </div>
    </div>
</section>

<section>
    <div class="container mb-5">
        <div class="row gy-5 px-3 justify-content-evenly">
            <?php
            if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                    ?>
                    <div class="col-lg-4 ">
                        <div class="bg-primary rounded p-4 fs-5 text-white">

                            <h5 class="text-center fw-bold fs-3 mb-3">Dados do cliente: <?php echo $id = $row["id"]; ?>
                            </h5>
                            <div class="small text-center mb-2">
                                <?php echo $data_cadastro = $row["data_cadastro"]; ?>
                            </div>

                            <div class="row gy-2">
                                <div>
                                    <span>Código do Pedido:</span>
                                    <?php echo $codigo = $row["codigo"]; ?>
                                </div>
                                <div>
                                    <span>Nome do Cliente:</span>
                                    <?php echo $nome = $row["nome"]; ?>
                                </div>
                                <div>
                                    <span>Telefone:</span>
                                    <?php echo $ddd = $row["ddd"]; ?>
                                    <?php echo $telefone = $row["telefone"]; ?>
                                </div>
                                <div>
                                    <span>Endereço:</span>
                                    <?php echo $endereco = $row["endereco"]; ?>
                                </div>
                                <div>
                                    <span>CEP:</span>
                                    <?php echo $cep = $row["cep"]; ?>
                                </div>
                                <div>
                                    <span>Entrega:</span>
                                    <?php echo $entrega = $row["entrega"]; ?>
                                </div>
                                <div>
                                    <span>Forma de Pagamento:</span>
                                    <?php echo $pagamento = $row["pagamento"]; ?>
                                </div>
                                <div>
                                    <span>Nome da Pizza:</span>
                                    <?php echo $pizza = $row["nome_pizza"]; ?>
                                </div>
                                <div>
                                    <span>Valor da Pizza:</span>
                                    <?php echo $valor = $row["valor"]; ?>
                                </div>
                            </div>

                            <div class="text-center mt-4">
                                <form method="POST">
                                    <input type="hidden" name="id" value="<?php echo $id; ?>">
                                    <button type="submit" name="confirmar_pedido" class="btn btn-success rounded-5">Confirmar
                                        Pedido
                                    </button>
                                </form>
                            </div>

                        </div>
                    </div>
                    <?php
                }
            } else {
                echo "Nenhum resultado encontrado.";
            }
            ?>
        </div>
    </div>
</section>

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"
        integrity="sha384-geWF76RCwLtnZ8qwWowPQNguL3RmwHVBC9FhGdlKrxdiJJigb/j/68SIy3Te4Bkz"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.8/dist/umd/popper.min.js"
        integrity="sha384-I7E8VVD/ismYTF4hNIPjVp/Zjvgyol6VFvRkX/vR+Vc4jQkC+hVqc2pM8ODewa9r"
        crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"
        integrity="sha384-fbbOQedDUMZZ5KreZpsbe1LCZPVmfTnH7ois6mU1QK+m14rQ1l2bGBq41eYeM/fS"
        crossorigin="anonymous"></script>
<script>
    var fechar = document.querySelector(".modal .fechar");
    fechar.addEventListener('click', function() {
        var modal = document.querySelector(".modal")

        modal.classList.remove("d-block")
    })
</script>
</body>
</html>
