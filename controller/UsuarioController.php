<?php

use JetBrains\PhpStorm\ArrayShape;

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
            
            $sql = "INSERT INTO `sisevid`.`usuario` (`ID_USUARIO`,`ID_USUARIO_INFO_CONTACTO`,`USUARIO`,`CONTRASEÑA`,`USUARIO_CREACION`,`FECHA_CREACION`) VALUES ('" . $ID_USER . "','" . $ID_C_I . "','" . $USER . "','" . $PASSWORD . "','" . $USUARIO_CREACION . "',NOW());";
            $sqlRol = "INSERT INTO USUARIO_ROLES_INTERMEDIA(ID_USUARIO, ID_USUARIO_ROLES) VALUES ('" . $ID_USER . "','" . $usuarioRolId . "');";

            $DB->ejecutarComandoSql($sql);
            $DB->ejecutarComandoSql($sqlRol);
            $DB->cerrarBd();
            echo '<script language="javascript">alert("Se registro correctamente el usuario");</script>';
        } catch (Exception $e) {
            echo '<script language="javascript">alert("No se pudo registrar el usuario");</script>';
            echo '<script language="javascript">alert("Exception: ' . $e . '");</script>';
        }
    }

    function consultarUsuario(string $user, string $password)
    {
        $sql = "SELECT * FROM usuario WHERE USUARIO = '" . $user . "' and CONTRASEÑA = '" . $password . "';";
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
        $sql = "SELECT UR.DESCRIPCION FROM USUARIO US INNER JOIN USUARIO_ROLES_INTERMEDIA URI ON US.ID_USUARIO = URI.ID_USUARIO INNER JOIN USUARIO_ROLES UR  ON URI.ID_USUARIO_ROLES = UR.ID_USUARIO_ROLES WHERE US.USUARIO = '$user' AND US.CONTRASEÑA = '$password'";
        
        $DB = new ControlConexion();
        $DB->abrirBd("localhost", "root", "", "SISEVID", 3306);
        $recordSet = $DB->ejecutarSelect($sql);
        $result2 = [];
        $i = 0;

        while($row = $recordSet->fetch_array()){
            $result2[$i]= $row['DESCRIPCION'];
            $i++;
        }
        
        $DB->cerrarBd();
        return $result2;
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
        $sql = "SELECT * FROM `usuario_roles`";
        $DB = new ControlConexion();
        $DB->abrirBd("localhost", "root", "", "SISEVID", 3306);
        $recordSet = $DB->ejecutarSelect($sql);

        $result = [];
        $i = 0;

        while($row = $recordSet->fetch_array()){
            $result[$i]= $row['DESCRIPCION'];
            $i++;
        }
        
        $DB->cerrarBd();
        return $result;
    }
}
