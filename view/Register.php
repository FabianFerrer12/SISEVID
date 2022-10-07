<?php
include '../model/Evidencia.php';
include '../controller/DB.php';
include '../controller/UsuarioController.php';

session_start();

if (isset($_SESSION['activeSesion'])) header("Location: ./index.php");;

$bot = '';

if (isset($_POST['btn'])) $bot = $_POST['btn'];


switch ($bot) {
    case 'Borrar':
        echo '<script language="javascript">alert("Se borran todos los datos");</script>';
        break;
    case 'Registrar':

        break;
    default:
        # code...
        break;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Registro de usuario</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body>
    <form id="formularioRegistro" method="post">
        <div class="container-fluid p-5 text-white text-center" style="background: #055160;">
            <h1>Evidencias</h1>
        </div>

        <div class="container">
            <div class="row">
                <div class="row g-3">
                    <div class="col">
                        <label>Nombre</label>
                        <input class="form-control" type="text" name="ID_EVIDENCIA" value="">
                    </div>
                    <div class="col">
                        <label>Apellido</label>
                        <input class="form-control" type="text" name="TITULO" value="">
                    </div>
                    <div class="col">
                        <label>Usuario</label>
                        <input class="form-control" type="text" name="DESCRIPCIÓN" value="">
                    </div>
                </div>


            </div>


            <div class="row">
                <div class="row g-3">
                    <div class="col">
                        <input type="submit" class="btn btn-primary" value="Registrar" name="btn" />
                    </div>

                    <div class="col">
                        <input type="submit" class="btn btn-danger" value="Borrar" name="btn" />
                    </div>
                </div>
            </div>
        </div>
    </form>
</body>

</html>