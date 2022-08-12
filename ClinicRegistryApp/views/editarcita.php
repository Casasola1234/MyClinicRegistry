<?php
// Include config file
require_once "./conexion.php";
 
// Definir variables e inicializar con valores vacíos
$asunto = $nota = $paciente = $medico = $fecha = $hora = $enfermedad = $sintomas = $medicamentos = $estado_listas = $estado_pago = $costos = "";
$asunto_err = $nota_err = $paciente_err = $medico_err = $fecha_err = $hora_err = $enfermedad_err = $sintomas_err = $medicamentos_err = $estado_listas_err = $estado_pago_err = $costos_err = "";

// Procesando los datos del formulario cuando se envía el formulario
if(isset($_POST["id"]) && !empty($_POST["id"])){
    // Obtener valor de entrada oculto
    $id = $_POST["id"];

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
    
    $sql = "UPDATE tbl_citas SET asunto=?, nota=?, paciente=?, medico=?, fecha=?, hora=?, enfermedad=?, sintomas=?, medicamentos=?, estado_listas=?, estado_pago=?, costos=? WHERE id=?";
    if(empty($asunto_err) && empty($nota_err) && empty($paciente_err) && empty($medico_err)&& empty($fecha_err)&& empty($hora_err)&& empty($enfermedad_err)&& empty($sintomas_err)&& empty($medicamentos_err)&& empty($estado_listas_err)&& empty($estado_pago_err)&& empty($costos_err)){
       
        $sql = "UPDATE tbl_citas SET asunto=?, nota=?, paciente=?, medico=?, fecha=?, hora=?, enfermedad=?, sintomas=?, medicamentos=?, estado_listas=?, estado_pago=?, costos=? WHERE id=?";
         
        if($stmt = mysqli_prepare($link, $sql)){
            
            mysqli_stmt_bind_param($stmt, "ssssssssssssi", $param_asunto, $param_nota, $param_paciente, $param_medico,$param_fecha,$param_hora,$param_enfermedad,$param_sintomas,$param_medicamentos,$param_estado_listas,$param_estado_pago,$param_costos, $param_id);
            
            
            $param_asunto = $asunto;
            $param_nota= $nota;
            $param_paciente =$paciente;
            $param_medico =$medico;
            $param_fecha =$fecha;
            $param_hora =$hora;
            $param_enfermedad =$enfermedad;
            $param_sintomas =$sintomas;
            $param_medicamentos =$medicamentos;
            $param_estado_listas =$estado_listas;
            $param_estado_pago =$estado_pago;
            $param_costos =$costos;
            $param_id = $id;
            
           
            if(mysqli_stmt_execute($stmt)){
             
                header("location: ./citas.php");
                exit();
            } else{
                echo "Oops! algo ah salido mal";
            }
        }
        
       
        mysqli_stmt_close($stmt);
    }
    
    
    mysqli_close($link);
} else{
    
    if(isset($_GET["id"]) && !empty(trim($_GET["id"]))){
        // Get URL parameter
        $id =  trim($_GET["id"]);
        
        
        $sql = "SELECT * FROM tbl_citas WHERE id =?";
        if($stmt = mysqli_prepare($link, $sql)){
           
            mysqli_stmt_bind_param($stmt, "i", $param_id);
            
            
            $param_id = $id;
            
            
            if(mysqli_stmt_execute($stmt)){
                $result = mysqli_stmt_get_result($stmt);
    
                if(mysqli_num_rows($result) == 1){
                   
                    $row = mysqli_fetch_array($result, MYSQLI_ASSOC);
                    
                    
                    $asunto= $row["asunto"];
                    $nota = $row["nota"];
                    $paciente = $row["paciente"];
                    $medico = $row['medico'];
                    $fecha = $row['fecha'];
                    $hora = $row['hora'];
                    $enfermedad = $row['enfermedad'];
                    $sintomas = $row['sintomas'];
                    $medicamentos = $row['medicamentos'];
                    $estado_listas = $row['estado_listas'];
                    $estado_pago = $row['estado_pago'];
                    $costos = $row['costos'];


                } else{
                   
                    header("location: ./error.php");
                    exit();
                }
                
                
            } else{
                echo "Oops! Something went wrong. Please try again later.";
            }
        }
        
        
        mysqli_stmt_close($stmt);
        
        
        mysqli_close($link);
     }  else{
        
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
                <h2 class="mt-5">Editar cita</h2>
                    <p>Por favor edite los datos y presione submit para guardar.</p>
                    <form action="<?php echo htmlspecialchars(basename($_SERVER['REQUEST_URI'])); ?>" method="post">
                        <div class="row justify-content-center">
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Asunto</label>
                            <input type="text" name="asunto" class="form-control <?php echo (!empty($asunto_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $asunto; ?>">
                            <span class="invalid-feedback"><?php echo $asunto_err;?></span>
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Nota</label>
                            <input type="text" name="nota" class="form-control <?php echo (!empty($nota_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $nota; ?>">
                            <span class="invalid-feedback"><?php echo $nota_err;?></span>
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Paciente</label>
                            <input type="text" name="paciente" class="form-control <?php echo (!empty($paciente_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $paciente; ?>">
                            <span class="invalid-feedback"><?php echo $paciente_err;?></span>
                        </div>
                        
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Medico</label>
                            <input type="text" name="medico" class="form-control <?php echo (!empty($medico_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $medico; ?>">
                            <span class="invalid-feedback"><?php echo $medico_err;?></span>
                        </div>
                         <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Paciente</label>
                            <input type="text" name="paciente" class="form-control <?php echo (!empty($paciente_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $paciente; ?>">
                            <span class="invalid-feedback"><?php echo $paciente_err;?></span>
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Fecha</label>
                            <input type="text" name="fecha" class="form-control <?php echo (!empty($fecha_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $fecha; ?>">
                            <span class="invalid-feedback"><?php echo $fecha_err;?></span>
                        </div>
                         <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Hora</label>
                            <input type="text" name="hora" class="form-control <?php echo (!empty($hora_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $hora; ?>">
                            <span class="invalid-feedback"><?php echo $hora_err;?></span>
                        </div>
                         <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Enfermedad</label>
                            <input type="text" name="enfermedad" class="form-control <?php echo (!empty($enfermedad_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $enfermedad; ?>">
                            <span class="invalid-feedback"><?php echo $enfermedad_err;?></span>
                        </div>
                         <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Sintomas</label>
                            <input type="text" name="sintomas" class="form-control <?php echo (!empty($sintomas_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $sintomas; ?>">
                            <span class="invalid-feedback"><?php echo $sintomas_err;?></span>
                        </div>
                         <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Medicamentos</label>
                            <input type="text" name="medicamentos" class="form-control <?php echo (!empty($medicamentos_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $medicamentos; ?>">
                            <span class="invalid-feedback"><?php echo $medicamentos_err;?></span>
                        </div>
                         <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Estado de listas</label>
                            <input type="text" name="estado_listas" class="form-control <?php echo (!empty($estado_listas_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $estado_listas; ?>">
                            <span class="invalid-feedback"><?php echo $estado_listas_err;?></span>
                        </div>
                         <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Estado del pago</label>
                            <input type="text" name="estado_pago" class="form-control <?php echo (!empty($estado_pago_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $estado_pago; ?>">
                            <span class="invalid-feedback"><?php echo $estado_pago_err;?></span>
                        </div>
                         <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">
                            <label>Costos</label>
                            <input type="text" name="costos" class="form-control <?php echo (!empty($costos_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $costos; ?>">
                            <span class="invalid-feedback"><?php echo $costos_err;?></span>
                        </div>
                        <div class="form-group col-lg-6 col-md-6 col-sm-6 col-xs-12">  
                        <input type="hidden" name="id" value="<?php echo $id; ?>"/>
                        <input type="submit" class="btn btn-primary" value="Submit">
                        <a href="citas.php" class="btn btn-secondary ml-2">Cancel</a>
                        </div>
                    </form>
                </div>
            </div>        
        </div>
    </div>
</body>
</html>
