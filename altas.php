<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Ejemplo de altas</title>
</head>
<body>
    <?php
    
    include("conexion.php");
    $nombre=$apellido=$correo=$genero=$municipio="";
    $Ingles=$Japones=$Frances="";
    $db=new Database();
    $query=$db->connect()->prepare('select max(id) as id from registro');
    $query->execute();
    $row=$query->fetch();
    $numero=$row['id'];
    $numero++;
    $comentario=$fechaRegistro="";

    ?>
   <h1>Alta de usuarios</h1>
   <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]) ?>" method="post" autocomplete="on">
   <fieldset> 
   <legend> Alta de usuarios</legend>
   <label for="id"> Folio:</label>
   
   <input type="text" id="id" name="id" readonly size="5" value="<?php echo $numero; ?>" autofocus>
  <br/>
  <br/>
   <label for= "nombre">nombre:</label>
   <input type="text" id="nombre" name="nombre" placeholder="Solo mayusculas" >
   <br/>
   <br/>            
   <label for= "apellido">apellido</label>
   <input type="text" id="apellido" name="apellido" placeholder="Solo letras" >
   <br/><br/>   
   <label for= "Correo">Correo</label>
   <input type="email" id="Correo" name="correo" placeholder="Email">
   <br/><br/>   
   <input type="radio" name="genero" id="genero" value="F" checked>Femenino 
    <input type="radio" name="genero" id="genero" value="M">Masculino 
    <br/><br/>
    <label for="Municipio">Selecciona tu municipio</label>

    <select name="municipio" ID="municipio">
    <option values="Zacatecas" selected>
    Zacatecas </option>
    <option values="Pabellon">
    Pabellón </option>
    <option values="Rincon de Romos">
    Rincón de Romos </option>
    <option values="Cosio">
    Cosío </option>
    <option values="Asientos">
    Asientos </option>
    </select>
    <br/><br/>
            <label for ="">Selecciona los idiomas: </label><br/>
            <input type="checkbox" name="Ingles" id="Ingles" >Ingles
            <input type="checkbox" name="Frances" id="Frances" >Frances
            <input type="checkbox" name="Japones" id="Japones" >Japones
            <br/><br/>
        <label for="fechaRegistro">Fecha de registro:</label>
        <input type="date" id="fechaRegistro"name="fechaRegistro" value="<?php echo date ("Y-m-d"); ?>">
        <br/><br>
        <label for="comentario">Comentario<label><br/>
        <textarea name="comentario" id="" cols="30" rows="5"></textarea>
        <br/><br>
<input type="submit" value="Registrar" name="Enviar">
</fieldset>
</form>
<?php
    if (isset($_REQUEST['Enviar'])){
        $nombre=$_POST['nombre'];
        $apellido=$_POST['apellido'];
        $correo=$_POST['correo'];
        $genero=$_POST['genero'];
        $municipio=$_POST['municipio'];
        if (isset($_REQUEST['Ingles'])){
            $Ingles="1";
        }
        if (isset($_REQUEST['Frances'])){
            $Frances="1";
        }
        if (isset($_REQUEST['Japones'])){
            $Japones="1";
        }
        $comentario=$_POST['comentario'];
        $fechaRegistro=$_POST['fechaRegistro'];
        $query=$db->connect()->prepare('select correo from registro where correo = :correo');
        $query->execute(['correo'=>$correo]);
        $row=$query->fetch(PDO::FETCH_NUM);
        if($query->rowCount()<=0){
            $insert = "insert into registro(correo, nombre, apellido, genero, municipio,Ingles,Frances,Japones,comentario,fechaRegistro) values (:correo, :nombre, :apellido, :genero, :municipio, :Ingles, :Frances, :Japones, :comentario, :fechaRegistro)";
            $insert = $db->connect()->prepare($insert);
            $insert->bindParam('correo',$correo, PDO::PARAM_STR,30);
            $insert->bindParam('nombre',$nombre, PDO::PARAM_STR,50);
            $insert->bindParam('apellido',$apellido, PDO::PARAM_STR,100);
            $insert->bindParam('genero',$genero, PDO::PARAM_STR,10);
            $insert->bindParam('municipio',$municipio, PDO::PARAM_STR,30);
            $insert->bindParam('Ingles',$Ingles, PDO::PARAM_STR,1);
            $insert->bindParam('Frances',$Frances, PDO::PARAM_STR,1);
            $insert->bindParam('Japones',$Japones, PDO::PARAM_STR,1);
            $insert->bindParam('comentario',$comentario, PDO::PARAM_STR,200);
            $insert->bindParam('fechaRegistro',$fechaRegistro, PDO::PARAM_STR);
            $insert->execute();
            if(!$query){
                echo "Error: ",$query->errorInfo();
            }
            echo "Registro agregado!!!";
        }else if($query->rowCount()>0){
            echo "EL CORREO YA EXISTE!!!!";
        }
    }
?>
</body>
</html>