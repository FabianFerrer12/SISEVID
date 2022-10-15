<?php
    class AutorController{
        var $objAutor;

        function __construct($objAutor){
            // var_dump($objAutor);
        
            $this->objAutor=$objAutor;
            
        }

        function guardarAutor(){
            $id = $this->objAutor->getId();
            $nombre=$this->objAutor->getNombre();
            $apellido=$this->objAutor->getApellido();
            $nacionalidad=$this->objAutor->getNacionalidad();
            $fechaNacimiento=$this->objAutor->getFechaNacimiento();
            $USUARIO_CREACION=$_SESSION['USER'];
            $sql="INSERT INTO autor (ID_AUTOR,NOMBRES,APELLIDOS,NACIONALIDAD,FECHA_NACIMIENTO,USUARIO_CREACION,FECHA_CREACION) VALUES('$id','$nombre','$apellido','$nacionalidad','$fechaNacimiento','$USUARIO_CREACION',NOW())";
            $DB = new ControlConexion();
            $DB->abrirBd("localhost","root","","SISEVID", 3306);
            $DB->ejecutarComandoSql($sql);
            $DB->cerrarBd();

        }
        function borrar($id_autor){

            $sql="DELETE FROM autor WHERE ID_AUTOR='$id_autor'";
            $DB = new ControlConexion();
            $DB->abrirBd("localhost","root","","SISEVID", 3306);
            $DB->ejecutarComandoSql($sql);
            $DB->cerrarBd();

        }
        function consultar ($id_autor){

            $mysqli = new mysqli("localhost","root","","SISEVID");
            if ($mysqli -> connect_errno) {
                echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
                exit();
            }
            $sql = "SELECT * FROM autor WHERE ID_AUTOR='$id_autor'";
            $result = $mysqli -> query($sql);
            $row = $result -> fetch_assoc();
            echo json_encode($row);
            die;
            $this->objAutor->setNombre($row['NOMBRES']);
            $this->objAutor->setApellido($row['APELLIDOS']);
            $this->objAutor->setNacionalidad($row['NACIONALIDAD']);
            $this->objAutor->setFechaNacimiento($row['FECHA_NACIMIENTO']);
            $result -> free_result();
            $mysqli -> close();
            return $this->objAutor;
        }
        function buscar($nombre){
            $mysqli = new mysqli("localhost","root","","SISEVID");
            $mat=[];
            $i=0;
            if ($mysqli -> connect_errno) {
                echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
                exit();
            }
            $sql = "SELECT * FROM autor WHERE NOMBRES LIKE '%$nombre%'";
            $resultado=$mysqli->query($sql);
            while($row = $resultado->fetch_assoc()){
                $mat[$i][0]=$row['NOMBRES'];
                $mat[$i][1]=$row['APELLIDOS'];
                $mat[$i][2]=$row['NACIONALIDAD'];
                $mat[$i][3]=$row['FECHA_NACIMIENTO'];
                $mat[$i][4]=$row['ID_AUTOR'];
                $i++;
            }
            $resultado->free_result();
            $mysqli -> close();
            return $mat;
        }
        function actualizar(){
            $id = $this->objAutor->getId();
            $nombre=$this->objAutor->getNombre();
            $apellido=$this->objAutor->getApellido();
            $nacionalidad=$this->objAutor->getNacionalidad();
            $fechaNacimiento=$this->objAutor->getFechaNacimiento();
            $mysqli = new mysqli("localhost","root","","SISEVID");
            if ($mysqli -> connect_errno) {
                echo "Failed to connect to MySQL: " . $mysqli -> connect_error;
                exit();
            }
            $sql="UPDATE autor SET NOMBRES='$nombre',APELLIDOS='$apellido',FECHA_NACIMIENTO='$fechaNacimiento' WHERE ID_AUTOR='$id'";
            $result = $mysqli -> query($sql);
            $mysqli -> close();
        }
        function listar(){
            // $id = $this->objAutor->getId();
            $mat=[];
            $i=0;
            $sql="SELECT * FROM autor";
            $DB = new ControlConexion();
            $DB->abrirBd("localhost","root","","SISEVID", 3306);
            $recordSet=$DB->ejecutarSelect($sql);
            while($row = $recordSet->fetch_array(MYSQLI_BOTH)){
                $mat[$i][0]=$row['NOMBRES'];
                $mat[$i][1]=$row['APELLIDOS'];
                $mat[$i][2]=$row['NACIONALIDAD'];
                $mat[$i][3]=$row['FECHA_NACIMIENTO'];
                $mat[$i][4]=$row['ID_AUTOR'];
                $i++;
            }
            $DB->cerrarBd();
            return $mat;
        }
    }
       
    



?>