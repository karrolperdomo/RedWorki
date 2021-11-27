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
        case 'ConsultaData':
                ConsultaData();
            break;
        default:
            break;
    }
}

function ConsultaData(){

	$consulta = new DAO;
    $respConexion=$consulta -> conectar();
    $htmlData="";

    $query="SELECT usu.documento_usuario
					,CONCAT(usu.nombres_usuario,' ',usu.apellido_usuario)
					,usu.fecha_creacion
					,his.f_ven_clave
			FROM sha_usuarios usu, log_user logU, log_hist his
			WHERE usu.id_usuario = logU.id_usuario
			AND logU.id_log_user = his.id_log_user
			AND usu.id_usuario = '".$_SESSION['id_usuario']."' ";
	$consulta->consulta($query);
    $consulta->leerVarios();
    $nombre=$consulta->ObjetoConsulta2[0][1];
    $documento_usuario=$consulta->ObjetoConsulta2[0][0];
    $fecha_creacion=$consulta->ObjetoConsulta2[0][2];
    $f_ven_clave=$consulta->ObjetoConsulta2[0][3];
    $htmlData ="<center><label><h4>Usuario: <div style='color:#FF0000;''>".$nombre."</div></h4></label>
    					
				<table>
					<tr>
						<td>
					<center><label>Documento Identidad:<div style='color:#FF0000;''>".$documento_usuario."</div></label>
						</td>
						</tr>
						<td>
					<center><label>Fecha Creacion Usuario: <div style='color:#FF0000;''>".$fecha_creacion."</div></label
						</td>
						</tr>
						<td>
					<center><label>Vencimiento Password: <div style='color:#FF0000;''>".$f_ven_clave."</div></label>
						</td>
						
					</tr>
				</table>";
				    
    $respuesta = utf8_encode($htmlData);
    echo $respuesta; 

}

?>
