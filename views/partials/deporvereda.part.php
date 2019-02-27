

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






<nav>
    <ul>
        <li>
            <a href="formularioLengua.php"> <?php echo $inicio ?> </a>
        </li>


        <li><a><?php echo $log ?></a>
            <ul>

                <li><a href="loguearJugador.php"> <?php echo $jugador ?> </a></li>
                <li><a href="loguearArbitro.php"><?php echo $arbitro ?> </a></li>
            </ul>
        </li>

        <li><a><?php echo $registrar ?></a>
            <ul>
                <li><a href="registrarJugador.php"> <?php echo $jugador ?> </a></li>
                <li><a href="registrarArbitro.php"><?php echo $arbitro ?> </a></li>
                <li><a href="registrarEquipo.php"> <?php echo $equipo ?> </a></li>
            </ul>
        </li>

        <li><a><?php echo $borrar ?></a>
            <ul>
                <li><a href="borrarJugador.php"> <?php echo $jugador ?> </a></li>
                <li><a href="borrarArbitro.php"><?php echo $arbitro ?> </a></li>
            </ul>
        </li>

        <li><a><?php echo $liga ?></a>
            <ul>
                <li><a href="borrarJugador.php"> <?php echo $jugador?> </a></li>
                <li><a href="borrarArbitro.php"><?php echo $arbitro ?> </a></li>
            </ul>
        </li>



    </ul>

</nav>
