<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); 

?>
<?php $this->load->view( 'header' ); ?>
<?php $this->load->view( 'aside-menu.php' ); ?>



<input type="hidden" name="id_seleccion"  id="id_seleccion" value="<?php echo $id_seleccion; ?>" >

  <div class="m-grid__item m-grid__item--fluid m-wrapper">
    
<?php $this->load->view( 'sub_header.php' ); ?>
    
    <div class="m-content contenido-socios">
      <div class="container-fluid">
        <div class="row">
          <div class="col-md-12 col-lg-12 col-xl-12">
            <p>Seleccione uno o más niveles por campo de acuerdo a su información y posteriormente ingrese la información requerida.</p>
          </div>
        </div>

      </div>
      <div class="container-fluid">
        <!--menu-socios-->
        <div class="row menu-socios">
          
           <?php if ( ($subcategorias)  ) { 
              $titulo='';
            ?>
                <?php foreach ($subcategorias as $key => $value) { ?>
                      <?php 
                          $titulo= ($value->id_hijo==$id_hijo) ? $value->hijo : $titulo;

                      ?>

                      <a 
                      href="/kerma/<?php echo $value->url_principal.'/'.$value->url_hijo.'/'.base64_encode($value->id_hijo).'/'.base64_encode($key).'/'.base64_encode(0).'/'.base64_encode(0); ?>" 
                      class="col-3 m-socios btn btn-block <?php echo ($value->id_hijo==$id_hijo) ? 'm-socios-activo' : ''; ?>" 

                      id_principal="<?php echo $value->id_principal; ?>" 
                      url_principal="<?php echo $value->url_principal; ?>" 
                      url_hijo="<?php echo $value->url_hijo; ?>" 
                      id_hijo="<?php echo $value->id_hijo; ?>" 
                      num_hijo="<?php echo $key; ?>" 

                      >

                        <div class="row">
                          <div class="col-10">
                            <h5><?php echo $value->hijo; ?></h5>
                            <p>Sin registros</p>

                             <?php 
                               $grupos = explode('|', $value->grupos);
                               $grupos_id = explode('|', $value->grupos_id);
                               $places= str_replace("`", '"', $value->sub_seleccion);
                             ?>

                              <select <?php echo ($value->id_hijo==$id_hijo) ? '' : 'disabled'; ?>  class="selectpicker administrativos" id="propietarios" multiple title="Seleccionar..." data-style="btn-info" data-actions-box="true">
                                <?php foreach ($grupos as $key2 => $value2) { 

                                        $selec='';
                                        if ( json_decode($places) )
                                        foreach (json_decode($places) as $key4 => $value4) { 
                                            if ($grupos_id[$key2] ==$value4->id_grupo_capital_humano) {
                                                $selec.= '<option   data-valor="'.$grupos_id[$key2].'"  tipo="D" value="'.$value4->nombre.'"  >'.$value4->nombre.'</option>';
                                            }
                                        }  

                                       if  (($grupos_id[$key2])) { 
                                          if ($selec!='') {
                                            echo '<optgroup  tipo="G" valor="'.$grupos_id[$key2].'" label="'.$value2.'">';
                                          } else {
                                             echo '<option '.(   (in_array($grupos_id[$key2], $arreglo)) ? "selected" : ""   ).'  data-valor="'.$grupos_id[$key2].'" tipo="G" value="'.$value2.'" valor="'.$grupos_id[$key2].'" valor="'.$key2.'">'. $value2.'</option>';

                                          }
                                             
                                       }

                                       echo $selec; 

                                        if  ($grupos_id[$key2]) { 
                                             echo '</optgroup>';
                                        } 

                               }  
                               ?>             
                                  <!--<option data-divider="true"></option> -->

                              </select>  




                          </div>


                          
                          <div class="col-2">
                            <i class="far <?php echo ($value->id_hijo==$id_hijo) ? 'fa-check-circle paloma-activo' : ''; ?>"></i>
                          </div>

                        </div>
                      </a>

                             <?php 
                               if ($value->id_hijo==$id_hijo) {
                                  $encabezados = explode('|', $value->encabezados);
                                  $ident_encabezado = explode('|', $value->id_encabezado);
                               }
                             ?>

                <?php }  ?>             
            <?php }  ?>   

        </div>
        <!--FIN menu socios-->





          <!--estructura, sueldo, politica, general, etc-->
          <div class="contenido_secciones">
              <div class="row menu2-socios-activo">
                          
                             <?php  if  ($encabezados)  ?>
                              <?php foreach ($encabezados as $key3 => $value3) { ?>
                                  <div class="col-3 item-m2-socios">
                                        <a 
                                        href="/kerma/<?php echo $url_principal.'/'.$url_hijo.'/'.base64_encode($id_hijo).'/'.base64_encode($num_hijo).'/'.base64_encode($ident_encabezado[$key3]).'/'.base64_encode($id_seleccion); ?>" 
                                        type="button" 
                                        class="btn btn-block <?php echo ($id_encabezado==$ident_encabezado[$key3]) ? 'encabezado-activo' : ''; ?>"

                                        id_encabezado="<?php echo $ident_encabezado[$key3] ; ?>" 
                                        num_encabezado="<?php echo $key3 ; ?>" >


                                          <?php echo $value3; ?>
                                        <i class="far <?php echo ($id_encabezado==$ident_encabezado[$key3]) ? 'fa-check-circle paloma-activo' : ''; ?>" id="despacho_paloma"></i>
                                        </a>
                                  </div>      
                              <?php }  ?>     
              </div>
          </div>



      </div> <!--CONTAINER-FLUID-->





        <div class="contenido_niveles">
            <div class="contenido_preguntas">
                <div class="row contenido-edd">
                    <div class="col-3 niveles">
                        <hr>
                        <h5><?php echo $titulo; ?> ...</h5>
                        <hr>


                        <!--Aqui es donde se va a poner los detalles -->
                        <div class="niveles_detalles">

                        </div>



                        
                    </div>
                    <div class="col-9 preguntas">
                        <div class="row">
                            <div class="col-8">
                                <!-- <p style="color:#af204e; font-weight:bold">Some title ...</p> -->
                                <h3 style="margin-top:-10px">Nivel A</h3>
                            </div>
                            <div class="col-4 ">
                                <div class="row">
                                    <button class="btn-replicar-info" type="button" name="button">Replicar informarción</button>
                                    <button class="btn-replicar-info-tip" type="button" data-toggle="tooltip" data-placement="bottom" title="Tooltip on bottom">

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
                       

                                  <?php if ( ($value->id_tipo_pregunta==4) || ($value->id_tipo_pregunta==5) ) { // 4-simple, 5-multiples?>

                                      <!-- SI/NO -->                                      
                                      
                                              <?php 
                                                 $valores = explode('|', $value->valores);
                                                 $valores_id = explode('|', $value->valores_id);
                                                 $simple_multiple = ($value->id_tipo_pregunta==5) ? ' multiple data-style="btn-info" data-actions-box="true" ': ' ';  
                                               ?> 



                                            <select id="<?php echo trim($value->campo); ?>" name="<?php echo $value->campo; ?>"
                                                                                        class="selectpicker form-control" <?php echo $simple_multiple; ?> >
                                                   <?php if ( ($valores[0])  ) { ?>
                                                          <?php foreach ($valores as $key2 => $value2) { ?>
                                                              <option value="<?php echo $valores_id[$key2]; ?>" orden="<?php echo $key2; ?>" ><?php echo $value2; ?></option>
                                                          <?php } ?>
                                                  <?php } ?>
                                            </select>
                                            <!-- <span style="color:blue; font-size:10px;"><?php //echo $value->tipo_pregunta; ?></span> -->
                                            <span style="color:transparent;font-size:10px;"><?php echo $value->descripcion_valores_predefinidos; ?></span>
                                      


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
        </div>



            <!--btn siguiente-->
           
                        <div class="row">
                            <div style="text-align:right" class="col-7">

                            </div>
                            <div style="text-align:center" class="col-3">
                                <button  class="btn-siguiente"  id="button_sig" name="button_sig">Siguiente</button>
                            </div>
                            <div class="col-2">

                            </div>
                        </div>

            <!--FIN btn siguiente-->





        <!-- <div class="contenido_niveles"></div> -->

    </div><!--FIN m-content-->
  </div> <!--FIN m-grid-->
</div>
<!-- end:: m-body -->
<?php $this->load->view( 'footer.php' ); ?>



     