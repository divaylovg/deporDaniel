<?php
require __DIR__."/partials/deporvereda.part.php";
?>


<form action="borrarJugador.php" method="POST">

    <label for="num"><?php echo $nombre ?> </label>
    <input type="text" name="nombre" value="">

    <label for="num"><?php echo $contrasenya ?> </label>
    <input type="password" name="contrasenya" value="">


    <input type="submit" value="<?php echo $enviar ?>"></input>

</form>

</body>
</html>
