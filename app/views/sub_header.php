<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');  ?>
  <!-- BEGIN: Subheader -->
  <?php $periodo =4; ?>

    <div class="div-socios">
      <div class="container-fluid">
        <div class="row">
          <div class="mr-auto col-3">
            <h5 class="m-subheader__title font-size:10px;"><?php echo $subcategorias[0]->principal; ?></h5>
            <h3 class="m-subheader__title "><?php echo $url_hijo; ?></h3>
          </div>


          <div class="col-4">
                <p class="año">Entidades:</p>
                <div class="dropdown drop-socios">
              <?php 
                echo '
                     <select class="selectpicker entidad" title="Seleccionar..." data-style="btn-info" data-actions-box="true" name="id_entidad" id="id_entidad">';
                         if ( $entidades  ) { 
                             foreach ($entidades as $key => $value) { 
                                    echo '<option class="dropdown-item" selected type="button" valor="'.$key.'">'.$value->nombre.'</option>';
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
                     <select class="selectpicker ano" title="Seleccionar..." data-style="btn-info" data-actions-box="true" name="id_ano" id="id_ano">';
                      for ($i = $ano-3; $i <= $ano; $i++) {
                        echo '<option class="dropdown-item" selected type="button" valor="'.$i.'">'.$i.'</option>';
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
                     <select class="selectpicker periodo" title="Seleccionar..." data-style="btn-info" data-actions-box="true" name="id_ano" id="id_ano">';
                      for ($i = 1; $i <= $periodo; $i++) {
                        echo '<option class="dropdown-item" selected type="button" valor="'.$i.'">'.$i.'</option>';
                      } 
                    echo '</select>';
                  ?>
              </div>
            </div>
            <div style="padding-right: 100px" class="porcentaje col-5">
              <div class="row">
                <div class="col-6">
                  <!-- <h3 style="color: #313f45 !important" class="m-subheader__title">1/3</h3> -->
                </div>
                <div class="col-6">
                  <h3 style="text-align: right !important" class="m-subheader__title">0%</h3>
                </div>
              </div>
              <div class="progress m-progress--sm">
                <div class="progress-bar m--bg-brand" role="progressbar" style="width: 33%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
            </div>
          </div>

        </div>
      </div>

    <!-- END: Subheader -->