<?php
/*
 *
 * @author        Julio Edwin Mora
 * @topic         Control Session
 * @data          25-11-2021
 *
 */
require_once('DaoConexion.php');
$action = $_GET['action'];
if(isset($action)){

    switch ($action) {
        case 'actualizarInformacionBasica':
                actualizarInformacionBasica();
            break;
        case 'actualizarFotoPerfil':
                actualizarFotoPerfil();
            break;
        case 'cargarHobbie':
                cargarHobbie();
            break;
        case 'cargarTipoHobbie':
                cargarTipoHobbie();
            break;
        case 'registrarHobbitUsuario':
                registrarHobbitUsuario();
            break;

        case 'cargarTodosHobbies':
                cargarTodosHobbies();
            break;
        case 'modificarHobbitUsuario':
                modificarHobbitUsuario();
            break;
        case 'eliminarHobbie':
                eliminarHobbie();
            break;
        default:
            break;
    }
}
function eliminarHobbie(){

    $array = $_POST;
    $errorA = false;
    $mensaje = '';
    $conexion=0;
    $redirecction="";
    $consulta = new DAO;
    $respConexion=$consulta -> conectar();
    
    $array['user'] = htmlentities($array["idUser"]);
    $array['hobbie'] = htmlentities($array["hobbie"]);
    $array['tipo_hobbie'] = htmlentities($array["tipo_hobbie"]);
    $array['description'] = htmlentities($array["description"]);


    if($respConexion == true){
        $conexion=1;
        if($array['user'] != '' && $array['hobbie'] != '' && $array['tipo_hobbie'] != '' && $array['description'] != ''){
                
                $QueryUsu = "DELETE FROM usuarios_tipos_hobbies 
                            WHERE id_usuario = '" . $array['user'] . "'  
                            AND id_tipo_hobbie = '" . $array['tipo_hobbie'] . "'; ";
                $consulta->consulta($QueryUsu);
    
                $redirecction = 1;
                $mensaje = "";
                
                
        }else{
            $errorA = true;
            $mensaje='Error: Ingrese con los datos del Hobbie.';
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

function modificarHobbitUsuario(){

    $array = $_POST;
    $errorA = false;
    $mensaje = '';
    $conexion=0;
    $redirecction="";
    $consulta = new DAO;
    $respConexion=$consulta -> conectar();
    
    $array['user'] = htmlentities($array["idUser"]);
    $array['hobbie'] = htmlentities($array["hobbie"]);
    $array['tipo_hobbie'] = htmlentities($array["tipo_hobbie"]);
    $array['description'] = htmlentities($array["description"]);


    if($respConexion == true){
        $conexion=1;
        if($array['user'] != '' && $array['hobbie'] != '' && $array['tipo_hobbie'] != '' && $array['description'] != ''){
                
                $QueryUsu = "UPDATE usuarios_tipos_hobbies 
                            SET  descripcion = '" . $array['description'] . "' 
                            WHERE id_usuario = '" . $array['user'] . "'  
                            AND id_tipo_hobbie = '" . $array['tipo_hobbie'] . "'; ";
                $consulta->consulta($QueryUsu);
    
                $redirecction = 1;
                $mensaje = "";
                
                
        }else{
            $errorA = true;
            $mensaje='Error: Ingrese con los datos del Hobbie.';
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



function cargarTodosHobbies(){

    $array = $_POST;
    $errorA = false;
    $mensaje = '';
    $conexion=0;
    $redirecction="";
    $consulta = new DAO;
    $respConexion=$consulta -> conectar();
    
    $array['user'] = htmlentities($array["idUser"]);


    if($respConexion == true){
        $conexion=1;
        if($array['user'] != '' ){
            
                $QueryUsu="SELECT hobbies.id_hobbie, hobbies.hobbie, tipos_hobbies.id_tipo_hobbie
                                , tipos_hobbies.tipo_hobbie, tipos_hobbies.imagen_hobbie, usuarios_tipos_hobbies.descripcion 
                            FROM hobbies, tipos_hobbies, usuarios_tipos_hobbies
                            where hobbies.id_hobbie = tipos_hobbies.id_hobbie
                            and tipos_hobbies.id_tipo_hobbie = usuarios_tipos_hobbies.id_tipo_hobbie
                            and usuarios_tipos_hobbies.id_usuario = '" . $array['user']  . "'
                            order by hobbies.hobbie desc;";
                
                $consulta->consulta($QueryUsu);
                $consulta->leerVarios();
                $Count = $consulta->numregistros();


                if($Count > 0){
                
                    $listado = array();
                    for ($i = 0; $i<$Count; $i++) {
                        $listado[$i][0] = $consulta->ObjetoConsulta2[$i][0]; // id_hobbie
                        $listado[$i][1] = $consulta->ObjetoConsulta2[$i][1]; // Hobbie
                        $listado[$i][2] = $consulta->ObjetoConsulta2[$i][2]; // id_tipo_hobbie
                        $listado[$i][3] = $consulta->ObjetoConsulta2[$i][3]; // tipo_hobbie
                        $listado[$i][4] = $consulta->ObjetoConsulta2[$i][4]; // imagen_hobbie
                        $listado[$i][5] = $consulta->ObjetoConsulta2[$i][5]; // descripcion
                        
                    }
                    
                    $redirecction = 1;
                    $mensaje = $listado;
                    
                }
        }else{
            $errorA = true;
            $mensaje='Error: Ingrese el Usuario.';
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

function registrarHobbitUsuario(){

    $array = $_POST;
    $errorA = false;
    $mensaje = '';
    $conexion=0;
    $redirecction="";
    $consulta = new DAO;
    $respConexion=$consulta -> conectar();
    
    $array['user'] = htmlentities($array["idUser"]);
    $array['hobbie'] = htmlentities($array["hobbie"]);
    $array['tipo_hobbie'] = htmlentities($array["tipo_hobbie"]);
    $array['description'] = htmlentities($array["description"]);


    if($respConexion == true){
        $conexion=1;
        if($array['user'] != '' && $array['hobbie'] != '' && $array['tipo_hobbie'] != '' && $array['description'] != ''){
            
                $QueryUsu = "INSERT INTO usuarios_tipos_hobbies 
                            VALUES 
                            ('" . $array['user'] . "', '" . $array['tipo_hobbie'] . "', '" . $array['description'] . "'); ";
                $consulta->consulta($QueryUsu);
    
                $redirecction = 1;
                $mensaje = "";
                
                
        }else{
            $errorA = true;
            $mensaje='Error: Ingrese el Usuario.';
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

function cargarTipoHobbie(){

    $array = $_POST;
    $errorA = false;
    $mensaje = '';
    $conexion=0;
    $redirecction="";
    $consulta = new DAO;
    $respConexion=$consulta -> conectar();
    
    $array['user'] = htmlentities($array["idUser"]);
    $array['hobbie'] = htmlentities($array["hobbie"]);


    if($respConexion == true){
        $conexion=1;
        if($array['user'] != '' ){
            
                $QueryUsu="SELECT * FROM tipos_hobbies
                            WHERE id_tipo_hobbie NOT IN 
                            (SELECT id_tipo_hobbie from usuarios_tipos_hobbies where id_usuario = '" . $array['user'] . "')
                            AND id_hobbie = '" . $array['hobbie'] . "'; ";
                
                $consulta->consulta($QueryUsu);
                $consulta->leerVarios();
                $Count = $consulta->numregistros();


                if($Count > 0){
                
                    $listado = array();
                    for ($i = 0; $i<$Count; $i++) {
                        $idHobbie = $consulta->ObjetoConsulta2[$i][0];
                        $hobbie   = $consulta->ObjetoConsulta2[$i][1];
                        $listado[$i][0] = $idHobbie;
                        $listado[$i][1] = $hobbie;
                    }


                    
                    $redirecction = 1;
                    $mensaje = $listado;
                    
                } else {
                    $errorA = true;
                    $mensaje='Error: El usuario no existe.'; 
                }
        }else{
            $errorA = true;
            $mensaje='Error: Ingrese el Usuario.';
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


function cargarHobbie(){

    $array = $_POST;
    $errorA = false;
    $mensaje = '';
    $conexion=0;
    $redirecction="";
    $consulta = new DAO;
    $respConexion=$consulta -> conectar();
    
    $array['user'] = htmlentities($array["idUser"]);


    if($respConexion == true){
        $conexion=1;
        if($array['user'] != '' ){
            
                $QueryUsu="SELECT * FROM hobbies;";
                $consulta->consulta($QueryUsu);
                $consulta->leerVarios();
                $Count = $consulta->numregistros();


                if($Count > 0){
                
                    $listado = array();
                    for ($i = 0; $i<$Count; $i++) {
                        $idHobbie = $consulta->ObjetoConsulta2[$i][0];
                        $hobbie   = $consulta->ObjetoConsulta2[$i][1];
                        $listado[$i][0] = $idHobbie;
                        $listado[$i][1] = $hobbie;
                    }


                    
                    $redirecction = 1;
                    $mensaje = $listado;
                    
                } else {
                    $errorA = true;
                    $mensaje='Error: El usuario no existe.'; 
                }
        }else{
            $errorA = true;
            $mensaje='Error: Ingrese el Usuario.';
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

function actualizarFotoPerfil(){
    $array = $_POST;
    $errorA = false;
    $mensaje = '';
    $conexion=0;
    $redirecction="";
    $consulta = new DAO;
    $respConexion=$consulta -> conectar();

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
                    //Si la imagen es correcta en tamaño y tipo
                    //Se intenta subir al servidor
                    $arrayextension = explode("/", $tipo);
                    $extension = $arrayextension[1];
                    $nuevoNombre = htmlentities($array["idUser"]) . "." . $extension;
                    
                    if (move_uploaded_file($temp, '../assets/img_perfil/' . $nuevoNombre)) {
                        $queryAct = "UPDATE usuarios SET " 
                                      . " imagen = '" . $nuevoNombre . "'
                                          WHERE id_usuario  = '" . $array['idUser'] . "'";
                            
                        $consulta->consulta($queryAct);

                        $QueryUsu="SELECT *
                                FROM usuarios
                                where id_usuario = '".$array["idUser"]."'";
                        $consulta->consulta($QueryUsu);
                        $consulta->leerVarios();
                        $Count = $consulta->numregistros();
                        
                        if($Count > 0){

                            session_start();
                            $_SESSION["autentica"] = "SIP";
                            $_SESSION["id_usuario"] = $consulta->ObjetoConsulta2[0][0];
                            $_SESSION["nombre_usuario"] = $consulta->ObjetoConsulta2[0][1];
                            $_SESSION["apellido_usuario"] = $consulta->ObjetoConsulta2[0][2];
                            $_SESSION["email"] = $consulta->ObjetoConsulta2[0][3];
                            $_SESSION["estado_usuario"] = $consulta->ObjetoConsulta2[0][6];
                            $_SESSION["imagen_perfil"] = $consulta->ObjetoConsulta2[0][9];
                            $_SESSION["mi_estado"] = $consulta->ObjetoConsulta2[0][11];
                            $_SESSION["numero_telefonico"] = $consulta->ObjetoConsulta2[0][12];
                            $_SESSION["direccion"] = $consulta->ObjetoConsulta2[0][13];
                            $_SESSION["cargo"] = $consulta->ObjetoConsulta2[0][14];
                            $_SESSION["estado_conexion"] = $consulta->ObjetoConsulta2[0][15];
                            $_SESSION["nombre_completo"] = $_SESSION["nombre_usuario"] . " " . $_SESSION["apellido_usuario"];

                                
                            $QueryUsu="SELECT empresas.id_empresa,empresas.nombre_empresa
                                        FROM usuarios, empresas
                                        WHERE usuarios.id_empresa = empresas.id_empresa
                                        AND usuarios.id_usuario = '".$_SESSION["id_usuario"]."';";
                            $consulta->consulta($QueryUsu);
                            $consulta->leerVarios();
                            $Count = $consulta->numregistros();
                            
                            if($Count > 0){
                                $_SESSION["id_empresa"] = $consulta->ObjetoConsulta2[0][0];
                                $_SESSION["nombre_empresa"] = $consulta->ObjetoConsulta2[0][1];
                            }


                            $redirecction = 1;
                            $errorA = false;

                        } else {
                            $errorA = true;
                            $mensaje='Error: Usuario tiene un estado ' . $estado;
                        }
                    }else {
                       //Si no se ha podido subir la imagen, mostramos un mensaje de error
                        $errorA = true;
                        $mensaje='Error: Ocurrió algún error al subir la Imagen. No pudo guardarse.';
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

function after ($a, $inthat){
        if (!is_bool(strpos($inthat, $a)))
        return substr($inthat, strpos($inthat,$a)+strlen($a));
}


function actualizarInformacionBasica(){
    
    $array = $_POST;
    $errorA = false;
    $mensaje = '';
    $conexion=0;
    $redirecction="";
    $consulta = new DAO;
    $respConexion=$consulta -> conectar();
    
    $array['idUser'] = htmlentities($array["idUser"]);
    $array['nombre'] = htmlentities($array["nombre"]);
    $array['apellido'] = htmlentities($array["apellido"]);
    $array['direccionRecidencia'] = htmlentities($array["direccionRecidencia"]);
    $array['telefono'] = htmlentities($array["telefono"]);
    $array['estado'] = htmlentities($array["estado"]);
    $array['cargo'] = htmlentities($array["cargo"]);
    
    

    if($respConexion == true){
        $conexion=1;
        if($array['idUser'] != '' ){
            if($array['nombre'] != '' ){
                if($array['apellido'] != '' ){
                    if($array['direccionRecidencia'] != '' ){
                        if($array['telefono'] != '' ){
                            if($array['estado'] != '' ){

                                $QueryUsu="SELECT *
                                            FROM usuarios
                                            where id_usuario = '".$array["idUser"]."'";
                                $consulta->consulta($QueryUsu);
                                $consulta->leerVarios();
                                $Count = $consulta->numregistros();
                                if($Count > 0){
                                    $queryAct = "UPDATE usuarios SET " 
                                              . " nombre_usuario = '" . $array['nombre'] . "',
                                                  apellido_usuario = '" . $array['apellido'] . "',
                                                  direccion = '" . $array['direccionRecidencia'] . "',
                                                  numero_telefonico = '" . $array['telefono'] . "',
                                                  mi_estado = '" . $array['estado'] . "',
                                                  cargo = '" . $array['cargo'] . "'
                                                  WHERE id_usuario  = '" . $array['idUser'] . "'";
                                    
                                    $consulta->consulta($queryAct);
                                    
                                    $QueryUsu="SELECT *
                                            FROM usuarios
                                            where id_usuario = '".$array["idUser"]."'";
                                    $consulta->consulta($QueryUsu);
                                    $consulta->leerVarios();
                                    $Count = $consulta->numregistros();
                                    
                                    if($Count > 0){

                                        session_start();
                                        $_SESSION["autentica"] = "SIP";
                                        $_SESSION["id_usuario"] = $consulta->ObjetoConsulta2[0][0];
                                        $_SESSION["nombre_usuario"] = $consulta->ObjetoConsulta2[0][1];
                                        $_SESSION["apellido_usuario"] = $consulta->ObjetoConsulta2[0][2];
                                        $_SESSION["email"] = $consulta->ObjetoConsulta2[0][3];
                                        $_SESSION["estado_usuario"] = $consulta->ObjetoConsulta2[0][6];
                                        $_SESSION["imagen_perfil"] = $consulta->ObjetoConsulta2[0][9];
                                        $_SESSION["mi_estado"] = $consulta->ObjetoConsulta2[0][11];
                                        $_SESSION["numero_telefonico"] = $consulta->ObjetoConsulta2[0][12];
                                        $_SESSION["direccion"] = $consulta->ObjetoConsulta2[0][13];
                                        $_SESSION["cargo"] = $consulta->ObjetoConsulta2[0][14];
                                        $_SESSION["nombre_completo"] = $_SESSION["nombre_usuario"] . " " . $_SESSION["apellido_usuario"];

                                            
                                        $redirecction = 1;
                                        $errorA = false;

                                    } else {
                                        $errorA = true;
                                        $mensaje='Error: Usuario tiene un estado ' . $estado;
                                    }


                                    

                                }else{
                                    $errorA = true;
                                    $mensaje='Error: Error con la carga del Usuario';
                                }

                            }else{
                                $errorA = true;
                                $mensaje='Error: Ingrese el Estado.';
                            }
                        }else{
                            $errorA = true;
                            $mensaje='Error: Ingrese el Telefono.';
                        }
                    }else{
                        $errorA = true;
                        $mensaje='Error: Ingrese la Direccion de recidencia.';
                    }
                }else{
                    $errorA = true;
                    $mensaje='Error: Ingrese el Apellido.';
                }
            }else{
                $errorA = true;
                $mensaje='Error: Ingrese el nombre.';
            }
        }else{
            $errorA = true;
            $mensaje='Error: Error con la carga del Usuario';
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


function validarDato($variable){
    $permitidos = "abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ"; 
   for ($i=0; $i<strlen($variable); $i++){ 
      if (strpos($permitidos, substr($variable,$i,1))===false){ 
        return false; 
      } 
   } 
   return true; 
}
?>