<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Consulta de Registro</title>
</head>
<body>
    <h1> Consulta de Registro</h1>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post" autocomplete="on">
        <fieldset><legend>Datos de consultas</legend>
        <label for="correo"> Correo a consultar:</label>
        <input type="texto" name="correo" id="correo">
        <input type="submit" name="consultar" id="consultar" value="Consultar Correo">
        <input type="submit" name="todo" id="todo" value="Mostrar todos los registros">
    </fieldset>
    </form>
        <?php
         include("conexion.php");
         $db=new Database();
         if(isset($_REQUEST['consultar'])){
             $correo=isset($_REQUEST['correo']) ? $_REQUEST['correo'] : null;
             $query=$db->connect()->prepare('select * from registro where correo = :correo');
             $query->setFetchMode(PDO::FETCH_ASSOC);
             $query->execute(['correo'=>$correo]);
             $row =$query->fetch();

             if($query->rowCount()<=0){
                 echo "<h4>Correo no encontrado</h4>";
             }elseif ($query->rowCount()>0){
                 print"<h5>Registro encontrado: </h5>";
                 print"<hr>";
                 print"<table>";

                 print"<tr>";
                     print"<th>id: </th>";
                     print"<th>".$row['id']."</th>";
                 print"</tr>";

                 
                 print"<tr>";
                     print"<th>nombre: </th>";
                     print"<th>".$row['nombre']."</th>";
                 print"</tr>";
                 
                 print"<tr>";
                     print"<th>apellido: </th>";
                     print"<th>".$row['apellido']."</th>";
                 print"</tr>";

                 
                 print"<tr>";
                     print"<th>genero: </th>";
                     print"<th>".$row['genero']."</th>";
                 print"</tr>";
                                     
                 print"<tr>";
                     print"<th>municipio: </th>";
                     print"<th>".$row['municipio']."</th>";
                 print"</tr>";

                 
                 print"<tr>";
                     print"<th>comentario: </th>";
                     print"<th>".$row['comentario']."</th>";
                 print"</tr>";

                 print"<tr>";
                 print"<th>fechaRegistro: </th>";
                 print"<th>".$row['fechaRegistro']."</th>";
                 print"</tr>";

                 
                 print"<tr>";
                     print"<th>correo: </th>";
                     print"<th>".$row['correo']."</th>";
                 print"</tr>";

                 print"</table>";
                 print "<hr/>";
                 print "<input type='submit' name='eliminar' value='Eliminar registro' id='eliminar'>";
             }//rowCount
         }//button buscar
         if(isset($_REQUEST['todo'])){
            $query = $db->connect()->prepare('select*from registro');
            $query->setFetchMode(PDO::FETCH_ASSOC);
            $query->execute();
            if($query->rowCount()<0){
                print "NO HAY INFORMACION DISPONIBLE";
            }
            else if ($query->rowCount()>=0){
                print "<br/><br/><hr/>";
                print "USUARIOS REGISTRADOS";
                print "<br/><br/><hr/><hr/>";
                print "<table>";
                print "<tr>";
                print "<th>ID</th>";
                print "<th>Nombre</th>";
                print "<th>Correo</th>";
                print "<th>Fecha</th>";
                print "<th>Municipio<th>";
                print "</tr>";
                while($row = $query-> fetch()){
                print "<tr>";
                print "<td>" .$row ['id']. "</td>";
                print "<td>" .$row ['nombre']. "</td>";
                print "<td>" .$row ['correo']. "</td>";
                print "<td>" .$row ['fechaRegistro']. "</td>";
                print "<td>" .$row ['municipio']. "</td>";
                print "</tr>";
            
            }
                print "</table>";
            }
         }
         ?>
  

</body>
</html>