<?php
session_start();

//if (isset($_SESSION['activeSesion'])) header("Location: ../index.php");

$bot = '';

if (isset($_POST['NAME'])) $NAME = $_POST['NAME'];
if (isset($_POST['APEL'])) $APEL = $_POST['APEL'];
if (isset($_POST['EMAIL'])) $EMAIL = $_POST['EMAIL'];
if (isset($_POST['USER'])) $USER = $_POST['USER'];
if (isset($_POST['PASSWORD'])) $PASSWORD = $_POST['PASSWORD'];
if (isset($_POST['TEL'])) $TEL = $_POST['TEL'];
if (isset($_POST['T_DOC'])) $T_DOC = $_POST['T_DOC'];
if (isset($_POST['N_DOC'])) $N_DOC = $_POST['N_DOC'];
if (isset($_POST['ROL'])) $ROL = $_POST['ROL'];

if (isset($_POST['btn'])) $bot = $_POST['btn'];


switch ($bot) {
    case 'Borrar':
        echo '<script language="javascript">alert("Se borran todos los datos");</script>';
        break;
    case 'Registrar':
        
        $rol = new UsuarioRol($ROL);
        $c_info = new InformacionContacto($T_DOC,$N_DOC,$NAME,$APEL,$TEL, $EMAIL,$_SESSION['USER']);
        $c_info -> setID("5");
        $usario = new Usuario($USER,$PASSWORD,$c_info,$rol);
        $UsuarioController = new UsuarioController();
        $success = $UsuarioController->crearUsuario($usario);
    
        if($susses){
            echo '<script language="javascript">alert("Se registro correctamente el usuario");</script>';
        }else{
            echo '<script language="javascript">alert("No se pudo registrar el usuario");</script>';
        }
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
                        <input class="form-control" type="text" name="NAME" value="">
                    </div>
                    <div class="col">
                        <label>Apellido</label>
                        <input class="form-control" type="text" name="APEL" value="">
                    </div>
                    <div class="col">
                        <label>Email</label>
                        <input class="form-control" type="text" name="EMAIL" value="">
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col">
                        <label>Usuario</label>
                        <input class="form-control" type="text" name="USER" value="">
                    </div>
                    <div class="col">
                        <label>Contraseña</label>
                        <input class="form-control" type="text" name="PASSWORD" value="">
                    </div>
                    <div class="col">
                        <label>Telefono</label>
                        <input class="form-control" type="text" name="TEL" value="">
                    </div>
                </div>
                <div class="row g-3">
                    <div class="col">
                        <label>Tipo Documento</label>
                        <input class="form-control" type="text" name="T_DOC" value="">
                    </div>
                    <div class="col">
                        <label>Numero Documento</label>
                        <input class="form-control" type="text" name="N_DOC" value="">
                    </div>
                    <div class="col">
                        <label>ROL</label>
                        <input class="form-control" type="text" name="ROL" value="">
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