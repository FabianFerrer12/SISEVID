<?php
    class VerificadorController{

        function Verficador($ID){

            $DB = new ControlConexion();
            $UsuarioCreacion=$_SESSION['USER'];
            $DB->abrirBd("localhost","root","","SISEVID", 3306);
            $sqlUpdate= "UPDATE evidencia_detalle SET ACTIVO = 'N' WHERE ID_EVIDENCIA = '$ID'";
            $DB->ejecutarComandoSql($sqlUpdate);
            $sql1= "INSERT INTO evidencia_detalle (ID_EVIDENCIA, USUARIO_MODIFICACION,FECHA_MODIFICACION,ESTADO,ACTIVO) VALUES ('$ID','$UsuarioCreacion',NOW(),'2','S')";
            $DB->ejecutarComandoSql($sql1);
            $DB->cerrarBd();
        }
    }