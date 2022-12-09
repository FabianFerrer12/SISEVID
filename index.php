<?php
include 'model/Evidencia.php';
include 'controller/UsuarioController.php';
include 'model/Usuario/Usuario.php';
include 'model/Usuario/InformacionContacto.php';
include 'model/Usuario/UsuarioRol.php';
include 'model/Autor.php';

session_start();
$_SESSION['activeSesion'] = false;
$bot = "";

if (isset($_POST['USER'])) $_SESSION['USER'] = $_POST['USER'];
if (isset($_POST['PASSWORD'])) $_SESSION['PASSWORD'] = $_POST['PASSWORD'];
if (isset($_POST['btn'])) $bot = $_POST['btn'];



switch ($bot) {
    case 'Login':
        $UsuarioController = new UsuarioController();
        $success = $UsuarioController->consultarUsuario($_SESSION['USER'],$_SESSION['PASSWORD']);;
        if ($success) {
            $_SESSION['activeSesion'] = true;
            $_SESSION['rol'] = $UsuarioController->consultarDescipcionRol($_SESSION['USER'],$_SESSION['PASSWORD']);

            if($_SESSION['rol']=='Administrador'){
                header("Location: ./view/ViewEvidencia.php");
            }else if($_SESSION['rol']=='Verificador'){
                header("Location: ./view/ViewEvidenciaVerificacion.php");
            }else if($_SESSION['rol']=='Validador'){
                header("Location: ./view/ViewEvidenciaValidacion.php");
            }else{
                echo '<script language="javascript">alert("No existe pagina para este usuario con el rol asignado");</script>';
            }
            //header("Location: ./view/ViewEvidencia.php");

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
<html lang="en" style = "height:100%;
  margin:0;
  display: flex;
  flex-direction: column;">

<head>
    <title>Login Usuario</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
</head>

<body style = "height:100%;
  margin:0;
  display: flex;
  flex-direction: column;background-image: linear-gradient(to top, #09203f 0%, #055160 100%);">
    <form id="idLogin" method="post">
        <!-- <div class="container-fluid p-5 text-white text-center" style="background: #055160;">
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
        </div> -->



        <div id="container"
            style="height: 100%; width: 100%; background-size: cover; display: flex; justify-content: center; align-items: center;">
            <div id="login" style="background: rgb(0 0 0 / 21%);  height: 330px; width: 35%;margin-top: 10%;">
                <div style="text-align: center; color: white; font-size: 50px;"><i class="fas fa-user"></i></div>

                <div id="tituloL" style="text-align: center; font-size: 50px; color: white;">Bienvenido</div>
                <div id="contenido2">
                    <div style="text-align: center;">

                        <div class="form-floating" style="width: 70%; margin-left: 15%;margin-block: 15px;border-style:hidden;">
                            <input class="form-control" id="floatingInput" placeholder="text" type="text" name="USER">
                            <label for="floatingInput">Usuario</label>
                        </div>
                        <div class="form-floating " style="width: 70%; margin-left: 15%;margin-block: 15px;border-style:hidden;">
                            <input type="password" class="form-control" id="floatingPassword" placeholder="Password"
                                name="PASSWORD">
                            <label for="floatingPassword">Contraseña</label>
                        </div>
                        <div style="width: 70%; margin-left: 15%;margin-block: 15px;">
                            <button type="submit" class="btn btn-primary" value="Login" name="btn"
                                style="width: 100%;background: #043d48;border-style:hidden;">Ingresar</button>
                        </div>
                    </div>

                </div>
            </div>
        </div>

















    </form>
</body>

</html>