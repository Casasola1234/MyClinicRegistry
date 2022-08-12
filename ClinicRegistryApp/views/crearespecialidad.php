<?php
// Include config file
require_once "./conexion.php";

// Definiendo variables y inicializandi con valores vacios
$especialidad = "";
$especialidad_err = "";

// Procesamiento de datos del formulario cuando se envía el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    
    $input_especialidad = trim($_POST["especialidad"]);
    if (empty($input_especialidad)) {
        $especialidad_err = "Por favor ingrese un nombre";
    } elseif (!filter_var($input_especialidad, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
        $especialidad_err = "ingrese un valor valido";
    } else {
        $especialidad = $input_especialidad;
    }
    $sql = "INSERT INTO tbl_especialidad (especialidad) VALUES (?)";
    // Verifique los errores de entrada antes de insertar en la base de datos
    if (empty($especialidad_err)) {
       // Prepare una declaración de inserción
        $sql = "INSERT INTO tbl_especialidad (especialidad) VALUES (?)";

        if ($stmt = mysqli_prepare($link, $sql)) {
             // Vincular variables a la declaración preparada como parámetros
            mysqli_stmt_bind_param($stmt, "s", $param_especialidad);
             // colocar parametros
            $param_especialidad = $especialidad;

            if (mysqli_stmt_execute($stmt)) {

                header("location: ./especialidad.php");

                exit();
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // declaracion de cierre
        mysqli_stmt_close($stmt);
    }

    // cerrando conecion
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Crear Especialidad</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@4.5.2/dist/sandstone/bootstrap.min.css">
        <style>
            .wrapper{
                width: 600px;
                margin: 0 auto;
            }
        </style>
    </head>
    <body class>
        <div class="list-group" style=" ">
        <nav class="navbar navbar-expand-lg navbar-dark bg-primary">
            <a class="navbar-brand" href="../views/menu.php"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-house-door" viewBox="0 0 16 16">
  <path d="M8.354 1.146a.5.5 0 0 0-.708 0l-6 6A.5.5 0 0 0 1.5 7.5v7a.5.5 0 0 0 .5.5h4.5a.5.5 0 0 0 .5-.5v-4h2v4a.5.5 0 0 0 .5.5H14a.5.5 0 0 0 .5-.5v-7a.5.5 0 0 0-.146-.354L13 5.793V2.5a.5.5 0 0 0-.5-.5h-1a.5.5 0 0 0-.5.5v1.293L8.354 1.146zM2.5 14V7.707l5.5-5.5 5.5 5.5V14H10v-4a.5.5 0 0 0-.5-.5h-3a.5.5 0 0 0-.5.5v4H2.5z"/>
</svg>Menu</a> 
            <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#callapsibleNavbar">
                <span class="navbar-toggler-icon"></span>
            </button> 
            <div class="collapse navbar-collapse" id="navbarColor02">
                <ul class="navbar-nav mr-auto">
                    <li class="nav-item">
                        <a class="nav-link" href="./agregarcita.php">Agregar Cita
                            <span class="sr-only">(current)</span>
                        </a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./citas.php">Citas</a>
                    </li>
                    <li class="nav-item">           
                        <a class="nav-link" href="./crearpaciente.php">Agregar Paciente</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./agregarpaciente.php">Pacientes</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./crearmedico.php">Agregar Medico</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./agregarmedico.php">Medicos</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./crearespecialidad.php">Agregar Especialidad</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./especialidad.php">Especialidades</a>
                    </li>
                    </u1>    
            </div>
        </div>
        <div class="wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="mt-5">Crear Especialidad</h2>
                        <p>Por favor ingrese los datos y presione submit para guardar.</p>
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <div class="form-group">
                                <label>Especialidad</label>
                                <input type="text" name="especialidad" class="form-control <?php echo (!empty($especialidad_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $especialidad; ?>">
                                <span class="invalid-feedback"><?php echo $especialidad_err; ?></span>
                            </div>
                            <input type="submit" class="btn btn-primary" onclick="hizoClick"value="Submit">
                            <a href="./especialidad.php" class="btn btn-secondary ml-2" onclick="hizoClick2">Cancel</a>
                        </form>
                        <script type="text/javascript">
                           function hizoClick() {
                              alert("Guardando");
                            }
                            function hizoClick2() {
                                alert("Devolviendo");
                            }
                        </script>
                    </div>
                </div>        
            </div>
        </div>
    </body>
</html>
