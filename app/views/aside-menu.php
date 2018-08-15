
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

        <?php //foreach($menues as $key=>$menu) 
        { ?>
          <?php  //if ( ( $this->session->userdata( 'id_perfil' ) == 1  ) || (in_array(4, $coleccion_id_operaciones)) ) 
            { ?>    


                <li class="m-menu__section">
                    <h4 class="m-menu__section-text">
                      <?php   echo 'Admin';  ?>
                    </h4>
                    <i class="m-menu__section-icon flaticon-more-v3"></i> <!-- no se usa creo -->
                </li>


                <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
                              <!--Elementos-->
                              <a href="#" class="m-menu__link m-menu__toggle"> <!--esonder la rayita de enlace  -->
                                <i class="m-menu__link-icon fas fa-chart-bar"></i>  <!--Logotipo izquierdo -->
                                <span class="m-menu__link-text"> <!--Color para la palabra -->
                                  Estatus                                </span>
                                <i class="m-menu__ver-arrow la "></i> <!-- flecha derecha o izquierda -->
                              </a>
               </li>

              <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
                              <!--Elementos-->
                              <a href="<?php echo base_url(); ?>usuarios" class="m-menu__link m-menu__toggle"> <!--esonder la rayita de enlace  -->
                                <i class="m-menu__link-icon fas fa-user-plus"></i>  <!--Logotipo izquierdo -->
                                <span class="m-menu__link-text"> <!--Color para la palabra -->
                                  Administrador de usuarios                                </span>
                                <i class="m-menu__ver-arrow la "></i> <!-- flecha derecha o izquierda -->
                              </a>
              </li>


              <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
                              <!--Elementos-->
                              <a href="<?php echo base_url(); ?>" class="m-menu__link m-menu__toggle"> <!--esonder la rayita de enlace  -->
                                <i class="m-menu__link-icon fas fa-clipboard-list"></i>  <!--Logotipo izquierdo -->
                                <span class="m-menu__link-text"> <!--Color para la palabra -->
                                  Asignador de tareas                                </span>
                                <i class="m-menu__ver-arrow la "></i> <!-- flecha derecha o izquierda -->
                              </a>
              </li>



              <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
                              <!--Elementos-->
                              <a href="<?php echo base_url(); ?>entidades" class="m-menu__link m-menu__togglee"> <!--esonder la rayita de enlace  -->
                                <i class="m-menu__link-icon fas fa-handshake-o"></i>  <!--Logotipo izquierdo -->
                                <span class="m-menu__link-text"> <!--Color para la palabra -->
                                  Administrador de Entidades                                </span>
                                <i class="m-menu__ver-arrow la "></i> <!-- flecha derecha o izquierda -->
                              </a>
              </li>

                <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true" m-menu-submenu-toggle="hover">
                    <!--Elementos-->
                    <a href="<?php echo base_url(); ?>reportes/dashboard" class="m-menu__link m-menu__toggle"> <!--esonder la rayita de enlace  -->
                        <i class="m-menu__link-icon fas fa-area-chart"></i>  <!--Logotipo izquierdo -->
                        <span class="m-menu__link-text">Reportes </span>
                        <i class="m-menu__ver-arrow la la-angle-right"></i> <!-- flecha derecha o izquierda -->
                    </a>

                    <div class="m-menu__submenu " m-hidden-height="160" style="display: none; overflow: hidden;">
                        <span class="m-menu__arrow"></span>
                        <ul class="m-menu__subnav">
                            <li class="m-menu__item " aria-haspopup="true"><a href="<?php echo base_url(); ?>reportes/estructura_despacho" class="m-menu__link ">
                                    <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Estructura del despacho</span></a>
                            </li>
                            <li class="m-menu__item " aria-haspopup="true"><a href="<?php echo base_url(); ?>reportes/prestaciones" class="m-menu__link ">
                                    <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Prestaciones</span></a>
                            </li>
                            <li class="m-menu__item " aria-haspopup="true"><a href="<?php echo base_url(); ?>reportes/compensaciones_prestaciones" class="m-menu__link ">
                                    <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Compensaciones y Prestaciones</span></a>
                            </li>


                            <li class="m-menu__item " aria-haspopup="true"><a href="<?php echo base_url(); ?>reportes/seguros_jubilacion" class="m-menu__link ">
                                    <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Seguros y Jubilación</span></a>
                            </li>

                            <li class="m-menu__item " aria-haspopup="true"><a href="<?php echo base_url(); ?>reportes/bonos_incentivos" class="m-menu__link ">
                                    <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Bonos e Incentivos</span></a>
                            </li>
                            <li class="m-menu__item " aria-haspopup="true"><a href="<?php echo base_url(); ?>reportes/tarifas_productividad" class="m-menu__link ">
                                    <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Tarifas y Productividad</span></a>
                            </li>

                            <li class="m-menu__item " aria-haspopup="true"><a href="<?php echo base_url(); ?>reportes/ti" class="m-menu__link ">
                                    <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Ti</span></a>
                            </li>
                            <li class="m-menu__item " aria-haspopup="true"><a href="<?php echo base_url(); ?>reportes/mercadotecnia" class="m-menu__link ">
                                    <i class="m-menu__link-bullet m-menu__link-bullet--dot"><span></span></i><span class="m-menu__link-text">Merca y Promocion</span></a>
                            </li>





                        </ul>
                    </div>
                </li>












                <?php if  (isset($menues[0])) { ?>

                <!--grupo-->
                <li class="m-menu__section">
                    <h4 class="m-menu__section-text">
                      <?php   echo 'Categorías';  ?>
                    </h4>
                    <i class="m-menu__section-icon flaticon-more-v3"></i> <!-- no se usa creo -->
                </li>



                      <?php foreach($menues as $key2=>$elem) { ?>
                      <!--Elementos-->
                      <li class="m-menu__item  m-menu__item--submenu" aria-haspopup="true"  m-menu-submenu-toggle="hover">
                          
                          
                              <!--Elementos-->
                              <a  href="<?php echo (trim($elem->url_principal)!='') ? base_url().$elem->url_principal : '#';  ?>" class="m-menu__link m-menu__toggle"> <!--esonder la rayita de enlace  -->
                                <i class="m-menu__link-icon fas <?php  echo $elem->icono; ?>"></i>  <!--Logotipo izquierdo -->
                                <span class="m-menu__link-text"> <!--Color para la palabra -->
                                  <?php   echo $elem->principal;  ?>
                                </span>
                                <i class="m-menu__ver-arrow la <?php  echo  (($elem->id_hijos) ? 'la-angle-right' : '' ); ?>"></i> <!-- flecha derecha o izquierda -->
                              </a>

                             <?php 
                               $hijos = explode('|', $elem->hijos);
                               $url_hijos = explode('|', $elem->url_hijos);
                               $id_hijos = explode('|', $elem->id_hijos);
                             ?>
                           

                           <?php if  (isset($hijos)) { ?>
                                  <?php foreach($hijos as $key3=>$subElemento) { ?>
                                      <!--detalles
                                      <div class="m-menu__submenu ">
                                          <span class="m-menu__arrow"></span>
                                          <ul class="m-menu__subnav">
                                              <li class="m-menu__item " aria-haspopup="true" >
                                                  <a  href="<?php echo (trim($url_hijos[$key3])!='') ? base_url().$elem->url_principal.'/'.$url_hijos[$key3].'/'.base64_encode($id_hijos[$key3]).'/'.base64_encode($key3).'/'.base64_encode(0) : '#';  ?>" class="m-menu__link ">
                                                      
                                                      <i class="m-menu__link-bullet m-menu__link-bullet--dot">
                                                          <span></span>
                                                      </i>
                                                      <span class="m-menu__link-text">
                                                           <?php   echo $subElemento;  ?>
                                                      </span>
                                                  </a>
                                              </li>
                                          </ul>
                                      </div> -->
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
