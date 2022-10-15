<?php
class Autor{
    private string $id;
    private string $nombre;
    private string $apellido;
    private string $nacionalidad;
    private string $fechaNacimiento;

    function __construct(string $id,string $nombre,string $apellido,string $nacionalidad,string $fechaNacimiento){
        $this->id=$id;
        $this->nombre=$nombre;
        $this->apellido=$apellido;
        $this->nacionalidad=$nacionalidad;
        $this->fechaNacimiento=$fechaNacimiento;
    }

    function getId(){
        return $this->id;
    }
    function setId($id){
        return $this->id=$id;
    }
    function getNombre(){
        return $this->nombre;
    }
    function setNombre($nombre){
        return $this->nombre=$nombre;
    }
    function getApellido(){
        return $this->apellido;
    }
    function setApellido($apellido){
        return $this->apellido=$apellido;
    }
    function getNacionalidad(){
        return $this->nacionalidad;
    }
    function setNacionalidad($nacionalidad){
        return $this->nacionalidad=$nacionalidad;
    }
    function getFechaNacimiento(){
        return $this->fechaNacimiento;
    }
    function setFechaNacimiento($fechaNacimiento){
        return $this->fechaNacimiento=$fechaNacimiento;
    }

    
}
