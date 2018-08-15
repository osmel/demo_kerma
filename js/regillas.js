jQuery(document).ready(function() {

//////////////////////////////////////////
    //var hash_url =  window.location.protocol+'//'+window.location.hostname+'/kerma/'; 

    
    var pathArray = window.location.pathname.split( '/' );

    //este es para cuando entre a un detalle
          switch (pathArray[2]) {
             case "informacion_general":  // pude ser multiple "informacion_general", "saeed", "larry": 
                    url_datos = 'leer_datos_general';
                 break;

             default: 
                   url_datos = '';
                 break;
          }

        if (pathArray[3])  {
              jQuery.ajax({
                          url : '/kerma/'+url_datos,
                          data:{
                             id_entidad: jQuery('#id_entidad_encabezado').val(),
                                 id_ano: jQuery('#id_ano').val(),
                             id_periodo: jQuery('#id_periodo').val(),

                          },

                          type : 'POST',
                          dataType : 'json',
                          success : function(data) {
                             if (data.datos) {
                                      jQuery.each( data.datos, function(campo, valor){
                                        jQuery('#'+campo).val(valor);
                                      });
                             }
                          } 
             }); 

        }

    jQuery('body').on('change', '#id_entidad_encabezado, #id_ano_encabezado, #id_periodo_encabezado', function(){
          switch (pathArray[2]) {
             case "informacion_general":  // pude ser multiple "informacion_general", "saeed", "larry": 
                    url_datos = 'leer_datos_general';
                 break;

             default: 
                   url_datos = 'leer_datos';
                 break;
          }

          jQuery.ajax({
                url : '/kerma/'+url_datos,
                data:{
                   id_entidad: jQuery('#id_entidad_encabezado').val(),
                       id_ano: jQuery('#id_ano').val(),
                   id_periodo: jQuery('#id_periodo').val(),

                },

                type : 'POST',
                dataType : 'json',
                success : function(data) {
                   if (data.datos) {
                            jQuery.each( data.datos, function(campo, valor){
                              jQuery('#'+campo).val(valor);

                            });
                   }
                } 
          });   

  });

    

    jQuery('body').on('click', '#button_sig', function(){
         window.location.href = '/kerma/'+pathArray[2];        
     }); 



   //jQuery("#foco_costo").focusout(function (e) {
   jQuery('body').on('focusout', 'input', function(){  //o blur que no se propaga , focusout no se propaga
        

        campo = jQuery(this).attr('id'); 
        valor = jQuery(this).val(); 
        //alert( jQuery(this).attr('id') );

         switch (pathArray[2]) {
             case "informacion_general":  // pude ser multiple "informacion_general", "saeed", "larry": 
                    url_datos = 'actualizar_datos_general';
                 break;

             default: 
                   url_datos = '';
                 break;
        }


         jQuery.ajax({
                url : '/kerma/'+url_datos,
                data:{
                   id_entidad: jQuery('#id_entidad_encabezado').val(),
                       id_ano: jQuery('#id_ano').val(),
                   id_periodo: jQuery('#id_periodo').val(),
                          campo : campo,
                          valor : valor,

                },

                type : 'POST',
                dataType : 'json',
                success : function(data) {

                  console.log(data);


                } 
          });   



      
   });




   //cambiando valores en los campos por select
   jQuery('body').on('change', 'select[tipo="7"], select[tipo="8"]', function(){  //o blur que no se propaga , focusout no se propaga
        campo = jQuery(this).attr('id'); 
        valor = jQuery(this).val(); 
         switch (pathArray[2]) {
             case "informacion_general":  // pude ser multiple "informacion_general", "saeed", "larry": 
                    url_datos = 'actualizar_datos_general';
                 break;

             default: 
                   url_datos = '';
                 break;
        }


         jQuery.ajax({
                url : '/kerma/'+url_datos,
                data:{
                   id_entidad: jQuery('#id_entidad_encabezado').val(),
                       id_ano: jQuery('#id_ano').val(),
                   id_periodo: jQuery('#id_periodo').val(),
                          campo : campo,
                          valor : valor,

                },

                type : 'POST',
                dataType : 'json',
                success : function(data) {

                  console.log(data);


                } 
          });   
      
   });



//////////////////////////////entidades

 var datatable_entidades = $('.tabla_entidades').mDatatable({
      // datasource definition
      data: {
        type: 'remote', //Obligatorio.Establecer tipo remote para obtener datos remotos de una URL pública
        source: {
          read: {
            url : '/kerma/procesando_entidades',
            method: 'POST',  //Método de petición para la solicitud ajax
            
            params: { //objeto de parámetros que se envia al server
                valor:new Date(), //  $('#id_perfil[mod="regilla"] option:selected').text(), //'uno',

            },
            map: function(raw) {  //Mapear los datos recibidos en la regilla. Todavía no se conque objetivo mapeo
              // sample data mapping
              var dataSet = raw;
              if (typeof raw.data !== 'undefined') {
                dataSet = raw.data;
                //console.log(dataSet);
              }
              return dataSet;
            },
          },
        },
        pageSize: 10,            //Cantidad de registros por paginas
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
        height: 550, // datatable's body's fixed height
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
          field: 'nombre',
          title: 'Nombre de la firma',
          filterable: false, // disable or enable filtering
          template: '{{nombre}}',
        },

        {
          field: 'id_estado',
          title: 'Estado',
         // filterable: false, // deshabilitar o habilitar filtro
          // callback function support for column rendering
          template: function(row) {
            var status = {
              1: {'titulo': row.estado, 'clase': 'm-badge--brand'},
              2: {'titulo': row.estado, 'clase': ' m-badge--metal'},
            };
            return  '<span class="m-badge ' + status[row.id_estado].clase + ' m-badge--wide">' + status[row.id_estado].titulo + '</span>';
          },
        },

        {
          field: 'cp',
          title: 'CP',
          filterable: false, // disable or enable filtering
          template: '{{cp}}',
        },

        {
          field: 'id_tipo_entidad',
          title: 'Tipo de Firma',
         // filterable: false, // deshabilitar o habilitar filtro
          // callback function support for column rendering
          template: function(row) {
            var status = {
              1: {'titulo': row.tipo_entidad, 'clase': 'm-badge--brand'},
              2: {'titulo': row.tipo_entidad, 'clase': ' m-badge--metal'},
            };
            return  '<span class="m-badge ' + status[row.id_tipo_entidad].clase + ' m-badge--wide">' + status[row.id_tipo_entidad].titulo + '</span>';
          },
        },


       {
          field: 'fecha',
          title: 'fecha',
          type: 'date',  //tipo 
          format: 'MM/DD/YYYY', //formato
        },        

         {
          field: 'email',
          title: 'Email',
          // sortable: 'asc', // default sort
          filterable: false, // disable or enable filtering
          //width: 150,
          // basic templating support for column rendering,
          template: '{{email}}',
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



/////////Filtros

    //cuando cambie en el filtro el id_tipo_entidad y id_estado, se actualiza la tabla con el elemento a buscar 
    $('#id_tipo_entidad[mod="regilla_entidad"]').on('change', function() {
      datatable_entidades.search($(this).val(), 'id_tipo_entidad');
    });

    $('#id_estado[mod="regilla_entidad"]').on('change', function() {
      datatable_entidades.search($(this).val(), 'id_estado');
    });

    //dibujar los elementos de filtros como un selector
    $('#id_tipo_entidad[mod="regilla_entidad"], #id_estado[mod="regilla_entidad"]').selectpicker();


////////////editar 1 entidad



/////////eliminar 1 sola entidad

    $('body').on('click', '#eliminar_entidad[data-toggle="modal"]', function(){
            //alert( $(this).data("target")+' .modal-content' );
            $($(this).data("target")+' .modal-content').load($(this).data("remoto"));
    });


  //gestion de usuarios (crear, editar y eliminar )
  jQuery('body').on('submit','#form_entidades22', function (e) { 


    jQuery('#foo').css('display','block');
    var spinner = new Spinner(opts).spin(target);
    /*
      var id_entidad = [];
      $.each($(".multiples_empresas option:selected"), function(indice, valor){
        id_entidad.push($(this).val());  // .html();   .text();  .val();    //[$(this).val()]
      });*/


    jQuery(this).ajaxSubmit({

         data: {
                     id_entidad: "no", // JSON.stringify(id_entidad), //id_entidad.join(", ")
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



  //gestion de usuarios (crear, editar y eliminar )
  jQuery('body').on('submit','#form_entidades', function (e) { 


    jQuery('#foo').css('display','block');
    var spinner = new Spinner(opts).spin(target);

      var id_usuario = [];
      $.each($(".multiples_usuarios option:selected"), function(indice, valor){
        id_usuario.push($(this).val());  // .html();   .text();  .val();    //[$(this).val()]
      });


    jQuery(this).ajaxSubmit({

         data: {
                     id_usuarios: JSON.stringify(id_usuario), //id_entidad.join(", ")
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






////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////


////////////////////////////usuarios



 var datatable_usuarios = $('.tabla_usuarios').mDatatable({
      // datasource definition
      data: {
        type: 'remote', //Obligatorio.Establecer tipo remote para obtener datos remotos de una URL pública
        source: {
          read: {
            url : '/kerma/procesando_usuarios',
            method: 'POST',  //Método de petición para la solicitud ajax
            
            params: { //objeto de parámetros que se envia al server
                valor:new Date(), //  $('#id_perfil[mod="regilla"] option:selected').text(), //'uno',

            },
            map: function(raw) {  //Mapear los datos recibidos en la regilla. Todavía no se conque objetivo mapeo
              // sample data mapping
              var dataSet = raw;
              if (typeof raw.data !== 'undefined') {
                dataSet = raw.data;
                //console.log(dataSet);
              }
              return dataSet;
            },
          },
        },
        pageSize: 10,            //Cantidad de registros por paginas
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
        //theme: 'default', // datatable theme
        //class: '', // custom wrapper class
        height: 550, // datatable's body's fixed height
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
        /*{
          field: 'id',
          title: '#',
          sortable: false, // disable sort for this column
          width: 40,
          selector: false,
          textAlign: 'center',
        },*/

    {
        field: 'id',
        title: '#',
        sortable: false,
        width: 40,
        textAlign: 'center',
        selector: {class: 'm-checkbox--solid m-checkbox--brand'},
      },
      /* {
        field: 'ID',
        title: 'ID',
        width: 40,
        template: '{{id}}',
      },*/ 

         {
          field: 'nombre',
          title: 'Usuario',
          //sortable: false,
          // sortable: 'asc', // default sort
          filterable: false, // disable or enable filtering
          //width: 150,
          // basic templating support for column rendering,
          template: '{{nombre}} - {{apellidos}}',
        },

        {
          field: 'entidad',
          title: 'Entidad',
          //sortable: false,
          // sortable: 'asc', // default sort
          filterable: false, // disable or enable filtering
          //width: 150,
          // basic templating support for column rendering,
          template: '{{entidad}}',
        },

         /*
         {
          field: 'perfil',  //nombre como se va a manejar la columna
          title: 'Perfil',  //titulo
          // sortable: 'asc', // orden por defecto
          filterable: false, // deshabilitar o habilitar filtro
          //width: 150, //ancho de la columna
          template: '{{perfil}}', // soporte de plantillas básicas para la renderizacion de columnas
        },*/


        {
          field: 'id_perfil',
          title: 'Perfil',
         // filterable: false, // deshabilitar o habilitar filtro
          // callback function support for column rendering
          template: function(row) {
            var status = {
              1: {'titulo': row.perfil, 'clase': 'm-badge--brand'},
              2: {'titulo': row.perfil, 'clase': ' m-badge--metal'},
              3: {'titulo': row.perfil, 'clase': ' m-badge--warning'},
              4: {'titulo': row.perfil, 'clase': ' m-badge--success'},
              5: {'titulo': row.perfil, 'clase': ' m-badge--info'},
              6: {'titulo': row.perfil, 'clase': ' m-badge--danger'},
              
            };
            return  '<span class="m-badge ' + status[row.id_perfil].clase + ' m-badge--wide">' + status[row.id_perfil].titulo + '</span>';
          },
        },


       {
          field: 'fecha',
          title: 'fecha',
          type: 'date',  //tipo 
          format: 'MM/DD/YYYY', //formato
        },        

         {
          field: 'email',
          title: 'Email',
          // sortable: 'asc', // default sort
          filterable: false, // disable or enable filtering
          //width: 150,
          // basic templating support for column rendering,
          template: '{{email}}',
        },         

        /*
        {
          field: 'otra',
          title: 'otra',
          attr: {nowrap: 'nowrap'},
          //width: 150,
          template: function(row) { //// función callback  soportada para la  renderización de columna
            return row.nombre + ' - ' + row.nombre;
          },

        },*/  


      {
          field: 'Actions',
          //width: 110,
          title: 'Comportamiento',
          sortable: false,
          overflow: 'visible',
          template: function (row, index, datatable) {
            return '\
            <a href="/kerma/editar_usuario/'+jQuery.base64.encode(row.id)+'" class="m-portlet__nav-link btn m-btn m-btn--hover-accent m-btn--icon m-btn--icon-only m-btn--pill" title="Edit details">\
              <i class="la la-edit"></i>\
            </a>\
            <a \
             id="eliminar_usuario" class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" title="Eliminar"\
             data-remoto="/kerma/eliminar_usuario/'+jQuery.base64.encode(row.id)+'/'+jQuery.base64.encode(row.nombre+' '+row.apellidos)+ '"\
               data-toggle="modal" data-target="#m_modal_1" >\
              <i class="la la-trash"></i>\
            </a>\
          ';
          },
        }        


        ],
    });


    $('body').on('click', '#eliminar_usuario[data-toggle="modal"]', function(){
            $($(this).data("target")+' .modal-content').load($(this).data("remoto"));
    });

    
    //cuando cambie en el filtro el id_perfil, se actualiza la tabla con el elemento a buscar 
    $('#id_perfil[mod="regilla"]').on('change', function() {
      datatable_usuarios.search($(this).val(), 'id_perfil');
    });

    $('#id_entidad').on('change', function() {
      datatable_usuarios.search($(this).val(), 'id_entidad');
    });

    //dibujar los elementos de filtros como un selector
    $('#id_perfil, #id_entidad').selectpicker();

 

    //Cuando da click en el checkbox de la 1ra fila
    
     //datatable_usuarios.on('m-datatable--on-click-checkbox m-datatable--on-layout-updated', function(e) {
     $('.tabla_usuarios').on('m-datatable--on-click-checkbox m-datatable--on-layout-updated', function(e) {
          // datatable.checkbox() access to extension methods
          var ids = datatable_usuarios.checkbox().getSelectedId();   //datatable.checkbox() esta declarada en la funcion checkbox
          var cantidad_seleccion = ids.length;
          $('#etiqueta_selector_multiple_registro').html(cantidad_seleccion);  //para poner la cantidad de registros seleccionados
          if (cantidad_seleccion > 0) {
            $('#selector_multiple_registro').collapse('show');
          } else {
            $('#selector_multiple_registro').collapse('hide');
          }
    });

    
    //para la modala de mostrar todos los ids seleccionados
     $('#modal_obtener_registro_seleccionado').on('show.bs.modal', function(e) {
      var ids = datatable_usuarios.checkbox().getSelectedId();
      var c = document.createDocumentFragment();
      for (var i = 0; i < ids.length; i++) {
        var li = document.createElement('li');
        li.setAttribute('data-id', ids[i]);
        li.innerHTML = 'Selected record ID: ' + ids[i];
        c.appendChild(li);
      }
      $(e.target).find('.m_datatable_selected_ids').append(c);
    }).on('hide.bs.modal', function(e) {
      $(e.target).find('.m_datatable_selected_ids').empty();
    });


////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
   //filtro de cambio multiple
    //Previo para poner "cantidad de registro" y saber cual es el "id_perfil"
    $('.cambio_multiple_perfil').on('click', function() {  
        $('.cambio_multiple_perfil').attr('activo',$(this).attr('valor'));
         var ids = datatable_usuarios.checkbox().getSelectedId();
         var cantidad= ids.length;
         $('.etiq_num_registro').html(cantidad);
    });



  //cuando acepta la modal de cambiar multiples perfiles   
  $('#aceptar_multiple_perfil').on('click', function() {  
        //console.log('aaa');
      var ids = datatable_usuarios.checkbox().getSelectedId();
      jQuery.ajax({
            url : '/kerma/cambiar_multiples_perfiles',
            data:{
              ids:JSON.stringify(ids),
              id_perfil:$('.cambio_multiple_perfil').attr('activo'),
            },

            type : 'POST',
            dataType : 'json',
            success : function(data) {
              if(data.exito == true){
                   console.log(data);
                  $("#modal_cambiar_multiple_perfil").modal('hide');
                  datatable_usuarios.reload();
                  //window.location.href = '/kerma/usuarios'; 
                  return false;
              } else {
                alert(data.exito);
              }

            } 
      });      
  }); 

////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////Eliminando multiple//////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
   

    //Previo para poner "cantidad de registro" 
    $('.eliminar_usuario_multiple').on('click', function() {  
         var ids = datatable_usuarios.checkbox().getSelectedId();
         var cantidad= ids.length;
         $('.etiq_num_registro').html(cantidad);
    });



  //cuando acepta la modal de eliminar multiples usuarios
  $('#aceptar_multiple_eliminar').on('click', function() {  
        //console.log('aaa');
      var ids = datatable_usuarios.checkbox().getSelectedId();
      jQuery.ajax({
            url : '/kerma/eliminar_multiples_usuarios',
            data:{
              ids:JSON.stringify(ids),
            },
            type : 'POST',
            dataType : 'json',
            success : function(data) {
              if(data.exito == true){
                   console.log(data);
                  
                  $("#modal_eliminar_usuario_multiple").modal('hide');
                  datatable_usuarios.reload();
                  return false;

                  //datatable.clearSelection(); unselect
                  //datatable.reload();
                     //datatable.find('thead input[type=checkbox]').removeAttr('checked');
                     //$(".tabla_usuarios > m-checkbox > input[type=checkbox]").attr('checked', false);
                     //datatable.uniform.update();
                     
                 // window.location.href = '/kerma/usuarios'; //aqui tuve que refrescar la pagina, porque no se quitaba los checked
                  
              } else {
                alert(data.exito);
              }

            } 
      });      
  }); 
  







////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
///////////////////////Historico de accesos//////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////

  var datatable_accesos = $('.tabla_historico_acceso').mDatatable({
      // datasource definition
      data: {
        type: 'remote', //Obligatorio.Establecer tipo remote para obtener datos remotos de una URL pública
        source: {
          read: {
            url : '/kerma/procesando_historico_accesos',
            method: 'POST',  //Método de petición para la solicitud ajax
            
            params: { //objeto de parámetros que se envia al server
                valor:'uno',
            },
            map: function(raw) {  //Mapear los datos recibidos en la regilla. Todavía no se conque objetivo mapeo
              // sample data mapping
              var dataSet = raw;
              if (typeof raw.data !== 'undefined') {
                dataSet = raw.data;
                //console.log(dataSet);
              }
              return dataSet;
            },
          },
        },
        pageSize: 10,            //Cantidad de registros por paginas
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
        //theme: 'default', // datatable theme
        //class: '', // custom wrapper class
        height: 550, // datatable's body's fixed height
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



      // columns definition
      columns: [


         {
          field: 'nombre',
          title: 'Usuario',
          filterable: false, // disable or enable filtering
          template: '{{nombre}} - {{apellidos}}',
        },

        {
          field: 'id_perfil',
          title: 'Perfil',
         // filterable: false, // deshabilitar o habilitar filtro
          // callback function support for column rendering
          template: function(row) {
            var status = {
              1: {'titulo': row.perfil, 'clase': 'm-badge--brand'},
              2: {'titulo': row.perfil, 'clase': ' m-badge--metal'},
              3: {'titulo': row.perfil, 'clase': ' m-badge--warning'},
              4: {'titulo': row.perfil, 'clase': ' m-badge--success'},
              5: {'titulo': row.perfil, 'clase': ' m-badge--info'},
              6: {'titulo': row.perfil, 'clase': ' m-badge--danger'},
              
            };
            return  '<span class="m-badge ' + status[row.id_perfil].clase + ' m-badge--wide">' + status[row.id_perfil].titulo + '</span>';
          },
        },


       {
          field: 'fecha',
          title: 'fecha',
          type: 'date',  //tipo 
          format: 'MM/DD/YYYY', //formato
        },        

         {
          field: 'email',
          title: 'Email',
          // sortable: 'asc', // default sort
          filterable: false, // disable or enable filtering
          //width: 150,
          // basic templating support for column rendering,
          template: '{{email}}',
        },         

      /*


      {
          field: 'Actions',
          //width: 110,
          title: 'Comportamiento',
          sortable: false,
          overflow: 'visible',
          template: function (row, index, datatable) {
            return '\
            <a \
             id="eliminar_usuario" class="m-portlet__nav-link btn m-btn m-btn--hover-danger m-btn--icon m-btn--icon-only m-btn--pill" title="Eliminar"\
             data-remoto="/kerma/eliminar_historico_usuario/'+jQuery.base64.encode(row.id)+'/'+jQuery.base64.encode(row.nombre+' '+row.apellidos)+ '"\
               data-toggle="modal" data-target="#m_modal_1" >\
              <i class="la la-trash"></i>\
            </a>\
          ';
          },
        }        */


        ],
    });





//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////dashboard_usuarios////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////  


  


            //datatable_modal_usuarios.search(jQuery('#categoria_seleccionada').val(), 'id_perfil');


            /*
            https://keenthemes.com/forums/topic/change-datasource-parameters-and-refresh-datatable/
            var datatable = $ (m_datatable) .mDatatable (); 
            datatable.setDataSourceParam ('encabezados', {id: 123}); 
            datatable.reload ();
            */    
          //datatable_modal_usuarios.setDataSourceParam ('valor', {id: jQuery('#categoria_seleccionada').val() }); 

      
     /*
      var ids = datatable_modal_usuarios.checkbox().getSelectedId();
      var c = document.createDocumentFragment();
      for (var i = 0; i < ids.length; i++) {
        var li = document.createElement('li');
        li.setAttribute('data-id', ids[i]);
        li.innerHTML = 'Selected record ID: ' + ids[i];
        c.appendChild(li);
      }
      $(e.target).find('.m_datatable_selected_ids').append(c);



          var arreglo_peso = [];
          var arreglo = {};

         jQuery("#tabla_detalle tbody tr td input.peso_real").each(function(e) {
            arreglo = {};
            arreglo["codigo"] = jQuery(this).attr('codigo') ;  
            arreglo['peso_real'] = jQuery(this).val();
            arreglo_peso.push( arreglo);
         });
         */

//cuando cambie en el filtro el id_perfil, se actualiza la tabla con el elemento a buscar 
    //$('#id_perfil[mod="regilla"]').on('change', function() {
      
    //});

  /*arreglo["codigo"] = jQuery(this).attr('codigo') ;  
            arreglo['peso_real'] = jQuery(this).val();
            arreglo_lectura.push( arreglo);
            */
            //console.log(  jQuery(this).find(' td[data-field="lectura"]  input').attr('type')   );
            //console.log(  jQuery(this).find('td[data-field="nombre"]  span').text()   );

//var ids = datatable_modal_usuarios.getRecords();
//var datatable_modal_usuarios = jQuery('body').on('mDatatable', '.tabla_modal_usuarios',{  


    //click aceptar en la modal
    jQuery('body').on('click', 'button.btn_aceptar_modal', function(){
          var arreglo_general = [];
          var arreglo = {};

          jQuery('.tabla_modal_usuarios table tbody tr').each(function(e) {
              arreglo = {};
                //arreglo['nombre'] = jQuery(this).find('td[data-field="nombre"]  span').text();
                   arreglo['lectura'] = jQuery(this).find(' td[data-field="lectura"] input').prop('checked') ? 1 : 0;
                arreglo['escritura'] = jQuery(this).find(' td[data-field="escritura"] input').prop('checked') ? 2 : 0;

                arreglo['id_usuario'] = jQuery(this).find(' td[data-field="escritura"] input').attr('identificador');
                  arreglo['id_modulo'] = jQuery('#categoria_seleccionada').val();
                   
                arreglo_general.push( arreglo);
         });


          jQuery.ajax({
              url : '/kerma/actualizar_roles',
              data:{
                arreglo_general:arreglo_general, //JSON.stringify(arreglo_general),
              },

              type : 'POST',
              dataType : 'json',
              success : function(data) {
                if(data.exito == true){
                     //console.log(data);
                } else {
                 
                }

                jQuery('#modal_usuarios').modal('hide');
                return false;

              } 
        });      


      //console.log(arreglo_lectura);

    });     

  //click para abrir la modal  
  jQuery('body').on('click', 'button[data-target="#modal_usuarios"]', function(){
            //$($(this).data("target")+' .modal-content').load($(this).data("remoto"));
            //alert( jQuery(this).attr('categoria')   );
            //quitar todos los activos
            jQuery('button[data-target="#modal_usuarios"]').removeClass('activo');
            //poner activo al q cliqueo
            jQuery(this).addClass('activo');

            jQuery('#categoria_seleccionada').val(  jQuery(this).attr('categoria') );

             datatable_modal_usuarios.setDataSourceParam ('id_modulo', jQuery('#categoria_seleccionada').val() ); 
            datatable_modal_usuarios.reload();
    });


//var datatable_modal_usuarios = 
var datatable_modal_usuarios = jQuery('.tabla_modal_usuarios').mDatatable({
      // datasource definition
      data: {
        type: 'remote', //Obligatorio.Establecer tipo remote para obtener datos remotos de una URL pública
        saveState: {
            cookie : false, //para que las variables no se guarden en una cookie, el valor por defecto es true
            webstorage : false,
          },
        source: {
          read: {
            url : '/kerma/procesando_modal_usuarios',
            method: 'POST',  //Método de petición para la solicitud ajax
            
            params: { //objeto de parámetros que se envia al server
                //esto es un valor fijo, para cambiarlo dinamicamente usar "setDataSourceParam" y poner webstorage y cookie a false, para q no guarde
                //id_modulo: jQuery('#categoria_seleccionada').val(),
                    //jQuery('button[data-target="#modal_usuarios"].activo').attr('categoria'), 
                
            },
            map: function(raw) {  //Mapear los datos recibidos en la regilla. Todavía no se conque objetivo mapeo
              // sample data mapping
               //alert(jQuery('button[data-target="#modal_usuarios"].activo').attr('categoria'));
              var dataSet = raw;
              if (typeof raw.data !== 'undefined') {
                dataSet = raw.data;
                //console.log(dataSet);
              }
              return dataSet;
            },
          },
        },
        pageSize: 10,            //Cantidad de registros por paginas
        serverPaging: true,     //Habilitar/deshabilitar la paginación en el lado del servidor.
        serverFiltering: true,  //Habilitar/deshabilitar el filtrado en el lado del servidor.
        serverSorting: true,    //Habilitar/deshabilitar la ordenación en el lado del servidor
        processing: true,
        serverSide: true,
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
        //theme: 'default', // datatable theme
        //class: '', // custom wrapper class
        height: 550, // datatable's body's fixed height
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
          field: 'lectura',
          title: "lectura", //#
          //sortable: false,
         // width: 20,
          //textAlign: 'center',
         
           template: function(row) {
            var check = {
              0: {'seleccion': ''},
              1: {'seleccion': 'checked'},
            };

              //resultado = '<span style="width: 110px;">'
              //resultado +=   '<label class="m-checkbox m-checkbox--single m-checkbox--solid m-checkbox--brand">';
              resultado =      '<input type="checkbox" value="" ' + check[row.lectura].seleccion + '>';
              //resultado +=          '<span></span>';
              //resultado += '</label>';
              //resultado += '</span>';

          return resultado;            
            
          },
        },
        
        {
          field: 'escritura',
          title: "escritura", 
         // width: 20,
           template: function(row) {
            var check = {
              0: {'seleccion': '', 'id': row.id},
              1: {'seleccion': 'checked', 'id': row.id},
            };
              //resultado = '<span style="width: 110px;">'
              //resultado +=   '<label class="m-checkbox m-checkbox--single m-checkbox--solid m-checkbox--brand">';
              resultado =      '<input identificador="' + check[row.escritura].id + '" type="checkbox" value="" ' + check[row.escritura].seleccion + '>';
              //resultado +=          '<span></span>';
              //resultado += '</label>';
              //resultado += '</span>';

          return resultado;            
            
          },
        },         

        {
          field: 'nombre',
          title: 'Usuario',
          //sortable: false,
          // sortable: 'asc', // default sort
          filterable: false, // disable or enable filtering
          //width: 30,
          // basic templating support for column rendering,
          template: '{{nombre}} - {{apellidos}}',
        }, 
        {
          field: 'id_perfil',
          title: 'Perfil',
          //width: 30,
          template: function(row) {
            var status = {
              1: {'titulo': row.perfil, 'clase': 'm-badge--brand'},
              2: {'titulo': row.perfil, 'clase': ' m-badge--metal'},
              3: {'titulo': row.perfil, 'clase': ' m-badge--warning'},
              4: {'titulo': row.perfil, 'clase': ' m-badge--success'},
              5: {'titulo': row.perfil, 'clase': ' m-badge--info'},
              6: {'titulo': row.perfil, 'clase': ' m-badge--danger'},
            };
            return  '<span class="m-badge ' + status[row.id_perfil].clase + ' m-badge--wide">' + status[row.id_perfil].titulo + '</span>';
          },
        },
        ],
    });





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


