<?php
session_start();
//permite que puedas acceder desde cualquer dominio a los archivos.
header("Access-Control-Allow-Origin: *");
require_once 'Connection.php';
$PDO=Connection::make();
$datos=$_POST['pasarEquipo'];
$unit=json_decode($datos, true);
$equipo=$unit['equipo'];

// vamos a contar los jugadores para ver si hay por lo menos 5
$sql = "SELECT * from jugador where equipo=:equipo";
$statement = $PDO->prepare($sql);
$statement->bindParam(':equipo', $equipo);
$statement->execute();
$arJugadores = $statement->fetchAll(PDO::FETCH_ASSOC);


if ((count($arJugadores))<5){
    echo "Se necesitan minimo 5 jugadores para apuntarse a liga.";
}else{
    //vamos a ver si hay 12 equipos apuntados ya en liga para decir que ya esta el tope o mas adelante hacer otras ligas
    $sql = "SELECT * from liga";
    $statement = $PDO->prepare($sql);
    $statement->execute();
    $arEquipos = $statement->fetchAll(PDO::FETCH_ASSOC);
    if ((count($arEquipos))==12){
        echo "Ya hay 12 equipos apuntados para este año, intentelo el año que viene.";
    }else{

        // vamos a ver si el nombre se encuentra ya en la liga para no apuntarlo mas de una vez
        $sql = "SELECT * from liga where nombre_equipo=:equipo";
        $statement = $PDO->prepare($sql);
        $statement->bindParam(':equipo', $equipo);
        $statement->execute();
        $estaYaApuntado = $statement->fetchAll(PDO::FETCH_ASSOC);

        if ((count($estaYaApuntado))>0){
            echo "Este equipo ya esta apuntado en la liga";
        }else{
            //ya que apuntamos equipo hay que cambiar la puntuacion de -1 a 0
            $sqlPuntuacion="Update equipo set puntuacion='0' where nombre=:nombre";
            $statement = $PDO->prepare($sqlPuntuacion);
            $statement->bindParam(':nombre', $equipo);
            $statement->execute();

            //apuntamos equipo a la liga
            $sql = "Insert into liga (nombre_equipo) values (:nombre_equipo)";
            $statement = $PDO->prepare($sql);
            $statement->bindParam(':nombre_equipo', $equipo);
            $statement->execute();

            echo "El equipo ".$equipo." se ha apuntado a la liga";
        }
    }
}


?>