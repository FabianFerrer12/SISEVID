<?php
include '../model/Evidencia.php';
include '../controller/DB.php';
include '../controller/EvidenciaController.php';

session_start();

if (!$_SESSION['activeSesion']) header("Location: ../index.php");

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

//$algo = $_SESSION['rol'] ;

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

$idEvi2 = "";
$titu2 = "";
$descrip2 = "";
$tipo2 = "";
$TipoArchivo2 = "";
$FechaCreacionEvi2 = "";
$FechaRegistroEvi2 = "";
$Autores2 = "";
$Observacion2 = "";
$IDLugarGeo2 = "";
$Estado2 = "";
$UsuarioCreacion2 = "";
$FechaCreacion2 = "";

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
if (isset($_POST['ESTADO'])) $Estado = $_POST['ESTADO'];
if (isset($_POST['inputBuscar'])) $inputBuscar = $_POST['inputBuscar'];


if (isset($_POST['ID_EVIDENCIA2'])) $idEvi2 = $_POST['ID_EVIDENCIA2'];
if (isset($_POST['TITULO2'])) $titu2 = $_POST['TITULO2'];
if (isset($_POST['DESCRIPCIÓN2'])) $descrip2 = $_POST['DESCRIPCIÓN2'];
if (isset($_POST['TIPO2'])) $tipo2 = $_POST['TIPO2'];
if (isset($_POST['TIPO_ARCHIVO2'])) $TipoArchivo2 = $_POST['TIPO_ARCHIVO2'];
if (isset($_POST['FECHA_CREACION_EVIDENCIA2'])) $FechaCreacionEvi2 = $_POST['FECHA_CREACION_EVIDENCIA2'];
if (isset($_POST['FECHA_REGISTRO_EVIDENCIA2'])) $FechaRegistroEvi2 = $_POST['FECHA_REGISTRO_EVIDENCIA2'];
if (isset($_POST['AUTORES2'])) $Autores2 = $_POST['AUTORES2'];
if (isset($_POST['OBSERVACION2'])) $Observacion2 = $_POST['OBSERVACION2'];
if (isset($_POST['ESTADO2'])) $Estado2 = $_POST['ESTADO2'];



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
        $mat = $objEvidenciaController->listar();
    break;
    case 'Editar':
        $objEvidencia = new Evidencia($idEvi2, $titu2, $descrip2, $tipo2, $TipoArchivo2, $FechaCreacionEvi2, $FechaRegistroEvi2, $Autores2, $Observacion2, $IDLugarGeo2, $Estado2);
        $objEvidenciaController = new EvidenciaController($objEvidencia);
        $objEvidenciaController->actualizar();
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
    <title>Evidencias registradas</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.0/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://kit.fontawesome.com/99291d97ef.js" crossorigin="anonymous"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="https://code.jquery.com/jquery-3.6.1.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/axios/dist/axios.min.js"></script>
    <script>
        function llenarModal_actualizar(evidenceTrame) {
            console.log(evidenceTrame);
            
            d = new String(evidenceTrame).split('||');
            console.log(d);
            $("#ID_EVIDENCIA2").val(d[0]);
            $("#TITULO2").val(d[1]);
            $("#DESCRIPCIÓN2").val(d[2]);
            $("#TIPO2").val(d[3]);
            $("#TIPO_ARCHIVO2").val(d[4]);
            $("#FECHA_CREACION_EVIDENCIA2").val(d[5]);
            $("#FECHA_REGISTRO_EVIDENCIA2").val(d[6]);
            $("#AUTORES2").val(d[7]);
            $("#OBSERVACION2").val(d[8]);
            $("#ID_LUGAR_GEOGRAFICO2").val( 'No hay lugar geografico'
                //d[9]
                );
            $("#ESTADO2").val('no hay estado'
                //d[10]
                );
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

    <div class="container-fluid p-4 text-dark text-center">
        <h1>Listado de todas las evidencias</h1>
    </div>

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
                        <button type="button" class="btn btn-success" data-bs-toggle="modal" style="background: #055160"
                            data-bs-target="#staticBackdrop" name="btn" value="Nuevo">
                            <i class="fa-solid fa-plus" style="margin-right: 10px;"></i>Nueva evidencia
                        </button>
                    </div>
                </div>
            </div>
        </div>
        <table class="table table-striped" style="vertical-align: initial;" id="table-evidences">
            <thead style="background: #055160;color: white;">
                <tr>
                    <th scope="col">ID</th>
                    <th scope="col">Titulo</th>
                    <th scope="col">Descripcion</th>
                    <th scope="col">Tipo</th>
                    <th scope="col">Tipo archivo</th>
                    <th scope="col">Autores</th>
                    <th scope="col">Estado</th>
                    <th scope="col">Acciónes</th>

                </tr>
            </thead>
<<<<<<< HEAD
            <tbody></tbody>
=======
            <?php 
                $mysqli = new mysqli("localhost","root","","SISEVID");
                if ($mysqli -> connect_errno) {
                    echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
                    exit();
                }
            $sql = "SELECT  e.*,ed.ESTADO FROM evidencia e INNER JOIN evidencia_detalle ed ON ed.ID_EVIDENCIA=e.ID_EVIDENCIA WHERE ed.ACTIVO='S'";
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
                    <td> <?php if ($row[11]==1){
                        echo 'No verificada';
                        }else if( $row[11]==2) {
                        echo 'Verificada';
                        }else if( $row[11]==3){
                        echo 'Verificada y validada';} ?> </td>
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
                <?php  } ?>
            </tbody>
