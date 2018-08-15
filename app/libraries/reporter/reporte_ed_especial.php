<?php
require_once('Report.php');
class reporte_ed_especial extends Report
{
    public function __construct()
    {
        parent::__construct();

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
            $report[$i]['user'] = $this->getMultipleUserData($data);

            if(@$data[0]==NULL || @$data[0]==""|| empty(@$data[0]))
            {
                @$report[$i]['raw']="NA";
            }else{
                @$report[$i]['raw']=$data[0];
            }



            $data = $this->CI->model_reportes->getUsersDataByHumanCapital($preguntas, $humancapital, $this->userId);
            $report[$i]['users'] = $this->getMultipleUsersData($data);



           $report[$i]['cuartiles']=$this->getCuartiles($data);
           $report[$i]['niveles'] =$this->getNiveles($data);
           $report[$i]['ranking'] =$this->getRanking($data,$report[$i]['user']['totalhm']);
           $report[$i]['vsprom'] =$this->getPromedioComparativo($report[$i]['user']['totalhm'],$report[$i]['users']['promedio']);
           $report[$i]['subtitulo']=$struct['subindice_descripcion'];

            $i++;
        }

        return $this->prepareJson($report);
    }


    public function getMultipleUserData(&$data)
    {
        $result=[];
        if(!empty($data)) {
            $hombres = $data[0];
            $mujeres = $data[1];
            $total=$hombres+$mujeres;

            if($total>0) {
                //Si la consulta devuelve datos mayores a 0 para  hombre o mujer o ambos se realizan los promedios
                $result['hombres'] = number_format(($hombres * 100) / ($hombres + $mujeres), 2, '.', ',');
                $result['mujeres'] = number_format(($mujeres * 100) / ($hombres + $mujeres), 2, '.', ',');
                $result['totalhm'] = $hombres + $mujeres;
            }elseif ($total<=0){
                //Si la consulta devuelve 0 para hombre o mujer
                $result['totalhm'] = 0;
                $result['hombres'] = 0;
                $result['mujeres'] = 0;
            }
        }else{
            //Si la consulta devuelve null o no hay nada
            $result['totalhm'] = self::NA;
            $result['hombres'] = self::NA;
            $result['mujeres'] = self::NA;

        }

        return $result;
    }

    public function getMultipleUsersData(&$data)
    {
        $i=0;
        $hombres=0;
        $mujeres=0;



        foreach ($data as $item) {
            //Si los datos son nulos no los tomamos en cuenta y los promediamos por $i /..es necesario ya que en los datos(consulta)
            // llegan datos  con estos campos campos nulos y es necesario eliminarlos para no afectar el promedio
            //La suma de un numero con un nullo es como si fuera un 0 (contrario a lo que pasa en las base de datos) ejem 2+null= 2  en BD 2+null = null
            //por lo tanto no hay problema si uno de los datos hombre o mujer viene con dato nulo
            if(!empty($item['0']) OR !empty($item['1'])) {
                $i++;
                $hombres  += $item['0'];
                $mujeres  += $item['1'];

            }

        }

        $promedio=($hombres+$mujeres)/$i;

        $result['promedio']=(float)number_format(($promedio),2,'.',',');
        $result['hombres']=(float)number_format(($hombres*100)/($hombres+$mujeres),2,'.',',');
        $result['mujeres']=(float)number_format(($mujeres*100)/($hombres+$mujeres),2,'.',',');



        return $result;
    }

    public function getCuartiles($data)
    {

        $matrix=$this->mixMatrix($data);
        $quartiles=$this->CI->statics->quartiles($matrix);
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

    public function mixMatrix($data)
    {
        $i = 0;
        $matrix = [];
        foreach ($data as $item) {
            if (!empty($item['0']) OR !empty($item['1'])) {
                $matrix[$i] = $item['0'] + $item['1'];
                $i++;
            }
        }

        return $matrix;
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
            $json_data['data'][$i]['usuario']=$report[$i]['user']['totalhm'];
            $json_data['data'][$i]['ph1']=$report[$i]['user']['hombres'];
            $json_data['data'][$i]['pm1']=$report[$i]['user']['mujeres'];

            $json_data['data'][$i]['promedio']=$report[$i]['users']['promedio'];

            $json_data['data'][$i]['ph2']=$report[$i]['users']['hombres'];
            $json_data['data'][$i]['pm2']=$report[$i]['users']['mujeres'];

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