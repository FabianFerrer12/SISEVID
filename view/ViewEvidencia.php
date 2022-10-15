<?php
include '../model/Evidencia.php';
include '../controller/DB.php';
include '../controller/EvidenciaController.php';

session_start();

if (!$_SESSION['activeSesion']) header("Location: ../index.php");

$idEvi = "";
$titu = "";
$descrip = "";
$tipo = "";
$TipoArchivo = "";
$FechaCreacionEvi = "";
$FechaRegistroEvi = "";
$Autores = "";
$Observacion = "";
$IDLugarGeo = "";
$Estado = "";
$UsuarioCreacion = "";
$FechaCreacion = "";
$mat = [];
$btnListar = "";
$btn = "";
$btnEliminar = "";
$btnEditar = "";
$btnNuevo = "";
$btnGuardar = "";
$idFila = "";
$inputBuscar = "";

if (isset($_POST['ID_EVIDENCIA'])) $idEvi = $_POST['ID_EVIDENCIA'];
if (isset($_POST['TITULO'])) $titu = $_POST['TITULO'];
if (isset($_POST['DESCRIPCIÓN'])) $descrip = $_POST['DESCRIPCIÓN'];
if (isset($_POST['TIPO'])) $tipo = $_POST['TIPO'];
if (isset($_POST['TIPO_ARCHIVO'])) $TipoArchivo = $_POST['TIPO_ARCHIVO'];
if (isset($_POST['FECHA_CREACION_EVIDENCIA'])) $FechaCreacionEvi = $_POST['FECHA_CREACION_EVIDENCIA'];
if (isset($_POST['FECHA_REGISTRO_EVIDENCIA'])) $FechaRegistroEvi = $_POST['FECHA_REGISTRO_EVIDENCIA'];
if (isset($_POST['AUTORES'])) $Autores = $_POST['AUTORES'];
if (isset($_POST['OBSERVACION'])) $Observacion = $_POST['OBSERVACION'];
// if (isset($_POST['ID_LUGAR_GEOGRAFICO'])) $IDLugarGeo = $_POST['ID_LUGAR_GEOGRAFICO'];
if (isset($_POST['ESTADO'])) $Estado = $_POST['ESTADO'];
if (isset($_POST['inputBuscar'])) $inputBuscar = $_POST['inputBuscar'];

// function borrar2($id_evidencia){
//     $objEvidencia = new Evidencia($idEvi, $titu, $descrip, $tipo, $TipoArchivo, $FechaCreacionEvi, $FechaRegistroEvi, $Autores, $Observacion, $IDLugarGeo, $Estado);
//     $objEvidenciaController = new EvidenciaController();
//     $objEvidenciaController->borrar($id_evidencia);
// }


if (isset($_POST['btn'])) $btn = $_POST['btn'];
if (isset($_POST['btnListar'])) $btnListar = $_POST['btnListar'];
if (isset($_POST['btnBorrar'])) $btnEliminar = $_POST['btnBorrar'];
if (isset($_POST['btnEditar'])) $btnEditar = $_POST['btnEditar'];
if (isset($_POST['btnGuardar'])) $btnGuardar = $_POST['btnGuardar'];
if (isset($_POST['btnNuevo'])) $btnNuevo = $_POST['btnNuevo'];


if($btnEliminar){
    $objEvidencia = new Evidencia($idEvi, $titu, $descrip, $tipo, $TipoArchivo, $FechaCreacionEvi, $FechaRegistroEvi, $Autores, $Observacion, $IDLugarGeo, $Estado);
    $objEvidenciaController = new EvidenciaController($objEvidencia);
    $objEvidenciaController->borrar($btnEliminar);
}

