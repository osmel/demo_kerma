<!-- begin::m-body -->
<div class="m-grid__item m-grid__item--fluid m-grid m-grid--ver-desktop m-grid--desktop m-body">
  <!-- BEGIN: Left Aside -->
  <button class="m-aside-left-close  m-aside-left-close--skin-dark " id="m_aside_left_close_btn">
    <i class="la la-close"></i>
  </button>
 <div id="m_aside_left" class="m-grid__item	m-aside-left  m-aside-left--skin-dark ">
    <!-- BEGIN: Aside Menu -->
  <div  id="m_ver_menu" class="m-aside-menu  m-aside-menu--skin-dark m-aside-menu--submenu-skin-dark" m-menu-vertical="1" m-menu-scrollable="0" m-menu-dropdown-timeout="500">

    <ul class="m-menu__nav  m-menu__nav--dropdown-submenu-arrow ">
        <!-- encabezado Catalogos --> 

        <?php foreach($menues as $key=>$menu) { ?>
          <?php //if ( ( $this->session->userdata( 'id_perfil' ) == 1  ) || (in_array(4, $coleccion_id_operaciones)) ) 
            { ?>    
                <!--grupo-->
                <li class="m-menu__section">
                    <h4 class="m-menu__section-text">
                      <?php   echo $menu['text'];  ?>
                    </h4>
                    <i class="m-menu__section-icon flaticon-more-v3"></i> <!-- no se usa creo -->
                </li>

                 <?php if  (isset($menu['objeto'])) { ?>
                      <?php foreach($menu['objeto'] as $key2=>$elem) { ?>
                      <!--Elementos-->
                      <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true"  m-menu-submenu-toggle="hover">
                          
                          
                              <!--Elementos-->
                              <a  href="<?php echo (trim($elem['enlace'])!='') ? '/kerma/'.$elem['enlace'] : '#';  ?>" class="m-menu__link m-menu__toggle"> <!--esonder la rayita de enlace  -->
                                <i class="m-menu__link-icon fas <?php  echo $elem['icono']; ?>"></i>  <!--Logotipo izquierdo -->
                                <span class="m-menu__link-text"> <!--Color para la palabra -->
                                  <?php   echo $elem['text'];  ?>
                                </span>
                                <i class="m-menu__ver-arrow la <?php  echo  (($elem['children']) ? 'la-angle-right' : '' ); ?>"></i> <!-- flecha derecha o izquierda -->
                              </a>
                           
                              <?php if  (isset($elem['objeto'])) { ?>
                                  <?php foreach($elem['objeto'] as $key3=>$subElemento) { ?>
                                      <!--detalles-->
                                      <div class="m-menu__submenu ">
                                          <span class="m-menu__arrow"></span>
                                          <ul class="m-menu__subnav">
                                              <li class="m-menu__item " aria-haspopup="true" >
                                                  <a  href="<?php echo (trim($subElemento['enlace'])!='') ? '/kerma/'.$subElemento['enlace'] : '#';  ?>" class="m-menu__link ">
                                                      <!-- Para poner el punto y el margen delante del detalle -->
                                                      <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                          <span></span>
                                                      </i>
                                                      <span class="m-menu__link-text">
                                                           <?php   echo $subElemento['text'];  ?>
                                                      </span>
                                                  </a>
                                              </li>
                                          </ul>
                                      </div>
                                  <?php }  ?>    
                              <?php }  ?>    
                                  
                      </li>
                      <?php }  ?>         
                <?php } ?>          
          <?php } ?>    

        <?php }  ?>    

      </ul>

 </div>
    <!-- END: Aside Menu -->
</div>
<!-- END: Left Aside -->
