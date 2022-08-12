<?php
// Verifique la existencia del parámetro id antes de seguir procesando
if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
    // Include config file
    require_once "./conexion.php";

    // Preparar una declaración de selección
    $sql = "SELECT * FROM tbl_pacientes WHERE id = ?";

    if ($stmt = mysqli_prepare($link, $sql)) {
        // Vincular variables a la declaración preparada como parámetros
        mysqli_stmt_bind_param($stmt, "i", $param_id);

        // colocando parametros
        $param_id = trim($_GET["id"]);

        // Intente ejecutar la declaración preparada
        if (mysqli_stmt_execute($stmt)) {
            $result = mysqli_stmt_get_result($stmt);

            if (mysqli_num_rows($result) == 1) {
                // Obtiene la fila de resultados como una matriz asociativa. Dado que el conjunto de resultados//
                //contiene solo una fila, no es necesario usar while loop //
                $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                // Recuperar valor de campo individual
                $nombre = $row["nombre"];
                $direccion = $row["direccion"];
                $email = $row["email"];
                $telefono = $row["telefono"];
            } else {
                echo "¡UPS! Algo salió mal. Por favor, inténtelo de nuevo más tarde.";
            }
        }


        mysqli_stmt_close($stmt);


        mysqli_close($link);
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>View Record</title>
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
                        <h1 class="mt-5 mb-3">Paciente</h1>
                        <div class="form-group">
                            <label>Nombre</label>
                            <p><b><?php echo $row["nombre"]; ?></b></p>
                        </div>
                        <div class="form-group">
                            <label>Direccion</label>
                            <p><b><?php echo $row["direccion"]; ?></b></p>
                        </div>
                        <div class="form-group">
                            <label>Email</label>
                            <p><b><?php echo $row["email"]; ?></b></p>
                        </div>
                        <div class="form-group">
                            <label>Telefono</label>
                            <p><b><?php echo $row["telefono"]; ?></b></p>
                        </div>


                        <p><a href="./agregarpaciente.php" class="btn btn-primary">volver</a></p>
                    </div>
                </div>        
            </div>
        </div>
    </body>
</html>