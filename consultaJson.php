<?php
session_start();
//permite que puedas acceder desde cualquer dominio a los archivos.
header("Access-Control-Allow-Origin: *");
require_once 'Connection.php';
$PDO=Connection::make();
    $arrayHoras=[];
   $datos=$_POST['datos'];
    //$datos='{"campo":"exterior", "fechaCons":"2019-02-14"}';
    $unit=json_decode($datos, true);

    //$campo=$unit->campo;
    //$fecha=$unit->fechaCons;

$campo=$unit['campo'];
$fecha=$unit['fechaCons'];


    //seleccionamos las horas que tengan una reserva del campo que buscamos
    $sql = "SELECT fecha from reserva where campo=:campo";
    $statement=$PDO->prepare($sql);
    $camp=[":campo"=>$campo];
    $statement->execute($camp);
    //todasFechas son las reservas del campo
    $todasFechas = $statement->fetchAll(PDO::FETCH_ASSOC);

//libres es array con horas libres que vamos a rellenar
$libres=[];

//todasFechas esta vacio por lo tanto metemos directamente las horas
if (empty($todasFechas)){
    array_push($libres,"15");
    array_push($libres,"18");
    array_push($libres,"21");
}else {
    foreach ($todasFechas as $reser){
        foreach($reser as $reserva){
        //x es la parte de la fecha sin la hora que sacamos de todas las reservas.
        $x=substr($reserva,0,10);

           //solo si coincide la fecha del dia que busco con la fecha encontrada de todas las reservas
            if ($fecha==$x){

                $aux=substr($reserva,11,2);

                array_push($arrayHoras, $aux);
            }
        }
    }


    $contador15=0;
    $contador18=0;
    $contador21=0;

    //no se puede reservar si esta en arrayHoras
    for ($i=0;$i<count($arrayHoras);$i++){
            if($arrayHoras[$i]==15){
               $contador15++;
            }
            if($arrayHoras[$i]==18){
                $contador18++;
              //  array_push($libres,"18");
            }
            if($arrayHoras[$i]==21){
                $contador21++;
               // array_push($libres,"21");
            }
        }

        //si no esta el contador esta a 0 por lo tanto esta libre y la hora nos interesa
        if ($contador21==0){
            array_push($libres,"21");
        }
        if ($contador18==0){
            array_push($libres,"18");
        }
        if ($contador15==0){
            array_push($libres,"15");
    }

}


//foreach ($libres as $libre){
  //      echo "<option value=$libre>$libre</option>";
//}
$envio=json_encode($libres);

echo $envio;





?>