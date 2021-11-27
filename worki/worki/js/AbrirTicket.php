<html>
    <head>
        <!-- Compatibilidad -->
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=Edge,chrome=1">
        <title>Apertura Ticket</title>
	<link rel="stylesheet" href="css/bootstrap.css">
	<link rel="stylesheet" href="css/bootstrap-responsive.css">
	<link rel="stylesheet" href="css/docs.css">
        <link rel="stylesheet" href="css/Estilo_Valida.css">
    </head>
    
    <body>
        
        <div class="span8 offset1">
                        <!-- Nombre del formulario y acciones de validacion -->
                         <form id="jform" method="post" name="Sform" action="Control_Nticket.php">
                             <div class="control-group">
                            <!-- Campos -->
                            <fieldset>
                                <legend>Abrir nuevo ticket</legend>
                                    <div class="control-group">
                                        <label class="control-label" for="IdCliente">C&eacute;dula o NIT:</label>
                                        <div class="controls">
                                            <input id="Id_Cliente" name="Id_Cliente" type="text" pattern="[0-9]*" placeholder="Ingrese CC o NIT" required><div id="nameInfo" class="info"></div>
                                        </div>
                                    </div>
                                
                                    <div class="control-group">
                                        <label class="control-label" for="NomCliente">Nombre usuario:</label>
                                        <div class="controls">
                                            <input id="Nom_Cliente" type="text" name="nombre_usuario" placeholder="Nombre" required><div id="NomInfo" class="info"></div>
                                        </div>
                                    </div>

                                    <div class="control-group">
                                        <label class="control-label" for="Celectronico">Correo electronico:</label>
                                        <div class="controls">
                                            <input id="C_electronico" type="email" name="correo_usuario" placeholder="Correo electronico" required><div id="emailInfo" class="info"></div>
                                        </div>
                                    </div>
                              </fieldset>
                         
                                        <fieldset>
                                        <label class="control-label" id="PLServicio">Placa de servicio:</label>
                                            <input type="text" name="plsvc" placeholder="Numero placa">
                                            <br>
                                            <label class ="label label-important">Si no posee numero de placa, active la casilla siguiente</label>
                                            <input type="checkbox" name="radSize" onclick="desabi();"/>
                                        </fieldset>
                                    
                                <label class="control-label" for="LDServicio"> En caso de no tener numero de PS:</label>
                                    <select disabled name="plsvcop">
                                            <option>Seleccione una opcion</option>
                                            <option>Redes, acceso a LAN</option>
                                           <option>Telefonia</option>
                                            <option>Red (Sin acceso a red o internet)</option>
                                            <option>Sin suministro electrico</option>
                                    </select>
                       
                                    
                                    <label class="control-label" for="PLServicio">Problemas frecuentes:</label>
                                    <select name="prob_frecuente">
                                            <option>Seleccione una opcion</option>
                                            <option>Hardware (Pantalla azul, apagado)</option>
                                           <option>Software (Bloqueo)</option>
                                            <option>Red (Sin acceso a red o internet)</option>
                                            <option>Sin suministro electrico</option>
                                    </select>
                                   
                                    <div class="control-group">
                                        <label class="control-label" for="P_Descripcion" >Describa el problema que presenta (MAX. 300 Caracteres)</label>
                                        <div class="controls">
                                            <textarea rows="3" name="problema" id="PDescripcion"></textarea>
                                        </div>
                                    </div>
                                        <!-- Enviar funcion con campos validados-->
                                        <button type="submit" id="BTNenviar" class="btn btn-danger" name="Generar" onclick="Imprimir_Ticket" href="#login_form">Guardar</button>
                                        <button class="btn">Cancelar</button>
                
                             </div>
                         </form> 
            </div>
        
            <div class="row">
                <div class="span5 offset3">
                    <!-- Funcion de impresion o error de ticket -->
                 <?php
                                class Respuesta_ticket {
                                    function error($result_error){
                                          echo "<script languaje='javascript' width='500px' heigth='500px'> alert(' " . $result_error . "')</script>";
                    
                                    }
                                   
                                }
                               ?>
                </div>
            </div>
                                   
                         <!-- Script para desabilitar/habilitar Combobox -->
        
                                    <script>
                                        function desabi()
                                            {
                                                document.Sform.plsvc.disabled = true;
                                                document.Sform.plsvcop.disabled = false;
                                            }
                                    </script>
        
            <script src="js/jquery.js"></script>
            <script src="js/prettify.js"></script>
            <script src="js/bootstrap-transition.js"></script>
            <script src="js/bootstrap-alert.js"></script>
            <script src="js/bootstrap-modal.js"></script>
            <script src="js/bootstrap-dropdown.js"></script>
            <script src="js/bootstrap-scrollspy.js"></script>
            <script src="js/bootstrap-tab2.js"></script>
            <script src="js/bootstrap-tooltip.js"></script>
            <script src="js/bootstrap-popover.js"></script>
            <script src="js/bootstrap-button.js"></script>
            <script src="js/bootstrap-collapse.js"></script>
            <script src="js/bootstrap-carousel.js"></script>
            <script src="js/bootstrap-typeahead.js"></script>
            <script type="text/javascript" src="js/validacion.js" charset="utf-8"></script>
            <script type="text/javascript" src="jqueryVal.js" charset="utf-8"></script>
    </body>
    
    
</html>


