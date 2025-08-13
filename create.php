<?php
$servername = "localhost";
$username = "root";
$password = "root";
$database = "dt_crud";

//Criação da conexão

$connection = new mysqli($servername, $username, $password, $database);

$name = "";
$email = "";
$phone = "";
$address = "";

$errorMessage = "";
$sucessMessage = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $name = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];

    do {
        if (empty($name) || empty($email) || empty($phone) || empty($address)) {
            $errorMessage = "Todos os campos precisam estar preenchidos";
            break;
        }
        // Criar novo cliente no banco de dados
      $sql = "INSERT INTO clients(name, email, phone, address)" .
       " VALUES ('$name', '$email', '$phone', '$address')";


        $result = $connection->query($sql);

        if (!$result) {
            die("Invalid query: " . $connection->error);
            break;
        }


        $name = "";
        $email = "";
        $phone = "";
        $address = "";

        $sucessMessage = "Cliente adicionado com sucesso";

        header("location: index.php");
        exit;
    } while (false);
}
?>
<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Minha Loja</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <div class="container my-5">
        <h2>Novo Cliente</h2>
        <?php
        if (!empty($errorMessage)) {
            echo "<div class = 'alert alert-warning alert-dismissble fade show' role ='alert';
                <strong>$errorMessage</strong>
                <button type = 'button' class ='btn-close' data-bs-dismiss='alert' aria-label ='close'></button>
                </div>
                 ";
        }
        ?>
        <form method="post">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Nome</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="name" value="<?php echo $name; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="email" value="<?php echo $email; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Telefone</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="phone" value="<?php echo $phone; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Endereço</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="address" value="<?php echo $address; ?>">
                </div>
            </div>
            <?php
            if (!empty($sucessMessage)) {
                echo "
                <div class = 'row mb-3'>
                    <div class = 'offset-sm-3 col-sm-6'>
                        <div class = 'alert alert-warning alert-dismissble fade-show' role = 'alert'>
                            <strong> $sucessMessage </strong>
                                <button type = 'button' class = 'btn-close' data-bs-dismiss = 'alert' aria label ='Close'></button>             
                             </div>
                        </div>
                    </div>
                ";
            }
            ?>


            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Registrar</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="index.php" role="button">Cancelar</a>
                </div>
            </div>

        </form>

    </div>
</body>

</html>