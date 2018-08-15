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
          <div class="col-3 m-socios m-socios-activo" id="propietarios_style">
            <div class="row">
              <div class="col-10">
                <h5>Propietarios</h5>
                <p>Sin registros</p>
                  <select class="selectpicker" id="propietarios" multiple title="Seleccionar..." data-style="btn-info" data-actions-box="true">
                      <option value="1">Nivel A</option>
                      <option value="2">Nivel B</option>
                      <option value="3">Nivel C</option>
                  </select>
              </div>
              <div class="col-2">
                <i class="far fa-check-circle paloma-activo"></i>
              </div>
            </div>
          </div>
          <div class="col-3 m-socios" id="nopropietarios_style">
            <div class="row">
              <div class="col-10">
                <h5>No Propietarios</h5>
                <p>Sin registros</p>
                  <select class="selectpicker" id="nopropietarios" multiple title="Seleccionar..." data-style="btn-info" data-actions-box="true">
                      <option value="1">Nivel A</option>
                      <option value="2">Nivel B</option>
                  </select>

              </div>
              <div class="col-2">
                <i class=""></i>
              </div>
            </div>
          </div>
          <div class="col-3 m-socios" id="ofcounsel_style">
            <div class="row">
              <div class="col-10">
                <h5>Of Counsel</h5>
                <p>Sin registros</p>
                  <select class="selectpicker" id="ofcounsel"  title="Seleccionar..." data-style="btn-info" data-actions-box="true">
                      <option value="4">Aplica</option>
                      <option value="0">No Aplica</option>
                  </select>
              </div>
              <div class="col-2">
                <i class=""></i>
              </div>
            </div>
          </div>
          <div class="col-3 m-socios" id="ofcounsel_style">
                <div class="row">
                    <div class="col-10">
                        <h5>Info</h5>
                        <p>Presiona para iniciar</p>
                        <button type="button" class="btn btn-danger" id="btn-comenzar">Guardar Configuracion y comenzar</button>
                    </div>
                    <div class="col-2">
                        <i class=""></i>
                    </div>
                </div>
            </div>
        </div>
        <!--FIN menu socios-->

          <!--Menu2 socios-->
          <div class="contenido_secciones">
              <div class="row menu2-socios-activo">
                  <div class="col-3 item-m2-socios" id="despacho">
                      <div class="row">
                          <div class="col-10">
                              <h5>Estructura del despacho</h5>
                          </div>
                          <div class="col-2">
                              <i class="far fa-check-circle paloma-activo" id="despacho_paloma"></i>
                          </div>
                      </div>
                  </div>
                  <div class="col-3 item-m2-socios" id="vacaciones">
                      <div class="row">
                          <div class="col-10">
                              <h5>Política de vacaciones</h5>
                          </div>
                          <div class="col-2">
                              <i class="far fa-check-circle paloma-activo" id="vacaciones_paloma"></i>
                          </div>
                      </div>
                  </div>
              </div>
          </div>
        <!--FIN Menu2 socios-->

          <div style="text-align:center" class="col-3">
              <button class="btn-siguiente" type="button" name="button">Siguiente</button>
          </div>

      </div> <!--CONTAINER-FLUID-->

        <div class="contenido_niveles">
            <div class="contenido_preguntas">
                <div class="row contenido-edd">
                    <div class="col-3 niveles">
                        <hr>
                        <h5>Some title ...</h5>
                        <hr>
                        <div class="nivel-activo">
                            <p>Nivel A <span class="fas fa-caret-right flecha-nivel"></span></p>
                        </div>
                        <hr>
                        <div class="nivel">
                            <p>Nivel B</p>
                        </div>
                        <hr>
                        <div class="nivel">
                            <p>Nivel C</p>
                        </div>
                        <hr>
                    </div>
                    <div class="col-9 preguntas">
                        <div class="row">
                            <div class="col-8">
                                <p style="color:#af204e; font-weight:bold">Some title ...</p>
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



                        <form id="myform">
                            <?php foreach ($preguntas as $item):?>
                                <?php $contador++;?>
                                <div class="row">
                                    <div style="text-align:right" class="col-7">
                                        <p3><?php echo $item->etiqueta_numeracion_pregunta. ". " . $item->pregunta;?></p3>
                                    </div>
                                    <div style="text-align:center" class="col-3">
                                        <label id="lastname-error" class="error" for="c1"></label>
                                        <input type="text" name="<?php echo 'c'.$contador;?>" value="" placeholder="<?php echo $item->placeholder;?>" id="<?php echo 'c'.$contador;?>">
                                    </div>
                                    <div class="col-2">
                                        <p>%</p>
                                    </div>
                                </div>
                            <?php endforeach;?>
                        </form>



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

    </div><!--FIN m-content-->
  </div> <!--FIN m-grid-->
