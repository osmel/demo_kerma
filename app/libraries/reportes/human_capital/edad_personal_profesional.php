<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
// Indice 2.16
class edad_personal_profesional
{

    private $question;
    public function __construct()
    {
        $this->CI =& get_instance();
        //parent::__construct();
        $this->id_usuario='2732e323-83a4-11e8-be07-bcee7be16e8e';
        $this->CI->load->model('reportes/model_human_capital');
        $this->CI->model_human_capital->setSection('profesionales');
        $this->CI->load->library('statics');

    }

    public function reporte()
    {
        $humancapital=array(1,2,3,4,5,6,20,18,17,16,15,14,13,12,11,10,9,8,7,19,29,30,31,32,33,34);
        //$humancapital=array(1);
                                 //¿Cuántos años de experiencia tienen en promedio a partir de la titulación?
        $reporte=array();
        $i=0;
        for($i=0;$i<count($humancapital);$i++) {



            $this->question='c14';
            $data = $this->CI->model_human_capital->getUserDataByHumanCapital($this->question,$humancapital[$i], $this->id_usuario);
            $reporte[$i]['usuario']['promedio']=$this->getUserData($data);
            $data = $this->CI->model_human_capital->getUsersDataByHumanCapital($this->question,$humancapital[$i], $this->id_usuario);

            $reporte[$i]['usuarios']['promedio'] = $this->getPromedioUsuarios($data);
            $reporte[$i]['usuarios']['cuartiles'] = $this->getCuartiles($data);
            $reporte[$i]['usuarios']['niveles'] = $this->getAltoBajo($data);


            if(($reporte[$i]['usuario']['promedio'])== "NA"){
                $reporte[$i]['usuario']['ranking']= "NA";
                $reporte[$i]['usuario']['vsprom']=  "NA";

            }else{
                $reporte[$i]['usuario']['ranking']=$this->getRanking($data,$reporte[$i]['usuario']['promedio']);
                $reporte[$i]['usuario']['vsprom']=$this->getVsprom($reporte[$i]['usuario']['promedio'],$reporte[$i]['usuarios']['promedio']);

            }
            //$this->debug($data);
            //$this->debug($reporte);




        }

        $this->render_data($reporte);
    }

    public function getUserData(&$data)
    {

        @$dato = $data[$this->question];
        if ($dato != NULL AND is_numeric($dato)){
            return number_format($dato,2,'.',',');
        }else{
            return "NA";
        }

    }
    public function getPromedioUsuarios(&$data)
    {

        if( array_sum($data)!=NULL) {


            $i = 0;
            $matrix = [];
            foreach ($data as $item) {
                if ($item[$this->question] != null) {
                    $matrix[$i] = $item[$this->question];
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

    public function getCuartiles(&$data)
    {
        $i=0;
        $matrix=[];
        foreach ($data as $item)
        {
            if($item[$this->question] != null){
                $matrix[$i] = $item[$this->question];
                $i++;
            }
        }

        $cuartiles= $this->CI->statics->quartiles($matrix);
        return $cuartiles;

    }

    public function getAltoBajo(&$data)
    {
        $i=0;
        $matrix=[];
        foreach ($data as $item)
        {
            if($item[$this->question] != null){
                $matrix[$i] = $item[$this->question];
                $i++;
            }
        }

        $altobajo= $this->CI->statics->levels($matrix);
        return $altobajo;

    }

    public function getRanking(&$data,$usuario_promedio)
    {
        $i=0;
        $matrix=[];
        foreach ($data as $item)
        {
            if($item[$this->question] != null){
                $matrix[$i] = $item[$this->question];
                $i++;
            }
        }

        array_push($matrix, $usuario_promedio);
        $ranking= $this->CI->statics->ranking_desc($matrix);

        $pos = array_search($usuario_promedio, array_column($ranking, 'value'));
        $rank=$ranking[$pos]['ranking'];
        return $rank . '.°';



    }

    public function getVsprom($usuario_promedio,$usuarios_promedio)
    {
        if($usuario_promedio>$usuarios_promedio){
            $vsprom="Arriba";
        }elseif($usuario_promedio<$usuarios_promedio){
            $vsprom="Abajo";
        }

        return $vsprom;
    }


    private function render_data($data)
    {


        echo '
<table border="1" cellpadding="1">
<tbody>
<tr>
<td>&nbsp;Ava</td>
<td>Promedio&nbsp;</td>
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
            echo '<td>' .$key['usuario']['promedio'] .'</td>';
            echo '<td>' .$key['usuarios']['promedio'].'</td>';
            echo '<td>' .$key['usuarios']['cuartiles']['q1'].'</td>';
            echo '<td>' .$key['usuarios']['cuartiles']['q2'].'</td>';
            echo '<td>' .$key['usuarios']['cuartiles']['q3'].'</td>';
            echo '<td>' .$key['usuarios']['niveles']['high'].'</td>';
            echo '<td>' .$key['usuarios']['niveles']['low'].'</td>';
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


