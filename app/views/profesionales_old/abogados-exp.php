<?php //var_dump($detalles_tipo_profesional);?>
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
            <h3 class="m-subheader__title ">Abogados por años de experiencia</h3>
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
            <div class="row">
              <div class="col-10">
                <h5>Años de Experiencia</h5>
                <p>Sin registros</p>
              </div>
              <div class="col-2">
                <i class="far fa-check-circle paloma-activo"></i>
              </div>
            </div>

              <select class="selectpicker" multiple title="Seleccionar..." data-style="btn-info" data-actions-box="true">
                  <?php foreach ($detalles_tipo_profesional as $item):?>
                  <option value="<?php echo $item->id ?>"><?php echo $item->nombre ?></option>

                  <?php endforeach ?>
              </select>

          </div>
        </div>
        <!--FIN menu socios-->
        <!--Menu2 socios-->
        <!--<div class="row menu2-socios-activo">
          <div class="col-3 item-m2-socios item-m2-socios">
            <div class="row">
              <div class="col-10">
                <h5>GENERAL</h5>
              </div>
              <div class="col-2">
                <i class=""></i>
              </div>
            </div>
          </div>
        </div>-->

        <!--FIN Menu2 socios-->
          <div class="dynamic_content">
              <div class="contenido_preguntas">
                  <div class="row contenido-edd">
                      <div class="col-12 preguntas">
                          <div class="row">
                              <div class="col-8">
                                  <p style="color:#af204e; font-weight:bold">Titulo2</p>
                                  <h3 style="margin-top:-10px">Titulo 2</h3>
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
                                  <p>1. Antigüedad en la firma</p>
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
                                  <p>2. Días de vacaciones otorgados</p>
                              </div>
                              <div style="text-align:center" class="col-3">
                                  <input type="text" name="" value="" placeholder="#">
                              </div>
                              <div class="col-2">

                              </div>
                          </div>
                          <!--FIN pregunta 2-->
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
              </div>
          </div>
      </div> <!--CONTAINER-FLUID-->


    </div><!--FIN m-content-->
  </div> <!--FIN m-grid-->
