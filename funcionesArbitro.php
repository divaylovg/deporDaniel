<?php
session_start();
include $_SESSION["lenguaje"];
require "views/funcionesArbitro.views.php";
require_once 'Connection.php';
$PDO=Connection::make();
// guardado en sesion el codigo de arbitro $_SESSION["codigo"]=$codigoForm;
if ($_SERVER['REQUEST_METHOD']==='POST') {

     $codigo_arbitro = $_SESSION["codigo"];
     $idPartido=$_POST['id'];

    if ($idPartido==""){
        echo "no ha introducido id del partido";
    }else{
        // SELECT * FROM `reserva` WHERE codigo_arbitro='paco' and id=4
        $sqlArbitro = "SELECT * from reserva where codigo_arbitro=:codigo_arbitro and id=:id";
        $statement = $PDO->prepare($sqlArbitro);
        $statement->bindParam(':codigo_arbitro', $codigo_arbitro);
        $statement->bindParam(':id', $idPartido);
        $statement->execute();
        $datosReserva = $statement->fetchAll(PDO::FETCH_ASSOC);

        if ((count($datosReserva))>0){
            //print_r($datosReserva);

            $equipo=$datosReserva[0]['equipo'];
            $fechaAmonestacion=$datosReserva[0]['fecha'];

            //vemos si este equipo ya esta amonestado
            $verEquipo = "SELECT * from amonestar where equipo=:equipo and fechaAmonestacion=:fechaAmonestacion";
            $statement = $PDO->prepare($verEquipo);
            $statement->bindParam(':equipo', $equipo);
            $statement->bindParam(':fechaAmonestacion', $fechaAmonestacion);
            $statement->execute();
            $equipoYaAmonestado = $statement->fetchAll(PDO::FETCH_ASSOC);

            if ((count($equipoYaAmonestado))==1){
                echo "Este equipo ya esta amonestado en esta fecha no puede amonestarlo de nuevo";
            }else{
                $amonestar="Insert into amonestar (codigo_arbitro, equipo, fechaAmonestacion) values(:codigo_arbitro ,:equipo , :fechaAmonestacion)";
                $statement = $PDO->prepare($amonestar);
                $statement->bindParam(':codigo_arbitro', $codigo_arbitro);
                $statement->bindParam(':equipo', $equipo);
                $statement->bindParam(':fechaAmonestacion', $fechaAmonestacion);
                $statement->execute();

                echo $codigo_arbitro." ha amonestado el equipo ".$equipo." en la fecha ".$fechaAmonestacion;

            }
        }else{
            echo "Usted no ha sido el arbitro de este partido por lo tanto no lo puede cambiar";
        }

    }

}


?>