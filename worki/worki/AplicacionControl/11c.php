<?php
/*
 ****************************************************
 ****************************************************
 * @author ***** Julio Edwin Mora *******************
 * @topic ****** Control Cambio Clave ***************
 * @data ******* < j.edwin.mora19@gmail.com >********
 * @data ******* 18/02/2015 -- dd/mm/aaaa ***********
 ****************************************************
 ****************************************************
 */
include('../seguridad.php');
@session_start();
require_once('DaoConexion.php');
$action = $_GET['action'];
@session_start();
if(isset($action)){

    switch ($action) {
        case 'Actualizar':
                Actualizar();
            break;
        default:
            break;
    }
}

function Actualizar(){
    
    $array = $_POST;
    $errorA = false;
    $mensaje = '';
    $conexion=0;
    $redirecction="";
    $consulta = new DAO;
    $respConexion=$consulta -> conectar();
    
    $array['Npass'] = htmlentities($array["Npass"]);
    $array['Cpass'] = htmlentities($array["Cpass"]);

    if($respConexion == true){
        $conexion=1;
        if($array['Npass'] != '' ){
            if($array['Cpass'] != '' ){
                if($array['Npass'] == $array['Cpass']){
                    $long=strlen($array['Npass']);
                    if($long > 5){
                        if (!ctype_alpha($array['Npass'])) {
                            $NpassConver = sha1($array['Npass']);
                            $query="SELECT log_clave,id_log_user
                                    FROM log_user
                                    WHERE id_usuario = '".$_SESSION["id_usuario"]."' ";
                            $consulta->consulta($query);
                            $consulta->leerVarios();
                            $log_clave=$consulta->ObjetoConsulta2[0][0];
                            $id_log_user=$consulta->ObjetoConsulta2[0][1];
                            if($log_clave != $NpassConver){
                                $query1="SELECT ultime_pass
                                        FROM log_hist his,log_user us
                                        WHERE his.id_log_user = us.id_log_user
                                        AND us.id_usuario = '".$_SESSION["id_usuario"]."'";
                                $consulta->consulta($query1);
                                $consulta->leerVarios();
                                $Count1 = $consulta->numregistros();
                                if($Count1 > 0){
                                    $ultime_pass=$consulta->ObjetoConsulta2[0][0];
                                    if($ultime_pass != $array['Npass']){
                                        $query2="UPDATE log_hist
                                                 SET ultime_pass = (SELECT pass_usuario
                                                                    FROM sha_usuarios
                                                                    WHERE id_usuario = '".$_SESSION["id_usuario"]."'
                                                                    LIMIT 1)
                                                    , f_cre_clave = CURDATE()
                                                    , f_ven_clave = CURDATE()+300                                                        
                                                  WHERE id_log_user = '".$id_log_user."' ";
                                        $consulta->consulta($query2);
                                        $query3="UPDATE log_user
                                                 SET log_clave = '".$NpassConver."'
                                                 WHERE id_usuario = '".$_SESSION["id_usuario"]."' ";
                                        $consulta->consulta($query3);
                                        $query4="UPDATE sha_usuarios
                                                 SET pass_usuario = '".$array['Npass']."'
                                                 WHERE id_usuario = '".$_SESSION["id_usuario"]."' ";
                                        $consulta->consulta($query4);
                                        $errorA = false;
                                        $mensaje='<b>Confirmacion:</b> Cambio de Clave Exitoso. ';         
                                    }else{
                                        $errorA = true;
                                        $mensaje='<b>Error:</b> La Clave ingresada fue utilizada en los ultimos tres Cambios, debe ingresar una nueva Clave. ';
                                    }
                                }else{
                                    $errorA = true;
                                    $mensaje='<b>Error:</b> Informacion de Ultima Clave no encontrada. ';  
                                }        
                            }else{
                                $errorA = true;
                                $mensaje='<b>Error:</b> La Clave ingresada fue utilizada en los ultimos tres Cambios, debe ingresar una nueva Clave. ';
                            }
                        }else{
                            $errorA = true;
                            $mensaje='<b>Error:</b> La nueva clave no contiene los mínimos parámetros de seguridad, debe contener 
                                                al menos cinco caracteres entre numeros y letras. ';  
                        }    
                    }else{
                        $errorA = true;
                        $mensaje='<b>Error:</b> La nueva clave no contiene los mínimos parámetros de seguridad, debe contener al menos cinco caracteres.';    
                    }
                }else{
                    $errorA = true;
                    $mensaje='<b>Error:</b> Clave de Confirmacion Erronea.';    
                }
            }else{
                $errorA = true;
                $mensaje='<b>Error:</b> Ingrese la Confirmacion de su Clave.';
            }
        }else{
            $errorA = true;
            $mensaje='<b>Error:</b> Ingrese La Nueva Clave.';
        }
    }else{
        $errorA = true;
        $mensaje='<b>Error:</b> Error de Conexion.';
        $conexion=0;
    }
    $respuesta = array();
    $respuesta['mensaje']= $mensaje;
    $respuesta['errorA']= $errorA;
    $respuesta['conexion']= $conexion;
    $respuesta['redirecction']=$redirecction;
    echo json_encode($respuesta);
}
?>