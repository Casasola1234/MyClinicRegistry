<<?php
// Include config file
require_once "./conexion.php";

// Definir variables e inicializar con valores vacíos
$especialidad = "";
$especialidad_err = "";


// Procesando los datos del formulario cuando se envía el formulario
if (isset($_POST["id"]) && !empty($_POST["id"])) {
    // Obtener valor de entrada oculto
    $id = $_POST["id"];


    $input_especialidad = trim($_POST["especialidad"]);
    if (empty($input_especialidad)) {
        $especialidad_err = "Por favor ingrese un nombre";
    } elseif (!filter_var($input_especialidad, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
        $especialidad_err = "ingrese un valor valido";
    } else {
        $especialidad = $input_especialidad;
    }

    $sql = "UPDATE tbl_especialidad SET especialidad=? WHERE id=?";
    if (empty($especialidad_err)) {

        $sql = "UPDATE tbl_especialidad SET especialidad=? WHERE id=?";

        if ($stmt = mysqli_prepare($link, $sql)) {

            mysqli_stmt_bind_param($stmt, "si", $param_especialidad, $param_id);


            $param_especialidad = $especialidad;
            $param_id = $id;

            if (mysqli_stmt_execute($stmt)) {

                header("location: ./especialidad.php");
                exit();
            } else {
                echo "Oops! algo ah salido mal";
            }
        }


        mysqli_stmt_close($stmt);
    }


    mysqli_close($link);
} else {

    if (isset($_GET["id"]) && !empty(trim($_GET["id"]))) {
        // Get URL parameter
        $id = trim($_GET["id"]);

        // Prepare a select statement
        $sql = "SELECT * FROM tbl_especialidad WHERE id =?";
        if ($stmt = mysqli_prepare($link, $sql)) {

            mysqli_stmt_bind_param($stmt, "i", $param_id);


            $param_id = $id;


            if (mysqli_stmt_execute($stmt)) {
                $result = mysqli_stmt_get_result($stmt);

                if (mysqli_num_rows($result) == 1) {

                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);

                    $nombre = $row["especialidad"];
                } else {
                    // URL doesn't contain valid id. Redirect to error page
                    header("location: ./error.php");
                    exit();
                }
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }


        mysqli_stmt_close($stmt);


        mysqli_close($link);
    } else {
        // URL doesn't contain id parameter. Redirect to error page
        header("location: error.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Editar paciente</title>
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
                        <h2 class="mt-5">Editar especialidad</h2>
                        <p>Por favor edite los datos y presione submit para guardar.</p>
                        <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                            <div class="form-group">
                                <label>especialidad</label>
                                <input type="text" name="especialidad" class="form-control <?php echo (!empty($especialidad_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $especialidad; ?>">
                                <span class="invalid-feedback"><?php echo $especialidad_err; ?></span>
                            </div>
                            <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                            <input type="submit" class="btn btn-primary" value="Submit">
                            <a href="especialidad.php" class="btn btn-secondary ml-2">Cancel</a>
                        </form>
                    </div>
                </div>        
            </div>
        </div>
    </body>
</html>
