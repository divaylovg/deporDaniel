<?php
require __DIR__."/partials/deporvereda.part.php";
$ruta="lenguaC.php";
include $_SESSION["lenguaje"];
require_once 'Connection.php';


// mi json de 5 dias
$clave = 'http://api.openweathermap.org/data/2.5/forecast?lat=39.594189&lon=-0.54474&APPID=0f1866e1cdd9b28faf55fa914e02f018&units=metric&lang=es';
$data = file_get_contents($clave);

$PDO=Connection::make();

//seleccionamos los datos del jugador logueado
$sql = "SELECT * from jugador where nombre=:nombre";
$nombre = $_SESSION["nombre"];
$statement = $PDO->prepare($sql);
$statement->bindParam(':nombre', $nombre);
$statement->execute();
$jugador = $statement->fetchAll(PDO::FETCH_ASSOC);
//
//echo ($jugador[0]["equipo"]);

$arDias=[];
$arHoras=[$h1,$h2,$h3];
$hoy=time();
$temp=$hoy;


for ($i=0;$i<5;$i++){
    $temp=$temp+86400;
    $arDias[$i]=$temp;
    //si es sabado o domingo metemos festivo
    if (date("N", $arDias[$i])==6||date("N", $arDias[$i])==7){
        $arDias[$i]="Festivo";
    }
}

?>




<form action="funcionesJugador.php" method="POST">

    <label for="num"><?php echo $campo ?> </label>

    <select name="campo">
        <option value="interior" name="campo"><?php echo $interior ?></option>;
        <option value="exterior" name="campo"><?php echo $exterior ?></option>;
    </select>





    <select name="fecha">
        <option value=<?php echo $seleccionarDia?>><?php echo $seleccionarDia ?></option>;

        <?php
        foreach ($arDias as $dia){
            if ($dia=="Festivo"){
                echo '<option value="Festivo">Festivo</option>';

            }else{
                //si no es festivo lo metemos en formato e imprimimos
                $fechaF=date("Y-m-d",$dia);
            echo "<option value=$fechaF>".date("Y-m-d",$dia).'</option>';
            }
        }

        ?>
    </select>

    <select name="horas">
        <option id="primera" ></option>
        <option id="segunda" ></option>
        <option id="tercera" ></option>

    </select>

    <script>
        let peticion = new XMLHttpRequest();
        let rellenarHoras;


        function obtainXMLHttpRequest(){
            var httpRequest;
            if (window.XMLHttpRequest){
//El explorador implementa la interfaz de forma nativa
                httpRequest = new XMLHttpRequest();
            }
            else if (window.ActiveXObject){
//El explorador permite crear objetos ActiveX
                try {
                    httpRequest = new ActiveXObject("MSXML2.XMLHTTP");
                } catch (e) {
                    try {
                        httpRequest = new ActiveXObject("Microsoft.XMLHTTP");
                    } catch (e) {}
                }
            }
// Si no se puede crear, devolvemos false. En caso contrario, devolvemos el objeto
            if (!httpRequest){
                return false;
            }
            else{
                return httpRequest;
            }
        }
        document.getElementsByTagName("select")[1].onchange=consultarHoras;

        function consultarHoras(event) {
          // no se usa porque me quita los valores al enviarlo event.target.disabled=true;
            peticion.open("POST", "http://localhost/deporDaniel.com/consultaJson.php", true);
            peticion.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            peticion.onreadystatechange = function () {
                if (peticion.readyState == 4) {
                    if (peticion.status == 200) {
                        rellenarHoras = peticion.responseText;
                        rellenarHoras=JSON.parse(peticion.responseText);
                        //alert(rellenarHoras[0]);
                        //alert(rellenarHoras[1]);
                        //alert(rellenarHoras[2]);

                        //tiempo pillamos el data de arriba php y lo transformamos en objeto para informar sobre las condiciones meteorologicas
                        let objeto = JSON.parse('<?= $data ?>');
                        //("el tiempo es "+objeto.list[0].main.temp);
                        let fechaCons = document.getElementsByTagName("select")[1].value;
                        //("fecha que le paso"+fechaCons);

                        for (let i = 0; i<objeto.list.length; i++) {
                            //de 0 a 10 es el substring de fecha y 11-13 la hora de todos los datos json para sacar el dia que nos interesa
                            let x=objeto.list[i].dt_txt.substring(0,10);
                            let estaHora=objeto.list[i].dt_txt.substring(11,13);
                           // alert( "Fecha completa"+objeto.list[i].dt_txt);
                            //alert("hora"+estaHora);
                            //alert("fecha"+x);
                            if (x == fechaCons) {
                                if (estaHora==18||estaHora==15||estaHora==21) {

                                    let temp= objeto.list[i].main.temp;
                                    let temp_min= objeto.list[i].main.temp_min;
                                    let temp_max= objeto.list[i].main.temp_max;
                                    let humidity=objeto.list[i].main.humidity;
                                    let nubes= objeto.list[i].clouds.all;
                                    let velocidadViento= objeto.list[i].wind.speed;

                                    let texto="El dia "+fechaCons+". A las "+estaHora+" horas las condiciones meteorologicas seran las siguenetes: "+"<br>"+"Temperatura media: "+temp+"<br>"+"Temperatura minima: "+temp_min+"<br>"+"Temperatura maxima: "+temp_max+"<br>"+"+Humedad: "+humidity+"<br>"+"Nubes: "+nubes+"<br>"+"Velocidad de viento: "+velocidadViento+"<br>"+"<br>";
                                    let parrafo = document.createElement('p');
                                    parrafo.innerHTML=texto;
                                    document.body.appendChild(parrafo);
                                }
                            }
                        }


                        var prim=document.getElementById("primera");
                        var seg=document.getElementById("segunda");
                        var ter=document.getElementById("tercera");

                        // en caso de tener texto dentro lo vacia antes me los duplicaba
                        prim.innerText="";
                        seg.innerText="";
                        ter.innerText="";


                        if (rellenarHoras[0]=="15"||rellenarHoras[0]=="18"||rellenarHoras[0]=="21"){
                            var txt1=document.createTextNode(rellenarHoras[0]);
                            prim.appendChild(txt1);
                        }
                        if (rellenarHoras[1]=="15"||rellenarHoras[1]=="18"||rellenarHoras[1]=="21"){
                            var txt2=document.createTextNode(rellenarHoras[1]);
                            seg.appendChild(txt2);
                        }
                        if (rellenarHoras[2]=="15"||rellenarHoras[2]=="18"||rellenarHoras[2]=="21"){
                            var txt3=document.createTextNode(rellenarHoras[2]);
                            ter.appendChild(txt3);
                        }




                      //  console.log(rellenarHoras);
                       // let contenido;
                        //var sel = document.createElement("select");

                    }
                }
            }
            let campo = document.getElementsByTagName("select")[0].value;
            //fecha de consulta del dia que nos interesa del select
            let fechaCons = document.getElementsByTagName("select")[1].value;
            let datos='{"campo":\"'+campo+'\", "fechaCons":\"'+fechaCons+'\"}';

            //alert(datos);
            // Enviamos la acción
            peticion.send("datos=" + datos);



        }
    </script>

    <!-- <label for="num"><?php //echo $mensajeHora ?> </label>
    <select name="hora">
        <option><//?php echo $mensajeHora ?></option>;

        <option><?php //echo $h1 ?></option>;
        <option><?php //echo $h2 ?></option>;
        <option><?php //echo $h3 ?></option>;

    </select>
