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
if (isset($_POST['ID_EVIDENCIA'])) $idEvi = $_POST['ID_EVIDENCIA'];
if (isset($_POST['TITULO'])) $titu = $_POST['TITULO'];
if (isset($_POST['DESCRIPCIÓN'])) $descrip = $_POST['DESCRIPCIÓN'];
if (isset($_POST['TIPO'])) $tipo = $_POST['TIPO'];
if (isset($_POST['TIPO_ARCHIVO'])) $TipoArchivo = $_POST['TIPO_ARCHIVO'];
if (isset($_POST['FECHA_CREACION_EVIDENCIA'])) $FechaCreacionEvi = $_POST['FECHA_CREACION_EVIDENCIA'];
if (isset($_POST['FECHA_REGISTRO_EVIDENCIA'])) $FechaRegistroEvi = $_POST['FECHA_REGISTRO_EVIDENCIA'];
if (isset($_POST['AUTORES'])) $Autores = $_POST['AUTORES'];
if (isset($_POST['OBSERVACION'])) $Observacion = $_POST['OBSERVACION'];
if (isset($_POST['ID_LUGAR_GEOGRAFICO'])) $IDLugarGeo = $_POST['ID_LUGAR_GEOGRAFICO'];
if (isset($_POST['ESTADO'])) $Estado = $_POST['ESTADO'];
if (isset($_POST['USUARIO_CREACION'])) $UsuarioCreacion = $_POST['USUARIO_CREACION'];
if (isset($_POST['FECHA_CREACION'])) $FechaCreacion = $_POST['FECHA_CREACION'];


if (isset($_POST['btn'])) $bot = $_POST['btn'];


switch ($bot) {
  case 'Guardar':
    $objEvidencia = new Evidencia($idEvi, $titu, $descrip, $tipo, $TipoArchivo, $FechaCreacionEvi, $FechaRegistroEvi, $Autores, $Observacion, $IDLugarGeo, $Estado, $UsuarioCreacion, $FechaCreacion);
    $objEvidenciaController = new EvidenciaController($objEvidencia);
    $objEvidenciaController->guardarEvidencia();
    // var_dump($objEvidencia); 
    break;
  case 'Consultar':
    $objEvidencia = new Evidencia($idEvi, "", "", "", "", "", "", "", "", "", "", "", "");
    $objEvidenciaController = new EvidenciaController($objEvidencia);
    $objEvidencia = $objEvidenciaController->consultar();
    //var_dump($objEvidencia);
    break;

  case 'Modificar':
    $objEvidencia = new Evidencia($idEvi, $titu, $descrip, $tipo, $TipoArchivo, $FechaCreacionEvi, $FechaRegistroEvi, $Autores, $Observacion, $IDLugarGeo, $Estado, $UsuarioCreacion, $FechaCreacion);
    $objEvidenciaController = new EvidenciaController($objEvidencia);
    $objEvidenciaController->modificar();
    break;

  case 'Borrar':
    $objEvidencia = new Evidencia($idEvi, $titu, $descrip, $tipo, $TipoArchivo, $FechaCreacionEvi, $FechaRegistroEvi, $Autores, $Observacion, $IDLugarGeo, $Estado, $UsuarioCreacion, $FechaCreacion);
    $objEvidenciaController = new EvidenciaController($objEvidencia);
    $objEvidenciaController->borrar();
    break;

  case 'Listar':
    $objEvidencia = new Evidencia($idEvi, $titu, $descrip, $tipo, $TipoArchivo, $FechaCreacionEvi, $FechaRegistroEvi, $Autores, $Observacion, $IDLugarGeo, $Estado, $UsuarioCreacion, $FechaCreacion);
    $objEvidenciaController = new EvidenciaController($objEvidencia);
    $mat = $objEvidenciaController->listar();

    break;

  default:
    # code...
    break;
}




//var_dump($objPersona); muestra todo el objto
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <title>Datos Evidencia</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>

</head>

<body>
    <form id="idViewEvidencia" action="ViewEvidencia.php" method="post">
        <div class="container-fluid p-5 text-white text-center" style= "background: #055160;">
            <h1>Evidencias</h1>
        </div>

        <div class="container">
            <div class="row">
                <div class="row g-3">
                    <div class="col">
                        <label>ID Evidencia</label>
                        <input class="form-control" type="text" name="ID_EVIDENCIA" value="<?php echo $idEvi ?>">
                    </div>
                    <div class="col">
                        <label>Titulo</label>
                        <input class="form-control" type="text" name="TITULO" value="<?php echo $titu ?>">
                    </div>
                    <div class="col">
                        <label>Descripcion</label>
                        <input class="form-control" type="text" name="DESCRIPCIÓN" value="<?php echo $descrip ?>">
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col">
                        <label>Tipo</label>
                        <input class="form-control" type="text" name="TIPO" value="<?php echo $tipo ?>">
                    </div>
                    <div class="col">
                        <label>Tipo archivo</label>
                        <input class="form-control" type="text" name="TITULO" value="<?php echo $TipoArchivo ?>">
                    </div>
                    <div class="col">
                        <label>Fecha creacion evidencia</label>
                        <input class="form-control" type="text" name="DESCRIPCIÓN"
                            value="<?php echo $FechaCreacionEvi ?>">
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col">
                        <label>Fecha registro evidencia</label>
                        <input class="form-control" type="text" name="ID_EVIDENCIA"
                            value="<?php echo $FechaRegistroEvi ?>">
                    </div>
                    <div class="col">
                        <label>Autores</label>
                        <input class="form-control" type="text" name="TITULO" value="<?php echo $Autores ?>">
                    </div>
                    <div class="col">
                        <label>Observacion</label>
                        <input class="form-control" type="text" name="DESCRIPCIÓN" value="<?php echo $Observacion ?>">
                    </div>
                </div>

                <div class="row g-3">
                    <div class="col-md-4">
                        <label>Lugar geografico</label>
                        <input class="form-control" type="text" name="ID_EVIDENCIA" value="<?php echo $IDLugarGeo ?>">
                    </div>
                    <div class="col-md-4">
                        <label>Estado</label>
                        <input class="form-control" type="text" name="TITULO" value="<?php echo $Estado ?>">
                    </div>
                </div>

                <!-- <div class="col-md-5">
                    <div class="col-sm-4">
                        Usuario Creacion
                    </div>
                    <div class="col-sm-4">
                        <input type="text" name="USUARIO_CREACION" value="<?php echo $UsuarioCreacion ?>">
                    </div>
                    <div class="col-sm-4">

                    </div>
                </div>

                <div class="col">
                    <div class="col-sm-4">
                        Fecha Creacion
                    </div>
                    <div class="col-sm-4">
                        <input type="time" name="FECHA_CREACION" value="<?php echo $FechaCreacion ?>">
                    </div>
                    <div class="col-sm-4">

                    </div>
                </div> -->
            </div>


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

            <div class="container">
                <?php
        for ($i = 0; $i < sizeof($mat); $i++) {
        ?>
                <div class="row">
                    <div class="col-sm-2">
                        <?php
              echo  $mat[$i][0];
              ?>
                    </div>
                    <div class="col-sm-2">
                        <?php
              echo  $mat[$i][1];
              ?>
                    </div>
                    <div class="col-sm-2">
                        <?php
              echo  $mat[$i][2];
              ?>
                    </div>
                    <div class="col-sm-2">
                        <?php
              echo  $mat[$i][3];
              ?>
                    </div>
                    <div class="col-sm-2">
                        <?php
              echo  $mat[$i][4];
              ?>
                    </div>
                </div>
                <?php } ?>
            </div>
    </form>
</body>

</html>