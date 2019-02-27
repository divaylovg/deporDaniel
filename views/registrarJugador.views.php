<?php
require __DIR__ . "/partials/deporvereda.part.php";
require_once 'Connection.php';
$PDO=Connection::make();

    $sql= "select nombre from equipo";
    $statement=$PDO->prepare($sql);
    $statement->execute();
    $equipos = $statement->fetchAll(PDO::FETCH_ASSOC);

?>


<form action="registrarJugador.php" method="POST" enctype="multipart/form-data">
    <label for="num"><?php echo $nombre ?> </label>
    <input type="text" name="nombre" value="">

    <label for="num"><?php echo $edad ?> </label>
    <input type="text" name="edad" value="">

    <label for="num"><?php echo $altura ?> </label>
    <input type="text" name="altura" value="">

    <select name="equipo">
        <?php
            foreach ($equipos as $equipo): ?>
               <option value="<?= $equipo['nombre'] ?>"><?= $equipo['nombre'] ?></option>
            <?php endforeach;
        ?>
    </select>

    <label for="num"><?php echo $foto ?> </label>
    <input type="file" name="foto">

    <label for="num"><?php echo $contrasenya ?> </label>
    <input type="password" name="contrasenya" value="">


    <input type="submit" value="<?php echo $enviar ?>"></input>
</form>

</body>
</html>
