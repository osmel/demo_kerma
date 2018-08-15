<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class Prueba extends CI_Controller {

    public function __construct(){
        parent::__construct();
        $this->load->model('admin/modelo', 'modelo');
        $this->load->model('admin/modelo_arbol', 'modelo_arbol');
        $this->load->model('model_informacion_general', 'model_informacion_general');


        $this->data_sistema['menues']     = ($this->model_informacion_general->listado_menu());		//


        $this->data_sistema['categorias'] = self::obtener_nodo(3);
        $this->data_sistema['perfiles']   = $this->modelo->obtener_perfiles();
        $this->data_sistema['entidades']  = $this->modelo->buscador_entidades();

        $this->data_sistema['permiso']   = $this->modelo->permiso_usuario_actual(1);



    }

    //catalogo de usuarios
    public function index(){
        if ( $this->session->userdata('session') !== TRUE ) {
            redirect('login');
        } else {

            $data=array();
            $this->data_sistema['subcategorias']   = $this->model_informacion_general->listado_subcategorias();
            $data = array_merge($this->data_sistema,$data);
            switch ($this->session->userdata('id_perfil')) {
                case 1:
                    echo "1";
                 // $this->load->view( 'Prueba/informacion_general', $data);
                 // var_dump($this->data_sistema);
                  var_dump($this->session);
                    break;
                case 2:
                case 3:  //funcionario y admin tambien pueden
                $this->load->view( 'prueba/informacion_general', $data);
                    break;
                case 4:
                    if  ( ($this->data_sistema['permiso']  & 1) || ($this->data_sistema['permiso']  & 2) )  {
                        $this->load->view( 'prueba/informacion_general', $data);
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


}

/* End of file main.php */
/* Location: ./app/controllers/main.php */