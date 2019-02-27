<?php
session_start();

$ruta="lenguaC.php";
//si recibimos el valor oculto y esta en ingles ponemos ruta a pagina en ingles
if (isset($_POST["oculto"])){

    if ($_POST["oculto"]=="ingles"){
        $ruta="lenguaI.php";
    }
}

$_SESSION["lenguaje"]=$ruta;

include $_SESSION["lenguaje"];


?>



<!DOCTYPE html>
<html lang="es">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="stylesheet" type="text/css" href="css/estilos.css">
    <title>Deporvereda</title>
</head>

<body>
    <h1><a name="inicio"></a>Deporvereda</h1></header>





<form method="post" action="formulario2.php">

    <input type="button" value="castellano" id="castellano">
    <input type="button" value="ingles" id="ingles">
    <input type="hidden" id="oculto" name="oculto">

</form>


<SCRIPT>

    document.getElementById('castellano').onclick=enviar;
    document.getElementById('ingles').onclick=enviar;

    function enviar (evento){
        document.getElementById('oculto').value=evento.target.value;
        document.getElementsByTagName('form')[0].submit();
    }

</SCRIPT>

</body>
</html>