<?php
require __DIR__."/partials/deporvereda.part.php";
$ruta="lenguaC.php";
include $_SESSION["lenguaje"];
require_once 'Connection.php';
$PDO=Connection::make();


?>

<form action="funcionesArbitro.php" method="POST">

    <label for="num"><?php echo $amonestar ?> </label>
    <input type="text" name="id" value="">
    <input type="submit">
    <br>

</form>

</body>
</html>
