<?php
/*
Archivo:  Usuario.php
Objetivo: clase que encapsula la información de un usuario
Autor:
*/
include_once("AccesoDatos.php");
include_once("cUsuarios.php");
class Usuario{ // clase base  "padre"
	private $nClave = 0;
	private $sPwd = "";
	private $oPersonalTel = null;
	private $oAD = null;

	public function getPersTel(){
		return $this->oPersonalTel;
	}
	public function setPersTel($valor){
		$this->oPersonalTel = $valor;
	}

	public function getClave(){
		return $this->nClave;
	}
	public function setClave($valor){
		$this->nClave = $valor;
	}

	public function getPwd(){
		return $this->sPwd;
	}
	public function setPwd($valor){
		$this->sPwd = $valor;
	}

	public function buscarCvePwd() {
		$bRet = false;
	
		if (($this->nClave === "" || $this->sPwd === "")) {
			throw new Exception("Usuario->buscar: faltan datos");
		}
	
		$this->oAD = new AccesoDatos();
	
		if ($this->oAD->conectar()) {
			$pdo = $this->oAD->getConexion();
	
			$stmt = $pdo->prepare("SELECT nIdPersonal FROM usuarios WHERE nCveUsu = :clave AND sContrasenai = :pwd");
			$stmt->bindParam(':clave', $this->nClave, PDO::PARAM_INT);
			$stmt->bindParam(':pwd', $this->sPwd, PDO::PARAM_STR);
			$stmt->execute();
	
			$arrRS = $stmt->fetchAll(PDO::FETCH_ASSOC);
	
			if ($arrRS && count($arrRS) > 0) {
				$this->oPersonalTel = new CUsuarios();
				$this->oPersonalTel->setIdPersonal($arrRS[0]['nIdPersonal']);
				$this->oPersonalTel->buscar();
				$bRet = true;
			}
	
			$this->oAD->desconectar();
		}
	
		return $bRet;
	}
	
}
?>
