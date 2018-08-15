<?php if(! defined('BASEPATH')) exit('No tienes permiso para acceder a este archivo');

/**
 * Class model_human_capital
 */
class model_reportes extends CI_Model
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
        $result = $this->db->get()->row_array();

        //echo "<pre>" . print_r($this->db,1) . "</pre>";
        $data=$this->clear($result);

        return $data;



    }
    public function getUserDataByNoHumanCapital($question,$id_usuario)
    {

        $this->db->select($question);
        $this->db->from($this->table);
        $this->db->where('id_usuario',$id_usuario);
        $result = $this->db->get()->row_array();

        //echo "<pre>" . print_r($this->db,1) . "</pre>";
        $data=$this->clear($result);

        return $data;



    }

    public function getUsersDataByHumanCapital($question,$id_ahc,$id_usuario)
    {

        $this->db->select($question);
        $this->db->from($this->table);
        $this->db->where('id_cha',$id_ahc);
        $this->db->where('id_usuario !=',$id_usuario);

        $result = $this->db->get()->result_array();

        $data=$this->clear2($result);


        return $data;

    }
    public function getUsersDataByNoHumanCapital($question,$id_usuario)
    {

        $this->db->select($question);
        $this->db->from($this->table);
        $this->db->where('id_usuario !=',$id_usuario);
        $result = $this->db->get()->result_array();
        //echo "<pre>" . print_r($this->db,1) . "</pre>";
        $data=$this->clear2($result);
        return $data;

    }

    public function setSection($table)
    {

        switch ($table) {
            case 'kerma_op_profesionales':
                $this->table = $this->db->dbprefix('op_profesionales');
                break;
            case 'kerma_op_administrativos':
                $this->table = $this->db->dbprefix('op_administrativos');
                break;
            case 'kerma_op_prestaciones':
                $this->table = $this->db->dbprefix('op_prestaciones');
                break;
            case 'kerma_op_otras_prestaciones':
                $this->table = $this->db->dbprefix('op_otras_prestaciones');
                break;
            case 'kerma_op_ti':
                $this->table = $this->db->dbprefix('op_ti');
                break;
            case 'kerma_op_merca_promocion':
                $this->table = $this->db->dbprefix('op_merca_promocion');
                break;
        }
    }

    private function clear(&$data)
    {

        $result=[];
        $i=0;
        foreach ($data as $item=>$value) {
            $result[$i]=$value;
            $i++;
        }

        return $result;
    }
    private function clear2(&$data)
    {
        $j=0;
        $result=[];
        foreach ($data as $key=>$value) {
            $j=0;
            foreach ($data[$key] as $key2=>$value2) {
                $result[$key][$j]= $value2;
                $j++;
           }
        }
        return $result;

    }

    public function getDescriptionbyHumanCapital($question,$id_ahc,$id_usuario)
    {

        $this->db->select($question.' as valor');
        $this->db->select('id_cha as capital_humano, cch.descripcion as categoria, gch.descripcion as grupo, rch.descripcion as rango,');
        $this->db->select('CONCAT(cch.descripcion," ",gch.descripcion, " " ,rch.descripcion) as descripcion',false);
        $this->db->from($this->table);
        $this->db->join('kerma_capital_humano_actual cha','cha.id=id_cha','left');
        $this->db->join('kerma_categoria_capital_humano cch','cch.id=cha.id_categoria_capital_humano','left');
        $this->db->join('kerma_grupo_capital_humano gch','gch.id=cha.id_grupo_capital_humano','left');
        $this->db->join('kerma_rango_capital_humano rch','rch.id=cha.id_rango_capital_humano','left');
        $this->db->where('id_cha',$id_ahc);
        $this->db->where('id_usuario',$id_usuario);
        $result = $this->db->get()->row_array();

        //echo "<pre>" . print_r($this->db,1) . "</pre>";
        $data=$this->clear($result);
        //var_dump($data);
        return $data;
    }



    public function getDescriptionbyHumanCapital2($id_ahc)
    {

        $this->db->select('cha.id,
	    cch.descripcion as categoria,
	    gch.descripcion as grupo,
	    rch.descripcion as rango,');
        $this->db->select('CONCAT(cch.descripcion," ",gch.descripcion, " " ,rch.descripcion) as descripcion',false);
        $this->db->from('kerma_capital_humano_actual as cha' );
        $this->db->join('kerma_categoria_capital_humano cch','cch.id=cha.id_categoria_capital_humano','left');
        $this->db->join('kerma_grupo_capital_humano gch','gch.id = cha.id_grupo_capital_humano','left');
        $this->db->join('kerma_rango_capital_humano rch','rch.id = cha.id_rango_capital_humano','left');
        $this->db->where('cha.id',$id_ahc);

        $data = $this->db->get()->row_array();
        $result=$data['categoria']." ".$data['grupo']." ".$data['rango'];
        //echo "<pre>" . print_r($this->db,1) . "</pre>";
        //$data=$this->clear($result);
        //var_dump($result);
        return $result;
    }

    public function getReportStruct($subindice)
    {

        $this->db->select('*');
        $this->db->from('kerma_reportes');
        $this->db->where('subindice',$subindice);
        $result = $this->db->get()->result_array();
        //echo "<pre>" . print_r($this->db,1) . "</pre>";
        return $result;
    }



    public function getHumanCapital($categorias,$grupos)
    {
        //$_tmp=array_search('5',$categorias);
        //var_dump($categorias);

        $this->db->select('
            cha.id,
            mch.id as modulo_id,
            mch.descripcion as descripcion,
            cch.id as categoria_id,
            cch.descripcion as categoria,
            gch.id as grupo_id,
            gch.descripcion as grupo,
            rch.id as rango_id,
            rch.descripcion as rango,'
        );
        
        $this->db->from('kerma_capital_humano_actual as cha');
        $this->db->join('kerma_modulos_capital_humano mch','mch.id   = cha.id_modulo_capital_humano','left');
        $this->db->join('kerma_categoria_capital_humano cch','cch.id  = cha.id_categoria_capital_humano','left');
        $this->db->join('kerma_grupo_capital_humano gch','gch.id = cha.id_grupo_capital_humano','left');
        $this->db->join('kerma_rango_capital_humano rch','rch.id = cha.id_rango_capital_humano','left');
        $this->db->where('cch.id IN('.$categorias.') AND gch.id IN (' .$grupos .')');
        $this->db->order_by('cha.id');

        $result = $this->db->get()->result_array();
        //var_dump($result);
        //echo "<pre>" . print_r($this->db,1) . "</pre>";
        return $result;
    }



}


