<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Clasificadores extends CI_Controller {

	public function __construct(){ 
		parent::__construct();

		$this->load->model('admin/modelo', 'modelo'); 

		$this->load->model('admin/model_clasificadores','model_clasificadores'); 
		

		$this->load->model('admin/modelo_arbol', 'modelo_arbol'); 
		$this->load->model('admin/modelo_arbol', 'modelo_arbol');
		$this->load->model('model_informacion_general', 'model_informacion_general');
		$this->load->library(array('email')); 
		$this->data_sistema['menues']     = ($this->model_informacion_general->listado_menu());		//
		$this->data_sistema['categorias']     = ($this->model_informacion_general->listado_menu());		//
		$this->data_sistema['perfiles']   = $this->modelo->obtener_perfiles();
		$this->data_sistema['perfiles_activo']   = $this->modelo->obtener_perfiles_activo();
		$this->data_sistema['entidades']   = $this->modelo->buscador_entidades();

	}



	//catalogo de entidades
	  public function listado_preguntas(){
	   if ( $this->session->userdata('session') !== TRUE ) {
	        redirect('login');
	    } else {

          $data=array();
          $data['modulos']   = $this->model_clasificadores->listado_modulos();
          //$data['encabezados']   = $this->modelo->buscador_estados();
          $data['id_modulo'] =1;  //como es la primera vez comienza por el 1er modulo
          $data['pestana'] =0;
          //$data['subcategorias']   = $this->model_clasificadores->listado_subcategorias($data);
          $data['seleccionado'] ='id_modulo';

          $data['sub_modulos']   = ($this->model_clasificadores->listado_sub_modulos($data));

          

          //die;
          
          $data = array_merge($this->data_sistema,$data);
          
	      switch ($this->session->userdata('id_perfil')) {    
		        case 1: 

		            $this->load->view( 'admin/catalogos/preguntas/preguntas', $data);
		          break;
		        case 2:
		        case 3:
		        case 4:
		        	    //print_r( $this->session->userdata('permiso')  ); die;
		             if  (  ( $this->session->userdata('permiso')) & 2  )   { 
		                $this->load->view( 'admin/catalogos/preguntas/preguntas', $data);
		              }  else  {
		                redirect('');
		              } 
		          break;
		        default:  
		          redirect('');
		          break;
	      }

	    }    
	    
	  }

  
  public function dependencia(){
  		$data = $_POST;
	  	$data['id_modulo'] = $this->input->post('id_modulo');
	  	$data['id_sub_modulo'] = $this->input->post('id_sub_modulo');
	  	$data['pestana'] = $this->input->post('pestana');

	  	$data['seleccionado'] = $this->input->post('seleccionado');
	  	

	  	$busqueda['sub_modulos']   = ($this->model_clasificadores->listado_sub_modulos($data));	  
	  	echo json_encode($busqueda);
 }		


  public function procesando_preguntas(){
    $data=$_POST;

    
    
    $busqueda = $this->model_clasificadores->buscando_preguntas($data); 


    $datos_meta = array_merge(['pagination' => [], 'sort' => [], 'query' => []], $data);

    $data['id_modulo'] = isset($datos_meta['query']['id_modulo']) && is_string($datos_meta['query']['id_modulo'])
                  ? $datos_meta['query']['id_modulo'] : 0;

   
    echo json_encode($busqueda);
  } 

///////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////

	//edicion del especialista o el perfil del especialista o administrador activo
	function nuevo_pregunta(  ){

		$data['id']=$this->session->userdata('id');
		$id_perfil=$this->session->userdata('id_perfil');

		/*
		$data['estados'] = $this->modelo->buscador_estados( );
		$data['ciudades'] = $this->modelo->buscador_ciudades( );
		$data['empresas'] = $this->modelo->buscador_entidades();
		$data['tipos_entidades'] = $this->modelo->buscador_tipo_entidades( );
		$data['losusuarios'] = $this->modelo->listado_deusuarios(  );
		*/

		$data['modulos'] = $this->model_clasificadores->modulos( );
		$data['sub_modulos'] = $this->model_clasificadores->sub_modulos( );
		
		$data['tipo_preguntas'] = $this->model_clasificadores->tipo_preguntas( );

		$data['id_modulo'] =1;  //por defecto el primero

		$data['botones'] = $this->model_clasificadores->botones( $data );
		//var_dump($data['botones']);die;

		$data = array_merge($this->data_sistema,$data);		  
		     switch ($this->session->userdata('id_perfil')) {      
		        case 1:
		        case 2:  //super y funcionario son los unicos que pueden crear entidades
								$this->load->view('admin/catalogos/preguntas/nuevo_pregunta',$data);
		          break;
		        default:  
		          redirect('');
		          break;
		      }
	}


	function botones_pregunta(){

		    $data['id_modulo']   	= $this->input->post( 'id_modulo' );
		    if   ( ($data['id_modulo']==3)  || ($data['id_modulo']==5)) {
		    	
		    	$data['categorias'] 		= $this->model_clasificadores->categorias( $data );			
		    	$data['grupo_rango'] 		= $this->model_clasificadores->grupo_rango( $data );			

		    } else {  //11, 12 y el resto
		    	$data['botones'] 		= $this->model_clasificadores->botones( $data );			
		    }
			

			echo json_encode($data);  //['botones']


     }			


	function valid_option_multiple( $str,$campo ){
		if (empty((array) (json_decode($this->input->post( $campo ), true) ))) {
					$this->form_validation->set_message('valid_option_multiple', '<b class="requerido">*</b> Es necesario que selecciones una <b>%s</b>.');
					return false;
		} else {
					$this->form_validation->set_message( 'valid_nacimiento',"<b class='requerido'>*</b> Su <b>%s</b> debe ser mayor a 18 años." );	
					return TRUE;
		}

	}


	function validar_nuevo_pregunta(){
		
		if ( $this->session->userdata('session') !== TRUE ) {
			redirect('');
		} else {

			//die;
			
			$this->form_validation->set_rules( 'nombre', 'Nombre', 'trim|required|min_length[3]|max_lenght[180]|xss_clean');  //callback_nombre_valido
			$this->form_validation->set_rules( 'campo', 'campo', 'trim|required|min_length[3]|max_length[100]|xss_clean');
			$this->form_validation->set_rules( 'placeholder', 'placeholder', 'trim|required|min_length[3]|max_length[100]|xss_clean');
			$this->form_validation->set_rules( 'tooltip', 'tooltip', 'trim|required|min_length[2]|max_length[100]|xss_clean');


			$this->form_validation->set_rules('id_tipo_pregunta', 'Tipo', 'required|callback_valid_option|xss_clean');
			$this->form_validation->set_rules('id_modulo', 'Modulo', 'required|callback_valid_option|xss_clean');
			$this->form_validation->set_rules('id_sub_modulo', 'Sub_Modulo', 'required|callback_valid_option|xss_clean');

			$data['id_modulo']   			= $this->input->post( 'id_modulo' );

			if   ( ($data['id_modulo']==3)  || ($data['id_modulo']==5) ) {
				$data['multiples_categoria']      = $this->input->post( 'multiples_categoria' );
				$this->form_validation->set_rules('id_btnes', 'grupos', 'required|callback_valid_option_multiple[id_btnes]|xss_clean');		
			}



			




			if ( $this->form_validation->run() === TRUE ){
				
					
					$data['nombre']		=	$this->input->post('nombre');
					$data 				= 	$this->security->xss_clean($data);  
					
					//$login_check =  $this->modelo->check_entidades_existente($data);
					//if ( $login_check ){ //if ( $login_check === TRUE ){

					if ( true ){ 
						
						$data['campo']   				= $this->input->post( 'campo' );
						$data['placeholder']   			= $this->input->post( 'placeholder' );
						$data['tooltip']   				= $this->input->post( 'tooltip' );
						
						$data['id_tipo_pregunta']   	= $this->input->post( 'id_tipo_pregunta' );
						
						$data['id_sub_modulo']   			= $this->input->post( 'id_sub_modulo' );

						
						$data['id_btnes']               = json_decode($this->input->post( 'id_btnes' ), true);
						

						$data 							= $this->security->xss_clean( $data );
						if   ( ($data['id_modulo']==3)  || ($data['id_modulo']==5) ) {
							$guardar 						= $this->model_clasificadores->agregar_pregunta_pestana1( $data );
						} else {
							$guardar 						= $this->model_clasificadores->agregar_pregunta( $data );
						}	
						//print_r($guardar); die;
						if ( $guardar !== FALSE ){
							echo TRUE;
						} else {
							echo '<span class="error"><b>E02</b> - La información no puedo ser actualizada no hubo cambios</span>';
						}
					} else {
						echo '<span class="error">La <b>Pregunta </b> ya se encuentra dada de alta.</span>';
					}
				
			} else {			
				echo validation_errors('<span class="error">','</span>');
			}
		}
	}	
	

///////////////////////////////////////////////////////////////////
///////////////////////////////////////////////////////////////////


	//edicion del especialista o el perfil del especialista o administrador activo
	function editar_entidad( $uid ){

		$id=$this->session->userdata('id');
		
		$uid = base64_decode($uid);
		$id_perfil=$this->session->userdata('id_perfil');

		$data['estados'] = $this->modelo->buscador_estados( );
		$data['ciudades'] = $this->modelo->buscador_ciudades( );
		$data['empresas'] = $this->modelo->buscador_entidades();
		$data['entidad'] = $this->modelo->busca_entidad( $uid );
		$data['tipos_entidades'] = $this->modelo->buscador_tipo_entidades( );
		$data['usuarios_asociados'] = (array)$this->modelo->obtener_usuario_deEmpresa( $uid );
		$data['losusuarios'] = $this->modelo->listado_deusuarios(  );
		
		$data = array_merge($this->data_sistema,$data);		  
		
 			$data['id']  = $uid;	
		     switch ($this->session->userdata('id_perfil')) {      
		        case 1:
		        case 2:  //super y funcionario son los unicos que pueden crear entidades

						if ( $data['entidad'] !== FALSE ){
								$this->load->view('admin/entidades/editar_entidad',$data);
						} else {
									redirect('');
						}

		          break;
		        
		        default:  
		          redirect('');
		          break;
		      }



	}
	
	function validacion_editar_entidad(){
		if ( $this->session->userdata('session') !== TRUE ) {
			redirect('');
		} else {
			
			$this->form_validation->set_rules( 'nombre', 'Nombre', 'trim|required|min_length[3]|max_lenght[180]|xss_clean');  //callback_nombre_valido
			$this->form_validation->set_rules( 'calle', 'Calle', 'trim|required|min_length[3]|max_length[100]|xss_clean');
			$this->form_validation->set_rules( 'colonia', 'Colonia', 'trim|required|min_length[3]|max_length[100]|xss_clean');
			$this->form_validation->set_rules( 'cp', 'CP', 'trim|required|min_length[2]|max_length[100]|xss_clean');
			$this->form_validation->set_rules('id_estado', 'Estado', 'required|callback_valid_option|xss_clean');
			$this->form_validation->set_rules('id_ciudad', 'Ciudad', 'required|callback_valid_option|xss_clean');
			$this->form_validation->set_rules( 'telefono', 'Teléfono', 'trim|numeric|min_length[8]|callback_valid_phone|xss_clean');
			$this->form_validation->set_rules( 'email', 'Correo', 'trim|required|valid_email|xss_clean');
			$this->form_validation->set_rules( 'socio', 'Socio responsable', 'trim|required|callback_nombre_valido|min_length[3]|max_lenght[180]|xss_clean');
			$this->form_validation->set_rules('id_tipo_entidad', 'Tipo entidad', 'required|callback_valid_option|xss_clean');



			if ( $this->form_validation->run() === TRUE ){
				
					
					$data['nombre']		=	$this->input->post('nombre');
					$data 				= 	$this->security->xss_clean($data);  
					$login_check =  $this->modelo->check_entidades_existente($data);
					if ( true ){ //if ( $login_check === TRUE ){
						
						$data['id_p']   			= $this->input->post( 'id_p' );

						$data['calle']   			= $this->input->post( 'calle' );
						$data['colonia']   			= $this->input->post( 'colonia' );
						$data['cp']   				= $this->input->post( 'cp' );
						$data['id_estado']   		= $this->input->post( 'id_estado' );
						$data['id_ciudad']   		= $this->input->post( 'id_ciudad' );

						$data['telefono']   			= $this->input->post( 'telefono' );
						$data['email']   			= $this->input->post( 'email' );
						$data['socio']   			= $this->input->post( 'socio' );
						$data['id_tipo_entidad']   		= $this->input->post( 'id_tipo_entidad' );

						$data['id_usuarios']               = json_decode($this->input->post( 'id_usuarios' ), true);
						

						$data 								= $this->security->xss_clean( $data );
						$guardar 									= $this->modelo->editar_entidad( $data );
						if ( $guardar !== FALSE ){
							echo TRUE;
						} else {
							echo '<span class="error"><b>E02</b> - La información no puedo ser actualizada no hubo cambios</span>';
						}
					} else {
						echo '<span class="error">La <b>Firma </b> ya se encuentra dada de alta.</span>';
					}
				
			} else {			
				echo validation_errors('<span class="error">','</span>');
			}
		}
	}	
	


	function eliminar_entidad($uid = '', $nombrecompleto=''){

	if($this->session->userdata('session') === TRUE ){
		  $id_perfil=$this->session->userdata('id_perfil');

		  if ($uid=='') {
			  $uid= $this->session->userdata('id');
		  } else {
		  		$uid = base64_decode($uid);
		  }   
		  $data['nombrecompleto']   = base64_decode($nombrecompleto);
		  $data['uid']        = $uid;


		  switch ($id_perfil) {    
			case 1:
					  $this->load->view( 'admin/entidades/eliminar_entidad', $data );            
			  break;
			case 2:
			case 3:					  
					  $this->load->view( 'admin/entidades/eliminar_entidad', $data );

			  break;


			default:  
			  redirect('');
			  break;
		  }
		}
		else{ 
		  redirect('');
		}
		
	}

	function validar_eliminar_entidad(){
		
		
		$uid = $this->input->post( 'uid_retorno' ); 

		$eliminado = $this->modelo->eliminar_entidad(  $uid );
		if ( $eliminado !== FALSE ){
			echo TRUE;
		} else {
			echo '<span class="error">No se ha podido eliminar al entidad</span>';
		}
	}

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////




	public function index(){
		if ( $this->session->userdata( 'session' ) !== TRUE ){
			$this->login();
		} else {
			$this->dashboard_usuario();
		}
	}

	public function dashboard_principal(){
		if ( $this->session->userdata( 'session' ) !== TRUE ){
			$this->load->view( 'principal/dashboard_principal' );
		} else {
			$this->dashboard_usuario();
		}
	}


	function dashboard_usuario(){ 
		if($this->session->userdata('session') === TRUE ){
		  $id_perfil=$this->session->userdata('id_perfil');

	
			$data=array();
	  		$data = array_merge($this->data_sistema,$data);

		  switch ($id_perfil) {    
			case 1:  //super
				$this->load->view( 'admin/principal/dashboard_usuario',$data );
				break;
			case 2: //funcionario
			case 3: //admin
			case 4: //editor
				$this->load->view( 'admin/principal/dashboard_usuario',$data );
			  break;

			default:  
			  redirect('');
			  break;
		  }
		}
		else{ 
		  redirect('');
		}	

	}


	
	function actualizar_roles(){ 
		      $data =  json_decode(json_encode( $_POST ),true  );

		      $actualizar_roles = $this->modelo->actualizar_roles($data);

		      /*
		    foreach ($data['arreglo_general'] as $key => $value) {
		    		print_r($value['lectura'] ) ;
		    		echo '<br/>';
		    }  	
		    die;*/
		    $data['exito'] = true;
			echo json_encode($data);
	}	

	public function login(){
		$this->load->view( 'admin/login' );
	}



	//validar login
	function validar_login(){  
		$this->form_validation->set_rules( 'email', 'Email', 'trim|required|valid_email|xss_clean');
		$this->form_validation->set_rules( 'contrasena', 'Contraseña', 'required|trim|min_length[8]|xss_clean');
		if ( $this->form_validation->run() == FALSE ){
				echo validation_errors('<span class="error">','</span>');
			} else {
				$data['email']		=	$this->input->post('email');
				$data['contrasena']		=	$this->input->post('contrasena');
				$data 				= 	$this->security->xss_clean($data);  
				$login_check = $this->modelo->check_login($data);
				
				if ( $login_check != FALSE ){
					$usuario_historico = $this->modelo->anadir_historico_acceso($login_check[0]);
					$this->session->set_userdata('session', TRUE);
					$this->session->set_userdata('email', $data['email']);
					
					if (is_array($login_check))
						foreach ($login_check as $login_element) {
							$this->session->set_userdata('id', $login_element->id);
							$this->session->set_userdata('id_perfil', $login_element->id_perfil);
							$this->session->set_userdata('perfil', $login_element->perfil);
							$this->session->set_userdata('nombre_completo', $login_element->nombre.' '.$login_element->apellidos);
							$this->session->set_userdata('especial', $login_element->especial);
							$this->session->set_userdata('permiso', $login_element->permiso);
						}
					echo TRUE;
				} else {
					echo '<span class="error">¡Ups! tus datos no son correctos, verificalos e intenta nuevamente por favor.</span>';
				}
			}
	}	
////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

	//catalogo de usuarios
	  public function listado_usuarios(){
	   if ( $this->session->userdata('session') !== TRUE ) {
	        redirect('login');
	    } else {

          $data=array();
          $data = array_merge($this->data_sistema,$data);
	      switch ($this->session->userdata('id_perfil')) {    
		        case 1: 
		            $this->load->view( 'admin/usuarios/usuarios', $data);
		          break;
		        case 2:
		        case 3:
		        case 4:
		        	    //print_r( $this->session->userdata('permiso')  ); die;
		             if  (  ( $this->session->userdata('permiso')) & 2  )   { 
		                $this->load->view( 'admin/usuarios/usuarios', $data);
		              }  else  {
		                redirect('');
		              } 
		          break;
		        default:  
		          redirect('');
		          break;
	      }

	    }    
	    
	  }


  public function procesando_usuarios(){
    $data=$_POST;
    $busqueda = $this->modelo->buscador_usuarios($data);
    echo $busqueda;
  } 


	




  public function historico_accesos(){

   if ( $this->session->userdata('session') !== TRUE ) {
        redirect('login');
    } else {
          $data=array();
          $data = array_merge($this->data_sistema,$data);

     switch ($this->session->userdata('id_perfil')) {      
        case 1:
	            $this->load->view( 'admin/usuarios/historico_accesos',$data);
          break;
        case 2:
        case 3:
        case 4:
              if  (  ( (int) $this->session->userdata('permiso')) & 2  )   { 
		                $this->load->view( 'admin/usuarios/historico_accesos',$data);
		              }  else  {
		                redirect('');
		         } 
          break;
        default:  
          redirect('');
          break;
      }

    }    
    
  }


  public function procesando_historico_accesos(){
    $data=$_POST;
    $busqueda = $this->modelo->historico_acceso($data);
    echo $busqueda;
  }


   


//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

   public function cambiar_multiples_perfiles(){
   	  $data['id_perfil'] = ($this->input->post( 'id_perfil' ));
   	  $data['ids'] = json_decode($this->input->post( 'ids' ), true);
   	  	
   	  $cambiando = $this->modelo->cambiar_multiples_perfiles(  $data );
   	  
   	  $datos['exito'] = $cambiando;
   	  //echo json_encode( $data['id_perfil'] );
   	  //echo json_encode( $data['$ids'][0] );
   	  echo  json_encode($datos);
   }	

	public function eliminar_multiples_usuarios(){
   	  $data['ids'] = json_decode($this->input->post( 'ids' ), true);
   	  $eliminado = $this->modelo->eliminar_multiples_usuarios(  $data );
   	  $datos['exito'] = $eliminado;
   	  echo  json_encode($datos);
	}	



//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////



   // Creación de especialista o Administrador (Nuevo Colaborador)
	function nuevo_usuario(){
		 if ( $this->session->userdata('session') !== TRUE ) {
		        redirect('login');
		    } else {
		          $data=array();
		          $data['empresas'] = $this->modelo->buscador_entidades();
		          $data = array_merge($this->data_sistema,$data);
		          
		     switch ($this->session->userdata('id_perfil')) {      
		        case 1:
			            $this->load->view( 'admin/usuarios/nuevo_usuario',$data );
		          break;
		        case 2:
		        case 3:
		        case 4:
		              if  (  ( (int) $this->session->userdata('permiso')) & 1  )   { 
				                $this->load->view( 'admin/usuarios/nuevo_usuario',$data );
				              }  else  {
				                redirect('');
				         } 
		          break;
		        default:  
		          redirect('');
		          break;
		      }

		    }    
		    
		  }


		public function buscador(){
		    if ($this->session->userdata('session') !== TRUE) {
		      redirect('/');
		    } else {
		       $data['key']=$_GET['key'];
		       //$data['num']=$_GET['num'];
		       $busqueda = $this->modelo->buscando_usuarios($data);

		       echo $busqueda;
		    }  
		  }


	function validar_nuevo_usuario(){
		if ($this->session->userdata('session') !== TRUE) {
			redirect('');
		} else {

			//print_r( $this->db->query('SELECT UUID() AS uuid')->row()->uuid ); 
			$this->form_validation->set_rules( 'nombre', 'Nombre', 'trim|required|callback_nombre_valido|min_length[3]|max_lenght[180]|xss_clean');
			$this->form_validation->set_rules( 'apellidos', 'Apellido(s)', 'trim|required|callback_nombre_valido|min_length[3]|max_lenght[180]|xss_clean');
			$this->form_validation->set_rules( 'email', 'Email', 'trim|required|valid_email|xss_clean');
			$this->form_validation->set_rules( 'telefono', 'Teléfono', 'trim|numeric|callback_valid_phone|xss_clean');
			$this->form_validation->set_rules('id_perfil', 'Rol de usuario', 'required|callback_valid_option|xss_clean');
			$this->form_validation->set_rules( 'pass_1', 'Contraseña', 'required|trim|min_length[8]|xss_clean');
			$this->form_validation->set_rules( 'pass_2', 'Confirmación de contraseña', 'required|trim|min_length[8]|xss_clean');



			if ($this->form_validation->run() === TRUE){
				if ($this->input->post( 'pass_1' ) === $this->input->post( 'pass_2' ) ){
					$data['email']		=	$this->input->post('email');
					$data['contrasena']		=	$this->input->post('pass_1');
					$data 				= 	$this->security->xss_clean($data);  
					$login_check = $this->modelo->check_correo_existente($data);

					if ( $login_check != FALSE ){		
						$usuario['nombre']   			= $this->input->post( 'nombre' );
						$usuario['apellidos']   		= $this->input->post( 'apellidos' );
						$usuario['email']   			= $this->input->post( 'email' );
						$usuario['contrasena']				= $this->input->post( 'pass_1' );
						$usuario['telefono']   		= $this->input->post( 'telefono' );
						$usuario['id_perfil']   		= $this->input->post( 'id_perfil' );
						$usuario['id_entidad']         = json_decode($this->input->post( 'id_entidad' ), true);
						
						//$usuario['fecha_nac']   		= $this->input->post( 'fecha_nac' );

						$usuario 						= $this->security->xss_clean( $usuario );
						$guardar 						= $this->modelo->anadir_usuario( $usuario );

						
						if ( $guardar !== FALSE ){  

									
									$dato['email']   			    = $usuario['email'];   			
									$dato['contrasena']				= $usuario['contrasena'];				

									/* 
									//envio de correo para notificar alta en usuarios del sistema
									$desde = $this->session->userdata('c1');
									$esp_nuevo = $usuario['email'];
									$this->email->from($desde, $this->session->userdata('c2'));
									$this->email->to( $esp_nuevo );
									$this->email->subject('Has sido dado de alta en '.$this->session->userdata('c2'));
									$this->email->message( $this->load->view('admin/correos/alta_usuario', $dato, TRUE ) );

										 
									if ($this->email->send()) {	
										echo TRUE;
									} else {
										echo '<span class="error"><b>E01</b> - El nuevo usuario no pudo ser agregado</span>';
									}
									*/



									echo true;	

						} else {
							echo '<span class="error"><b>E01</b> - El nuevo usuario no pudo ser agregado</span>';
						}
					} else {
						echo '<span class="error">El <b>Correo electrónico</b> ya se encuentra asignado a una cuenta.</span>';
					}
				} else {
					echo '<span class="error">No coinciden la Contraseña </b> y su <b>Confirmación</b> </span>';
				}
			} else {			
				echo validation_errors('<span class="error">','</span>');
			}
		}
	}



	//edicion del especialista o el perfil del especialista o administrador activo
	function actualizar_perfil( $uid = '' ){

		$id=$this->session->userdata('id');




		if ($uid=='') {
			$uid= $id;
			$data['retorno'] = '/'; //admin

		} else {
			$uid = base64_decode($uid);
		}
  

		if ($uid==$id) {
			$this->data_sistema['perfiles'] = $this->data_sistema['perfiles_activo']; //cuando va a checar su mismo usuario	
		}
		



		$id_perfil=$this->session->userdata('id_perfil');
		$data['empresas'] = $this->modelo->buscador_entidades();
		$data['usuario'] = $this->modelo->obtener_usuario( $uid );

		$data['entidades_usuarios'] = (array)$this->modelo->obtener_empresas_deusuario( $uid );
		
		$data = array_merge($this->data_sistema,$data);		  
		
	//Administrador con permiso a todo ($id_perfil==1)
	//usuario solo viendo su PERFIL  OR (($id_perfil!=1) and ($id==$uid) )
/*
		if	( ($id_perfil==1) OR (($id_perfil!=1) and ($id==$uid) ) ) {
			


			$data['id']  = $uid;
			if ( $data['usuario'] !== FALSE ){
					$this->load->view('admin/usuarios/editar_usuario',$data);
			} else {
						redirect('');
			}
		} else
		{
			 redirect('');
		}	



*/


			 $data['id']  = $uid;	
		     switch ($this->session->userdata('id_perfil')) {      
		        case 1:
			            

						if ( $data['usuario'] !== FALSE ){
								$this->load->view('admin/usuarios/editar_usuario',$data);
						} else {
									redirect('');
						}

		          break;
		        case 2:
		        case 3:
		        case 4:
		        		//&& (  ( (int) $this->session->userdata('permiso')) & 2  )
						if  (( $data['usuario'] !== FALSE )  ) {
								$this->load->view('admin/usuarios/editar_usuario',$data);
						} else {
									redirect('');
						}




		          break;

		        default:  
		          redirect('');
		          break;
		      }




	}
	
	function validacion_edicion_usuario(){
		
		if ( $this->session->userdata('session') !== TRUE ) {
			redirect('');
		} else {
			
			$this->form_validation->set_rules( 'nombre', 'Nombre', 'trim|required|callback_nombre_valido|min_length[3]|max_lenght[180]|xss_clean');
			$this->form_validation->set_rules( 'apellidos', 'Apellido(s)', 'trim|required|callback_nombre_valido|min_length[3]|max_lenght[180]|xss_clean');
			$this->form_validation->set_rules( 'email', 'Email', 'trim|required|valid_email|xss_clean');
			$this->form_validation->set_rules( 'telefono', 'Teléfono', 'trim|numeric|callback_valid_phone|xss_clean');
			$this->form_validation->set_rules( 'id_perfil', 'Rol de usuario', 'required|callback_valid_option|xss_clean');
			$this->form_validation->set_rules( 'pass_1', 'Contraseña', 'required|trim|min_length[8]|xss_clean');
			$this->form_validation->set_rules( 'pass_2', 'Confirmación de contraseña', 'required|trim|min_length[8]|xss_clean');


	 


			if ( $this->form_validation->run() === TRUE ){
				if ($this->input->post( 'pass_1' ) === $this->input->post( 'pass_2' ) ){
					$uid 				=   $this->input->post( 'id_p' ); 
					$data['id']							= $uid;
					$data['email']		=	$this->input->post('email');
					$data 				= 	$this->security->xss_clean($data);  
					$login_check =  $this->modelo->check_usuario_existente($data);
					if ( TRUE ){ //if ( $login_check === TRUE ){
						$usuario['nombre']   					= $this->input->post( 'nombre' );
						$usuario['apellidos']   				= $this->input->post( 'apellidos' );
						$usuario['email']   					= $this->input->post( 'email' );
						$usuario['contrasena']						= $this->input->post( 'pass_1' );
						$usuario['telefono']   				= $this->input->post( 'telefono' );
						$usuario['id_perfil']   				= $this->input->post( 'id_perfil' );
						$usuario['id_entidad']               = json_decode($this->input->post( 'id_entidad' ), true);
						$usuario['id']							= $uid;

						$usuario 								= $this->security->xss_clean( $usuario );
						$guardar 									= $this->modelo->edicion_usuario( $usuario );
						if ( $guardar !== FALSE ){
							echo TRUE;
						} else {
							echo '<span class="error"><b>E02</b> - La información del usuario no puedo ser actualizada no hubo cambios</span>';
						}
					} else {
						echo '<span class="error">El <b>Correo electrónico1</b> ya se encuentra asignado a una cuenta.</span>';
					}
				} else {
					echo '<span class="error">La <b>Contraseña</b> y la <b>Confirmación</b> no coinciden, verificalas.</span>';
				}
			} else {			
				echo validation_errors('<span class="error">','</span>');
			}
		}
	}	
	

	function eliminar_usuario($uid = '', $nombrecompleto=''){

	if($this->session->userdata('session') === TRUE ){
		  $id_perfil=$this->session->userdata('id_perfil');

		  if ($uid=='') {
			  $uid= $this->session->userdata('id');
		  } else {
		  		$uid = base64_decode($uid);
		  }   
		  $data['nombrecompleto']   = base64_decode($nombrecompleto);
		  $data['uid']        = $uid;


		  switch ($id_perfil) {    
			case 1:
					  $this->load->view( 'admin/usuarios/eliminar_usuario', $data );            
			  break;
			case 2:
			case 3:					  
					  $this->load->view( 'admin/usuarios/eliminar_usuario', $data );

			  break;


			default:  
			  redirect('');
			  break;
		  }
		}
		else{ 
		  redirect('');
		}
		
	}


	function validar_eliminar_usuario(){
		
		
		$uid = $this->input->post( 'uid_retorno' ); 

		$eliminado = $this->modelo->eliminar_usuario(  $uid );
		if ( $eliminado !== FALSE ){
			echo TRUE;
		} else {
			echo '<span class="error">No se ha podido eliminar al usuario</span>';
		}
	}

	/////////////hasta aqui registro de usuario////////////	

	/////////////presentacion, filtro y paginador////////////	




	//recuperar constraseña
	function recuperar_contrasena(){
		$this->load->view('admin/recuperar_password');
	}
	
	
	function validar_recuperar_password(){
		$this->form_validation->set_rules( 'email', 'Email', 'trim|required|valid_email|xss_clean');

		if ( $this->form_validation->run() == FALSE ){
			echo validation_errors('<span class="error">','</span>');
		} else {
				$data['email']		=	$this->input->post('email');
				$correo_enviar      =   $data['email'];
				$data 				= 	$this->security->xss_clean($data);  
				$usuario_check 		=   $this->modelo->recuperar_contrasena($data);

				if ( $usuario_check != FALSE ){
						$data= $usuario_check[0]; 	
						$desde = $this->session->userdata('c1');
						$this->email->from($desde,$this->session->userdata('c2'));
						$this->email->to($correo_enviar);
						$this->email->subject('Recuperación de contraseña de '.$this->session->userdata('c2'));
						$this->email->message($this->load->view('admin/correos/envio_contrasena', $data, true));
						if ($this->email->send()) {
							echo TRUE;						
						} else 
							echo false;	
				} else {
					echo '<span class="error">¡Ups! tus datos no son correctos, verificalos e intenta nuevamente por favor.</span>';
				}
		}
	}		





//////////////////////salida del sistema//////////////////////////////////////////
	public function logout(){
		$this->session->sess_destroy();
		redirect('/'); //admin
	}	




//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
/////////////////////////////////////////////dashboard_usuarios////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////  



  public function procesando_modal_usuarios(){
    $data=$_POST;
    //print_r($data); die;
    $busqueda = $this->modelo->buscador_modal_usuarios($data);
    echo $busqueda;
  } 

//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////  
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////////

public function menu_nodo($num) {
	$arreglo=self::obtener_nodo($num);
	
	foreach($arreglo as $key=>$valor) {
		 if ($valor['children']) {
			$arreglo[$key]['objeto'] = self::obtener_nodo($valor['id']);
				
				foreach($arreglo[$key]['objeto'] as $key2=>$valor2) {
		 			if ($valor2['children']) {
		 				$arreglo[$key]['objeto'][$key2]['objeto'] = self::obtener_nodo($valor2['id']);
		 			} 
		 		}		
		 }
	}	

	return ($arreglo);
}	

//'objeto' => ( ($v['rgt'] - $v['lft'] > 1) ? menu_nodo( $v['id'] ) ? array()  ) 
  //para obtener cada nodo hijo y mostrarlo

  public function obtener_nodo($num) {
    $node = $num; //isset($_GET['id']) && $_GET['id'] !== '#' ? (int)$_GET['id'] : 0;
    $temp = $this->modelo_arbol->get_children($node);
    $rslt = array();
    
    foreach($temp as $v) {
      //if (derecho -izquierdo >1) significa que tiene hijos y por tanto envia "true"
      $rslt[] = array('id' => $v['id'], 'text' => $v['nm'], 'children' => ($v['rgt'] - $v['lft'] > 1), 'icono' => $v['icono'] , 'enlace' => $v['enlace'] );
    }
    return $rslt;
    //header('Content-Type: application/json; charset=utf-8');
    //echo json_encode($rslt);
    
  }



  //este es solo para obtener el recorrido seleccionado, apartir de una IP dada
  public function obtener_contenido() {
	    $node = 23; //isset($_GET['id']) && $_GET['id'] !== '#' ? $_GET['id'] : 0;
	    $node = explode(':', $node);

	    if(count($node) > 1) {
	        $rslt = array('content' => 'Multiples Seleccionados');
	    } else {
	       //en este caso $temp[path] es agregado para el recorrido seleccionado
	       $temp = $this->modelo_arbol->get_node((int)$node[0], array('with_path' => true));

	       //aqui se conforma el formato q voy a presentar del recorrido seleccionado
	       $rslt = array('content' => 'Seleccionado: /' . 
	                                   implode('/',array_map(function ($v) { return $v['nm']; }, $temp['path'])).
	                                   '/'.$temp['nm']
	                    );
	       }
	     
	    header('Content-Type: application/json; charset=utf-8');
	    echo json_encode($rslt);
    
  }	



/////////////////validaciones/////////////////////////////////////////	
	function valid_nacimiento( $str, $campo ){
		if ($this->input->post($campo)){
			$hoy =  new DateTime (date("Y-m-d", strtotime(date("d-m-Y"))) );
			$fecha_nac = new DateTime ( date("Y-m-d", strtotime($this->input->post($campo)) ) );
			$fecha = date_diff($hoy, $fecha_nac);
			if ( ($fecha->y>=5) && ($fecha->y<=150) ) {
				return true;
			} else {
				$this->form_validation->set_message( 'valid_nacimiento',"<b class='requerido'>*</b> Su <b>%s</b> debe ser mayor a 18 años." );	
				return false;
			}

		} else {
			$this->form_validation->set_message( 'valid_nacimiento',"<b class='requerido'>*</b> Es obligatorio <b>%s</b>." );
			return false;
		}	

	}


	public function valid_cero($str)
	{
		return (  preg_match("/^(0)$/ix", $str)) ? FALSE : TRUE;
	}

	function nombre_valido( $str ){
		 $regex = "/^([A-Za-z ñáéíóúÑÁÉÍÓÚ]{2,60})$/i";
		//if ( ! preg_match( '/^[A-Za-zÁÉÍÓÚáéíóúÑñ \s]/', $str ) ){
		if ( ! preg_match( $regex, $str ) ){			
			$this->form_validation->set_message( 'nombre_valido','<b class="requerido">*</b> La información introducida en <b>%s</b> no es válida.' );
			return FALSE;
		} else {
			return TRUE;
		}
	}

	function valid_phone( $str ){
		if ( $str ) {
			if ( ! preg_match( '/\([0-9]\)| |[0-9]/', $str ) ){
				$this->form_validation->set_message( 'valid_phone', '<b class="requerido">*</b> El <b>%s</b> no tiene un formato válido.' );
				return FALSE;
			} else {
				return TRUE;
			}
		}
	}

	function valid_option( $str ){
		if ($str == 0) {
			$this->form_validation->set_message('valid_option', '<b class="requerido">*</b> Es necesario que selecciones una <b>%s</b>.');
			return FALSE;
		} else {
			return TRUE;
		}
	}

	function valid_date( $str ){

		$arr = explode('-', $str);
		if ( count($arr) == 3 ){
			$d = $arr[0];
			$m = $arr[1];
			$y = $arr[2];
			if ( is_numeric( $m ) && is_numeric( $d ) && is_numeric( $y ) ){
				return checkdate($m, $d, $y);
			} else {
				$this->form_validation->set_message('valid_date', '<b class="requerido">*</b> El campo <b>%s</b> debe tener una fecha válida con el formato DD-MM-YYYY.');
				return FALSE;
			}
		} else {
			$this->form_validation->set_message('valid_date', '<b class="requerido">*</b> El campo <b>%s</b> debe tener una fecha válida con el formato DD/MM/YYYY.');
			return FALSE;
		}
	}

	public function valid_email($str)
	{
		return ( ! preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $str)) ? FALSE : TRUE;
	}

	////Agregado por implementacion de registro insitu para evento/////
	public function opcion_valida( $str ){
		if ( $str == '0' ){
			$this->form_validation->set_message('opcion_valida',"<b class='requerido'>*</b>  Selección <b>%s</b>.");
			return FALSE;
		} else {
			return TRUE;
		}
	}


}

/* End of file main.php */
/* Location: ./app/controllers/main.php */