<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar registros</title>
</head>
<body>
    <?php
        $correo=isset($_REQUEST['correo']) ? $_REQUEST['correo'] : null;
    ?>
    <h1>Eliminar registros</h1>  
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post" autocomplete="on">
        <fieldset> 
        <legend> Eliminar registro</legend>
        <label for="correo">correo a buscar</label>
        <input type="text" name="correo" id ="correo" value="<?php echo $correo; ?>">
        <input type="submit" name="buscar" id="buscar">
        <?php
            include("conexion.php");
            $db=new Database();
            if(isset($_REQUEST['buscar'])){
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
            if(isset($_REQUEST['eliminar'])){
                $correo=isset($_REQUEST['correo']) ? $_REQUEST['correo'] : null;
                $query=$db->connect()->prepare('delete from registro where correo= :correo');
                $query->execute(['correo'=>$correo]);
                if (!$query) {
                    echo "Error: ".$query->errorInfo();
                }
                echo "<h5>Registro eliminado</h5>";
                $query->closeCursor();
                $query=null;
                $db = null;
            }
        ?>
    </fieldset>
    </form>
</body>
</html>