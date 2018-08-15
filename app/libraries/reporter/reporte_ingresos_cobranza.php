<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once('Report.php');
class reporte_ingresos_cobranza extends Report
{
    public function __construct()
    {
        parent::__construct();

    }

    public function reporte($subindice,$periodo,$anio,$muestras)
    {
        $report = [];
        $this->userId = '2732e323-83a4-11e8-be07-bcee7be16e8e';
        $struct = $this->getReportStructure($subindice);


        $this->CI->model_reportes->setSection($struct['tabla']);
        $i = 0;

            foreach ($struct['respuestas'] as $respuesta) {


                //$preguntas=implode(",", $struct['respuestas']);
                $preguntas = $respuesta;

                $data = $this->CI->model_reportes->getUserDataByNoHumanCapital($preguntas, $this->userId,$periodo,$anio);

                //return $this->prepareJson($report);
                if (@$data[0] == NULL || @$data[0] == "" || empty(@$data[0])) {
                    @$report[$i]['user'] = "NA";
                } else {
                    @$report[$i]['user'] = $data[0];
                }
                $data = $this->CI->model_reportes->getUsersDataByNoHumanCapital($preguntas, $this->userId,$periodo,$anio,$muestras);
                $report[$i]['promedio'] =$this->getPromedio($data);
                $report[$i]['cuartiles']=$this->getCuartiles($data);
                $report[$i]['niveles'] =$this->getNiveles($data);
                $report[$i]['ranking'] =$this->getRanking($report[$i]);
                $report[$i]['vsprom'] =$this->getPromedioComparativo($report[$i]['user'],$report[$i]['promedio']);
                $report[$i]['subtitulo']=$struct['subindice_descripcion'];
                $report[$i]['pregunta'] = $struct['preguntas'][$i];



                $i++;

            }

        return $this->prepareJson($report);






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



        $struct['section_id']=explode('|',$data[0]['section_id']);
        $struct['seccion_descripcion']=explode('|',$data[0]['seccion_descripcion']);
        $struct['subsection_id']=explode('|',$data[0]['subsection_id']);
        $struct['subsection_descripcion']=explode('|',$data[0]['subseccion_descripcion']);
        $struct['respuestas']=explode('|',$data[0]['respuestas']);
        $struct['preguntas']=explode('|',$data[0]['preguntas']);


        return $struct;
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
            $json_data['data'][$i]['pregunta'] = $report[$i]['pregunta'];
            $json_data['data'][$i]['subtitulo']=$report[$i]['subtitulo'];
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

       return $json_data;


    }
}