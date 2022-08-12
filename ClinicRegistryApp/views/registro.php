<?php
// Include config file
require_once "./conexion.php";
 
// Define variables and initialize with empty values
$cedula = $usuario = $clave = $activo = "";
$cedula_err=$usuario_err=$clave_err=$activo_err = "";
 
// Processing form data when form is submitted
if($_SERVER["REQUEST_METHOD"] == "POST"){
    // Validate name
    $input_cedula = trim($_POST["cedula"]);
    if(empty($input_cedula)){
        $cedula = "ingrese la cedula";
    }  else{
        $cedula = $input_cedula;
    }
    
    $input_usuario = trim($_POST["usuario"]);
    if(empty($input_usuario)){
        $usuario_err = "Please enter a name.";
    } else{
        $usuario = $input_usuario;
    }
    $input_clave = trim($_POST["clave"]);
    if(empty($input_clave)){
        $clave_err = "por favor ingrese una clave.";
    
    } else{
        $clave= $input_clave;
    }
    
   // if(!empty($cedula) && !empty($usuario)&& !empty($clave)){
     //   $activo = "1";
   
    //} else{
      //  $activo= "0";
    //}
  
   
    $sql = "INSERT INTO tbl_usuarios (cedula,usuario,clave) VALUES (?, ?, ?)";
    // Check input errors before inserting in database
    if(empty($cedula_err) && empty($usuario_err) && empty($clave_err) ){
        // Prepare an insert statement
        $sql = "INSERT INTO tbl_usuarios (cedula,usuario,clave) VALUES (?, ?, ?)";
         
        if($stmt = mysqli_prepare($link, $sql)){
            // Bind variables to the prepared statement as parameters
            mysqli_stmt_bind_param($stmt, "sss", $param_cedula, $param_usuario, $param_clave);
            
            // Set parameters
            $param_cedula = $cedula;
         $param_usuario= $usuario;
          $param_clave =$clave;
           
             
            
            if(mysqli_stmt_execute($stmt)){
                
                header("location: ../index.php");
              
                exit();
            } else{
                echo "Oops! Algo salió mal";
            }
        }
         
        // Close statement
        mysqli_stmt_close($stmt);
    }
    
    // Close connection
    mysqli_close($link);
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <title>Crear paciente</title>
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@4.5.2/dist/sandstone/bootstrap.min.css">

    <style>
        .wrapper{
            width: 600px;
            margin: 0 auto;
        }
    </style>
</head>
<body>
<div class=" card border-info mb-3 mt-5 mx-auto col-md-6" >
            <div class="card-header">Registre sus datos</div>
            <div class="card-body">
                <h5 class="card-title">Registro</h5>
                    
                    <p>Por favor ingrese los datos y presione submit para guardar.</p>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                       
                    <div class="form-group">
                            <label>Cedula</label>
                            <input type="text" name="cedula" class="form-control <?php echo (!empty($cedula_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $cedula; ?>">
                            <span class="invalid-feedback"><?php echo $cedula_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>usuario</label>
                            <input type="text" name="usuario" class="form-control <?php echo (!empty($usuario_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $usuario; ?>">
                            <span class="invalid-feedback"><?php echo $usuario_err;?></span>
                        </div>
                        <div class="form-group">
                            <label>Contraseña</label>
                            <input type="password" name="clave" class="form-control <?php echo (!empty($clave_err)) ? 'is-invalid' : ''; ?>" value="<?php echo $clave; ?>">
                            <span class="invalid-feedback"><?php echo $clave_err;?></span>
                        </div>
                        
                       
                        <input type="submit" class="btn btn-primary" value="Enviar">
                        <a href="javascript:history.back()"class="btn btn-secondary ml-2">Cancelar</a>
                    </form>
                    
                </div>
            </div>        
        </div>
    </div>
</body>
</html>