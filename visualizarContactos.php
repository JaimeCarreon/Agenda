<?php

include_once("Modelo\Usuario.php");
include_once("Modelo\cContactos.php");
session_start();
$sErr = "";
$sNom = "";
$arrContacto = null;
$oUsu = new Usuario();
$oCont = new cContactos();
/*Verificar que exista sesión*/
if (isset($_SESSION["usu"]) && !empty($_SESSION["usu"])) {
	$oUsu = $_SESSION["usu"];

	try {
		$arrContacto = $oCont->visuaContactos();
	} catch (Exception $e) {
		//Enviar el error específico a la bitácora de php (dentro de php\logs\php_error_log
		error_log($e->getFile() . " " . $e->getLine() . " " . $e->getMessage(), 0);
		$sErr = "Error en base de datos, comunicarse con el administrador";
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
<div class="contenedor-flex">
<section>
	<h1>Contacto</h1>
	<form class="tablaContac" name="formTablaGral" method="post" action="crudContacto.php">
		<input type="hidden" name="txtClave">
		<input type="hidden" name="txtOpe">
		<table border="1">
			<thead>
				<tr>
					<td>ID</td>
					<td>Nombre</td>
					<td>Direccion</td>
					<td>Email</td>
					<td>Telefono</td>
					<td>Opciones</td>
				</tr>
			</thead>
			<?php
			if ($arrContacto != null) {
				foreach ($arrContacto as $oCont) {
					?>
					<tr>
						<td class="llave"><?php echo $oCont->getIdCo(); ?></td>
						<td><?php echo $oCont->getNombre(); ?></td>
						<td><?php echo $oCont->getDireccion(); ?></td>
						<td><?php echo $oCont->getEmail(); ?></td>
						<td><?php echo $oCont->getTelefono(); ?></td>

						<td data-label="Opciones">
							<?php
							if (isset($_SESSION["tipo"]) && $_SESSION["tipo"] == "Administrador") {
								?>
								<div class="botones-accion">
								<input type="submit" name="Submit" value="Modificar"
									onClick="txtClave.value=<?php echo $oCont->getIdCo(); ?>; txtOpe.value='m'">
								<!--<input type="submit" name="Submit" value="Borrar"
									onClick="txtClave.value=< echo $oCont->getIdCo(); ?>; txtOpe.value='b'">-->
								<button type="button" onclick="mostrar(
								'¿Seguro que quiere eliminar este contacto?',
								'<?php echo $oCont->getNombre(); ?>',
								'<?php echo $oCont->getDireccion(); ?>',
								'<?php echo $oCont->getEmail(); ?>',
								'<?php echo $oCont->getTelefono(); ?>',
								'resCrudContactos.php',
								'<?php echo $oCont->getIdCo(); ?>'
								)">Borrar</button>
								</div>
								<?php
							} else {
								echo "Solo lectura";
							}
							?>
						</td>

					</tr>
					<?php
				}//foreach
			} else {
				?>
				<tr>
					<td colspan="2">No hay datos</td>
				</tr>
				<?php
			}
			?>
		</table>
		<?php
		if (isset($_SESSION["tipo"]) && $_SESSION["tipo"] == "Administrador") {
			?>
			<input type="submit" name="Submit" value="Crear Nuevo" onClick="txtClave.value='-1';txtOpe.value='a'">
			<?php
		}
		?>

	</form>
	<?php
// Mostrar mensaje de éxito si existe el parámetro
if (isset($_GET['success']) && $_GET['success'] == '1') {
    echo '
    <div id="success-message" style="
        position: fixed;
        top: 20px;
        right: 20px;
        background-color: #4CAF50;
        color: white;
        padding: 15px;
        border-radius: 5px;
        box-shadow: 0 2px 10px rgba(0,0,0,0.2);
        z-index: 1000;
        display: flex;
        align-items: center;
        animation: slideIn 0.5s forwards;
    ">
        <span style="margin-right: 15px;">¡Modificado con éxito!</span>
        
    </div>
    <style>
        @keyframes slideIn {
            from { transform: translateX(100%); opacity: 0; }
            to { transform: translateX(0); opacity: 1; }
        }
    </style>
    <script>
        // Cerrar automáticamente después de 3 segundos
        setTimeout(function() {
            const msg = document.getElementById(\'success-message\');
            if (msg) {
                msg.remove();
                window.history.replaceState({}, document.title, window.location.pathname);
            }
        }, 4000);
    </script>';
}
?>
</section>
<?php include_once("aside.html"); ?>
</div>

<link rel="stylesheet" href="CSS/estilos.css">

<script src="JS/popup.js"></script>

<?php
include_once("pie.html");
?>