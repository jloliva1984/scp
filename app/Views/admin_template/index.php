<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8" />
        <meta http-equiv="X-UA-Compatible" content="IE=edge" />
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
        <meta name="description" content="" />
        <meta name="author" content="" />
         	
        <link rel="shortcut icon" href="<?php echo base_url('assets/images/')?>/favicon.ico"  />

        <title>SCP || IPROYAZ</title>
        <link href="<?php echo base_url('/assets/admin_template/');?>/css/styles.css" rel="stylesheet" />
        <link rel="stylesheet" href="<?php echo base_url('/assets/admin_template/');?>/fontawesome/css/all.min.css">
        
        <link rel="stylesheet" href="<?php echo base_url('/assets/admin_template/');?>/css/cards.css">
        
        <link href="<?php echo base_url('/assets/admin_template/');?>/css/dataTables.bootstrap4.min.css" rel="stylesheet" crossorigin="anonymous" />
        <script src="<?php echo base_url('/assets/admin_template/');?>/fontawesome/js/all.min.js" crossorigin="anonymous"></script>
        
    </head>
    <body class="sb-nav-fixed">
        <nav class="sb-topnav navbar navbar-expand navbar-dark bg-dark">
            <a class="navbar-brand" href="index.html">SCP || IPROYAZ</a>
            <button class="btn btn-link btn-sm order-1 order-lg-0" id="sidebarToggle" href="#"><svg xmlns="http://www.w3.org/2000/svg" width="16" height="16" fill="currentColor" class="bi bi-arrow-left-right" viewBox="0 0 16 16">
  <path fill-rule="evenodd" d="M1 11.5a.5.5 0 0 0 .5.5h11.793l-3.147 3.146a.5.5 0 0 0 .708.708l4-4a.5.5 0 0 0 0-.708l-4-4a.5.5 0 0 0-.708.708L13.293 11H1.5a.5.5 0 0 0-.5.5zm14-7a.5.5 0 0 1-.5.5H2.707l3.147 3.146a.5.5 0 1 1-.708.708l-4-4a.5.5 0 0 1 0-.708l4-4a.5.5 0 1 1 .708.708L2.707 4H14.5a.5.5 0 0 1 .5.5z"/>
