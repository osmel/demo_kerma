<?php
require_once('Report.php');
class reporte_seguros_jubilacion extends Report
{
    public function __construct()
    {
        parent::__construct();

    }


    public function reporte($reporteId)
    {
        $report = [];
        $this->userId = '2732e323-83a4-11e8-be07-bcee7be16e8e';
        $struct = $this->getReportStructure($reporteId);

        $this->CI->model_reportes->setSection($struct['tabla']);
        $i = 0;
        foreach ($struct['human_capital'] as $humancapital) {
            foreach ($struct['respuestas'] as $respuesta) {


                //$preguntas=implode(",", $struct['respuestas']);
                $preguntas = $respuesta;
                $report[$i]['human_capital'] = $this->CI->model_reportes->getDescriptionbyHumanCapital2($humancapital);
                $data = $this->CI->model_reportes->getUserDataByHumanCapital($preguntas, $humancapital, $this->userId);

                if (@$data[0] == NULL || @$data[0] == "" || empty(@$data[0])) {
                    @$report[$i]['user'] = "NA";
                } else {
                    @$report[$i]['user'] = $data[0];
                }

                $data = $this->CI->model_reportes->getUsersDataByHumanCapital($preguntas, $humancapital, $this->userId);
                //var_dump($data);
                //var_dump(count($data));

                $report[$i]['porcentaje'] = $this->getPorcentaje($data);
                $report[$i]['subtitulo'] = $struct['subindice_descripcion'];
                $report[$i]['pregunta'] = $struct['preguntas'][$i];

                $i++;

            }

        }

        return $this->prepareJson($report);


    }

    public function getPorcentaje($data)
    {


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

        $porcentaje = (($total_si * 100) / $total);

        return round($porcentaje, 2, PHP_ROUND_HALF_UP);
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
            $json_data['data'][$i]['subtitulo'] = $report[$i]['subtitulo'];
           // $json_data['data'][$i]['humancapital'] = $report[$i]['human_capital'];
            $json_data['data'][$i]['porcentaje'] = $report[$i]['porcentaje'];
            $json_data['data'][$i]['pregunta'] = $report[$i]['pregunta'];

        }


        return $json_data;


    }
}