</div>
<!-- end:: m-body -->
<?php $this->load->view( 'footer.php' ); ?>
<script>
    $(document).ready(function(){
        let data= new Object;
        let no_prop="nopropietarios";
        let si_prop="propietarios";
        let of_counsel="ofcounsel";
        let contador_nivel=0;
        //let niveles= new Array();
        let niveles={
            "valor":[],
            "texto":[]
        };


        let contador_seccion=0;
        let socios =
            {

             "s_propietarios" :{'valor':[]},
             "n_propietarios" :{'valor':[]},
             "of_counsel"     :{'valor':[]},
             "niveles"        :{'valor':[]}
            };
        $('.btn-siguiente').hide();
        constructor();
        function constructor(){
            $('.contenido_secciones').hide();
        }

        $('#propietarios.selectpicker').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {
            let valor=$(this).val();
            //let texto=$(this).find(":selected").text();
            socios['s_propietarios']['valor']=valor;
            console.log(socios);
        });

        $('#nopropietarios.selectpicker').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {
            let valor=$(this).val();
            socios['n_propietarios']['valor']=valor;
            console.log(socios);
        });

        $('#ofcounsel.selectpicker').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {
            let valor=$(this).val();
            if(valor==4){
                socios['of_counsel']['valor']=valor;
                console.log(socios);
            }

        });


        $('#propietarios.selectpicker').on('show.bs.select', function (e) {
            activar_selector(si_prop);
        });

        $('#nopropietarios.selectpicker').on('show.bs.select', function (e) {
            activar_selector(no_prop);
        });
        $('#ofcounsel.selectpicker').on('show.bs.select', function (e) {
            activar_selector(of_counsel);
        });


        $('.selectpickerr').on('hidden.bs.select', function (e) {
            console.log(socios);
        });

        $('#btn-comenzar').on('click', function (e) {


            for(var i=0;i< socios.s_propietarios.valor.length ;i++){

                niveles.valor.push(socios.s_propietarios.valor[i]);
                niveles.texto.push(si_prop);

            }

            for(var i=0;i< socios.n_propietarios.valor.length ;i++){

                niveles.valor.push(socios.n_propietarios.valor[i]);
                niveles.texto.push(no_prop);

            }

            for(var i=0;i< socios.of_counsel.valor.length ;i++){

                niveles.valor.push(socios.of_counsel.valor[i]);
                niveles.texto.push(of_counsel);

            }

            console.log(niveles);

            $( '.btn-siguiente' ).trigger( "click" );
        });



        $('body').on('click','.btn-siguiente', function (e) {

         if (niveles.valor.length >0){

             $('.contenido_secciones').show();

            if(contador_seccion==0){


                if(niveles.texto[0] == no_prop){

                    activar_selector(no_prop);
                }
                if(niveles.texto[0] == si_prop){

                    activar_selector(si_prop);
                }

                if(niveles.texto[0] == of_counsel){
                    activar_selector(of_counsel);

                }



                $('#despacho').removeClass( "col-3 item-m2-socios" ).addClass( "col-3 item-m2-socios item-m2-socios-activo" );
                $('#despacho_paloma').removeClass( "far fa-check-circle" ).addClass( "far fa-check-circle paloma-activo" );

                $('#vacaciones').removeClass( "col-3 item-m2-socios item-m2-socios-activo" ).addClass( "col-3 item-m2-socios" );
                $('#vacaciones_paloma').removeClass( "far fa-check-circle paloma-activo" ).addClass( "far fa-check-circle" );

                data=recibe_formulario_nivel(niveles.valor[0],contador_seccion);
                alert(data);

                contador_seccion=contador_seccion+2;
            }else if(contador_seccion==2){


                $('#despacho').removeClass( "col-3 item-m2-socios item-m2-socios-activo" ).addClass( "col-3 item-m2-socios" );
                $('#despacho_paloma').removeClass( "far fa-check-circle paloma-activo" ).addClass( "far fa-check-circle" );

                $('#vacaciones').removeClass( "col-3 item-m2-socios" ).addClass( "col-3 item-m2-socios item-m2-socios-activo" );
                $('#vacaciones_paloma').removeClass( "far fa-check-circle" ).addClass( "far fa-check-circle paloma-activo" );

                niveles.texto.shift();
                recibe_formulario_nivel(niveles.valor.shift(),contador_seccion);
                contador_seccion=0;
            }


         }else{
             $('.contenido_secciones').remove();
             $('.contenido_preguntas').remove();

             alert("Captura de datos terminada")
         }



        });
        function recibe_formulario_nivel(nivel,seccion)
        {

            var host = window.location.origin;
            var url  = host+"/kerma/profesionales3/get_level_form";
            json_data={
                "level"  :nivel,
                "section":seccion
            };

            var x=$.ajax({
                // la URL para la petición
                url : url,

                // la información a enviar
                // (también es posible utilizar una cadena de datos)
                data : json_data,

                // especifica si será una petición POST o GET
                type : 'POST',

                // el tipo de información que se espera de respuesta
                dataType : 'JSON',

                // código a ejecutar si la petición es satisfactoria;
                // la respuesta es pasada como argumento a la función
                success : function(json, status, xhr) {
                    //alert (json);

                    render_preguntas(json);
                    //$(".contenido_preguntas").remove();
                    //$('.contenido_niveles' ).append( json );

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
            }).responseText;

            alert(x);
        }
        function render_preguntas(preguntas){

        }
        function activar_selector(piker_id){
            switch(piker_id){
                case si_prop:

                    $('#nopropietarios_style').removeClass( "col-3 m-socios m-socios-activo" ).addClass( "col-3 m-socios" );
                    $('#ofcounsel_style').removeClass( "col-3 m-socios m-socios-activo" ).addClass( "col-3 m-socios" );

                    $('#propietarios_style').removeClass( "col-3 m-socios" ).addClass( "col-3 m-socios m-socios-activo" );


                    //paloma
                    $('#nopropietarios_style i').removeClass( "far fa-check-circle paloma-activo" ).addClass( "" );
                    $('#ofcounsel_style i').removeClass( "far fa-check-circle paloma-activo" ).addClass( "" );

                    $('#propietarios_style i').addClass( "far fa-check-circle paloma-activo" );
                    break;

                    break;
                case no_prop:
                    $('#propietarios_style').removeClass( "col-3 m-socios m-socios-activo" ).addClass( "col-3 m-socios" );
                    $('#ofcounsel_style').removeClass( "col-3 m-socios m-socios-activo" ).addClass( "col-3 m-socios" );

                    $('#nopropietarios_style').removeClass( "col-3 m-socios" ).addClass( "col-3 m-socios m-socios-activo" );


                    //paloma
                    $('#propietarios_style i').removeClass( "far fa-check-circle paloma-activo" ).addClass( "" );
                    $('#ofcounsel_style i').removeClass( "far fa-check-circle paloma-activo" ).addClass( "" );

                    $('#nopropietarios_style i').addClass( "far fa-check-circle paloma-activo" );
                    break;

                case of_counsel:
                    $('#nopropietarios_style').removeClass( "col-3 m-socios m-socios-activo" ).addClass( "col-3 m-socios" );
                    $('#propietarios_style').removeClass( "col-3 m-socios m-socios-activo" ).addClass( "col-3 m-socios" );

                    $('#ofcounsel_style').removeClass( "col-3 m-socios" ).addClass( "col-3 m-socios m-socios-activo" );

                    //paloma
                    $('#propietarios_style i').removeClass( "far fa-check-circle paloma-activo" ).addClass( "" );
                    $('#nopropietarios_style i').removeClass( "far fa-check-circle paloma-activo" ).addClass( "" );

                    $('#ofcounsel_style i').addClass( "far fa-check-circle paloma-activo" );

                    break;
            }
        }



    });
</script>