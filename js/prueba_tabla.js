//== Class definition

var DatatableRemoteAjaxDemo = function() {
  //== Private functions

  // basic demo
  var claseUsuario = function() {

    var datatable = $('.tabla_usuarios').mDatatable({
      // datasource definition
      data: {
        type: 'remote', //Obligatorio.Establecer tipo remote para obtener datos remotos de una URL pública
        source: {
          read: {
            url : '/kerma/procesando_usuarios',
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

     extensions: {
       checkbox: {
          /*
            creo q es para cambiar tipo de variables que se llamen de otra forma en el request
           vars: {
             selectedAllRows: 'selectedAllRows',
             requestIds: 'requestIds',
             rowIds: 'meta.rowIds',
           },
           */

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

        
        {
          field: 'otra',
          title: 'otra',
          attr: {nowrap: 'nowrap'},
          //width: 150,
          template: function(row) { //// función callback  soportada para la  renderización de columna
            return row.nombre + ' - ' + row.nombre;
          },

        },  


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
    $('#id_perfil').on('change', function() {
      datatable.search($(this).val(), 'id_perfil');
    });

    $('#id_otro').on('change', function() {
      datatable.search($(this).val(), 'id_perfil');
    });

    //dibujar los elementos de filtros como un selector
    $('#id_perfil, #id_otro').selectpicker();

 

    //Cuando da click en el checkbox de la 1ra fila
    datatable.on('m-datatable--on-click-checkbox m-datatable--on-layout-updated', function(e) {
          // datatable.checkbox() access to extension methods
          var ids = datatable.checkbox().getSelectedId();   //datatable.checkbox() esta declarada en la funcion checkbox
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
      var ids = datatable.checkbox().getSelectedId();
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
         var ids = datatable.checkbox().getSelectedId();
         var cantidad= ids.length;
         $('.etiq_num_registro').html(cantidad);
    });



  //cuando acepta la modal de cambiar multiples perfiles   
  $('#aceptar_multiple_perfil').on('click', function() {  
        //console.log('aaa');
      var ids = datatable.checkbox().getSelectedId();
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
                  datatable.reload();
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
         var ids = datatable.checkbox().getSelectedId();
         var cantidad= ids.length;
         $('.etiq_num_registro').html(cantidad);
    });



  //cuando acepta la modal de eliminar multiples usuarios
  $('#aceptar_multiple_eliminar').on('click', function() {  
        //console.log('aaa');
      var ids = datatable.checkbox().getSelectedId();
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
                  datatable.reload();
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




  };

  return {
    // public functions
    init: function() {
      claseUsuario();
    },
  };
  
}();

jQuery(document).ready(function() {
  DatatableRemoteAjaxDemo.init();
});




/*




  var serverSelectorDemo = function() {

    // enable extension
    options.extensions = {
      checkbox: {},
    };
    options.search = {
      input: $('#generalSearch1'),
    };

    var datatable = $('#server_record_selection').mDatatable(options);

    $('#m_form_status1').on('change', function() {
      datatable.search($(this).val().toLowerCase(), 'Status');
    });

    $('#m_form_type1').on('change', function() {
      datatable.search($(this).val().toLowerCase(), 'Type');
    });

    $('#m_form_status1,#m_form_type1').selectpicker();

    datatable.on('m-datatable--on-click-checkbox m-datatable--on-layout-updated', function(e) {
      // datatable.checkbox() access to extension methods
      var ids = datatable.checkbox().getSelectedId();
      var count = ids.length;
      $('#m_datatable_selected_number1').html(count);
      if (count > 0) {
        $('#m_datatable_group_action_form1').collapse('show');
      } else {
        $('#m_datatable_group_action_form1').collapse('hide');
      }
    });

    $('#m_modal_fetch_id_server').on('show.bs.modal', function(e) {
      var ids = datatable.checkbox().getSelectedId();
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

  };


*/