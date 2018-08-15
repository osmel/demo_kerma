<?php if(! defined('BASEPATH')) exit('No tienes permiso para acceder a este archivo');

class model_migracion extends CI_Model{

    private $key_hash;
    public function __construct()
    {
        parent::__construct();

        //$this->db1=$this->load->database('default', true);
        $this->db2=$this->load->database('original', true);
        $this->db1=$this->load->database('default', true);
        $this->key_hash    = $_SERVER['HASH_ENCRYPT'];
    }




    public function db_get_data_by_question($user_id,$questions)
    {
        $this->db2->select('a.id,
	a.actual_human_capital_id,
	a.value_numeric,
	a.string_value,
	a.question_id,
	a.user_id,
	u.full_name,
	u.email,
	u.username,
	q.name,
	q.section_subsection_id,
	q.id_question,
	a.date_created,
	a.last_updated,
	sec.id as section_id,
	sec.name as section_name,
	sub.id as subsection_id,
	sub.name as subsection_name');

        $this->db2->from('answer a');
        $this->db2->join('question q','q.id = a.question_id');
        $this->db2->join('section_subsection ss','ss.id = q.section_subsection_id');
        $this->db2->join('section sec','sec.id = ss.section_id');
        $this->db2->join('subsection sub','sub.id = ss.subsection_id');
        $this->db2->join('user u','u.id=a.user_id');

        $this->db2->where('question_id IN ('.$questions.')');
        $this->db2->where('user_id',$user_id);
        $this->db2->order_by('question_id','ASC');
        $result = $this->db2->get();
        //echo "<pre>" . print_r($this->db2,1) . "</pre>";
        return $result->result_array();
    }
    public function db_get_data_by_actual_human_capital($user_id,$ahc_id)
    {
        $this->db2->select('a.id,
	a.actual_human_capital_id,
	a.date_created,
	a.last_updated,
	a.value_numeric,
	a.value_date,
	a.question_id,
	a.user_id,
	q.name,
	q.section_subsection_id,
	q.id_question,
	sec.id AS section_id,
	sec.name AS section_name,
	sub.id AS subsection_id,
	sub.name AS subsection_name,
	ahc.category_human_capital_id AS chc_id,
	chc.description AS chc_description,
	ahc.group_human_capital_id AS ghc_id,
	ghc.description AS ghc_description,
	ahc.range_human_capital_id AS rhc_id,
	rhc.description AS rhc_description');

        $this->db2->from('answer a');
        $this->db2->join('question q','q.id=a.question_id','left');
        $this->db2->join('section_subsection ss','ss.id = q.section_subsection_id','left');
        $this->db2->join('section sec','sec.id = ss.section_id','left');
        $this->db2->join('subsection sub','sub.id = ss.subsection_id','left');
        $this->db2->join('actual_human_capital ahc','ahc.id = a.actual_human_capital_id','left');
        $this->db2->join('category_human_capital chc','chc.id = ahc.category_human_capital_id','left');
        $this->db2->join('group_human_capital ghc','ghc.id = ahc.group_human_capital_id','left');
        $this->db2->join('range_human_capital rhc','rhc.id = ahc.range_human_capital_id','left');


        $this->db2->where('actual_human_capital_id',$ahc_id);
        $this->db2->where('user_id',$user_id);
        $this->db2->order_by('question_id', 'ASC');

        $result = $this->db2->get();
        //echo "<pre>" . print_r($this->db2,1) . "</pre>";
        return $result->result_array();


    }

    public function db_get_usuarios_list()
    {
        $this->db2->select('*');
        $this->db2->from('user');

        $result = $this->db2->get();
        return $result->result_array();

    }

    public function db_set_usuarios_data($data)
    {


        $this->db1->set('id',$data['id']);
        $this->db1->set( 'email', "AES_ENCRYPT('{$data['email']}','{$this->key_hash}')", FALSE );
        $this->db1->set( 'contrasena', "AES_ENCRYPT('{$data['contrasena']}','{$this->key_hash}')", FALSE );
        $this->db1->set('id_perfil',$data['id_perfil']);
        $this->db1->set('permiso',$data['permiso']);
        $this->db1->set('creacion',$data['creacion']);
        $this->db1->set( 'telefono', "AES_ENCRYPT('{$data['telefono']}','{$this->key_hash}')", FALSE );
        $this->db1->set('activo',$data['activo']);
        $this->db1->set('nombre',$data['nombre']);
        $this->db1->set('apellidos',$data['apellidos']);
        $this->db1->set('fecha_nac',$data['fecha_nac']);
        $this->db1->set('estado',$data['estado']);
        $this->db1->set('fecha_pc',$data['fecha_pc']);
        $this->db1->set('id_usuario',$data['id_usuario']);
        $this->db1->set('fecha_mac',$data['fecha_mac']);
        $this->db1->set('especial',$data['especial']);
        $this->db1->insert('usuarios');

        if($this->db1->affected_rows() > 0){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    public function db_set_generales_data($data)
    {
        $this->db1->insert('kerma_op_generales', $data);
        if($this->db1->affected_rows() > 0){
            return TRUE;
        }else{
            return FALSE;
        }
    }

    public function db_set_ingresos_cobranza_data($data)
    {
        $this->db1->insert('kerma_op_ingreso_cobranza', $data);
        if($this->db1->affected_rows() > 0){
            return TRUE;
        }else{
            return FALSE;
        }
    }

    public function db_set_estructura_admin_data($data)
    {
        $this->db1->insert('kerma_op_estructura_admin', $data);
        if($this->db1->affected_rows() > 0){
            return TRUE;
        }else{
            return FALSE;
        }
    }

    public function db_set_bonos_incentivos_data($data)
    {
        $this->db1->insert('kerma_op_bonos_incentivos', $data);
        if($this->db1->affected_rows() > 0){
            return TRUE;
        }else{
            return FALSE;
        }
    }

    public function db_set_mercadotecnia_data($data)
    {
        $this->db1->insert('kerma_op_merca_promocion', $data);
        if($this->db1->affected_rows() > 0){
            return TRUE;
        }else{
            return FALSE;
        }
    }
    public function db_set_ti_data($data)
    {
        $this->db1->insert('kerma_op_ti', $data);
        if($this->db1->affected_rows() > 0){
            return TRUE;
        }else{
            return FALSE;
        }
    }




    public function db_set_profesionales_data($data)
    {
        $this->db1->insert('kerma_op_profesionales', $data);
        if($this->db1->affected_rows() > 0){
            return TRUE;
        }else{
            return FALSE;
        }
    }

    public function db_set_prestaciones_data($data)
    {
        $this->db1->insert('kerma_op_prestaciones', $data);
        if($this->db1->affected_rows() > 0){
            return TRUE;
        }else{
            return FALSE;
        }
    }

    public function db_set_otras_prestaciones_data($data)
    {
        $this->db1->insert('kerma_op_otras_prestaciones', $data);
        if($this->db1->affected_rows() > 0){
            return TRUE;
        }else{
            return FALSE;
        }
    }


    public function db_set_administrativos_data($data)
    {
        $this->db1->insert('kerma_op_administrativos', $data);
        if($this->db1->affected_rows() > 0){
            return TRUE;
        }else{
            return FALSE;
        }
    }

    public function db_get_users()
    {
        $this->db2->select('distinct(user_id)');
        $this->db2->from('answer');

        $result = $this->db2->get();
        return $result->result_array();

    }

    public function get_uuid()
    {
        $uuid = $this->db->query('SELECT UUID() AS uuid')->row()->uuid;
        return $uuid;
    }

    public function db_get_usuarios_kerma_new($user_id)
    {
        $this->db1->select('id');
        $this->db1->from('kerma_usuarios');
        $this->db1->where('id_usuario',$user_id);
        $result = $this->db1->get();
        return $result->row()->id;
    }


}
