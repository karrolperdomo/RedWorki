<?php
/*
 *
 * @author        Julio Edwin Mora
 * @topic         Control Menu Ayuda
 * @data          02/02/2015
 *
 */
require_once('DaoConexion.php');
$action = $_GET['action'];
if(isset($action)){

    switch ($action) {
        case 'Continuar':
                Proceso();
            break;
        default:
            break;
    }
}

function Proceso(){
	$array = $_POST;
    $errorA = false;
    $mensaje = '';
    $conexion=0;
    $redirecction="";
    $consulta = new DAO;
    $respConexion=$consulta -> conectar();

    $array['documento_identidad'] = htmlentities($array["documento_identidad"]);
    $array['correo'] = htmlentities($array["correo"]);
    if($respConexion == true){
    	$conexion=1;
    	$minimosCorreo = "@";
		$valCorreo = strpos($array['correo'], $minimosCorreo);
		if($valCorreo){
			$respValCC=validarDato($array['documento_identidad']);
			if($respValCC){
				
			}else{
				$errorA = true;
        		$mensaje='Error: Documento de Identidad invalido, recuerde que no debe ingresar ningun caracter de separacion.';
			}
		}else{
			$errorA = true;
        	$mensaje='Error: Direccion de correo invalida.';
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
function validarDato($variable){
    $permitidos = "1234567890"; 
   for ($i=0; $i<strlen($variable); $i++){ 
      if (strpos($permitidos, substr($variable,$i,1))===false){ 
        return false; 
      } 
   } 
   return true; 
}