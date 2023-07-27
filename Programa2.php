<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Elementos de formulario</title>
</head>
<body>
    <h1>Elementos de formulario</h1>
    <form action="Programa2_rest.php" method="post">
        <fieldset>
            <legend>Datos personales</legend>
            <label for= "nombre">nombre:</label>
            <input typw="text" id="nombre" name="nombre" placeholder="Solo mayusculas" required autofocus>
            <br/><br/>
            <label for= "apellido">apellido</label>
            <input typw="text" id="apellido" name="apellido" value="Martinez Batres" readonly>
            <br/><br/>            
            <input type="radio" name="genero" id="genero" value="F" checked>Femenino 
            <input type="radio" name="genero" id="genero" value="M">Masculino 
            <br/><br/>
            <label for="Municipio">Selecciona tu municipio</label>
            
            <select name="Municipio" ID="Municipio">
            <option values="Zacatecas" selected>
            Zacatecas </option>
            <option values="Pabellón">
            Pabellón </option>
            <option values="Rincón de Romos">
            Rincón de Romos </option>
            <option values="Cosío">
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
            <label for="comentario">comentario:</label><br/>
            <textarea name="comentario" id="comentario"
            cols="30" rows="5"></textarea><br/><br/>
            <br/><br/>
            <label for="fechaRegistro">Fecha de registro:</label>
            <input type="Date" name= "fechaRegistro" id="fechaRegistro">
            <br/><br/>

            <input type="submit" name="enviar" id= "enviar">
            <br/><br/>
        
        </fieldset>
    </form>
</body>
</html>