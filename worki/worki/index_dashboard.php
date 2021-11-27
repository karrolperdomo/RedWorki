<?php include('seguridad.php'); 
@session_start();
?>
<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Worki - Dashboard</title>

    <!-- Custom fonts for this template-->
    <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
    <link
        href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i"
        rel="stylesheet">

    <!-- Custom styles for this template-->
    <link href="css/sb-admin-2.min.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <script type="text/javascript">
        $(document).ready(function(e){

            $("#FormularioCambioEstado").on('submit', function(e){

                var idUser = document.getElementById("idUser").value;
                
                if (idUser == "") {
                    alert("Error usuario logueado");
                } else {
                    e.preventDefault();
                    $.ajax({
                        type: 'POST',
                        url: "AplicacionControl/ControlSession.php?action=cambiarEstadoConexion" ,
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
                                alert(json.mensaje);
                                
                              }else{
                                 alert("Estado actualizado correctamente");
                                
                                
                                var redirecction = json.redirecction;
                                if(redirecction != ""){
                                  if(redirecction == 1){
                                    setTimeout(function(){window.location.href="index_dashboard.php";},2 ); 
                                  }else{
                                    setTimeout(function(){window.location.href="ActPass.php";},2); 
                                  } 
                                }

                                
                              }
                            }
                            
                          }
                    });
                }

                
            });


            $("#FormNuevaPublicacion").on('submit', function(e){
                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: "AplicacionControl/ControlMuro.php?action=nuevaPublicacion" ,
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
                    
                        var conexion = json.conexion;
                        if(conexion == 0){
                            alert(json.mensaje);
                            setTimeout(function(){window.location.href="index_dashboard.php";},20);  
                        }else{
                          var error = json.errorA;
                          if(error == true){
                            //Sexy.error(json.mensaje);
                          }else{
                             //Sexy.error("Informacion actualizada correctamente");
                            
                            var redirecction = json.redirecction;
                            if(redirecction != ""){
                              if(redirecction == 1){
                                setTimeout(function(){window.location.href="index_dashboard.php";},2 ); 
                              }else{
                                setTimeout(function(){window.location.href="ActPass.php";},2); 
                              } 
                            }
                            
                          }
                        }
                        
                      }
                });
            });



            $("#FormularioComentarios").on('submit', function(e){

                e.preventDefault();
                $.ajax({
                    type: 'POST',
                    url: "AplicacionControl/ControlMuro.php?action=nuevoComentario" ,
                    data: new FormData(this),
                    contentType: false,
                    cache: false,
                    processData:false,
                    dataType : "json",
                    
                    success: function(json) {
                    
                        var conexion = json.conexion;
                        if(conexion == 0){
                            alert(json.mensaje);
                            setTimeout(function(){window.location.href="index_dashboard.php";},20);  
                        }else{
                          var error = json.errorA;
                          if(error == true){
                            //Sexy.error(json.mensaje);
                          }else{
                             //Sexy.error("Informacion actualizada correctamente");
                            
                            var redirecction = json.redirecction;
                            if(redirecction != ""){
                              if(redirecction == 1){
                                abrirVentanaComentarios(json.mensaje);
                                 
                              }else{
                                setTimeout(function(){window.location.href="index_dashboard.php";},2 );
                              } 
                            }
                            
                          }
                        }
                        
                      }
                });
            });






        });

        
    </script>
</head>

