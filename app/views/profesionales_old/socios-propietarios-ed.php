<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $this->load->view( 'header' ); ?>
<?php $this->load->view( 'aside-menu.php' ); ?>

<div class="m-grid__item m-grid__item--fluid m-wrapper">
    <!-- BEGIN: Subheader -->
    <div class="div-socios">
      <div class="container-fluid">
        <div class="row">
          <div class="mr-auto col-3">
            <h5>Profesionales</h5>
            <h3 class="m-subheader__title ">Socios</h3>
          </div>
            <div class="col-2">
              <p class="año">Año:</p>
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
            <div class="col-2">
              <p class="periodo">Período:</p>
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
          <div class="col-3 m-socios m-socios-activo">
            <h5>Propietarios</h5>
            <p>Sin registros</p>
            <div class="dropdown drop-socios">
              <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Nivel A, Nivel B
              </button>
              <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                <button class="dropdown-item" type="button">Nivel A</button>
                <button class="dropdown-item" type="button">Nivel B</button>
                <button class="dropdown-item" type="button">Nivel C</button>
              </div>
            </div>
          </div>
          <div class="col-3 m-socios">
            <h5>No Propietarios</h5>
            <p>Sin registros</p>
            <div class="dropdown drop-socios">
              <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Seleccionar
              </button>
              <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                <button class="dropdown-item" type="button">Nivel A</button>
                <button class="dropdown-item" type="button">Nivel B</button>
                <button class="dropdown-item" type="button">Nivel C</button>
              </div>
            </div>
          </div>
          <div class="col-3 m-socios">
            <h5>Of Counsel</h5>
            <p>Sin registros</p>
            <div class="dropdown drop-socios">
              <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                Seleccionar
              </button>
              <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
                <button class="dropdown-item" type="button">Nivel A</button>
                <button class="dropdown-item" type="button">Nivel B</button>
                <button class="dropdown-item" type="button">Nivel C</button>
              </div>
            </div>
          </div>
        </div>
        <!--FIN menu socios-->
        <!--Menu2 socios-->
        <div class="row menu2-socios-activo">
          <div class="col-3 item-m2-socios item-m2-socios-activo">
            <h5>Estructura del despacho</h5>
          </div>
          <div class="col-3 item-m2-socios">
            <h5>Política de vacaciones</h5>
          </div>
        </div>
        <!--FIN Menu2 socios-->
        <div class="row contenido-edd">
          <div class="col-3 niveles">
            <hr>
            <h5>Propietarios</h5>
            <hr>
            <div class="nivel-activo">
              <p>Nivel A <span class="fas fa-caret-right flecha-nivel"></span></p>
            </div>
            <hr>
            <div class="nivel">
              <p>Nivel B</p>
            </div>
            <hr>
          </div>
          <div class="col-9 preguntas">
            <div class="row">
              <div class="col-8">
                <p style="color:#af204e; font-weight:bold">Estructura del despacho</p>
                <h3 style="margin-top:-10px">Nivel A</h3>
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
            <div class="row">
              <div style="text-align:right" class="col-7">
                <p>1. Número de Socios Propietarios de Nivel A hombres</p>
              </div>
              <div style="text-align:center" class="col-3">
                <input type="text" name="" value="" placeholder="#">
              </div>
              <div class="col-2">

              </div>
            </div>
            <!--FIN pregunta 1-->
            <!--pregunta 2-->
            <div class="row">
              <div style="text-align:right" class="col-7">
                <p>2. Número de Socios Propietarios de Nivel A mujeres</p>
              </div>
              <div style="text-align:center" class="col-3">
                <input type="text" name="" value="" placeholder="#">
              </div>
              <div class="col-2">

              </div>
            </div>
            <!--FIN pregunta 2-->
            <!--total socios-->
            <div class="row">
              <div style="text-align:right" class="col-7">
                <p>Total de Socios Nivel A</p>
              </div>
              <div style="text-align:center" class="col-3">
                <input type="text" name="" value="" placeholder="#">
              </div>
              <div class="col-2">

              </div>
            </div>
            <!--FIN total socios-->
            <!--% hombres-->
            <div class="row">
              <div style="text-align:right" class="col-7">
                <p>Porcentaje de hombres</p>
              </div>
              <div style="text-align:center" class="col-3">
                <input type="text" name="" value="" placeholder="#">
              </div>
              <div class="col-2">

              </div>
            </div>
            <!--FIN % hombres-->
            <!--% mujeres-->
            <div class="row">
              <div style="text-align:right" class="col-7">
                <p>Porcentaje de hombres</p>
              </div>
              <div style="text-align:center" class="col-3">
                <input type="text" name="" value="" placeholder="#">
              </div>
              <div class="col-2">

              </div>
            </div>
            <!--FIN % mujeres-->
            <hr>
            <!--pregunta 3-->
            <div class="row">
              <div style="text-align:right" class="col-7">
                <p>3. Tarifa base por hora publicada en dólares</p>
              </div>
              <div style="text-align:center" class="col-3">
                <input type="text" name="" value="" placeholder="#">
              </div>
              <div class="col-2">
                <div class="row">
                  <div class="">
                    <p>USD</p>
                  </div>
                  <div class="">
                    <button class="btn-replicar-info-tip" type="button" data-toggle="tooltip" data-placement="bottom" title="Tooltip on bottom">
                      ?
                    </button>
                  </div>
                </div>
              </div>
            </div>
            <!--FIN preguntas 3-->
            <!--pregunta 4-->
            <div class="row">
              <div style="text-align:right" class="col-7">
                <p>4. Tarifa base publicada en pesos</p>
              </div>
              <div style="text-align:center" class="col-3">
                <input type="text" name="" value="" placeholder="#">
              </div>
              <div class="col-2">
                <div class="row">
                  <div class="">
                    <p>MXN</p>
                  </div>
                  <div class="">
                    <button class="btn-replicar-info-tip" type="button" data-toggle="tooltip" data-placement="bottom" title="Tooltip on bottom">
                      ?
                    </button>
                  </div>
                </div>
              </div>
            </div>
            <!--FIN preguntas 4-->
            <!--pregunta 5-->
            <div class="row">
              <div style="text-align:right" class="col-7">
                <p>5. Objetivos anual de horas facturables</p>
              </div>
              <div style="text-align:center" class="col-3">
                <input type="text" name="" value="" placeholder="#">
              </div>
              <div class="col-2">

              </div>
            </div>
            <!--FIN preguntas 5-->
            <!--pregunta 6-->
            <div class="row">
              <div style="text-align:right" class="col-7">
                <p>6. Número de horas reportadas promedio al año</p>
              </div>
              <div style="text-align:center" class="col-3">
                <input type="text" name="" value="" placeholder="#">
              </div>
              <div class="col-2">

              </div>
            </div>
            <!--FIN preguntas 6-->
            <!--pregunta 7-->
            <div class="row">
              <div style="text-align:right" class="col-7">
                <p>7. Número de horas facturadas promedio al año</p>
              </div>
              <div style="text-align:center" class="col-3">
                <input type="text" name="" value="" placeholder="#">
              </div>
              <div class="col-2">

              </div>
            </div>
            <!--FIN preguntas 7-->
            <!--realización-->
            <div class="row">
              <div style="text-align:right" class="col-7">
                <p>Realización</p>
              </div>
              <div style="text-align:center" class="col-3">
                <input type="text" name="" value="" placeholder="#">
              </div>
              <div class="col-2">

              </div>
            </div>
            <!--FIN realización-->
            <!--productividad-->
            <div class="row">
              <div style="text-align:right" class="col-7">
                <p>Productividad</p>
              </div>
              <div style="text-align:center" class="col-3">
                <input type="text" name="" value="" placeholder="#">
              </div>
              <div class="col-2">

              </div>
            </div>
            <!--FIN productividad-->
            <hr>
            <!--pregunta 8-->
            <div class="row">
              <div style="text-align:right" class="col-7">
                <p>8. ¿Cuántos socios Propietarios de Nivel B había al principio del año?</p>
              </div>
              <div style="text-align:center" class="col-3">
                <input type="text" name="" value="" placeholder="#">
              </div>
              <div class="col-2">

              </div>
            </div>
            <!--FIN pregunta 8-->
            <!--pregunta 9-->
            <div class="row">
              <div style="text-align:right" class="col-7">
                <p>9. ¿Cuántos Socios Propietarios de Nivel B salieron en los últimos doce meses?</p>
              </div>
              <div style="text-align:center" class="col-3">
                <input type="text" name="" value="" placeholder="#">
              </div>
              <div class="col-2">

              </div>
            </div>
            <!--FIN pregunta 9-->
            <hr>
            <!--pregunta 10-->
            <div class="row">
              <div style="text-align:right" class="col-7">
                <p>10. ¿Cuántos Socios Propietarios de Nivel A entraron en los últimos doce meses?</p>
              </div>
              <div style="text-align:center" class="col-3">
                <input type="text" name="" value="" placeholder="#">
              </div>
              <div class="col-2">

              </div>
            </div>
            <!--FIN pregunta 10-->
            <!--pregunta 11-->
            <div class="row">
              <div style="text-align:right" class="col-7">
                <p>11. ¿Cuántos años de experiencia tienen en promedio a partir de la titulación?</p>
              </div>
              <div style="text-align:center" class="col-3">
                <input type="text" name="" value="" placeholder="#">
              </div>
              <div class="col-2">

              </div>
            </div>
            <!--FIN pregunta 11-->
            <!--pregunta 12-->
            <div class="row">
              <div style="text-align:right" class="col-7">
                <p>12. Edad promedio</p>
              </div>
              <div style="text-align:center" class="col-3">
                <input type="text" name="" value="" placeholder="#">
              </div>
              <div class="col-2">

              </div>
            </div>
            <!--FIN pregunta 12-->
            <!--btn siguiente-->
            <div class="row">
              <div style="text-align:right" class="col-7">

              </div>
              <div style="text-align:center" class="col-3">
                <button class="btn-siguiente" type="button" name="button">Siguiente</button>
              </div>
              <div class="col-2">

              </div>
            </div>
            <!--FIN btn siguiente-->

          </div> <!--FIN preguntas-->
        </div>
      </div> <!--CONTAINER-FLUID-->


    </div><!--FIN m-content-->
  </div> <!--FIN m-grid-->
</div>
<!-- end:: m-body -->
<?php $this->load->view( 'footer.php' ); ?>
