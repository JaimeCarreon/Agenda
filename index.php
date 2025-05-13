<?php
include_once("cabecera.html");
?>

<div class="main-container">
    

    <section>
        <form id="frm" method="post" action="login.php">
            <label>Usuario</label>
            <input type="text" name="txtCve" required />
            <br />
            <label>Contraseña</label>
            <input type="password" name="txtPwd" required />
            <br />
            <input type="submit" value="Enviar" />
        </form>
    </section>
	<?php include_once("aside.html"); ?>
</div>

<?php
include_once("pie.html");
?>
