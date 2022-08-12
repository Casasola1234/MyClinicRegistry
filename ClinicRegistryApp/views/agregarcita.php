<?php
// Include config file
require_once "./conexion.php";

// Definiendo variables y inicializandi con valores vacios
$asunto = $nota = $paciente = $medico = $fecha = $hora = $enfermedad = $sintomas = $medicamentos = $estado_listas = $estado_pago = $costos = "";
$asunto_err = $nota_err = $paciente_err = $medico_err = $fecha_err = $hora_err = $enfermedad_err = $sintomas_err = $medicamentos_err = $estado_listas_err = $estado_pago_err = $costos_err = "";

// Procesamiento de datos del formulario cuando se envía el formulario
if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $input_asunto = trim($_POST["asunto"]);
    if (empty($input_asunto)) {
        $asunto = "Please enter a name.";
    } elseif (!filter_var($input_asunto, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
        $asunto_err = "Please enter a valid name.";
    } else {
        $asunto = $input_asunto;
    }

    $input_nota = trim($_POST["nota"]);
    if (empty($input_nota)) {
        $nota = "Please enter a name.";
    } else {
        $nota = $input_nota;
    }
    $input_paciente = trim($_POST["paciente"]);
    if (empty($input_paciente)) {
        $paciente = "Please enter a name.";
    } else {
        $paciente = $input_paciente;
    }
    $input_medico = trim($_POST["medico"]);
    if (empty($input_medico)) {
        $medico = "Please enter a name.";
    } else {
        $medico = $input_medico;
    }
    $input_fecha = trim($_POST["fecha"]);
    if (empty($input_fecha)) {
        $fecha = "Please enter a name.";
    } else {
        $fecha = $input_fecha;
    }
    $input_hora = trim($_POST["hora"]);
    if (empty($input_hora)) {
        $hora = "Please enter a name.";
    } else {
        $hora = $input_hora;
    }
    $input_enfermedad = trim($_POST["enfermedad"]);
    if (empty($input_enfermedad)) {
        $enfermedad = "Please enter a name.";
    } else {
        $enfermedad = $input_enfermedad;
    }
    $input_sintomas = trim($_POST["sintomas"]);
    if (empty($input_sintomas)) {
        $sintomas = "Please enter a name.";
    } else {
        $sintomas = $input_sintomas;
    }
    $input_medicamentos = trim($_POST["medicamentos"]);
    if (empty($input_medicamentos)) {
        $medicamentos = "Please enter a name.";
    } else {
        $medicamentos = $input_medicamentos;
    }
    $input_estado_listas = trim($_POST["estado_listas"]);
    if (empty($input_estado_listas)) {
        $estado_listas = "Please enter a name.";
    } else {
        $estado_listas = $input_estado_listas;
    }
    $input_estado_pago = trim($_POST["estado_pago"]);
    if (empty($input_estado_pago)) {
        $estado_pago = "Please enter a name.";
    } else {
        $estado_pago = $input_estado_pago;
    }
    $input_costos = trim($_POST["costos"]);
    if (empty($input_costos)) {
        $costos = "Please enter a name.";
    } else {
        $costos = $input_costos;
    }


    $sql = "INSERT INTO tbl_citas (asunto,nota,paciente,medico,fecha,hora,enfermedad,sintomas,medicamentos,estado_listas,estado_pago,costos) VALUES (?, ?, ?, ?,?,?,?,?,?,?,?,?)";
    // Verifique los errores de entrada antes de insertar en la base de datos
    if (empty($asunto_err) && empty($nota_err) && empty($paciente_err) && empty($medico_err) && empty($fecha_err) && empty($hora_err) && empty($enfermedad_err) && empty($sintomas_err) && empty($medicamentos_err) && empty($estado_listas_err) && empty($estado_pago_err) && empty($costos_err)) {
        // Prepare una declaración de inserción
        $sql = "INSERT INTO tbl_citas (asunto,nota,paciente,medico,fecha,hora,enfermedad,sintomas,medicamentos,estado_listas,estado_pago,costos) VALUES (?, ?, ?, ?,?,?,?,?,?,?,?,?)";

        if ($stmt = mysqli_prepare($link, $sql)) {
            // Vincular variables a la declaración preparada como parámetros
            mysqli_stmt_bind_param($stmt, "ssssssssssss", $param_asunto, $param_nota, $param_paciente, $param_medico, $param_fecha, $param_hora, $param_enfermedad, $param_sintomas, $param_medicamentos, $param_estado_listas, $param_estado_pago, $param_costos);

            // colocar parametros
            $param_asunto = $asunto;
            $param_nota = $nota;
            $param_paciente = $paciente;
            $param_medico = $medico;
            $param_fecha = $fecha;
            $param_hora = $hora;
            $param_enfermedad = $enfermedad;
            $param_sintomas = $sintomas;
            $param_medicamentos = $medicamentos;
            $param_estado_listas = $estado_listas;
            $param_estado_pago = $estado_pago;
            $param_costos = $costos;

            if (mysqli_stmt_execute($stmt)) {

                header("location: ./agregarcita.php");

                exit();
            } else {
                echo "Oops! Something went wrong. Please try again later.";
            }
        }

        // declaracion de cierre
        mysqli_stmt_close($stmt);
    }

    // Cerrando conecion
    mysqli_close($link);
}
?>

