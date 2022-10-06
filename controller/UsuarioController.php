<?php
class UsuarioController
{
    var $usuario;

    

    function guardarEvidencia()
    {
        $ID_Evidencia = $this->objEvidencia->getID_EVIDENCIA();
        $titu = $this->objEvidencia->getTitulo();
        $des = $this->objEvidencia->getDescripcion();
        $tip = $this->objEvidencia->getTipo();
        $tipoarchivo = $this->objEvidencia->getTIPOARCHIVO();
        $fechaCre = $this->objEvidencia->getFechaCreacion();
        $fechaRegistroEvi = $this->objEvidencia->getFechaRegistroEvidencia();
        $autores = $this->objEvidencia->getAutores();
        $Observacion = $this->objEvidencia->getObservacion();
        $Estado = $this->objEvidencia->getESTADO();
        $USUARIO_CREACION = $this->objEvidencia->getUSUARIO_CREACION();
        $FechaCreacion = $this->objEvidencia->getFECHA_CREACION();
        $ID_LUGAR = $this->objEvidencia->getID_LUGAR();


        $sql = "INSERT INTO evidencia VALUES('" . $ID_Evidencia . "','" . $titu . "','" . $des . "','" . $tip . "','" . $tipoarchivo . "','" . $fechaCre . "','" . $fechaRegistroEvi . "','" . $autores . "','" . $Observacion . "','','" . $Estado . "','" . $USUARIO_CREACION . "','" . $FechaCreacion . "')";
        $DB = new ControlConexion();
        $DB->abrirBd("localhost", "root", "", "SISEVID", 3306);
        $DB->ejecutarComandoSql($sql);
        $DB->cerrarBd();
    }

    function consultar(string $user, string $password)
    {

        $sql = "SELECT * FROM sisevid.usuario WHERE sisevid.usuario.USUARIO = '" . $user . "' and sisevid.usuario.CONTRASEÑA = '" . $password . "';";
        $DB = new ControlConexion();
        $DB->abrirBd("localhost", "root", "", "SISEVID", 3306);
        $recordSet = $DB->ejecutarSelect($sql);
        if ($row = $recordSet->fetch_array(MYSQLI_BOTH)) {
            $DB->cerrarBd();
            return true;
        }
        $DB->cerrarBd();
        return false;
    }
}
