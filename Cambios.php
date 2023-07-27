<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cambio de datos</title>
</head>
<body>
    <?php
        include('conexion.php');
        $db=new Database();
        $correo=isset($_REQUEST['correo']) ? $_REQUEST['correo']: null;
        $ingles=$japones=$frances="";

    ?>
    <h1>Cambio de datos</h1>
    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post">
        
        <label for="correo">Correo:</label>
        <input type= "text" name="correo" id="correo" value="<?php echo $correo; ?>">
        <input type= "submit" name="buscar" id="buscar" value="Buscar registro">
        <br/><br/><br/>
        <?php
        if (isset($_REQUEST['buscar'])){
            $correo=isset($_REQUEST['correo']) ? $_REQUEST['correo']: null;
        $query=$db->connect()->prepare("select*from registro where correo= :correo");
        $query->setFetchMode(PDO::FETCH_ASSOC);
        $query ->execute(['correo'=>$correo]);
        $row = $query ->fetch();
        $isChekedM = $row['genero'] == 'M' ? 'checked' : '';
        $isChekedF= $row['genero'] == 'F' ? 'checked' : '';
        $isChekedI= $row['ingles'] == 'I' ? 'checked' : '';
        $isChekedFr= $row['frances'] == 'F' ? 'checked' : '';
        $isChekedj= $row['japones'] == 'J' ? 'checked' : '';
        

        if($query->rowCount()<=0){
            echo "Correo no encontrado";
        }
        elseif($query->rowCount()>=0)
        {
            echo '<label>Id:</label>';
            echo '<input type "text" value="' .$row['id'].'" readonly size="5"><br/><br/>';
            echo '<label>Correo:</label>';
            echo '<input type "text" value="' .$row['correo'].'" readonly size="20"><br/><br/>';
            echo '<label>Nombre:</label>';
            echo '<input type="text" name="nombre"  value="' .$row['nombre'].'" readonly size="20" autofocus><br/><br/>';
            echo '<input type="text" name="apellido"  value="' .$row['apellido'].'" readonly size="20"><br/><br/>';
            echo '<label>Fecha:</label>';
            echo '<input type="date" name="fechaRegistro" value="' .$row['fechaRegistro'].'"><br/><br/>';
            echo '<label>Municipio:</label>';
            echo '<select name="municipio" id="municipio">
            <option value="' .$row['municipio'].'"></option>
            <option value="Aguascalientes">Aguascalientes</option>
            <option value="Asientos">Asientos</option>
            <option value="Cosio">Cosio</option>
            <option value="Pabellos">Pabellon</option>
            <option value="Rincon">Rincon</option></select><br/><br/>';
            
            echo '<label>Genero</label>';
            echo '<input type="radio" name="genero" value="M"  '.$isChekedM.' >Masculino';
            echo '<input type="radio" name="genero" value="F"  '.$isChekedF.'>Femenino';

            echo '<br/><br/><label>Idiomas seleccionados:</label><br/>';
            echo '<input type="checkbox" name="ingles" id="ingles" value="1"'.$isChekedI.'>ingles';
            echo '<input type="checkbox" name="frances" id="frances" value="1"'.$isChekedFr.'>frances';
            echo '<input type="checkbox" name="japones" id="japones" value="1"'.$isChekedj.'>japones';

            echo '</br><label>Comentario:</label>';
            echo '<textarea cols="30" rows="5" name="comentario">"' .$row['comentario'].'" </textarea><br/><br/>';

            echo '<input type="submit" name="cambiar" id="cambiar" value="Cambiar Datos">';
            
        }

        }
        if(isset($_REQUEST['cambiar'])){
                $nombre=$_POST['nombre'];
                $apellido=$_POST['apellido'];
                $genero=$_POST['genero'];
                $municipio=$_POST['municipio'];
                $comentario=$_POST['comentario'];
                $fechaRegistro=$_POST['fechaRegistro'];
                if(isset($_REQUEST['ingles']))($ingles="1");
                if(isset($_REQUEST['japones']))($japones="1");
                if(isset($_REQUEST['frances']))($frances="1");
                if(isset($_REQUEST['ingles']))($ingles="0");
                if(isset($_REQUEST['japones']))($japones="0");
                if(isset($_REQUEST['frances']))($frances="0");

                $sql="update registro set nombre=?,genero=?,municipio=?,comentario=?,fechaRegistro=?,ingles=?,frances=?,japones=? where correo=?";
                $stmt =$db->connect()->prepare($sql);
                $stmt->execute([$nombre, $genero, $municipio, $comentario, $fechaRegistro, $ingles, $frances, $japones,$correo]);
                echo "Los datos se actualizaron correctamente!!";
        }
        ?>

    </form>
</body>
</html>