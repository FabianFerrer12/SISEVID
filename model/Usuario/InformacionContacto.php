<?php


class InformacionContacto{
    private string $TIPO_DOCUMENTO;
    private string $NUMERO_DOCUMENTO;
    private string $NOMBRES;
    private string $APELLIDOS;
    private string $NUMERO_CONTACTO;
    private string $EMAIL;
    private string $USUARIO_CREACION;

    function __construct(string $TIPO_DOCUMENTO, string $NUMERO_DOCUMENTO, string $NOMBRES, string $APELLIDOS,string $NUMERO_CONTACTO,
    string $EMAIL,string $USUARIO_CREACION){ //Constructor con parametros
        $this->TIPO_DOCUMENTO=$TIPO_DOCUMENTO;
        $this->NUMERO_DOCUMENTO=$NUMERO_DOCUMENTO;
        $this->NOMBRES=$NOMBRES;
        $this->APELLIDOS=$APELLIDOS;
        $this->NUMERO_CONTACTO=$NUMERO_CONTACTO;
        $this->EMAIL=$EMAIL;
        $this->USUARIO_CREACION=$USUARIO_CREACION;
    }

    function getTIPO_DOCUMENTO(){
        return $this->TIPO_DOCUMENTO;
    }

    function setTIPO_DOCUMENTO($TIPO_DOCUMENTO){
        return $this->TIPO_DOCUMENTO=$TIPO_DOCUMENTO;
    }

    function getNUMERO_DOCUMENTO(){
        return $this->NUMERO_DOCUMENTO;
    }

    function setNUMERO_DOCUMENTO($NUMERO_DOCUMENTO){
        return $this->NUMERO_DOCUMENTO=$NUMERO_DOCUMENTO;
    }
    function getNOMBRES(){
        return $this->NOMBRES;
    }

    function setNOMBRES($NOMBRES){
        return $this->NOMBRES=$NOMBRES;
    }

    function getAPELLIDOS(){
        return $this->APELLIDOS;
    }

    function setAPELLIDOS($APELLIDOS){
        return $this->APELLIDOS=$APELLIDOS;
    }

    function getNUMERO_CONTACTO(){
        return $this->NUMERO_CONTACTO;
    }

    function setNUMERO_CONTACTO($NUMERO_CONTACTO){
        return $this->NUMERO_CONTACTO=$NUMERO_CONTACTO;
    }
    
    function getEMAIL(){
        return $this->EMAIL;
    }

    function setEMAIL($EMAIL){
        return $this->EMAIL=$EMAIL;
    }

    function getUSUARIO_CREACION(){
        return $this->USUARIO_CREACION;
    }

    function setUSUARIO_CREACION($USUARIO_CREACION){
        return $this->USUARIO_CREACION=$USUARIO_CREACION;
    }

}

?>