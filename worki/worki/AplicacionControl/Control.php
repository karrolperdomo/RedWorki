<?php
/*
 *
 * @author        Julio Edwin Mora
 * @topic         Control Session
 * @data          02/02/2015 -- dd/mm/aaaa
 *
 */

$action = $_GET['action'];
if(isset($action)){
    switch ($action) {
        case 'adicionar':
                adicionar();
            break;
        default:
            break;
    }
}

function adicionar(){
    // campturo la informacion que me envian por metodo post y la convierto en un arreglo
    $array = $_POST;
    $errorA = false;
    $mensaje='';

    // ciclo para demorar un poco el proceso ya que es muy cortas la validaciones
    $b=6000000;//tiempo
    for($a=0;$a<$b;$a++){}//conteo

    if(isset($array['dato_1']) && $array['dato_1'] != ''){
        if(isset($array['dato_2']) && $array['dato_2'] != ''){
            if(isset($array['dato_3']) && $array['dato_3'] != ''){
                if(is_numeric($array['dato_1']) ){
                    $resp=validarDato($array['dato_2']);
                    if($resp == true){
                        if(substr_count($array['dato_3'], '@') == 1){
                            $errorA = false;
                            $mensaje.='Confirmacion: Datos Correctos.'; 
                        }else{
                            $errorA = true;
                            $mensaje.='Error: formato erroneo Dato 3.'; 
                        } 
                    }else{
                        $errorA = true;
                        $mensaje.='Error: formato erroneo Dato 2.';
                    }
                }else{
                    $errorA = true;
                    $mensaje.='Error: formato erroneo Dato 1.'; 
                }
            }else{
                $errorA = true;
                $mensaje.='Error: Diligencie Dato 3.'; 
            }    
        }else{
            $errorA = true;
            $mensaje.='Error: Diligencie Dato 2.'; 
        }
    }else{
        $errorA = true;
        $mensaje.='Error: Diligencie Dato 1.';
    }
    $respuesta = array();
    $respuesta['mensaje']= $mensaje;
    $respuesta['error']= $errorA;
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