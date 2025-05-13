<?php
class Contacto {

    protected $sNombre="";

    protected $sDireccion="";

    protected $sTelefono = "";

    protected $sEmail = "";

    protected $nID = "";

    function setNombre($psNombre){
        $this->sNombre=$psNombre;
    }

    function getNombre(){
        return $this->sNombre;
    }

    function setDireccion($psDireccion){
        $this->sDireccion=$psDireccion;
    }

    function getDireccion(){
        return $this->sDireccion;
    }

    function setTelefono($psTelefono){
        $this->sTelefono=$psTelefono;
    }

    function getTelefono(){
        return $this->sTelefono;
    }

    function setEmail($psEmail){
        $this->sEmail=$psEmail;
    }
    function getEmail(){  
        return $this->sEmail;  
    }

    function setIdCo($pnID){
        $this->nID=$pnID;
    }

    function getIdCo(){
        return $this->nID;
    }
}
?>