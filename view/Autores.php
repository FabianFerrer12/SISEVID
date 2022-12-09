<?php
include '../model/Autor.php';
include '../controller/DB.php';
include '../controller/AutorController.php';


session_start();

if (!$_SESSION['activeSesion']) header("Location: ../index.php");

$id = "";
$nombre = "";
$apellido = "";
$nacionalidad = "";
$fechaNacimiento = "";

$id2 = "";
$nombre2 = "";
$apellido2 = "";
$nacionalidad2 = "";
$fechaNacimiento2 = "";


$mat = [];
$btnListar = "";
$btn = "";
$btnEliminar = "";
$btnEditar = "";
$btnNuevo = "";
$btnGuardar = "";
$idFila = "";
$inputBuscar = "";

if (isset($_POST['ID_AUTOR'])) $id = $_POST['ID_AUTOR'];
if (isset($_POST['NOMBRE'])) $nombre = $_POST['NOMBRE'];
if (isset($_POST['APELLIDO'])) $apellido = $_POST['APELLIDO'];
if (isset($_POST['NACIONALIDAD'])) $nacionalidad = $_POST['NACIONALIDAD'];
if (isset($_POST['FECHA_NACIMIENTO'])) $fechaNacimiento = $_POST['FECHA_NACIMIENTO'];

if (isset($_POST['ID_AUTOR2'])) $id2 = $_POST['ID_AUTOR2'];
if (isset($_POST['NOMBRE2'])) $nombre2 = $_POST['NOMBRE2'];
if (isset($_POST['APELLIDO2'])) $apellido2 = $_POST['APELLIDO2'];
if (isset($_POST['NACIONALIDAD2'])) $nacionalidad2 = $_POST['NACIONALIDAD2'];
if (isset($_POST['FECHA_NACIMIENTO2'])) $fechaNacimiento2 = $_POST['FECHA_NACIMIENTO2'];

if (isset($_POST['btn'])) $btn = $_POST['btn'];
if (isset($_POST['btnListar'])) $btnListar = $_POST['btnListar'];
if (isset($_POST['btnBorrar'])) $btnEliminar = $_POST['btnBorrar'];
if (isset($_POST['btnEditar'])) $btnEditar = $_POST['btnEditar'];
if (isset($_POST['btnGuardar'])) $btnGuardar = $_POST['btnGuardar'];
if (isset($_POST['btnNuevo'])) $btnNuevo = $_POST['btnNuevo'];
if (isset($_POST['inputBuscar'])) $inputBuscar = $_POST['inputBuscar'];


if($btnEliminar){
    $objAutor = new Autor($id, $nombre, $apellido, $nacionalidad, $fechaNacimiento);
    $objAutorController = new AutorController($objAutor);
    $objAutorController->borrar($btnEliminar);
}


if($btnNuevo){
    $nombre="";
    $apellido="";
    $nacionalidad="";
    $fechaNacimiento="";
}


switch ($btn) {
    case 'Consultar':
        $objAutor = new Autor($id, "", "", "", "");
        $objAutorController = new AutorController($objAutor);
        $mat = $objAutorController->buscar($inputBuscar);
    break;
    case 'Listar':
        $objAutor = new Autor($id, $nombre, $apellido, $nacionalidad, $fechaNacimiento);
        $objAutorController = new AutorController($objAutor);
        $mat = $objAutorController->listar();
    break;
    case 'Nuevo':
        $nombre="";
        $apellido="";
        $nacionalidad="";
        $fechaNacimiento="";
    break;
    case 'Guardar':
        $objAutor = new Autor($id, $nombre, $apellido, $nacionalidad, $fechaNacimiento);
        $objAutorController = new AutorController($objAutor);
        $objAutorController->guardarAutor();
        $mat = $objAutorController->listar();
        break;
    case 'Actualizar':
        $objAutor = new Autor($id2, $nombre2, $apellido2, $nacionalidad2, $fechaNacimiento2);
        $objAutorController = new AutorController($objAutor);
        $objAutorController->actualizar();
        $mat = $objAutorController->listar();
    break;
    default:
        $objAutor = new Autor($id, $nombre, $apellido,$nacionalidad, $fechaNacimiento);
        // var_dump($objAutor);
        $objAutorController = new AutorController($objAutor);
        $mat = $objAutorController->listar();
    break;
}


