<?php
$severname = "localhost";
$username  = "root";
$password = "root";
$database = "dt_crud";
 
//criação de conexão
 
$connection = new mysqli($severname, $username, $password, $database);
 
$id = "";
$name = "";
$email = "";
$phone = "";
$address = "";
 
$errorMenssage = "";
$successMessage = "";
 
if ($_SERVER['REQUEST_METHOD'] == 'GET') {
    //GET MOSTRA OS DADOS DO
    if (!isset($_GET["id"])) {
        header("location:index.php");
        exit;
    }
    $id = $_GET["id"];
 
    //LER A LINHA DO CLIENTE SELECIONADO NO MYSQLI
 
    $sql = "SELECT * FROM clients WHERE id=$id";
    $result = $connection->query($sql);
    $row = $result->fetch_assoc();
 
 
    if (!$row) {
        header("location: index.php");
        exit;
    }
    $name  = $row["name"];
    $email = $row["email"];
    $phone = $row["phone"];
    $address = $row["address"];
} else {
    //POST: ATUALIZAR OS DADOS DOS CLIENTES
    $id = $_POST["id"];
    $name  = $_POST["name"];
    $email = $_POST["email"];
    $phone = $_POST["phone"];
    $address = $_POST["address"];
    do {
        if (empty($name) || empty($email) || empty($phone) || empty($address)) {
            $errorMenssage = "All the fields are required";
            break;
        }
        $sql = "UPDATE clients " .
            "SET name = '$name', email = '$email', phone = '$phone',
            address = '$address'" . "WHERE id =$id";
 
        $result = $connection->query($sql);
 
        if (!$result) {
            $errorMessage = "Invalid query:" . $connection->error;
            break;
        }
 
        $sucessMessage = "Client added correctly";
 
        header("location: index.php");
        exit;
    } while (true);
}
 
?>
<!DOCTYPE html>
<html lang="pt-br">
 
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My shop</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.7/dist/js/bootstrap.bundle.min.js"></script>
</head>
 
<body>
    <div class="container my-5">
        <h2>New Client</h2>
        <?php
        if (!empty($errorMenssage)) {
            echo "<div class='alert alert-warning alert-dismissible fade show' role='alert'>
            <strong>$errorMenssage</strong>
            <button type='button' class='btn-close' data-bs-dismiss='alert' arial-label='close'>
            </button>
            </div>
            ";
        }
        ?>
        <form method="post">
            <input type="hidden" name="id" value="<?php echo $id; ?>">
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Name</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="name" value="<?php echo $name; ?>">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Email</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="email" value="">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Phone</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="phone" value="">
                </div>
            </div>
            <div class="row mb-3">
                <label class="col-sm-3 col-form-label">Address</label>
                <div class="col-sm-6">
                    <input type="text" class="form-control" name="address" value="">
                </div>
            </div>
            <?php
            if (!empty($successMessage)) {
                echo "
                    <div class='row mb-3'>
                        <div class='offset-sm-3 col-sm-6'>
                            <div class='alert alert-warning alert-dissmissble fade show' role='alert'>
                                 <strong>$successMessage</strong>
                                    <button type='button' class='btn-close' data-bs-dismiss='alert' arial label ='Close'></button>
                        </div>
                    </div>
                </div>
                       ";
            }
            ?>
            <div class="row mb-3">
                <div class="offset-sm-3 col-sm-3 d-grid">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
                <div class="col-sm-3 d-grid">
                    <a class="btn btn-outline-primary" href="index.php" role="button">Cancel</a>
                </div>
            </div>
        </form>
    </div>
</body>
 
</html>
 