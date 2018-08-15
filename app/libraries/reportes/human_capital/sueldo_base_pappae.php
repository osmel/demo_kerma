<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//Sueldo base promedio anual personal profesional por años de experiencia
// Indice 3.7
class sueldo_base_pappae
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
        $humancapital=array(21,22,23,24,25,26,27,28);
        //$humancapital=array(17);

        $reporte=array();
        $i=0;
        for($i=0;$i<count($humancapital);$i++) {


            $this->question='c21';
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



            $this->question='c14';
            $data = $this->CI->model_human_capital->getUsersDataByHumanCapital($this->question,$humancapital[$i], $this->id_usuario);
            $reporte[$i]['usuarios']['edad'] = $this->getPromedioUsuarios($data);

            $this->question='c13';
            $data = $this->CI->model_human_capital->getUsersDataByHumanCapital($this->question,$humancapital[$i], $this->id_usuario);
            $reporte[$i]['usuarios']['experiencia'] = $this->getPromedioUsuarios($data);

            $this->question='c3,c4';
            $data = $this->CI->model_human_capital->getUsersDataByHumanCapital($this->question,$humancapital[$i], $this->id_usuario);
            $reporte[$i]['usuarios']['personal'] = $this->getUsersTotalPersonal($data);

            //$this->debug($data);
            //$this->debug($reporte);




        }

        $this->render_data($reporte);
    }

    public function getUserData(&$data)
    {
        @$dato = $data[$this->question];

        if ($dato != NULL && is_numeric($dato)){

            $result=number_format($dato,2,'.',',');

        }else{
            $result= "NA";
        }

        return $result;

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

    private function getUsersTotalPersonal(&$data)
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

        $result=(float)number_format(($promedio),2,'.',',');



        return $result;

    }


    private function render_data($data)
    {


        echo '
<table border="1" cellpadding="1">
<tbody>
<tr>
<td>&nbsp;Ava</td>
<td>Promedio&nbsp;</td>
<td>Personal Total</td>

<td>Edad</td>
<td>Años de exp.</td>
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
            echo '<td>' .$key['usuarios']['personal'].'</td>';
            echo '<td>' .$key['usuarios']['edad'].'</td>';
            echo '<td>' .$key['usuarios']['experiencia'].'</td>';
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


    public function debug(&$data)
    {
        echo "<pre>". print_r($data,1). "</pre>";
    }

    public function checkNull(&$data)
    {
       if(empty($data) OR ($data==NULL)){
           return "NA";
       }
    }



}


