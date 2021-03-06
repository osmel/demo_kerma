<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');?>
<style>
    #chartdiv {
        width		: 100%;
        height		: 500px;
        font-size	: 8px;
    }
</style>
<?php $this->load->view( 'header' ); ?>
<?php $this->load->view( 'aside-menu.php' ); ?>

<div class="m-grid__item m-grid__item--fluid m-wrapper">
    <!-- BEGIN: Subheader -->
    <div class="m-subheader div-status">
        <div class="d-flex align-items-center">
            <div class="mr-auto">
                <h3 class="m-subheader__title ">Reportes</h3>
                <h5><div id="subtitulo"></div></h5>
            </div>
        </div>
    </div>
    <!-- END: Subheader -->
    <div class="m-content contenido-admin-usu-cat">
        <div class="container-fluid">
            <!--Menu admin-->
            <div class="row menu2-socios-activo">


            </div>
            <!--FIN Menu admin-->
        </div>
        <!--catalogo usuarios-->
    </div><!--FIN m-content-->


    <!-- Cuerpo regilla -->
    <br/>
    <div class="container-fluid">
        <div class="m-grid m-grid--hor m-grid--root m-page">
            <div class="m-portlet__body">
                <div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
                    <div class="row align-items-center">

                        <div class="col-xl-12 order-2 order-xl-1">
                            <div class="form-group m-form__group row align-items-center">
                                <!-- Filtro de perfil -->


                                <div class="col-md-5">
                                    <div class="m-form__group m-form__group--inline">
                                        <div class="m-form__label">
                                            <label>
                                                Tipo de reporte:
                                            </label>
                                        </div>
                                        <div class="m-form__control">

                                            <select class="form-control m-input m-input--square" id="reportes_subindice">

                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <!--
                                <div class="col-md-5">
                                    <div class="m-form__group m-form__group--inline">
                                        <div class="m-form__label">
                                            <label>
                                                Tipo de reporte:
                                            </label>
                                        </div>
                                        <div class="m-form__control">

                                            <select class="form-control m-input m-input--square" id="reportes_categorias">

                                            </select>
                                        </div>
                                    </div>
                                </div>
                                -->


                                <div class="col-md-1">
                                    <div class="m-form__group m-form__group--inline">
                                        <button type="button" class="btn m-btn--pill  btn-danger m-btn--wide" id="reporte">Buscar</button>
                                    </div>
                                </div>


                            </div>

                            <div class="form-group m-form__group row align-items-center">


                                <div class="col-md-2">
                                    <div class="m-form__group m-form__group--inline">
                                        <div class="m-form__label">
                                            <label>
                                                Periodos:
                                            </label>
                                        </div>
                                        <div class="m-form__control">
                                            <select class="form-control m-input m-input--square" id="periodos">
                                                <option value="4">Anual</option>
                                                <option value="3">Semestral</option>
                                                <option value="2">Cuatrimestral</option>
                                                <option value="1">Bimestral</option>
                                                <option value="0">Mensual</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="m-form__group m-form__group--inline">
                                        <div class="m-form__label">
                                            <label>
                                                Años:
                                            </label>
                                        </div>
                                        <div class="m-form__control">
                                            <select class="form-control m-input m-input--square" id="anios">
                                                <option value="2017">2017</option>
                                                <option value="2018">2018</option>
                                            </select>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="m-form__group m-form__group--inline">
                                        <div class="m-form__label">
                                            <label>
                                                Firmas:
                                            </label>
                                        </div>
                                        <div class="m-form__control">
                                            <!--<div id="container_muestras"> </div>-->
                                            <select class='selectpicker'  multiple data-actions-box='true' id='muestras'>
                                            </select>

                                        </div>
                                    </div>
                                </div>
                                <!--

                               <div class="col-md-2">
                                   <div class="m-form__group m-form__group--inline">
                                       <div class="m-form__label">
                                           <label>
                                               Categorias:
                                           </label>
                                       </div>
                                       <div class="m-form__control">
                                           <select class="form-control m-input m-input--square" id="categorias">
                                               <option value="1">Socio</option>
                                               <option value="2">Abogado</option>
                                               <option value="3">Pasante</option>
                                               <option value="4">No Abogado</option>
                                           </select>
                                       </div>
                                   </div>
                               </div>

                               <div class="col-md-2">
                                   <div class="m-form__group m-form__group--inline">
                                       <div class="m-form__label">
                                           <label>
                                               Subcategorias:
                                           </label>
                                       </div>
                                       <div class="m-form__control">
                                           <select class="selectpicker" id="subcategorias" multiple title="Seleccionar..." data-style="btn-info" data-actions-box="true">
                                           </select>
                                       </div>
                                   </div>
                               </div>

                            -->

                           </div>


                            <!--
                            <div class="form-group m-form__group row align-items-center">
                                <div class="col-md-3">
                                    <div class="m-input-icon m-input-icon--left">
                                        <input type="text" class="form-control m-input" placeholder="Search..." id="busquedaGeneral">
                                        <span class="m-input-icon__icon m-input-icon__icon--left">
                                            <span>
                                                <i class="la la-search"></i>
                                            </span>
                                        </span>
                                    </div>
                                </div>
                            </div>
                            -->

                            <!--begin: Selected Rows Group Action Form -->
                            <div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30 collapse" id="selector_multiple_registro">
                                <div class="row align-items-center">
                                    <div class="col-xl-12">
                                        <div class="m-form__group m-form__group--inline">

                                            <div class="m-form__label m-form__label-no-wrap">
                                                <label class="m--font-bold m--font-danger-">
                                                    Seleccionado
                                                    <span id="etiqueta_selector_multiple_registro"></span>
                                                    registros:
                                                </label>
                                            </div>

                                            <div class="m-form__control">
                                                <div class="btn-toolbar">

                                                    <div class="dropdown">

                                                        <button type="button" class="btn btn-accent btn-sm dropdown-toggle" data-toggle="dropdown">
                                                            Actualizando Perfil
                                                        </button>

                                                        <div class="dropdown-menu" aria-labelledby="btnGroupDrop1" id="id_grupo">
                                                            <?php foreach ( $perfiles as $perfil ){ ?>

                                                                <button
                                                                        class="btn btn-sm  dropdown-item cambio_multiple_perfil"
                                                                        valor="<?php echo $perfil->id_perfil; ?>"
                                                                        activo=""
                                                                        type="button" data-toggle="modal" data-target="#modal_cambiar_multiple_perfil">
                                                                    <?php echo $perfil->perfil; ?>
                                                                </button>

                                                            <?php } ?>
                                                        </div>

                                                    </div>



                                                    &nbsp;&nbsp;&nbsp;

                                                    <button class="btn btn-sm btn-danger eliminar_usuario_multiple"
                                                            type="button" data-toggle="modal" data-target="#modal_eliminar_usuario_multiple">
                                                        Eliminando todos los seleccionados
                                                    </button>

                                                    &nbsp;&nbsp;&nbsp;
                                                    <button class="btn btn-sm btn-success" type="button" data-toggle="modal" data-target="#modal_obtener_registro_seleccionado">
                                                        Obtener registros seleccionados
                                                    </button>

                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                </div>
                            </div>
                            <!--end: Selected Rows Group Action Form -->
                            <!--begin: Datatable -->

                            <div class="tabla_reportes"></div>
                        </div>
                    </div>


                </div>
            </div>
        </div>
        <div id="chartdiv" style="width: 100%"></div>
        <div class="row">
            <div class="col-sm-8 col-md-9"></div>
            <div class="col-sm-4 col-md-3">

            </div>
        </div>
    </div>


