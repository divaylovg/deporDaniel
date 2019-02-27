<?php
session_start();
include $_SESSION["lenguaje"];
require "views/funcionesJugador.views.php";
require_once 'Connection.php';
$PDO=Connection::make();

//borramos equipo amonestado con 30 dias
$hoy=time();
$fechaHoy=date("Y-m-d",$hoy);
//86400*30=2592000 es la fecha hace 30 dias
$hace30dias=$hoy-2592000;
$fechaHace30dias=date("Y-m-d",$hace30dias);
//las fechas que vamos a buscar y eleminar la amonestacion si han pasado 30 dias
$fecha18=$fechaHace30dias." 18:00:00";
$fecha21=$fechaHace30dias." 21:00:00";
$fecha15=$fechaHace30dias." 15:00:00";

//borramos la amonestacion de cualquier equipo pasados los 30 dias
$sql = "DELETE from amonestar where fechaAmonestacion=:fecha18 or fechaAmonestacion=:fecha21 or fechaAmonestacion=:fecha15 ";
//DELETE FROM `jugador` WHERE `jugador`.`nombre` = 'paco'
$statement=$PDO->prepare($sql);
$statement->bindParam(':fecha18', $fecha18);
$statement->bindParam(':fecha21', $fecha21);
$statement->bindParam(':fecha15', $fecha15);
$statement->execute();


if ($_SERVER['REQUEST_METHOD']==='POST') {
    if (($_POST['horas'])=="") {
        echo '<br>' ."No ha introducido hora";
    } else {
        if ($_POST['fecha'] == "Festivo"||$_POST['fecha']=="Selecciona dia") {
            echo '<br>' ."Ha seleccionado opcion incorrecta o un dia festivo en el que las instalaciones estan cerradas. ";
        } else {

//sacar los datos del jugador que esta logueado en la sesion
            $sql = "SELECT * from jugador where nombre=:nombre";
            $nombre = $_SESSION["nombre"];
            $statement = $PDO->prepare($sql);
            $statement->bindParam(':nombre', $nombre);
            $statement->execute();
            $jugador = $statement->fetchAll(PDO::FETCH_ASSOC);
            //print_r($jugador);
            //si quiero hacer objeto de jugador seria asi
            //$jugador=$statement->fetchAll(PDO::FETCH_CLASS|PDO::FETCH_PROPS_LATE, "Jugador");
            echo('<br>' ."Equipo ".$jugador[0]["equipo"]);



            //comprobar si el nombre del equipo esta amonestado
            $sqlAmonestado = "SELECT equipo from amonestar where equipo=:equipo";
            $statement = $PDO->prepare($sqlAmonestado);
            $equipo = $jugador[0]["equipo"];
            $statement->bindParam(':equipo', $equipo);
            $statement->execute();
            $siEstaEnAmonestado = $statement->fetchAll(PDO::FETCH_ASSOC);

            //si no esta amonestado podra hacer la reserva.
            if (empty($siEstaEnAmonestado)) {
                //ver la array con horas
                // print_r($_POST);
                // echo ($_POST['horas']);

                //concatenamos fecha y hora para que este junto en la bd;
                $fecha = $_POST['fecha'] . " " . $_POST['horas'];

                //seleccionar arbitro que no esta inscrito en ese dia
                $sqlArbitro = "SELECT codigo from arbitro where not exists(select codigo_arbitro from reserva where fecha=:fecha)";
                $statement = $PDO->prepare($sqlArbitro);
                $statement->bindParam(':fecha', $fecha);
                $statement->execute();
                $arbitrosLibres = $statement->fetchAll(PDO::FETCH_ASSOC);
                echo "<br>";
                //echo count($arbitrosLibres);
                //seleccionamos un arbitro aleatorio;
                $numArbitro = rand(0, (count($arbitrosLibres) - 1));
                //print_r($arbitrosLibres);

                $arbitroElegido = $arbitrosLibres[$numArbitro]["codigo"];

                echo '<br>' ."Fecha del partido: ". $fecha;

                //insertamos reserva del equipo despues
               $sql2 = "INSERT INTO reserva (campo, equipo, fecha, codigo_arbitro) VALUES (:campo, :equipo, :fecha, :codigo_arbitro)";

                $statement = $PDO->prepare($sql2);
                $campo = $_POST['campo'];
                $equipo = $jugador[0]["equipo"];

                //arbitro es arbitroElegido y fecha es la fecha de arriba.
                $statement->bindParam(':campo', $campo);
                $statement->bindParam(':equipo', $equipo);
                $statement->bindParam(':fecha', $fecha);
                $statement->bindParam(':codigo_arbitro', $arbitroElegido);
                $statement->execute();
                echo "<br>";

                $sql = "SELECT id from reserva where fecha=:fecha and campo=:campo";
                $statement = $PDO->prepare($sql);
                $statement->bindParam(':fecha', $fecha);
                $statement->bindParam(':campo', $campo);
                $statement->execute();
                $id = $statement->fetchAll(PDO::FETCH_ASSOC);

                echo $jugador[0]["equipo"] . " ha reservado el campo " . ($_POST['campo']) . " en la fecha " . ($_POST['fecha']) . " a la hora " . $_POST['horas'].".";
                echo '<br>' ."El arbitro del partido sera: " . $arbitroElegido;

                echo "<br>"."<br>"."En caso de querer cancelar su partido puede introducir el identificador del partido mas abajo. Identificador: ".$id[0]["id"];
                ;


            } else {
                echo '<br>' ."El equipo fue amonestado el dia " . $fechaHace30dias . " y no puede reservar hasta pasados 30 dias";
            }
        }
    }
}

?>

