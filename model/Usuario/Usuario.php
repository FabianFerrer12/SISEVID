<?php
include 'model/Usuario/InformacionContacto.php';

class Usuario{
    private string $ID;
    private string $USER;
    private string $PASSWORD;
    private InformacionContacto $CONTACT_INFO;
    
    function __construct(string $USER,string $PASSWORD,InformacionContacto $CONTACT_INFO){ //Constructor con parametros
        $this->USER=$USER;
        $this->PASSWORD=$PASSWORD;
        $this->CONTACT_INFO=$CONTACT_INFO;       
    }
       
    function getID(){
        return $this->ID;
    }

    function setID($ID){
        return $this->ID=$ID;
    }

    function getUSER(){
        return $this->USER;
    }

    function setUSER($USER){
        return $this->USER=$USER;
    }

    function getPASSWORD(){
        return $this->PASSWORD;
    }

    function PASSWORD($PASSWORD){
        return $this->PASSWORD=$PASSWORD;
    }

    function getCONTACT_INFO(){
        return $this->CONTACT_INFO;
    }

    function setCONTACT_INFO($CONTACT_INFO){
        return $this->CONTACT_INFO=$CONTACT_INFO;
    }
    
}

?>