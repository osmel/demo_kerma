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

  jQuery('.selectpicker').on('changed.bs.select', function (e, clickedIndex, isSelected, previousValue) {
          nivel='';	
          var valor_anterior=0;
		  var  elementos= {};
		  var objeto = [];
		 jQuery('option[data-valor]:selected').each(function(index, value)  {
		 		var arreglo = [];
		        var select = jQuery(this);
		        //arreglo.push({  "valor":jQuery(this).attr('data-valor'), "texto":jQuery(this).val(), "num_texto":index,  "tipo":jQuery(this).attr('tipo')  });

		        elementos['valor'] = jQuery(this).attr('data-valor');
		        elementos["texto"] = jQuery(this).val();
		        elementos["num_texto"] = index;
		        elementos["tipo"] = jQuery(this).attr('tipo');  
		        objeto.push(elementos);
					
			        $.each(objeto, function(key, valores) {
			        	 
							//console.log(valor_anterior);
						  if (valor_anterior!=valores.valor) {
			              	  //pp=valores.valor; //jQuery('option[value="'+valores.valor+'"]').attr('data-valor');
             	              $grupo = ( jQuery('optgroup[valor="'+valores.valor+'"]').attr('label') != undefined ) ? jQuery('optgroup[valor="'+valores.valor+'"]').attr('label') : ''; 

				              if ($grupo) {
					              nivel +='<div class="'+((key==0) ? "" : "") +'">';
					              nivel +='  <h5>'+$grupo+'</h5>';
					              nivel +=' </div>';
					              nivel +='';
				              }	 

				              valor_anterior=valores.valor ;
			              }

			          			  url_principal = jQuery('a.m-socios-activo').attr('url_principal');
				              	       url_hijo =  jQuery('a.m-socios-activo').attr('url_hijo') ;
				              		    id_hijo =  jQuery.base64.encode( jQuery('a.m-socios-activo').attr('id_hijo') );
				              		   num_hijo =  jQuery.base64.encode( jQuery('a.m-socios-activo').attr('num_hijo') );
							  	 id_encabezado = jQuery.base64.encode( jQuery('a.encabezado-activo').attr('id_encabezado') );
	  							  id_seleccion =  	jQuery.base64.encode(valores.valor);  
			        	  
			        	  url="/kerma/"+url_principal+"/"+url_hijo+"/"+id_hijo+"/"+num_hijo+"/"+id_encabezado+"/"+id_seleccion;
					      nivel +='<a href="'+url+'" class="btn btn-block '+((index==0) ? "nivel-activo" : "") +'">';
			              nivel +='  <p>'+valores.texto+' <span class="fas fa-caret-right flecha-nivel"></span></p>';
			              nivel +=' </a>';
			              nivel +='';

			              /*
				              console.log(  jQuery('a.m-socios-activo').attr('url_principal')  );
				              console.log(  jQuery('a.m-socios-activo').attr('url_hijo')  );
				              console.log(  jQuery('a.m-socios-activo').attr('id_hijo')  );
				              console.log(  jQuery('a.m-socios-activo').attr('num_hijo')  );
							  console.log(  jQuery('a.encabezado-activo').attr('id_encabezado')  );
			              */



			              //detalle($url_hijo, $id_hijo,$num_hijo,   $id_encabezado='MA==', $id_seleccion='MA=='){
			              // /kerma/<?php echo $url_principal.'/'.$url_hijo.'/'.base64_encode($id_hijo).'/'.base64_encode($num_hijo).'/'.base64_encode($ident_encabezado[$key3]).'/'.base64_encode(0); ?>
    					  //console.log('g'+$grupo);
            

            		});

				//console.log(arreglo);
				//elementos.push( arreglo);

		    });
   			jQuery('.niveles_detalles').children().remove();
            jQuery('.niveles_detalles').append(nivel);

      
            console.log(objeto);
      	  //console.log(    JSON.stringify(elementos)   );
  });


    







});