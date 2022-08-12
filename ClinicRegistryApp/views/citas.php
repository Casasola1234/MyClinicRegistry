<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <title>Dashboard</title>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootswatch@4.5.2/dist/sandstone/bootstrap.min.css">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
        <script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
        <style>
            .wrapper{
                width: 600px;
                margin: 0 auto;
            }
            table tr td:last-child{
                width: 120px;
            }
        </style>
        <script>
            $(document).ready(function () {
                $('[data-toggle="tooltip"]').tooltip();
            });
        </script>
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
                        <div class="mt-5 mb-3 clearfix">
                            <h2 class="pull-left">Citas</h2>
                            <a href="./agregarcita.php" class="btn btn-success pull-right"><i class="fa fa-plus"></i> Añadir nueva cita</a>
                        </div>
                        <?php
                   
                        require_once "./conexion.php";
 
                        $sql = "SELECT * FROM tbl_citas";
                        if ($result = mysqli_query($link, $sql)) {
                            if (mysqli_num_rows($result) > 0) {
                                echo '<table class="table table-bordered table-striped">';
                                echo "<thead>";
                                echo "<tr>";
                                echo "<th>#</th>";
                                echo "<th>Asunto</th>";
                                echo "<th>Paciente</th>";
                                echo "<th>Medico</th>";
                                echo "<th>Fecha</th>";
                                echo "<th>Accion</th>";
                                echo "</tr>";
                                echo "</thead>";
                                echo "<tbody>";
                                while ($row = mysqli_fetch_array($result)) {
                                    echo "<tr>";
                                    echo "<td>" . $row['id'] . "</td>";
                                    echo "<td>" . $row['asunto'] . "</td>";
                                    echo "<td>" . $row['paciente'] . "</td>";
                                    echo "<td>" . $row['medico'] . "</td>";
                                    echo "<td>" . $row['fecha'] . "</td>";
                                    echo "<td>";
                                    echo '<a href="vercita.php?id=' . $row['id'] . '" class="mr-3" title="View Record" data-toggle="tooltip"><span class="fa fa-eye"></span></a>';
                                    echo '<a href="editarcita.php?id=' . $row['id'] . '" class="mr-3" title="Update Record" data-toggle="tooltip"><span class="fa fa-pencil"></span></a>';
                                    echo '<a href="deletecita.php?id=' . $row['id'] . '" title="Delete Record" data-toggle="tooltip"><span class="fa fa-trash"></span></a>';
                                    echo "</td>";
                                    echo "</tr>";
                                }
                                echo "</tbody>";
                                echo "</table>";

                              
                                mysqli_free_result($result);
                            } else {
                                echo '<div class="alert alert-danger"><em>No se encontraron registros.</em></div>';
                            }
                        } else {
                            echo "¡UPS! Algo salió mal. Por favor, inténtelo de nuevo más tarde.";
                        }

                        mysqli_close($link);
                        ?>
                    </div>
                </div>        
            </div>
        </div>
    </body>
</html>