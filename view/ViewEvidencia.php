<?php
include '../model/Evidencia.php';
include '../controller/DB.php';
include '../controller/EvidenciaController.php';

session_start();

//if (isset($_SESSION['activeSesion'])) header("Location: ../index.php");

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
$bot = "";
$btnEliminar = "";
$btnEditar = "";
$btnNuevo = "";
$btnGuardar = "";
$idFila = "";

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
// if (isset($_POST['USUARIO_CREACION'])) $UsuarioCreacion = $_POST['USUARIO_CREACION'];
// if (isset($_POST['FECHA_CREACION'])) $FechaCreacion = $_POST['FECHA_CREACION'];

function borrar2($id_evidencia){
    echo '<script language="javascript">alert("entro");</script>';
    $objEvidencia = new Evidencia($idEvi, $titu, $descrip, $tipo, $TipoArchivo, $FechaCreacionEvi, $FechaRegistroEvi, $Autores, $Observacion, $IDLugarGeo, $Estado);
    $objEvidenciaController = new EvidenciaController();
    echo console.log($id_evidencia);
    $objEvidenciaController->borrar($id_evidencia);
}


if (isset($_POST['btn'])) $bot = $_POST['btn'];
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


switch ($bot) {
  case 'Guardar':
    $objEvidencia = new Evidencia($idEvi, $titu, $descrip, $tipo, $TipoArchivo, $FechaCreacionEvi, $FechaRegistroEvi, $Autores, $Observacion, $IDLugarGeo, $Estado);
    $objEvidenciaController = new EvidenciaController($objEvidencia);
    $objEvidenciaController->guardarEvidencia();
    // var_dump($objEvidencia); 
    break;
  case 'Consultar':
    $objEvidencia = new Evidencia($idEvi, "", "", "", "", "", "", "", "", "", "");
    $objEvidenciaController = new EvidenciaController($objEvidencia);
    $objEvidencia = $objEvidenciaController->consultar();
    // var_dump($objEvidencia);
    $titu=$objEvidencia->getTitulo();
    $descrip=$objEvidencia->getDescripcion();
    $tipo=$objEvidencia->getTipo();
    $TipoArchivo=$objEvidencia->getTipoArchivo();
    $FechaCreacionEvi=$objEvidencia->getFechaCreacion();
    $FechaRegistroEvi=$objEvidencia->getFechaRegistroEvidencia();
    $Autores=$objEvidencia->getAutores();
    $Observacion=$objEvidencia->getObservacion();
    $Estado=$objEvidencia->getESTADO();
    break;

  case 'Modificar':
    $objEvidencia = new Evidencia($idEvi, $titu, $descrip, $tipo, $TipoArchivo, $FechaCreacionEvi, $FechaRegistroEvi, $Autores, $Observacion, $IDLugarGeo, $Estado);
    $objEvidenciaController = new EvidenciaController($objEvidencia);
    $objEvidenciaController->actualizar();
    break;

  case 'Borrar':
    $objEvidencia = new Evidencia($idEvi, $titu, $descrip, $tipo, $TipoArchivo, $FechaCreacionEvi, $FechaRegistroEvi, $Autores, $Observacion, $IDLugarGeo, $Estado);
    $objEvidenciaController = new EvidenciaController($objEvidencia);
    $objEvidenciaController->borrar($btnEliminar);
    break;

  case 'Listar':
    $objEvidencia = new Evidencia($idEvi, $titu, $descrip, $tipo, $TipoArchivo, $FechaCreacionEvi, $FechaRegistroEvi, $Autores, $Observacion, $IDLugarGeo, $Estado);
    $objEvidenciaController = new EvidenciaController($objEvidencia);
    $mat = $objEvidenciaController->listar();

    break;

  default:
    $objEvidencia = new Evidencia($idEvi, $titu, $descrip, $tipo, $TipoArchivo, $FechaCreacionEvi, $FechaRegistroEvi, $Autores, $Observacion, $IDLugarGeo, $Estado);
    $objEvidenciaController = new EvidenciaController($objEvidencia);
    $mat = $objEvidenciaController->listar();
    break;
}




//var_dump($objPersona); muestra todo el objto
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
                        <a class="nav-link" href="./Register.php">Usuarios</a>
                    </li>
                </ul>
            </div>
        </div>
    </nav>
    <form id="idViewEvidencia" action="ViewEvidencia.php" method="post">
        <!-- <div class="container-fluid p-5 text-white text-center" style="background: #055160;">
            <h1>Evidencias</h1>
        </div> -->

        <div class="container">
            <button type="button" class="btn btn-success" data-bs-toggle="modal" data-bs-target="#staticBackdrop"
                value="aa" name="btnNuevo" style="position: relative;float: right;margin: 15px;">
                <i class="fa-solid fa-plus" style= "margin-right: 10px;"></i>Nueva evidencia
            </button>

            <div class="row">
                <div class="row g-3">
                    <div class="col">
                        <input type="submit" class="btn btn-success" value="Guardar" name="btn" />
                    </div>
                    <div class="col">
                        <input type="submit" class="btn btn-secondary" value="Consultar" name="btn" />
                    </div>
                    <div class="col">
                        <input type="submit" class="btn btn-primary" value="Modificar" name="btn" />
                    </div>
                    <div class="col">
                        <input type="submit" class="btn btn-danger" value="Borrar" name="btn" />
                    </div>
                    <div class="col">
                        <input type="submit" class="btn btn-primary" value="Listar" name="btn" />
                    </div>
                </div>
            </div>

            <table class="table">
                <thead>
                    <tr>
                        <th scope="col">#</th>
                        <th scope="col">Titulo</th>
                        <th scope="col">Descripcion</th>
                        <th scope="col">Tipo</th>
                        <th scope="col">Tipo archivo</th>
                        <th scope="col">Autores</th>
                        <th scope="col">Accion</th>
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
                                <button class="btn btn-outline-primary" style="border-style: hidden"
                                    value="<?php echo $mat[$i][9]; ?>" name="btnEditar" data-bs-toggle="modal"
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