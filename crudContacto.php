<?php
/*
Archivo:  abcPersHosp.php
Objetivo: edición sobre Personal Hospitalario
Autor:    
*/
include_once("Modelo\cContactos.php");
session_start();

$sErr = "";
$sOpe = "";
$sCve = "";
$sNomBoton = "Borrar";
$oCont = new cContactos();
$bCampoEditable = false;
$bLlaveEditable = false;

$oCont = new cContactos();
/*Verificar que haya sesión*/
if (isset($_SESSION["usu"]) && !empty($_SESSION["usu"])) {
	/*Verificar datos de captura*/
	if (
		isset($_POST["txtClave"]) && !empty($_POST["txtClave"]) &&
		isset($_POST["txtOpe"]) && !empty($_POST["txtOpe"])
	) {
		$sOpe = $_POST["txtOpe"];
		$sCve = $_POST["txtClave"];
		if ($sOpe != 'a') {
			$oCont->setIdPersonal($sCve);
			try {
				if (!$oCont->buscar()) {
					$sError = "Este contacto no existe no existe";
				}
			} catch (Exception $e) {
				error_log($e->getFile() . " " . $e->getLine() . " " . $e->getMessage(), 0);
				$sErr = $e->getMessage();  

			}
		}
		if ($sOpe == 'a') {
			$bCampoEditable = true;
			$bLlaveEditable = true;
			$sNomBoton = "Agregar";
		} else if ($sOpe == 'm') {
			$bCampoEditable = true; //la llave no es editable por omisión
			$sNomBoton = "Modificar";
			
		}
		//Si fue borrado, nada es editable y es el valor por omisión
	} else {
		$sErr = "Faltan datos";
	}
} else
	$sErr = "Falta establecer el login";

if ($sErr == "") {
	include_once("cabecera.html");
	include_once("menu2.php");

} else {
	header("Location: error.php?sError=" . $sErr);
	exit();
}
?>
<section>
	<form name="insertar" action="resCrudContactos.php" method="post">
		<input type="hidden" name="txtOpe" value="<?php echo $sOpe; ?>">
		<input type="hidden" name="txtClave" value="<?php echo $sCve; ?>" />
		<TABLE BORDER="1" ALIGN="CENTER">

			<TR>
				<TD><strong>Nombre</strong> </TD>
				<td>
					<input type="text" name="txtNombre" <?php echo ($bCampoEditable == true ? '' : ' disabled '); ?>
						value="<?php echo $oCont->getNombre(); ?>" />
					<br />
				</td>
			</TR>

			<TR>
				<TD><strong>Direccion</strong> </TD>
				<td>
					<input type="text" name="txtDireccion" <?php echo ($bCampoEditable == true ? '' : ' disabled '); ?>
						value="<?php echo $oCont->getDireccion(); ?>" />
					<br />
				</td>
			</TR>

			<TR>
				<TD><strong>Telefono</strong> </TD>
				<td>
					<input type="text" name="txtTelefono" <?php echo ($bCampoEditable == true ? '' : ' disabled '); ?>
						value="<?php echo $oCont->getTelefono(); ?>" />
					<br />
				</td>
			</TR>

			<TR>
				<TD><strong>Email</strong> </TD>
				<td>
					<input type="text" name="txtEmail" <?php echo ($bCampoEditable == true ? '' : ' disabled '); ?>
						value="<?php echo $oCont->getEmail(); ?>" />
					<br />
				</td>
			</TR>
		</TABLE>

		<input type ="submit" value="<?php echo $sNomBoton;?>" 
				onClick="return evalua(txtNombre, txtApePat, rbSexo, txtFecNacim);"/>

		<input type="submit" name="Submit" value="Cancelar" onClick="abcPH.action='visualizarContactos.php';">
	</form>

</section>
</section>

<link rel="stylesheet" href="CSS/estilos.css">
<?php
include_once("pie.html");
?>