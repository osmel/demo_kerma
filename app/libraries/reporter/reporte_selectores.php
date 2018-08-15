<?php


class reporte_selectores
{
    public function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->model('reportes/model_selectores');
    }

    public function getReportesIndice($valor)
    {

        $indices=$this->CI->model_selectores->getReportesIndice($valor);
        $select="";
        $select .= '<option>Selecciona una opción</option>' . PHP_EOL;
        foreach ($indices as $indice=>$key) {
          $select.='<option value=\''.addslashes($key['indice']).'\'>'.$key['indice_descripcion'].'</option>'.PHP_EOL;
        }

       return $select;
    }

    public function getReportesSubIndice($valor)
    {

        $subindices=$this->CI->model_selectores->getReportesSubIndice($valor);
        $select="";

        foreach ($subindices as $subindice=>$key) {
            $select.='<option value=\''.addslashes($key['subindice']).'\'>'.$key['subindice_descripcion'].'</option>'.PHP_EOL;
        }

        return $select;
    }

    public function getCategorias_old($valor)
    {

        $categorias=$this->CI->model_selectores->getCategorias($valor);

        $catId=explode('|',$categorias[0]['categoria_id']);
        $catName=explode('|',$categorias[0]['categoria_descripcion']);
        $categories['descripcion']=$catName;
        $categories['id']=$catId;
        $select="";

        for ($i=0; $i<count($categories['id']);$i++){
            $select .= '<option value=\'' . addslashes($categories['id'][$i]) . '\'>' . $categories['descripcion'][$i] . '</option>' . PHP_EOL;
        }




        return $select;
    }
    public function getGrupos($valor)
    {

        $grupos=$this->CI->model_selectores->getGrupos($valor);
        var_dump($valor);
        $groupId=explode('|',$grupos[0]['grupo_id']);
        $groupName=explode('|',$grupos[0]['grupo_descripcion']);
        $groups['descripcion']=$groupName;
        $groups['id']=$groupId;
        $select="";

        for ($i=0; $i<count($groups['id']);$i++){
            $select .= '<option value=\'' . addslashes($groups['id'][$i]) . '\'>' . $groups['descripcion'][$i] . '</option>' . PHP_EOL;
        }




        return $select;
    }


    public function getModulos()
    {
        $modulos=$this->CI->model_selectores->getModulos();
        $select="";
        $select .= '<option>Selecciona una opción</option>' . PHP_EOL;
        foreach ($modulos as $modulo=>$key) {
            $select.='<option value=\''.addslashes($key['modulo_id']).'\'>'.$key['modulo_descripcion'].'</option>'.PHP_EOL;
        }

        return $select;
    }

    public function getSubcategorias($valor)
    {

        $subindices=$this->CI->model_selectores->getSubcategorias($valor);


        $select="";

        foreach ($subindices as $subindice=>$key) {
            $select.='<option value=\''.addslashes($key['subindice']).'\'>'.$key['subindice_descripcion'].'</option>'.PHP_EOL;
        }

        return $select;
    }

    public function getCategorias($subindice)
    {


        $categorias=$this->CI->model_selectores->getCategorias($subindice);

        $categorias_id=explode('|',$categorias[0]['categoria_id']);
        $categorias_descripcion=explode('|',$categorias[0]['categoria_descripcion']);

        $categorias=[];
        $categorias = array_combine($categorias_descripcion,$categorias_id);

        $select="";
        foreach ($categorias as $categoria=>$key) {
            $select.='<option value=\''.addslashes($key).'\'>'.$categoria.'</option>'.PHP_EOL;

        }

        return $select;

    }

    public function getPeriodos()
    {
        $periodos=$this->CI->model_selectores->getPeriodos();

        $select="";

        foreach ($periodos as $periodo=>$key) {
            $select.='<option value=\''.addslashes($key['id']).'\'>'.$key['descripcion'].'</option>'.PHP_EOL;
        }

       return $select;
    }

    public function getAnios()
    {
        $anios=$this->CI->model_selectores->getAnios();

        $select="";

        foreach ($anios as $anio=>$key) {
            $select.='<option value=\''.addslashes($key['descripcion']).'\'>'.$key['descripcion'].'</option>'.PHP_EOL;
        }

        return $select;
    }

    public function getMuestras()
    {
        $muestras=$this->CI->model_selectores->getMuestras();
        //$selector="";
        //$selector.=" <select class='selectpicker'  multiple data-actions-box='true' id='muestras'>".PHP_EOL;



        $options="";

        foreach ($muestras as $muetra=>$key) {
            $options.='<option value=\''.addslashes($key['id_usuario']).'\'>'.$key['nombre'].'</option>'.PHP_EOL;
        }

        //$selector.=$options;
        //$selector.=" </select>".PHP_EOL;

        return $options;
    }





}