
<?php
require_once ('views/usuario/header.php');

//require_once ('views/usuario/navbarprincipal.php');
//require_once ('views/usuario/footer.php');
$server = 'localhost';
$username = 'root';
$password = '';
$database = 'proyecto';
try {
    $conn = new PDO("mysql:host=$server;dbname=$database;",$username,$password);

} catch (PDOException $e) {
    die('conected failed: '.$e->getMessage());  
    
}
//$cedula=$_POST['cedula'];
//$clave= $_POST['clave'];

if(!empty($_POST['cedula']) && !empty($_POST['clave'])){
    $records = $conn->prepare('SELECT id, cedula, clave FROM tbl_usuarios WHERE cedula=:cedula and clave=:clave');
    $records ->bindParam(':cedula', $_POST['cedula']);
    $records->bindParam(':clave', $_POST['clave']);

    $records->execute();
    $results = $records->fetch(PDO::FETCH_ASSOC);
    $message= '';
    if (isset($records)) {
        
    
    //if (count($results) > 0 && password_verify($_POST['clave'], $results['clave'])) {
     //   $_SESSION['user_id'] = $results['id'];
        header('Location: ./views/menu.php');
    
    } else{
        $message = 'Las credenciales ingresadas son invalidas';
    
    }
    //} 
}
?>


<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <link rel="stylesheet" href="css/style3.css">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@4.5.2/dist/sandstone/bootstrap.min.css">
        <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <link href="https://use.fontawesome.com/releases/v5.9.0/css/all.css" rel="stylesheet">

<!-- Latest compiled JavaScript -->
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.1/js/bootstrap.min.js"></script>



        <title>Inicio de sesión</title>
    </head>
 
    <?php
    require_once ('views/usuario/inicio.php');
    ?>
    <?php
if (!empty($message)) : ?>
<p><?= $message?></p>
<?php endif;?>    
        <div class=" card border-info mb-3 mt-5 mx-auto col-md-6" >
            <div class="card-header">Inicio de Sesión</div>
            <div class="card-body">
                <h5 class="card-title">Digite sus datos </h5>

                
    <form action="index.php" method="POST">
    <input type="text" class="form-control" id="cedula" 
                               placeholder="1-12345678" pattern="[0-9]{1}-[0-9]{8}" 
                            
                               name="cedula" required name="cedula" placeholder="Cedula">
<br>
    <input type="password" class="form-control" name="clave" placeholder="contraseña">
    <br>
    <input type="submit" style="" class="btn btn-info btn-lg btn-block" value="Enviar">
    <p class="float-right">No posee con una cuenta 
                        <a href="./views/registro.php">Cree una</a></p>
    </form>
            </div>
            <div class="card-footer">
             2022
            </div>
        </div>
        <BR></BR>
        <BR></BR>
        <BR></BR>
        <BR></BR>
        <BR></BR>
        <footer>
    <tr>
    <td style="color: Black;"><a href=""> SOPORTE</a></td>
    <td> <a href="">  - AVISO DE PRIVACIDAD</a></td>
    <td> <a href=""> - TÉRMINOS DE USO</a></td>
    <td> <a href="">- PREFERENCIAS DE COOKIES</a> </td>
   
    </tr>
    <tr> - © 2020 </tr>
    
    
    
    
    </footer>

 
 
</html>




