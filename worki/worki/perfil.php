<?php include('seguridad.php'); 
@session_start();
?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
        <title>Worki - Mi Perfil</title>




        <link rel="icon" type="image/x-icon" href="assets/img/favicon.ico" />
        <!-- Font Awesome icons (free version)-->
        <script src="https://use.fontawesome.com/releases/v5.15.4/js/all.js" crossorigin="anonymous"></script>
        <!-- Google fonts-->
        <link href="https://fonts.googleapis.com/css?family=Saira+Extra+Condensed:500,700" rel="stylesheet" type="text/css" />
        <link href="https://fonts.googleapis.com/css?family=Muli:400,400i,800,800i" rel="stylesheet" type="text/css" />
        <!-- Core theme CSS (includes Bootstrap)-->
        <link href="css/styles.css" rel="stylesheet" />



        
        <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

<!--
    <script type="text/javascript" src="js/jquery-2.1.3.min.js"></script>
    <script type="text/javascript" src="js/jquery.min.js"></script>
    <script type="text/javascript" src="js/jquery.bpopup-0.9.0.min.js"></script> 
    <script type="text/javascript" src="js/jquery.easing.1.3.js"></script>
    <script type="text/javascript" src="js/sexyalertbox.v1.2.jquery.js"></script>
    <script type="text/javascript" src="js/bootstrap.min.js"></script>
-->


<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script>

        


          
        </script>

        <script>
            function validaVacio(valor) {
                valor = valor.replace("&nbsp;", "");
                valor = valor == undefined ? "" : valor;
                if (!valor || 0 === valor.trim().length) {
                    return true;
                    }
                else {
                    return false;
                    }
            }

            function modificarHobbie(id_hobbie, hobbie, id_tipo_hobbie, tipo_hobbie, descripcion){

                var stringHtml = '<select class="form-control form-control-user" aria-label=".form-select-lg ' 
                    + 'example" name="hobbie" id="hobbie">' 
                    + '<option value ="' + id_hobbie + '" selected>'+hobbie+'</option></select>';

                document.getElementById("div_hobbie").innerHTML = stringHtml;

                var stringHtml = '<select class="form-control form-control-user" aria-label=".form-select-lg ' 
                    + 'example" name="tipo_hobbie" id="tipo_hobbie">' 
                    + '<option value ="' + id_tipo_hobbie + '" selected>'+tipo_hobbie+'</option></select>';

                document.getElementById("div_tipo_hobbie").innerHTML = stringHtml;

                var stringHtml = '<textarea class="form-control" id="description" name="description" >'+descripcion+'</textarea>';
                document.getElementById("div_descripcion").innerHTML = stringHtml;

                $("#modalModificarHobbie").modal("show");
            }

            function cerrarModalModificarHobbie(){
                $('#modalModificarHobbie').modal('hide');
            }


