<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');  ?>

<?php $periodo =4; ?>
 
 <div class="m-grid__item m-grid__item--fluid m-wrapper">
    <!-- BEGIN: Subheader categorias -->
    <div class="m-subheader div-status">
      <div class="d-flex align-items-center">
        <div class="mr-auto">
          <h3 class="m-subheader__title "><?php echo $subcategorias[0]->principal; ?></h3> 
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
          <h4>Subcategorías</h4>
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

   


            <div class="col-md-2 col-lg-2 col-xl-2">
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


      </div>