<body id="page-top">

    <!-- Page Wrapper -->
    <div id="wrapper">

        <!-- Sidebar -->
        <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

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

            <!-- Nav Item - Dashboard -->
            <li class="nav-item active">
                <a class="nav-link" href="perfil.php">
                    <img class="img-profile rounded-circle" src="assets/img_perfil/<?php echo $_SESSION['imagen_perfil']; ?>"">
                    <span>Mi Perfil </span></a>

            </li>



            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Interface
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            

            <!-- Nav Item - Utilities Collapse Menu -->
            

            <!-- Divider -->
            <hr class="sidebar-divider">

            <!-- Heading -->
            <div class="sidebar-heading">
                Addons
            </div>

            <!-- Nav Item - Pages Collapse Menu -->
            
            <!-- Nav Item - Charts -->
            
            

            

        </ul>
        <!-- End of Sidebar -->

        <!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">

                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">

                    <!-- Sidebar Toggle (Topbar) -->
                    <button id="sidebarToggleTop" class="btn btn-link d-md-none rounded-circle mr-3">
                        <i class="fa fa-bars"></i>
                    </button>

                    <!-- Topbar Search -->
                    <form
                        class="d-none d-sm-inline-block form-inline mr-auto ml-md-3 my-2 my-md-0 mw-100 navbar-search">
                        <div class="input-group">
                            <input type="text" class="form-control bg-light border-0 small" placeholder="Search for..."
                                aria-label="Search" aria-describedby="basic-addon2">
                            <div class="input-group-append">
                                <button class="btn btn-primary" type="button">
                                    <i class="fas fa-search fa-sm"></i>
                                </button>
                            </div>
                        </div>
                    </form>

                    <!-- Topbar Navbar -->
                    <ul class="navbar-nav ml-auto">

                        <!-- Nav Item - Search Dropdown (Visible Only XS) -->
                        <li class="nav-item dropdown no-arrow d-sm-none">
                            <a class="nav-link dropdown-toggle" href="#" id="searchDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-search fa-fw"></i>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-menu dropdown-menu-right p-3 shadow animated--grow-in"
                                aria-labelledby="searchDropdown">
                                <form class="form-inline mr-auto w-100 navbar-search">
                                    <div class="input-group">
                                        <input type="text" class="form-control bg-light border-0 small"
                                            placeholder="Search for..." aria-label="Search"
                                            aria-describedby="basic-addon2">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="button">
                                                <i class="fas fa-search fa-sm"></i>
                                            </button>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </li>

                        <!-- Nav Item - Alerts -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="alertsDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-bell fa-fw"></i>
                                <!-- Counter - Alerts -->
                                <span class="badge badge-danger badge-counter">3+</span>
                            </a>
                            <!-- Dropdown - Alerts -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="alertsDropdown">
                                <h6 class="dropdown-header">
                                    Alerts Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-primary">
                                            <i class="fas fa-file-alt text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 12, 2019</div>
                                        <span class="font-weight-bold">A new monthly report is ready to download!</span>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-success">
                                            <i class="fas fa-donate text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 7, 2019</div>
                                        $290.29 has been deposited into your account!
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="mr-3">
                                        <div class="icon-circle bg-warning">
                                            <i class="fas fa-exclamation-triangle text-white"></i>
                                        </div>
                                    </div>
                                    <div>
                                        <div class="small text-gray-500">December 2, 2019</div>
                                        Spending Alert: We've noticed unusually high spending for your account.
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Show All Alerts</a>
                            </div>
                        </li>

                        <!-- Nav Item - Messages -->
                        <li class="nav-item dropdown no-arrow mx-1">
                            <a class="nav-link dropdown-toggle" href="#" id="messagesDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <i class="fas fa-envelope fa-fw"></i>
                                <!-- Counter - Messages -->
                                <span class="badge badge-danger badge-counter">7</span>
                            </a>
                            <!-- Dropdown - Messages -->
                            <div class="dropdown-list dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="messagesDropdown">
                                <h6 class="dropdown-header">
                                    Message Center
                                </h6>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_1.svg"
                                            alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div class="font-weight-bold">
                                        <div class="text-truncate">Hi there! I am wondering if you can help me with a
                                            problem I've been having.</div>
                                        <div class="small text-gray-500">Emily Fowler · 58m</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_2.svg"
                                            alt="...">
                                        <div class="status-indicator"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">I have the photos that you ordered last month, how
                                            would you like them sent to you?</div>
                                        <div class="small text-gray-500">Jae Chun · 1d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="img/undraw_profile_3.svg"
                                            alt="...">
                                        <div class="status-indicator bg-warning"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Last month's report looks great, I am very happy with
                                            the progress so far, keep up the good work!</div>
                                        <div class="small text-gray-500">Morgan Alvarez · 2d</div>
                                    </div>
                                </a>
                                <a class="dropdown-item d-flex align-items-center" href="#">
                                    <div class="dropdown-list-image mr-3">
                                        <img class="rounded-circle" src="https://source.unsplash.com/Mv9hjnEUHR4/60x60"
                                            alt="...">
                                        <div class="status-indicator bg-success"></div>
                                    </div>
                                    <div>
                                        <div class="text-truncate">Am I a good boy? The reason I ask is because someone
                                            told me that people say this to all dogs, even if they aren't good...</div>
                                        <div class="small text-gray-500">Chicken the Dog · 2w</div>
                                    </div>
                                </a>
                                <a class="dropdown-item text-center small text-gray-500" href="#">Read More Messages</a>
                            </div>
                        </li>

                        <div class="topbar-divider d-none d-sm-block"></div>


                       
                        <!-- Nav Item - User Information -->
                        <li class="nav-item dropdown no-arrow">
                            
                            <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button"
                                data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <span class="mr-2 d-none d-lg-inline text-gray-600 small">
                                    <?php echo $_SESSION["nombre_completo"]?>
                                </span>
                                <img class="img-profile rounded-circle"
                                    src="assets/img_perfil/<?php echo $_SESSION['imagen_perfil']; ?>">
                            </a>
                            <!-- Dropdown - User Information -->
                            <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in"
                                aria-labelledby="userDropdown">
                                <a class="dropdown-item" href="perfil.php">
                                    <i class="fas fa-user fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Perfil
                                </a>
                                
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-cogs fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Settings
                                </a>
                                <a class="dropdown-item" href="#">
                                    <i class="fas fa-list fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Activity Log
                                </a>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#estadoModal">
                                    <i class="fas fa-status fa-sm fa-fw mr-2 text-green-400"></i>
                                   
                                    <?php $color = "light"; ?>
                                    <?php if ($_SESSION["estado_conexion"] == "Disponible") { $color = "success"; }?>
                                    <?php if ($_SESSION["estado_conexion"] == "Ocupado") { $color ="danger";} ?>
                                    <?php if ($_SESSION["estado_conexion"] == "No Molestar"){ $color =  "danger";} ?>
                                    <?php if ($_SESSION["estado_conexion"] == "Ausente"){$color =  "warning";} ?>
                                    <?php if ($_SESSION["estado_conexion"] == "Desconectado"){$color = "secondary";} ?>
                                    
                                    <div class="px-2 py-1 bg-gradient-<?php echo $color; ?> text-white">
                                        <?php echo $_SESSION["estado_conexion"]?>
                                    </div>
                                </a>
                                <div class="dropdown-divider"></div>
                                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                                    <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                                    Cerrar Sesion
                                </a>
                            </div>
                        </li>

                    </ul>

                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Muro</h1>
                        <a href="#" class="d-none d-sm-inline-block btn btn-sm btn-primary shadow-sm" data-toggle="modal" data-target="#nuevaPublicacionModal">
                            <i class="fas fa-download fa-sm text-white-50"></i> Nueva Publicación
                        </a>
                    </div>

                    <!-- Content Row -->


                    <div class="row">

                        <!-- Earnings (Monthly) Card Example -->
                <!--
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Earnings (Monthly)</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">$40,000</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-calendar fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                -->
                        <!-- Earnings (Monthly) Card Example -->
                <!--
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                                Earnings (Annual)</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">$215,000</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-dollar-sign fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                -->
                        <!-- Earnings (Monthly) Card Example -->
                <!--
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">Tasks
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">50%</div>
                                                </div>
                                                <div class="col">
                                                    <div class="progress progress-sm mr-2">
                                                        <div class="progress-bar bg-info" role="progressbar"
                                                            style="width: 50%" aria-valuenow="50" aria-valuemin="0"
                                                            aria-valuemax="100"></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                -->
                        <!-- Pending Requests Card Example -->
                <!--
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Pending Requests</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">18</div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                -->

                    </div>

                    <!-- Content Row -->

                    <div class="row" id="contenidoMuro">
                    </div>
                    <div class="row" id="contenidoMuro">

                    


                        


                        <!-- Area Chart -->
                        <div class="col-xl-8 col-lg-7">

                        </div>

                        <!-- Pie Chart -->
                        <div class="col-xl-4 col-lg-5">
                            <div class="card shadow mb-4">
                                <!-- Card Header - Dropdown -->
                                
                                <!-- Card Body -->
                                
                            </div>
                        </div>
                    </div>

                    

                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

            <!-- Footer -->
            <footer class="sticky-footer bg-white">
                <div class="container my-auto">
                    <div class="copyright text-center my-auto">
                        <span>Copyright &copy; Your Website 2021</span>
                    </div>
                </div>
            </footer>
            <!-- End of Footer -->

        </div>
        <!-- End of Content Wrapper -->

    </div>
    <!-- End of Page Wrapper -->

    <!-- Scroll to Top Button-->
    <a class="scroll-to-top rounded" href="#page-top">
        <i class="fas fa-angle-up"></i>
    </a>

    <!-- nueva publicacion Modal-->
    <div class="modal fade" id="nuevaPublicacionModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">NUEVA PUBLICACION</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form enctype="multipart/form-data" id="FormNuevaPublicacion" >
                    <div class="modal-body">
                
                        <!-- -------------------- -->
                        <input id="idUser" name="idUser" type="hidden" value="<?php echo $_SESSION["id_usuario"]; ?>">
                        <!-- -------------------- -->

                        
                        <div class="form-group row">
                            <label for="inputPassword" class="col-sm-3 col-form-label">Titulo</label>
                            <div class="col-sm-9">
                                <input id="titulo" name="titulo" type="text" class="form-control" value="" required>
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Descripción *</label>
                            <textarea class="form-control" id="description" name="description" ></textarea>
                        </div>
                        <div class="form-group">
                            <label for="file">Seleccione Foto a publicar</label>
                            <input type="file" class="form-control" id="file" name="file" required>
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



    <!-- comentarPublicacion Modal-->
    <div class="modal fade" id="comentarPublicacion" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">Comentarios Publicacion</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>


                <form enctype="multipart/form-data" id="FormularioComentarios" >

                    <!-- -------------------- -->
                    <input id="idUser" name="idUser" type="hidden" value="<?php echo $_SESSION["id_usuario"]; ?>">
                    <!-- -------------------- -->
                    <div id="variablesOcultas"></div>

                    <div class="modal-body">

                        <div id="listadoComentarios"></div>
                        

                        <!-- Basic Card Example -->

                        <!--
                        <div class="card shadow mb-4">
                            <div class="card-header py-3">
                                <div class="row no-gutters align-items-center">
                                    <div style="margin-right: 10px;">
                                        <img class="img-thumbnail rounded-circle" style="width: 70px;" src="assets/img_perfil/2.jpeg">
                                    </div>
                                    <div class="col mr-2">
                                        <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                            Bibiana Forero</div>
                                    </div>
                                    <div class="col-auto">
                                        <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                            2021-11-25 22:57:26
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="card-body">
                                hay que mentira
                            </div>
                        </div>
                    -->
                        <!-- Basic Card Example -->



                        <div class="form-group">
                            <label for="exampleFormControlTextarea1">Nuevo comentario</label>
                            <textarea class="form-control" id="comentario" name="comentario" required></textarea>
                        </div>
                        <input type="submit" name="submit" class="btn btn-primary submitBtn" value="Enviar Comentario"/>
                    </div>
                
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cerrar</button>
                </div>
                </form>
            </div>
        </div>
    </div>  


