<?php
/*
 *
 * @author        Julio Edwin Mora
 * @topic         Control Muro
 * @data          25-11-2021
 *
 */
require_once('DaoConexion.php');
$action = $_GET['action'];
if(isset($action)){

    switch ($action) {
        case 'cargarNoticiasMuro':
                cargarNoticiasMuro();
            break;
        case 'nuevaPublicacion':
                nuevaPublicacion();
            break;
        case 'cargarComentarios':
                cargarComentarios();
            break;
        case 'nuevoComentario':
                nuevoComentario();
            break;
        case 'registrarMeGusta':
                registrarMeGusta();
            break;
        default:
            break;
    }
}

function registrarMeGusta(){

    $array = $_POST;
    $errorA = false;
    $mensaje = '';
    $conexion=0;
    $redirecction="";
    $cantidadMeGusta = 0;
    $consulta = new DAO;
    $respConexion=$consulta -> conectar();

    $array['idUser'] = htmlentities($array["iduser"]);
    $array['idPublicacion'] = htmlentities($array["id_publicacion"]);

    if($respConexion == true){
        $conexion=1;
        if($array['idUser'] != '' && $array['idPublicacion'] != ''){
            
            $QueryUsu=" SELECT id_me_gusta 
                        FROM me_gusta 
                        WHERE me_gusta.id_publicacion = '".$array['idPublicacion']."'
                        AND me_gusta.id_usuario = '".$array['idUser']."'; ";
                
            $consulta->consulta($QueryUsu);
            $consulta->leerVarios();
            $Count = $consulta->numregistros();

            if($Count > 0){
                $id_me_gusta = $consulta->ObjetoConsulta2[0][0];
                $queryAct = "DELETE FROM me_gusta WHERE id_me_gusta = '".$id_me_gusta."' ";
                $consulta->consulta($queryAct);
                
                $redirecction = 1;
                $errorA = false;
                $mensaje = 0;
            } else {
                $queryAct = "INSERT INTO me_gusta ( id_publicacion ,id_usuario)
                        VALUES
                        ('".$array['idPublicacion']."','".$array['idUser']."'); ";
                                
                $consulta->consulta($queryAct);

                $redirecction = 1;
                $errorA = false;
                $mensaje = 1;
            }

            
            $QueryUsu=" SELECT count(id_me_gusta)
                        FROM me_gusta 
                        WHERE me_gusta.id_publicacion = '".$array['idPublicacion']."'; ";
                
            $consulta->consulta($QueryUsu);
            $consulta->leerVarios();
            $Count = $consulta->numregistros();
            
            if($Count > 0){
                $cantidadMeGusta = $consulta->ObjetoConsulta2[0][0];
            }



        }else{
            $errorA = true;
            $mensaje='Error: Error al guardar me gusta';
        }
    }else{
        $errorA = true;
        $mensaje='Error: Error de Conexion.';
        $conexion=0;
    }

    $respuesta = array();
    $respuesta['mensaje']= $mensaje;
    $respuesta['errorA']= $errorA;
    $respuesta['conexion']= $conexion;
    $respuesta['redirecction']=$redirecction;
    $respuesta['cantidadMeGusta']=$cantidadMeGusta;
    echo json_encode($respuesta);
}

function nuevoComentario(){
    $array = $_POST;
    $errorA = false;
    $mensaje = '';
    $conexion=0;
    $redirecction="";
    $consulta = new DAO;
    $respConexion=$consulta -> conectar();

    $array['idUser'] = htmlentities($array["idUser"]);
    $array['idPublicacion'] = htmlentities($array["idPublicacion"]);
    $array['comentario'] = htmlentities($array["comentario"]);

    if($respConexion == true){
        $conexion=1;
        if($array['idUser'] != '' && $array['idPublicacion'] != '' && $array['comentario'] != ''){
            
            $queryAct = "INSERT INTO comentarios (id_publicacion,id_usuario,comentario)
                        VALUES
                        ('".$array['idPublicacion']."','".$array['idUser']."','".$array['comentario']."'); ";
                                
            $consulta->consulta($queryAct);

            $redirecction = 1;
            $errorA = false;
            $mensaje = $array['idPublicacion'];

                
        }else{
            $errorA = true;
            $mensaje='Error: Ingrese el comentario';
        }
    }else{
        $errorA = true;
        $mensaje='Error: Error de Conexion.';
        $conexion=0;
    }

    $respuesta = array();
    $respuesta['mensaje']= $mensaje;
    $respuesta['errorA']= $errorA;
    $respuesta['conexion']= $conexion;
    $respuesta['redirecction']=$redirecction;
    echo json_encode($respuesta);
}


