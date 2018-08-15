<?php if(! defined('BASEPATH')) exit('No tienes permiso para acceder a este archivo');

class modelo_profesionales extends CI_Model{

    private $key_hash;
    private $timezone;

    function __construct(){
        parent::__construct();
        $this->load->database("default");
        $this->key_hash    = $_SERVER['HASH_ENCRYPT'];
        $this->timezone    = 'UM1';

        //usuarios
        $this->usuarios             = $this->db->dbprefix('usuarios');
        $this->perfiles             = $this->db->dbprefix('perfiles');
        $this->historico_acceso     = $this->db->dbprefix('historico_acceso');

        $this->entidades     = $this->db->dbprefix('op_configuracion_entidades');

        $this->entidades__usuarios     = $this->db->dbprefix('entidades__usuarios');

        $this->modulos                                = $this->db->dbprefix('cat_view_modulos');
        $this->relacion_modulo__encabezado_pregunta   = $this->db->dbprefix('cat_view_modulo__encabezado_pregunta');
        $this->encabezado_pregunta                    = $this->db->dbprefix('cat_view_encabezado_pregunta');
        $this->preguntas                    = $this->db->dbprefix('cat_view_preguntas');




        $this->tipo_pregunta                    = $this->db->dbprefix('cat_tipo_pregunta');
        $this->relacion_valores_pregunta                    = $this->db->dbprefix('cat_view_valores_predefinidos_pregunta');
        $this->valores_predefinidos                    = $this->db->dbprefix('cat_valores_predefinidos');
        $this->tipo_valores_predefinidos                    = $this->db->dbprefix('cat_tipo_valores_predefinidos');
        $this->subcategoria                    = 3;

        $this->detalle_tipo_profesional         =      $this->db->dbprefix('detalle_tipo_profesional');


    }


    /*
    SELECT e.id, e.nombre, m.nombre principal
    FROM kerma_cat_view_modulos m
    INNER JOIN kerma_cat_view_modulo__encabezado_pregunta r ON r.id_modulo = m.id
    INNER JOIN kerma_cat_view_encabezado_pregunta e ON r.id_encabezado_pregunta = e.id
    WHERE m.id =2
    */

    public function listado_detalle_tipo_profesional($prof_type){
        //$id_session = $this->session->userdata('id');
        $this->db->select( '*' );
        $this->db->from($this->detalle_tipo_profesional);
        $where = '((id_tipo_profesionales ='.$prof_type.'))';
        $this->db->where($where);



        $result = $this->db->get();

        if ($result->num_rows() > 0)
            return $result->result();
        else
            return FALSE;
        //$login->free_result();
    }

    public function listado_subcategorias(){
        $id_session = $this->session->userdata('id');
        $this->db->select( 'e.id, e.nombre, m.nombre principal,m.url url_principal,e.url url_hijo, r.id id_encabezado' );
        $this->db->from($this->modulos.' m');
        $this->db->join($this->relacion_modulo__encabezado_pregunta.' r', ' r.id_modulo = m.id');
        $this->db->join($this->encabezado_pregunta.' e', ' r.id_encabezado_pregunta = e.id');

        $where = '(
                        (m.id ='.$this->subcategoria.') 
              )';
        $this->db->where($where);



        $result = $this->db->get();
        if ($result->num_rows() > 0)
            return $result->result();
        else
            return FALSE;
        $login->free_result();
    }



    public function listado_sub_pregunta($data){
        //$id_session = $this->session->userdata('id');
        //e.id, e.nombre, m.nombre principal,m.url url_principal,e.url url_hijo, r.id id_encabezado,


        $this->db->select( 'e.id, e.nombre encabezado, m.nombre principal, p.nombre pregunta, r.id, p.id_numeracion_pregunta, p.etiqueta_numeracion_pregunta, p.identificador, p.wildcard,t.nombre tipo_pregunta,vp.descripcion valor_predefinido,vp.id id_valor_predefinido,
            tvp.descripcion tipo_valor_predefinido,tvp.id id_tipo_valor_predefinido,p.placeholder' );

        $this->db->from($this->modulos.' m');
        $this->db->join($this->relacion_modulo__encabezado_pregunta.' r', ' r.id_modulo = m.id');
        $this->db->join($this->encabezado_pregunta.' e', ' r.id_encabezado_pregunta = e.id');
        $this->db->join($this->preguntas.' p', ' r.id = p.id_modulo__encabezado_pregunta');

        $this->db->join($this->tipo_pregunta.' t', 't.id = p.id_tipo_pregunta');
        $this->db->join($this->relacion_valores_pregunta.' v', 'v.id_pregunta = p.id','LEFT');
        $this->db->join($this->valores_predefinidos.' vp', 'vp.id = v.id_valores_predefinidos','LEFT');
        $this->db->join($this->tipo_valores_predefinidos.' tvp', 'tvp.id = vp.id_tipo_valores_predefinidos','LEFT');



        $where = '(
                        ( (m.id ='.$this->subcategoria.')  AND (r.id ='.$data["id_encabezado"].')  AND (p.wildcard IS NULL) )
              )';
        $this->db->where($where);
        $this->db->group_by('p.id_numeracion_pregunta');
        $this->db->order_by('p.id_numeracion_pregunta');

        $result = $this->db->get();


        if ($result->num_rows() > 0) {
            return $result->result();
        }else {
            return FALSE;
            //$login->free_result();
        }
    }

    public function listado_respuestas_abogados_tarifa($tarifa)
    {

        //$this->db->select('c1,c2,c3,c4,c5,c6,c7,c8,c9,c10,c11,c12,c13,c14,c15,c16,c17,c8,c19,c20,c21,c22,c23,c24,c25');
        $this->db->select('*');
        $this->db->from('kerma_op_profesionales');
        $this->db->where('id_detalle_tipo_profesional',$tarifa[0]);
        $result = $this->db->get();

        if ($result->row_array() > 0)
            return $result->row_array();
        else
            return FALSE;
        //$login->free_result();

    }










}