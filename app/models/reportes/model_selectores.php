<?php if(! defined('BASEPATH')) exit('No tienes permiso para acceder a este archivo');

/**
 * Class model_human_capital
 */
class model_selectores extends CI_Model
{
    private $table;

    public function __construct()
    {
        parent::__construct();
        $this->db = $this->load->database('default', true);


    }

    public function getReportesIndice($valor)
    {

        $this->db->select('indice,indice_descripcion');
        $this->db->from('kerma_reportes');
        $this->db->where('modulo_id',$valor);

        $this->db->group_by('indice');
        $result = $this->db->get()->result_array();

        //echo "<pre>" . print_r($result) . "</pre>";
        //$data=$this->clear($result);
        return $result;


    }

    public function getReportesSubIndice($valor)
    {

        $this->db->select('subindice,subindice_descripcion');
        $this->db->from('kerma_reportes');
        $this->db->where('indice',$valor);

        $this->db->group_by('subindice');
        $result = $this->db->get()->result_array();

        //echo "<pre>" . print_r($result) . "</pre>";
        //$data=$this->clear($result);
        return $result;


    }

    public function getCategorias($valor)
    {

        $this->db->select('categoria_id,categoria_descripcion');
        $this->db->from('kerma_reportes');
        $this->db->where('subindice',$valor);

        $this->db->group_by('subindice');
        $result = $this->db->get()->result_array();

        //echo "<pre>" . print_r($result) . "</pre>";
        //$data=$this->clear($result);
        return $result;


    }

    public function getGrupos($valor)
    {

        $this->db->select('grupo_id,grupo_descripcion');
        $this->db->from('kerma_reportes');
        $this->db->where('categoria_id',$valor);

        $this->db->group_by('categoria_id');
        $result = $this->db->get()->result_array();

        //echo "<pre>" . print_r($result) . "</pre>";
        //$data=$this->clear($result);
        return $result;


    }

    public function getModulos()
    {

        $this->db->select('modulo_id,modulo_descripcion');
        $this->db->from('kerma_reportes');
        $this->db->group_by('modulo_id');
        $result = $this->db->get()->result_array();

        //echo "<pre>" . print_r($result) . "</pre>";
        //$data=$this->clear($result);
        return $result;


    }

    public function getSubcategorias($indice)
    {

        $this->db->select('subindice,subindice_descripcion');
        $this->db->from('kerma_reportes');
        $this->db->where('indice',$indice);
        $this->db->group_by('subindice');
        $result = $this->db->get()->result_array();
       // echo "<pre>" . print_r($this->db,1) . "</pre>";

        return $result;
    }
    public function getSubSecciones($indice)
    {

        $this->db->select('subindice,subindice_descripcion');
        $this->db->from('kerma_reportes');
        $this->db->where('indice',$indice);
        $this->db->group_by('subindice');
        $result = $this->db->get()->result_array();
        // echo "<pre>" . print_r($this->db,1) . "</pre>";

        return $result;
    }


    public function getIdentificadores($subindice)
    {

        $this->db->select('categoria_id,categoria_descripcion');
        $this->db->from('kerma_reportes');
        $this->db->where('subindice',$subindice);
        $result = $this->db->get()->result_array();
         echo "<pre>" . print_r($this->db,1) . "</pre>";






        /*
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
        $this->db->where('cch.id IN('.$categorias.')') ;
        $this->db->group_by('cch.id');
        $this->db->order_by('cha.id');

        $result = $this->db->get()->result_array();
        //echo "<pre>" . print_r($this->db,1) . "</pre>";

        */
        return $result;
    }

}