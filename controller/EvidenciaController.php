<?php
    class EvidenciaController{
        var $objEvidencia;

        function __construct($objEvidencia){
            $this->objEvidencia = $objEvidencia;
            // var_dump($objEvidencia);
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
            $USUARIO_CREACION=$_SESSION['USER'];
            // $FechaCreacion=$this->objEvidencia->getFECHA_CREACION();
            $ID_LUGAR=$this->objEvidencia->getID_LUGAR();
            $sql="INSERT INTO EVIDENCIA (ID_EVIDENCIA,TITULO,DESCRIPCIÓN,TIPO,TIPO_ARCHIVO,FECHA_CREACION_EVIDENCIA,FECHA_REGISTRO_EVIDENCIA,AUTORES,OBSERVACION,ESTADO,USUARIO_CREACION,FECHA_CREACION) VALUES('$ID_Evidencia','$titu','$des','$tip','$tipoarchivo','$fechaCre','$fechaRegistroEvi','$autores','$Observacion','$Estado','$USUARIO_CREACION',NOW())";
            $DB = new ControlConexion();
            $DB->abrirBd("localhost","root","","SISEVID", 3306);
            $DB->ejecutarComandoSql($sql);
            $DB->cerrarBd();

            // echo($DB);
        }   


        function borrar($id_evidencia){
            // $ID_Evidencia=$this->objEvidencia->getID_EVIDENCIA();

            $sql="DELETE FROM evidencia WHERE ID_EVIDENCIA='$id_evidencia'";
            $DB = new ControlConexion();
            $DB->abrirBd("localhost","root","","SISEVID", 3306);
            $DB->ejecutarComandoSql($sql);
            $DB->cerrarBd();
        }

        function consultar($id_evidencia){
            // $ID_Evidencia=$this->objEvidencia->getID_EVIDENCIA();
            $mysqli = new mysqli("localhost","root","","SISEVID");

            if ($mysqli -> connect_errno) {
                echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
                exit();
            }

            $sql = "SELECT * FROM evidencia WHERE ID_EVIDENCIA='$id_evidencia'";
            $result = $mysqli -> query($sql);

            // Associative array
            $row = $result -> fetch_assoc();
            // echo ($row['AUTORES']);
            $this->objEvidencia->setTitulo($row['TITULO']);
            $this->objEvidencia->setDescripcion($row['DESCRIPCIÓN']);
            $this->objEvidencia->setTipo($row['TIPO']);
            $this->objEvidencia->setTIPOARCHIVO($row['TIPO_ARCHIVO']);
            $this->objEvidencia->setFechaCreacion($row['FECHA_CREACION_EVIDENCIA']);
            $this->objEvidencia->setFechaRegistroEvidencia($row['FECHA_REGISTRO_EVIDENCIA']);
            $this->objEvidencia->setAutores($row['AUTORES']);
            $this->objEvidencia->setObservacion($row['OBSERVACION']);
            // $this->objEvidencia->setID_LUGAR($row['ID_LUGAR_GEOGRAFICO']);
            $this->objEvidencia->setESTADO($row['ESTADO']);
            // Free result set
            $result -> free_result();
            $mysqli -> close();

            return $this->objEvidencia;
        }

        function buscar($titulo){
            // $ID_Evidencia=$this->objEvidencia->getID_EVIDENCIA();
            $mysqli = new mysqli("localhost","root","","SISEVID");
            $mat=[];
            $i=0;

            if ($mysqli -> connect_errno) {
                echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
                exit();
            }

            $sql = "SELECT * FROM evidencia WHERE TITULO LIKE '%$titulo%'";

            $resultado=$mysqli->query($sql);
            while($row = $resultado->fetch_assoc()){
                $mat[$i][0]=$row['TITULO'];
                $mat[$i][1]=$row['DESCRIPCIÓN'];
                $mat[$i][2]=$row['TIPO'];
                $mat[$i][3]=$row['TIPO_ARCHIVO'];
                $mat[$i][4]=$row['FECHA_CREACION_EVIDENCIA'];
                $mat[$i][5]=$row['FECHA_REGISTRO_EVIDENCIA'];
                $mat[$i][6]=$row['AUTORES'];
                $mat[$i][7]=$row['OBSERVACION'];
                $mat[$i][8]=$row['ESTADO'];
                $mat[$i][9]=$row['ID_EVIDENCIA'];
                $i++;
            }
            $resultado->free_result();
            $mysqli -> close();
            return $mat;
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
            // $USUARIO_CREACION=$this->objEvidencia->getUSUARIO_CREACION();
            // $FechaCreacion=$this->objEvidencia->getFECHA_CREACION();
            // $ID_LUGAR=$this->objEvidencia->getID_LUGAR();


            $mysqli = new mysqli("localhost","root","","SISEVID");

            if ($mysqli -> connect_errno) {
                echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
                exit();
            }

            $sql="UPDATE evidencia SET TITULO='$titu',DESCRIPCIÓN='$des',TIPO='$tip',TIPO_ARCHIVO='$tipoarchivo',FECHA_CREACION_EVIDENCIA='$fechaCre',FECHA_REGISTRO_EVIDENCIA='$fechaRegistroEvi',AUTORES='$autores',OBSERVACION='$Observacion',ESTADO='$Estado' WHERE ID_EVIDENCIA='$ID_Evidencia'";

            $result = $mysqli -> query($sql);

            // Associative array
            // $row = $result -> fetch_assoc();

            // Free result set
            // $result -> free_result();
            $mysqli -> close();
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
                $mat[$i][0]=$row['TITULO'];
                $mat[$i][1]=$row['DESCRIPCIÓN'];
                $mat[$i][2]=$row['TIPO'];
                $mat[$i][3]=$row['TIPO_ARCHIVO'];
                $mat[$i][4]=$row['FECHA_CREACION_EVIDENCIA'];
                $mat[$i][5]=$row['FECHA_REGISTRO_EVIDENCIA'];
                $mat[$i][6]=$row['AUTORES'];
                $mat[$i][7]=$row['OBSERVACION'];
                $mat[$i][8]=$row['ESTADO'];
                $mat[$i][9]=$row['ID_EVIDENCIA'];
                $i++;
            }
            $DB->cerrarBd();
            return $mat;
        }


    }
?>