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
        <div class="row menu-socios">
          <div class="col-3 m-socios m-socios-activo">
            <h5>Propietarios</h5>
            <p>Sin registros</p>


                <select class="selectpicker" multiple title="Seleccionar..." data-style="btn-info" data-actions-box="true">
                    <option value="1">Nivel A</option>
                    <option value="2">Nivel B</option>
                    <option value="3">Nivel C</option>
                </select>


          </div>
          <div class="col-3 m-socios">
            <h5>No Propietarios</h5>
            <p>Sin registros</p>
              <select class="selectpicker" id="no_propietarios" multiple title="Seleccionar..." data-style="btn-info" data-actions-box="true">
                  <option value="4">Nivel A</option>
                  <option value="5">Nivel B</option>
                  <option value="6">Nivel C</option>
              </select>

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
        <div class="row menu2-socios-activo">
          <div class="col-3">
            <h5>Estructura del despacho</h5>
          </div>
          <div class="col-3">
            <h5>Política de vacaciones</h5>
          </div>
        </div>
      </div>




        <div class="contenido_niveles container-fluid">


        </div>

    </div><!--FIN m-content-->
  </div> <!--FIN m-grid-->
</div>
<!-- end:: m-body -->

<?php $this->load->view( 'footer.php' ); ?>


<script>
    $(document).ready(function() {

        var propietario_nivel_a=false;
        var propietario_nivel_b=false;
        var propietario_nivel_c=false;
        var no_propietario_nivel_a=false;
        var no_propietario_nivel_b=false;
        var no_propietario_nivel_c=false;

        var nivel;

        $('.contenido_preguntas').hide();





        $('.selectpicker').on('changed.bs.select', function (e) {

            nivel=$(this).val();
            console.log(nivel);


        });

        // El evento se dispara cuando se pierde el foco
        $('.selectpicker').on('hidden.bs.select', function (e) {
            $(".contenido_preguntas").remove();
            console.log(nivel);



            for(var i=0;i<nivel.length;i++){



                switch (nivel[i]){
                    case "1":
                    propietario_nivel_a=true;
                    break;
                    case "2":
                    propietario_nivel_b=true;
                    break;
                    case "3":
                    propietario_nivel_c=true;
                    break;
                    case "4":
                    no_propietario_nivel_a=true;
                    break;
                    case "5":
                    no_propietario_nivel_b=true;
                    break;
                    case "6":
                    no_propietario_nivel_c=true;
                    break;

                }

            }

            if(propietario_nivel_a==true){
                propietario_nivel_a=false;
                recibe_formulario_nivel(1);
            }else if(propietario_nivel_b==true){
                propietario_nivel_b=false;
                recibe_formulario_nivel(2);
            }else if(propietario_nivel_c==true){
                propietario_nivel_c=false;
                recibe_formulario_nivel(3);
            }else if(no_propietario_nivel_a==true){
                no_propietario_nivel_a=false;
                recibe_formulario_nivel(4);
            }else if(no_propietario_nivel_b==true){
                no_propietario_nivel_b=false;
                recibe_formulario_nivel(5);
            }else if(no_propietario_nivel_c==true){
                no_propietario_nivel_c=false;
                recibe_formulario_nivel(6);

            }





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

        $('body').on('click','.btn-siguiente', function (e) {


            if(propietario_nivel_a==true){
                propietario_nivel_a=false;
                $(".contenido_preguntas").remove();
                recibe_formulario_nivel(1);

            }else if(propietario_nivel_b==true){
                propietario_nivel_b=false;
                $(".contenido_preguntas").remove();
                recibe_formulario_nivel(2);

            }else if(propietario_nivel_c==true){
                propietario_nivel_c=false;
                $(".contenido_preguntas").remove();
                recibe_formulario_nivel(3);
            }else if(no_propietario_nivel_a==true){
                no_propietario_nivel_a=false;
                $(".contenido_preguntas").remove();
                recibe_formulario_nivel(4);
            }else if(no_propietario_nivel_b==true){
                no_propietario_nivel_b=false;
                $(".contenido_preguntas").remove();
                recibe_formulario_nivel(5);
            }else if(no_propietario_nivel_c==true){
                no_propietario_nivel_c=false;
                $(".contenido_preguntas").remove();
                recibe_formulario_nivel(6);


            }



        });

        function envia_datos(pregn, datos)
        {
            var host = window.location.origin;
            var uri  = window.location.pathname;//.split( '/' );
            var url  = host+"/kerma/profesionales/#";

            var json_data=
                {
                    "pregunta" :pregn,
                    "respuesta":datos,
                    "niveles"  : {

                        "nivel1": nivel[0],
                        "nivel2": nivel[1],
                        "nivel3": nivel[2]
                    }
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
                dataType : 'JSON',

                // código a ejecutar si la petición es satisfactoria;
                // la respuesta es pasada como argumento a la función
                success : function(json) {
                    //$('<h1/>').text(json.title).appendTo('body');
                    //$('<div class="content"/>')
                    //  .html(json.html).appendTo('body');
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

        function recibe_formulario_nivel(nivel_form)
        {
            var host = window.location.origin;
            var url  = host+"/kerma/profesionales/prepara_formulario";
            json_data={"formulario":nivel_form};
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
                    $('.contenido_niveles' ).append( json );

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


        $('body').on('mouseover','.m-socios', function (e) {

            $(this).css("background-color","#af204e");
            $(this).css("color","white");
            $(this).css("cursor","pointer");
            //$(this).addClass("m-socios-activo");


        });

        $('body').on('mouseout','.m-socios', function (e) {

            $(this).css("background-color","#f8f9fa");
            $(this).css("color","black");
            //$(this).removeClass("m-socios-activo");

        });

        $('body').on('click','.m-socios', function (e) {

            $(".m-socios").removeClass("m-socios-activo");
            $(this).addClass("m-socios-activo");


        });



    })



</script>

