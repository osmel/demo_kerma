<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');  ?>
  <!-- BEGIN: Subheader -->
  <?php $periodo =4; ?>

 <div class="m-grid__item m-grid__item--fluid m-wrapper">
    <!-- BEGIN: Subheader -->
    <div class="m-subheader div-status">
      <div class="d-flex align-items-center">
        <div class="mr-auto"> 
          <h3 class="m-subheader__title font-size:10px;"><?php echo $subcategorias[0]->principal; ?></h3>

          <?php 
             $grupos = explode('|', $sub_pregunta[0]->grupos);
             $grupos_id = explode('|', $sub_pregunta[0]->grupos_id);
             //print_r($grupos[0] );die;
             //print_r($grupos[0] );die;
           ?>

           <div class="row">
           
            <?php if ( ($grupos[0])  ) { ?>
                <?php foreach ($grupos as $key => $value) { ?>
                        
                        <div class="item-m2-socios item-m2-socios">
                          <a href="/kerma/<?php echo $sub_pregunta[0]->url_principal.'/'.$sub_pregunta[0]->url_hijo.'/'.base64_encode($sub_pregunta[0]->id_encabezado).'/'.base64_encode($key);?>" valor="<?php echo $grupos_id[$key] ; ?>" type="button" class="btn btn-blockfont-size:10px;"><?php echo $value; ?></a>
                        </div>


                <?php }  ?>             
            <?php }  ?>             
           </div>  

        </div>
        <div class="porcentaje">
          <h3 class="m-subheader__title">0%</h3>
        </div>
      </div>
      <div class="progress m-progress--sm">
        <div class="progress-bar m--bg-brand" role="progressbar" style="width: 0%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
      </div>
    </div>
    <!-- END: Subheader -->


    <div class="m-content">

      <div class="row titulo-contenido">
        <div class="col-md-4 col-lg-4 col-xl-4">
          <h4><?php echo $grupos[$id_seccion]; ?></h4>
        </div>

        
           <div class="col-4">
                <p class="año">Entidades:</p>
                <div class="dropdown drop-socios">
              <?php 
                echo '
                     <select class="selectpicker entidad" title="Seleccionar..." data-style="btn-info" data-actions-box="true" name="id_entidad_encabezado" id="id_entidad_encabezado" >';
                         if ( $entidades  ) { 
                             foreach ($entidades as $key => $value) { 
                                    echo '<option class="dropdown-item" selected type="button" value="'.$value->id.'" valor="'.$key.'">'.$value->nombre.'</option>';
                             }  
                         }  
                echo '</select>';
                ?> 
                </div>
          </div>  
          
        <div class="col-2">
              <p class="año">Año:</p>
              <div class="dropdown drop-socios">
                  <?php 
                    $ano = date('Y');
                    echo '
                     <select class="selectpicker ano" title="Seleccionar..." data-style="btn-info" data-actions-box="true" name="id_ano_encabezado" id="id_ano_encabezado">';
                      for ($i = $ano-3; $i <= $ano; $i++) {
                        echo '<option class="dropdown-item" selected type="button" value="'.$i.'" valor="'.$i.'">'.$i.'</option>';
                      } 
                    echo '</select>';
                  ?>

              </div>
        </div>

        <div class="col-2">
              <p class="periodo">Período:</p>
              <div class="dropdown drop-socios">
                <?php 
                    $ano = date('Y');
                    echo '
                     <select class="selectpicker periodo" title="Seleccionar..." data-style="btn-info" data-actions-box="true" name="id_periodo_encabezado" id="id_periodo_encabezado">';
                      for ($i = 1; $i <= $periodo; $i++) {
                        echo '<option class="dropdown-item" selected type="button" value="'.$i.'" valor="'.$i.'">'.$i.'</option>';
                      } 
                    echo '</select>';
                  ?>
        </div>
            </div>


      </div>