if($btnEditar){
    $objEvidencia = new Evidencia($idEvi, "", "", "", "", "", "", "", "", "", "");
    $objEvidenciaController = new EvidenciaController($objEvidencia);
    $objEvidencia = $objEvidenciaController->consultar($btnEditar);

    $titu=$objEvidencia->getTitulo();
    $descrip=$objEvidencia->getDescripcion();
    $tipo=$objEvidencia->getTipo();
    $TipoArchivo=$objEvidencia->getTipoArchivo();
    $FechaCreacionEvi=$objEvidencia->getFechaCreacion();
    $FechaRegistroEvi=$objEvidencia->getFechaRegistroEvidencia();
    $Autores=$objEvidencia->getAutores();
    $Observacion=$objEvidencia->getObservacion();
    $Estado=$objEvidencia->getESTADO();
}

if($btnGuardar){
    $objEvidencia = new Evidencia($idEvi, $titu, $descrip, $tipo, $TipoArchivo, $FechaCreacionEvi, $FechaRegistroEvi, $Autores, $Observacion, $IDLugarGeo, $Estado);
    $objEvidenciaController = new EvidenciaController($objEvidencia);
    $objEvidenciaController->guardarEvidencia();
}

if($btnNuevo){
    $titu="";
    $descrip="";
    $tipo="";
    $TipoArchivo="";
    $FechaCreacionEvi="";
    $FechaRegistroEvi="";
    $Autores="";
    $Observacion="";
    $Estado="";
}


