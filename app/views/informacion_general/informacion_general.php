
<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $this->load->view( 'header' ); ?>
<?php $this->load->view( 'aside-menu.php' ); ?>

  <?php $this->load->view( 'sub_header_categorias' ); ?>  

      <!--Primer fila-->
      
        
      
          <div class="fila row">
                <?php foreach ($subcategorias as $key => $value) { ?>
                      <!--Cuadro socios-->
                      <div class="col-md-12 col-lg-6 col-xl-4">
                        <div class="contenido-cat m-widget24">
                          <div class="m-widget24__item">
                            <div class="row">
                              <div style="text-align:left !important" class="col-9 info-cat">
                                <h5><?php echo $value->nombre; ?></h5>
                              </div>
                              <div class="col-3 info-cat">
                                <h4>0%</h4>
                              </div>
                            </div>
                            <div style="margin-top:20px !important" class="progress m-progress--sm">
                              <div class="completo-bar progress-bar m--bg-brand" role="progressbar" style="width: 0%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
                            </div>
                            <hr>
                            <div class="botones-cat row">
                              <div class="col-12">
                                
                                <a href="/kerma/<?php echo $value->url_principal.'/'.$value->url_hijo.'/'.base64_encode($value->id_encabezado); ?>" class="blanco-btn btn btn-block"> Editar</a>
                                
                              </div>
                            </div>
                          </div>
                        </div>
                      </div>
                      <!--FIN Cuadro socios-->

                <?php } ?>
      </div>
      <!--FIN Primer fila-->


     

      </div>
      <!--FIN Segunda fila-->


    </div><!--FIN m-content-->
  </div> <!--FIN m-grid-->
</div>
<!-- end:: m-body -->
<?php $this->load->view('footer'); ?>