$(document).ready(function(e){

    cargarTodosHobbies();

        $("#Forma1").on('submit', function(e){

            var idUser = document.getElementById("idUser").value; 
            var nombre = document.getElementById("nombre").value; 
            var apellido = document.getElementById("apellido").value; 
            var direccionRecidencia = document.getElementById("direccionRecidencia").value; 
            var telefono = document.getElementById("telefono").value; 
            var estado = document.getElementById("estado").value; 
            var cargo = document.getElementById("cargo").value; 


            if ( validaVacio(nombre) || validaVacio(apellido) || validaVacio(direccionRecidencia) 
                || validaVacio(telefono) || validaVacio(estado) || validaVacio(cargo)
            ) {  //COMPRUEBA CAMPOS VACIOS
                alert("Los campos no pueden quedar vacios");
                return false;
            }

            e.preventDefault();
            jQuery.ajax({
              type: "POST",
              dataType : "json",
              url: "AplicacionControl/ControlPerfil.php?action=actualizarInformacionBasica" ,
              //data: jQuery("#Forma1").serialize(),
                data: new FormData(this),
                contentType: false,
                cache: false,
                processData:false,
              beforeSend: function(){
                    $('.submitBtn').attr("disabled","disabled");
                    $('#fupForm').css("opacity",".5");
                },  
              success: function(json) {
                var conexion = json.conexion;
                if(conexion == 0){
                  setTimeout(function(){window.location.href="ErrorConexion.php";},2);  
                }else{
                  var error = json.errorA;
                  if(error == true){
                    //Sexy.error(json.mensaje);
                  }else{
                     //Sexy.error("Informacion actualizada correctamente");
                    var redirecction = json.redirecction;
                    if(redirecction != ""){
                      if(redirecction == 1){
                        setTimeout(function(){window.location.href="perfil.php";},2 ); 
                      }else{
                        setTimeout(function(){window.location.href="ActPass.php";},2); 
                      } 
                    }
                  }
                }
              }
            });
        });

    $("#Forma2").on('submit', function(e){
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: "AplicacionControl/ControlPerfil.php?action=actualizarFotoPerfil" ,
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            dataType : "json",
            beforeSend: function(){
                $('.submitBtn').attr("disabled","disabled");
                $('#fupForm').css("opacity",".5");
            },
            success: function(json) {
                console.log(json);
            
                var conexion = json.conexion;
                if(conexion == 0){
                  setTimeout(function(){window.location.href="ErrorConexion.php";},2);  
                }else{
                  var error = json.errorA;
                  if(error == true){
                    //Sexy.error(json.mensaje);
                  }else{
                     //Sexy.error("Informacion actualizada correctamente");
                    
                    var redirecction = json.redirecction;
                    if(redirecction != ""){
                      if(redirecction == 1){
                        setTimeout(function(){window.location.href="perfil.php";},2 ); 
                      }else{
                        setTimeout(function(){window.location.href="ActPass.php";},2); 
                      } 
                    }
                    
                  }
                }
                
              }
        });
    });

    $("#FormularioNuevoHobbit").on('submit', function(e){
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: "AplicacionControl/ControlPerfil.php?action=registrarHobbitUsuario" ,
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            dataType : "json",
            beforeSend: function(){
                $('.submitBtn').attr("disabled","disabled");
                $('#fupForm').css("opacity",".5");
            },
            success: function(json) {
                console.log(json);
            
                var conexion = json.conexion;
                if(conexion == 0){
                  setTimeout(function(){window.location.href="ErrorConexion.php";},2);  
                }else{
                  var error = json.errorA;
                  if(error == true){
                    //Sexy.error(json.mensaje);
                  }else{
                     //Sexy.error("Informacion actualizada correctamente");
                    
                    
                    var redirecction = json.redirecction;
                    if(redirecction != ""){
                      if(redirecction == 1){
                        setTimeout(function(){window.location.href="perfil.php";},2 ); 
                      }else{
                        setTimeout(function(){window.location.href="ActPass.php";},2); 
                      } 
                    }

                    
                  }
                }
                
              }
        });
    });
        
    $("#FormularioActualizarHobbit").on('submit', function(e){
        e.preventDefault();
        $.ajax({
            type: 'POST',
            url: "AplicacionControl/ControlPerfil.php?action=modificarHobbitUsuario" ,
            data: new FormData(this),
            contentType: false,
            cache: false,
            processData:false,
            dataType : "json",
            beforeSend: function(){
                $('.submitBtn').attr("disabled","disabled");
                $('#fupForm').css("opacity",".5");
            },
            success: function(json) {
                console.log(json);
            
                var conexion = json.conexion;
                if(conexion == 0){
                  setTimeout(function(){window.location.href="ErrorConexion.php";},2);  
                }else{
                  var error = json.errorA;
                  if(error == true){
                    //Sexy.error(json.mensaje);
                  }else{
                     //Sexy.error("Informacion actualizada correctamente");
                    cerrarModalModificarHobbie();
                    
                    var redirecction = json.redirecction;
                    if(redirecction != ""){
                      if(redirecction == 1){
                        setTimeout(function(){window.location.href="perfil.php";},2 ); 
                      }else{
                        setTimeout(function(){window.location.href="ActPass.php";},2); 
                      } 
                    }

                    
                  }
                }
                
              }
        });
    });
    


    //file type validation
    $("#file").change(function() {
        var file = this.files[0];
        var imagefile = file.type;
        var match= ["image/jpeg","image/png","image/jpg"];
        if(!((imagefile==match[0]) || (imagefile==match[1]) || (imagefile==match[2]))){
            alert('Please select a valid image file (JPEG/JPG/PNG).');
            $("#file").val('');
            return false;
        }
    });
});
</script>

    </head>
    <body id="page-top">



       



        <!-- Navigation-->
        <nav class="navbar-nav navbar-expand-lg navbar-dark sidebar sidebar-dark bg-gradient-primary fixed-top" id="sideNav">
            <!-- Sidebar - Brand -->


