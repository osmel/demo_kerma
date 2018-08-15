<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
require_once('Report.php');
class reporte_ti extends Report
{
    public function __construct()
    {
        parent::__construct();

    }

    public function reporte($subindice)
    {
        $report = [];
        $this->userId = '2732e323-83a4-11e8-be07-bcee7be16e8e';
        $struct = $this->getReportStructure($subindice);


        $this->CI->model_reportes->setSection($struct['tabla']);
        $i = 0;

            foreach ($struct['respuestas'] as $respuesta) {


                //$preguntas=implode(",", $struct['respuestas']);
                $preguntas = $respuesta;

                $data = $this->CI->model_reportes->getUserDataByNoHumanCapital($preguntas, $this->userId);

                //return $this->prepareJson($report);
                if (@$data[0] == NULL || @$data[0] == "" || empty(@$data[0])) {
                    @$report[$i]['user'] = "NA";
                } else {
                    @$report[$i]['user'] = $data[0];
                }
                $data = $this->CI->model_reportes->getUsersDataByNoHumanCapital($preguntas, $this->userId);
                $report[$i]['porcentajes'] = $this->getPorcentaje($data);
                $report[$i]['pregunta'] = $struct['preguntas'][$i];



                $i++;

            }

        return $this->prepareJson($report);






    }

    public function getPorcentaje($data)
    {

        $porcentajes=[];
        $total_si = 0;
        $total_no = 0;
        $total = count($data);
        foreach ($data as $item) {

            if ($item[0] !== NULL) {
                $total_si++;
            } else {
                $total_no++;
            }
        }

        $porcentajes['si'] = round((($total_si * 100) / $total),2,PHP_ROUND_HALF_UP);
        $porcentajes['no'] = round((($total_no * 100) / $total),2,PHP_ROUND_HALF_UP);

        return $porcentajes;
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

        $json_data = [];
        $json_data['meta']['page'] = '1';
        $json_data['meta']['pages'] = '1';
        $json_data['meta']['perpage'] = '1';
        $json_data['meta']['total'] = '1';
        $json_data['meta']['sort'] = 'asc';
        $json_data['meta']['field'] = 'promedio';

        for ($i = 0; $i < count($report); $i++) {

            // $json_data['data'][$i]['humancapital'] = $report[$i]['human_capital'];
            $json_data['data'][$i]['user'] = $report[$i]['user'];
            $json_data['data'][$i]['porcentaje_si'] = $report[$i]['porcentajes']['si'];
            $json_data['data'][$i]['porcentaje_no'] = $report[$i]['porcentajes']['no'];
            $json_data['data'][$i]['pregunta'] = $report[$i]['pregunta'];

        }


       return $json_data;


    }
}