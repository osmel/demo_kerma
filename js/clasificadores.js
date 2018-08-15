jQuery(document).ready(function() {

//////////////////////////////entidades

 var datatable_preguntas = $('.tabla_preguntas').mDatatable({
      // datasource definition
      data: {
        type: 'remote', //Obligatorio.Establecer tipo remote para obtener datos remotos de una URL pública

        saveState: {
            cookie : false, //para que las variables no se guarden en una cookie, el valor por defecto es true
            webstorage : false,
          },

        source: {
          read: {
            url : '/kerma/procesando_preguntas',
            method: 'POST',  //Método de petición para la solicitud ajax
            
            params: { //objeto de parámetros que se envia al server
                //valor:new Date(), //  $('#id_perfil[mod="regilla"] option:selected').text(), //'uno',
                /*
                query: {
                  id_modulo:1,
                }*/

                query: {  //UPDATE `kerma_cat_view_preguntas` SET `activo`=1 WHERE id>=63 and id<=65
                          // UPDATE `kerma_cat_view_preguntas` SET `activo`=1 WHERE id=111 or id=112 or id=162 or id=163 or id=190 or id=191
                         
                         /*"id_modulo":3,
                        //"cch.id":3, //profesionales   o r.id
                        "id_sub_modulo": 3,
                        "campo": 'cch.id',
                        "e.id":7, //5-estructura de despacho, 7-politica
                        */
                        //id_modulo:1,

                       // pestana:0,
                        
                }

            },
            map: function(raw) {  //Mapear los datos recibidos en la regilla. Todavía no se conque objetivo mapeo
              var dataSet = raw;
              if (typeof raw.data !== 'undefined') {
                dataSet = raw.data;
                //console.log(raw);
              }
              return dataSet;
            },
          },
        },
        pageSize: 100,            //Cantidad de registros por paginas
        serverPaging: true,     //Habilitar/deshabilitar la paginación en el lado del servidor.
        serverFiltering: true,  //Habilitar/deshabilitar el filtrado en el lado del servidor.
        serverSorting: true,    //Habilitar/deshabilitar la ordenación en el lado del servidor

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
        scroll: false,  //Habilitar / deshabilitar el scroll. vertical y horizontal
        footer: false,    //Habilitar / deshabilitar el pie de página.
        //height: 550, // datatable's body's fixed height
      },

      // column sorting
      sortable: true,  //Habilitar/deshabilitar columnas ordenables globalmente. 

      pagination: true,  //Habilitar / deshabilitar la paginación globalmente 

      toolbar: {
        // toolbar items
        items: {
          // pagination
          pagination: {
            // page size select
            pageSizeSelect: [-1,2,10, 20, 30, 50, 100,200],  //-1 indica que es para todos
          },
        },
      },

      search: {
        input: $('#busquedaGeneral'),  //Pasar el elemento jQuery de entrada. La tabla de datos agregará el evento OnKeyup a la entrada 
                                     //para disparar el filtro de búsqueda interno de los datos que ya están listo en la tabla.
      },

     extensions: {
       checkbox: {
          
            //creo q es para cambiar tipo de variables que se llamen de otra forma en el request
           vars: {
             selectedAllRows: 'selectedAllRows',
             requestIds: 'requestIds',
             rowIds: 'meta.rowIds',
           },
           

       },

     },

      // columns definition
      columns: [
     {
        field: 'id',
        title: '#',
        sortable: false,
        width: 40,
        textAlign: 'center',
        //selector: {class: 'm-checkbox--solid m-checkbox--brand'},
      },

       {
          field: 'identificador',
          title: 'Identificador',
          filterable: false, // disable or enable filtering
          
        },
       {
          field: 'nombre',
          title: 'Nombre',
          filterable: false, // disable or enable filtering
          
        },        

       {
          field: 'id_numeracion_pregunta',
          title: 'Núm Pregunta',
          filterable: false, // disable or enable filtering
          
        },  
        {
          field: 'tipo_pregunta',
          title: 'Tipo Pregunta',
          filterable: false, // disable or enable filtering
          
        },  

        {
          field: 'principal',
          title: 'Modulos',
          filterable: false, // disable or enable filtering
          
        }, 
        {
          field: 'hijo',
          title: 'Sub-Modulos',
          filterable: false, // disable or enable filtering
          
        },  

 
        {
          field: 'encabezados',
          title: 'Encabezado Pregunta(BOTONES)',
          filterable: false, // disable or enable filtering
          
        },        


       /*
        {
          field: 'encabezado_pregunta',
          title: 'Encabezado Pregunta',
          filterable: false, // disable or enable filtering
          
        },  */
        


        {
          field: 'id_modulo',
          title: 'Modulos',
         // filterable: false, // deshabilitar o habilitar filtro
          // callback function support for column rendering
          template: function(row) {
            var status = {
              1: {'titulo': row.id_modulo, 'clase': 'm-badge--danger'},
              2: {'titulo': row.id_modulo, 'clase': ' m-badge--info'},
              3: {'titulo': row.id_modulo, 'clase': ' m-badge--primary'},
              4: {'titulo': row.id_modulo, 'clase': ' m-badge--warning'},
              5: {'titulo': row.id_modulo, 'clase': ' m-badge--brand'},
              6: {'titulo': row.id_modulo, 'clase': ' m-badge--primary'},
              7: {'titulo': row.id_modulo, 'clase': ' m-badge--success'},
              8: {'titulo': row.id_modulo, 'clase': ' m-badge--focus'},
              9: {'titulo': row.id_modulo, 'clase': ' m-badge--accent'},
              10: {'titulo': row.id_modulo, 'clase': ' m-badge--metal'},
              11: {'titulo': row.id_modulo, 'clase': ' m-badge--metal'},
              12: {'titulo': row.id_modulo, 'clase': ' m-badge--metal'},
              13: {'titulo': row.id_modulo, 'clase': ' m-badge--metal'},

            };
            return  '<span class="m-badge ' + status[row.id_modulo].clase + ' m-badge--wide">' + status[row.id_modulo].titulo + '</span>';
          } 


        },

  
      {
          field: 'Actions',
          //width: 110,
          title: 'Comportamiento',
          sortable: false,
          overflow: 'visible',
          template: function (row, index, datatable) {
            return '\
            <a href="/kerma/editar_entidad/'+jQuery.base64.encode(row.id)+'" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="Edit details">\
              <i class="la la-edit"></i>\
            </a>\
            <a \
             id="eliminar_entidad" class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" title="Eliminar"\
             data-remoto="/kerma/eliminar_entidad/'+jQuery.base64.encode(row.id)+'/'+jQuery.base64.encode(row.nombre)+ '"\
               data-toggle="modal" data-target="#m_modal_entidad" >\
              <i class="la la-trash"></i>\
            </a>\
          ';
          },
        } 

        


        ],

  
    });


 



    //llenar el list multiple de botones
    $('#id_modulo[mod="nuevo_pregunta"]').on('change', function() {

      url_datos = 'botones_pregunta';
      jQuery.ajax({
                          url : '/kerma/'+url_datos,
                          data:{
                                 id_modulo: jQuery('#id_modulo[mod="nuevo_pregunta"]').val(),
                          },
                          type : 'POST',
                          dataType : 'json',
                          success : function(misdatos) {
                               

                                $('#multiples_btnes[mod="nuevo_pregunta"]').
                                          find('option')
                                              .remove()
                                              .end();

                                $('#multiples_categoria[mod="nuevo_pregunta"]').
                                          find('option')
                                              .remove()
                                              .end();


                                       //prestaciones y otras prestaciones. Pueden incluirse los otros que son pestana=0       
                                       if   ( (jQuery('#id_modulo[mod="nuevo_pregunta"]').val()==11) || (jQuery('#id_modulo[mod="nuevo_pregunta"]').val()==12) ) {
                                             $.each( misdatos.botones, function( key, elemento ) {
                                                  //console.log( elemento.grupo_nombre+'('+elemento.categoria_nombre+')' );         
                                                  $('#multiples_btnes[mod="nuevo_pregunta"]').append('<option value="'+elemento.id+'">'+elemento.grupo_nombre+'('+elemento.categoria_nombre+')'+'</option>'); //.end();
                                             }); 
                                       }           


                                       //Profesionales y administrativos
                                       if   ( (jQuery('#id_modulo[mod="nuevo_pregunta"]').val()==3) || (jQuery('#id_modulo[mod="nuevo_pregunta"]').val()==5) ) {

                                             $.each( misdatos.grupo_rango, function( key, elemento ) {
                                                  $('#multiples_btnes[mod="nuevo_pregunta"]').append('<option value="'+elemento.id_grupo+'">'+elemento.grupo_nombre+'('+elemento.rangos+')'+'</option>'); //.end();
                                             }); 

                                             //categorias 
                                             $.each( misdatos.categorias, function( key, elemento ) {
                                                  $('#multiples_categoria[mod="nuevo_pregunta"]').append('<option value="'+elemento.id+'">'+elemento.nombre+'</option>'); //.end();
                                             }); 
                                       }       


                                      $('#multiples_btnes[mod="nuevo_pregunta"]').selectpicker('refresh');
                                      $('#multiples_categoria[mod="nuevo_pregunta"]').selectpicker('refresh');


                                      

                                             


                          }
       });                     
                              
    });


    //llenar el list multiple de botones
    $('#id_tipo_pregunta[mod="nuevo_pregunta"]').on('change', function() {
      
          if ( ( jQuery('#id_tipo_pregunta[mod="nuevo_pregunta"]').val() == 4)  ||  ( jQuery('#id_tipo_pregunta[mod="nuevo_pregunta"]').val() == 5) ) {  // sel. simple y multiple

                
                url_datos = 'tipos_selectores';
                jQuery.ajax({
                                    url : '/kerma/'+url_datos,
                                    data:{
                                           id_tipo_pregunta: jQuery('#id_tipo_pregunta[mod="nuevo_pregunta"]').val(),
                                    },
                                    type : 'POST',
                                    dataType : 'json',
                                    success : function(misdatos) {

                                        $('#bloque_tipo').css('display','block');
                                        
                                         

                                        $('#tipo_seleccion[mod="nuevo_pregunta"]').
                                                  find('option')
                                                      .remove()
                                                      .end();

                                           $.each( misdatos.rango_elementos, function( key, elemento ) {
                                                $('#tipo_seleccion[mod="nuevo_pregunta"]').append('<option value="'+elemento.id_grupo+'">'+elemento.grupo_nombre+'('+elemento.rangos+')'+'</option>'); //.end();
                                           }); 

                                      $('#tipo_seleccion[mod="nuevo_pregunta"]').selectpicker('refresh');

                                    }
                 });                     
                                        
         }  else { //cuando no es selector

                      $('#tipo_seleccion[mod="nuevo_pregunta"]').
                                  find('option')
                                      .remove()
                                      .end();
                      $('#tipo_seleccion[mod="nuevo_pregunta"]').selectpicker('refresh');                
                      $('#bloque_tipo').css('display','none');

         }


    });  
    


     //guardar, nuevo de preguntas
  jQuery('body').on('submit','#form_preguntas', function (e) { 


    jQuery('#foo').css('display','block');
    var spinner = new Spinner(opts).spin(target);

      var id_btnes = [];
      $.each($(".multiples_btnes option:selected"), function(indice, valor){
        id_btnes.push($(this).val());  // .html();   .text();  .val();    //[$(this).val()]
      });


    jQuery(this).ajaxSubmit({

         data: {
                     id_btnes: JSON.stringify(id_btnes), //id_entidad.join(", ")
                 },

      success: function(data){
        if(data != true){
          
          spinner.stop();
          jQuery('#foo').css('display','none');
          jQuery('#messages').css('display','block');
          jQuery('#messages').addClass('alert-danger');
          jQuery('#messages').html(data);
          jQuery('html,body').animate({
            'scrollTop': jQuery('#messages').offset().top
          }, 1000);
        

        }else{
            $catalogo = e.target.name;
            spinner.stop();
            jQuery('#foo').css('display','none');
            window.location.href = ''+$catalogo;        
        }
      } 
    });
    return false;
  }); 



    $('#id_modulo[mod="regilla_cat_pregunta"], #id_sub_modulo[mod="regilla_cat_pregunta"], #id_botones[mod="regilla_cat_pregunta"], #id_agrupamiento[mod="regilla_cat_pregunta"], #id_rango[mod="regilla_cat_pregunta"]').on('change', function() {
      


      //datatable_preguntas.search($(this).val(), 'r.id');
              var seleccionado = jQuery(this).attr("id");   

              url_datos = 'dependencia';
              jQuery.ajax({
                          url : '/kerma/'+url_datos,
                          data:{
                                seleccionado: seleccionado,
                                // pestana: $('#pestana').val(), esta no es la pestana vieja, no la nueva cuando cambio selector
                                 id_modulo: jQuery('#id_modulo[mod="regilla_cat_pregunta"]').val(),
                             id_sub_modulo: jQuery('#id_sub_modulo[mod="regilla_cat_pregunta"]').val(),
                           id_agrupamiento: jQuery('#id_agrupamiento[mod="regilla_cat_pregunta"]').val(),
                     id_agrupamiento_campo: jQuery('#id_agrupamiento[mod="regilla_cat_pregunta"] option:selected').attr('campo'),
                          },
                          type : 'POST',
                          dataType : 'json',
                          success : function(data) {
                              if (typeof data.sub_modulos !== 'undefined') {
                                  misdatos = data.sub_modulos;      
                                  //console.log(misdatos);

                                //id_modulo   => "id_sub_modulo"                                   
                                      if (seleccionado=='id_modulo') {  //solo actualizar id_sub_modulo cuando cambie id_modulo
                                          $('#id_sub_modulo[mod="regilla_cat_pregunta"]').
                                          find('option')
                                              .remove()
                                              .end();


                                           $('#id_sub_modulo[mod="regilla_cat_pregunta"]').append('<option value="0">Todos</option>');    
                                           $.each( misdatos, function( key, elemento ) {
                                               hijos = elemento.hijos.split('|');
                                               id_hijos = elemento.id_hijos.split('|');
                                               //$('#pestana').val(elemento.pestanas);
                                              
                                               if  ((hijos)) {
                                                      $.each( hijos, function( key2, subElemento ) {
                                                          $('#id_sub_modulo[mod="regilla_cat_pregunta"]').append('<option value="'+id_hijos[key2]+'">'+subElemento+'</option>'); //.end();
                                                      });  
                                                      $('#id_sub_modulo[mod="regilla_cat_pregunta"]').selectpicker('refresh');
                                                      
                                               }                      

                                           }); 
                                           jQuery('#id_sub_modulo[mod="regilla_cat_pregunta"]').trigger('change');

                                        }   


                                 //id_sub_modulo     => "id_botones" y  "id_agrupamiento"
                                      if  ((seleccionado=='id_sub_modulo') &&  (misdatos[0])    ) {  //solo actualizar id_botones cuando cambie id_sub_modulo y tenga botones
                                       
                                         //id_botones

                                            if ( (misdatos[0].botones) &&  ($('#id_sub_modulo[mod="regilla_cat_pregunta"]').val()!=0) ) {
                                                $('.btnes').css('display','block'); 

                                                $('#id_botones[mod="regilla_cat_pregunta"]').
                                                find('option')
                                                    .remove()
                                                    .end()
                                                    .selectpicker('show');

                                                    var botones= misdatos[0].botones.replace(/`/g, '"');
                                                    botones= botones.replace(/\r?\n/g, '');  //limpiar caracteres en blanco
                                                    botones = botones.split('|');
                                                     
                                                     var id_botones = misdatos[0].id_botones.split('|');
                                                     //$('#pestana').val(elemento.pestanas);
                                                    
                                                     if  ((botones)) {
                                                          //console.log(misdatos[0]);
                                                            $('#id_botones[mod="regilla_cat_pregunta"]').append('<option value="0">Todos</option>'); 
                                                            $.each( botones, function( key2, subElemento ) {
                                                                $('#id_botones[mod="regilla_cat_pregunta"]').append('<option value="'+id_botones[key2]+'">'+subElemento+'</option>'); //.end();
                                                            });  
                                                            $('#id_botones[mod="regilla_cat_pregunta"]').selectpicker('refresh');
                                                            
                                                     }                      
                                                   jQuery('#id_botones[mod="regilla_cat_pregunta"]').trigger('change');
  
                                              } else {
                                                  $('#id_botones[mod="regilla_cat_pregunta"]').
                                                  find('option')
                                                      .remove()
                                                      .end()
                                                      .selectpicker('hide');

                                                     

                                                   $('#id_botones[mod="regilla_cat_pregunta"]').selectpicker('refresh');   
                                                   $('.btnes').css('display','none'); 
                                                    jQuery('#id_botones[mod="regilla_cat_pregunta"]').trigger('change');  //apagado

                                              }


                                              console.log(misdatos[0]);
                                              console.log($('#id_sub_modulo[mod="regilla_cat_pregunta"]').val());
                                              console.log($('#id_modulo[mod="regilla_cat_pregunta"]').val());

                                        //id_agrupamiento  //los agrupamientos solo son para los que las pestana=1 (id_modulo=3 o 5)
                                            if ( ( (misdatos[0].agrupamiento) &&  ($('#id_sub_modulo[mod="regilla_cat_pregunta"]').val()!=0) )
                                              &&  ((jQuery('#id_modulo[mod="regilla_cat_pregunta"]').val()==3) || (jQuery('#id_modulo[mod="regilla_cat_pregunta"]').val()==5))  )

                                             {  
                                                $('.agrupamiento').css('display','block'); 

                                                $('#id_agrupamiento[mod="regilla_cat_pregunta"]').
                                                find('option')
                                                    .remove()
                                                    .end()
                                                    .selectpicker('show');

                                                    /*
                                                        \r -> carriage return (retorno de carro)
                                                        \n -> Line Feed (nueva línea)
                                                        En realidad, dependiendo de la plataforma y del navegador, la representación del salto de línea puede ser \n o \r\n
                                                    */
                                                    var agrupacion= misdatos[0].agrupamiento.replace(/`/g, '"');
                                                    var agrupacion= agrupacion.replace(/\r?\n/g, '');  //limpiar caracteres en blanco
                                                      
                                                      console.log(agrupacion);

                                                  // console.log(   jQuery.parseJSON (agrupacion)    );

                                                   $('#id_agrupamiento[mod="regilla_cat_pregunta"]').append('<option value="0">Todos</option>'); 

                                                   var grupo = [];
                                                   jQuery.each( jQuery.parseJSON (agrupacion), function( key, elemento ) {
                                                              
                                                            
                                                           if (elemento.id_grupo==-1) {

                                                                    $('#id_agrupamiento[mod="regilla_cat_pregunta"]').append('<option campo="rch.id" campo_orig="id_rango"  value="'+elemento.id_rango+'">'+elemento.nombre_rango+'</option>'); //.end();

                                                            } else {

                                                                    if  ( grupo.find( item => item.nombre_grupo == elemento.nombre_grupo) == undefined  ) {
                                                                              grupo.push(elemento);
                                                                              $('#id_agrupamiento[mod="regilla_cat_pregunta"]').append('<option campo="gch.id"  campo_orig="id_grupo" value="'+elemento.id_grupo+'">'+elemento.nombre_grupo+'</option>'); //.end();
                                                                    }
                                                            }
    
                                 
                                                   });
                                                   
                                                   $('#id_agrupamiento[mod="regilla_cat_pregunta"]').selectpicker('refresh'); 
                                                   jQuery('#id_agrupamiento[mod="regilla_cat_pregunta"]').trigger('change');
                                                                     


                                              } else {
                                                  $('#id_agrupamiento[mod="regilla_cat_pregunta"]').
                                                  find('option')
                                                      .remove()
                                                      .end()
                                                      .selectpicker('hide');

                                                     

                                                   $('#id_agrupamiento[mod="regilla_cat_pregunta"]').selectpicker('refresh');   
                                                   $('.agrupamiento').css('display','none'); 
                                                   jQuery('#id_agrupamiento[mod="regilla_cat_pregunta"]').trigger('change');  //apagado

                                              }


                                        } else {  //cuando id_sub_modulo=0

                                          if  (seleccionado=='id_sub_modulo') {
                                               //alert('asd');

                                               $('#id_botones[mod="regilla_cat_pregunta"]').
                                                      find('option')
                                                          .remove()
                                                          .end()
                                                          .selectpicker('hide');

                                                         

                                                       $('#id_botones[mod="regilla_cat_pregunta"]').selectpicker('refresh');   
                                                       $('.btnes').css('display','none'); 
                                                       jQuery('#id_botones[mod="regilla_cat_pregunta"]').trigger('change');  //apagado



                                               $('#id_agrupamiento[mod="regilla_cat_pregunta"]').
                                                      find('option')
                                                          .remove()
                                                          .end()
                                                          .selectpicker('hide');

                                                         

                                                       $('#id_agrupamiento[mod="regilla_cat_pregunta"]').selectpicker('refresh');   
                                                       $('.agrupamiento').css('display','none'); 
                                                       jQuery('#id_agrupamiento[mod="regilla_cat_pregunta"]').trigger('change');  //apagado

                                           }            
                                        }  
                                        



                                  //id_agrupamiento     => "id_rango" 
                                      if  ((seleccionado=='id_agrupamiento') &&  (misdatos[0])    ) {    //solo actualizar id_rango cuando cambie id_sub_modulo y tenga botones
                                           
                                            if ((misdatos[0].agrupamiento) &&  ($('#id_agrupamiento[mod="regilla_cat_pregunta"]').val()!=0) ) {
                                                  $('.rango').css('display','block'); 

                                                  $('#id_rango[mod="regilla_cat_pregunta"]').
                                                  find('option')
                                                      .remove()
                                                      .end()
                                                      .selectpicker('show');

                                                      var agrupacion= misdatos[0].agrupamiento.replace(/`/g, '"');
                                                      var agrupacion= agrupacion.replace(/\r?\n/g, '');
                                                    
                                                     $('#id_rango[mod="regilla_cat_pregunta"]').append('<option value="0">Todos</option>'); 

                                                     var i = 0;
                                                   jQuery.each( jQuery.parseJSON (agrupacion), function( key, elemento ) {
                                                        if ((elemento.id_grupo!=-1) && (elemento.id_rango!=-1) )  {
                                                             // console.log(elemento);
                                                              i++;
                                                              $('#id_rango[mod="regilla_cat_pregunta"]').append('<option campo="rch.id" campo_orig="id_rango" value="'+elemento.id_rango+'">'+elemento.nombre_rango+'</option>'); //.end();
                                                        }  
                                                   });

                                                   //console.log(grupo);
                                                   if (i>0) {
                                                          $('#id_rango[mod="regilla_cat_pregunta"]').selectpicker('refresh'); 
                                                          jQuery('#id_rango[mod="regilla_cat_pregunta"]').trigger('change');
                                                   } else {  //para el caso de ofCourse

                                                         $('#id_rango[mod="regilla_cat_pregunta"]').
                                                        find('option')
                                                            .remove()
                                                            .end()
                                                            .selectpicker('hide');

                                                           

                                                       $('#id_rango[mod="regilla_cat_pregunta"]').selectpicker('refresh');   
                                                       $('.rango').css('display','none'); 
                                                       jQuery('#id_rango[mod="regilla_cat_pregunta"]').trigger('change');  //apagado
                                                   }
                                                                     


                                              } else {

                                                  $('#id_rango[mod="regilla_cat_pregunta"]').
                                                  find('option')
                                                      .remove()
                                                      .end()
                                                      .selectpicker('hide');

                                                     

                                                   $('#id_rango[mod="regilla_cat_pregunta"]').selectpicker('refresh');   
                                                   $('.rango').css('display','none'); 
                                                   jQuery('#id_rango[mod="regilla_cat_pregunta"]').trigger('change');  //apagado

                                              }


                                        } else {  //cuando id_agrupamiento = 0
                                           if  (seleccionado=='id_agrupamiento') {
                                            
                                              $('#id_rango[mod="regilla_cat_pregunta"]').
                                                    find('option')
                                                        .remove()
                                                        .end()
                                                        .selectpicker('hide');

                                                       

                                                     $('#id_rango[mod="regilla_cat_pregunta"]').selectpicker('refresh');   
                                                     $('.rango').css('display','none'); 
                                                     jQuery('#id_rango[mod="regilla_cat_pregunta"]').trigger('change');  //apagado
                                            }         
                                        }  
                                        




                                        var campo= $('#id_agrupamiento[mod="regilla_cat_pregunta"] option:selected').attr('campo');
                                        var rango= $('#id_rango[mod="regilla_cat_pregunta"] option:selected').attr('campo');

                                         //if ($('#pestana').val()=="0") 
                                         if ((jQuery('#id_modulo[mod="regilla_cat_pregunta"]').val()!=3) && (jQuery('#id_modulo[mod="regilla_cat_pregunta"]').val()!=5)) {
                                              
                                              datatable_preguntas.setDataSourceParam('query',
                                                 {
                                                  'id_modulo': jQuery('#id_modulo[mod="regilla_cat_pregunta"]').val(),
                                                  'r.id_encabezado_pregunta': jQuery('#id_sub_modulo[mod="regilla_cat_pregunta"]').val(),
                                                  
                                                  'gch.id': jQuery('#id_botones[mod="regilla_cat_pregunta"]').val() ? jQuery('#id_botones[mod="regilla_cat_pregunta"]').val() : 0,
                                                   // 'pestana': jQuery('#pestana').val(), 
                                                  }
                                               );
                                           }  else {
                                               datatable_preguntas.setDataSourceParam('query', 
                                                            {
                                                              'id_modulo': jQuery('#id_modulo[mod="regilla_cat_pregunta"]').val(),
                                                               'cch.id': jQuery('#id_sub_modulo[mod="regilla_cat_pregunta"]').val(),
                                                              
                                                              'e.id': jQuery('#id_botones[mod="regilla_cat_pregunta"]').val() ? jQuery('#id_botones[mod="regilla_cat_pregunta"]').val() : 0,
                                                              //'pestana': jQuery('#pestana').val(),
                                                                [campo] : jQuery('#id_agrupamiento').val(),
                                                                [rango] : jQuery('#id_rango').val(),
                                                            }
                                              );
                                         }

                                        datatable_preguntas.reload();




                              }  
                            
                          } 
             }); 



    });

    //dibujar los elementos de filtros como un selector
    $('#id_modulo[mod="regilla_cat_pregunta"], #id_sub_modulo[mod="regilla_cat_pregunta"]').selectpicker(); //


    /*$('#id_modulo[mod="regilla_cat_pregunta"]').trigger('change');
    $('#id_sub_modulo[mod="regilla_cat_pregunta"]').trigger('change');
    */


  var opts = {
    lines: 13, 
    length: 20, 
    width: 10, 
    radius: 30, 
    corners: 1, 
    rotate: 0, 
    direction: 1, 
    color: '#E8192C',
    speed: 1, 
    trail: 60,
    shadow: false,
    hwaccel: false,
    className: 'spinner',
    zIndex: 2e9, 
    top: '50%', // Top position relative to parent
    left: '50%' // Left position relative to parent   
  };

  
  jQuery(".navigacion").change(function() {
      document.location.href = jQuery(this).val();
  });

    var target = document.getElementById('foo');




});

