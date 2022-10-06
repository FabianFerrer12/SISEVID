<?php
class Evidencia{
    private string $ID_EVIDENCIA;
    private string $TITULO;
    private string $DESCRIPCIÓN;
    private string $TIPO;
    private string $TIPOARCHIVO;
    private string $FECHA_CREACION_EVIDENCIA;
    private string $FECHA_REGISTRO_EVIDENCIA;
    private string $AUTORES;
    private string $OBSERVACION;
    private string $ESTADO;
    private string $ID_LUGAR_GEOGRAFICO;
    // private string $USUARIO_CREACION;
    // private string $FECHA_CREACION;

    function __construct(string $ID_EVIDENCIA,string $TITULO,string $DESCRIPCIÓN,string $TIPO,string $TIPOARCHIVO,string $FECHA_CREACION_EVIDENCIA,string $FECHA_REGISTRO_EVIDENCIA,string $AUTORES,string $OBSERVACION,string $ID_LUGAR_GEOGRAFICO,string $ESTADO){ //Constructor con parametros

        $this->ID_EVIDENCIA=$ID_EVIDENCIA;
        $this->TITULO=$TITULO;
        $this->DESCRIPCIÓN=$DESCRIPCIÓN;
        $this->TIPO=$TIPO;
        $this->TIPOARCHIVO=$TIPOARCHIVO;
        $this->FECHA_CREACION_EVIDENCIA=$FECHA_CREACION_EVIDENCIA;
        $this->FECHA_REGISTRO_EVIDENCIA=$FECHA_REGISTRO_EVIDENCIA;
        $this->AUTORES=$AUTORES;
        $this->OBSERVACION=$OBSERVACION;
        $this->ID_LUGAR_GEOGRAFICO=$ID_LUGAR_GEOGRAFICO;
        $this->ESTADO=$ESTADO;
        // $this->USUARIO_CREACION=$USUARIO_CREACION;
        // $this->FECHA_CREACION=$FECHA_CREACION;
    }
    
    function getID_EVIDENCIA(){
        return $this->ID_EVIDENCIA;
    }

    function setID_EVIDENCIA($ID_EVIDENCIA){
        return $this->ID_EVIDENCIA=$ID_EVIDENCIA;
    }

    function getTitulo(){
        return $this->TITULO;
    }

    function setTitulo($TITULO){
        return $this->TITULO=$TITULO;
    }

    function getDescripcion(){
        return $this->DESCRIPCIÓN;
    }

    function setDescripcion($DESCRIPCIÓN){
        return $this->DESCRIPCIÓN=$DESCRIPCIÓN;
    }

    function getTipo(){
        return $this->TIPO;
    }

    function setTipo($TIPO){
        return $this->TIPO=$TIPO;
    }

    function getTipoArchivo(){
        return $this->TIPOARCHIVO;
    }

    function setTIPOARCHIVO($TIPOARCHIVO){
        return $this->TIPOARCHIVO=$TIPOARCHIVO;
    }

    function getFechaCreacion(){
        return $this->FECHA_CREACION_EVIDENCIA;
    }

    function setFechaCreacion($FECHA_CREACION_EVIDENCIA){
        return $this->FECHA_CREACION_EVIDENCIA=$FECHA_CREACION_EVIDENCIA;
    }

    function getFechaRegistroEvidencia(){
        return $this->FECHA_REGISTRO_EVIDENCIA;
    }

    function setFechaRegistroEvidencia($FECHA_REGISTRO_EVIDENCIA){
        return $this->FECHA_REGISTRO_EVIDENCIA=$FECHA_REGISTRO_EVIDENCIA;
    }

    function getAutores(){
        return $this->AUTORES;
    }

    function setAutores($AUTORES){
        return $this->AUTORES=$AUTORES;
    }

    function getObservacion(){
        return $this->OBSERVACION;
    }

    function setObservacion($OBSERVACION){
        return $this->OBSERVACION=$OBSERVACION;
    }

    function getID_LUGAR(){
        return $this->ID_LUGAR_GEOGRAFICO;
    }

    function setID_LUGAR($ID_LUGAR_GEOGRAFICO){
        return $this->ID_LUGAR_GEOGRAFICO=$ID_LUGAR_GEOGRAFICO;
    }
    function getESTADO(){
        return $this->ESTADO;
    }

    function setESTADO($ESTADO){
        return $this->ESTADO=$ESTADO;
    }

    // function getUSUARIO_CREACION(){
    //     return $this->USUARIO_CREACION;
    // }

    // function setUSUARIO_CREACION($USUARIO_CREACION){
    //     return $this->USUARIO_CREACION=$USUARIO_CREACION;
    // }

    // function getFECHA_CREACION(){
    //     return $this->FECHA_CREACION;
    // }

    // function setFECHA_CREACION($FECHA_CREACION){
    //     return $this->FECHA_CREACION=$FECHA_CREACION;
    // }

}

?>