switch ($btn) {
    case 'Consultar':
        $objEvidencia = new Evidencia($idEvi, "", "", "", "", "", "", "", "", "", "");
        $objEvidenciaController = new EvidenciaController($objEvidencia);
        $mat = $objEvidenciaController->buscar($inputBuscar);
    break;
    case 'Listar':
        $objEvidencia = new Evidencia($idEvi, $titu, $descrip, $tipo, $TipoArchivo, $FechaCreacionEvi, $FechaRegistroEvi, $Autores, $Observacion, $IDLugarGeo, $Estado);
        $objEvidenciaController = new EvidenciaController($objEvidencia);
        $mat = $objEvidenciaController->listar();
    break;
    case 'Nuevo':
        $titu="";
        $descrip="";
        $tipo="";
        $TipoArchivo="";
        $FechaCreacionEvi="";
        $FechaRegistroEvi="";
        $Autores="";
        $Observacion="";
        $Estado="";
    break;
    case'Guardar':
        $objEvidencia = new Evidencia($idEvi, $titu, $descrip, $tipo, $TipoArchivo, $FechaCreacionEvi, $FechaRegistroEvi, $Autores, $Observacion, $IDLugarGeo, $Estado);
        $objEvidenciaController = new EvidenciaController($objEvidencia);
        $objEvidenciaController->guardarEvidencia();
        break;
    default:
        $objEvidencia = new Evidencia($idEvi, $titu, $descrip, $tipo, $TipoArchivo, $FechaCreacionEvi, $FechaRegistroEvi, $Autores, $Observacion, $IDLugarGeo, $Estado);
        // var_dump($objEvidencia);
        $objEvidenciaController = new EvidenciaController($objEvidencia);
        $mat = $objEvidenciaController->listar();
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
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="./ViewEvidencia.php">Evidencias</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./Autores.php">Autores</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="./Register.php">Usuarios</a>
                    </li>
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
    <form id="idViewEvidencia" action="ViewEvidencia.php" method="post">
        <div class="container">
            <div style="margin:20px;">
                <div style="display: flex; align-items: center; justify-content: space-between;">
                    <div class="input-group" style="width: 35%;">
                        <input class="form-control" type="text" placeholder="Titulo" name="inputBuscar"
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
                            <button type="button" class="btn btn-success" data-bs-toggle="modal"
                                style="background: #055160" data-bs-target="#staticBackdrop" name="btn" value="Nuevo">
                                <i class="fa-solid fa-plus" style="margin-right: 10px;"></i>Nueva evidencia
                            </button>
                        </div>
                    </div>
                </div>
            </div>

            <table class="table table-striped" style="vertical-align: initial;">
                <thead style="background: #055160;color: white;">
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Titulo</th>
                        <th scope="col">Descripcion</th>
                        <th scope="col">Tipo</th>
                        <th scope="col">Tipo archivo</th>
                        <th scope="col">Autores</th>
                        <th scope="col">Acciónes</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
        for ($i = 0; $i < sizeof($mat); $i++) {
        ?>
                    <tr>
                        <th scope="row"><?php echo $i+1; ?></th>
                        <td><?php echo $mat[$i][0]; ?></td>
                        <td><?php echo $mat[$i][1]; ?></td>
                        <td><?php echo $mat[$i][2]; ?></td>
                        <td><?php echo $mat[$i][3]; ?></td>
                        <td><?php echo $mat[$i][6]; ?></td>
                        <td>
                            <div style="display: flex,justify-content: space-between;">
                                <button class="btn btn-outline-primary" style="border-style: hidden" type="submit"
                                    data-bs-toggle="modal" value="<?php echo $mat[$i][9]; ?>" name="btnEditar"
                                    data-bs-target="#staticBackdrop"><i class="fa-solid fa-pen-to-square"></i></button>
                                <button class="btn btn-outline-danger" style="border-style: hidden"
                                    value="<?php echo $mat[$i][9]; ?>" name="btnBorrar" type="submit"><i
                                        class="fa-solid fa-trash"></i></button>
                            </div>
                        </td>
                    </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div>

        <!-- Modal -->
        <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
            aria-labelledby="staticBackdropLabel" aria-hidden="true">
            <div class="modal-dialog modal-xl">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="staticBackdropLabel">Evidencia</h5>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        <div class="row">
                            <div class="row g-3">
                                <div class="col">
                                    <label>ID Evidencia</label>
                                    <input class="form-control" type="text" name="ID_EVIDENCIA"
                                        value="<?php echo $idEvi ?>">
                                </div>
                                <div class="col">
                                    <label>Titulo</label>
                                    <input class="form-control" type="text" name="TITULO" value="<?php echo $titu ?>">
                                </div>
                                <div class="col">
                                    <label>Descripcion</label>
                                    <input class="form-control" type="text" name="DESCRIPCIÓN"
                                        value="<?php echo $descrip ?>">
                                </div>
                            </div>

                            <div class="row g-3">
                                <div class="col">
                                    <label>Tipo</label>
                                    <input class="form-control" type="text" name="TIPO" value="<?php echo $tipo?>">
                                </div>
                                <div class="col">
                                    <label>Tipo archivo</label>
                                    <input class="form-control" type="text" name="TIPO_ARCHIVO"
                                        value="<?php echo $TipoArchivo ?>">
                                </div>
                                <div class="col">
                                    <label>Fecha creacion evidencia</label>
                                    <input class="form-control" type="date" name="FECHA_CREACION_EVIDENCIA"
                                        value="<?php echo $FechaCreacionEvi ?>">
                                </div>
                            </div>

                            <div class="row g-3">
                                <div class="col">
                                    <label>Fecha registro evidencia</label>
                                    <input class="form-control" type="date" name="FECHA_REGISTRO_EVIDENCIA"
                                        value="<?php echo $FechaRegistroEvi ?>">
                                </div>
                                <div class="col">
                                    <label>Autores</label>
                                    <input class="form-control" type="text" name="AUTORES"
                                        value="<?php echo $Autores?>">
                                </div>
                                <div class="col">
                                    <label>Observacion</label>
                                    <input class="form-control" type="text" name="OBSERVACION"
                                        value="<?php echo $Observacion ?>">
                                </div>
                            </div>

                            <div class="row g-3">
                                <div class="col-md-4">
                                    <label>Lugar geografico</label>
                                    <input class="form-control" type="text" name="ID_LUGAR_GEOGRAFICO"
                                        value="<?php echo $IDLugarGeo ?>">
                                </div>
                                <div class="col-md-4">
                                    <label>Estado</label>
                                    <input class="form-control" type="text" name="ESTADO" value="<?php echo $Estado ?>">
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
            </div>
        </div>
    </form>


</body>

</html>