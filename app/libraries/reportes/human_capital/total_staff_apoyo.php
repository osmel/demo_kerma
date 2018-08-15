<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//indice 2.3
class total_staff_apoyo
{
    private $id_usuario;
    private $reporte=array();
    public function __construct()

    {
        $this->CI =& get_instance();
        //parent::__construct();
        $this->id_usuario='2732e323-83a4-11e8-be07-bcee7be16e8e';
        $this->CI->load->model('reportes/model_human_capital');
        $this->CI->model_human_capital->setSection('administrativos');
        $this->CI->load->library('statics');


    }



    public function reporte()
    {
        $humancapital=array(63,64,65,66,67,68,69,70,71);
        //$humancapital=array(46);
        $this->question='c3,c4';
        $reporte=array();
        $i=0;
        for($i=0;$i<count($humancapital);$i++) {




             $data = $this->CI->model_human_capital->getUserDataByHumanCapital($this->question,$humancapital[$i], $this->id_usuario);
            $reporte[$i]['usuario']=$this->getUserData($data);
             $data = $this->CI->model_human_capital->getUsersDataByHumanCapital($this->question,$humancapital[$i], $this->id_usuario);
            $reporte[$i]['usuarios'] =$this->getUsersData($data);
            $reporte[$i]['usuarios']['niveles'] =$this->get_high_low($data);
            $reporte[$i]['usuarios']['cuartiles']=$this->get_quartiles($data);
            $reporte[$i]['usuario']['ranking']=$this->get_ranking($data,$reporte[$i]);
            $reporte[$i]['usuario']['vsprom']=$this->get_vsprom($reporte[$i]);

            //$this->debug($reporte);

        }

        $this->order_data($reporte);
    }

    private function getUserData(&$data)
    {



        if(!empty($data)) {
            $hombres = $data['c3'];
            $mujeres = $data['c4'];
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
            $result['totalhm'] = 'NA';
            $result['hombres'] = "NA";
            $result['mujeres'] = "NA";

        }

        return $result;
    }

    private function getUsersData(&$data)
    {

        $i=0;
        $hombres=0;
        $mujeres=0;



        foreach ($data as $item) {
            //Si los datos son nulos no los tomamos en cuenta y los promediamos por $i /..es necesario ya que en los datos(consulta)
            // llegan datos  con estos campos campos nulos y es necesario eliminarlos para no afectar el promedio
            //La suma de un numero con un nullo es como si fuera un 0 (contrario a lo que pasa en las base de datos) ejem 2+null= 2  en BD 2+null = null
            //por lo tanto no hay problema si uno de los datos hombre o mujer viene con dato nulo
            if(!empty($item['c3']) OR !empty($item['c4'])) {
                $i++;
                $hombres  += $item['c3'];
                $mujeres  += $item['c4'];

            }

        }

        $promedio=($hombres+$mujeres)/$i;

        $result['promedio']=(float)number_format(($promedio),2,'.',',');
        $result['hombres']=(float)number_format(($hombres*100)/($hombres+$mujeres),2,'.',',');
        $result['mujeres']=(float)number_format(($mujeres*100)/($hombres+$mujeres),2,'.',',');



        return $result;

    }

    private function  get_high_low(&$data)
    {

        $personal=array();

        foreach ($data as $item) {
            if (!empty($item['c3']) OR !empty($item['c4'])) {

                $sum = $item['c3'] + $item['c4'];

                array_push($personal,$sum);
            }
        }

        $result['alto']=max($personal);
        $result['bajo']=min($personal);


        return $result;

    }

    private function get_quartiles(&$data)
    {
        //https://www.mathportal.org/calculators/statistics-calculator/descriptive-statistics-calculator.php
        //http://www.universoformulas.com/estadistica/descriptiva/cuartiles/  Formula1
        //https://formulas.tutorvista.com/math/quartile-formula.html          Formula2

        $personal=array();
        foreach ($data as $item) {
            if (!empty($item['c3']) OR !empty($item['c4'])) {

                $sum = $item['c3'] + $item['c4'];
                array_push($personal,$sum);
            }
        }

        $quartiles=$this->CI->statics->quartiles($personal);
        return $quartiles;

    }

