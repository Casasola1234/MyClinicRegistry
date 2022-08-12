<?php
if (isset($_POST["id"]) && !empty($_POST["id"])) {
    // Include config file
    require_once "./conexion.php";

    // Preparando una declaracion de eliminacion
    $sql = "DELETE FROM tbl_medicos WHERE id = ?";

    if ($stmt = mysqli_prepare($link, $sql)) {
        // Vincular variables a la declaración preparada como parámetros
        mysqli_stmt_bind_param($stmt, "i", $param_id);

        // colocando parametros
        $param_id = trim($_POST["id"]);

        // Intente ejecutar la declaración preparada
        if (mysqli_stmt_execute($stmt)) {
            // Registros eliminados con éxito. Redirigir a la página de destino
            header("location: ../views/agregarmedico.php");
            exit();
        } else {
            echo "Oops! Something went wrong. Please try again later.";
        }
    }

    // Cerrando declaracion
    mysqli_stmt_close($stmt);

    // Cerrando conecion
    mysqli_close($link);
}
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Delete Record</title>
        <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@4.5.2/dist/sandstone/bootstrap.min.css">
        <style>
            .wrapper{
                width: 600px;
                margin: 0 auto;
            }
        </style>
    </head>
    <body>
        <div class="wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="mt-5 mb-3">Delete Record</h2>
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <div class="alert alert-danger">
                                <input type="hidden" name="id" value="<?php echo trim($_GET["id"]); ?>"/>
                                <p>Are you sure you want to delete this employee record?</p>
                                <p>
                                    <input type="submit" value="Yes" class="btn btn-danger">
                                    <a href="agregarmedico.php" class="btn btn-secondary">No</a>
                                </p>
                            </div>
                        </form>
                    </div>
                </div>        
            </div>
        </div>
    </body>
</html>