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
        case 'Inicio':
                inicio();
            break;
        case 'buscarUsuario':
                buscarUsuario();
            break;
        case 'cargarPalabraClave':
                cargarPalabraClave();
            break;
        case 'recuperarClave':
                recuperarClave();
            break;
        case 'cambiarClave':
                cambiarClave();
            break;
        case 'cargarEmpresas':
                cargarEmpresas();
            break;
        case 'registrarNuevoUsuario':
                registrarNuevoUsuario();
            break;
        case 'cambiarEstadoConexion':
                cambiarEstadoConexion();
            break;
            
        default:
            break;
    }
}

function cambiarEstadoConexion(){
    $array = $_POST;
    $errorA = false;
    $mensaje = '';
    $conexion=0;
    $redirecction="";
    $consulta = new DAO;
    $respConexion=$consulta -> conectar();
    
    $array['idUser'] = htmlentities($array["idUser"]);
    $array['estado_conexion'] = htmlentities($array["estado_conexion"]);
    

    if($respConexion == true){
        $conexion=1;
        if($array['idUser'] != '' && $array['estado_conexion'] != ''){
            
            $QueryUsu="UPDATE usuarios SET estado_conexion = '" . $array['estado_conexion'] 
                        . "' WHERE id_usuario = '" . $array['idUser'] . "' ";
            $consulta->consulta($QueryUsu);

            session_start();
            $_SESSION["estado_conexion"] = $array['estado_conexion'];
            
            $redirecction = 1;
            $mensaje = "";
                
        }else{
            $errorA = true;
            $mensaje='Error: Ingrese los datos solicitados';
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
function registrarNuevoUsuario(){

    $array = $_POST;
    $errorA = false;
    $mensaje = '';
    $conexion=0;
    $redirecction="";
    $consulta = new DAO;
    $respConexion=$consulta -> conectar();
    
    $array['nombre'] = htmlentities($array["nombre"]);
    $array['apellidos'] = htmlentities($array["apellidos"]);
    $array['email'] = htmlentities($array["email"]);
    $array['palabra_clave'] = htmlentities($array['palabra_clave']);
    $array['id_empresa'] = htmlentities($array['empresa']);
    $array['password'] = sha1($array['password']);
    $array['telefono'] = htmlentities($array['telefono']);
    $array['direccion'] = htmlentities($array['direccion']);
    $array['cargo'] = htmlentities($array['cargo']);

    if($respConexion == true){
        $conexion=1;
        if($array['nombre'] != '' && $array['apellidos'] != '' && $array['email'] != '' && $array['palabra_clave'] != '' 
            && $array['id_empresa'] != '' && $array['password'] != '' ){
            
                $QueryUsu="SELECT * FROM usuarios WHERE email = '".$array["email"]."' ";
                $consulta->consulta($QueryUsu);
                $consulta->leerVarios();
                $Count = $consulta->numregistros();
                if($Count > 0){

                    $errorA = true;
                    $mensaje='Error: El correo electronico ya se encuentra registrado';

                } else {

                    $QueryUsu="INSERT INTO usuarios 
                        (nombre_usuario,apellido_usuario,email,password,palabra_clave,id_empresa,estado_usuario,numero_telefonico
                        ,direccion,cargo,estado_conexion)
                    VALUES ('".$array['nombre']."','".$array['apellidos']."','".$array['email']."','".$array['password']."','".$array['palabra_clave']."','".$array['id_empresa']."','activo','".$array['telefono']."','".$array['direccion']."','".$array['cargo']."','Disponible')";
                    $consulta->consulta($QueryUsu);
                    
                    $redirecction = 1;
                    $mensaje = "";
                }
        }else{
            $errorA = true;
            $mensaje='Error: Ingrese los datos solicitados';
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

function cargarEmpresas(){

    $array = $_POST;
    $errorA = false;
    $mensaje = '';
    $conexion=0;
    $redirecction="";
    $consulta = new DAO;
    $respConexion=$consulta -> conectar();
    
    

    if($respConexion == true){
        $conexion=1;
            
        $QueryUsu="SELECT * FROM empresas where estado_empresa = 'activo';";
        $consulta->consulta($QueryUsu);
        $consulta->leerVarios();
        $Count = $consulta->numregistros();

        if($Count > 0){
        
            $listado = array();
            for ($i = 0; $i<$Count; $i++) {

                $id_empresa     = $consulta->ObjetoConsulta2[$i][0];
                $nombre_empresa = $consulta->ObjetoConsulta2[$i][1];
                $listado[$i][0] = $id_empresa;
                $listado[$i][1] = $nombre_empresa;
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


function cambiarClave(){
    $array = $_POST;
    $errorA = false;
    $mensaje = '';
    $conexion=0;
    $redirecction="";
    $consulta = new DAO;
    $respConexion=$consulta -> conectar();
    
    $array['idUser'] = htmlentities($array["idUser"]);
    $array['password'] = htmlentities($array["password"]);
    $array['confirmarpassword'] = htmlentities($array["confirmarpassword"]);
    $array['password'] = sha1($array['password']);

    if($respConexion == true){
        $conexion=1;
        if($array['idUser'] != '' && $array['password'] != '' && $array['confirmarpassword'] != ''){
            
                $QueryUsu="UPDATE usuarios SET password = '" . $array['password'] 
                            . "' WHERE id_usuario = '" . $array['idUser'] . "' ";
                $consulta->consulta($QueryUsu);
                
                $redirecction = 1;
                $mensaje = "";
                
        }else{
            $errorA = true;
            $mensaje='Error: Ingrese los datos solicitados';
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

function recuperarClave(){
    $array = $_POST;
    $errorA = false;
    $mensaje = '';
    $conexion=0;
    $redirecction="";
    $consulta = new DAO;
    $respConexion=$consulta -> conectar();
    
    $array['user'] = htmlentities($array["usuario"]);
    $array['palabraClave'] = htmlentities($array["palabraClave"]);

    if($respConexion == true){
        $conexion=1;
        if($array['user'] != '' ){
            
                $QueryUsu="SELECT *
                            FROM usuarios
                            where email = '".$array["user"]."' 
                            and palabra_clave = '" . $array['palabraClave'] . "' ";
                $consulta->consulta($QueryUsu);
                $consulta->leerVarios();
                $Count = $consulta->numregistros();
                if($Count > 0){
                    
                    $redirecction = 1;
                    $mensaje = $consulta->ObjetoConsulta2[0][0];;
                    
                } else {
                    $errorA = true;
                    $mensaje='Error: Los datos ingresados no son validos.'; 
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



function cargarPalabraClave(){
    $array = $_POST;
    $errorA = false;
    $mensaje = '';
    $conexion=0;
    $redirecction="";
    $consulta = new DAO;
    $respConexion=$consulta -> conectar();
    
    $array['user'] = htmlentities($array["usuario"]);

    if($respConexion == true){
        $conexion=1;
        if($array['user'] != '' ){
            
                $QueryUsu="SELECT *
                            FROM usuarios
                            where email = '".$array["user"]."'";
                $consulta->consulta($QueryUsu);
                $consulta->leerVarios();
                $Count = $consulta->numregistros();
                if($Count > 0){
                    $palabra_clave = $consulta->ObjetoConsulta2[0][5];
                    $palabrasClave = array('perro', 'gato', 'jirafa', 'pez', 'elefante', 'raton');
                    $listado = array();
                    $ubicacion = rand(0,2);
                    for($i = 0; $i < 3; $i ++){
                        if ($ubicacion == $i){
                            $listado[$i] = $palabra_clave;
                        } else {
                            $listado[$i] = $palabrasClave[rand(0,5)];
                        }
                    }

                    $listado[0];
                    $listado[1];
                    $listado[2];
                    

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

function buscarUsuario(){
    $array = $_POST;
    $errorA = false;
    $mensaje = '';
    $conexion=0;
    $redirecction="";
    $consulta = new DAO;
    $respConexion=$consulta -> conectar();

    $array['user'] = htmlentities($array["usuario"]);

    if($respConexion == true){
        $conexion=1;
        if($array['user'] != '' ){
            
                $QueryUsu="SELECT *
                            FROM usuarios
                            where email = '".$array["user"]."'";
                $consulta->consulta($QueryUsu);
                $consulta->leerVarios();
                $Count = $consulta->numregistros();
                if($Count > 0){
                    $redirecction = 1;
                    $mensaje = $array['user'];
                    
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

function inicio(){
    
    $array = $_POST;
    $errorA = false;
    $mensaje = '';
    $conexion=0;
    $redirecction="";
    $consulta = new DAO;
    $respConexion=$consulta -> conectar();
    
    $array['user'] = htmlentities($array["usuario"]);
    $array['pass'] = htmlentities($array["password"]);
    $array['pass'] = sha1($array['pass']);
    

    if($respConexion == true){
        $conexion=1;
        if($array['user'] != '' ){
            if($array['pass'] != '' ){

                $QueryUsu="SELECT *
                            FROM usuarios
                            where email = '".$array["user"]."'";
                $consulta->consulta($QueryUsu);
                $consulta->leerVarios();
                $Count = $consulta->numregistros();
                if($Count > 0){

                    $QueryUsu="SELECT *
                                FROM usuarios
                                where email = '".$array["user"]."'
                                and password = '" . $array['pass'] . "' ";
                    $consulta->consulta($QueryUsu);
                    $consulta->leerVarios();
                    $Count = $consulta->numregistros();
                    
                    if($Count > 0){

                        $estado = $consulta->ObjetoConsulta2[0][6];
                        
                        if ($estado == 'activo') {
                            
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
                        

                    } else {
                        $errorA = true;
                        $mensaje='Error: Clave Incorrecta.'; 
                    }
                } else {
                    $errorA = true;
                    $mensaje='Error: Usuario Incorrecto.'; 
                }
       
            }else{
                $errorA = true;
                $mensaje='Error: Ingrese la Clave.';
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