</div> <!--FIN todo-->

</body>
</html>

<?php $this->load->view('footer'); ?>

<script>
    $(document).ready(function() {


        var datatable_reportes  = $('.tabla_reportes').mDatatable({});

        var normal={
            // datasource definition
            data: {
                type: 'remote', //Obligatorio.Establecer tipo remote para obtener datos remotos de una URL pública
                source: {
                    read: {
                        url : '/kerma/reportes/reportes_seguros_jubilacion/',
                        method: 'POST',  //Método de petición para la solicitud ajax

                        params: { //objeto de parámetros que se envia al server
                            //indice:$('#reportes_id').find(":selected").val()//  $('#id_perfil[mod="regilla"] option:selected').text(), //'uno',

                        },
                        map: function(raw) {  //Mapear los datos recibidos en la regilla. Todavía no se conque objetivo mapeo
                            // sample data mapping
                            var dataSet = raw;
                            if (typeof raw.data !== 'undefined') {
                                dataSet = raw.data;

                            }
                           graph_bars(dataSet);
                            return dataSet;
                        }
                    }

                },
                pageSize: 20,            //Cantidad de registros por paginas
                saveState: {
                    cookie: false,
                    webstorage: false
                },
                serverPaging: true,     //Habilitar/deshabilitar la paginación en el lado del servidor.
                serverFiltering: true,  //Habilitar/deshabilitar el filtrado en el lado del servidor.
                serverSorting: true    //Habilitar/deshabilitar la ordenación en el lado del servidor

            },

            translate: { //tratamiento de lenguaje
                records: {
                    processing: 'Cargando...',
                    noRecords: 'No se encontrarón archivos'
                },
                toolbar: {
                    pagination: {
                        items: {
                            default: {
                                first: 'Primero',
                                prev: 'Anterior',
                                next: 'Siguiente',
                                last: 'Último',
                                more: 'Más páginas',
                                input: 'Número de página',
                                select: 'Seleccionar tamaño de página'
                            },
                            info: 'Viendo {{start}} - {{end}} de {{total}} registros'
                        }
                    }
                }
            },


            // definition de temas
            layout: {
                scroll: true,  //Habilitar / deshabilitar el scroll. vertical y horizontal
                footer: false,    //Habilitar / deshabilitar el pie de página.
                //theme: 'default', // datatable theme
                //class: '', // custom wrapper class
                opacity:1,
                height: 700 // datatable's body's fixed height
            },

            // column sorting
            sortable: true,  //Habilitar/deshabilitar columnas ordenables globalmente.

            pagination: false,  //Habilitar / deshabilitar la paginación globalmente

            toolbar: {
                // toolbar items
                items: {
                    // pagination
                    pagination: {
                        // page size select
                        pageSizeSelect: [-1,2,10, 20, 30, 50, 100,200]  //-1 indica que es para todos
                    }
                }
            },

            search: {
                input: $('#busquedaGeneral') //Pasar el elemento jQuery de entrada. La tabla de datos agregará el evento OnKeyup a la entrada
                //para disparar el filtro de búsqueda interno de los datos que ya están listo en la tabla.
            },

            extensions: {
                checkbox: {

                    //creo q es para cambiar tipo de variables que se llamen de otra forma en el request
                    vars: {
                        selectedAllRows: 'selectedAllRows',
                        requestIds: 'requestIds',
                        rowIds: 'meta.rowIds'
                    }


                }

            },

            // columns definition
            columns: [
                {
                    field: 'pregunta',
                    title: 'Personal',
                    // sortable: 'asc', // default sort
                    filterable: false, // disable or enable filtering
                    width: 250,
                    // basic templating support for column rendering,
                    template: '{{pregunta}}'

                },
                {
                    field: 'porcentaje',
                    title: 'Si',
                    // sortable: 'asc', // default sort
                    filterable: false, // disable or enable filtering
                    width: 200,
                    // basic templating support for column rendering,
                    template: function(row) {


                        var status = {
                            1: {'titulo': row.porcentaje, 'clase': 'm-badge--warning'},
                            2: {'titulo': row.porcentaje, 'clase': 'm-badge--metal'},

                        };

                        switch(row.vsprom) {
                            case 'NA':
                                return  '<span class="m-badge ' + status["2"].clase + ' m-badge--wide">' + status["2"].titulo +'</span>';
                                break;
                            default:
                                return  '<span class="m-badge ' + status["1"].clase + ' m-badge--wide">' + status["1"].titulo +'</span>';
                                break;


                        }
                        return  '<span class="m-badge ' + status["1"].clase + ' m-badge--wide">' + status["1"].titulo +'</span>';
                    },
                }

            ]
        };



        construct();


        function construct()
        {
            getPeriodos();
            getAnios();
            getMuestras();
            getSubcategorias(6);
        }



        $('#reportes_categorias').on('change', function() {
            var valor = $(this).find(":selected").val();

        });


        // Obtenemos los valores y el texto del selector multiple cuando el evento changed es disparado
        $('#subcategorias.selectpicker').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {
            //unset Container subcategoria
            container['subcategoria']=[];
            //  iteramos sobre cada uno de los elementos seleccionados para obtener y un array pues el texto es enviado en forma de string
            $('#subcategorias.selectpicker option:selected').each(function(i, selectedElement) {
                //subcategorias[]['texto'].push($(selectedElement).text());
                container['subcategoria'].push($(selectedElement).val());
            });

        });

        function getAnios()
        {


            var host = window.location.origin;
            var url  = host+"/kerma/reportes/getAnios";




            $.ajax({
                // la URL para la petición
                url : url,

                // la información a enviar
                // (también es posible utilizar una cadena de datos)
                data : {

                },

                // especifica si será una petición POST o GET
                type : 'POST',

                // el tipo de información que se espera de respuesta
                //dataType : 'JSON',

                // código a ejecutar si la petición es satisfactoria;
                // la respuesta es pasada como argumento a la función
                success : function(response, status, xhr) {

                    $('#anios').html(response)
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
        function getPeriodos()
        {


            var host = window.location.origin;
            var url  = host+"/kerma/reportes/getPeriodos";




            $.ajax({
                // la URL para la petición
                url : url,

                // la información a enviar
                // (también es posible utilizar una cadena de datos)
                data : {

                },

                // especifica si será una petición POST o GET
                type : 'POST',

                // el tipo de información que se espera de respuesta
                //dataType : 'JSON',

                // código a ejecutar si la petición es satisfactoria;
                // la respuesta es pasada como argumento a la función
                success : function(response, status, xhr) {

                    $('#periodos').html(response)
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
        function getMuestras()
        {


            var host = window.location.origin;
            var url  = host+"/kerma/reportes/getMuestras";
            var selector=selector;

            $.ajax({
                // la URL para la petición
                url : url,

                // la información a enviar
                // (también es posible utilizar una cadena de datos)
                data : {

                },

                // especifica si será una petición POST o GET
                type : 'POST',

                // el tipo de información que se espera de respuesta
                //dataType : 'JSON',

                // código a ejecutar si la petición es satisfactoria;
                // la respuesta es pasada como argumento a la función
                success : function(response, status, xhr) {

                    //$('#container_muestras').html(response);
                    $('#muestras').html(response).selectpicker('refresh');
                    $('#muestras').selectpicker('selectAll');
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
        function getSubcategorias(indice)
        {


            var host = window.location.origin;
            var url  = host+"/kerma/reportes/getSubcategorias";
            var selector=selector;



            $.ajax({
                // la URL para la petición
                url : url,

                // la información a enviar
                // (también es posible utilizar una cadena de datos)
                data : {
                    'indice':indice
                },

                // especifica si será una petición POST o GET
                type : 'POST',

                // el tipo de información que se espera de respuesta
                //dataType : 'JSON',

                // código a ejecutar si la petición es satisfactoria;
                // la respuesta es pasada como argumento a la función
                success : function(response, status, xhr) {

                    $('#reportes_subindice').html(response)
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
        function getCategorias(subindice)
        {


            var host = window.location.origin;
            var url  = host+"/kerma/reportes/getCategorias";
            var selector=selector;

            $.ajax({
                // la URL para la petición
                url : url,

                // la información a enviar
                // (también es posible utilizar una cadena de datos)
                data : {
                    'subindice':subindice
                },

                // especifica si será una petición POST o GET
                type : 'POST',

                // el tipo de información que se espera de respuesta
                //dataType : 'JSON',

                // código a ejecutar si la petición es satisfactoria;
                // la respuesta es pasada como argumento a la función
                success : function(response, status, xhr) {

                    $('#reportes_categorias').html(response)
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




        $('#reporte').on('click', function() {


            var parametros={
                'subindice':'',
                'categoria':'',
                'tipo'     :'',
                'periodo'  :'',
                'anio'     :'',
                'muestras' :[]
            };


            parametros.categoria = $('#reportes_categorias').find(":selected").val();
            parametros.subindice = $('#reportes_subindice').find(":selected").val();
            parametros.anio      = $('#anios').find(":selected").val();
            parametros.periodo   = $('#periodos').find(":selected").val();

            $('#muestras.selectpicker option:selected').each(function(i, selectedElement) {
                //subcategorias[]['texto'].push($(selectedElement).text());
                parametros.muestras.push($(selectedElement).val());
            });

            if(parametros.muestras.length<3){
                alert ("Debes seleccionar una muestra mayor a 2 Firmas");
                return
            }


            if(parametros.subindice =="2.1" || parametros.subindice =="2.2" || parametros.subindice =="2.3"){
                parametros.tipo = 2;

                $('.tabla_reportes').mDatatable('destroy');
                datatable_reportes = $('.tabla_reportes').mDatatable(especial);

            }else {
                parametros.tipo = 1;
                $('.tabla_reportes').mDatatable('destroy');
                datatable_reportes = $('.tabla_reportes').mDatatable(normal);
            }

            datatable_reportes.setDataSourceParam('parametros', parametros);
            datatable_reportes.reload();

        });






    function graph_bars(dataSet){


            var grafico=
                {
                    "theme": "light",
                    "type":  "serial",
                    "dataProvider":[],
                    "valueAxes": [{
                        "unit": "",
                        "position": "left",
                        "title": ""
                    }],
                    "graphs": [{
                        "balloonText": "Promedio otras firmas para [[category]]  <b>[[value]]</b>",
                        "fillAlphas": 0.9,
                        "lineAlpha": 0.2,
                        "title": "Promedio Otras Firmas",
                        "type": "column",
                        "valueField": "promedio_firmas"
                    }, {
                        "balloonText": "Promedio mi firma [[category]]  <b>[[value]]</b>",
                        "fillAlphas": 0.9,
                        "lineAlpha": 0.2,
                        "title": "Promedio Mi Firma",
                        "type": "column",
                        "clustered":false,
                        "columnWidth":0.5,
                        "valueField": "promedio_actual"
                    }],
                    "plotAreaFillAlphas": 0.1,
                    "categoryField": "personal",
                    "categoryAxis": {
                        "gridPosition": "start",
                        "labelRotation": 90
                    },
                    "export": {
                        "enabled": true
                    }



                };
            //console.log(grafico);

            // console.log(dataSet);
            for(var i=0; i<dataSet.length;i++){
                //console.log(dataSet[i].humancapital);

                grafico.dataProvider.push({
                    "personal": dataSet[i].pregunta,
                    "promedio_firmas": parseFloat(dataSet[i].porcentaje)

                });


            }

            grafico.valueAxes[0].title=dataSet[0].subtitulo;
            $('#subtitulo').html(dataSet[0].subtitulo);


            var chart = AmCharts.makeChart("chartdiv", grafico);


        }


    });
</script>
