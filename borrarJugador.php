<?php
session_start();

$ruta="lenguaC.php";

include $_SESSION["lenguaje"];

require "views/borrarJugador.views.php";

require_once 'Connection.php';
$PDO=Connection::make();

if ($_SERVER['REQUEST_METHOD']==='POST') {

    $sql = "SELECT contrasenya from jugador where nombre=:nombre";

    $nombre=$_POST['nombre'];
    $contrasenyaForm=$_POST['contrasenya'];

    $statement=$PDO->prepare($sql);
    $statement->bindParam(':nombre', $nombre);
    $statement->execute();
    $jugador = $statement->fetch(PDO::FETCH_ASSOC);

    if (!$jugador){
        //no hay jugador que se llame asi
        echo "No se ha encontrado Jugador con el codigo introducido";

    }else if (password_verify($contrasenyaForm, $jugador["contrasenya"])){
        $sql = "DELETE from arbitro where arbitro.codigo=:codigo";
        //DELETE FROM `jugador` WHERE `jugador`.`nombre` = 'paco'
        $nombre=$_POST['nombre'];
        $contrasenyaForm=$_POST['contrasenya'];

        $statement=$PDO->prepare($sql);
        $statement->bindParam(':nombre', $nombre);
        $statement->execute();

        echo"Se ha borrado el Jugador de la base de datos.";

    }else if(!password_verify($contrasenyaForm, $jugador["contrasenya"])){
        echo"La contraseña no coincide";
    }

}



?>