<!-- Sidebar - Brand -->
            <a class="sidebar-brand d-flex align-items-center justify-content-center" href="index_dashboard.php">
                <div class="sidebar-brand-icon rotate-n-15">
                    <i class="fas fa-laugh-wink"></i>
                </div>
                <div class="sidebar-brand-text mx-3">Worki <sup>2</sup></div>
            </a>
            <!-- Divider -->
            <hr class="sidebar-divider my-0">

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="index_dashboard.php">
                    <img class="img-profile rounded-circle"
                                    src="img/undraw_rocket.svg">
                    <span>Muro</span></a>
            </li>


            <!-- Divider -->
            <hr class="sidebar-divider">


            <a class="navbar-brand js-scroll-trigger " href="#page-top" data-toggle="modal" data-target="#modalActualizarFoto"> 
                <span class="d-block d-lg-none"><?php echo $_SESSION['imagen_perfil']; ?></span>
                <span class="d-none d-lg-block"><img class="img-fluid img-profile rounded-circle mx-auto mb-2" 
                    src="assets/img_perfil/<?php echo $_SESSION['imagen_perfil']; ?>" alt="..." /></span>
            </a>
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarResponsive" aria-controls="navbarResponsive" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"></span></button>
            <div class="collapse navbar-collapse" id="navbarResponsive">
                <ul class="navbar-nav">
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="#informacionPersonal">Información Personal</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="#Hobbies">Hobbies</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link js-scroll-trigger" href="#InformacionLaboral">Informacion laboral</a>
                    </li>


                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#education">Education</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#skills">Skills</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#interests">Interests</a></li>
                    <li class="nav-item"><a class="nav-link js-scroll-trigger" href="#awards">Awards</a></li>
                </ul>
            </div>
        </nav>














        <!-- Page Content-->
        <div class="container-fluid p-0">
            <!-- About-->
            <section class="resume-section" id="informacionPersonal">
                <div class="resume-section-content">
                    <center>
                        <h1 class="mb-5"> <?php echo $_SESSION['apellido_usuario']; ?>
                            <span class="text-primary"><?php echo $_SESSION['nombre_usuario']; ?></span>
                        </h1>
                     </center>
                    <h4 class=" mb-5">Información Personal</h4>

                    <div class="d-flex flex-column flex-md-row justify-content-between mb-3">
                        <div class="flex-grow-1">
                            <div class="subheading mb-2" >
                                Empresa: <?php echo $_SESSION['nombre_empresa']; ?>  
                            </div>
                            <div class="subheading mb-2" >
                                Cargo Laboral: <?php echo $_SESSION['cargo']; ?>  
                            </div>
                            <div class="subheading mb-2" >
                                Dirección: <?php echo $_SESSION['direccion']; ?>  
                            </div>
                            <div class="subheading mb-2 ">
                                Telefono: <?php echo $_SESSION['numero_telefonico']; ?>
                            </div>
                            <div class="subheading mb-2 ">
                                Estado conexión: <?php echo $_SESSION['estado_conexion']; ?>
                            </div>
                            <div class="subheading mb-5">
                                Correo:
                                <a href="mailto:<?php echo $_SESSION['email']; ?>"><?php echo $_SESSION['email']; ?></a>
                            </div>
                            
                              <p class="lead mb-5"><?php echo $_SESSION['mi_estado']; ?></p>
                        </div>



                        <div class="flex-shrink-0 ">
                        <span class="text-primary">
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modalInfoPersonal">
                                <i class="fas fa-edit fa-sm fa-fw mr-2 text-gray-400"></i>
                                <span class="text-primary">Editar Información</span>
                            </a>
                        </span>
                    </div>
                        


                        



                        <div class="dropdown-divider"></div>
                        

                    </div>
                    
                  
                    <div class="social-icons">
                        <a class="social-icon" href="#!"><i class="fab fa-linkedin-in"></i></a>
                        <a class="social-icon" href="#!"><i class="fab fa-github"></i></a>
                        <a class="social-icon" href="#!"><i class="fab fa-twitter"></i></a>
                        <a class="social-icon" href="#!"><i class="fab fa-facebook-f"></i></a>
                    </div>
                    
                </div>
            </section>
            <hr class="m-0" />



            <!-- Hobbies-->
            <section class="resume-section" id="Hobbies">
                <div class="resume-section-content">
                    <div class="d-flex flex-column flex-md-row justify-content-between mb-5">
                        <div class="flex-grow-1">
                            <h2 class="mb-5">Hobbies</h2>
                        </div>
                        <div class="flex-shrink-0">
                            <span class="text-primary">
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modalNuevoHobbie">
                                <i class="fas fa-edit fa-sm fa-fw mr-2 text-gray-400"></i>
                                <span class="text-primary">Registrar Hobbie</span>
                            </a>
                            </span>
                        </div>
                    </div>
                    
                    <div id="contenidoHobbies" name="contenidoHobbies"></div>

                </div>
            </section>
            <hr class="m-0" />



            <!-- Hobbies-->
            <section class="resume-section" id="InformacionLaboral">
                <div class="resume-section-content">
                    <div class="d-flex flex-column flex-md-row justify-content-between mb-5">
                        <div class="flex-grow-1">
                            <h2 class="mb-5">Informacion Laboral</h2>
                        </div>
                        <div class="flex-shrink-0">
                            <span class="text-primary">
                            <a class="dropdown-item" href="#" data-toggle="modal" data-target="#modalInfoPersonal">
                                <i class="fas fa-edit fa-sm fa-fw mr-2 text-gray-400"></i>
                                <span class="text-primary">Registrar Información Laboral</span>
                            </a>
                        </span>
                        </div>
                    </div>
                    
                    <div class="d-flex flex-column flex-md-row justify-content-between mb-5">
                        <div class="flex-grow-1">
                            <h3 class="mb-0">Senior Web Developer</h3>
                            <div class="subheading mb-3">Intelitec Solutions</div>
                            <p>Bring to the table win-win survival strategies to ensure proactive domination. At the end of the day, going forward, a new normal that has evolved from generation X is on the runway heading towards a streamlined cloud solution. User generated content in real-time will have multiple touchpoints for offshoring.</p>
                        </div>
                        <div class="flex-shrink-0"><span class="text-primary">March 2013 - Present</span></div>
                    </div>
                    <div class="d-flex flex-column flex-md-row justify-content-between mb-5">
                        <div class="flex-grow-1">
                            <h3 class="mb-0">Web Developer</h3>
                            <div class="subheading mb-3">Intelitec Solutions</div>
                            <p>Capitalize on low hanging fruit to identify a ballpark value added activity to beta test. Override the digital divide with additional clickthroughs from DevOps. Nanotechnology immersion along the information highway will close the loop on focusing solely on the bottom line.</p>
                        </div>
                        <div class="flex-shrink-0"><span class="text-primary">December 2011 - March 2013</span></div>
                    </div>
                    <div class="d-flex flex-column flex-md-row justify-content-between mb-5">
                        <div class="flex-grow-1">
                            <h3 class="mb-0">Junior Web Designer</h3>
                            <div class="subheading mb-3">Shout! Media Productions</div>
                            <p>Podcasting operational change management inside of workflows to establish a framework. Taking seamless key performance indicators offline to maximise the long tail. Keeping your eye on the ball while performing a deep dive on the start-up mentality to derive convergence on cross-platform integration.</p>
                        </div>
                        <div class="flex-shrink-0"><span class="text-primary">July 2010 - December 2011</span></div>
                    </div>
                    <div class="d-flex flex-column flex-md-row justify-content-between">
                        <div class="flex-grow-1">
                            <h3 class="mb-0">Web Design Intern</h3>
                            <div class="subheading mb-3">Shout! Media Productions</div>
                            <p>Collaboratively administrate empowered markets via plug-and-play networks. Dynamically procrastinate B2C users after installed base benefits. Dramatically visualize customer directed convergence without revolutionary ROI.</p>
                        </div>
                        <div class="flex-shrink-0"><span class="text-primary">September 2008 - June 2010</span></div>
                    </div>
                </div>
            </section>
            <hr class="m-0" />



            <!-- Education-->
            <section class="resume-section" id="education">
                <div class="resume-section-content">
                    <h2 class="mb-5">Education</h2>
                    <div class="d-flex flex-column flex-md-row justify-content-between mb-5">
                        <div class="flex-grow-1">
                            <h3 class="mb-0">University of Colorado Boulder</h3>
                            <div class="subheading mb-3">Bachelor of Science</div>
                            <div>Computer Science - Web Development Track</div>
                            <p>GPA: 3.23</p>
                        </div>
                        <div class="flex-shrink-0"><span class="text-primary">August 2006 - May 2010</span></div>
                    </div>
                    <div class="d-flex flex-column flex-md-row justify-content-between">
                        <div class="flex-grow-1">
                            <h3 class="mb-0">James Buchanan High School</h3>
                            <div class="subheading mb-3">Technology Magnet Program</div>
                            <p>GPA: 3.56</p>
                        </div>
                        <div class="flex-shrink-0"><span class="text-primary">August 2002 - May 2006</span></div>
                    </div>
                </div>
            </section>
            <hr class="m-0" />
            <!-- Skills-->
            <section class="resume-section" id="skills">
                <div class="resume-section-content">
                    <h2 class="mb-5">Skills</h2>
                    <div class="subheading mb-3">Programming Languages & Tools</div>
                    <ul class="list-inline dev-icons">
                        <li class="list-inline-item"><i class="fab fa-html5"></i></li>
                        <li class="list-inline-item"><i class="fab fa-css3-alt"></i></li>
                        <li class="list-inline-item"><i class="fab fa-js-square"></i></li>
                        <li class="list-inline-item"><i class="fab fa-angular"></i></li>
                        <li class="list-inline-item"><i class="fab fa-react"></i></li>
                        <li class="list-inline-item"><i class="fab fa-node-js"></i></li>
                        <li class="list-inline-item"><i class="fab fa-sass"></i></li>
                        <li class="list-inline-item"><i class="fab fa-less"></i></li>
                        <li class="list-inline-item"><i class="fab fa-wordpress"></i></li>
                        <li class="list-inline-item"><i class="fab fa-gulp"></i></li>
                        <li class="list-inline-item"><i class="fab fa-grunt"></i></li>
                        <li class="list-inline-item"><i class="fab fa-npm"></i></li>
                    </ul>
                    <div class="subheading mb-3">Workflow</div>
                    <ul class="fa-ul mb-0">
                        <li>
                            <span class="fa-li"><i class="fas fa-check"></i></span>
                            Mobile-First, Responsive Design
                        </li>
                        <li>
                            <span class="fa-li"><i class="fas fa-check"></i></span>
                            Cross Browser Testing & Debugging
                        </li>
                        <li>
                            <span class="fa-li"><i class="fas fa-check"></i></span>
                            Cross Functional Teams
                        </li>
                        <li>
                            <span class="fa-li"><i class="fas fa-check"></i></span>
                            Agile Development & Scrum
                        </li>
                    </ul>
                </div>
            </section>
            <hr class="m-0" />
            <!-- Interests-->
            <section class="resume-section" id="interests">
                <div class="resume-section-content">
                    <h2 class="mb-5">Interests</h2>
                    <p>Apart from being a web developer, I enjoy most of my time being outdoors. In the winter, I am an avid skier and novice ice climber. During the warmer months here in Colorado, I enjoy mountain biking, free climbing, and kayaking.</p>
                    <p class="mb-0">When forced indoors, I follow a number of sci-fi and fantasy genre movies and television shows, I am an aspiring chef, and I spend a large amount of my free time exploring the latest technology advancements in the front-end web development world.</p>
                </div>
            </section>
            <hr class="m-0" />
            <!-- Awards-->
            <section class="resume-section" id="awards">
                <div class="resume-section-content">
                    <h2 class="mb-5">Awards & Certifications</h2>
                    <ul class="fa-ul mb-0">
                        <li>
                            <span class="fa-li"><i class="fas fa-trophy text-warning"></i></span>
                            Google Analytics Certified Developer
                        </li>
                        <li>
                            <span class="fa-li"><i class="fas fa-trophy text-warning"></i></span>
                            Mobile Web Specialist - Google Certification
                        </li>
                        <li>
                            <span class="fa-li"><i class="fas fa-trophy text-warning"></i></span>
                            1
                            <sup>st</sup>
                            Place - University of Colorado Boulder - Emerging Tech Competition 2009
                        </li>
                        <li>
                            <span class="fa-li"><i class="fas fa-trophy text-warning"></i></span>
                            1
                            <sup>st</sup>
                            Place - University of Colorado Boulder - Adobe Creative Jam 2008 (UI Design Category)
                        </li>
                        <li>
                            <span class="fa-li"><i class="fas fa-trophy text-warning"></i></span>
                            2
                            <sup>nd</sup>
                            Place - University of Colorado Boulder - Emerging Tech Competition 2008
                        </li>
                        <li>
                            <span class="fa-li"><i class="fas fa-trophy text-warning"></i></span>
                            1
                            <sup>st</sup>
                            Place - James Buchanan High School - Hackathon 2006
                        </li>
                        <li>
                            <span class="fa-li"><i class="fas fa-trophy text-warning"></i></span>
                            3
                            <sup>rd</sup>
                            Place - James Buchanan High School - Hackathon 2005
                        </li>
                    </ul>
                </div>
            </section>
        </div>