</div>
<!-- end:: m-body -->
<?php $this->load->view( 'footer' ); ?>
<script>
    $(document).ready(function() {
        var contador=0;
        var tarifa={
            "value":""
        };
        var subsecciones={
          "despacho":{
              "active":true,
              "indice":"1",
              "finished":false
          },

          "sueldos":{
              "active":false,
              "indice":"2",
              "finished":false
          },
          "vacaciones":{
              "active":false,
              "indice":"3",
              "finished":false
          }
        };

        $('.selectpicker').on('hidden.bs.select', function (e) {

        });

        $('.selectpicker').on('changed.bs.select', function (e) {

            tarifa.value=$(this).val();
            console.log("Tarifa " + tarifa.value);
        });



        $('body').on('click','.btn-siguiente', function (e) {


            if(jQuery.isEmptyObject(tarifa.value)){
                alert("¡Selecciona los años de experiencia!");
            } else {
                get_next_subsection();

            }



        });


        $('body').on('mouseover','#despacho', function (e) {

            $('#despacho').css( 'cursor', 'pointer' );
            $('#desoacho').css( 'background-color', '#6e1632' );

        });
        $('body').on('mouseout','#despacho', function (e) {

            $('#despacho').css( 'cursor', 'pointer' );
            $('#despacho').css( 'background-color', '#95153E' );

        });
        $('body').on('mouseover','#sueldos', function (e) {

            $('#sueldos').css( 'cursor', 'pointer' );
            $('#sueldos').css( 'background-color', '#6e1632' );

        });
        $('body').on('mouseout','#sueldos', function (e) {

            $('#sueldos').css( 'cursor', 'pointer' );
            $('#sueldos').css( 'background-color', '#95153E' );

        });
        $('body').on('mouseover','#vacaciones', function (e) {

            $('#vacaciones').css( 'cursor', 'pointer' );
            $('#vacaciones').css( 'background-color', '#6e1632' );

        });
        $('body').on('mouseout','#sueldos', function (e) {

            $('#vacaciones').css( 'cursor', 'pointer' );
            $('#vacaciones').css( 'background-color', '#95153E' );

        });
        $('body').on('click','#despacho', function (e) {


            subsecciones.despacho.active=true;
            get_next_subsection();

        });
        $('body').on('click','#sueldos', function (e) {



            subsecciones.sueldos.active=true;
            get_next_subsection();

        });
        $('body').on('click','#vacaciones', function (e) {



            subsecciones.vacaciones.active=true;
            get_next_subsection();

        });


        $('body').on('focusout','input', function (e) {


            // $('input').on('focusout',"input", function (e) {
            event.preventDefault(e);
            //alert("s");
            var datos=$(this).val();
            var pregn=$(this).attr('name');


            console.log(pregn);
            console.log(datos);
            //envia_datos(pregn,datos);

        });

        function set_data()
        {

            var host = window.location.origin;
            var url  = host+"/kerma/profesionales/#";
            json_data={"subsection":subsection};
            $.ajax({
                // la URL para la petición
                url : url,

                // la información a enviar
                // (también es posible utilizar una cadena de datos)
                data : json_data,

                // especifica si será una petición POST o GET
                type : 'POST',

                // el tipo de información que se espera de respuesta
                //dataType : 'JSON',

                // código a ejecutar si la petición es satisfactoria;
                // la respuesta es pasada como argumento a la función
                success : function(json, status, xhr) {
                    //alert (json);
                    $('.dynamic_content' ).append( json );


                },



                // código a ejecutar si la petición falla;
                // son pasados como argumentos a la función
                // el objeto de la petición en crudo y código de estatus de la petición
                error : function(xhr, status) {
                    //alert('Disculpe, existió un problema');
                }

                // código a ejecutar sin importar si la petición falló o no
                //complete : function(xhr, status) {
                //alert('Petición realizada');
                //}
            });



        }
        function get_subsection(subsection,tarifa)
        {

            var host = window.location.origin;
            var url  = host+"/kerma/profesionales/get_subsection";
            json_data={

                "subsection":subsection
            };
            $.ajax({
                // la URL para la petición
                url : url,

                // la información a enviar
                // (también es posible utilizar una cadena de datos)
                data : json_data,

                // especifica si será una petición POST o GET
                type : 'POST',

                // el tipo de información que se espera de respuesta
                //dataType : 'JSON',

                // código a ejecutar si la petición es satisfactoria;
                // la respuesta es pasada como argumento a la función
                success : function(json, status, xhr) {
                    //alert (json);
                    $('.dynamic_content' ).append( json );


                },



                // código a ejecutar si la petición falla;
                // son pasados como argumentos a la función
                // el objeto de la petición en crudo y código de estatus de la petición
                error : function(xhr, status) {
                    //alert('Disculpe, existió un problema');
                }

                // código a ejecutar sin importar si la petición falló o no
                //complete : function(xhr, status) {
                //alert('Petición realizada');
                //}
            });



        }


        function get_next_subsection()
        {

            var next_subsection;
                //get_subsection(subsecciones.vacaciones.indice);



                    if(subsecciones.despacho.active==true){

                        subsecciones.despacho.active=false;
                        subsecciones.sueldos.active=true;
                        subsecciones.vacaciones.active=false;
                        next_subsection=subsecciones.despacho.indice;
                        //get_subsection(subsecciones.despacho.indice);
                    }else if(subsecciones.sueldos.active==true){
                        subsecciones.sueldos.active=false;
                        subsecciones.vacaciones.active=true;
                        subsecciones.despacho.active=false;
                        next_subsection=subsecciones.sueldos.indice;
                        //get_subsection(subsecciones.sueldos.indice);
                    }else if(subsecciones.vacaciones.active==true) {
                        subsecciones.vacaciones.active = false;
                        subsecciones.despacho.active=true;
                        subsecciones.despacho.sueldos=false;
                        next_subsection=subsecciones.vacaciones.indice;
                        delete tarifa.value[contador];
                        contador++;

                    }



            clear_dynamic_content();
            console.log("Get Next Subsecction "+tarifa.value);
            get_subsection(next_subsection);
            //var current_tarifa=tarifa.value[contador];

        }




        function clear_dynamic_content()
        {
            $('.contenido_preguntas').remove();
        }



    })

</script>

