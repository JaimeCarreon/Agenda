<?php

include_once("Modelo\cContactos.php");
session_start();

$sErr=""; $sOpe = ""; $sCve = "";
$oCont = new cContactos();

	/*Verificar que exista la sesión*/
	if (isset($_SESSION["usu"]) && !empty($_SESSION["usu"])){
		/*Verifica datos de captura mínimos*/
		if (isset($_POST["txtClave"]) && !empty($_POST["txtClave"]) &&
			isset($_POST["txtOpe"]) && !empty($_POST["txtOpe"])){
			$sOpe = $_POST["txtOpe"];
			$sCve = $_POST["txtClave"];
			$oCont->setIdPersonal($sCve);
			
			if ($sOpe != "b"){
				$oCont->setNombre($_POST["txtNombre"]);
				$oCont->setDireccion($_POST["txtDireccion"]);
				$oCont->setTelefono($_POST["txtTelefono"]);
				$oCont->setEmail($_POST["txtEmail"]);
				
			}
			try{
				if ($sOpe == 'a')
					$nResultado = $oCont->insertar();
				else if ($sOpe == 'b')
					$nResultado = $oCont->borrar();
				else 
					$nResultado = $oCont->modificar();
				
				if ($nResultado != 1){
					$sError = "Error en bd";
				}
			}catch(Exception $e){
				//Enviar el error específico a la bitácora de php (dentro de php\logs\php_error_log
				error_log($e->getFile()." ".$e->getLine()." ".$e->getMessage(),0);
				$sErr = $e->getMessage() . " en " . $e->getFile() . " línea " . $e->getLine();


			}
		}
		else{
			$sErr = "Faltan datos";
		}
	}
	else
		$sErr = "Falta establecer el login";
	
	if ($sErr == "")
		if($sOpe == 'a'){
			header("Location: visualizarContactos.php");
		}else{
			header("Location: visualizarContactos.php?success=1");
		}
	else
		header("Location: error.php?sError=".$sErr);
	exit();
?>