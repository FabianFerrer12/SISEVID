<?php

class Usuario{
    private string $ID;
    private string $USER;
    private string $PASSWORD;

    
    function __construct(string $USER,string $PASSWORD){ //Constructor con parametros
        $this->ID = "";
        $this->USER=$USER;
        $this->PASSWORD=$PASSWORD;     
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
}

?>