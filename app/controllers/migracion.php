<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class migracion extends CI_Controller {

private $usuarios;

    public function __construct()
    {
       parent::__construct();
       $this->load->model('migracion/model_migracion');
       $this->usuarios=$this->get_users();

    }

    public function index()
    {
        echo "index";

    }

    public function usuarios()
    {
        $this->process_usuarios();

    }

    public function generales()
    {
        $this->process_generales();
    }
    public function ingresos_cobranza()
    {
        $this->process_ingresos_cobranza();
    }
    public function operacion_abogados()
    {
        $this->process_operacion_abogados();

    }
    public function estructura_admin()
    {
        $this->process_estructura_admin();
    }
    public function bonos_incentivos()
    {
        $this->process_bonos_incentivos();
    }
    public function mercadotecnia()
    {
        $this->process_mercadotecnia();
    }
    public function ti()
    {
        $this->process_ti();
    }
    public function profesionales()
    {
        $this->process_profesionales();
    }
    public function administrativos()
    {
        $this->process_administrativos();
    }
    public function prestaciones()
    {
        $this->process_prestaciones();
    }
    public function otras_prestaciones()
    {
        $this->process_otras_prestaciones();
    }


    ////////////////////////////////////////////////////////// PROCESS  ////////////////////////////////////////////////

    // Without Human Capital
    private function process_usuarios()
    {
        $data=$this->model_migracion->db_get_usuarios_list();
        //var_dump($data);
        foreach ( $data as $item) {


            $migracion['id']=$this->model_migracion->get_uuid();
            $migracion['email']=$item['email'];
            $migracion['contrasena']="12345678";
            $migracion['id_perfil']=1;
            $migracion['permiso']=0;
            $migracion['creacion']=gmt_to_local( '', 'UM1', TRUE);
            $migracion['telefono']='5555555555';
            $migracion['activo']=1;
            $migracion['nombre']=$item['full_name'];
            $migracion['apellidos']=$item['full_name'];
            $migracion['fecha_nac']=gmt_to_local( '', 'UM1', TRUE);
            $migracion['estado']=1;
            $migracion['fecha_pc']=gmt_to_local( '', 'UM1', TRUE);
            $migracion['id_usuario']=$item['id'];
            $migracion['fecha_mac']=date("Y-m-d H:i:s");
            $migracion['especial']=0;

            $this->model_migracion->db_set_usuarios_data($migracion);

        }
        var_dump($migracion);
    }
    private function process_generales()
    {
        foreach ( $this->usuarios as $usuario) {
            $questions = "1,2,3,4,5,6,7,8,9,10,11";
            $data = $this->get_data_by_question($usuario['user_id'], $questions);
            $this->set_generales_data($data);
        }

    }
    private function process_ingresos_cobranza()
    {
        foreach ( $this->usuarios as $usuario) {
            $questions = "12,13,14,15,16,17,18,19,20,21,22,23,24,25,26,27,28,29,30,31,32,33,34,35";
            $data = $this->get_data_by_question($usuario['user_id'], $questions);
            $this->set_ingresos_cobranza_data($data);
        }

    }
    private function process_operacion_abogados()
    {
        foreach ( $this->usuarios as $usuario) {
            $questions = "217,218,219,220,221,222,223,224,225,226,227,228,229,230,231,232,233,234,235,236,237,238,239,240";
            $data = $this->get_data_by_question($usuario['user_id'], $questions);
            $this->set_operacion_abogados_data($data);
        }

    }
    private function process_estructura_admin()
    {
        foreach ( $this->usuarios as $usuario) {
            $questions = "308,309,310,311,312,313,314,315";
            $data = $this->get_data_by_question($usuario['user_id'], $questions);
            $this->set_estructura_admin_data($data,$questions);
        }
    }
    private function process_bonos_incentivos()
    {
        foreach ( $this->usuarios as $usuario) {
            $questions = "316,317,318,319,320,321,322,323,324,325,326,327,328,329,330,331,332,333,334,335,336,337,338,339,340,341,342,343,344,345,346,347,348,349,350,351,352,353,354,355,356,357,358,359,360,361,362,363,364,365,366,367,368,369,370,371,372,373,374,375,376,377,378,379,380,381,382,383,384,385,386,387,388,389,390,391,392,393,394,395,396,397,398,399,400";
            $data = $this->get_data_by_question($usuario['user_id'], $questions);
            $this->set_bonos_incentivos_data($data,$questions);
        }
    }
    private function process_mercadotecnia()
    {
        foreach ( $this->usuarios as $usuario) {
            $questions = "401,402,403,404,405,406,407,408,409,410,411,412,413,414,415,416,417,418,419,420";
            $data = $this->get_data_by_question($usuario['user_id'],$questions);
            $this->set_mercadotecnia_data($data);
        }

    }
    private function process_ti()
    {
        foreach ( $this->usuarios as $usuario) {
            $questions = "455,456,457,458,459,460,461,462,463,464,465,466,467,468,469,470,471,472,473,474,475,476,477";
            $data = $this->get_data_by_question($usuario['user_id'], $questions);
            $this->set_ti_data($data,$questions);
        }

    }

    // With Human Capital
    private function process_profesionales()
    {
        foreach ( $this->usuarios as $usuario) {

            for ($i = 1; $i <= 40; $i++){
                //echo "usuario: " . $usuario['user_id']. " human capital: " . $i . "</br>";
                $data = $this->get_data_by_actual_human_capital($usuario['user_id'], $i);
                $this->set_profesionales_data($data,$i);
            }



            //var_dump($data);
       }
    }
    private function process_administrativos()
    {
        foreach ( $this->usuarios as $usuario) {

            for ($i = 41; $i <= 71; $i++){
                echo "usuario: " . $usuario['user_id']. " human capital: " . $i . "</br>";
                $data = $this->get_data_by_actual_human_capital($usuario['user_id'], $i);
                //var_dump($data);

                $this->set_administrativos_data($data,$i);
            }




        }
    }
    private function process_prestaciones()
    {
        foreach ( $this->usuarios as $usuario) {

            for ($i = 72; $i <= 83; $i++){
                echo "usuario: " . $usuario['user_id']. " human capital: " . $i . "</br>";
                $data = $this->get_data_by_actual_human_capital($usuario['user_id'], $i);
                $this->set_prestaciones_data($data,$i);
                //var_dump($data);
            }
        }

    }
    private function process_otras_prestaciones()
    {
        foreach ( $this->usuarios as $usuario) {

            for ($i = 84; $i <= 110; $i++){
                echo "usuario: " . $usuario['user_id']. " human capital: " . $i . "</br>";
                $data = $this->get_data_by_actual_human_capital($usuario['user_id'], $i);
                $this->set_otras_prestaciones_data($data,$i);
                //var_dump($data);
            }




        }
    }


    ///////////////////////////////////////////////////////////// SET //////////////////////////////////////////////////

    // Without Human Capital
    private function set_generales_data($data)
    {
        if (!empty($data)) {
            $i = 0;
            $migracion = array();
            $migracion['id_usuario'] = $this->replace_user_id($data[0]['user_id']);
            //$migracion['id_usuario'] = $data[0]['user_id'];
            $migracion['fecha_creacion'] = $data[0]['date_created'];
            $migracion['fecha_actualizacion'] = $data[0]['last_updated'];
            $migracion['periodo'] = 0;
            foreach ($data as $item) {
                $i++;
                $migracion['c' . $i] = $item['string_value'];

            }
            var_dump($migracion);
            $this->model_migracion->db_set_generales_data($migracion);
        }
    }
    private function set_ingresos_cobranza_data($data)
    {
        if (!empty($data)) {
            $i = 0;
            $migracion = array();
            $migracion['id_usuario'] = $this->replace_user_id($data[0]['user_id']);
            //$migracion['id_usuario'] = $data[0]['user_id'];
            $migracion['fecha_creacion'] = $data[0]['date_created'];
            $migracion['fecha_actualizacion'] = $data[0]['last_updated'];
            $migracion['periodo'] = 0;
            foreach ($data as $item) {
                $i++;
                $migracion['c' . $i] = $item['value_numeric'];

            }
            var_dump($migracion);
            $this->model_migracion->db_set_ingresos_cobranza_data($migracion);
        }
    }
    private function set_operacion_abogados_data($data)
    {
        if (!empty($data)) {
            $i = 0;
            $migracion = array();
            $migracion['id_usuario'] = $this->replace_user_id($data[0]['user_id']);
            //$migracion['id_usuario'] = $data[0]['user_id'];
            $migracion['fecha_creacion'] = $data[0]['date_created'];
            $migracion['fecha_actualizacion'] = $data[0]['last_updated'];
            $migracion['periodo'] = 0;

            foreach ($data as $item) {
                if($item['question_id']=='217'){
                    $migracion['c1'] = $item['value_numeric'];
                }
                if($item['question_id']=='218'){
                    $migracion['c2'] = $item['value_numeric'];
                }
                if($item['question_id']=='219'){
                    $migracion['c3'] = $item['value_numeric'];
                }
                if($item['question_id']=='221'){
                    $migracion['c4'] = $item['value_numeric'];
                }
                if($item['question_id']=='223'){
                    $migracion['c5'] = $item['value_numeric'];
                }
                if($item['question_id']=='225'){
                    $migracion['c6'] = $item['value_numeric'];
                }
                if($item['question_id']=='227'){
                    $migracion['c7'] = $item['value_numeric'];
                }
                if($item['question_id']=='229'){
                    $migracion['c8'] = $item['value_numeric'];
                }
                if($item['question_id']=='231'){
                    $migracion['c9'] = $item['value_numeric'];
                }
                if($item['question_id']=='232'){
                    $migracion['c10'] = $item['value_numeric'];
                }
                if($item['question_id']=='233'){                //
                    $migracion['c11'] = $item['value_numeric']; //  RESPUESTA SELECT
                }                                               //
                if($item['question_id']=='234'){                //
                    $migracion['c12'] = $item['string_value']; // RESPUESTA SELECT OTROS (ESPECIFICAR)
                }
                if($item['question_id']=='235'){
                    $migracion['c13'] = $item['value_numeric'];
                }
                if($item['question_id']=='236'){
                    $migracion['c14'] = $item['value_numeric'];
                }
                if($item['question_id']=='237'){
                    $migracion['c15'] = $item['value_numeric'];
                }
                if($item['question_id']=='238') {
                    $migracion['c16'] = $item['string_value'];
                }
                if($item['question_id']=='239'){
                    $migracion['c17'] = $item['value_numeric'];
                }
                if($item['question_id']=='240'){
                    $migracion['c18'] = $item['value_numeric'];
                }
            }
            var_dump($migracion);
            //$this->model_migracion->db_set_ingresos_cobranza_data($migracion);
        }
    }
    private function set_estructura_admin_data($data,$questions)
    {

        if (!empty($data)) {
            $i = 0;
            $j = 0;
            $migracion = array();
            $migracion['id_usuario'] = $this->replace_user_id($data[0]['user_id']);
            //$migracion['id_usuario'] = $data[0]['user_id'];
            $migracion['fecha_creacion'] = $data[0]['date_created'];
            $migracion['fecha_actualizacion'] = $data[0]['last_updated'];
            $migracion['periodo'] = 0;



            foreach ($data as $item) {
                $i++;
                $migracion['c' . $i] = $item['value_numeric'];

            }

            var_dump($migracion);
            $this->model_migracion->db_set_estructura_admin_data($migracion);
        }
    }
    private function set_bonos_incentivos_data($data)
    {
        if (!empty($data)) {
            $i = 0;
            $j = 0;
            $migracion = array();
            $migracion['id_usuario'] = $this->replace_user_id($data[0]['user_id']);
            //$migracion['id_usuario'] = $data[0]['user_id'];
            $migracion['fecha_creacion'] = $data[0]['date_created'];
            $migracion['fecha_actualizacion'] = $data[0]['last_updated'];
            $migracion['periodo'] = 0;


            foreach ($data as $item) {
                $i++;
                $migracion['c' . $i] = $item['value_numeric'];

            }

            var_dump($migracion);
            $this->model_migracion->db_set_bonos_incentivos_data($migracion);
        }
    }
    private function set_mercadotecnia_data($data)
    {
        if (!empty($data)) {
            $i = 0;

            $migracion = array();
            $migracion['id_usuario'] = $this->replace_user_id($data[0]['user_id']);
            //$migracion['id_usuario'] = $data[0]['user_id'];
            $migracion['fecha_creacion'] = $data[0]['date_created'];
            $migracion['fecha_actualizacion'] = $data[0]['last_updated'];
            $migracion['periodo'] = 0;


            foreach ($data as $item) {
                $i++;
                if($i<3) {
                    $migracion['c' . $i] = $item['value_numeric'];
                }else{
                    $migracion['c' . $i] = $item['string_value'];
                }
            }

            var_dump($migracion);
            $this->model_migracion->db_set_mercadotecnia_data($migracion);
        }
    }
    private function set_ti_data($data)
    {
        if (!empty($data)) {
            $i = 0;

            $migracion = array();
            $migracion['id_usuario'] = $this->replace_user_id($data[0]['user_id']);
            //$migracion['id_usuario'] = $data[0]['user_id'];
            $migracion['fecha_creacion'] = $data[0]['date_created'];
            $migracion['fecha_actualizacion'] = $data[0]['last_updated'];
            $migracion['periodo'] = 0;


            foreach ($data as $item) {

                $i++;

                $migracion['c' . $i] = $item['value_numeric'];

            }
            var_dump($migracion);
            $this->model_migracion->db_set_ti_data($migracion);
        }
    }
    // With Human Capital
    private function set_profesionales_data($data,$human_capital)
    {


        $abogados=array(7,8,9,10,11,12,13,14,15,16,17,18,19,20);



        if (!empty($data)) {

            $i = 0;
            $migracion = array();
            //$migracion['id_usuario'] = 'c0f2a51e-7e3a-11e8-be07-bcee7be16e8e';
            $migracion['id_usuario'] = $this->replace_user_id($data[0]['user_id']);
            $migracion['id_cha'] = $data[0]['actual_human_capital_id'];
            $migracion['fecha_creacion'] = $data[0]['date_created'];
            $migracion['fecha_actualizacion'] = $data[0]['last_updated'];
            $migracion['periodo'] = 0;
            //var_dump($migracion);

            //if (array_search($human_capital, $socios) !== FALSE) {
            if ($human_capital==1 || $human_capital==2 || $human_capital==3 || $human_capital==4 || $human_capital==5|| $human_capital==6) {
                echo "Guardando Datos:: Usuario=> " . $migracion['id_usuario'] . " Profesionales => SOCIOS" . " Human Capital=>" . $human_capital . " </br>";

                foreach ($data as $item) {
                    $item['question_id'] == '96' ? $migracion['c3'] = $item['value_numeric'] : NULL;
                    $item['question_id'] == '97' ? $migracion['c4'] = $item['value_numeric'] : NULL;
                    $item['question_id'] == '98' ? $migracion['c5'] = $item['value_numeric'] : NULL;
                    $item['question_id'] == '99' ? $migracion['c6'] = $item['value_numeric'] : NULL;
                    $item['question_id'] == '100' ? $migracion['c7'] = $item['value_numeric'] : NULL;
                    $item['question_id'] == '101' ? $migracion['c8'] = $item['value_numeric'] : NULL;
                    $item['question_id'] == '102' ? $migracion['c9'] = $item['value_numeric'] : NULL;
                    $item['question_id'] == '103' ? $migracion['c10'] = $item['value_numeric'] : NULL;
                    $item['question_id'] == '104' ? $migracion['c11'] = $item['value_numeric'] : NULL;
                    $item['question_id'] == '105' ? $migracion['c12'] = $item['value_numeric'] : NULL;
                    $item['question_id'] == '106' ? $migracion['c13'] = $item['value_numeric'] : NULL;
                    $item['question_id'] == '107' ? $migracion['c14'] = $item['value_numeric'] : NULL;
                    $item['question_id'] == '108' ? $migracion['c26'] = $item['value_numeric'] : NULL;
                    $item['question_id'] == '109' ? $migracion['c27'] = $item['value_numeric'] : NULL;
                    $item['question_id'] == '110' ? $migracion['c28'] = $item['value_numeric'] : NULL;


                }

            }

            //if(array_search($human_capital,$abogados)!== FALSE){
            if ($human_capital==7 || $human_capital==8 || $human_capital==9 || $human_capital==10 || $human_capital==11|| $human_capital==12 ||
                $human_capital==13 || $human_capital==14 || $human_capital==15 || $human_capital==16 || $human_capital==17|| $human_capital==18 ||
                $human_capital==19 || $human_capital==20) {

                echo "Guardando Datos:: Usuario=> " .$migracion['id_usuario'] ." Profesionales => ABOGADOS" . " Human Capital=>". $human_capital ." </br>";
                foreach ($data as $item) {

                    $item['question_id']=='113' ?  $migracion['c3'] = $item['value_numeric']: NULL;
                    $item['question_id']=='114' ?  $migracion['c4'] = $item['value_numeric']: NULL;
                    $item['question_id']=='115' ?  $migracion['c7'] = $item['value_numeric']: NULL;
                    $item['question_id']=='116' ?  $migracion['c8'] = $item['value_numeric']: NULL;
                    $item['question_id']=='117' ?  $migracion['c9'] = $item['value_numeric']: NULL;
                    $item['question_id']=='118' ?  $migracion['c10'] = $item['value_numeric']: NULL;
                    $item['question_id']=='119' ?  $migracion['c11'] = $item['value_numeric']: NULL;
                    $item['question_id']=='120' ?  $migracion['c12'] = $item['value_numeric']: NULL;
                    $item['question_id']=='121' ?  $migracion['c13'] = $item['value_numeric']: NULL;
                    $item['question_id']=='122' ? $migracion['c14'] = $item['value_numeric']: NULL;
                    $item['question_id']=='123' ? $migracion['c15'] = $item['value_numeric']: NULL;
                    $item['question_id']=='124' ? $migracion['c16'] = $item['value_numeric']: NULL;
                    $item['question_id']=='125' ? $migracion['c17'] = $item['value_numeric']: NULL;
                    $item['question_id']=='126' ? $migracion['c18'] = $item['value_numeric']: NULL;
                    $item['question_id']=='127' ? $migracion['c19'] = $item['value_numeric']: NULL;
                    $item['question_id']=='128' ? $migracion['c20'] = $item['value_numeric']: NULL;
                    $item['question_id']=='129' ? $migracion['c21'] = $item['value_numeric']: NULL;
                    $item['question_id']=='130' ? $migracion['c22'] = $item['value_numeric']: NULL;
                    $item['question_id']=='131' ? $migracion['c23'] = $item['value_numeric']: NULL;
                    $item['question_id']=='132' ? $migracion['c24'] = $item['value_date']: NULL;
                    $item['question_id']=='133' ? $migracion['c25'] = $item['value_numeric']: NULL;
                    $item['question_id']=='134' ? $migracion['c26'] = $item['value_numeric']:NULL;
                    $item['question_id']=='135' ? $migracion['c27'] = $item['value_numeric']: NULL;
                    $item['question_id']=='136' ? $migracion['c28'] = $item['value_numeric']: NULL;


                }

            }


            //if(array_search($human_capital,$abogados)!== FALSE){
            if ($human_capital==21 || $human_capital==22 || $human_capital==23 || $human_capital==24 || $human_capital==25|| $human_capital==26 ||
                $human_capital==27 || $human_capital==28) {

                echo "Guardando Datos:: Usuario=> " .$migracion['id_usuario'] ." Profesionales => ABOGADOS AÑOS EXP." . " Human Capital=>". $human_capital ." </br>";
                foreach ($data as $item) {
                    $item['question_id']=='137' ?  $migracion['c3'] = $item['value_numeric']: NULL;
                    $item['question_id']=='138' ?  $migracion['c4'] = $item['value_numeric']: NULL;
                    $item['question_id']=='139' ?  $migracion['c7'] = $item['value_numeric']: NULL;
                    $item['question_id']=='140' ?  $migracion['c5'] = $item['value_numeric']: NULL;
                    $item['question_id']=='141' ?  $migracion['c6'] = $item['value_numeric']: NULL;
                    $item['question_id']=='142' ?  $migracion['c8'] = $item['value_numeric']: NULL;
                    $item['question_id']=='143' ?  $migracion['c9'] = $item['value_numeric']: NULL;
                    $item['question_id']=='144' ?  $migracion['c10'] = $item['value_numeric']: NULL;
                    $item['question_id']=='145' ?  $migracion['c11'] = $item['value_numeric']: NULL;
                    $item['question_id']=='146' ? $migracion['c12'] = $item['value_numeric']: NULL;
                    $item['question_id']=='147' ? $migracion['c14'] = $item['value_numeric']: NULL;
                    $item['question_id']=='148' ? $migracion['c15'] = $item['value_numeric']: NULL;
                    $item['question_id']=='149' ? $migracion['c16'] = $item['value_numeric']: NULL;
                    $item['question_id']=='150' ? $migracion['c17'] = $item['value_numeric']: NULL;
                    $item['question_id']=='151' ? $migracion['c18'] = $item['value_numeric']: NULL;
                    $item['question_id']=='152' ? $migracion['c19'] = $item['value_numeric']: NULL;
                    $item['question_id']=='153' ? $migracion['c20'] = $item['value_numeric']: NULL;
                    $item['question_id']=='154' ? $migracion['c21'] = $item['value_numeric']: NULL;
                    $item['question_id']=='155' ? $migracion['c22'] = $item['value_numeric']: NULL;
                    $item['question_id']=='156' ? $migracion['c23'] = $item['value_numeric']: NULL;
                    $item['question_id']=='157' ? $migracion['c24'] = $item['value_date']: NULL;
                    $item['question_id']=='158' ? $migracion['c25'] = $item['value_numeric']: NULL;
                    $item['question_id']=='159' ? $migracion['c26'] = $item['value_numeric']: NULL;
                    $item['question_id']=='160' ? $migracion['c27'] = $item['value_numeric']: NULL;
                    $item['question_id']=='161' ? $migracion['c28'] = $item['value_numeric']: NULL;


                }
          }

            //if(array_search($human_capital,$abogados)!== FALSE){
            if ($human_capital==35 || $human_capital==36 || $human_capital==37|| $human_capital==38 ||
                $human_capital==39 || $human_capital==40) {

                echo "Guardando Datos:: Usuario=> " .$migracion['id_usuario'] ." Profesionales => NO ABOGADOS ." . " Human Capital=>". $human_capital ." </br>";
                foreach ($data as $item) {
                    $item['question_id']=='164' ?  $migracion['c3'] = $item['value_numeric']: NULL;
                    $item['question_id']=='165' ?  $migracion['c4'] = $item['value_numeric']: NULL;
                    $item['question_id']=='166' ?  $migracion['c7'] = $item['value_numeric']: NULL;
                    $item['question_id']=='167' ?  $migracion['c5'] = $item['value_numeric']: NULL;
                    $item['question_id']=='168' ?  $migracion['c6'] = $item['value_numeric']: NULL;
                    $item['question_id']=='169' ?  $migracion['c8'] = $item['value_numeric']: NULL;
                    $item['question_id']=='170' ?  $migracion['c9'] = $item['value_numeric']: NULL;
                    $item['question_id']=='171' ?  $migracion['c10'] = $item['value_numeric']: NULL;
                    $item['question_id']=='172' ?  $migracion['c11'] = $item['value_numeric']: NULL;
                    $item['question_id']=='173' ? $migracion['c12'] = $item['value_numeric']: NULL;
                    $item['question_id']=='174' ? $migracion['c13'] = $item['value_numeric']: NULL;
                    $item['question_id']=='175' ? $migracion['c14'] = $item['value_numeric']: NULL;
                    $item['question_id']=='176' ? $migracion['c15'] = $item['value_numeric']: NULL;
                    $item['question_id']=='177' ? $migracion['c16'] = $item['value_numeric']: NULL;
                    $item['question_id']=='178' ? $migracion['c17'] = $item['value_numeric']: NULL;
                    $item['question_id']=='179' ? $migracion['c18'] = $item['value_numeric']: NULL;
                    $item['question_id']=='180' ? $migracion['c19'] = $item['value_numeric']: NULL;
                    $item['question_id']=='181' ? $migracion['c20'] = $item['value_numeric']: NULL;
                    $item['question_id']=='182' ? $migracion['c21'] = $item['value_numeric']: NULL;
                    $item['question_id']=='183' ? $migracion['c22'] = $item['value_numeric']: NULL;
                    $item['question_id']=='184' ? $migracion['c23'] = $item['value_numeric']: NULL;
                    $item['question_id']=='185' ? $migracion['c24'] = $item['value_date']: NULL;
                    $item['question_id']=='186' ? $migracion['c25'] = $item['value_numeric']: NULL;
                    $item['question_id']=='187' ? $migracion['c26'] = $item['value_numeric']: NULL;
                    $item['question_id']=='188' ? $migracion['c27'] = $item['value_numeric']: NULL;
                    $item['question_id']=='189' ? $migracion['c28'] = $item['value_numeric']: NULL;


                }
            }




            //if(array_search($human_capital,$abogados)!== FALSE){
            if ($human_capital==29 || $human_capital==30 || $human_capital==31|| $human_capital==32 ||
                $human_capital==33 || $human_capital==34) {

                echo "Guardando Datos:: Usuario=> " .$migracion['id_usuario'] ." Profesionales => PASNANTES ." . " Human Capital=>". $human_capital ." </br>";
                foreach ($data as $item) {
                    $item['question_id']=='192' ?  $migracion['c3'] = $item['value_numeric']: NULL;
                    $item['question_id']=='193' ?  $migracion['c4'] = $item['value_numeric']: NULL;
                    $item['question_id']=='194' ?  $migracion['c7'] = $item['value_numeric']: NULL;
                    $item['question_id']=='195' ?  $migracion['c5'] = $item['value_numeric']: NULL;
                    $item['question_id']=='196' ?  $migracion['c6'] = $item['value_numeric']: NULL;
                    $item['question_id']=='197' ?  $migracion['c8'] = $item['value_numeric']: NULL;
                    $item['question_id']=='198' ?  $migracion['c9'] = $item['value_numeric']: NULL;
                    $item['question_id']=='199' ?  $migracion['c10'] = $item['value_numeric']: NULL;
                    $item['question_id']=='200' ?  $migracion['c11'] = $item['value_numeric']: NULL;
                    $item['question_id']=='201' ? $migracion['c12'] = $item['value_numeric']: NULL;
                    $item['question_id']=='202' ? $migracion['c14'] = $item['value_numeric']: NULL;
                    $item['question_id']=='203' ? $migracion['c15'] = $item['value_numeric']: NULL;
                    $item['question_id']=='204' ? $migracion['c16'] = $item['value_numeric']: NULL;
                    $item['question_id']=='205' ? $migracion['c17'] = $item['value_numeric']: NULL;
                    $item['question_id']=='206' ? $migracion['c18'] = $item['value_numeric']: NULL;
                    $item['question_id']=='207' ? $migracion['c19'] = $item['value_numeric']: NULL;
                    $item['question_id']=='208' ? $migracion['c20'] = $item['value_numeric']: NULL;
                    $item['question_id']=='209' ? $migracion['c21'] = $item['value_numeric']: NULL;
                    $item['question_id']=='210' ? $migracion['c22'] = $item['value_numeric']: NULL;
                    $item['question_id']=='211' ? $migracion['c23'] = $item['value_numeric']: NULL;
                    $item['question_id']=='212' ? $migracion['c24'] = $item['value_date']: NULL;
                    $item['question_id']=='213' ? $migracion['c25'] = $item['value_numeric']: NULL;
                    $item['question_id']=='214' ? $migracion['c26'] = $item['value_numeric']: NULL;
                    $item['question_id']=='215' ? $migracion['c27'] = $item['value_numeric']: NULL;
                    $item['question_id']=='216' ? $migracion['c28'] = $item['value_numeric']: NULL;


                }
            }









            /*
            foreach ($data as $item) {
                $i++;

                if ($i==21){
                    $migracion['c' . $i] = $item['value_date'];
                }else{
                    $migracion['c' . $i] = $item['value_numeric'];
                }
            }
            */

            $this->model_migracion->db_set_profesionales_data($migracion);


        }
    }
    private function set_administrativos_data($data,$human_capital)
    {
        if (!empty($data)) {


            $i = 0;
            $migracion = array();
            $migracion['id_usuario'] = $this->replace_user_id($data[0]['user_id']);
            //$migracion['id_usuario'] = $data[0]['user_id'];
            $migracion['id_cha'] = $data[0]['actual_human_capital_id'];
            $migracion['fecha_creacion'] = $data[0]['date_created'];
            $migracion['fecha_actualizacion'] = $data[0]['last_updated'];
            $migracion['periodo'] = 0;


            if ($human_capital==41 || $human_capital==42 || $human_capital==43 || $human_capital==44 || $human_capital==45 || $human_capital==46
                || $human_capital==47 || $human_capital==48 || $human_capital==49) {
                echo "Guardando Datos:: Usuario=> " . $migracion['id_usuario'] . " Administrativos => GERENTE DE ADMINISTRACION" . " Human Capital=>" . $human_capital . " </br>";

                foreach ($data as $item) {

                    $item['question_id']=='241' ?  $migracion['c1'] = $item['value_numeric']: NULL;
                    $item['question_id']=='242' ?  $migracion['c2'] = $item['value_numeric']: NULL;
                    $item['question_id']=='243' ?  $migracion['c3'] = $item['value_numeric']: NULL;
                    $item['question_id']=='244' ?  $migracion['c4'] = $item['value_numeric']: NULL;
                    $item['question_id']=='245' ?  $migracion['c5'] = $item['value_numeric']: NULL;
                    $item['question_id']=='246' ?  $migracion['c6'] = $item['value_numeric']: NULL;
                    $item['question_id']=='247' ?  $migracion['c10'] = $item['value_numeric']: NULL;
                    $item['question_id']=='248' ?  $migracion['c11'] = $item['value_numeric']: NULL;
                    $item['question_id']=='249' ?  $migracion['c12'] = $item['value_numeric']: NULL;
                    $item['question_id']=='250' ?  $migracion['c13'] = $item['value_numeric']: NULL;
                    $item['question_id']=='251' ?  $migracion['c14'] = $item['value_numeric']: NULL;
                    $item['question_id']=='252' ?  $migracion['c15'] = $item['value_numeric']: NULL;
                    $item['question_id']=='253' ?  $migracion['c16'] = $item['value_numeric']: NULL;
                    $item['question_id']=='254' ?  $migracion['c17'] = $item['value_numeric']: NULL;
                    $item['question_id']=='255' ?  $migracion['c18'] = $item['value_numeric']: NULL;
                    $item['question_id']=='256' ?  $migracion['c19'] = $item['value_numeric']: NULL;
                    $item['question_id']=='257' ?  $migracion['c20'] = $item['value_date']: NULL;
                    $item['question_id']=='258' ?  $migracion['c21'] = $item['value_numeric']: NULL;
                    $item['question_id']=='259' ?  $migracion['c22'] = $item['value_numeric']: NULL;
                    $item['question_id']=='260' ?  $migracion['c23'] = $item['value_numeric']: NULL;
                    $item['question_id']=='261' ?  $migracion['c24'] = $item['value_numeric']: NULL;


                }
            }


            if ($human_capital==50 || $human_capital==51 || $human_capital==52 || $human_capital==53 || $human_capital==54 || $human_capital==55
                || $human_capital==56 || $human_capital==57 || $human_capital==58 || $human_capital==59 || $human_capital==60 || $human_capital==61
                || $human_capital==62) {
                echo "Guardando Datos:: Usuario=> " . $migracion['id_usuario'] . " Administrativos => STAFF DE ADMINISTRACION" . " Human Capital=>" . $human_capital . " </br>";

                foreach ($data as $item) {

                    $item['question_id']=='264' ?  $migracion['c3'] = $item['value_numeric']: NULL;
                    $item['question_id']=='265' ?  $migracion['c4'] = $item['value_numeric']: NULL;
                    $item['question_id']=='266' ?  $migracion['c7'] = $item['value_numeric']: NULL;
                    $item['question_id']=='267' ?  $migracion['c8'] = $item['value_numeric']: NULL;
                    $item['question_id']=='268' ?  $migracion['c9'] = $item['value_numeric']: NULL;
                    $item['question_id']=='269' ?  $migracion['c6'] = $item['value_numeric']: NULL;
                    $item['question_id']=='270' ?  $migracion['c10'] = $item['value_numeric']: NULL;
                    $item['question_id']=='271' ?  $migracion['c11'] = $item['value_numeric']: NULL;
                    $item['question_id']=='272' ?  $migracion['c12'] = $item['value_numeric']: NULL;
                    $item['question_id']=='273' ?  $migracion['c13'] = $item['value_numeric']: NULL;
                    $item['question_id']=='274' ?  $migracion['c14'] = $item['value_numeric']: NULL;
                    $item['question_id']=='275' ?  $migracion['c15'] = $item['value_numeric']: NULL;
                    $item['question_id']=='276' ?  $migracion['c16'] = $item['value_numeric']: NULL;
                    $item['question_id']=='277' ?  $migracion['c17'] = $item['value_numeric']: NULL;
                    $item['question_id']=='278' ?  $migracion['c18'] = $item['value_numeric']: NULL;
                    $item['question_id']=='279' ?  $migracion['c19'] = $item['value_numeric']: NULL;
                    $item['question_id']=='280' ?  $migracion['c20'] = $item['value_date']: NULL;
                    $item['question_id']=='281' ?  $migracion['c21'] = $item['value_numeric']: NULL;
                    $item['question_id']=='282' ?  $migracion['c22'] = $item['value_numeric']: NULL;
                    $item['question_id']=='283' ?  $migracion['c23'] = $item['value_numeric']: NULL;
                    $item['question_id']=='284' ?  $migracion['c24'] = $item['value_numeric']: NULL;

                }
            }

            if ($human_capital==63 || $human_capital==64 || $human_capital==65 || $human_capital==66 || $human_capital==67 || $human_capital==68
                || $human_capital==69 || $human_capital==70 || $human_capital==71) {
                echo "Guardando Datos:: Usuario=> " . $migracion['id_usuario'] . " Administrativos => APOYO DE ADMINISTRACION" . " Human Capital=>" . $human_capital . " </br>";

                foreach ($data as $item) {

                    $item['question_id']=='287' ?  $migracion['c3'] = $item['value_numeric']: NULL;
                    $item['question_id']=='288' ?  $migracion['c4'] = $item['value_numeric']: NULL;
                    $item['question_id']=='289' ?  $migracion['c7'] = $item['value_numeric']: NULL;
                    $item['question_id']=='290' ?  $migracion['c8'] = $item['value_numeric']: NULL;
                    $item['question_id']=='291' ?  $migracion['c9'] = $item['value_numeric']: NULL;
                    $item['question_id']=='292' ?  $migracion['c6'] = $item['value_numeric']: NULL;
                    $item['question_id']=='293' ?  $migracion['c10'] = $item['value_numeric']: NULL;
                    $item['question_id']=='294' ?  $migracion['c11'] = $item['value_numeric']: NULL;
                    $item['question_id']=='295' ?  $migracion['c12'] = $item['value_numeric']: NULL;
                    $item['question_id']=='296' ?  $migracion['c13'] = $item['value_numeric']: NULL;
                    $item['question_id']=='297' ?  $migracion['c14'] = $item['value_numeric']: NULL;
                    $item['question_id']=='298' ?  $migracion['c15'] = $item['value_numeric']: NULL;
                    $item['question_id']=='299' ?  $migracion['c16'] = $item['value_numeric']: NULL;
                    $item['question_id']=='300' ?  $migracion['c17'] = $item['value_numeric']: NULL;
                    $item['question_id']=='301' ?  $migracion['c18'] = $item['value_numeric']: NULL;
                    $item['question_id']=='302' ?  $migracion['c19'] = $item['value_numeric']: NULL;
                    $item['question_id']=='303' ?  $migracion['c20'] = $item['value_date']: NULL;
                    $item['question_id']=='304' ?  $migracion['c21'] = $item['value_numeric']: NULL;
                    $item['question_id']=='305' ?  $migracion['c22'] = $item['value_numeric']: NULL;
                    $item['question_id']=='306' ?  $migracion['c23'] = $item['value_numeric']: NULL;
                    $item['question_id']=='307' ?  $migracion['c24'] = $item['value_numeric']: NULL;
                }
            }





            $this->model_migracion->db_set_administrativos_data($migracion);
            //echo "Guardando Datos =>  Administrativos";


        }
    }
    private function set_prestaciones_data($data,$human_capital)
    {
        if (!empty($data)) {


            $i = 0;
            $migracion = array();
            $migracion['id_usuario'] = $this->replace_user_id($data[0]['user_id']);
            //$migracion['id_usuario'] = $data[0]['user_id'];
            $migracion['id_cha'] = $data[0]['actual_human_capital_id'];
            $migracion['fecha_creacion'] = $data[0]['date_created'];
            $migracion['fecha_actualizacion'] = $data[0]['last_updated'];
            $migracion['periodo'] = 0;

            if ($human_capital==72 || $human_capital==73 || $human_capital==74 || $human_capital==75 || $human_capital==76 || $human_capital==77) {
                echo "Guardando Datos:: Usuario=> " . $migracion['id_usuario'] . " Prestaciones => SEGUROS Y SALUD" . " Human Capital=>" . $human_capital . " </br>";


                foreach ($data as $item) {

                    $item['question_id']=='497' ?  $migracion['c1'] = $item['value_numeric']: NULL;
                    $item['question_id']=='498' ?  $migracion['c2'] = $item['value_numeric']: NULL;
                    $item['question_id']=='499' ?  $migracion['c3'] = $item['value_numeric']: NULL;
                    $item['question_id']=='500' ?  $migracion['c4'] = $item['value_numeric']: NULL;
                    $item['question_id']=='501' ?  $migracion['c5'] = $item['value_numeric']: NULL;
                    $item['question_id']=='502' ?  $migracion['c6'] = $item['value_numeric']: NULL;
                    $item['question_id']=='478' ?  $migracion['c14'] = $item['value_numeric']: NULL;
                    $item['question_id']=='479' ?  $migracion['c15'] = $item['value_numeric']: NULL;
                    $item['question_id']=='480' ?  $migracion['c16'] = $item['value_numeric']: NULL;
                    $item['question_id']=='481' ?  $migracion['c17'] = $item['value_numeric']: NULL;
                    $item['question_id']=='482' ?  $migracion['c18'] = $item['value_numeric']: NULL;
                    $item['question_id']=='483' ?  $migracion['c19'] = $item['value_numeric']: NULL;
                    $item['question_id']=='484' ?  $migracion['c20'] = $item['value_numeric']: NULL;
                    $item['question_id']=='485' ?  $migracion['c21'] = $item['value_numeric']: NULL;
                    $item['question_id']=='486' ?  $migracion['c22'] = $item['value_numeric']: NULL;
                    $item['question_id']=='487' ?  $migracion['c23'] = $item['value_numeric']: NULL;
                    $item['question_id']=='488' ?  $migracion['c24'] = $item['value_numeric']: NULL;
                    $item['question_id']=='489' ?  $migracion['c25'] = $item['value_numeric']: NULL;
                    $item['question_id']=='490' ?  $migracion['c26'] = $item['value_numeric']: NULL;
                    $item['question_id']=='491' ?  $migracion['c27'] = $item['value_numeric']: NULL;
                    $item['question_id']=='492' ?  $migracion['c28'] = $item['value_numeric']: NULL;
                    $item['question_id']=='493' ?  $migracion['c29'] = $item['value_numeric']: NULL;
                    $item['question_id']=='494' ?  $migracion['c30'] = $item['value_numeric']: NULL;
                    $item['question_id']=='495' ?  $migracion['c31'] = $item['value_numeric']: NULL;
                    $item['question_id']=='496' ?  $migracion['c32'] = $item['value_numeric']: NULL;
                }
            }


            if ($human_capital==78 || $human_capital==79 || $human_capital==80 || $human_capital==81 || $human_capital==82|| $human_capital==83) {
                echo "Guardando Datos:: Usuario=> " . $migracion['id_usuario'] . " Prestaciones => EXTRAS " . " Human Capital=>" . $human_capital . " </br>";


                foreach ($data as $item) {

                    $item['question_id']=='503' ?  $migracion['c7'] = $item['value_numeric']: NULL;
                    $item['question_id']=='504' ?  $migracion['c8'] = $item['value_numeric']: NULL;
                    $item['question_id']=='505' ?  $migracion['c9'] = $item['value_numeric']: NULL;
                    $item['question_id']=='506' ?  $migracion['c10'] = $item['value_numeric']: NULL;
                    $item['question_id']=='507' ?  $migracion['c11'] = $item['value_numeric']: NULL;
                    $item['question_id']=='508' ?  $migracion['c12'] = $item['value_numeric']: NULL;
                    $item['question_id']=='509' ?  $migracion['c13'] = $item['value_numeric']: NULL;

                    $item['question_id']=='510' ?  $migracion['c14'] = $item['value_numeric']: NULL;
                    $item['question_id']=='511' ?  $migracion['c15'] = $item['value_numeric']: NULL;
                    $item['question_id']=='512' ?  $migracion['c16'] = $item['value_numeric']: NULL;
                    $item['question_id']=='513' ?  $migracion['c17'] = $item['value_numeric']: NULL;
                    $item['question_id']=='514' ?  $migracion['c18'] = $item['value_numeric']: NULL;
                    $item['question_id']=='515' ?  $migracion['c19'] = $item['value_numeric']: NULL;
                    $item['question_id']=='516' ?  $migracion['c20'] = $item['value_numeric']: NULL;
                    $item['question_id']=='517' ?  $migracion['c21'] = $item['value_numeric']: NULL;
                    $item['question_id']=='518' ?  $migracion['c22'] = $item['value_numeric']: NULL;
                    $item['question_id']=='519' ?  $migracion['c23'] = $item['value_numeric']: NULL;
                    $item['question_id']=='520' ?  $migracion['c24'] = $item['value_numeric']: NULL;
                    $item['question_id']=='521' ?  $migracion['c25'] = $item['value_numeric']: NULL;
                    $item['question_id']=='522' ?  $migracion['c26'] = $item['value_numeric']: NULL;
                    $item['question_id']=='523' ?  $migracion['c27'] = $item['value_numeric']: NULL;
                    $item['question_id']=='524' ?  $migracion['c28'] = $item['value_numeric']: NULL;
                    $item['question_id']=='525' ?  $migracion['c29'] = $item['value_numeric']: NULL;
                    $item['question_id']=='526' ?  $migracion['c30'] = $item['value_numeric']: NULL;
                    $item['question_id']=='527' ?  $migracion['c31'] = $item['value_numeric']: NULL;
                    $item['question_id']=='528' ?  $migracion['c32'] = $item['value_numeric']: NULL;
                }
            }

            $this->model_migracion->db_set_prestaciones_data($migracion);
            //echo "Guardando Datos =>  Prestaciones";


        }
    }
    private function set_otras_prestaciones_data($data,$human_capital)
    {
        if (!empty($data)) {


            $i = 0;
            $migracion = array();
            $migracion['id_usuario'] = $this->replace_user_id($data[0]['user_id']);
            //$migracion['id_usuario'] = $data[0]['user_id'];
            $migracion['id_cha'] = $data[0]['actual_human_capital_id'];
            $migracion['fecha_creacion'] = $data[0]['date_created'];
            $migracion['fecha_actualizacion'] = $data[0]['last_updated'];
            $migracion['periodo'] = 0;



            if ($human_capital==84 || $human_capital==85 || $human_capital==86 || $human_capital==87 || $human_capital==88 || $human_capital==89 ||
                $human_capital==90 || $human_capital==91 || $human_capital==92 || $human_capital==93 || $human_capital==94 || $human_capital==95 ||
                $human_capital==96
            ) {
                echo "Guardando Datos:: Usuario=> " . $migracion['id_usuario'] . " Otras Prestaciones => DIAS FESTIVOS " . " Human Capital=>" . $human_capital . " </br>";


                foreach ($data as $item) {

                    $item['question_id']=='533' ?  $migracion['c5'] = $item['value_numeric']: NULL;
                    $item['question_id']=='534' ?  $migracion['c6'] = $item['value_numeric']: NULL;
                    $item['question_id']=='535' ?  $migracion['c7'] = $item['value_numeric']: NULL;
                    $item['question_id']=='536' ?  $migracion['c8'] = $item['value_numeric']: NULL;



                }
            }

            if ($human_capital==97 || $human_capital==98 || $human_capital==99 || $human_capital==100 || $human_capital==101){
                echo "Guardando Datos:: Usuario=> " . $migracion['id_usuario'] . " Otras Prestaciones => ESTUDIOS " . " Human Capital=>" . $human_capital . " </br>";


                foreach ($data as $item) {

                    $item['question_id']=='537' ?  $migracion['c9'] = $item['value_numeric']: NULL;
                    $item['question_id']=='538' ?  $migracion['c10'] = $item['value_numeric']: NULL;
                    $item['question_id']=='539' ?  $migracion['c11'] = $item['value_numeric']: NULL;
                    $item['question_id']=='540' ?  $migracion['c12'] = $item['value_numeric']: NULL;
                    $item['question_id']=='541' ?  $migracion['c13'] = $item['value_numeric']: NULL;

                    $item['question_id']=='542' ?  $migracion['c24'] = $item['value_numeric']: NULL;
                    $item['question_id']=='543' ?  $migracion['c25'] = $item['value_numeric']: NULL;
                    $item['question_id']=='544' ?  $migracion['c26'] = $item['value_numeric']: NULL;
                    $item['question_id']=='545' ?  $migracion['c27'] = $item['value_numeric']: NULL;
                    $item['question_id']=='546' ?  $migracion['c28'] = $item['value_numeric']: NULL;
                    $item['question_id']=='547' ?  $migracion['c29'] = $item['value_numeric']: NULL;
                    $item['question_id']=='548' ?  $migracion['c30'] = $item['value_numeric']: NULL;
                    $item['question_id']=='549' ?  $migracion['c31'] = $item['value_numeric']: NULL;
                    $item['question_id']=='550' ?  $migracion['c32'] = $item['value_numeric']: NULL;
                    $item['question_id']=='551' ?  $migracion['c33'] = $item['value_numeric']: NULL;
                    $item['question_id']=='552' ?  $migracion['c34'] = $item['value_numeric']: NULL;
                    $item['question_id']=='553' ?  $migracion['c35'] = $item['value_numeric']: NULL;
                    $item['question_id']=='554' ?  $migracion['c36'] = $item['value_numeric']: NULL;
                    $item['question_id']=='555' ?  $migracion['c37'] = $item['value_numeric']: NULL;
                    $item['question_id']=='556' ?  $migracion['c38'] = $item['value_numeric']: NULL;
                    $item['question_id']=='557' ?  $migracion['c39'] = $item['value_numeric']: NULL;
                    $item['question_id']=='558' ?  $migracion['c40'] = $item['value_numeric']: NULL;
                    $item['question_id']=='559' ?  $migracion['c41'] = $item['value_numeric']: NULL;
                    $item['question_id']=='560' ?  $migracion['c42'] = $item['value_numeric']: NULL;


                    $item['question_id']=='561' ?  $migracion['c24'] = $item['value_numeric']: NULL;
                    $item['question_id']=='562' ?  $migracion['c25'] = $item['value_numeric']: NULL;
                    $item['question_id']=='563' ?  $migracion['c26'] = $item['value_numeric']: NULL;
                    $item['question_id']=='564' ?  $migracion['c27'] = $item['value_numeric']: NULL;
                    $item['question_id']=='565' ?  $migracion['c28'] = $item['value_numeric']: NULL;
                    $item['question_id']=='566' ?  $migracion['c29'] = $item['value_numeric']: NULL;
                    $item['question_id']=='567' ?  $migracion['c30'] = $item['value_numeric']: NULL;
                    $item['question_id']=='568' ?  $migracion['c31'] = $item['value_numeric']: NULL;
                    $item['question_id']=='569' ?  $migracion['c32'] = $item['value_numeric']: NULL;
                    $item['question_id']=='570' ?  $migracion['c33'] = $item['value_numeric']: NULL;
                    $item['question_id']=='571' ?  $migracion['c34'] = $item['value_numeric']: NULL;
                    $item['question_id']=='572' ?  $migracion['c35'] = $item['value_numeric']: NULL;
                    $item['question_id']=='573' ?  $migracion['c36'] = $item['value_numeric']: NULL;
                    $item['question_id']=='574' ?  $migracion['c37'] = $item['value_numeric']: NULL;
                    $item['question_id']=='575' ?  $migracion['c38'] = $item['value_numeric']: NULL;
                    $item['question_id']=='576' ?  $migracion['c39'] = $item['value_numeric']: NULL;
                    $item['question_id']=='577' ?  $migracion['c40'] = $item['value_numeric']: NULL;
                    $item['question_id']=='578' ?  $migracion['c41'] = $item['value_numeric']: NULL;
                    $item['question_id']=='579' ?  $migracion['c42'] = $item['value_numeric']: NULL;


                    $item['question_id']=='580' ?  $migracion['c24'] = $item['value_numeric']: NULL;
                    $item['question_id']=='581' ?  $migracion['c25'] = $item['value_numeric']: NULL;
                    $item['question_id']=='582' ?  $migracion['c26'] = $item['value_numeric']: NULL;
                    $item['question_id']=='583' ?  $migracion['c27'] = $item['value_numeric']: NULL;
                    $item['question_id']=='584' ?  $migracion['c28'] = $item['value_numeric']: NULL;
                    $item['question_id']=='585' ?  $migracion['c29'] = $item['value_numeric']: NULL;
                    $item['question_id']=='586' ?  $migracion['c30'] = $item['value_numeric']: NULL;
                    $item['question_id']=='587' ?  $migracion['c31'] = $item['value_numeric']: NULL;
                    $item['question_id']=='588' ?  $migracion['c32'] = $item['value_numeric']: NULL;
                    $item['question_id']=='589' ?  $migracion['c33'] = $item['value_numeric']: NULL;
                    $item['question_id']=='590' ?  $migracion['c34'] = $item['value_numeric']: NULL;
                    $item['question_id']=='591' ?  $migracion['c35'] = $item['value_numeric']: NULL;
                    $item['question_id']=='592' ?  $migracion['c36'] = $item['value_numeric']: NULL;
                    $item['question_id']=='593' ?  $migracion['c37'] = $item['value_numeric']: NULL;
                    $item['question_id']=='594' ?  $migracion['c38'] = $item['value_numeric']: NULL;
                    $item['question_id']=='595' ?  $migracion['c39'] = $item['value_numeric']: NULL;
                    $item['question_id']=='596' ?  $migracion['c40'] = $item['value_numeric']: NULL;
                    $item['question_id']=='597' ?  $migracion['c41'] = $item['value_numeric']: NULL;
                    $item['question_id']=='598' ?  $migracion['c42'] = $item['value_numeric']: NULL;

                    $item['question_id']=='599' ?  $migracion['c24'] = $item['value_numeric']: NULL;
                    $item['question_id']=='600' ?  $migracion['c25'] = $item['value_numeric']: NULL;
                    $item['question_id']=='601' ?  $migracion['c26'] = $item['value_numeric']: NULL;
                    $item['question_id']=='602' ?  $migracion['c27'] = $item['value_numeric']: NULL;
                    $item['question_id']=='603' ?  $migracion['c28'] = $item['value_numeric']: NULL;
                    $item['question_id']=='604' ?  $migracion['c29'] = $item['value_numeric']: NULL;
                    $item['question_id']=='605' ?  $migracion['c30'] = $item['value_numeric']: NULL;
                    $item['question_id']=='606' ?  $migracion['c31'] = $item['value_numeric']: NULL;
                    $item['question_id']=='607' ?  $migracion['c32'] = $item['value_numeric']: NULL;
                    $item['question_id']=='608' ?  $migracion['c33'] = $item['value_numeric']: NULL;
                    $item['question_id']=='609' ?  $migracion['c34'] = $item['value_numeric']: NULL;
                    $item['question_id']=='610' ?  $migracion['c35'] = $item['value_numeric']: NULL;
                    $item['question_id']=='611' ?  $migracion['c36'] = $item['value_numeric']: NULL;
                    $item['question_id']=='612' ?  $migracion['c37'] = $item['value_numeric']: NULL;
                    $item['question_id']=='613' ?  $migracion['c38'] = $item['value_numeric']: NULL;
                    $item['question_id']=='614' ?  $migracion['c39'] = $item['value_numeric']: NULL;
                    $item['question_id']=='615' ?  $migracion['c40'] = $item['value_numeric']: NULL;
                    $item['question_id']=='616' ?  $migracion['c41'] = $item['value_numeric']: NULL;
                    $item['question_id']=='617' ?  $migracion['c42'] = $item['value_numeric']: NULL;

                    $item['question_id']=='618' ?  $migracion['c24'] = $item['value_numeric']: NULL;
                    $item['question_id']=='619' ?  $migracion['c25'] = $item['value_numeric']: NULL;
                    $item['question_id']=='620' ?  $migracion['c26'] = $item['value_numeric']: NULL;
                    $item['question_id']=='621' ?  $migracion['c27'] = $item['value_numeric']: NULL;
                    $item['question_id']=='622' ?  $migracion['c28'] = $item['value_numeric']: NULL;
                    $item['question_id']=='623' ?  $migracion['c29'] = $item['value_numeric']: NULL;
                    $item['question_id']=='624' ?  $migracion['c30'] = $item['value_numeric']: NULL;
                    $item['question_id']=='625' ?  $migracion['c31'] = $item['value_numeric']: NULL;
                    $item['question_id']=='626' ?  $migracion['c32'] = $item['value_numeric']: NULL;
                    $item['question_id']=='627' ?  $migracion['c33'] = $item['value_numeric']: NULL;
                    $item['question_id']=='628' ?  $migracion['c34'] = $item['value_numeric']: NULL;
                    $item['question_id']=='629' ?  $migracion['c35'] = $item['value_numeric']: NULL;
                    $item['question_id']=='630' ?  $migracion['c36'] = $item['value_numeric']: NULL;
                    $item['question_id']=='631' ?  $migracion['c37'] = $item['value_numeric']: NULL;
                    $item['question_id']=='632' ?  $migracion['c38'] = $item['value_numeric']: NULL;
                    $item['question_id']=='633' ?  $migracion['c39'] = $item['value_numeric']: NULL;
                    $item['question_id']=='634' ?  $migracion['c40'] = $item['value_numeric']: NULL;
                    $item['question_id']=='635' ?  $migracion['c41'] = $item['value_numeric']: NULL;
                    $item['question_id']=='636' ?  $migracion['c42'] = $item['value_numeric']: NULL;


                }
            }

            if ($human_capital==102 || $human_capital==103 || $human_capital==104 || $human_capital==105 || $human_capital==106 || $human_capital==107){
                echo "Guardando Datos:: Usuario=> " . $migracion['id_usuario'] . " Otras Prestaciones => DIAS FESTIVOS " . " Human Capital=>" . $human_capital . " </br>";


                foreach ($data as $item) {

                    $item['question_id']=='637' ?  $migracion['c14'] = $item['value_numeric']: NULL;
                    $item['question_id']=='638' ?  $migracion['c15'] = $item['value_numeric']: NULL;
                    $item['question_id']=='639' ?  $migracion['c16'] = $item['value_numeric']: NULL;
                    $item['question_id']=='640' ?  $migracion['c17'] = $item['value_numeric']: NULL;
                    $item['question_id']=='641' ?  $migracion['c18'] = $item['value_numeric']: NULL;
                    $item['question_id']=='642' ?  $migracion['c19'] = $item['value_numeric']: NULL;

                    $item['question_id']=='643' ?  $migracion['c24'] = $item['value_numeric']: NULL;
                    $item['question_id']=='644' ?  $migracion['c25'] = $item['value_numeric']: NULL;
                    $item['question_id']=='645' ?  $migracion['c26'] = $item['value_numeric']: NULL;
                    $item['question_id']=='646' ?  $migracion['c27'] = $item['value_numeric']: NULL;
                    $item['question_id']=='647' ?  $migracion['c28'] = $item['value_numeric']: NULL;
                    $item['question_id']=='648' ?  $migracion['c29'] = $item['value_numeric']: NULL;
                    $item['question_id']=='649' ?  $migracion['c30'] = $item['value_numeric']: NULL;
                    $item['question_id']=='650' ?  $migracion['c31'] = $item['value_numeric']: NULL;


                    $item['question_id']=='651' ?  $migracion['c24'] = $item['value_numeric']: NULL;
                    $item['question_id']=='652' ?  $migracion['c25'] = $item['value_numeric']: NULL;
                    $item['question_id']=='653' ?  $migracion['c26'] = $item['value_numeric']: NULL;
                    $item['question_id']=='654' ?  $migracion['c27'] = $item['value_numeric']: NULL;
                    $item['question_id']=='655' ?  $migracion['c28'] = $item['value_numeric']: NULL;
                    $item['question_id']=='656' ?  $migracion['c29'] = $item['value_numeric']: NULL;
                    $item['question_id']=='657' ?  $migracion['c30'] = $item['value_numeric']: NULL;
                    $item['question_id']=='658' ?  $migracion['c31'] = $item['value_numeric']: NULL;


                    $item['question_id']=='659' ?  $migracion['c24'] = $item['value_numeric']: NULL;
                    $item['question_id']=='660' ?  $migracion['c25'] = $item['value_numeric']: NULL;
                    $item['question_id']=='661' ?  $migracion['c26'] = $item['value_numeric']: NULL;
                    $item['question_id']=='662' ?  $migracion['c27'] = $item['value_numeric']: NULL;
                    $item['question_id']=='663' ?  $migracion['c28'] = $item['value_numeric']: NULL;
                    $item['question_id']=='664' ?  $migracion['c29'] = $item['value_numeric']: NULL;
                    $item['question_id']=='665' ?  $migracion['c30'] = $item['value_numeric']: NULL;
                    $item['question_id']=='666' ?  $migracion['c31'] = $item['value_numeric']: NULL;
                    $item['question_id']=='667' ?  $migracion['c32'] = $item['value_numeric']: NULL;
                    $item['question_id']=='668' ?  $migracion['c33'] = $item['value_numeric']: NULL;
                    $item['question_id']=='669' ?  $migracion['c34'] = $item['value_numeric']: NULL;
                    $item['question_id']=='670' ?  $migracion['c35'] = $item['value_numeric']: NULL;
                    $item['question_id']=='671' ?  $migracion['c36'] = $item['value_numeric']: NULL;
                    $item['question_id']=='672' ?  $migracion['c37'] = $item['value_numeric']: NULL;
                    $item['question_id']=='673' ?  $migracion['c38'] = $item['value_numeric']: NULL;
                    $item['question_id']=='674' ?  $migracion['c39'] = $item['value_numeric']: NULL;
                    $item['question_id']=='675' ?  $migracion['c40'] = $item['value_numeric']: NULL;
                    $item['question_id']=='676' ?  $migracion['c41'] = $item['value_numeric']: NULL;
                    $item['question_id']=='677' ?  $migracion['c42'] = $item['value_numeric']: NULL;


                    $item['question_id']=='678' ?  $migracion['c24'] = $item['value_numeric']: NULL;
                    $item['question_id']=='679' ?  $migracion['c25'] = $item['value_numeric']: NULL;
                    $item['question_id']=='680' ?  $migracion['c26'] = $item['value_numeric']: NULL;
                    $item['question_id']=='681' ?  $migracion['c27'] = $item['value_numeric']: NULL;
                    $item['question_id']=='682' ?  $migracion['c28'] = $item['value_numeric']: NULL;
                    $item['question_id']=='683' ?  $migracion['c29'] = $item['value_numeric']: NULL;
                    $item['question_id']=='684' ?  $migracion['c30'] = $item['value_numeric']: NULL;
                    $item['question_id']=='685' ?  $migracion['c31'] = $item['value_numeric']: NULL;
                    $item['question_id']=='686' ?  $migracion['c32'] = $item['value_numeric']: NULL;
                    $item['question_id']=='687' ?  $migracion['c33'] = $item['value_numeric']: NULL;
                    $item['question_id']=='688' ?  $migracion['c34'] = $item['value_numeric']: NULL;
                    $item['question_id']=='689' ?  $migracion['c35'] = $item['value_numeric']: NULL;
                    $item['question_id']=='690' ?  $migracion['c36'] = $item['value_numeric']: NULL;
                    $item['question_id']=='691' ?  $migracion['c37'] = $item['value_numeric']: NULL;
                    $item['question_id']=='692' ?  $migracion['c38'] = $item['value_numeric']: NULL;
                    $item['question_id']=='693' ?  $migracion['c39'] = $item['value_numeric']: NULL;
                    $item['question_id']=='694' ?  $migracion['c40'] = $item['value_numeric']: NULL;
                    $item['question_id']=='695' ?  $migracion['c41'] = $item['value_numeric']: NULL;
                    $item['question_id']=='696' ?  $migracion['c42'] = $item['value_numeric']: NULL;


                    $item['question_id']=='697' ?  $migracion['c24'] = $item['value_numeric']: NULL;
                    $item['question_id']=='698' ?  $migracion['c25'] = $item['value_numeric']: NULL;
                    $item['question_id']=='699' ?  $migracion['c26'] = $item['value_numeric']: NULL;
                    $item['question_id']=='700' ?  $migracion['c27'] = $item['value_numeric']: NULL;
                    $item['question_id']=='701' ?  $migracion['c28'] = $item['value_numeric']: NULL;
                    $item['question_id']=='702' ?  $migracion['c29'] = $item['value_numeric']: NULL;
                    $item['question_id']=='703' ?  $migracion['c30'] = $item['value_numeric']: NULL;
                    $item['question_id']=='704' ?  $migracion['c31'] = $item['value_numeric']: NULL;
                    $item['question_id']=='705' ?  $migracion['c32'] = $item['value_numeric']: NULL;
                    $item['question_id']=='706' ?  $migracion['c33'] = $item['value_numeric']: NULL;
                    $item['question_id']=='707' ?  $migracion['c34'] = $item['value_numeric']: NULL;
                    $item['question_id']=='708' ?  $migracion['c35'] = $item['value_numeric']: NULL;
                    $item['question_id']=='709' ?  $migracion['c36'] = $item['value_numeric']: NULL;
                    $item['question_id']=='710' ?  $migracion['c37'] = $item['value_numeric']: NULL;
                    $item['question_id']=='711' ?  $migracion['c38'] = $item['value_numeric']: NULL;
                    $item['question_id']=='712' ?  $migracion['c39'] = $item['value_numeric']: NULL;
                    $item['question_id']=='713' ?  $migracion['c40'] = $item['value_numeric']: NULL;
                    $item['question_id']=='714' ?  $migracion['c41'] = $item['value_numeric']: NULL;
                    $item['question_id']=='715' ?  $migracion['c42'] = $item['value_numeric']: NULL;


                    $item['question_id']=='716' ?  $migracion['c24'] = $item['value_numeric']: NULL;
                    $item['question_id']=='717' ?  $migracion['c25'] = $item['value_numeric']: NULL;
                    $item['question_id']=='718' ?  $migracion['c26'] = $item['value_numeric']: NULL;
                    $item['question_id']=='719' ?  $migracion['c27'] = $item['value_numeric']: NULL;
                    $item['question_id']=='720' ?  $migracion['c28'] = $item['value_numeric']: NULL;
                    $item['question_id']=='721' ?  $migracion['c29'] = $item['value_numeric']: NULL;
                    $item['question_id']=='722' ?  $migracion['c30'] = $item['value_numeric']: NULL;
                    $item['question_id']=='723' ?  $migracion['c31'] = $item['value_numeric']: NULL;
                    $item['question_id']=='724' ?  $migracion['c32'] = $item['value_numeric']: NULL;
                    $item['question_id']=='725' ?  $migracion['c33'] = $item['value_numeric']: NULL;
                    $item['question_id']=='726' ?  $migracion['c34'] = $item['value_numeric']: NULL;
                    $item['question_id']=='727' ?  $migracion['c35'] = $item['value_numeric']: NULL;
                    $item['question_id']=='728' ?  $migracion['c36'] = $item['value_numeric']: NULL;
                    $item['question_id']=='729' ?  $migracion['c37'] = $item['value_numeric']: NULL;
                    $item['question_id']=='730' ?  $migracion['c38'] = $item['value_numeric']: NULL;
                    $item['question_id']=='731' ?  $migracion['c39'] = $item['value_numeric']: NULL;
                    $item['question_id']=='732' ?  $migracion['c40'] = $item['value_numeric']: NULL;
                    $item['question_id']=='733' ?  $migracion['c41'] = $item['value_numeric']: NULL;
                    $item['question_id']=='734' ?  $migracion['c42'] = $item['value_numeric']: NULL;


                }
            }

            if ($human_capital==108 || $human_capital==109 || $human_capital==110) {
                echo "Guardando Datos:: Usuario=> " . $migracion['id_usuario'] . " Otras Prestaciones => JUBILACION y SUCESION " . " Human Capital=>" . $human_capital . " </br>";


                foreach ($data as $item) {

                    $item['question_id']=='735' ?  $migracion['c21'] = $item['value_numeric']: NULL;
                    $item['question_id']=='736' ?  $migracion['c22'] = $item['value_numeric']: NULL;
                    $item['question_id']=='738' ?  $migracion['c23'] = $item['value_numeric']: NULL;

                    $item['question_id']=='739' ?  $migracion['c24'] = $item['value_numeric']: NULL;
                    $item['question_id']=='740' ?  $migracion['c25'] = $item['value_numeric']: NULL;
                    $item['question_id']=='741' ?  $migracion['c26'] = $item['value_numeric']: NULL;
                    $item['question_id']=='742' ?  $migracion['c27'] = $item['value_numeric']: NULL;
                    $item['question_id']=='743' ?  $migracion['c28'] = $item['value_numeric']: NULL;
                    $item['question_id']=='744' ?  $migracion['c29'] = $item['value_numeric']: NULL;
                    $item['question_id']=='745' ?  $migracion['c30'] = $item['value_numeric']: NULL;
                    $item['question_id']=='746' ?  $migracion['c31'] = $item['value_numeric']: NULL;
                    $item['question_id']=='747' ?  $migracion['c32'] = $item['value_numeric']: NULL;
                    $item['question_id']=='748' ?  $migracion['c33'] = $item['value_numeric']: NULL;
                    $item['question_id']=='749' ?  $migracion['c34'] = $item['value_numeric']: NULL;
                    $item['question_id']=='750' ?  $migracion['c35'] = $item['value_numeric']: NULL;
                    $item['question_id']=='751' ?  $migracion['c36'] = $item['value_numeric']: NULL;
                    $item['question_id']=='752' ?  $migracion['c37'] = $item['value_numeric']: NULL;
                    $item['question_id']=='753' ?  $migracion['c38'] = $item['value_numeric']: NULL;
                    $item['question_id']=='754' ?  $migracion['c39'] = $item['value_numeric']: NULL;
                    $item['question_id']=='755' ?  $migracion['c40'] = $item['value_numeric']: NULL;
                    $item['question_id']=='756' ?  $migracion['c41'] = $item['value_numeric']: NULL;
                    $item['question_id']=='757' ?  $migracion['c42'] = $item['value_numeric']: NULL;


                    $item['question_id']=='758' ?  $migracion['c24'] = $item['value_numeric']: NULL;
                    $item['question_id']=='759' ?  $migracion['c25'] = $item['value_numeric']: NULL;
                    $item['question_id']=='760' ?  $migracion['c26'] = $item['value_numeric']: NULL;
                    $item['question_id']=='761' ?  $migracion['c27'] = $item['value_numeric']: NULL;
                    $item['question_id']=='762' ?  $migracion['c28'] = $item['value_numeric']: NULL;
                    $item['question_id']=='763' ?  $migracion['c29'] = $item['value_numeric']: NULL;
                    $item['question_id']=='764' ?  $migracion['c30'] = $item['value_numeric']: NULL;

                    $item['question_id']=='765' ?  $migracion['c43'] = $item['value_numeric']: NULL;
                    $item['question_id']=='766' ?  $migracion['c44'] = $item['value_numeric']: NULL;
                    $item['question_id']=='767' ?  $migracion['c45'] = $item['value_numeric']: NULL;
                    $item['question_id']=='768' ?  $migracion['c46'] = $item['value_numeric']: NULL;
                    $item['question_id']=='769' ?  $migracion['c47'] = $item['value_numeric']: NULL;
                    $item['question_id']=='770' ?  $migracion['c48'] = $item['value_numeric']: NULL;
                    $item['question_id']=='771' ?  $migracion['c49'] = $item['value_numeric']: NULL;





                }

            }
            $this->model_migracion->db_set_otras_prestaciones_data($migracion);


        }
    }

    private function get_data_by_question($user_id,$questions)
    {
        $result=$this->model_migracion->db_get_data_by_question($user_id,$questions);
        return $result;
    }
    private function get_data_by_actual_human_capital($user_id,$ahc_id)
    {
        $result=$this->model_migracion->db_get_data_by_actual_human_capital($user_id,$ahc_id);
        return $result;
    }
    private function get_users()
    {
        return $this->model_migracion->db_get_users();
    }

    private function replace_user_id($user_id)
    {
        $result=$this->model_migracion->db_get_usuarios_kerma_new($user_id);

        return $result;

    }

}


