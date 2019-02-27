<?php

// ALTER TABLE `reserva` ADD `id` INT NOT NULL AUTO_INCREMENT PRIMARY KEY    podria meter un id directamente si no va

$sql = "SELECT * from jugador where nombre=:nombre";
$nombre = $_SESSION["nombre"];
$statement = $PDO->prepare($sql);
$statement->bindParam(':nombre', $nombre);
$statement->execute();
$jugador = $statement->fetchAll(PDO::FETCH_ASSOC);

//equipo de jugador
$jugador[0]["equipo"];

$sql = "SELECT id from reserva where equipo=:equipo";
$statement = $PDO->prepare($sql);
$statement->bindParam(':equipo', $jugador[0]["equipo"]);
$statement->execute();
$idReservas = $statement->fetchAll(PDO::FETCH_ASSOC);


$envio=json_encode($idReservas);




?>