<?php
//Reanudamos la sesión
session_start();
//Literalmente la destruirmos
session_destroy();
//Redireccionamos a index.php (al inicio de sesión)
header('Location: index.html');
?>