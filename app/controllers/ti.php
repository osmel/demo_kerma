<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Ti extends CI_Controller {

	public function __construct(){ 
		parent::__construct();
		$this->load->model('admin/modelo', 'modelo'); 
		$this->load->model('admin/modelo_arbol', 'modelo_arbol'); 
		$this->load->model('model_ti', 'model_ti');
		$this->load->model('model_informacion_general', 'model_informacion_general');
		
		
		//$this->data_sistema['menues']     = self::menu_nodo(1);
		$this->data_sistema['menues']     = ($this->model_informacion_general->listado_menu());		//
		$this->data_sistema['categorias'] = self::obtener_nodo(3);
		$this->data_sistema['perfiles']   = $this->modelo->obtener_perfiles();
		$this->data_sistema['entidades']   = $this->modelo->buscador_entidades();
		
		$this->data_sistema['permiso']   = $this->modelo->permiso_usuario_actual(10);

	}





	//catalogo de usuarios
	  public function index(){
	   if ( $this->session->userdata('session') !== TRUE ) {
	        redirect('login');
	    } else {

          $data=array();
          $this->data_sistema['subcategorias']   = $this->model_ti->listado_subcategorias();
          $data = array_merge($this->data_sistema,$data);
	      switch ($this->session->userdata('id_perfil')) {    
		        case 1: 
		            $this->load->view( 'ti/ti', $data);
		          break;
		        case 2:
		        case 3:  //funcionario y admin tambien pueden
		             $this->load->view( 'ti/ti', $data);
		          break;
		        case 4:
		             if  ( ($this->data_sistema['permiso']  & 1) || ($this->data_sistema['permiso']  & 2) )  { 
		                $this->load->view( 'ti/ti', $data);
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



	public function detalle($encabezado, $id_encabezado,$id_seccion='MA=='){
	   if ( $this->session->userdata('session') !== TRUE ) {
	        redirect('login');
	    } else {


          $data=array();
          $data['encabezado'] = $encabezado;
          $data['id_encabezado'] = base64_decode($id_encabezado);
          $data['id_seccion'] = base64_decode($id_seccion);
		  $data['sub_pregunta']   = $this->model_ti->listado_sub_pregunta($data);	          

          $data['subcategorias']   = $this->model_ti->listado_subcategorias();
          $data = array_merge($this->data_sistema,$data);
	      switch ($this->session->userdata('id_perfil')) {    
		        case 1: 
		            $this->load->view( 'ti/detalle', $data);
		          break;
		        case 2:
		        case 3:  //funcionario y admin tambien pueden
		             $this->load->view( 'ti/detalle', $data);
		          break;
		        case 4:
		             if  ( ($this->data_sistema['permiso']  & 1) || ($this->data_sistema['permiso']  & 2) )  { 
		                $this->load->view( 'ti/detalle', $data);
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