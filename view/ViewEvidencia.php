<?php
    include '../model/Evidencia.php';
    include '../controller/DB.php';
    include '../controller/EvidenciaController.php';

    $idEvi= "";
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

    $bot = "";
    if(isset($_POST['ID_EVIDENCIA']))$idEvi = $_POST['ID_EVIDENCIA'];
    if(isset($_POST['TITULO']))$titu = $_POST['TITULO'];
    if(isset($_POST['DESCRIPCIÓN']))$descrip = $_POST['DESCRIPCIÓN'];
    if(isset($_POST['TIPO']))$tipo = $_POST['TIPO'];
    if(isset($_POST['TIPO_ARCHIVO']))$TipoArchivo = $_POST['TIPO_ARCHIVO'];
    if(isset($_POST['FECHA_CREACION_EVIDENCIA']))$FechaCreacionEvi = $_POST['FECHA_CREACION_EVIDENCIA'];
    if(isset($_POST['FECHA_REGISTRO_EVIDENCIA']))$FechaRegistroEvi = $_POST['FECHA_REGISTRO_EVIDENCIA'];
    if(isset($_POST['AUTORES']))$Autores = $_POST['AUTORES'];
    if(isset($_POST['OBSERVACION']))$Observacion = $_POST['OBSERVACION'];
    if(isset($_POST['ID_LUGAR_GEOGRAFICO']))$IDLugarGeo = $_POST['ID_LUGAR_GEOGRAFICO'];
    if(isset($_POST['ESTADO']))$Estado = $_POST['ESTADO'];
    if(isset($_POST['USUARIO_CREACION']))$UsuarioCreacion = $_POST['USUARIO_CREACION'];
    if(isset($_POST['FECHA_CREACION']))$FechaCreacion = $_POST['FECHA_CREACION'];


    if(isset($_POST['btn']))$bot = $_POST['btn'];
   

    switch ($bot) {
        case 'Guardar':
            $objEvidencia= new Evidencia($idEvi,$titu,$descrip,$tipo,$TipoArchivo,$FechaCreacionEvi,$FechaRegistroEvi,$Autores,$Observacion,$IDLugarGeo,$Estado,$UsuarioCreacion,$FechaCreacion);
            $objEvidenciaController = new EvidenciaController($objEvidencia);
            $objEvidenciaController->guardarEvidencia();
            // var_dump($objEvidencia); 
            break;
        case 'Consultar':
            $objEvidencia= new Evidencia($idEvi,"","","","","","","","","","","","");
            $objEvidenciaController = new EvidenciaController($objEvidencia);
            $objEvidencia=$objEvidenciaController->consultar();
            //var_dump($objEvidencia);
            break;

        case 'Modificar':
          $objEvidencia= new Evidencia($idEvi,$titu,$descrip,$tipo,$TipoArchivo,$FechaCreacionEvi,$FechaRegistroEvi,$Autores,$Observacion,$IDLugarGeo,$Estado,$UsuarioCreacion,$FechaCreacion);
            $objEvidenciaController = new EvidenciaController($objEvidencia);
            $objEvidenciaController->modificar();
            break;

        case 'Borrar':
          $objEvidencia= new Evidencia($idEvi,$titu,$descrip,$tipo,$TipoArchivo,$FechaCreacionEvi,$FechaRegistroEvi,$Autores,$Observacion,$IDLugarGeo,$Estado,$UsuarioCreacion,$FechaCreacion);
            $objEvidenciaController = new EvidenciaController($objEvidencia);
            $objEvidenciaController->borrar();
            break;
        
        case 'Listar':
          $objEvidencia= new Evidencia($idEvi,$titu,$descrip,$tipo,$TipoArchivo,$FechaCreacionEvi,$FechaRegistroEvi,$Autores,$Observacion,$IDLugarGeo,$Estado,$UsuarioCreacion,$FechaCreacion);
            $objEvidenciaController = new EvidenciaController($objEvidencia);
            $mat=$objEvidenciaController->listar();
            
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
<div class="container-fluid p-5 bg-primary text-white text-center">
  <h1>Datos Evidencia</h1>
</div>
  
<div class="container mt-5">

  <div class="row">
    <div class="col-sm-4">
      ID_EVIDENCIA
    </div>
    <div class="col-sm-4">
      <input type="text" name="ID_EVIDENCIA" style="width: 500px;" value="<?php echo $idEvi?>">
    </div>
    <div class="col-sm-4">
  
    </div>
  </div>

  <div class="row">
    <div class="col-sm-4">
      TITULO
    </div>
    <div class="col-sm-4">
      <input type="text" name="TITULO" style="width: 500px;" value="<?php echo $titu?>">
    </div>
    <div class="col-sm-4">
  
    </div>
  </div>

  <div class="row">
    <div class="col-sm-4">
      DESCRIPCION
    </div>
    <div class="col-sm-4">
      <input type="text" name="DESCRIPCIÓN" style="width: 500px;" value="<?php echo $descrip?>">
    </div>
    <div class="col-sm-4">
  
    </div>
  </div>

  <div class="row">
    <div class="col-sm-4">
      TIPO
    </div>
    <div class="col-sm-4">
      <input type="text" name="TIPO" style="width: 500px;" value="<?php echo $tipo?>">
    </div>
    <div class="col-sm-4">
  
    </div>
  </div>
  
  <div class="row">
    <div class="col-sm-4">
      Tipo archivo
    </div>
    <div class="col-sm-4">
      <input type="text" name="TIPO_ARCHIVO" style="width: 500px;" value="<?php echo $TipoArchivo?>">
    </div>
    <div class="col-sm-4">
  
    </div>
  </div>
  
  <div class="row">
    <div class="col-sm-4">
      Fecha creacion evidencia
    </div>
    <div class="col-sm-4">
      <input type="date" name="FECHA_CREACION_EVIDENCIA" style="width: 500px;" value="<?php echo $FechaCreacionEvi?>">
    </div>
    <div class="col-sm-4">
  
    </div>
  </div>
  
  <div class="row">
    <div class="col-sm-4">
      Fecha registro evidencia
    </div>
    <div class="col-sm-4">
      <input type="date" name="FECHA_REGISTRO_EVIDENCIA" style="width: 500px;" value="<?php echo $FechaRegistroEvi?>">
    </div>
    <div class="col-sm-4">
  
    </div>
  </div>
  
  <div class="row">
    <div class="col-sm-4">
      Autores
    </div>
    <div class="col-sm-4">
      <input type="text" name="AUTORES" style="width: 500px;" value="<?php echo $Autores?>">
    </div>
    <div class="col-sm-4">
  
    </div>
  </div>

  <div class="row">
    <div class="col-sm-4">
      Observacion
    </div>
    <div class="col-sm-4">
      <input type="text" name="OBSERVACION" style="width: 500px;" value="<?php echo $Observacion?>">
    </div>
    <div class="col-sm-4">
  
    </div>
  </div>

  <div class="row">
    <div class="col-sm-4">
      ID_LUGAR_GEOGRAFICO
    </div>
    <div class="col-sm-4">
      <input type="text" name="ID_LUGAR_GEOGRAFICO" style="width: 500px;" value="<?php echo $IDLugarGeo?>">
    </div>
    <div class="col-sm-4">
  
    </div>
  </div>

  <div class="row">
    <div class="col-sm-4">
      ESTADO
    </div>
    <div class="col-sm-4">
      <input type="text" name="ESTADO" style="width: 500px;" value="<?php echo $Estado?>">
    </div>
    <div class="col-sm-4">
  
    </div>
  </div>

  <div class="row">
    <div class="col-sm-4">
      Usuario Creacion
    </div>
    <div class="col-sm-4">
      <input type="text" name="USUARIO_CREACION" style="width: 500px;" value="<?php echo $UsuarioCreacion?>">
    </div>
    <div class="col-sm-4">
  
    </div>
  </div>

  <div class="row">
    <div class="col-sm-4">
      Fecha Creacion
    </div>
    <div class="col-sm-4">
      <input type="time" name="FECHA_CREACION" style="width: 500px;" value="<?php echo $FechaCreacion?>">
    </div>
    <div class="col-sm-4">
  
    </div>
  </div>

<div class="row">
    <div class="col-sm-1">
    </div>
    <div class="col-sm-2">
        <input type="submit" value="Guardar" name="btn"/>
    </div>
    <div class="col-sm-2">
        <input type="submit" value="Consultar" name="btn"/>
    </div> 
    <div class="col-sm-2">
        <input type="submit" value="Modificar" name="btn"/>
    </div>     
    <div class="col-sm-2">
        <input type="submit" value="Borrar" name="btn"/>
    </div> 
    <div class="col-sm-2">
        <input type="submit" value="Listar" name="btn"/>
    </div>   
    <div class="col-sm-1">
    </div>  
</div>

<div class="container mt-5">
<?php
  for ($i=0; $i < sizeof($mat) ; $i++) { 
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
<?php }?>
</div>
</form>  
</body>
</html>

