
    
 
              $this->session->set_userdata('id', $login_element->id);
              $this->session->set_userdata('id_perfil', $login_element->id_perfil);
              $this->session->set_userdata('perfil', $login_element->perfil);
              $this->session->set_userdata('nombre_completo', $login_element->nombre.' '.$login_element->apellidos);
              $this->session->set_userdata('especial', $login_element->especial);
              $this->session->set_userdata('permiso', $login_element->permiso);

329



    //Cuando da click en el checkbox de la 1ra fila
    
     //datatable_entidades.on('m-datatable--on-click-checkbox m-datatable--on-layout-updated', function(e) {
     $('.tabla_entidades').on('m-datatable--on-click-checkbox m-datatable--on-layout-updated', function(e) {
          // datatable.checkbox() access to extension methods
          var ids = datatable_entidades.checkbox().getSelectedId();   //datatable.checkbox() esta declarada en la funcion checkbox
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
      var ids = datatable_entidades.checkbox().getSelectedId();
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
         var ids = datatable_entidades.checkbox().getSelectedId();
         var cantidad= ids.length;
         $('.etiq_num_registro').html(cantidad);
    });



  //cuando acepta la modal de cambiar multiples perfiles   
  $('#aceptar_multiple_perfil').on('click', function() {  
        //console.log('aaa');
      var ids = datatable_entidades.checkbox().getSelectedId();
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
                  datatable_entidades.reload();
                  //window.location.href = '/kerma/entidades'; 
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
    $('.eliminar_entidad_multiple').on('click', function() {  
         var ids = datatable_entidades.checkbox().getSelectedId();
         var cantidad= ids.length;
         $('.etiq_num_registro').html(cantidad);
    });



  //cuando acepta la modal de eliminar multiples entidades
  $('#aceptar_multiple_eliminar').on('click', function() {  
        //console.log('aaa');
      var ids = datatable_entidades.checkbox().getSelectedId();
      jQuery.ajax({
            url : '/kerma/eliminar_multiples_entidades',
            data:{
              ids:JSON.stringify(ids),
            },
            type : 'POST',
            dataType : 'json',
            success : function(data) {
              if(data.exito == true){
                   console.log(data);
                  
                  $("#modal_eliminar_entidad_multiple").modal('hide');
                  datatable_entidades.reload();
                  return false;

                  //datatable.clearSelection(); unselect
                  //datatable.reload();
                     //datatable.find('thead input[type=checkbox]').removeAttr('checked');
                     //$(".tabla_entidades > m-checkbox > input[type=checkbox]").attr('checked', false);
                     //datatable.uniform.update();
                     
                 // window.location.href = '/kerma/entidades'; //aqui tuve que refrescar la pagina, porque no se quitaba los checked
                  
              } else {
                alert(data.exito);
              }

            } 
      });      
  }); 
  