function cargarComentarios(){

    $array = $_POST;
    $errorA = false;
    $mensaje = '';
    $conexion=0;
    $redirecction="";
    $consulta = new DAO;
    $respConexion=$consulta -> conectar();
    
    $array['id_publicacion'] = htmlentities($array["id_publicacion"]);

    if($respConexion == true){
        $conexion=1;
        $listado = array();


        $QueryUsu="SELECT comentarios.id_comentario, comentarios.id_publicacion, comentarios.comentario, 
                    comentarios.fecha_hora, usuarios.nombre_usuario, usuarios.apellido_usuario, usuarios.imagen
                    FROM comentarios, usuarios
                    WHERE comentarios.id_usuario = usuarios.id_usuario
                    AND comentarios.id_publicacion = '".$array['id_publicacion']."'
                    order by comentarios.fecha_hora asc;";
        
        $consulta->consulta($QueryUsu);
        $consulta->leerVarios();
        $Count = $consulta->numregistros();

        if($Count > 0){
            for ($i = 0; $i<$Count; $i++) {
                $listado[$i][0] = $consulta->ObjetoConsulta2[$i][0]; // id_comentario
                $listado[$i][1] = $consulta->ObjetoConsulta2[$i][1]; // id_publicacion
                $listado[$i][2] = $consulta->ObjetoConsulta2[$i][2]; // comentario
                $listado[$i][3] = $consulta->ObjetoConsulta2[$i][3]; // fecha_hora
                $listado[$i][4] = $consulta->ObjetoConsulta2[$i][4]; // nombre_usuario
                $listado[$i][5] = $consulta->ObjetoConsulta2[$i][5]; // apellido_usuario
                $listado[$i][6] = $consulta->ObjetoConsulta2[$i][6]; // imagen
            }
        }

        $redirecction = 1;
        $mensaje = $listado;

    }else{
        $errorA = true;
        $mensaje='Error: Error de Conexion.';
        $conexion=0;
    }
    //$resulado_query_busqueda = $db->consulta_general($query_busqueda);
    //$db->cerrar_conexion();
    $respuesta = array();
    $respuesta['mensaje']= $mensaje;
    $respuesta['errorA']= $errorA;
    $respuesta['conexion']= $conexion;
    $respuesta['redirecction']=$redirecction;
    echo json_encode($respuesta);
}

