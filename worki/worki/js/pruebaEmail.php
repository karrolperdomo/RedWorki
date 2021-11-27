<html lang="es">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
        <link rel="shortcut icon" href="img/favicon.ico">
        <title>Registro de Hardware</title>
        <link rel="stylesheet" href="css/bootstrap.css">
        <link href="css/bootstrap-responsive.css" rel="stylesheet">
        <link rel="stylesheet" href="css/docs.css">

        <script Language="JavaScript">      
            if(history.forward(1)){
                history.replace(history.forward(1));
            }
        </script>

    </head>
    <body>
        
    </body>            
</html>


<?php

///////Configuración///// 



///////Fin configuración// 

 

if (isset ($_POST['enviar'])) { 

$headers .= "From: ".$_POST['email']; 
$mail_destinatario=$_POST['email'];
if ( mail ($mail_destinatario, $_POST['asunto'], "Nombre y apellidos : ".$_POST['nombre']." Asunto: ".stripcslashes ($_POST['asunto'])."n Mensaje :n ".stripcslashes ($_POST['mensaje']), $headers )) echo '<p>Su mensaje a sido enviado correctamente. Gracias por contactar con nosostros</p>'; 

 

else echo '<p>Error al enviar el formulario. Por favor, inténtelo de nuevo mas tarde.</p>'; } 

 

echo '<form action="pruebaEmail.php" method="post"> <label for="nombre">Nombre y apellidos : </label>  

<input type="text" name="nombre" size="50" maxlength="80"><br> <label for="email">Email : </label>  <input type="text" name="email" size="50" maxlength="60"><br> <label for="asunto">Asunto : </label>  <input type="text" name="asunto" size="50" maxlength="60"><br> <label for="mensaje">Mensaje : </label>  <textarea name="mensaje" cols="31" rows="5"></textarea> <br> 

<label for="enviar"> <input type="submit" name="enviar" value="Enviar consulta"></label>

 </form><p> </p><p><br>';

?>

</p>