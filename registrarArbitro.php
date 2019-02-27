<?php
session_start();

$ruta="lenguaC.php";

include $_SESSION["lenguaje"];

require "views/registrarArbitro.views.php";


require_once 'Connection.php';
$PDO=Connection::make();



if ($_SERVER['REQUEST_METHOD'] === 'POST') {

    $sql="INSERT INTO arbitro (codigo, nombre, edad, foto, contrasenya) VALUES (:codigo,:nombre, :edad, :foto, :contrasenya)";
    $codigo=$_POST['codigo'];
    $nombre=$_POST['nombre'];
    $edad=$_POST['edad'];
    $contrasenya=$_POST['contrasenya'];

    if($codigo!=""){
        if($nombre!=""){
            if ($edad!=""){
                if ($contrasenya!=""){
                    $ruta="imagenes/";
                    $name=$_FILES['foto']['name'];
                    $foto="imagenes/".$name;

                    If (is_file($foto) === true) {
                        $idUnico = time();
                        $name = $idUnico . '_' . $name;
                        $foto = $ruta . $nombre;

                    }if (move_uploaded_file($_FILES['foto']['tmp_name'], $foto)) {

                        $contrasenya=hash2($contrasenya);

                        $statement=$PDO->prepare($sql);
                        $statement->bindParam(':codigo', $codigo);
                        $statement->bindParam(':nombre', $nombre);
                        $statement->bindParam(':edad', $edad);
                        $statement->bindParam(':foto', $foto);
                        $statement->bindParam(':contrasenya', $contrasenya);

                        $statement->execute();
                        echo "El arbitro ".$nombre." ha sido creado correctamente.";
                    } else {
                        echo "Ocurrió algún error al subir el fichero. No pudo guardarse.";
                    }



                }else{
                    echo "No ha introducido contrasenya";
                }
            }else{
                echo "Falta introducir edad";
            }
        }else{
            echo "Falta introducir nombre";
        }
    }else{
        echo "Falta codigo de arbitro";
    }

}

function hash2($password) {
    return password_hash($password, PASSWORD_DEFAULT, ['cost'=> 15]);
}

?>

