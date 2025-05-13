<?php

include_once("modelo\Usuario.php");
session_start();
$sErr = "";
$sNom="";
$sTipo="";
$oUsu=new Usuario();
 
if (isset($_SESSION["usu"])){
    $oUsu = $_SESSION["usu"];
    $sNom = $oUsu->getPersTel()->getNombre();
    $sTipo = $_SESSION["tipo"];
}
else
    $sErr = "Debe estar firmado";

if ($sErr == ""){
    include_once("cabecera.html");
    include_once("menu.php");
}
else{
    header("Location: error.php?sErr=".$sErr);
    exit();
}
?>

<!-- CONTENEDOR FLEX -->
<div class="contenido-principal">
    <section>
        <h1>Bienvenido <?php echo $sNom;?></h1>
        <h3>Eres tipo <?php echo $sTipo;?></h3>
    </section>

    <?php include_once("aside.html"); ?>
</div>

<?php include_once("pie.html"); ?>