-->

    <input type="submit" value="<?php echo $enviar ?>"></input>


    <br><br><!-- OJO CAMBIAR DE MENOS 1 A 0 LA PUNTUACION <form action="apuntarLiga.php" method="POST">
   -->
<input type="button" id="apu" value="<?php echo $apuntar ?>">

<script>
    document.getElementById("apu").onclick=apuntarLiga;

    function apuntarLiga() {
        alert("apuntar");
        let peticionApuntarLiga = new XMLHttpRequest();

        peticionApuntarLiga.open("POST", "http://localhost/deporDaniel.com/ajaxApuntarEquipo.php", true);
        peticionApuntarLiga.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
        peticionApuntarLiga.onreadystatechange=function () {
            if (peticionApuntarLiga.readyState == 4) {
                if (peticionApuntarLiga.status == 200) {
                    let respuestaApuntar = peticionApuntarLiga.responseText;
                    let par=document.createElement("p");
                    par.innerHTML=respuestaApuntar;
                    document.body.appendChild(par);
                }
            }
        }
        let pasarEquipo='{"equipo":\"<?=$jugador[0]["equipo"]?>\"}';
        alert(pasarEquipo);
        peticionApuntarLiga.send("pasarEquipo="+pasarEquipo);

    }

</script>

    <br><br>




    <label for="num"><?php echo $cancelar ?> </label>
    <input type="text" name="contrasenya" value="">
    <input type="button" id="can" value="<?php echo $enviar ?>"></input>

    <script>
        document.getElementById("can").onclick=cancelarPartido;

        function cancelarPartido(event) {
            let peticionCancelar = new XMLHttpRequest();

            let idCancelar=document.getElementsByTagName("input")[2].value;

            peticionCancelar.open("POST", "http://localhost/deporDaniel.com/ajaxCancelarPartido.php", true);
            peticionCancelar.setRequestHeader("Content-Type", "application/x-www-form-urlencoded");
            peticionCancelar.onreadystatechange=function () {
                if (peticionCancelar.readyState == 4) {
                    if (peticionCancelar.status == 200) {
                        let respuestaCancelacion = peticionCancelar.responseText;
                        let par=document.createElement("p");
                        par.innerHTML=respuestaCancelacion;
                        document.body.appendChild(par);
                    }
                }
            }

            let idCancelarE='{"id":\"'+idCancelar+'\","equipo":\"<?=$jugador[0]["equipo"]?>\"}';
                alert(idCancelarE);
            peticionCancelar.send("idCancelar="+idCancelarE);
        }
    </script>



    <br>
</form>

</body>
</html>