?>



<!DOCTYPE html>
<html lang="es">

<head>
    <title>Datos Evidencia</title>
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
        $("#ID_AUTOR2").val(d[0]);
        $("#NOMBRE2").val(d[1]);
        $("#APELLIDO2").val(d[2]);
        $("#NACIONALIDAD2").val(d[3]);
        $("#FECHA_NACIMIENTO2").val(d[4]);
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
                    <?php if ($algo == "Administrador"){ ?>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="./ViewEvidencia.php">Evidencias
                            registradas </a>
                    </li>

                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="./ViewEvidenciaVerificacion.php">Evidencias
                            verificadas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="./ViewEvidenciaValidacion.php">Evidencias
                            verificadas y validadas</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./Autores.php">Autores</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./Register.php">Usuarios</a>
                    </li>
                    <?php }?>


                    <?php if ( $_SESSION['rol'] == "Verificador"){ ?>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="./ViewEvidenciaVerificacion.php">Evidencias
                            verificadas</a>
                    </li>
                    <?php }?>

                    <?php if ( $_SESSION['rol'] == "Validador"){ ?>
                    <li class="nav-item">
                        <a class="nav-link" aria-current="page" href="./ViewEvidenciaValidacion.php">Evidencias
                            verificadas y validadas</a>
                    </li>
                    <?php }?>

                    <li class="nav-item dropdown" style="position: absolute;right: 80px;">
                        <a class="nav-link active dropdown-toggle" href="#" id="navbarDropdown" role="button"
                            data-bs-toggle="dropdown" aria-expanded="false">
                            <i class="fas fa-user"></i>
                            <?php echo $_SESSION['rol']; ?>
                        </a>
                        <ul class="dropdown-menu" aria-labelledby="navbarDropdown">
                            <li><a class="dropdown-item" href="./CerrarSession.php">Cerrar session</a></li>
                        </ul>
                    </li>
                </ul>
            </div>
        </div>
    </nav>

    <div class="container">
        <div style="margin:20px;">
            <div style="display: flex; align-items: center; justify-content: space-between;">
                <div class="input-group" style="width: 35%;">
                    <input class="form-control" type="text" placeholder="Nombre" name="inputBuscar"
                        value="<?php echo $inputBuscar?>">
                    <button type="submit" class="btn btn-primary" name="btn" value="Consultar"
                        style="background: #055160;border-style: hidden"><i
                            class="fa-solid fa-magnifying-glass"></i></button>
                </div>
                <div style="display: flex;justify-content: space-between; width: 20%;">
                    <div class="">
                        <button type="submit" class="btn btn-primary" value="Listar" name="btn"
                            style="background: #055160"><i class="fas fa-sync"></i></button>
                    </div>
                    <div class="">
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" style="background: #055160"
                            data-bs-target="#staticBackdrop" name="btn" value="Nuevo">
                            <i class="fa-solid fa-plus" style="margin-right: 10px;"></i>Nuevo autor
                        </button>
                    </div>
                </div>
            </div>
        </div>

        <table class="table table-striped" style="vertical-align: initial;">
            <thead style="background: #055160;color: white;">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Nombres</th>
                    <th scope="col">Apellidos</th>
                    <th scope="col">Nacionalidad</th>
                    <th scope="col">Fecha nacimiento</th>
                    <th scope="col">Acciónes</th>
                </tr>
            </thead>

            <?php 
                $mysqli = new mysqli("localhost","root","socrates","SISEVID");
                if ($mysqli -> connect_errno) {
                    echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
                    exit();
                }
                $sql = "SELECT * FROM autor";
                $resultado=$mysqli->query($sql);
                while($row = $resultado->fetch_array()){
                    $datos=$row[0]."||".
                    $row[1]."||".
                    $row[2]."||".
                    $row[3]."||".
                    $row[4]."||".
                    $row[5]."||".
                    $row[6];
                ?>
            <tbody>
                <tr>
                    <th scope="row"><?php echo $row[0]; ?></th>
                    <td><?php echo $row[1]; ?></td>
                    <td><?php echo $row[2]; ?></td>
                    <td><?php echo $row[3]; ?></td>
                    <td><?php echo $row[4]; ?></td>
                    <td>
                        <div style="display: flex,justify-content: space-between;">
                            <button class="btn btn-outline-primary" style="border-style: hidden" type="button"
                                data-bs-toggle="modal" onclick="llenarModal_actualizar('<?php echo $datos?>');"
                                data-bs-target="#editar"><i class="fa-solid fa-pen-to-square"></i></button>
                            <button class="btn btn-outline-danger" style="border-style: hidden"
                                value="<?php echo $row[0]; ?>" name="btnBorrar" type="submit"><i
                                    class="fa-solid fa-trash"></i></button>
                        </div>
                    </td>
                </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

    <!-- Modal  nuevo-->
    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Autor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="idAutores" action="Autores.php" method="post" class="row g-3 needs-validation" validate>
                        <div class="row">
                            <div class="row g-3">
                                <div class="col">
                                    <label>ID autor</label>
                                    <input class="form-control" type="text" name="ID_AUTOR" value="<?php echo $id ?>"
                                        required>
                                </div>
                                <div class="col">
                                    <label>Nombres</label>
                                    <input class="form-control" type="text" name="NOMBRE" value="<?php echo $nombre ?>"
                                        required>
                                </div>

                            </div>

                            <div class="row g-3">
                                <div class="col">
                                    <label>Apellidos</label>
                                    <input class="form-control" type="text" name="APELLIDO"
                                        value="<?php echo $apellido ?>" required>
                                </div>
                                <div class="col">
                                    <label>Nacionalidad</label>
                                    <input class="form-control" type="text" name="NACIONALIDAD"
                                        value="<?php echo $nacionalidad?>" required>
                                </div>
                            </div>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label>Fecha nacimiento</label>
                                    <input class="form-control" type="date" name="FECHA_NACIMIENTO"
                                        value="<?php echo $fechaNacimiento ?>" required>
                                </div>
                            </div>


                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                    <button class="btn btn-primary" value="Guardar" name="btn" type="submit"><i
                            class="fa-regular fa-floppy-disk"></i> Guardar</button>
                </div>
            </div>
            </form>
        </div>
    </div>


    <!-- Modal  editar-->
    <div class="modal fade" id="editar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-lg">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Autor</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="idAutores" action="Autores.php" method="post" class="row g-3 needs-validation" validate>
                        <div class="row">
                            <div class="row g-3">
                                <div class="col">
                                    <label>ID autor</label>
                                    <input class="form-control" type="text" name="ID_AUTOR2" id="ID_AUTOR2"
                                        readonly="readonly" value="" required>
                                </div>
                                <div class="col">
                                    <label>Nombres</label>
                                    <input class="form-control" type="text" name="NOMBRE2" id="NOMBRE2" value=""
                                        required>
                                </div>

                            </div>

                            <div class="row g-3">
                                <div class="col">
                                    <label>Apellidos</label>
                                    <input class="form-control" type="text" name="APELLIDO2" id="APELLIDO2" value=""
                                        required>
                                </div>
                                <div class="col">
                                    <label>Nacionalidad</label>
                                    <input class="form-control" type="text" name="NACIONALIDAD2" id="NACIONALIDAD2"
                                        value="" required>
                                </div>
                            </div>

                            <div class="row g-3">
                                <div class="col-md-6">
                                    <label>Fecha nacimiento</label>
                                    <input class="form-control" type="date" name="FECHA_NACIMIENTO2"
                                        id="FECHA_NACIMIENTO2" value="" required>
                                </div>
                            </div>


                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                    <button class="btn btn-primary" value="Actualizar" name="btn" type="submit"><i
                            class="fa-regular fa-floppy-disk"></i> Editar</button>
                </div>
            </div>
            </form>
        </div>
    </div>



</body>

</html>