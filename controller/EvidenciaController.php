<?php
    class EvidenciaController{
        var $objEvidencia;

        function __construct($objEvidencia){
            $this->objEvidencia = $objEvidencia;
        }

        function guardarEvidencia(){
            $ID_Evidencia=$this->objEvidencia->getID_EVIDENCIA();
            $titu=$this->objEvidencia->getTitulo();
            $des=$this->objEvidencia->getDescripcion();
            $tip=$this->objEvidencia->getTipo();
            $tipoarchivo=$this->objEvidencia->getTIPOARCHIVO();
            $fechaCre=$this->objEvidencia->getFechaCreacion();
            $fechaRegistroEvi=$this->objEvidencia->getFechaRegistroEvidencia();
            $autores=$this->objEvidencia->getAutores();
            $Observacion=$this->objEvidencia->getObservacion();
            $Estado=$this->objEvidencia->getESTADO();
            $USUARIO_CREACION=$this->objEvidencia->getUSUARIO_CREACION();
            $FechaCreacion=$this->objEvidencia->getFECHA_CREACION();
            $ID_LUGAR=$this->objEvidencia->getID_LUGAR();


            $sql="INSERT INTO evidencia VALUES('".$ID_Evidencia."','".$titu."','".$des."','".$tip."','".$tipoarchivo."','".$fechaCre."','".$fechaRegistroEvi."','".$autores."','".$Observacion."','','".$Estado."','".$USUARIO_CREACION."','".$FechaCreacion."')";
            $DB = new ControlConexion();
            $DB->abrirBd("localhost","root","","SISEVID", 3306);
            $DB->ejecutarComandoSql($sql);
            $DB->cerrarBd();
        }   


        function borrar(){
            $ID_EVIDENCIA = $this->$objEvidencia->getID_EVIDENCIA();

            $sql="DELETE FROM evidencia WHERE ID_EVIDENCIA='".$ID_EVIDENCIA."'";
            $DB = new ControlConexion();
            $DB->abrirBd("localhost","root","","SISEVID", 3306);
            $DB->ejecutarComandoSql($sql);
            $DB->cerrarBd();
        }

        function consultar(){

            $ID_EVIDENCIA = $this->$objEvidencia->getID_EVIDENCIA();

            $sql="SELECT * FROM evidencia WHERE ID_EVIDENCIA='".$ID_EVIDENCIA."'";
            $DB = new ControlConexion();
            $DB->abrirBd("localhost","root","","SISEVID", 3306);
            $recordSet=$DB->ejecutarSelect($sql);
            if($row = $recordSet->fetch_array(MYSQLI_BOTH)){
                $this->$objEvidencia->setTitulo($row['TITULO']);
                $this->$objEvidencia->setDescripcion($row['DESCRIPCIÓN']);
                $this->$objEvidencia->setTipo($row['TIPO']);
                $this->objEvidencia->setTIPOARCHIVO($row['TIPO_ARCHIVO']);
                $this->$objEvidencia->setFechaCreacion($row['FECHA_CREACION_EVIDENCIA']);
                $this->$objEvidencia->setFechaRegistroEvidencia($row['FECHA_REGISTRO_EVIDENCIA']);
                $this->$objEvidencia-setAutores($row['AUTORES']);
                $this->$objEvidencia->setObservacion($row['OBSERVACION']);
                $this->$objEvidencia->setID_LUGAR($row['ID_LUGAR_GEOGRAFICO ']);
                $this->$objEvidencia->setESTADO($row['ESTADO']);
                $this->$objEvidencia->setUSUARIO_CREACION($row['USUARIO_CREACION']);
                $this->$objEvidencia->setFECHA_CREACION($row['FECHA_CREACION']);
            }
            $DB->cerrarBd();
            return $this->$objEvidencia;
        }

        function actualizar(){
            $titu=$this->objEvidencia->getTitulo();
            $des=$this->objEvidencia->getDescripcion();
            $tip=$this->objEvidencia->getTipo();
            $tipoarchivo=$this->objEvidencia->getTIPOARCHIVO();
            $fechaCre=$this->objEvidencia->getFechaCreacion();
            $fechaRegistroEvi=$this->objEvidencia->getFechaRegistroEvidencia();
            $autores=$this->objEvidencia->getAutores();
            $Observacion=$this->objEvidencia->getObservacion();
            $Estado=$this->objEvidencia->getESTADO();
            $ID_Evidencia=$this->objEvidencia->getID_EVIDENCIA();
            $USUARIO_CREACION=$this->objEvidencia->getUSUARIO_CREACION();
            $FechaCreacion=$this->objEvidencia->getFECHA_CREACION();
            $ID_LUGAR=$this->objEvidencia->getID_LUGAR();

            $sql="UPDATE evidencia SET TITULO='".$titu."',DESCRIPCIÓN='".$des."',TIPO='".$tip."',TIPO_ARCHIVO='".$tipoarchivo."',FECHA_CREACION_EVIDENCIA='".$fechaCre."',FECHA_REGISTRO_EVIDENCIA='".$fechaRegistroEvi."',AUTORES='".$autores."',OBSERVACION='".$Observacion."',ID_LUGAR_GEOGRAFICO='".$ID_LUGAR."',ESTADO='".$Estado."',USUARIO_CREACION='".$USUARIO_CREACION."',FECHA_CREACION='".$FechaCreacion."'WHERE ID_EVIDENCIA='".$ID_Evidencia."'";
            $DB = new ControlConexion();
            $DB->abrirBd("localhost","root","","SISEVID", 3306);
            $DB->ejecutarComandoSql($sql);
            $DB->cerrarBd();
        }

        function listar(){
            $cod = $this->objEvidencia->getID_EVIDENCIA();
            $mat=[];
            $i=0;

            $sql="SELECT * FROM evidencia";
            $DB = new ControlConexion();
            $DB->abrirBd("localhost","root","","SISEVID", 3306);
            $recordSet=$DB->ejecutarSelect($sql);
            while($row = $recordSet->fetch_array(MYSQLI_BOTH)){
                $mat[$i][0]=$row['codigo'];
                $mat[$i][1]=$row['nombre'];
                $mat[$i][2]=$row['telefono'];
                $mat[$i][3]=$row['email'];
                $mat[$i][4]=$row['direccion'];
                $i++;
            }
            $DB->cerrarBd();
            return $mat;
        }


    }
?>