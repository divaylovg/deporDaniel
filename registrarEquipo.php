<?php
session_start();

$ruta="lenguaC.php";

include $_SESSION["lenguaje"];

require "views/registrarEquipo.views.php";

require_once 'Connection.php';
$PDO=Connection::make();


if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre=$_POST['nombre'];

    if ($nombre!=""){

        $sql="INSERT INTO equipo (nombre, fechaCreacion, foto, puntuacion) VALUES (:nombre, CURRENT_TIME(), :foto, -1)";
        //al crear un equipo todos empezaran en -1 en caso de participar en liga se cambiara a 0
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
            $statement->bindParam(':foto', $foto);

            $statement->execute();
            echo "El equipo ".$nombre." se ha cerado correctamente.";
        } else {
            echo "Ocurrió algún error al subir el fichero. No pudo guardarse.";
        }


    }else{
        echo "No ha introducido un nombre";
    }


}




?>

