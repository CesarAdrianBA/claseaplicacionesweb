<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Respuestas php</title>
</head>
<body>
    <h1>Respuestas del servidor.</h1>
    <?php
   echo "<h2>Datos Personales</h2>";
   echo "Nombre: " .$_REQUEST['Nombre']."<br/>";
   echo "Apellidos" .$_REQUEST['Apellidos']."<br>";
   if($_REQUEST['genero']=='F')
   {
    echo "Género:Femenino";
   }
   if($_REQUEST['genero']=='M')
   {
    echo "Género:Masculino";
   }
   echo "</br>Municipio de procedencia: ".$_REQUEST['Municipio']."</br>";
   echo "Idiomas seleccionados: <br/>";
   if(isset($_REQUEST['Ingles'])){echo "Ingles <br/>";}
   if(isset($_REQUEST['Japones'])){echo "Japones <br/>";}
   if(isset($_REQUEST['Frances'])){echo "Frances <br/>";}
   if(isset($_REQUEST['Italiano'])){echo "Italiano <br/>";}
   echo "comentario: ".$_request['comentario']."<br/>";
   echo "Fecha de registro: " .$_REQUEST['fechaRegistro']."<br/>";
    ?>
</body>
</html>