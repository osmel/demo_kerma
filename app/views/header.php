<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<!DOCTYPE html>
<html lang="es_MX">
<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<title>ADMINISTRADOR DOSSIER LEGAL</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
  
  
  <link rel="shortcut icon" href="<?php echo base_url(); ?>assets/demo/default/media/img/logo/favicon.ico" />

  <?php echo link_tag('css/sistema.css'); ?>




    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.0.10/css/all.css">
    <link href="https://fonts.googleapis.com/css?family=Montserrat:400,700,900" rel="stylesheet">  
    
    

     <!--Estilos  bundle-->
    
    <link href="<?php echo base_url(); ?>metronic/dist/default/assets/vendors/base/vendors.bundle.css" rel="stylesheet" type="text/css" />
    <link href="<?php echo base_url(); ?>/metronic/dist/default/assets/demo/default/base/style.bundle.css" rel="stylesheet" type="text/css" />

    <!--Sirven para controlar las selecciones multiples del dropdawn-->
    <link href="<?php echo base_url(); ?>metronic/misplugins/bootstrap-select/css/bootstrap-select.css" rel="stylesheet" type="text/css" />

 <!--   <link href="<?php echo base_url(); ?>metronic/misplugins/selectize-master/css/selectize.css" rel="stylesheet" type="text/css" /> -->


    <!--Estilos-->
    <link href="<?php echo base_url(); ?>metronic/dist/default/assets/ed/css/estilos.css" rel="stylesheet" type="text/css" />

    <link rel="stylesheet" href="https://www.amcharts.com/lib/3/plugins/export/export.css" type="text/css" media="all" />

<style type="text/css">
  .dropdown-header { color: red; }
</style>


</head>
	<!-- end::Head -->
  <!-- begin::Body -->
  <body  class="m-page--fluid m--skin- m-content--skin-light2 m-header--fixed m-header--fixed-mobile m-aside-left--enabled m-aside-left--skin-dark m-aside-left--offcanvas m-footer--push m-aside--offcanvas-default" >
    <!-- begin:: Page -->
    <div class="m-grid m-grid--hor m-grid--root m-page" style="display: inline-block;">

      <!-- BEGIN: Header -->
      <header id="m_header" class="m-grid__item    m-header "  m-minimize-offset="200" m-minimize-mobile-offset="200" >
        <div class="m-container m-container--fluid m-container--full-height">
          <div class="m-stack m-stack--ver m-stack--desktop">
            <!-- BEGIN: Brand -->
            <div class="m-stack__item m-brand  m-brand--skin-dark ">
              <div class="m-stack m-stack--ver m-stack--general">
                
                <div class="m-stack__item m-stack__item--middle m-brand__tools">
                  <!-- BEGIN: Left Aside Minimize Toggle -->
                  <a href="javascript:;" id="m_aside_left_minimize_toggle" class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-desktop-inline-block">
                    <span></span>
                  </a>
                  <!-- END -->
                  <!-- BEGIN: Responsive Aside Left Menu Toggler -->
                  <a href="javascript:;" id="m_aside_left_offcanvas_toggle" class="m-brand__icon m-brand__toggler m-brand__toggler--left m--visible-tablet-and-mobile-inline-block">
                    <span></span>
                  </a>
                  <!-- END -->
                  <!-- BEGIN: Responsive Header Menu Toggler -->
                  <a id="m_aside_header_menu_mobile_toggle" href="javascript:;" class="m-brand__icon m-brand__toggler m--visible-tablet-and-mobile-inline-block">
                    <span></span>
                  </a>
                  <!-- END -->
                  <!-- BEGIN: Topbar Toggler -->
                  <a id="m_aside_header_topbar_mobile_toggle" href="javascript:;" class="m-brand__icon m--visible-tablet-and-mobile-inline-block">
                    <i class="flaticon-more"></i>
                  </a>
                  <!-- END: Topbar Toggler -->
                </div>
              </div>
            </div> <!-- END: Brand -->
            <div class="m-stack__item m-stack__item--fluid m-header-head" id="m_header_nav">
              <!--Logo-->
              <div id="m_header_menu" class="m-header-menu m-aside-header-menu-mobile m-aside-header-menu-mobile--offcanvas  m-header-menu--skin-light m-header-menu--submenu-skin-light m-aside-header-menu-mobile--skin-dark m-aside-header-menu-mobile--submenu-skin-dark "  >
                
            
              <a href="<?php echo base_url(); ?>">
                <img class="logo" src="<?php echo base_url(); ?>img/logo-login.png" alt="logo">
              </a>
            

              </div>
              <!--FIN Logo-->
             
				<?php $this->load->view( 'admin/principal/menu_usuario.php' ); ?>
				<div class="alert" id="messages"></div>

              <!-- END: Topbar -->
            </div>
          </div>
        </div>
      </header>
      <!-- END: Header -->