<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Agregar cita</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@4.5.2/dist/sandstone/bootstrap.min.css">
       
        <style>
            .wrapper{
                width: 600px;
                margin: 0 auto;
            }
        </style>
    </head>
    <body>
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
        </nav> 
        <div class="wrapper">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-12">
                        <h2 class="mt-5">Crear cita</h2>
                        <p>Por favor ingrese los datos y presione submit para guardar.</p>
                        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                            <div class="row justify-content-center">
                                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <label>Asunto:</label>
                                    <input type="text" name="asunto" class="form-control <?php echo (!empty($asunto_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $asunto; ?>">
                                    <span class="invalid-feedback"><?php echo $asunto_err; ?></span>
                                </div>
                                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <label>Nota:</label>
                                    <input type="text" name="nota" class="form-control <?php echo (!empty($nota_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $nota; ?>">
                                    <span class="invalid-feedback"><?php echo $nota_err; ?></span>
                                </div>
                                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <label>Paciente:</label>
                                    <input type="text" name="paciente" class="form-control <?php echo (!empty($paciente_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $paciente; ?>">
                                    <span class="invalid-feedback"><?php echo $paciente_err; ?></span>
                                </div>

                                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <label>Medico:</label>
                                    <select type="text" name="medico" class="form-control <?php echo (!empty($medico_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $medico; ?>">
                                    <span class="invalid-feedback"><?php echo $medico_err; ?></span>
                                    <option value="1">Jose Martinez</option>
                                    <option value="1">Pablo Arias</option>
                                    <option value="1">Miguel Ortiz</option>
                                    <option value="1">Alejandro Castro</option>
                                    </select>
                                </div>
                                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <label>Fecha:</label>
                                    <input type="date" name="fecha" class="form-control <?php echo (!empty($fecha_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $fecha; ?>">
                                    <span class="invalid-feedback"><?php echo $fecha_err; ?></span>
                                </div>
                                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <label>Hora:</label>
                                    <input type="time" name="hora" class="form-control <?php echo (!empty($hora_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $hora; ?>">
                                    <span class="invalid-feedback"><?php echo $hora_err; ?></span>
                                </div>
                                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <label>Enfermedad:</label>
                                    <input type="text" name="enfermedad" class="form-control <?php echo (!empty($enfermedad_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $enfermedad; ?>">
                                    <span class="invalid-feedback"><?php echo $enfermedad_err; ?></span>
                                </div>
                                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <label>Sintomas:</label>
                                    <input type="text" name="sintomas" class="form-control <?php echo (!empty($sintomas_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $sintomas; ?>">
                                    <span class="invalid-feedback"><?php echo $sintomas_err; ?></span>
                                </div>
                                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <label>Medicamentos:</label>
                                    <input type="text" name="medicamentos" class="form-control <?php echo (!empty($medicamentos_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $medicamentos; ?>">
                                    <span class="invalid-feedback"><?php echo $medicamentos_err; ?></span>
                                </div>
                                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <label>Estado de listas:</label>
                                    <select type="text" name="estado_listas" class="form-control <?php echo (!empty($estado_listas_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $estado_listas; ?>">
                                    <span class="invalid-feedback"><?php echo $estado_listas_err; ?></span>
                                    <option value="1">Pendiente</option>
                                    <option value="1">Aplicada</option>
                                    <option value="1">No Asistió</option>
                                    <option value="1">Cancelado</option>
                                    </select>
                                </div>
                                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <label>Estado del pago:</label>
                                    <select type="text" name="estado_pago" class="form-control <?php echo (!empty($estado_pago_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $estado_pago; ?>">
                                    <span class="invalid-feedback"><?php echo $estado_pago_err; ?></span>
                                    <option value="1">Pendiente</option>
                                    <option value="1">Pagado</option>
                                    <option value="1">Anulado</option>
                                    </select> 
                                </div>
                                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <label>Costos:</label>
                                    <input type="text" name="costos" class="form-control <?php echo (!empty($costos_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $costos; ?>">
                                    <span class="invalid-feedback"><?php echo $costos_err; ?></span>
                                </div>
                                <input type="submit" class="btn btn-primary" onclick="hizoClick" value="Submit">
                                <a href="./citas.php" class="btn btn-secondary ml-2" onclick="hizoClick2">Cancel</a>
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
