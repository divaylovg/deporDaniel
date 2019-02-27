<?php
session_start();

$ruta="lenguaC.php";

include $_SESSION["lenguaje"];

require "views/loguearArbitro.views.php";

require_once 'Connection.php';
$PDO=Connection::make();

if ($_SERVER['REQUEST_METHOD']==='POST') {

    $sql = "SELECT contrasenya from arbitro where codigo=:codigo";

    $codigoForm=$_POST['codigo'];
    $contrasenyaForm=$_POST['contrasenya'];

    $statement=$PDO->prepare($sql);
    $statement->bindParam(':codigo', $codigoForm);
    $statement->execute();
    $arbitro = $statement->fetch(PDO::FETCH_ASSOC);

    if (!$arbitro){
        //no hay arbitro que se llame asi
        echo "No se ha encontrado arbitro con el codigo introducido";

    }else if (password_verify($contrasenyaForm, $arbitro["contrasenya"])){
        $_SESSION["codigo"]=$codigoForm;
        //las contraseñas coinciden
        header('Location:funcionesArbitro.php');
    }else if(!password_verify($contrasenyaForm, $arbitro["contrasenya"])){
        echo"La contraseña no coincide";
    }


}

?>

