<?php
session_start();
//permite que puedas acceder desde cualquer dominio a los archivos.
header("Access-Control-Allow-Origin: *");
require_once 'Connection.php';
$PDO=Connection::make();
$datos=$_POST['idCancelar'];
$unit=json_decode($datos, true);
$id=$unit['id'];
$equipo=$unit['equipo'];


$sql = "SELECT * from reserva where id=:id and equipo=:equipo";
$statement = $PDO->prepare($sql);
$statement->bindParam(':equipo', $equipo);
$statement->bindParam(':id', $id);
$statement->execute();
$arId = $statement->fetchAll(PDO::FETCH_ASSOC);



if (empty($arId)){
    echo "No ha introducido id correcto para borrar la reserva";
}else{
    $sql = "DELETE from reserva where id=:id and equipo=:equipo";
    $statement=$PDO->prepare($sql);
    $statement->bindParam(':equipo', $equipo);
    $statement->bindParam(':id', $id);
    $statement->execute();

    echo "Se ha cancelado el partido con id: ";
    echo $id;
}




?>