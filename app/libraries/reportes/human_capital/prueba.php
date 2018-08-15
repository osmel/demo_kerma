<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
//Sueldo Base Promedio Anual Personal Administrativo
// 3.9
class prueba
{

    private $reporte;
    public function __construct()
    {
        $this->CI =& get_instance();
        //parent::__construct();

        $this->id_usuario='2732e323-83a4-11e8-be07-bcee7be16e8e';
        $this->CI->load->model('reportes/model_human_capital');


        $this->CI->load->library('reporter');

    }

    public function reporte()
    {
        $this->CI->reporter->reporte();
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
<td>Años de Experiencia</td>
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








}