>>>>>>> 3ac58a5a075f256a25b8c91b19f652c4564b2a54
        </table>
        <script>
                const readEvidences = () => {
                    axios.get('http://localhost:8887/evidences/consultEvidences').then(res => {
                        const table = document.getElementById('table-evidences').querySelector('tbody');

                        res.data.forEach((evidence, key) => {
                            console.log(evidence);  
                            const tr = document.createElement('TR');
                            tr.setAttribute('ID',evidence.id);

                            const tdID = document.createElement('TD');
                            tdID.textContent = evidence.id;

                            const tdTitle = document.createElement('TD');
                            tdTitle.textContent = evidence.title;

                            const tdDescription = document.createElement('TD');
                            tdDescription.textContent = evidence.description;

                            const tdType = document.createElement('TD');
                            tdType.textContent = evidence.type;

                            const tdTypeFile = document.createElement('TD');
                            tdTypeFile.textContent = evidence.typeFile;

                            const tdAuthors = document.createElement('TD');
                            tdAuthors.textContent = evidence.authors;

                            const tdEstado = document.createElement('TD');
                            tdEstado.textContent = 'evidence.authors';

                            const tdAcciones = document.createElement('TD');

                            const divAcciones = document.createElement('DIV');
                            divAcciones.setAttribute('style','display: flex,justify-content: space-between;');
                            
                            const evidenceTrame = evidence.id + "||" + evidence.title + "||" + evidence.description + "||" + evidence.type + "||" + evidence.typeFile
                            + "||" + evidence.evidenceCreationDate + "||" + evidence.evidenceRegisterDate + "||" + evidence.authors + "||" + evidence.observation;
                            
                            const btnAccionesActualizar = document.createElement('BUTTON');
                            btnAccionesActualizar.setAttribute('VALUE',evidence.id);
                            btnAccionesActualizar.setAttribute('style','border-style: hidden');
                            btnAccionesActualizar.setAttribute('type','submit');
                            btnAccionesActualizar.setAttribute('name','btnActualizar');
                            btnAccionesActualizar.setAttribute('data-bs-toggle','modal');
                            btnAccionesActualizar.setAttribute('data-bs-target','#editar');
                            btnAccionesActualizar.setAttribute('onclick','llenarModal_actualizar("'+ evidenceTrame +'");');
                            
                            const btnAccionesBorrar = document.createElement('BUTTON');
                            btnAccionesBorrar.setAttribute('CLASS','btn btn-outline-primary');
                            btnAccionesBorrar.setAttribute('VALUE',evidence.id);
                            btnAccionesBorrar.setAttribute('style','border-style: hidden');
                            btnAccionesBorrar.setAttribute('type','button');
                            btnAccionesBorrar.setAttribute('name','btnABorrar');
                            btnAccionesBorrar.setAttribute('onclick','eliminarEvidencia('+evidence.id+');');

                            const iIconEdit = document.createElement('i');
                            iIconEdit.setAttribute('CLASS','fa-solid fa-pen-to-square');

                            const iIconTrash = document.createElement('i');
                            iIconTrash.setAttribute('CLASS','fa-solid fa-trash');

                            btnAccionesActualizar.appendChild(iIconEdit);
                            btnAccionesBorrar.appendChild(iIconTrash);
                            divAcciones.appendChild(btnAccionesActualizar);
                            divAcciones.appendChild(btnAccionesBorrar);
                            tdAcciones.appendChild(divAcciones);

                            tr.appendChild(tdID);
                            tr.appendChild(tdTitle);
                            tr.appendChild(tdDescription);
                            tr.appendChild(tdType);
                            tr.appendChild(tdTypeFile);
                            tr.appendChild(tdAuthors);
                            tr.appendChild(tdEstado);
                            tr.appendChild(tdAcciones);
                        
                            table.appendChild(tr);
                        });
                    });
                };
                readEvidences();
            </script>
            <script>
                function eliminarEvidencia(idEvidencia) {
                    axios.delete('http://localhost:8887/joins/deleteEvidenceWithDetails/'+idEvidencia).then(res => {
                        window.location.reload()}
                    );
                }
            </script>
    </div>

    <!-- Modal nueva evidencia -->

    <div class="modal fade" id="staticBackdrop" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Evidencia</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="idViewEvidencia" action="ViewEvidencia.php" method="post" class="row g-3 needs-validation"
                        validate>
                        <div class="row">
                            <div class="row g-3">
                                <div class="col">
                                    <label>ID Evidencia</label>
                                    <input class="form-control" type="text" name="ID_EVIDENCIA"
                                        value="<?php echo $idEvi ?>" required>
                                </div>
                                <div class="col">
                                    <label>Titulo</label>
                                    <input class="form-control" type="text" name="TITULO" value="<?php echo $titu ?>"
                                        required>
                                </div>
                                <div class="col">
                                    <label>Descripcion</label>
                                    <input class="form-control" type="text" name="DESCRIPCIÓN"
                                        value="<?php echo $descrip ?>" required>
                                </div>
                            </div>

                            <div class="row g-3">
                                <div class="col">
                                    <label>Tipo</label>
                                    <input class="form-control" type="text" name="TIPO" value="<?php echo $tipo?>"
                                        required>
                                </div>
                                <div class="col">
                                    <label>Tipo archivo</label>
                                    <input class="form-control" type="text" name="TIPO_ARCHIVO"
                                        value="<?php echo $TipoArchivo ?>" required>
                                </div>
                                <div class="col">
                                    <label>Fecha creacion evidencia</label>
                                    <input class="form-control" type="date" name="FECHA_CREACION_EVIDENCIA"
                                        value="<?php echo $FechaCreacionEvi ?>" required>
                                </div>
                            </div>

                            <div class="row g-3">
                                <div class="col">
                                    <label>Fecha registro evidencia</label>
                                    <input class="form-control" type="date" name="FECHA_REGISTRO_EVIDENCIA"
                                        value="<?php echo $FechaRegistroEvi ?>" required>
                                </div>
                                <div class="col">
                                    <label>Autores</label>
                                    <input class="form-control" type="text" name="AUTORES" value="<?php echo $Autores?>"
                                        required>
                                </div>
                                <div class="col">
                                    <label>Observacion</label>
                                    <input class="form-control" type="text" name="OBSERVACION"
                                        value="<?php echo $Observacion ?>" required>
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

    <!-- Modal editar -->

    <div class="modal fade" id="editar" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
        aria-labelledby="staticBackdropLabel" aria-hidden="true">
        <div class="modal-dialog modal-xl">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="staticBackdropLabel">Evidencia</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <form id="idViewEvidencia" action="ViewEvidencia.php" method="post" class="row g-3 needs-validation"
                        validate>
                        <div class="row">
                            <div class="row g-3">
                                <div class="col">
                                    <label>ID Evidencia</label>
                                    <input class="form-control" type="text" name="ID_EVIDENCIA2" id="ID_EVIDENCIA2"
                                        readonly="readonly" value="" required>
                                </div>
                                <div class="col">
                                    <label>Titulo</label>
                                    <input class="form-control" type="text" name="TITULO2" id="TITULO2" value=""
                                        required>
                                </div>
                                <div class="col">
                                    <label>Descripcion</label>
                                    <input class="form-control" type="text" name="DESCRIPCIÓN2" id="DESCRIPCIÓN2"
                                        value="" required>
                                </div>
                            </div>

                            <div class="row g-3">
                                <div class="col">
                                    <label>Tipo</label>
                                    <input class="form-control" type="text" name="TIPO2" id="TIPO2" value="" required>
                                </div>
                                <div class="col">
                                    <label>Tipo archivo</label>
                                    <input class="form-control" type="text" name="TIPO_ARCHIVO2" id="TIPO_ARCHIVO2"
                                        value="" required>
                                </div>
                                <div class="col">
                                    <label>Fecha creacion evidencia</label>
                                    <input class="form-control" type="date" name="FECHA_CREACION_EVIDENCIA2"
                                        id="FECHA_CREACION_EVIDENCIA2" value="" required>
                                </div>
                            </div>

                            <div class="row g-3">
                                <div class="col">
                                    <label>Fecha registro evidencia</label>
                                    <input class="form-control" type="date" name="FECHA_REGISTRO_EVIDENCIA2"
                                        id="FECHA_REGISTRO_EVIDENCIA2" value="" required>
                                </div>
                                <div class="col">
                                    <label>Autores</label>
                                    <input class="form-control" type="text" name="AUTORES2" id="AUTORES2" value=""
                                        required>
                                </div>
                                <div class="col">
                                    <label>Observacion</label>
                                    <input class="form-control" type="text" name="OBSERVACION2" id="OBSERVACION2"
                                        value="" required>
                                </div>
                            </div>


                        </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-danger" data-bs-dismiss="modal">Cancelar</button>
                    <button class="btn btn-primary" value="Editar" name="btn" type="submit"><i
                            class="fa-regular fa-floppy-disk"></i> Editar</button>
                </div>
            </div>
            </form>
        </div>
    </div>
</body>

</html>