<div class="modal fade bd-example-modal-lg" id="modalActualizarFoto" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">ACTUALIZAR FOTO DE PERFIL</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>

        <div class="modal-body">
            <p class="statusMsg"></p>
<form enctype="multipart/form-data" id="Forma2" >
    <!-- -------------------- -->
                <input id="idUser" name="idUser" type="hidden" value="<?php echo $_SESSION["id_usuario"]; ?>">
                <!-- -------------------- -->
    <div class="form-group">
        <label for="file">Seleccione su nueva Foto de Perfil</label>
        <input type="file" class="form-control" id="file" name="file" required />
    </div>
    

        </div>
        <div class="modal-footer">
            <input type="submit" name="submit" class="btn btn-primary submitBtn" value="Actualizar Datos"/>
            <button class="btn btn-secondary" href="perfil.php" type="button" data-dismiss="modal">Cancelar</button>
        </div>
    </form>
    </div>
  </div>
</div>




<div class="modal fade bd-example-modal-lg" id="modalInfoPersonal" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">ACTUALIZAR INFORMACIÓN PERSONAL</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
    <form enctype="multipart/form-data" id="Forma1" >
        <div class="modal-body">
            
                <!-- -------------------- -->
                <input id="idUser" name="idUser" type="hidden" value="<?php echo $_SESSION["id_usuario"]; ?>">
                <!-- -------------------- -->

                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-3 col-form-label">Correo electronico *</label>
                    <div class="col-sm-9">
                      <a class="form-control" href="mailto:<?php echo $_SESSION['email']; ?>"><?php echo $_SESSION['email']; ?></a>
                    </div>
                  </div>

                  <div class="form-group row">
                    <label for="staticEmail" class="col-sm-3 col-form-label">Cargo Laboral *</label>
                    <div class="col-sm-9">
                        <input id="cargo" name="cargo" type="text" class="form-control" value="<?php echo $_SESSION['cargo']; ?>" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputPassword" class="col-sm-3 col-form-label">Nombres *</label>
                    <div class="col-sm-9">
                      <input id="nombre" name="nombre" type="text" class="form-control" value="<?php echo $_SESSION['nombre_usuario']; ?>" required>
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputPassword" class="col-sm-3 col-form-label">Apellidos *</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="apellido" name="apellido" value="<?php echo $_SESSION['apellido_usuario']; ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputPassword" class="col-sm-3 col-form-label">Dirección Recidencia *</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="direccionRecidencia" name="direccionRecidencia" value="<?php echo $_SESSION['direccion']; ?>">
                    </div>
                  </div>
                  <div class="form-group row">
                    <label for="inputPassword" class="col-sm-3 col-form-label">Telefono *</label>
                    <div class="col-sm-9">
                      <input type="text" class="form-control" id="telefono" name="telefono" value="<?php echo $_SESSION['numero_telefonico']; ?>">
                    </div>
                  </div>
                  <div class="form-group">
                    <label for="exampleFormControlTextarea1">Estado *</label>
                    <textarea class="form-control" id="estado" name="estado" ><?php echo trim($_SESSION['mi_estado']); ?></textarea>
                  </div>

            



        </div>
        <div class="modal-footer">
           
            <input type="submit" name="submit" class="btn btn-primary submitBtn" value="Actualizar Datos"/>
            <button class="btn btn-secondary" href="perfil.php" type="button" data-dismiss="modal">Cancelar</button>
            
        </div>
    </form>
    </div>
  </div>
