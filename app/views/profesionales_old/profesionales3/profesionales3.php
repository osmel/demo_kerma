<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $this->load->view( 'header' ); ?>
<?php $this->load->view( 'aside-menu.php' ); ?>

  <div class="m-grid__item m-grid__item--fluid m-wrapper">
    <!-- BEGIN: Subheader -->
    <div class="m-subheader div-status">
      <div class="d-flex align-items-center">
        <div class="mr-auto">
          <h3 class="m-subheader__title ">Profesionales</h3>
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
        <div class="col-md-8 col-lg-8 col-xl-8">
          <h4>Subcategorías</h4>
        </div>
        <div class="col-md-2 col-lg-2 col-xl-2">
          <p>Año:</p>
          <div class="dropdown drop-socios">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Seleccionar
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
              <button class="dropdown-item" type="button">Action</button>
              <button class="dropdown-item" type="button">Another action</button>
              <button class="dropdown-item" type="button">Something else here</button>
            </div>
          </div>
        </div>
        <div class="col-md-2 col-lg-2 col-xl-2">
          <p>Período:</p>
          <div class="dropdown drop-socios">
            <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
              Seleccionar
            </button>
            <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
              <button class="dropdown-item" type="button">Action</button>
              <button class="dropdown-item" type="button">Another action</button>
              <button class="dropdown-item" type="button">Something else here</button>
            </div>
          </div>
        </div>
      </div>

      <!--Primer fila-->
      <div class="fila row">
        <!--Cuadro socios-->
        <div class="col-md-12 col-lg-6 col-xl-4">
          <div class="contenido-cat m-widget24">
            <div class="m-widget24__item">
              <div class="row">
                <div style="text-align:left !important" class="col-9 info-cat">
                  <h5>Socios</h5>
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
                  <button class="completo-btn" type="button" name="button">Editar</button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--FIN Cuadro socios-->

        <!--Cuadro abogados tarifa-->
        <div class="col-md-12 col-lg-6 col-xl-4">
          <div class="contenido-cat m-widget24">
            <div class="m-widget24__item">
              <div class="row">
                <div style="text-align:left !important" class="col-9 info-cat">
                  <h5>Abogados Tarifa</h5>
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
                  <button class="completo-btn" type="button" name="button">Editar</button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--FIN Cuadro abogados tarifa-->

        <!--Cuadro abogados años de exp.-->
        <div class="col-md-12 col-lg-6 col-xl-4">
          <div class="contenido-cat m-widget24">
            <div class="m-widget24__item">
              <div class="row">
                <div style="text-align:left !important" class="col-9 info-cat">
                  <h5>Abogados años de exp.</h5>
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
                  <button class="completo-btn" type="button" name="button">Editar</button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--FIN Cuadro abogados años de exp.-->

      </div>
      <!--FIN Primer fila-->


      <!--Segunda fila-->
      <div class="fila row">
        <!--Cuadro profesionales no abogados-->
        <div class="col-md-12 col-lg-6 col-xl-4">
          <div class="contenido-cat m-widget24">
            <div class="m-widget24__item">
              <div class="row">
                <div style="text-align:left !important" class="col-9 info-cat">
                  <h5>Profesionales No Abogados</h5>
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
                  <button class="completo-btn" type="button" name="button">Editar</button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--FIN Cuadro profesionales no abogados-->

        <!--Cuadro pasantes-->
        <div class="col-md-12 col-lg-6 col-xl-4">
          <div class="contenido-cat m-widget24">
            <div class="m-widget24__item">
              <div class="row">
                <div style="text-align:left !important" class="col-9 info-cat">
                  <h5>Pasantes</h5>
                </div>
                <div class="col-3 info-cat">
                  <h4>0%</h4>
                </div>
              </div>
              <div style="margin-top:20px !important" class="progress m-progress--sm">
                <div class=" progress-bar m--bg-brand" role="progressbar" style="width: 0%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
              </div>
              <hr>
              <div class="botones-cat row">
                <div class="col-12">
                  <button class="completo-btn" type="button" name="button">Editar</button>
                </div>
              </div>
            </div>
          </div>
        </div>
        <!--FIN Cuadro pasantes-->

      </div>
      <!--FIN Segunda fila-->


    </div><!--FIN m-content-->
  </div> <!--FIN m-grid-->
</div>
<!-- end:: m-body -->
<?php $this->load->view('footer'); ?>