</svg></button>
            <!-- Navbar Search-->
            <div><font COLOR="white" class="text-center"><?php echo date('d/m/Y'); ?></font></div>

            <form class="d-none d-md-inline-block form-inline ml-auto mr-0 mr-md-3 my-2 my-md-0">
                <!-- <div class="input-group">
                    <input class="form-control" type="text" placeholder="" aria-label="Search" aria-describedby="basic-addon2" />
                    <div class="input-group-append">
                        <button class="btn btn-primary" type="button"><i class="fas fa-search"></i></button>
                    </div>
                </div> -->
            </form>
            <!-- Navbar-->
            <ul class="navbar-nav ml-auto ml-md-0">
                <li class="nav-item dropdown">
                    <a class="nav-link dropdown-toggle" id="userDropdown" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false"><i class="fas fa-user fa-fw"></i>
                    <?php 
                    if(session()->has('loggedUserName')){ echo session()->get('loggedrol').'/'.session()->get('loggedUserName');} 
                    ?>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right" aria-labelledby="userDropdown">
                     <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="<?= base_url().'/login/logout' ?>"><i class="fas fa-sign-out-alt"></i> Cerrar sesión</a>
                    </div>
                </li>
            </ul>
        </nav>
        <div id="layoutSidenav">
            <div id="layoutSidenav_nav">
                <nav class="sb-sidenav accordion sb-sidenav-dark" id="sidenavAccordion">
                    <div class="sb-sidenav-menu">
                        <div class="nav">
                            <div class="sb-sidenav-menu-heading">Dashboard</div>
                            <a class="nav-link" href="<?= base_url()?>/home">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Dashboard
                            </a>
                            <div class="sb-sidenav-menu-heading">Planificación</div>
                            <a class="nav-link" href="<?= base_url()?>/planificacion/proyectos_management">
                                <div class="sb-nav-link-icon"><i class="fas fa-tachometer-alt"></i></div>
                                Planificación
                            </a>
                            <div class="sb-sidenav-menu-heading">Administración</div>
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayouts" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Codificadores
                                <div class="sb-sidenav-collapse-arrow"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayouts" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="<?= base_url() ?>/proyectos/proyectos_management">Proyectos</a>
                                    <a class="nav-link" href="<?= base_url() ?>/SubElementosGastos/subelementosgastos_management">Subelementos Gastos</a>
                                    <a class="nav-link" href="<?= base_url() ?>/Especialidades/especialidades_management">Especialidades</a>
                                    <a class="nav-link" href="<?= base_url() ?>/Especialistas/especialistas_management">Especialistas</a>
                                    <a class="nav-link" href="<?= base_url() ?>/Usuarios/usuarios_management">Usuarios</a>
                                    <a class="nav-link" href="<?= base_url() ?>/Codificadores/user_rol_show">Roles</a>
                                    <a class="nav-link" href="<?= base_url() ?>/Codificadores/actions_management">Acciones</a>
                                </nav>
                            </div>

                            <div class="sb-sidenav-menu-heading">Prorrateo</div>
                            <a class="nav-link" href="<?= base_url()?>/Proyectos/prorrateo_show">
                                <div class="sb-nav-link-icon"><i class="fas fa-share-alt"></i></div>
                                Prorrateo
                            </a>

                            <div class="sb-sidenav-menu-heading">REPORTES</div>
                            <a class="nav-link" href="<?= base_url()?>/Proyectos/reportes_dashboard">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Reportes
                            </a>

                            <!-- <div class="sb-sidenav-menu-heading">Reportes</div>
                            <a class="nav-link collapsed" href="#" data-toggle="collapse" data-target="#collapseLayoutsReportes" aria-expanded="false" aria-controls="collapseLayouts">
                                <div class="sb-nav-link-icon"><i class="fas fa-columns"></i></div>
                                Reportes
                                <div class="sb-sidenav-collapse-arrow"></i></div>
                            </a>
                            <div class="collapse" id="collapseLayoutsReportes" aria-labelledby="headingOne" data-parent="#sidenavAccordion">
                                <nav class="sb-sidenav-menu-nested nav">
                                    <a class="nav-link" href="<?= base_url() ?>/Proyectos/reporte_prorrateo">Prorrateo</a>
                                </nav>
                            </div> -->


                            
                            
                           
                    </div>
                    <div class="sb-sidenav-footer">
                        <div class="small">Logueado como:</div>
                        <?php 
                    if(session()->has('loggedUserName')){ echo session()->get('loggedrol');} 
                    ?>
                    </div>
                </nav>
            </div>
            

        <!--area editable de la plantilla-->
        <div class="container-fluid" style="width: 100%;">
        <?= $this->renderSection('content') ?>
       
        <!--end area editable-->




                    <footer class="py-3 bg-light mt-auto">
                        <div class="container-fluid">
                            <div class="d-flex align-items-center justify-content-between small">
                                <div class="text-muted">Desarrollo - DATAZAUCAR - SANTIAGO DE CUBA - ESP. ING. JORGE LUIS OLIVA MATOS - CELL 58391013 </div>
                                <div>
                                    <a href="#"></a>
                                    &middot;
                                    <a href="#"></a>
                                </div>
                            </div>
                        </div>
                    </footer>
        </div>   
            </div>
        </div>
        
        <!--OOOOOJJJOOOOOO    EN LAS VISTAS DONDE NO USE GROCERY DEBO CARGAR JQUERY MANUALMENTE-->

        <!--<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" crossorigin="anonymous"></script>-->
        <script src="<?php echo base_url('/assets/admin_template/')?>/js/bootstrap.bundle.min.js" crossorigin="anonymous"></script>
        
        <script src="<?php echo base_url('/assets/admin_template/')?>/js/scripts.js"></script>
        
        <!-- <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/2.8.0/Chart.min.js" crossorigin="anonymous"></script> -->
        <script src="<?php echo base_url('/assets/admin_template/')?>/assets/demo/chart-area-demo.js"></script>
        <script src="<?php echo base_url('/assets/admin_template/')?>/assets/demo/chart-bar-demo.js"></script>
        <!-- <script src="<?php echo base_url('/assets/')?>/datatables/datatables.min.js" crossorigin="anonymous"></script>
        <script src="<?php echo base_url('/assets/')?>/datatables/datatables.bootstrap4.min.js" crossorigin="anonymous"></script> -->
        <!-- <script src="<?php echo base_url('/assets/admin_template/')?>/assets/demo/datatables-demo.js"></script> -->
        <script defer src="<?php echo base_url('/assets/admin_template/')?>/fontawesome/js/brands.js" crossorigin="anonymous"></script>
        <script defer src="<?php echo base_url('/assets/admin_template/')?>/fontawesome/js/fontawesome.js" crossorigin="anonymous"></script>

        
        <!-- highcharts -->
        <!-- <script src="https://code.highcharts.com/highcharts.js"></script>
        <script src="https://code.highcharts.com/modules/data.js"></script>
        <script src="https://code.highcharts.com/modules/exporting.js"></script>
        <script src="https://code.highcharts.com/modules/accessibility.js"></script> -->

        <!-- <script src="<?php //echo base_url('public'); ?>/js/all.min.js"></script>
        <script src="<?//= base_url('public'); ?>/js/bootstrap.bundle.min.js"></script>
        <script src="<?//= base_url('public'); ?>/js/scripts.js"></script> -->
        <!-- <script src="<?= base_url(); ?>/assets/demo/datatables-demo.js"></script> -->
    </body>
</html>