</div>




<div class="modal fade bd-example-modal-lg" id="modalNuevoHobbie" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">REGISTRAR NUEVO HOBBIE</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
    <form enctype="multipart/form-data" id="FormularioNuevoHobbit" >
        <div class="modal-body">
            
                <!-- -------------------- -->
                <input id="idUser" name="idUser" type="hidden" value="<?php echo $_SESSION["id_usuario"]; ?>">
                <!-- -------------------- -->


                  <div class="form-group row">
                    <label for="inputPassword" class="col-sm-3 col-form-label">Hobbie</label>
                    <select class="form-control form-control-user" aria-label=".form-select-lg example" name="hobbie" id="hobbie">
                        <option value ="" selected>Seleccione Tipo Hobbie</option>
                    </select>
                  </div>
                  <div class="form-group row">
                    <label for="inputPassword" class="col-sm-3 col-form-label">Tipo Hobbie</label>
                    <select class="form-control form-control-user" aria-label=".form-select-lg example" name="tipo_hobbie" id="tipo_hobbie">
                        <option value ="" selected>Seleccione Hoppie</option>
                    </select>
                  </div>
                  <div class="form-group">
                    <label for="exampleFormControlTextarea1">Descripción *</label>
                    <textarea class="form-control" id="description" name="description" ></textarea>
                  </div>
        </div>
        <div class="modal-footer">
           
            <input type="submit" name="submit" class="btn btn-primary submitBtn" value="Actualizar Datos"/>
            <button class="btn btn-secondary" href="perfil.php" type="button" data-dismiss="modal">Cancelar</button>
        </div>
    </form>
    </div>
  </div>
