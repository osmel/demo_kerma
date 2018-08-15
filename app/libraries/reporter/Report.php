<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');



class Report
{
    protected $reporte;
    protected $reporteId;
    protected $userId;

     const NA    = 'NA';
     const UP    = 'Arriba';
     const DOWN  = 'Abajo';

    public function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->model('reportes/model_reportes');
        $this->CI->load->library('statics');
    }

    public function reporte($subindice)
    {
        $report=[];
        $this->userId='2732e323-83a4-11e8-be07-bcee7be16e8e';
        $struct=$this->getReportStructure($subindice);


        $this->CI->model_reportes->setSection($struct['tabla']);
        $i=0;
        foreach ($struct['human_capital'] as $humancapital) {
            $preguntas=implode(",", $struct['respuestas']);
            $report[$i]['human_capital']= $this->CI->model_reportes->getDescriptionbyHumanCapital2($humancapital);
            $data = $this->CI->model_reportes->getUserDataByHumanCapital($preguntas,$humancapital,$this->userId);

            if(@$data[0]==NULL || @$data[0]==""|| empty(@$data[0]))
                {
                    @$report[$i]['user']="NA";
                }else{
                    @$report[$i]['user']=$data[0];
                }

            $data = $this->CI->model_reportes->getUsersDataByHumanCapital($preguntas, $humancapital, $this->userId);
            $report[$i]['promedio'] =$this->getPromedio($data);
            $report[$i]['cuartiles']=$this->getCuartiles($data);
            $report[$i]['niveles'] =$this->getNiveles($data);
            $report[$i]['ranking'] =$this->getRanking($data,$report[$i]['user']);
            $report[$i]['vsprom'] =$this->getPromedioComparativo($report[$i]['user'],$report[$i]['promedio']);
            $report[$i]['subtitulo']=$struct['subindice_descripcion'];
            $i++;
        }


        return $this->prepareJson($report);
    }


    public function getPromedio($data)
     {


         if( !empty($data)) {


             $i = 0;
             $matrix = [];
             foreach ($data as $item) {

                 if ($item[0] != null) {
                     $matrix[$i] = $item[0];
                     $i++;

                 }
             }

             $promedio= $this->CI->statics->average($matrix);

         }else{
             // Todos los datos de los usuarios estan vacios
             $promedio="No existen datos";
         }


         return $promedio;
     }

     public function getCuartiles($data)
     {

         $matrix=$this->mixMatrix($data);


         $quartiles= $this->CI->statics->quartiles($matrix);
         return $quartiles;

     }


     public function getNiveles($data)
     {

             $matrix=$this->mixMatrix($data);

             $levels= $this->CI->statics->levels($matrix);

             return $levels;

         }

     public function getRanking($data,$usuario_promedio)
     {
         $matrix=$this->mixMatrix($data);

         array_push($matrix, $usuario_promedio);
         $ranking= $this->CI->statics->ranking_desc($matrix);
         $pos = array_search($usuario_promedio, array_column($ranking, 'value'));
         $rank=$ranking[$pos]['ranking'];

         return $rank . '.°';
     }
     public function getPromedioComparativo($usuario_promedio,$usuarios_promedio)
     {

         $vsprom='';

        if(is_numeric($usuario_promedio) && is_numeric($usuarios_promedio)) {
            if ($usuario_promedio >= $usuarios_promedio) {
                $vsprom = self::UP;
            } elseif ($usuario_promedio <= $usuarios_promedio) {
                $vsprom = self::DOWN;
            }
        }else{
            $vsprom = self::NA;
        }

         return $vsprom;
     }



    public function getReportStructure($subindice)
    {
        $struct=[];
        $data=$this->CI->model_reportes->getReportStruct($subindice);

        $struct['id']=$data[0]['id'];
        $struct['indice']=$data[0]['indice_descripcion'];
        $struct['subindice']=$data[0]['subindice'];
        $struct['subindice_descripcion']=$data[0]['subindice_descripcion'];
        $struct['modulo_id']=$data[0]['modulo_id'];
        $struct['modulo_descripcion']=$data[0]['modulo_descripcion'];
        $struct['tabla']=$data[0]['tabla'];

        $struct['categoria_id']=explode('|',$data[0]['categoria_id']);
        $struct['categoria_descripcion']=explode('|',$data[0]['categoria_descripcion']);
        $struct['grupo_id']=explode('|',$data[0]['grupo_id']);
        $struct['grupo_descripcion']=explode('|',$data[0]['grupo_descripcion']);
        //$struct['human_capital']=explode('|',$data[0]['human_capital']);

        $struct['respuestas']=explode('|',$data[0]['respuestas']);
        $struct['preguntas']=explode('|',$data[0]['preguntas']);
        $struct['human_capital']=$this->getHumanCapital($struct);





        return $struct;
    }

    public function mixMatrix($data)
    {
        $i=0;
        $matrix=[];

        foreach ($data as $item)
        {
            if($item[0] != null){
                $matrix[$i] = $item[0];
                $i++;
            }
        }

        return $matrix;
    }
    public function setReporteId($reporteId)
    {
        $this->reporteId=$reporteId;
    }

    public function getHumanCapital($struct)
    {
        $categorias=[];
        $grupos=[];
        $hc=[];
        $categorias=implode(",",$struct['categoria_id']);
        $grupos=implode(",",$struct['grupo_id']);
        $results =$this->CI->model_reportes->getHumanCapital($categorias,$grupos);
        $i=0;
        foreach ($results as $result) {
            $hc[$i]=$result['id'];
            $i++;
        }

       return $hc;
    }


    public function prepareJson($report)
    {

        $json_data=[];
        $json_data['meta']['page']='1';
        $json_data['meta']['pages']='1';
        $json_data['meta']['perpage']='1';
        $json_data['meta']['total']='1';
        $json_data['meta']['sort']='asc';
        $json_data['meta']['field']='promedio';

        for($i=0;$i<count($report);$i++) {
            $json_data['data'][$i]['subtitulo']=$report[$i]['subtitulo'];
            $json_data['data'][$i]['humancapital']=$report[$i]['human_capital'];
            $json_data['data'][$i]['usuario']=$report[$i]['user'];
            $json_data['data'][$i]['promedio']=$report[$i]['promedio'];
            $json_data['data'][$i]['q1']=$report[$i]['cuartiles']['q1'];
            $json_data['data'][$i]['q2']=$report[$i]['cuartiles']['q2'];
            $json_data['data'][$i]['q3']=$report[$i]['cuartiles']['q3'];
            $json_data['data'][$i]['alto']=$report[$i]['niveles']['high'];
            $json_data['data'][$i]['bajo']=$report[$i]['niveles']['low'];
            $json_data['data'][$i]['ranking']=$report[$i]['ranking'];
            $json_data['data'][$i]['vsprom']=$report[$i]['vsprom'];
        }


        return $json_data;

    }
}