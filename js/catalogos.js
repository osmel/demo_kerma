jQuery(document).ready(function($) {


	//para el guardar de todos los catalogos
    jQuery('body').on('submit','#form_catalogos', function (e) {
    	
			jQuery('#foo').css('display','block');
			var spinner = new Spinner(opts).spin(target);
			jQuery(this).ajaxSubmit({
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
							//e.preventDefault();
							window.location.href = '/'+$catalogo;	
							return false;
					}
				} 
			});
			return false;
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

	
	jQuery(".navigacion").change(function()	{
	    document.location.href = jQuery(this).val();
	});

   	var target = document.getElementById('foo');	



//este es para los selectores de profesionales y administrativos
//https://silviomoreto.github.io/bootstrap-select/examples/#customize-menu
// evento https://silviomoreto.github.io/bootstrap-select/options/#events

/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////PROFESIONALES///////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////


jQuery('.selectpicker.profesionales').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {
  	//alert('bb');
			         nivel='';	
			         var valor_anterior=0;
					 var objeto = [];

					 jQuery('option[data-valor]:selected').each(function(index, value)  {
					 		var  elementos= {};
					        var select = jQuery(this);
					        elementos['id_grupo_capital_humano'] = jQuery(this).attr('id_grupo_capital_humano');
					        elementos['valor'] = jQuery(this).attr('data-valor');
					        elementos["texto"] = jQuery(this).val();
					        elementos["num_texto"] = index;
					        elementos["tipo"] = jQuery(this).attr('tipo');  
					        objeto.push(elementos);
					    });




						$.each(objeto, function(key, valores) {
			        	 
							//console.log(valor_anterior);
						  if (valor_anterior!=valores.id_grupo_capital_humano) {
			              	  //pp=valores.valor; //jQuery('option[value="'+valores.valor+'"]').attr('data-valor');
             	              $grupo = ( jQuery('optgroup[valor="'+valores.id_grupo_capital_humano+'"]').attr('label') != undefined ) ? jQuery('optgroup[valor="'+valores.id_grupo_capital_humano+'"]').attr('label') : ''; 

             	              //id_grupo_capital_humano

				              if ($grupo) {
					              nivel +='<div class="'+(($grupo==jQuery('#id_seleccion').val()) ? "" : "") +'">';
					              nivel +='  <h5>'+$grupo+'</h5>';
					              nivel +=' </div>';
					              nivel +='';
				              }	 

				              valor_anterior=valores.id_grupo_capital_humano ;
			              }

			              		   id_principal = jQuery('a.m-socios-activo').attr('id_principal');
			          			  url_principal = jQuery('a.m-socios-activo').attr('url_principal');
				              	       url_hijo =  jQuery('a.m-socios-activo').attr('url_hijo') ;
				              		    id_hijo =  jQuery.base64.encode( jQuery('a.m-socios-activo').attr('id_hijo') );
				              		   num_hijo =  jQuery.base64.encode( jQuery('a.m-socios-activo').attr('num_hijo') );
							  	 id_encabezado = jQuery.base64.encode( jQuery('a.encabezado-activo').attr('id_encabezado') );
	  							  id_seleccion =  	jQuery.base64.encode(  valores.valor );   //? valores.valor : 0
			        	  
 	  							  
	  						respuesta =  ( ( (parseInt(jQuery('#id_seleccion').val()) ==0) && (key==0) ) ? "nivel-activo" : (  ( parseInt(jQuery.base64.decode(id_seleccion) ) == parseInt(jQuery('#id_seleccion').val()) ) ? "nivel-activo" : "osmel") ); 
	  						//respuesta =  ( ( ( parseInt(jQuery('#id_seleccion').val()) == 0 ) && (key==0) ) ? "nivel-activo" : ""); 

	  						//public function detalle($url_hijo, $id_hijo,$num_hijo,   $id_encabezado='MA==', $id_seleccion='MA=='){

	  					   //detalles		
			        	  url="/kerma/"+url_principal+"/"+url_hijo+"/"+id_hijo+"/"+num_hijo+"/"+id_encabezado+"/"+id_seleccion;
					      nivel +='<a href="'+url+'"  class="btn btn-block '+respuesta+'"  valor="'+parseInt(jQuery.base64.decode(id_seleccion))+'" >';
			              nivel +='  <p>'+valores.texto+' <span class="fas fa-caret-right flecha-nivel"></span></p>';
			              nivel +=' </a>';
			              nivel +='';

			              

			    

            		});

				




   			jQuery('.niveles_detalles').children().remove();
            jQuery('.niveles_detalles').append(nivel);


            	 //guardar informacion de los marcados tanto en profesionales como en administrativos
	            jQuery.ajax({
		            url : '/kerma/guardar_selectores_marcados',
		            data:{
		              objeto:JSON.stringify(objeto),

					  id_principal  : jQuery('a.m-socios-activo').attr('id_principal'),
			          url_principal : jQuery('a.m-socios-activo').attr('url_principal'),
				      	   url_hijo : jQuery('a.m-socios-activo').attr('url_hijo') ,
				           id_hijo  : jQuery.base64.encode( jQuery('a.m-socios-activo').attr('id_hijo') ),
				          num_hijo  :  jQuery.base64.encode( jQuery('a.m-socios-activo').attr('num_hijo') ),
					  id_encabezado  : jQuery.base64.encode( jQuery('a.encabezado-activo').attr('id_encabezado') ),
					  num_encabezado  : jQuery.base64.encode( jQuery('a.encabezado-activo').attr('num_encabezado') ),

	  				   id_seleccion  : jQuery.base64.encode( jQuery('a.nivel-activo').attr('valor') ? jQuery('a.nivel-activo').attr('valor') : 0    ), //jQuery.base64.encode(0),   //valores.valor


		              
		            },

		            type : 'POST',
		            dataType : 'json',
		            success : function(data) {
			              if(data.exito == true){
			                   console.log(data);
			               
			              } else {
			                //alert(data.exito);
			              }

		            } 
		      });   


      
            //console.log(objeto);
      	  //console.log(    JSON.stringify(elementos)   );
  });









/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////ADMINISTRATIVOS/////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////





  jQuery('.selectpicker.administrativos').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {
  	//alert('bb');
			         nivel='';	
			         var valor_anterior=0;
					 var objeto = [];

					 jQuery('option[data-valor]:selected').each(function(index, value)  {
					 		var  elementos= {};
					        var select = jQuery(this);

					        elementos['valor'] = jQuery(this).attr('data-valor') ? jQuery(this).attr('data-valor') : jQuery(this).attr('valor');
					        elementos["texto"] = jQuery(this).val();
					        elementos["num_texto"] = index;
					        elementos["tipo"] = jQuery(this).attr('tipo');  
					        objeto.push(elementos);

					        console.log(elementos);
					    });




						$.each(objeto, function(key, valores) {
			        	 
							//console.log(valor_anterior);
						  if (valor_anterior!=valores.valor) {
			              	  //pp=valores.valor; //jQuery('option[value="'+valores.valor+'"]').attr('data-valor');
             	              $grupo = ( jQuery('optgroup[valor="'+valores.valor+'"]').attr('label') != undefined ) ? jQuery('optgroup[valor="'+valores.valor+'"]').attr('label') : ''; 

				              if ($grupo) {
					              nivel +='<div class="'+(($grupo==jQuery('#id_seleccion').val()) ? "" : "") +'">';
					              nivel +='  <h5>'+$grupo+'</h5>';
					              nivel +=' </div>';
					              nivel +='';
				              }	 

				              valor_anterior=valores.valor ;
			              }

			              		   id_principal = jQuery('a.m-socios-activo').attr('id_principal');
			          			  url_principal = jQuery('a.m-socios-activo').attr('url_principal');
				              	       url_hijo =  jQuery('a.m-socios-activo').attr('url_hijo') ;
				              		    id_hijo =  jQuery.base64.encode( jQuery('a.m-socios-activo').attr('id_hijo') );
				              		   num_hijo =  jQuery.base64.encode( jQuery('a.m-socios-activo').attr('num_hijo') );
							  	 id_encabezado = jQuery.base64.encode( jQuery('a.encabezado-activo').attr('id_encabezado') );
	  							  id_seleccion =  	jQuery.base64.encode(  valores.valor );   //? valores.valor : 0
			        	  
 	  							  
	  						respuesta =  ( ( (parseInt(jQuery('#id_seleccion').val()) ==0) && (key==0) ) ? "nivel-activo" : (  ( parseInt(jQuery.base64.decode(id_seleccion) ) == parseInt(jQuery('#id_seleccion').val()) ) ? "nivel-activo" : "osmel") ); 
	  						//respuesta =  ( ( ( parseInt(jQuery('#id_seleccion').val()) == 0 ) && (key==0) ) ? "nivel-activo" : ""); 

	  						//public function detalle($url_hijo, $id_hijo,$num_hijo,   $id_encabezado='MA==', $id_seleccion='MA=='){

	  					   //detalles		
			        	  url="/kerma/"+url_principal+"/"+url_hijo+"/"+id_hijo+"/"+num_hijo+"/"+id_encabezado+"/"+id_seleccion;
					      nivel +='<a href="'+url+'"  class="btn btn-block '+respuesta+'"  valor="'+parseInt(jQuery.base64.decode(id_seleccion))+'" >';
			              nivel +='  <p>'+valores.texto+' <span class="fas fa-caret-right flecha-nivel"></span></p>';
			              nivel +=' </a>';
			              nivel +='';

			              

			    

            		});

				




   			jQuery('.niveles_detalles').children().remove();
            jQuery('.niveles_detalles').append(nivel);


            	 //guardar informacion de los marcados tanto en profesionales como en administrativos
	            jQuery.ajax({
		            url : '/kerma/guardar_selectores_marcados',
		            data:{
		              objeto:JSON.stringify(objeto),

					  id_principal  : jQuery('a.m-socios-activo').attr('id_principal'),
			          url_principal : jQuery('a.m-socios-activo').attr('url_principal'),
				      	   url_hijo : jQuery('a.m-socios-activo').attr('url_hijo') ,
				           id_hijo  : jQuery.base64.encode( jQuery('a.m-socios-activo').attr('id_hijo') ),
				          num_hijo  :  jQuery.base64.encode( jQuery('a.m-socios-activo').attr('num_hijo') ),
					  id_encabezado  : jQuery.base64.encode( jQuery('a.encabezado-activo').attr('id_encabezado') ),
					  num_encabezado  : jQuery.base64.encode( jQuery('a.encabezado-activo').attr('num_encabezado') ),

	  				   id_seleccion  : jQuery.base64.encode( jQuery('a.nivel-activo').attr('valor') ? jQuery('a.nivel-activo').attr('valor') : 0    ), //jQuery.base64.encode(0),   //valores.valor


		              
		            },

		            type : 'POST',
		            dataType : 'json',
		            success : function(data) {
			              if(data.exito == true){
			                  
			              } else {
			                
			              }

		            } 
		      });   


      
            //console.log(objeto);
      	  //console.log(    JSON.stringify(elementos)   );
  });


    

/////////////////////////////////////////////
 //cuando refresca la pagina
{
	$('.selectpicker').trigger('changed.bs.select');
}

/////////////////////////////////////////



});