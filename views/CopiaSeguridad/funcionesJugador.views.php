<?php
require __DIR__."/partials/deporvereda.part.php";

$ruta="lenguaC.php";

include $_SESSION["lenguaje"];

require_once 'Connection.php';
$PDO=Connection::make();
$arDias=[];
$hoy=time();
for ($i=0;$i<5;$i++){
    $arDias[$i]=$hoy+86400;
    if (date("N", $arDias[$i])==6||7){
        $arDias="Festivo";
    }
}

?>


<form action="funcionesJugador.php" method="POST">

    <label for="num"><?php echo $campo ?> </label>

    <select name="campo">
        <option value=$interior><?php echo $interior ?></option>;
        <option value=$exterior><?php echo $exterior ?></option>;
    </select>


    <label for="num"><?php echo $dia ?> </label>
    <select name="dia">
        <option value="dia"><?php echo $dia ?></option>;
        <option value="dia"><?php echo $lunes ?></option>;
        <option value="dia"><?php echo $martes ?></option>;
        <option value="dia"><?php echo $miercoles ?></option>;
        <option value="dia"><?php echo $jueves ?></option>;
        <option value="dia"><?php echo $viernes ?></option>;

    </select>



    <label for="num"><?php echo $mensajeHora ?> </label>
    <select name="hora">
        <option><?php echo $mensajeHora ?></option>;
        <option><?php echo $h1 ?></option>;
        <option><?php echo $h2 ?></option>;
        <option><?php echo $h3 ?></option>;
    </select>


    <input type="submit" value="<?php echo $enviar ?>"></input>
</form>

</body>
</html>
