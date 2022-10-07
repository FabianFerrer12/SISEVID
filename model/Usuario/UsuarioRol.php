<?php

class UsuarioRol{
    private string $ID;
    private string $DESCRIPCION;
    
    
    function __construct(string $DESCRIPCION){ //Constructor con parametros
        $this->DESCRIPCION=$DESCRIPCION;     
    }
       
    function getID(){
        return $this->ID;
    }

    function setID($ID){
        return $this->ID=$ID;
    }

    function getDESCRIPCION(){
        return $this->DESCRIPCION;
    }

    function setDESCRIPCION($DESCRIPCION){
        return $this->DESCRIPCION=$DESCRIPCION;
    }    
}

?>