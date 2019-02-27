

<!DOCTYPE html>
<html lang="es">

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8" />
    <link rel="stylesheet" type="text/css" href="css/estilos.css">
    <link href="https://fonts.googleapis.com/css?family=Pacifico" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Passion+One" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Lobster" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Anton" rel="stylesheet">

    <title>Deporvereda</title>
</head>

<body>
<h1><a name="inicio"></a>Deporvereda</h1></header>


<li><a href="borrarJugador.php"> <?php
        $fecha="2000-19-19 18:19:20";
        echo $fecha."<br>";
        $fechaFecha=substr($fecha,0,10);
        echo $fechaFecha."<br>";
        //length es donde paras.
        $hora=substr($fecha,11,2);
        echo $hora."<br>";

        $total=$fechaFecha." ".$hora;
        echo $total." <br>";


        $hoy=time();
        $fecha1=date("Y-m-d",$hoy);
        echo $fecha1."<br>";
        $hace30dias=$hoy-2592000;
        $fecha2=date("Y-m-d",$hace30dias);

        echo $fecha2;
        "<br>";

        ?> </a></li>



</body>
</html>
