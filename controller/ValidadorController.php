<?php
    class ValidadorController{
        var $objEvidencia;

        function __construct($objEvidencia){
            $this->objEvidencia = $objEvidencia;
            // var_dump($objEvidencia);
        }

        function Validador()
        {
            $UsuarioCreacion=$_SESSION['USER'];
            $ID_Evidencia=$this->objEvidencia->getID_EVIDENCIA();
            $sql="INSERT INTO evidencia_detalle (ID_EVIDENCIA,USUARIO_MODIFICACION,FECHA_MODIFICACION,ESTADO) VALUES ('$ID_Evidencia','$UsuarioCreacion',NOW(),'3')";
            $DB = new ControlConexion();
            $DB->abrirBd("localhost","root","","SISEVID", 3306);
            $DB->ejecutarComandoSql($sql);
        }
    }