    private function get_vsprom($data)
    {

        $client=['me'=>100];
        if(is_numeric($data['usuario']['totalhm'])){
            if ($data['usuario']['totalhm'] > $data['usuarios']['promedio'])
                $vsprom = 'Arriba';
            else {
                $vsprom = 'Abajo';
            }

        }else{
            $vsprom="NA";
        }

        return $vsprom;
    }

    private function get_ranking(&$data,$reporte)
    {
        if($reporte['usuario']['totalhm']==="NA"){
           return "NA";
        }else {
            $matrix = [];
            $i = 0;
            foreach ($data as $item) {
                if (!empty($item['c3']) OR !empty($item['c4'])) {
                    $matrix[$i] = $item['c3'] + $item['c4'];
                    $i++;
                }
            }

            array_push($matrix, $reporte['usuario']['totalhm']);
            $ranking = $this->CI->statics->ranking_desc($matrix);
            $pos = array_search($reporte['usuario']['totalhm'], array_column($ranking, 'value'));
            $rank_pos=$ranking[$pos]['ranking'];
            return $rank_pos. "°";
            //$rank = new NumberFormatter("es", NumberFormatter::ORDINAL);
            //return $rank->format($rank_pos);

        }
    }


    private function order_data($data)
    {


echo '
<table border="1" cellpadding="1">
<tbody>
<tr>
<td>&nbsp;Ava</td>
<td>%H&nbsp;</td>
<td>%M</td>
<td>Promedio&nbsp;</td>
<td>H%&nbsp;</td>
<td>M%&nbsp;</td>
<td>25%&nbsp;</td>
<td>50%&nbsp;</td>
<td>75%&nbsp;</td>
<td>Alto&nbsp;</td>
<td>Bajo&nbsp;</td>
<td>Rank</td>
<td>vsprom</td>
</tr>';
        foreach ($data as $item=>$key) {
            //var_dump($key['others_data']);
            //echo $key['client_data']['totalhm'].",".$key['client_data']['hombres'].",".$key['client_data']['mujeres']. ",";
            //echo $key['others_data']['promedios']['promedio']. "," . $key['others_data']['promedios']['hombres']. "," . $key['others_data']['promedios']['mujeres']. ",";
            //echo $key['others_data']['cuartiles']['q1']. "," . $key['others_data']['cuartiles']['q2']. "," . $key['others_data']['cuartiles']['q3']. ",";
            //echo $key['others_data']['altoybajo']['alto']. "," . $key['others_data']['altoybajo']['bajo']. ",";
            //echo $key['others_data']['vsprom']. "</br>";



            echo '<tr>';
            echo '<td>' .$key['usuario']['totalhm'] .'</td>';
            echo '<td>' .$key['usuario']['hombres'].'</td>';
            echo '<td>' .$key['usuario']['mujeres'].'</td>';
            echo '<td>' .$key['usuarios']['promedio'].'</td>';
            echo '<td>' .$key['usuarios']['hombres'].'</td>';
            echo '<td>' .$key['usuarios']['mujeres'].'</td>';
            echo '<td>' .$key['usuarios']['cuartiles']['q1'].'</td>';
            echo '<td>' .$key['usuarios']['cuartiles']['q2'].'</td>';
            echo '<td>' .$key['usuarios']['cuartiles']['q3'].'</td>';
            echo '<td>' .$key['usuarios']['niveles']['alto'].'</td>';
            echo '<td>' .$key['usuarios']['niveles']['bajo'].'</td>';
            echo '<td>' .$key['usuario']['ranking'].'</td>';
            echo '<td>' .$key['usuario']['vsprom'].'</td>';
            echo '</tr>';




        }
        echo'
</tbody>
</table>';
    }

    public function debug($data)
    {
        echo "<pre>". print_r($data,1). "</pre>";
    }

}
