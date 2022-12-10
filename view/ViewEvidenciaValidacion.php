<?php
include '../model/Evidencia.php';
include '../controller/DB.php';
include '../controller/ValidadorController.php';

session_start();

if (!$_SESSION['activeSesion']) header("Location: ../index.php");
$Verificar='';
if (isset($_POST['Verificar'])) $Verificar = $_POST['Verificar'];

$administrador = false;
$validate = false;
$verificate = false;
$administrativo = false;

if (isset($_SESSION['roles'])){
    foreach ($_SESSION['roles'] as $rol){
        if($rol == 'Administrador'){
            $administrador = true;
        }else if($rol =='Verificador'){
            $validate = true;
        }else if ($rol=='Validador'){
            $verificate = true;
        }else if($rol=='Administrativo'){
            $administrativo = true;
        }
    }  
}

if($Verificar){
    $controlador=new ValidadorController();
    $controlador->Validador($Verificar);
}
?>

<!DOCTYPE html>
<html lang="es">

<head>
    <title>Evidencias verificadas y validadas</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/99291d97ef.js" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script>
    function llenarModal_actualizar(datos) {
        console.log(datos);
        d = datos.split('||');
        $("#ID_EVIDENCIA2").val(d[0]);
        $("#TITULO2").val(d[1]);
        $("#DESCRIPCIÓN2").val(d[2]);
        $("#TIPO2").val(d[3]);
        $("#TIPO_ARCHIVO2").val(d[4]);
        $("#FECHA_CREACION_EVIDENCIA2").val(d[5]);
        $("#FECHA_REGISTRO_EVIDENCIA2").val(d[6]);
        $("#AUTORES2").val(d[7]);
        $("#OBSERVACION2").val(d[8]);
        $("#ID_LUGAR_GEOGRAFICO2").val(d[9]);
        $("#ESTADO2").val(d[10]);
    }
    </script>
</head>

<body>
<nav class="navbar navbar-expand-lg navbar-dark bg-dark" style="background-color: #055160 !important;">
        <div class="container-fluid">
            <a class="navbar-brand" href="#">SISEVID</a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
                aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="collapse navbar-collapse" id="navbarNav">
                <ul class="navbar-nav">
                <?php if ($administrador){ ?>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="./ViewEvidencia.php">Evidencias
                                registradas </a>
                        </li>
                    <?php }?>
                    <?php if ($administrador || $verificate){ ?>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="./ViewEvidenciaVerificacion.php">Evidencias
                                verificadas</a>
                        </li>
                    <?php }?>
                    <?php if ($administrador || $validate){ ?>
                        <li class="nav-item">
                            <a class="nav-link" aria-current="page" href="./ViewEvidenciaValidacion.php">Evidencias
                                verificadas y validadas</a>
                        </li>
                    <?php }?>
                    <?php if ($administrador ){ ?>
                        <li class="nav-item">
                            <a class="nav-link" href="./Autores.php">Autores</a>
                        </li>
                    <?php }?>
                    <?php if ($administrador){ ?>
                        <li class="nav-item">
                            <a class="nav-link" href="./Register.php">Usuarios</a>
                        </li>
                    <?php }?>

                    <li class="nav-item dropdown" style="position: absolute;right: 80px;">
                        <a class="nav-link active dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user"></i>
                            <?php echo $_SESSION['USER']; ?>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="./CerrarSession.php">Cerrar session</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container-fluid p-5 text-dark text-center">
        <h1>Listado de evidencias verificadas</h1>
    </div>

    <div class="container">
        <table class="table table-striped" style="vertical-align: initial;">
            <thead style="background: #055160;color: white;">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Titulo</th>
                    <th scope="col">Descripcion</th>
                    <th scope="col">Tipo</th>
                    <th scope="col">Tipo archivo</th>
                    <th scope="col">Autores</th>
                    <th scope="col">Acción</th>
                </tr>
            </thead>
            <?php 
                $mysqli = new mysqli("localhost","root","","SISEVID");
                if ($mysqli -> connect_errno) {
                    echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
                    exit();
                }
                $sql = "SELECT * FROM evidencia e INNER JOIN evidencia_detalle ed ON ed.ID_EVIDENCIA=e.ID_EVIDENCIA WHERE ed.ESTADO='2' AND ed.ACTIVO='S'";
                $resultado=$mysqli->query($sql);
                while($row = $resultado->fetch_array()){
                    $datos=$row[0]."||".
                    $row[1]."||".
                    $row[2]."||".
                    $row[3]."||".
                    $row[4]."||".
                    $row[5]."||".
                    $row[6]."||".
                    $row[7]."||".
                    $row[8]."||".
                    $row[9]."||".
                    $row[10];
                ?>
            <tbody>
                <tr>
                    <th scope="row"><?php echo $row[0]; ?></th>
                    <td><?php echo $row[1];  ?></td>
                    <td><?php echo $row[2]; ?></td>
                    <td><?php echo $row[3];?></td>
                    <td><?php echo $row[4];?></td>
                    <td><?php echo $row[7]; ?></td>
                    <td>
                        <form action="ViewEvidenciaValidacion.php" method="POST">
                            <div style="display: flex,justify-content: space-between;">
                                <button class="btn btn-outline-primary" style="border-style: hidden" type="submit" VALUE="<?php echo $row[0] ?>" name="Verificar" > <i class="fas fa-check-double"></i> Validar</button>

                            </div>
                        </form>
                    </td>
                </tr>
                <?php  } ?>
            </tbody>
        </table>
    </div>
</body>

</html>