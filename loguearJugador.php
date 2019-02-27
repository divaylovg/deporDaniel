<?php
session_start();

include $_SESSION["lenguaje"];

require "views/loguearJugador.views.php";

require_once 'Connection.php';
$PDO=Connection::make();


if ($_SERVER['REQUEST_METHOD']==='POST') {

    $sql = "SELECT contrasenya from jugador where nombre=:nombre";

    $nombreForm=$_POST['nombre'];
    $contrasenyaForm=$_POST['contrasenya'];

    $statement=$PDO->prepare($sql);
    $statement->bindParam(':nombre', $nombreForm);
    $statement->execute();
    $jugadores = $statement->fetch(PDO::FETCH_ASSOC);

    if (!$jugadores){
        //no hay jugador que se llame asi
        echo "No se ha encontrado jugador con el nombre introducido";

    }else if (password_verify($contrasenyaForm, $jugadores["contrasenya"])){
        //guardamos el nombre en sesion.
        $_SESSION["nombre"]=$nombreForm;
       //las contraseñas coinciden
        header('Location:funcionesJugador.php');
    }else if(!password_verify($contrasenyaForm, $jugadores["contrasenya"])){
        echo"La contraseña no coincide";
    }


}



function verify($password, $hash) {
    return password_verify($password, $hash);
}
?>

