<?php
include '../model/Usuario/UsuarioRol.php';
include '../model/Usuario/Usuario.php';
include '../model/Usuario/InformacionContacto.php';
include '../controller/UsuarioController.php';
session_start();

if (!$_SESSION['activeSesion']) header("Location: ../index.php");

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

$administrador = false;
$validate = false;
$verificate = false;
$administrativo = false;

<<<<<<< HEAD
if (isset($_SESSION['ROLES'])){
    // foreach ($_SESSION['ROLES'] as $rol){
    //     if($rol == 'Administrador'){
    //         $administrador = true;
    //     }else if($rol =='Verificador'){
    //         $verificate = true;
    //     }else if ($rol=='Validador'){
    //         $validate = true;
    //     }else if($rol=='Administrativo'){
    //         $administrativo = true;
    //     }
    // }
}else{
    $administrador = true;
    $verificate = true;
    $validate = true;
    $administrativo = true;
    
    echo '<script language="javascript">alert("No posee roles asignados, por ende se brindan todos los permisos");</script>';
=======
if (isset($_SESSION['roles'])){
    foreach ($_SESSION['roles'] as $rol){
        if($rol == 'Administrador'){
            $administrador = true;
        }else if($rol =='Verificador'){
            $verificate = true;
        }else if ($rol=='Validador'){
            $validate = true;
        }else if($rol=='Administrativo'){
            $administrativo = true;
        }
    }  
>>>>>>> 3ac58a5a075f256a25b8c91b19f652c4564b2a54
}


switch ($bot) {
    case 'Borrar':
        echo "rol".$_SESSION['rol'];
        echo '<script language="javascript">alert("Se borran todos los datos");</script>';
        break;
    case 'Registrar':
        if ($_SESSION['rol'] == "Administrador") {
            $rol = new UsuarioRol($ROL);
            $c_info = new InformacionContacto($T_DOC, $N_DOC, $NAME, $APEL, $TEL, $EMAIL, $_SESSION['USER']);
            $c_info->setID(rand(0, 9999));
            $usario = new Usuario($USER, $PASSWORD, $c_info, $rol);
            $usario->setID(rand(0, 9999));
            $UsuarioController = new UsuarioController();
            $UsuarioController->crearUsuario($usario);
        }else{
            echo '<script language="javascript">alert("No tienes permisos para crear usuarios");</script>';
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
    <script src="https://kit.fontawesome.com/99291d97ef.js" crossorigin="anonymous"></script>

</head>

<body>
    <form id="formularioRegistro" method="post">
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
            <h1>Registro de usuario</h1>
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
                        <select name="ROL" class="form-select" aria-label="Default select example">
                            <?php 
                                $UsuarioController = new UsuarioController();
                                $roles = $UsuarioController->consultarRoles();
                                foreach($roles as $rol){
                                    echo "<option value=".$rol.">".$rol."</option>"
                                ?>  
                            <?php }?>
                        </select>
                    </div>
                </div>

            </div>


            <div class="row">
                <div class="row g-3">
                    <div class="col">
                        <button class="btn btn-success" value="Registrar" name="btn"><i class="fa-solid fa-user-plus"
                                style="margin-right: 10px;"></i>Registrar</button>
                    </div>

                    <!-- <div class="col">
                        <input type="submit" class="btn btn-danger" value="Borrar" name="btn" />
                    </div> -->
                </div>
            </div>
        </div>
    </form>
</body>

</html>