                                  <?php if ($value->id_tipo_pregunta==5) { // Seleccion?>

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


