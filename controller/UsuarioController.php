<?php
include_once 'DB.php';
class UsuarioController
{
    function crearUsuario(Usuario $user)
    {

        try {

            $ID_USER = $user->getID();
            $USER = $user->getUSER();
            $PASSWORD = $user->getPASSWORD();
            $CONTACT_INFO = $user->getCONTACT_INFO();
            $ID_C_I = $CONTACT_INFO->getID();
            $TIPO_DOCUMENTO = $CONTACT_INFO->getTIPO_DOCUMENTO();
            $NUMERO_DOCUMENTO = $CONTACT_INFO->getNUMERO_DOCUMENTO();
            $NOMBRES = $CONTACT_INFO->getNOMBRES();
            $APELLIDOS = $CONTACT_INFO->getAPELLIDOS();
            $NUMERO_CONTACTO = $CONTACT_INFO->getNUMERO_CONTACTO();
            $EMAIL = $CONTACT_INFO->getEMAIL();
            $USUARIO_CREACION = $CONTACT_INFO->getUSUARIO_CREACION();

            $sql = "INSERT INTO `sisevid`.`usuario_info_contacto` (`ID_USUARIO_INFO_CONTACTO`,`TIPO_DOCUMENTO`,`NUMERO_DOCUMENTO`,`NOMBRES`,`APELLIDOS`,`NUMERO_CONTACTO`,`EMAIL`,`USUARIO_CREACION`,`FECHA_CREACION`) VALUES ('" . $ID_C_I . "','" . $TIPO_DOCUMENTO . "','" . $NUMERO_DOCUMENTO . "','" . $NOMBRES . "','" . $APELLIDOS . "','" . $NUMERO_CONTACTO . "','" . $EMAIL . "','" . $USUARIO_CREACION . "',CURDATE())";
            $DB = new ControlConexion();
            $DB->abrirBd("localhost", "root", "", "SISEVID", 3306);
            $DB->ejecutarComandoSql($sql);

            $USUARIO_ROL = $user->getUSUARIO_ROL();
            $description = $USUARIO_ROL->getDESCRIPCION();
            $usuarioController = new  UsuarioController();
            $usuarioRol = $usuarioController->consultarRolEspecifico($description);
            $usuarioRolId = $usuarioRol->getID();
            $sql = "INSERT INTO `sisevid`.`usuario` (`ID_USUARIO`,`ID_USUARIO_INFO_CONTACTO`,`ID_USUARIO_ROLES`,`USUARIO`,`CONTRASEÑA`,`USUARIO_CREACION`,`FECHA_CREACION`) VALUES ('" . $ID_USER . "','" . $ID_C_I . "','" . $usuarioRolId . "','" . $USER . "','" . $PASSWORD . "','" . $USUARIO_CREACION . "',CURDATE());";

            $DB->ejecutarComandoSql($sql);
            $DB->cerrarBd();
            echo '<script language="javascript">alert("Se registro correctamente el usuario");</script>';
        } catch (Exception $e) {
            echo '<script language="javascript">alert("No se pudo registrar el usuario");</script>';
            echo '<script language="javascript">alert("Exception: ' . $e . '");</script>';
        }
    }

    function consultarUsuario(string $user, string $password)
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

    function consultarDescipcionRol(string $user,string $password)
    {
        $sql = "SELECT `usuario_roles`.`DESCRIPCION` FROM `usuario_roles` INNER JOIN `usuario` ON `usuario_roles`.`ID_USUARIO_ROLES` = `usuario`.`ID_USUARIO_ROLES` WHERE `usuario`.`USUARIO` = '".$user."' AND `usuario`.`CONTRASEÑA` = '".$password."'";
        $DB = new ControlConexion();
        $DB->abrirBd("localhost", "root", "", "SISEVID", 3306);
        $recordSet = $DB->ejecutarSelect($sql);
        if ($row = $recordSet->fetch_array(MYSQLI_BOTH)) {
            $DB->cerrarBd();
            return $row['DESCRIPCION'];
        }
        $DB->cerrarBd();
        return null;
    }
    


    function consultarRolEspecifico(string $description)
    {
        $usuarioRol = null;
        $sql = "SELECT * FROM `usuario_roles` WHERE DESCRIPCION IN ('" . $description . "')";
        $DB = new ControlConexion();
        $DB->abrirBd("localhost", "root", "", "SISEVID", 3306);
        $recordSet = $DB->ejecutarSelect($sql);
        if ($row = $recordSet->fetch_array(MYSQLI_BOTH)) {
            $usuarioRol = new UsuarioRol($description);
            $usuarioRol->setID($row['ID_USUARIO_ROLES']);
        }
        $DB->cerrarBd();
        return $usuarioRol;
    }

    //AJustar para que se almacene en la lista y lo retorne
    function consultarRoles()
    {
        $usuarioRol = null;
        $sql = "SELECT * FROM `usuario_roles`";
        $DB = new ControlConexion();
        $DB->abrirBd("localhost", "root", "", "SISEVID", 3306);
        $recordSet = $DB->ejecutarSelect($sql);
        if ($row = $recordSet->fetch_array(MYSQLI_BOTH)) {
            $usuarioRol = new UsuarioRol($row['DESCRIPCION']);
            $usuarioRol->setID($row['ID']);
        }
        $DB->cerrarBd();
        return $usuarioRol;
    }
}
