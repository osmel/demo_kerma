
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $this->load->view( 'header' ); ?>
<?php $this->load->view( 'aside-menu.php' ); ?>

 <?php $this->load->view( 'sub_header_detalles' ); ?>

      <!--Primer fila-->
      
        
      
<div class="contenido_preguntas">
    <div class="row contenido-edd">
        <div class="col-3 niveles">
        
        </div>
        <div class="col-9 preguntas">
            <div class="row">
                <div class="col-8">
                    <p style="color:#af204e; font-weight:boldfont-size:10px;"><?php echo $sub_pregunta[0]->encabezado; ?></p>
                    <!--<h3 style="margin-top:-10px">Nivel A</h3> -->
                </div>
                <div class="col-4 ">
                    <div class="row">
                        <button class="btn-replicar-info" type="button" name="button">Replicar informarción</button>
                        <button class="btn-replicar-info-tip" type="button" data-toggle="tooltip" data-placement="bottom" title="Tooltip on bottom">
                            ?
                        </button>
                    </div>

                </div>
            </div>
            <hr>
            <!--pregunta 1-->
            <?php foreach ($sub_pregunta as $key => $value) { ?>
                <div class="row">
                    <div style="text-align:right" class="col-7">
                        <p><?php echo $value->id_numeracion_pregunta.'. '.$value->pregunta.'. '.$value->id_preg; ?></p>
                    </div>
                    
                    <div style="text-align:center" class="col-3">
                       

                                  <?php if ($value->id_tipo_pregunta==4) { // Seleccion?>

                                      <!-- SI/NO -->                                      
                                      <?php if ($value->id_tipo_valores_predefinidos==8) { //Seleccion Booleana ?>
                                              <?php 
                                                 $valores = explode('|', $value->valores);
                                                 $valores_id = explode('|', $value->valores_id);
                                               ?>

                                            <select name="c1"  class="form-control">
                                                   <?php if ( ($valores[0])  ) { ?>
                                                          <?php foreach ($valores as $key2 => $value2) { ?>
                                                              <option value="<?php echo $valores_id[$key2]; ?>" orden="<?php echo $key2; ?>" ><?php echo $value2; ?></option>
                                                          <?php } ?>
                                                  <?php } ?>
                                            </select>
                                            <!-- <span style="color:blue; font-size:10px;"><?php //echo $value->tipo_pregunta; ?></span> -->
                                            <span style="color:transparent;font-size:10px;"><?php echo $value->descripcion_valores_predefinidos; ?></span>
                                      <?php }  ?>

                                      <!-- MULTIPLES -->                                      
                                      <?php if ($value->id_tipo_valores_predefinidos<>8) { // <>8 11=Día festivo "multiples" ?>
                                              <?php 
                                                 $valores = explode('|', $value->valores);
                                                 $valores_id = explode('|', $value->valores_id);
                                               ?>

                                            <select class="selectpicker  multiples_c1" multiple title="Seleccionar..." data-style="btn-info" data-actions-box="true" >  

                                                   <?php if ( ($valores[0])  ) { ?>
                                                          <?php foreach ($valores as $key2 => $value2) { ?>
                                                              <option value="<?php echo $valores_id[$key2]; ?>" orden="<?php echo $key2; ?>" ><?php echo $value2; ?></option>
                                                          <?php } ?>
                                                  <?php } ?>
                                            </select>
                                            <span style="color:transparent;font-size:10px;"><?php echo $value->tipo_pregunta; ?></span>
                                            <span style="color:transparent;font-size:10px;"><?php echo $value->descripcion_valores_predefinidos; ?></span>

                                      <?php }  ?>



                                   <?php } ?>


                                   <?php if ($value->id_tipo_pregunta==1) { // input cadena?>
                                            <input type="text" name="c1" value="" placeholder="<?php echo $value->placeholder; ?>"> 
                                            <!-- <span style="color:red;font-size:10px;"><?php //echo $value->tipo_pregunta; ?></span> -->
                                   <?php } ?>


                                   <?php if ($value->id_tipo_pregunta==2) { // input cantidad entera?>
                                            <input type="text" name="c1" value="" placeholder="<?php echo $value->placeholder; ?>"> 
                                            <!-- <span style="color:red;font-size:10px;"><?php //echo $value->tipo_pregunta; ?></span> -->
                                   <?php } ?>

                                   <?php if ($value->id_tipo_pregunta==6) { // input Cantidad Decimal?>
                                        
                                            <input type="text" name="c1" value="" placeholder="<?php echo $value->placeholder; ?>"> 
                                            <!-- <span style="color:red;font-size:10px;"><?php //echo $value->tipo_pregunta; ?></span> -->
                                        
                                   <?php } ?>


                                   


                    </div>


                    <div class="col-2">
                    </div>
                </div>

            <?php } ?>
            <!--FIN pregunta 1-->
           
            <!--FIN btn siguiente-->

        </div> <!--FIN preguntas-->
    </div>
</div>

























         
      <!--FIN Primer fila-->


     

      </div>
      <!--FIN Segunda fila-->


    </div><!--FIN m-content-->
  </div> <!--FIN m-grid-->
</div>
<!-- end:: m-body -->
<?php $this->load->view('footer'); ?>









