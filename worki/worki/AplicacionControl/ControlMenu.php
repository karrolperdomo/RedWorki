<?php
/*
 ****************************************************
 ****************************************************
 * @author ***** Julio Edwin Mora *******************
 * @topic ****** Control Menu Principal *************
 * @data ******* < j.edwin.mora19@gmail.com > *******
 * @data ******* 06/04/2015 -- dd/mm/aaaa ***********
 ****************************************************
 ****************************************************
 */

include('../seguridad.php');
@session_start();
require_once('DaoConexion.php');
$action = $_GET['action'];
if(isset($action)){

    switch ($action) {
        case 'Roles':
                Roles();
            break;
        default:
            break;
    }
}
function Roles(){
	$consulta = new DAO;
    $consulta -> conectar();

    // el menu principal debe ser traido de la base de datos este es solo un ejemplo
    $menuPrincipal =" <div class='AccordionPanel'>
                    	<div class='AccordionPanelTab' style='font-size:17px'>Perfil de Usuario</div>
                    	<div class='AccordionPanelContent' >
                        	<ul>
                            	<li id='click' class='opciones' value='10v.php'>Mi Perfil</li>
                            	<li id='click' class='opciones' value='11v.php'>Cambio de Clave</li>
                            	<li  class='opciones'><a href='salir.php'>Desconectarme</a></li>
                        	</ul>
                    	</div>
                	</div> ";

	
	// CREACION DE LOS DEMAS MENU Y SUBMENU DEL USUARIO-- SI ES ADMINISTRADOR DEBE TENER EN CUENTA QUE NIVEL ES 
	// Y PINTAR EL MODULO DE ADMINISTRACION DE LA PLATAFORMA CON LA OPCION DE CREACION, ELIMINACION, SUSPENCION DE MODULOS Y SUBMODULOS             	
	//---------------------------- EJEMPLO -----------------------------
	// falta traer de la base de datos los numeros de los archivo para colocarlos en el campo de value.
	// tener en cuenta que si cambia de la ruta de AplicacionView/ hay que arreglar el script que se encuentra a el final ...
	$menuAdmiPlata =" <div class='AccordionPanel'>
	                    <div class='AccordionPanelTab' style='font-size:17px'>Administracion Plataforma</div>
	                    <div class='AccordionPanelContent'>
	                        <ul>
	                            <li id='menu_estadoProductosAlmacen' class='opciones'>Administrar Modulos</li>
	                            <li id='menu_estadoProductosAlmacen' class='opciones'>Administrar Submodulos</li>
	                        </ul>
	                    </div>
	                </div> ";
	//------------------------------------------------------------------

	$html =" <div id='Accordion1' class='Accordion' tabindex='0'> ";
		// como esta el menu principal y menuAdmiPlata  debe de traer los demas modulos y submodulos y agregarlos en medi de este div
		$html.=$menuPrincipal;
		$html.=$menuAdmiPlata;
	$html.=" </div> ";
	// scrip para que funcione el menu desplegable...
	$script=" <script>
	            jQuery(document).ready(function(){
	                jQuery('li#click').click(function() {
	                    var dato = jQuery(this).attr('value');
	                    jQuery('#sectionContent').load('AplicacionView/'+dato);
	                });
	            });
			</script>";		
	$html.=$script;
	$respuesta = utf8_encode($html);
    echo $respuesta;
}
?>