<!-- Logout Modal-->
    <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">¿Preparado para Salir?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <div class="modal-body">Seleccione "Cerrar sesión" a continuación si está listo para finalizar su sesión actual.</div>
                <div class="modal-footer">
                    <button class="btn btn-secondary" type="button" data-dismiss="modal">Cancelar</button>
                    <a class="btn btn-primary" href="salir.php">Cerrar Sesión</a>
                </div>
            </div>
        </div>
    </div>  

    <!-- estadoModal Modal-->
    <div class="modal fade" id="estadoModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="exampleModalLabel">¿Desea cambiar su estado de conexión?</h5>
                    <button class="close" type="button" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">×</span>
                    </button>
                </div>
                <form enctype="multipart/form-data" id="FormularioCambioEstado" >
                
                    <div class="modal-body">
                        
                        <!-- -------------------- -->
                        <input id="idUser" name="idUser" type="hidden" value="<?php echo $_SESSION["id_usuario"]; ?>">
                        <input id="id_empresa" name="id_empresa" type="hidden" value="<?php echo $_SESSION["id_empresa"]; ?>">
                        <!-- -------------------- -->
                         <div class="form-group row">

                            <a class="dropdown-item" >
                                <label for="inputPassword" class="col-sm-12 col-form-label">Su estado actual</label>
                                
                                <div class="col-sm-8 px-2 py-1 bg-gradient-<?php echo $color; ?> text-white"><?php echo $_SESSION["estado_conexion"]?></div>
                            </a>
                        </div>
                          <div class="form-group row">
                            <label for="inputPassword" class="col-sm-12 col-form-label">Cambiar Estado de conexión</label>
                            <select class="form-control form-control-user" aria-label=".form-select-lg example" name="estado_conexion" id="estado_conexion">
                                <option value="Disponible">Disponible</option>
                                <option value="Ocupado">Ocupado</option>
                                <option value="No Molestar">No Molestar</option>
                                <option value="Ausente">Ausente</option>
                                <option value="Desconectado">Desconectado</option>
                            </select>
                          </div>
                    </div>
                    <div class="modal-footer">
                       
                        <input type="submit" name="submit" class="btn btn-primary submitBtn" value="Actualizar Estado"/>
                        <button class="btn btn-secondary" href="perfil.php" type="button" data-dismiss="modal">Cancelar</button>
                    </div>
                </form>
                
            </div>
        </div>
    </div>  



    <script type="text/javascript">

        cargarNoticiasMuro();

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

        function cargarNoticiasMuro(){
            
            var usuario = document.getElementById("idUser").value; 
        
            if ( validaVacio(usuario) ) {  //COMPRUEBA CAMPOS VACIOS
                alert("Los campos no pueden quedar vacios");
                return false;
            }

            jQuery.ajax({
              type: "POST",
              dataType : "json",
              url: "AplicacionControl/ControlMuro.php?action=cargarNoticiasMuro" ,
              data: jQuery("#FormularioCambioEstado").serialize(),
              success: function(json) {
                console.log(json);
                var conexion = json.conexion;
                if(conexion == 0){
                    aler(json.mensaje); 
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
                            
                            stringHtml += ' <div class="col-xl-8 col-lg-7">';
                            stringHtml += ' <div class="card mb-4">';
                            stringHtml += ' <nav class="nav">';
                            stringHtml += ' <a class="nav-link active" href="#">';
                            stringHtml += ' <img class="img-thumbnail rounded-circle" style="width: 70px;" ' 
                                        + ' src="assets/img_perfil/'+arreglo[i][8]+'">';
                            stringHtml += ' </a>';
                            stringHtml += ' <a class="nav-link" href="#" style="margin-top: 15px">'+arreglo[i][6]+' '+arreglo[i][7]+'</a>';
                            stringHtml += ' </nav>';
                            stringHtml += ' <a href="#!"><center><img style="width:550px;height:550px;"class="card-img-top" src="assets/img_muro/'+arreglo[i][1]+'" alt="..." /></center></a>';
                            stringHtml += ' <div class="card-body">';
                            stringHtml += ' <div class="small text-muted">'+arreglo[i][2]+'</div>';
                            stringHtml += ' <h2 class="card-title">'+arreglo[i][3]+'</h2>';
                            stringHtml += ' <p class="card-text">'+arreglo[i][4]+'</p>';
                            
                            stringHtml += ' <div class="mt-5 text-center">';
                            stringHtml += ' <span class="mr-2">';
                            stringHtml += ' <i class="fas fa-thumbs-up text-primary"></i>'
                                        +' <label id="me_gusta_'+arreglo[i][0]+'" name="me_gusta_'
                                        +arreglo[i][0]+'">'+arreglo[i][9]+'</label>';
                            stringHtml += ' </span>';
                            stringHtml += ' </div>';
                            
                            stringHtml += ' <div id="botonMeGusta_'+arreglo[i][0]+'">';
                            stringHtml += ' <a onclick="meGusta(\''+arreglo[i][0]+'\')" ';
                            if (arreglo[i][10] == 0) {
                                stringHtml += ' class="btn btn-Light btn btn-sm" href="#!">Me gusta →</a>';
                            } else {
                                stringHtml += ' class="btn btn-success btn btn-sm" href="#!">Me gusta →</a>';
                            }
                            stringHtml += ' </div>';

                            stringHtml += ' <a onclick="abrirVentanaComentarios(\''+arreglo[i][0]+'\')" ' 
                                        +'class="d-none d-sm-inline-block btn btn-sm btn-secondary shadow-sm">';
                            stringHtml += ' <ion-icon name="chatbox-outline"></ion-icon>';
                            stringHtml += ' <i class="fas fa-pen-alt text-white-70"></i> Comentar';
                            stringHtml += ' </a>';
                            stringHtml += ' </div>';
                            stringHtml += ' </div>';
                            stringHtml += ' </div>';
                        }

                        document.getElementById("contenidoMuro").innerHTML = stringHtml;
                    }
                    
                  }
                }
              }
            });
        }

        function meGusta(idPublicacion){
            
            var idUser = document.getElementById("idUser").value;
            var valor = parseInt(document.getElementById("me_gusta_" + idPublicacion).innerHTML);
            

            jQuery.ajax({
              type: "POST",
              dataType : "json",
              url: "AplicacionControl/ControlMuro.php?action=registrarMeGusta" ,
              data: {id_publicacion:idPublicacion,iduser:idUser},
              success: function(json) {
                
                var conexion = json.conexion;
                if(conexion == 0){
                    aler(json.mensaje); 
                }else{
                  var error = json.errorA;
                  if(error == true){
                    Sexy.error(json.mensaje);
                  }else{

                    var stringHtml = '';

                    if (json.mensaje == 0) {
                        stringHtml = ' <a onclick="meGusta(\''+idPublicacion+'\')" '
                                        +'class="btn btn-Light btn btn-sm" href="#!">Me gusta →</a>';

                    } else {
                        stringHtml = ' <a onclick="meGusta(\''+idPublicacion+'\')" '
                                        +'class="btn btn-success btn btn-sm" href="#!">Me gusta →</a>';
                    }
                    
                    document.getElementById("me_gusta_"+ idPublicacion).innerHTML= json.cantidadMeGusta;
                    document.getElementById("botonMeGusta_"+idPublicacion).innerHTML = '';
                    document.getElementById("botonMeGusta_"+idPublicacion).innerHTML = stringHtml;
                  }
                }
              }
            });


        }

        function abrirVentanaComentarios(idPublicacion){

            document.getElementById('comentario').value = '';
            document.getElementById("listadoComentarios").innerHTML = "";
            var htmlOcultas = '<input id="idPublicacion" name="idPublicacion" type="hidden" value="'+idPublicacion+'">';
            document.getElementById("variablesOcultas").innerHTML = htmlOcultas;

            jQuery.ajax({
              type: "POST",
              dataType : "json",
              url: "AplicacionControl/ControlMuro.php?action=cargarComentarios" ,
              data: {id_publicacion:idPublicacion},
              success: function(json) {
                console.log(json);
                var conexion = json.conexion;
                if(conexion == 0){
                    aler(json.mensaje); 
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
                            
                            stringHtml += ' <div class="card shadow mb-4">';
                            stringHtml += ' <div class="card-header py-3">';
                            stringHtml += ' <div class="row no-gutters align-items-center">';
                            stringHtml += ' <div style="margin-right: 10px;">';
                            stringHtml += ' <img class="img-thumbnail rounded-circle" '
                                        +'style="width: 70px;" src="assets/img_perfil/'+arreglo[i][6]+'">';
                            stringHtml += ' </div>';
                            stringHtml += ' <div class="col mr-2">';
                            stringHtml += ' <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">';
                            stringHtml += ' '+arreglo[i][4]+' '+arreglo[i][5]+'</div>'
                            stringHtml += ' </div>';
                            stringHtml += ' <div class="col-auto">';
                            stringHtml += ' <div class="text-xs font-weight-bold text-success text-uppercase mb-1">';
                            stringHtml += arreglo[i][3];
                            stringHtml += ' </div>';
                            stringHtml += ' </div>';
                            stringHtml += ' </div>';
                            stringHtml += ' </div>';
                            stringHtml += ' <div class="card-body">';
                            stringHtml += arreglo[i][2];
                            stringHtml += ' </div>';
                            stringHtml += ' </div>';


                            



                        }

                        document.getElementById("listadoComentarios").innerHTML = stringHtml;
                    }
                    
                  }
                }
              }
            });

            $("#comentarPublicacion").modal("show");
        }
    </script>

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