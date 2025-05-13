<?php
include_once("AccesoDatos.php");
include_once("Contacto.php");
class cContactos extends Contacto
{

    private $nIdPersonal = 0;

    function setIdPersonal($pnIdPersonal)
    {
        $this->nIdPersonal = $pnIdPersonal;
    }
    function getIdPersonal()
    {
        return $this->nIdPersonal;
    }

    function visuaContactos()
    {
        $oAccesoDatos = new AccesoDatos();
        $sQuery = "";
        $arrRS = null;
        $aLinea = null;
        $j = 0;
        $oCont = null;
        $arrResultado = [];
        if ($oAccesoDatos->conectar()) {
            $sQuery = "SELECT *
                    FROM contactos
                    ORDER BY id";
            $arrRS = $oAccesoDatos->ejecutarConsulta($sQuery);
            $oAccesoDatos->desconectar();
            if ($arrRS) {
                foreach ($arrRS as $aLinea) {
                    $oCont = new cContactos();

                    $oCont->setIdCo($aLinea[0]);
                    $oCont->setNombre($aLinea[1]);
                    $oCont->setDireccion($aLinea[2]);
                    $oCont->setTelefono($aLinea[3]);
                    $oCont->setEmail($aLinea[4]);

                    $arrResultado[$j] = $oCont;
                    $j = $j + 1;
                }
            } else
                $arrResultado = [];
        }
        return $arrResultado;
    }

    function buscar()
    {
        $oAccesoDatos = new AccesoDatos();
        $sQuery = "";
        $arrRS = null;
        $bRet = false;
        if ($this->nIdPersonal == 0)
            throw new Exception("cUsuarios->buscar(): faltan datos");
        else {
            if ($oAccesoDatos->conectar()) {
                $sQuery = " SELECT id,nombre,direccion,email,telefono
                                    FROM contactos
                                    WHERE id = " . $this->nIdPersonal;
                $arrRS = $oAccesoDatos->ejecutarConsulta($sQuery);
                $oAccesoDatos->desconectar();
                if ($arrRS) {
                    $this->nID = $arrRS[0][0];
                    $this->sNombre = $arrRS[0][1];
                    $this->sDireccion = $arrRS[0][2];
                    $this->sEmail = $arrRS[0][3];
                    $this->sTelefono = $arrRS[0][4];

                    $bRet = true;
                }
            }
        }
        return $bRet;
    }

    function insertar()
    {
        $oAccesoDatos = new AccesoDatos();
        $sQuery = "";
        $nAfectados = -1;

        if (
            $this->sNombre == "" || $this->sDireccion == "" ||
            $this->sTelefono == "" || $this->sEmail == ""
        ) {
            throw new Exception("cContactos->insertar(): faltan datos");
        } else {
            if ($oAccesoDatos->conectar()) {
                $sQuery = "INSERT INTO contactos (nombre, direccion, email, telefono)
                           VALUES ('" . $this->sNombre . "', '" . $this->sDireccion . "',
                                   '" . $this->sEmail . "', '" . $this->sTelefono . "')";
                $nAfectados = $oAccesoDatos->ejecutarComando($sQuery);
                $oAccesoDatos->desconectar();
            }
        }

        return $nAfectados;
    }

    function modificar() {
        $oAccesoDatos = new AccesoDatos();
        $sQuery = "";
        $nAfectados = -1;
    
        if (
            $this->sNombre == "" || 
            $this->sDireccion == "" || $this->sTelefono == "" || $this->sEmail == ""
        ) {
            throw new Exception("cContactos->modificar(): faltan datos");
        } else {
            if ($oAccesoDatos->conectar()) {
                $sQuery = "UPDATE contactos SET 
                            nombre = '" . $this->sNombre . "', 
                            direccion = '" . $this->sDireccion . "', 
                            email = '" . $this->sEmail . "', 
                            telefono = '" . $this->sTelefono . "'
                           WHERE id = " . $this->nIdPersonal;
    
                $nAfectados = $oAccesoDatos->ejecutarComando($sQuery);
                $oAccesoDatos->desconectar();
            }
        }
    
        return $nAfectados;
    }
    
    function borrar(){
        $oAccesoDatos=new AccesoDatos();
        $sQuery="";
        $nAfectados=-1;
            if ($this->nIdPersonal==0)
                throw new Exception("cContactos->borrar(): faltan datos");
            else{
                if ($oAccesoDatos->conectar()){
                     $sQuery = "DELETE FROM contactos
                                WHERE id = ".$this->nIdPersonal;
                    $nAfectados = $oAccesoDatos->ejecutarComando($sQuery);
                    $oAccesoDatos->desconectar();
                }
            }
            return $nAfectados;
        }
    

}


?>