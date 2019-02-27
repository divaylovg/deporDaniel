<?php
session_start();

$ruta="lenguaC.php";

include $_SESSION["lenguaje"];

require "views/registrarJugador.views.php";

require_once 'Connection.php';
$PDO=Connection::make();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {


$sql="INSERT INTO jugador (nombre, edad, foto, contrasenya, altura, equipo, goles) VALUES (:nombre, :edad, :foto, :contrasenya, :altura, :equipo, 0)";

$nombre=$_POST['nombre'];
$edad=$_POST['edad'];
$contrasenya=$_POST['contrasenya'];
$contrasenya=hash2($contrasenya);
$altura=$_POST['altura'];
$equipo=$_POST['equipo'];

    if ($nombre!=""){
        if ($edad!=""){
            if ($contrasenya!=""){
                if ($altura!=""){

                    $ruta="imagenes/";
                    $name=$_FILES['foto']['name'];
                    $foto="imagenes/".$name;

                    If (is_file($foto) === true) {
                        $idUnico = time();
                        $name = $idUnico . '_' . $name;
                        $foto = $ruta . $nombre;

                    }if (move_uploaded_file($_FILES['foto']['tmp_name'], $foto)) {


                        $statement=$PDO->prepare($sql);
                        $statement->bindParam(':nombre', $nombre);
                        $statement->bindParam(':edad', $edad);
                        $statement->bindParam(':foto', $foto);
                        $statement->bindParam(':contrasenya', $contrasenya);
                        $statement->bindParam(':altura',$altura);
                        $statement->bindParam(':equipo',$equipo);

                        $statement->execute();
                        echo "El jugador ".$nombre." se ha registrado correctamente.";
                    } else {
                        echo "Ocurrió algún error al subir el fichero. No pudo guardarse.";
                    }




                }else{
                    echo "No ha introducido altura.";
                }
            }else{
                echo "No ha introducido contrasenya.";
            }
        }else{
            echo "No ha introducido edad.";
        }
    }else{
        echo "No ha introducido nombre.";
    }




}

function hash2($password) {
    return password_hash($password, PASSWORD_DEFAULT, ['cost'=> 15]);
}


?>

