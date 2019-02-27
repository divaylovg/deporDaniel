<?php
require __DIR__."/partials/deporvereda.part.php";
?>


<form action="registrarArbitro.php" method="POST" enctype="multipart/form-data">

    <label for="num"><?php echo $codigo ?> </label>
    <input type="text" name="codigo" value="">

    <label for="num"><?php echo $nombre ?> </label>
    <input type="text" name="nombre" value="">

    <label for="num"><?php echo $edad ?> </label>
    <input type="text" name="edad" value="">

    <label for="num"><?php echo $foto ?> </label>
    <input type="file" name="foto" value="">


    <label for="num"><?php echo $contrasenya ?> </label>
    <input type="password" name="contrasenya" value="">


    <input type="submit" value="<?php echo $enviar ?>"></input>
</form>

</body>
</html>
