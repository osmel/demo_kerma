<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>


<!-- BEGIN SIDEBAR -->
<div class="page-sidebar-wrapper">
    <div class="page-sidebar navbar-collapse collapse">
            <ul class="page-sidebar-menu  page-header-fixed " data-keep-expanded="false" data-auto-scroll="true" data-slide-speed="200" style="padding-top: 20px">
                <li class="sidebar-toggler-wrapper hide">
                    <div class="sidebar-toggler">
                        <span></span>
                    </div>
                </li>
                
             <!-- Fin Caracteristicas -->     
            <?php //if ($id_perfil==1) { ?>    
            <?php //if (($id_perfil==1) || ($id_perfil==2) || ($id_perfil==3) ) { ?>   
            <?php if ( ( $this->session->userdata( 'id_perfil' ) == 1  ) || (in_array(2, $coleccion_id_operaciones)) ) { ?>    
                <!-- encabezado Caracteristicas -->        
                <li class="heading">
                        <h3 class="uppercase">Proyectos</h3>
                    </li>

                
                    
                    <li class="nav-item  ">
                        <a href="<?php echo base_url(); ?>crear_proyecto" class="nav-link nav-toggle">
                            <i class="fa fa-building"></i>
                            <span class="title">Crear</span>
                            <span class="badge badge-danger"><i class="fa fa-plus"></i></span>
                        </a>
                    </li>

                    


                <li class="sidebar-search-wrapper">
                    <div class="sidebar-search" >
                        <div class="input-group">
                            <!-- <input type="text" id="typeahead_example_31" name="typeahead_example_3" class="form-control" /> -->

                            <input  type="text" name="editando_proyectos" idusuario="1" class="form-control buscar_elemento ttip" title="Campo predictivo. Escriba y seleccione el nombre de un proyecto." autocomplete="off" spellcheck="false" placeholder="Buscar Proyecto...">

                            <span class="input-group-btn">
                                <a class="btn submit">
                                    <i class="icon-magnifier"></i>
                                </a>
                            </span>
                        </div>
                    </div>
                    
                </li>        


                    <div  class="scrollers proyectos">
                      
                                <?php if ($proyectos) { ?>
                                    <?php foreach ($proyectos as $proyecto) { ?>
                                        <li nombre="<?php echo base64_encode($proyecto->proyecto); ?>" 
                                     identificador="<?php echo base64_encode($proyecto->id); ?>" 

                                     class="nav-item context <?php echo ($proyecto->id); ?>"  data-toggle="context" data-target="#context-menu">
                                            <a href="<?php echo base_url(); ?>editar_proyecto/<?php echo base64_encode($proyecto->id); ?>" class="nav-link ">
                                                    
                                                    

                                                <i class="fa fa-<?php echo ($proyecto->dueno_real==1) ? 'unlock' : 'unlock-alt' ?>"></i>
                                                <span class="title"><?php echo $proyecto->proyecto; ?></span>
                                                <span class="badge badge-success">6</span>
                                            </a>
                                        </li>
                                    <?php } ?>    
                                <?php } ?>     
                      
                       <!--menu contextual-->
                                <div id="context-menu" style="position: absolute; z-index: 9999; top: 423px; left: 350px;" class="">
                                    <ul class="dropdown-menu" role="menu">
                                       <li><a tabindex="-1" href="">Modificar</a></li>
                                       <li class="divider"></li>
                                       <li><a tabindex="-1" href="">Eliminar</a></li>
                                    </ul>
                                </div>  


                    </div>    
                


            <?php } ?>     
                
                
              



            <!-- encabezado Reportes --> 

            <?php if ( ( $this->session->userdata( 'id_perfil' ) == 1  ) || (in_array(5, $coleccion_id_operaciones)) ) { ?>    
                    <li class="heading">
                        <h3 class="uppercase">Reportes</h3>
                    </li>

                    <li class="nav-item  ">
                        <a href="<?php echo base_url(); ?>general" class="nav-link nav-toggle">
                            <i class="fa fa-archive"></i>
                            <span class="title">General</span>
                            <span class="badge"><i class="fa fa-print"></i></span>
                            
                        </a>
                    </li>          
            <?php } ?>   

                      

               
             <!-- encabezado Catalogos --> 

            <?php if ( ( $this->session->userdata( 'id_perfil' ) == 1  ) || (in_array(4, $coleccion_id_operaciones)) ) { ?>    
                    <li class="heading">
                        <h3 class="uppercase">Catálogos</h3>
                    </li>

                    <li class="nav-item  ">
                        <a href="<?php echo base_url(); ?>areas" class="nav-link nav-toggle">
                            <i class="fa fa-archive"></i>
                            <span class="title">Áreas</span>
                            <span class="badge"><i class="fa fa-eye"></i></span>
                            
                        </a>
                    </li>                                    
            <?php } ?>            





            </ul>
            <!-- END SIDEBAR MENU -->
        <!-- END SIDEBAR MENU -->
    </div>
    <!-- END SIDEBAR -->
</div>
<!-- END SIDEBAR -->