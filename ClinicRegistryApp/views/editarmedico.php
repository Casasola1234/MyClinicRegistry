<?php
// Include config file
require_once "./conexion.php";

// Definir variables e inicializar con valores vacíos
$nombre = $direccion = $email = $telefono = $especialidad="";
$nombre_err = $direccion_err = $email_err = $telefono_err = $especialidad_err= "";


// Procesando los datos del formulario cuando se envía el formulario
if (isset($_POST["id"]) && !empty($_POST["id"])) {
    // Obtener valor de entrada oculto
    $id = $_POST["id"];


    $input_nombre = trim($_POST["nombre"]);
    if (empty($input_nombre)) {
        $nombre_err = "Por favor ingrese un nombre";
    } elseif (!filter_var($input_nombre, FILTER_VALIDATE_REGEXP, array("options" => array("regexp" => "/^[a-zA-Z\s]+$/")))) {
        $nombre_err = "ingrese un valor valido";
    } else {
        $nombre = $input_nombre;
    }
    $input_direccion = trim($_POST["direccion"]);
    if (empty($input_direccion)) {
        $direccion = "Please enter a name.";
    } else {
        $direccion = $input_direccion;
    }
    $input_email = trim($_POST["email"]);
    if (empty($input_email)) {
        $email = "Please enter a name.";
    } else {
        $email = $input_email;
    }
    $input_telefono = trim($_POST["telefono"]);
    if (empty($input_telefono)) {
        $telefono = "Please enter a name.";
    } else {
        $telefono = $input_telefono;
    }
    $input_especialidad = trim($_POST["especialidad"]);
    if (empty($input_especialidad)) {
        $especialidad = "Please enter a name.";
    } else {
        $especialidad = $input_especialidad;
    }


    $sql = "UPDATE tbl_medicos SET nombre=?, direccion=?, email=?, telefono=?, especialidad=? WHERE id=?";
    if (empty($nombre_err) && empty($direccion_err) && empty($email_err) && empty($telefono_err)&& empty($especialidad_err)) {

        $sql = "UPDATE tbl_medicos SET nombre=?,direccion=?,email=?,telefono=?,especialidad=? WHERE id=?";

        if ($stmt = mysqli_prepare($link, $sql)) {

            mysqli_stmt_bind_param($stmt, "sssssi", $param_nombre, $param_direccion, $param_email, $param_telefono,$param_especialidad, $param_id);


            $param_nombre = $nombre;
            $param_direccion = $direccion;
            $param_email = $email;
            $param_telefono = $telefono;
            $param_especialidad = $especialidad;
            $param_id = $id;


            if (mysqli_stmt_execute($stmt)) {

                header("location: ./agregarmedico.php");
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

        $id = trim($_GET["id"]);


        $sql = "SELECT * FROM tbl_medicos WHERE id =?";
        if ($stmt = mysqli_prepare($link, $sql)) {

            mysqli_stmt_bind_param($stmt, "i", $param_id);


            $param_id = $id;


            if (mysqli_stmt_execute($stmt)) {
                $result = mysqli_stmt_get_result($stmt);

                if (mysqli_num_rows($result) == 1) {

                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);


                    $nombre = $row["nombre"];
                    $direccion = $row["direccion"];
                    $email = $row["email"];
                    $telefono = $row['telefono'];
                    $especialidad = $row['especialidad'];
                } else {

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
                        <h2 class="mt-5">Editar medico</h2>
                        <p>Por favor edite los datos y presione submit para guardar.</p>
                        <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                            <div class="row justify-content-center">   
                                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <label>Nombre</label>
                                    <input type="text" name="nombre" class="form-control <?php echo (!empty($nombre_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $nombre; ?>">
                                    <span class="invalid-feedback"><?php echo $nombre_err; ?></span>
                                </div>
                                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <label>Direccion</label>
                                    <input type="text" name="direccion" class="form-control <?php echo (!empty($direccion_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $direccion; ?>">
                                    <span class="invalid-feedback"><?php echo $direccion_err; ?></span>
                                </div>
                                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <label>Email</label>
                                    <input type="text" name="email" class="form-control <?php echo (!empty($email_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $email; ?>">
                                    <span class="invalid-feedback"><?php echo $email_err; ?></span>
                                </div> 
                                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <label>telefono</label>
                                    <input type="text" name="telefono" class="form-control <?php echo (!empty($telefono_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $telefono; ?>">
                                    <span class="invalid-feedback"><?php echo $telefono_err; ?></span>
                                </div>
                                </div>
                                <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                                    <label>Especialidad</label>
                                    <select type="text" name="especialidad" class="form-control <?php echo (!empty($especialiad_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $especialidad; ?>">
                                    <span class="invalid-feedback"><?php echo $especialidad_err; ?></span>
                                    <option value="1">Cardiologia</option>
                                    <option value="1">Psicologo</option>
                                    <option value="1">Pediatria</option>
                                    <option value="1">Urologia</option>
                                    </select>
                                </div>
                                <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                                <input type="submit" class="btn btn-primary" value="Submit">
                                <a href="agregarmedico.php" class="btn btn-secondary ml-2">Cancel</a>
                        </form>
                    </div>
                </div>        
            </div>
        </div>
    </body>
</html>
