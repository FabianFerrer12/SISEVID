<?php
include 'model/Evidencia.php';
include 'controller/DB.php';
include 'controller/UsuarioController.php';

session_start();
$_SESSION['activeSesion'] = false;
$bot = "";

if (isset($_POST['USER'])) $_SESSION['USER'] = $_POST['USER'];
if (isset($_POST['PASSWORD'])) $_SESSION['PASSWORD'] = $_POST['PASSWORD'];
if (isset($_POST['btn'])) $bot = $_POST['btn'];



switch ($bot) {
    case 'Login':
        $UsuarioController = new UsuarioController();
        $success = $UsuarioController->consultar($_SESSION['USER'],$_SESSION['PASSWORD']);;
        if ($success) {
            $_SESSION['activeSesion'] = true;
            header("Location: ./view/ViewEvidencia.php");
        } else echo '<script language="javascript">alert("Usuario o contraseña incorrecta");</script>';
        break;
    case 'Soporte':
        echo '<script language="javascript">alert("Mensaje de contacto a soporte");</script>';
        header("Location: URL");
        break;
    default:
        # code...
        break;
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Login Usuario</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body>
    <form id="idLogin" method="post">
        <div class="container-fluid p-5 text-white text-center" style="background: #055160;">
            <h1>Login</h1>
        </div>
        <div class="container ">
            <div class="row">
                <div class="row g-3 justify-content-center">
                    <div class="col-sm-3 ">
                        <label>Usuario</label>
                        <input class="form-control" type="text" name="USER" value="">
                    </div>
                </div>
                <div class="row g-3 justify-content-center">
                    <div class="col-sm-3 ">
                        <label>Contraseña</label>
                        <input class="form-control" type="password" name="PASSWORD" value="">
                    </div>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-4">
                    <input type="submit" class="btn btn-primary" value="Login" name="btn" />
                </div>
            </div>
        </div>
    </form>
</body>

</html>