</div>


<div class="modal fade bd-example-modal-lg" id="modalModificarHobbie" tabindex="-1" role="dialog" aria-labelledby="myLargeModalLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">MODIFICAR HOBBIE</h5>
        <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
        </button>
    </div>
    <form enctype="multipart/form-data" id="FormularioActualizarHobbit" >
        <div class="modal-body">
            
                <!-- -------------------- -->
                <input id="idUser" name="idUser" type="hidden" value="<?php echo $_SESSION["id_usuario"]; ?>">
                <!-- -------------------- -->

                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-3 col-form-label">Hobbie</label>
                    <div class="col-sm-9" id="div_hobbie" id="div_hobbie"></div>
                </div>

                <div class="form-group row">
                    <label for="staticEmail" class="col-sm-3 col-form-label">Tipo Hobbie</label>
                    <div class="col-sm-9" id="div_tipo_hobbie" id="div_tipo_hobbie"></div>
                </div>

                <div class="form-group">
                    <label for="exampleFormControlTextarea1">Descripción *</label>
                    <div id="div_descripcion" id="div_descripcion"></div>
                </div>
        </div>
        <div class="modal-footer">
           
            <input type="submit" name="submit" class="btn btn-primary submitBtn" value="Actualizar Hobbie"/>
            <input  onclick="eliminarHobbie()"class="btn btn-danger submitBtn" value="Eliminar Hobbie"/>
            <button class="btn btn-secondary" href="perfil.php" type="button" data-dismiss="modal">Cancelar</button>
        </div>
    </form>
    </div>
  </div>