function nuevaPublicacion(){
    $array = $_POST;
    $errorA = false;
    $mensaje = '';
    $conexion=0;
    $redirecction="";
    $consulta = new DAO;
    $respConexion=$consulta -> conectar();

    $array['idUser'] = htmlentities($array["idUser"]);
    $array['titulo'] = htmlentities($array["titulo"]);
    $array['description'] = htmlentities($array["description"]);

    if($respConexion == true){
        $conexion=1;
        if(!empty($_FILES['file']['name'])){
            
            //Recogemos el archivo enviado por el formulario
            $archivo = $_FILES['file']['name'];

            //Si el archivo contiene algo y es diferente de vacio
            if (isset($archivo) && $archivo != "") {
                //Obtenemos algunos datos necesarios sobre el archivo
                  $tipo = $_FILES['file']['type'];
                  $tamano = $_FILES['file']['size'];
                  $temp = $_FILES['file']['tmp_name'];

                //Se comprueba si el archivo a cargar es correcto observando su extensión y tamaño
                if (!((strpos($tipo, "gif") || strpos($tipo, "jpeg") || strpos($tipo, "jpg") 
                    || strpos($tipo, "png")) && ($tamano < 2000000))) {
                    $errorA = true;
                    $mensaje='Error: La extensión o el tamaño de los archivos no es correcta.<br/>
                            - Se permiten archivos .gif, .jpg, .png. y de 200 kb como máximo.';
                    $conexion=0;


                } else {

                    $QueryUsu="SELECT COUNT(publicaciones.id_publicacion)
                                FROM publicaciones
                                WHERE publicaciones.id_usuario = '".$array["idUser"]."'
                                AND DATE(publicaciones.fecha_hora) = DATE(NOW());";
                    
                    $consulta->consulta($QueryUsu);
                    $consulta->leerVarios();
                    $Count = $consulta->numregistros();
                    $cantidadPublicaciones = 0;
                    if($Count > 0){
                        $cantidadPublicaciones = $consulta->ObjetoConsulta2[0][0];
                    }


                    if ($cantidadPublicaciones < 5) {
                        //Si la imagen es correcta en tamaño y tipo
                        //Se intenta subir al servidor
                        date_default_timezone_set('UTC');
                        $date = date('Y/m/d H:i:s');
                        
                        $arrayextension = explode("/", $tipo);
                        $extension = $arrayextension[1];
                        
                        $nuevoNombre = sha1(htmlentities($array["idUser"]) . "_". $date);
                        $nuevoNombre .= "." . $extension;
                        

                        if (move_uploaded_file($temp, '../assets/img_muro/' . $nuevoNombre)) {

                            $queryAct = "INSERT INTO publicaciones(id_usuario,imagen,titulo,descripcion) values
                                    ('".$array['idUser']."','".$nuevoNombre."','".$array['titulo']."','".$array['description']."');";
                                
                            $consulta->consulta($queryAct);

                            $redirecction = 1;
                            $errorA = false;

                            
                        }else {
                           //Si no se ha podido subir la imagen, mostramos un mensaje de error
                            $errorA = true;
                            $mensaje='Error: Ocurrió algún error al subir la Imagen. No pudo guardarse.';
                            $conexion=0;
                        }
                    } else {
                        $errorA = true;
                        $mensaje='Error: Ya subio el maximo de publicaciones por dia';
                        $conexion=0;
                    }

                    
                }
            } else {
                $errorA = true;
                $mensaje='Error: No se cargo correctamente informacion de la nueva Imagen.';
                $conexion=0;
            }

        } else {
            $errorA = true;
            $mensaje='Error: No se cargo correctamente informacion de la nueva Imagen.';
            $conexion=0;
        }
    }else{
        $errorA = true;
        $mensaje='Error: Error de Conexion.';
        $conexion=0;
    }

    $respuesta = array();
    $respuesta['mensaje']= $mensaje;
    $respuesta['errorA']= $errorA;
    $respuesta['conexion']= $conexion;
    $respuesta['redirecction']=$redirecction;
    echo json_encode($respuesta);
}
function cargarNoticiasMuro(){

    $array = $_POST;
    $errorA = false;
    $mensaje = '';
    $conexion=0;
    $redirecction="";
    $consulta = new DAO;
    $respConexion=$consulta -> conectar();
    
    $array['idUser'] = htmlentities($array["idUser"]);
    $array['id_empresa'] = htmlentities($array["id_empresa"]);

    if($respConexion == true){
        $conexion=1;
            
        $QueryUsu="SELECT publicaciones.id_publicacion, publicaciones.imagen, publicaciones.fecha_hora, 
                            publicaciones.titulo, publicaciones.descripcion,usuarios.id_usuario, 
                            usuarios.nombre_usuario, usuarios.apellido_usuario, usuarios.imagen
                    FROM publicaciones, usuarios 
                    WHERE publicaciones.id_usuario = usuarios.id_usuario 
                    AND usuarios.id_empresa = '".$array['id_empresa']."' 
                    order by publicaciones.fecha_hora desc;";
        
        $consulta->consulta($QueryUsu);
        $consulta->leerVarios();
        $Count = $consulta->numregistros();

        if($Count > 0){
        
            $listado = array();
            for ($i = 0; $i<$Count; $i++) {

                $listado[$i][0] = $consulta->ObjetoConsulta2[$i][0]; // id_publicacion
                $listado[$i][1] = $consulta->ObjetoConsulta2[$i][1]; // imagen
                $listado[$i][2] = $consulta->ObjetoConsulta2[$i][2]; // fecha_hora
                $listado[$i][3] = $consulta->ObjetoConsulta2[$i][3]; // titulo
                $listado[$i][4] = $consulta->ObjetoConsulta2[$i][4]; // descripcion
                $listado[$i][5] = $consulta->ObjetoConsulta2[$i][5]; // id_usuario
                $listado[$i][6] = $consulta->ObjetoConsulta2[$i][6]; // nombre_usuario
                $listado[$i][7] = $consulta->ObjetoConsulta2[$i][7]; // apellido_usuario
                $listado[$i][8] = $consulta->ObjetoConsulta2[$i][8]; // imagen
            
                $QueryUsu=" SELECT count(id_me_gusta)
                            FROM me_gusta 
                            WHERE me_gusta.id_publicacion = '".$listado[$i][0]."'; ";
                
                $consulta2 = new DAO;
                $respConexion=$consulta2 -> conectar();

                $consulta2->consulta($QueryUsu);
                $consulta2->leerVarios();
                $Count2 = $consulta2->numregistros();
                $cantidadMeGusta = 0;
                if($Count2 > 0){
                    $cantidadMeGusta = $consulta2->ObjetoConsulta2[0][0];
                }

                $listado[$i][9] = $cantidadMeGusta; // imagen



                $QueryUsu=" SELECT count(id_me_gusta)
                            FROM me_gusta 
                            WHERE me_gusta.id_publicacion = '".$listado[$i][0]."'
                            AND me_gusta.id_usuario = '".$array['idUser']."'; ";
                
                $consulta2->consulta($QueryUsu);
                $consulta2->leerVarios();
                $Count2 = $consulta2->numregistros();
                $miestadomegusta = 0;
                if($Count2 > 0){
                    $miestadomegusta = $consulta2->ObjetoConsulta2[0][0];
                }
                $listado[$i][10] = $miestadomegusta; // imagen


            }
            
            $redirecction = 1;
            $mensaje = $listado;
            
        } else {
            $errorA = true;
            $mensaje='Error: No hay empresas activas.'; 
        }
    }else{
        $errorA = true;
        $mensaje='Error: Error de Conexion.';
        $conexion=0;
    }
    //$resulado_query_busqueda = $db->consulta_general($query_busqueda);
    //$db->cerrar_conexion();
    $respuesta = array();
    $respuesta['mensaje']= $mensaje;
    $respuesta['errorA']= $errorA;
    $respuesta['conexion']= $conexion;
    $respuesta['redirecction']=$redirecction;
    echo json_encode($respuesta);
}