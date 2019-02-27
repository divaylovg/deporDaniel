<?php
require __DIR__."/partials/deporvereda.part.php";
?>


<form action="registrarEquipo.php" method="POST" enctype="multipart/form-data">
    <label for="num"><?php echo $nombre ?> </label>
    <input type="text" name="nombre" value="">

    <label for="num"><?php echo $foto ?> </label>
    <input type="file" name="foto" value="">



    <input type="submit" value="<?php echo $enviar ?>"></input>
</form>

</body>
</html>