</div>


    
<script type="text/javascript">
        cargarHobbie();
        
        function eliminarHobbie(){
            
            jQuery.ajax({
              type: "POST",
              dataType : "json",
              url: "AplicacionControl/ControlPerfil.php?action=eliminarHobbie" ,
              data: jQuery("#FormularioActualizarHobbit").serialize(),
              success: function(json) {
                var conexion = json.conexion;
                if(conexion == 0){
                  setTimeout(function(){window.location.href="ErrorConexion.php";},2);  
                }else{
                  var error = json.errorA;
                  if(error == true){
                    Sexy.error(json.mensaje);
                  }else{
                    var redirecction = json.redirecction;
                    if(redirecction != ""){
                      if(redirecction == 1){
                        setTimeout(function(){window.location.href="perfil.php";},2); 
                      }else{
                        setTimeout(function(){window.location.href="ActPass.php";},2); 
                      } 
                    }
                  }
                }
              }
            });
        }


        function cargarTodosHobbies(){

            var usuario = document.getElementById("idUser").value; 
        
            if ( validaVacio(usuario) ) {  //COMPRUEBA CAMPOS VACIOS
                alert("Los campos no pueden quedar vacios");
                return false;
            }

            jQuery.ajax({
              type: "POST",
              dataType : "json",
              url: "AplicacionControl/ControlPerfil.php?action=cargarTodosHobbies" ,
              data: jQuery("#FormularioNuevoHobbit").serialize(),
              success: function(json) {
                console.log(json);
                var conexion = json.conexion;
                if(conexion == 0){
                  setTimeout(function(){window.location.href="ErrorConexion.php";},2);  
                }else{
                  var error = json.errorA;
                  if(error == true){
                    Sexy.error(json.mensaje);
                  }else{

                    var arreglo = json.mensaje;
                    var stringHtml = "";
                    if (arreglo.length > 0 ){
                        var titulo= false;
                        var tituloActual = "";
                        for(var i=0; i < arreglo.length; i++){
                            
                            if (i == 0 ){
                                tituloActual = arreglo[i][1];
                            } else {
                                if (tituloActual != arreglo[i][1]) {
                                    tituloActual = arreglo[i][1];
                                    titulo = false;
                                }
                            }


                            if (titulo == false) {
                                stringHtml += ' <div class=d-flex flex-column flex-md-row justify-content-between mb-5" style="margin-top:100px"> ';
                                stringHtml += ' <div class="flex-grow-1"> ';
                                stringHtml += ' <center><h3 class="mb-0">' + arreglo[i][1] + '</h3></center>';
                                titulo = true;
                            }

                            stringHtml += ' <div class="subheading mb-3" style="margin-top: 60px;">'
                            stringHtml += ' <a  onclick="modificarHobbie(\'' 
                                        + arreglo[i][0] + '\',\'' + arreglo[i][1] + '\',\'' + arreglo[i][2] 
                                        + '\',\'' + arreglo[i][3] + '\',\'' + arreglo[i][5] + '\');" style="margin-right: 30px;">';
                            stringHtml += ' <i class="fas fa-edit fa-sm fa-fw mr-2 " style="color: #4e73df!important;"></i></a>'
                            stringHtml +=  arreglo[i][3] + '</div>';
                            stringHtml += ' <p>' + arreglo[i][5] + '</p>';
                            stringHtml += ' </div>';
                            stringHtml += ' </div>';
                        }

                        document.getElementById("contenidoHobbies").innerHTML = stringHtml;
                    }
                    
                  }
                }
              }
            });
        }


        function cargarHobbie(){

            var usuario = document.getElementById("idUser").value; 
        
            if ( validaVacio(usuario) ) {  //COMPRUEBA CAMPOS VACIOS
                alert("Los campos no pueden quedar vacios");
                return false;
            }

            jQuery.ajax({
              type: "POST",
              dataType : "json",
              url: "AplicacionControl/ControlPerfil.php?action=cargarHobbie" ,
              data: jQuery("#FormularioNuevoHobbit").serialize(),
              success: function(json) {
                console.log(json);
                var conexion = json.conexion;
                if(conexion == 0){
                  setTimeout(function(){window.location.href="ErrorConexion.php";},2);  
                }else{
                  var error = json.errorA;
                  if(error == true){
                    Sexy.error(json.mensaje);
                  }else{
                    addOptions('hobbie', json.mensaje);
                  }
                }
              }
            });
        }
        // Rutina para agregar opciones a un <select>
        function addOptions(domElement, json) {
        
        
         var select = document.getElementsByName(domElement)[0];
         for(var i=0; i < json.length; i++){
            var option = document.createElement("option");
            option.text = json[i][1];
            option.value = json[i][0];
            select.add(option);
         }
         
        }

        var select = document.querySelector('#hobbie'),
        input = document.querySelector('input[type="button"]');
        select.addEventListener('change',function(){
            
            


            var hobbie = document.getElementById("hobbie").value; 
        
            if ( validaVacio(hobbie) ) {  //COMPRUEBA CAMPOS VACIOS
                alert("Los campos no pueden quedar vacios");
                return false;
            }

            jQuery.ajax({
              type: "POST",
              dataType : "json",
              url: "AplicacionControl/ControlPerfil.php?action=cargarTipoHobbie" ,
              data: jQuery("#FormularioNuevoHobbit").serialize(),
              success: function(json) {
                console.log(json);
                var conexion = json.conexion;
                if(conexion == 0){
                  setTimeout(function(){window.location.href="ErrorConexion.php";},2);  
                }else{
                  var error = json.errorA;
                  if(error == true){
                    Sexy.error(json.mensaje);
                  }else{
                    $("#tipo_hobbie").empty();
                    addOptions('tipo_hobbie', json.mensaje);
                  }
                }
              }
            });
        });

        

    </script>

    <!-- Bootstrap core JS-->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
    <!-- Core theme JS-->
    <script src="js/scripts.js"></script>


        <!-- Bootstrap core JavaScript-->
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

    <!-- Core plugin JavaScript-->
    <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

    <!-- Custom scripts for all pages-->
    <script src="js/sb-admin-2.min.js"></script>

    <!-- Page level plugins -->
    <script src="vendor/chart.js/Chart.min.js"></script>

    <!-- Page level custom scripts -->
    <script src="js/demo/chart-area-demo.js"></script>
    <script src="js/demo/chart-pie-demo.js"></script>



    </body>
</html>
