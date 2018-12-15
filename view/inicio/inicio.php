<!DOCTYPE html>
<html>
<head>
  
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  
  <title>Bienvenido</title>
  
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  
  <link rel="stylesheet" href="../assets/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.5.0/css/font-awesome.min.css">
  <link rel="stylesheet" href="../assets/css/AdminLTE.min.css">
  <link rel="stylesheet" href="../assets/css/skin-blue.min.css">
  <link rel="stylesheet" href="../assets/css/style.css">
   <link rel="stylesheet" href="../assets/css/jquery.bootgrid.min.css">
  <!-- Google Font -->
  <link rel="stylesheet"
        href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
</head>

</head>

<body class="hold-transition skin-blue sidebar-mini">
<div class="wrapper">
  <!-- header -->
  <header class="main-header">
    <a href="/" class="logo">
      <span class="logo-lg"><b>Biblioteca</b></span> <!--Cuando La barra esta activa-->
      <span class="logo-mini"><b>Bi</b></span> <!--Cuando La barra esta desactivada-->
    </a>
    <nav class="navbar navbar-static-top">
      <a href="#" class="sidebar-toggle" data-toggle="offcanvas" role="button">
        
      </a>
      <div class="navbar-custom-menu">
        <ul class="nav navbar-nav">
          <li class="dropdown user user-menu">
            <a href="#" class="dropdown-toggle" data-toggle="dropdown">
              <img src="<?php echo $_SESSION['user_img'];?>" class="user-image" alt="User Image">
              <span class="hidden-xs"><?php echo $_SESSION['user']; ?></span>
            </a>
            <ul class="dropdown-menu">
              <li class="user-header">
                <img src="<?php echo $_SESSION['user_img'];?>" class="img-circle" alt="User Image">
                <h2><?php echo $_SESSION['user']; ?></h2>
              </li>
              <li class="user-footer">
                <div class="pull-right">
                  <a href="?c=login&a=CerrarSesion" class="btn btn-default btn-flat">Cerrar Sesion</a>
                </div>
              </li>
            </ul>
          </li>
        </ul>
      </div>
    </nav>
  </header>
  
 

<aside class="main-sidebar">


<section class="sidebar">

      <!-- Panel de Usuario -->
      <div class="user-panel">
            <div class="pull-left image">
              <img src="<?php echo $_SESSION['user_img'];?>" class="img-circle" alt="User Image">
            </div>
            <div class="pull-left info">
              <p> <?php echo $_SESSION['user']; ?> </p>
              <!-- Status -->
              <a href="#"><i class="fa fa-circle text-success"></i> Online</a>
           </div>
      </div>


      <!-- Menu Lateral -->
      <ul class="sidebar-menu" data-widget="tree">
        <li class="header">INICIO</li>
        

        <li class="treeview">
        <a href="#"><i class="fa fa-link"></i> <span>OPCIONES BASICAS</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
        </a>
            <ul class="treeview-menu">
                <li class="active"><a href="?c=Libro&a=Index"><i class="fa fa-book"></i> <span> Libros</span></a></li>
                <li><a href="?c=Autor&a=Index"><i class="fa fa-users"></i> <span> Autores</span></a></li>
                <li><a href="?c=Genero&a=Index"><i class="fa fa-list"></i><span> Generos</span></a></li>
                <li><a href="?c=Editorial&a=Index"><i class="fa fa-book"></i><span> Editoriales</span></a></li>
            </ul>
            <ul class="treeview-menu">
               <!-- Aqui va solo lo que va a acceder los Alumnos-->
            </ul>
        </li>
          
          

        <li class="treeview">
          <a href="#"><i class="fa fa-link"></i> <span>BAJAS</span>
            <span class="pull-right-container">
                <i class="fa fa-angle-left pull-right"></i>
              </span>
          </a>
          <ul class="treeview-menu">
            <li><a href="/?c=Usuario&a=BajarUsuario"><i class="fa fa-circle-o text-green "></i> <span> Solicitud de Baja</span></a></li>  
              <?php if ( $_SESSION['users_tipos_id']==3 ) {
                  # En este caso solo el ADMINISTRADOR
              ?>
              <li><a href="?c=Solicitudesbajas&a=Index"><i class="fa fa-circle-o text-green "></i> <span> Revisar Bajas</span></a></li>
          <?php
          }
           ?>
           </ul>
      </li>

      <li class="treeview">
            <a href="#"><i class="fa fa-link"></i> <span>REPORTES</span>
              <span class="pull-right-container">
                  <i class="fa fa-angle-left pull-right"></i>
                </span>
            </a>
            <ul class="treeview-menu">
            <li><a href="/?c=Reporte&a=ReporteProfesores"><i class="fa fa-list"></i><span>Listado de Profesores</span></a></li>
            </ul>
      </li>   
      </ul>

      <!-- /.sidebar-menu -->
    </section>
    <!-- /.sidebar -->
 </aside>


  <!-- Content -->
  <div class="content-wrapper">
  <section class="content">
