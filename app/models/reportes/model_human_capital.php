<?php if(! defined('BASEPATH')) exit('No tienes permiso para acceder a este archivo');

/**
 * Class model_human_capital
 */
class model_human_capital extends CI_Model
{
    private $table;
    public function __construct()
    {
        parent::__construct();
        $this->db = $this->load->database('default', true);


    }
    public function getUserDataByHumanCapital($question,$id_ahc,$id_usuario)
    {

        $this->db->select($question);
        $this->db->from($this->table);
        $this->db->where('id_cha',$id_ahc);
        $this->db->where('id_usuario',$id_usuario);
        $result = $this->db->get();
        //echo "<pre>" . print_r($this->db,1) . "</pre>";
        return $result->row_array();
    }

    public function getUsersDataByHumanCapital($question,$id_ahc,$id_usuario)
    {

        $this->db->select($question);
        $this->db->from($this->table);
        $this->db->where('id_cha',$id_ahc);
        $this->db->where('id_usuario !=',$id_usuario);
        $result = $this->db->get();
        return $result->result_array();

    }

    public function setSection($table)
    {
        switch ($table) {
            case 'profesionales':
                $this->table = $this->db->dbprefix('op_profesionales');
                break;
            case 'administrativos':
                $this->table = $this->db->dbprefix('op_administrativos');
                break;
        }
    }

}


