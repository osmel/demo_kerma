<?php

class Reporter
{
    private $human_capital = [];
    private $container     = [];
    private $err           = [];
    private $user_id;
    private $repo_id;
    private $section;
    const NA    = 'NA';
    const UP    = 'Arriba';
    const DOWN  = 'Abajo';
    const PROFESIONALES   = 'profesionales';
    const ADMINISTRATIVOS = 'administrativos';
    const SIMPLE          = 'simple';
    const MULTIPLE        = 'multiple';


    public function __construct()
    {
        $this->CI =& get_instance();
        $this->CI->load->model('reportes/model_reportes');
        $this->CI->load->library('statics');


    }


    public function reporte($indice)
    {
        $reporte=[];
        $this->user_id='2732e323-83a4-11e8-be07-bcee7be16e8e';
        $this->repo_id=$indice;
        $this->repo_structure=$this->CI->reporter->getReportStructure($this->repo_id);


        $this->CI->model_reportes->setSection($this->repo_structure['section']);

         if($this->repo_structure['format'] == self::MULTIPLE){

             $i=0;
             foreach ($this->repo_structure['humancapital'] as $humancapital) {

                 $preguntas=implode(",", $this->repo_structure['questions']['main']);

                    $data = $this->CI->model_reportes->getUserDataByHumanCapital($preguntas,$humancapital,$this->user_id);

                    if($data!=NULL) {
                        $reporte[$i]['humancapital']=$this->getHumanCapitalName($humancapital);

                        $reporte[$i]['usuario'] = $this->getUserData($data, $this->repo_structure['level']);
                        $data = $this->CI->model_reportes->getUsersDataByHumanCapital($preguntas, $humancapital, $this->user_id);

                         $reporte[$i]['usuarios'] =$this->getUsersData($data,$this->repo_structure['level']);

                         $reporte[$i]['usuarios']['cuartiles']=$this->getQuartiles($data,$this->repo_structure['level']);



                         $reporte[$i]['usuarios']['niveles'] =$this->getLevels($data,$this->repo_structure['level']);
                         $reporte[$i]['usuario']['ranking'] =$this->getRanking($data,$reporte[$i]['usuario']['totalhm'],$this->repo_structure['level']);
                         $reporte[$i]['usuario']['vsprom'] =$this->getComparativeAverage($reporte[$i]['usuario']['totalhm'],$reporte[$i]['usuarios']['promedio']);


                        $i++;

                    }

             }


        }else{
             $i=0;
             foreach ($this->repo_structure['humancapital'] as $humancapital) {

                 $preguntas=implode(",", $this->repo_structure['questions']['main']);

                 $data = $this->CI->model_reportes->getUserDataByHumanCapital($preguntas,$humancapital,$this->user_id);

                 if($data!=NULL) {
                     $reporte[$i]['humancapital']=$this->getHumanCapitalName($humancapital);

                     $reporte[$i]['usuario']['data'] = $this->getUserData($data, $this->repo_structure['level']);
                     $data = $this->CI->model_reportes->getUsersDataByHumanCapital($preguntas, $humancapital, $this->user_id);

                     $reporte[$i]['usuarios']['promedio'] =$this->getUsersData($data,$this->repo_structure['level']);

                     $reporte[$i]['usuarios']['cuartiles']=$this->getQuartiles($data,$this->repo_structure['level']);

                     $reporte[$i]['usuarios']['niveles'] =$this->getLevels($data,$this->repo_structure['level']);
                      $reporte[$i]['usuario']['ranking'] =$this->getRanking($data,$reporte[$i]['usuario']['data'],$this->repo_structure['level']);
                      $reporte[$i]['usuario']['vsprom'] =$this->getComparativeAverage($reporte[$i]['usuario']['data'],$reporte[$i]['usuarios']['promedio']);

                      $data = $this->CI->model_reportes->getDescriptionByHumanCapital($preguntas,$humancapital,$this->user_id);


                     $i++;


                 }

             }
             return $this->prepareJson($reporte);
         }
        //$this->debug($reporte);




    }
    public function getUsersData(&$data,$isMultiple)
    {
        $result=[];
        switch ($isMultiple){
            case 1 :
                $result=$this->getSingleUsersData($data);
                break;
            case 2 :
                $result=$this->getMultipleUsersData($data);
                break;

        }

        return $result;
    }
    public function getUserData(&$data,$isMultiple)
    {

        $result=[];
        switch ($isMultiple){
            case 1 :
                $result=$this->getSingleUserData($data);
                break;
            case 2 :
                $result=$this->getMultipleUserData($data);
                break;

        }

        return $result;

    }
    public function getSingleUsersData(&$data)
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

    public function getSingleUserData(&$data)
    {

        @$dato = $data[0];

        if ($dato != NULL && is_numeric($dato)){

            $result=number_format($dato,2,'.',',');

        }else{
            $result = self::NA;
        }

        return $result;
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

    public function getAverageUsersData($data)
    {

        $i = 0;
        $matrix = [];
        foreach ($data as $item) {
            if ($item[$this->question] != NULL) {
                $matrix[$i] = $item[$this->question];
                $i++;
            }
        }

        $average= $this->CI->statics->average($matrix);


        return $average;
    }

    public function getQuartiles($data,$isMultiple)
    {

        if($isMultiple==1){

            $i=0;
            $matrix=[];
            foreach ($data as $item)
            {
                if($item[0] != null){
                    $matrix[$i] = $item[0];
                    $i++;
                }
            }

            $quartiles= $this->CI->statics->quartiles($matrix);


        }elseif($isMultiple==2){
            $i=0;
            $matrix=[];
            foreach ($data as $item) {
                if (!empty($item['0']) OR !empty($item['1'])) {

                    $sum = $item['0'] + $item['1'];
                    array_push($matrix,$sum);
                }
            }

            $quartiles=$this->CI->statics->quartiles($matrix);

        }

        return $quartiles;


    }

    public function getLevels(&$data,$isMultiple)
    {

       if($isMultiple==1){

           $i=0;
           $matrix=[];
           foreach ($data as $item)
           {
               if($item[0] != null){
                   $matrix[$i] = $item[0];
                   $i++;
               }
           }

           $result= $this->CI->statics->levels($matrix);

           return $result;

       }elseif($isMultiple==2){


           $matrix = [];
           foreach ($data as $item) {
               if (!empty($item['0']) OR !empty($item['1'])) {

                   $sum = $item['0'] + $item['1'];

                   array_push($matrix, $sum);
               }
           }

           $result['alto'] = max($matrix);
           $result['bajo'] = min($matrix);


           return $result;
       }



    }

    public function getRanking(&$data,$usuario_promedio,$isMultiple)
    {


        if($isMultiple==1){

            $i=0;
            $matrix=[];
            foreach ($data as $item)
            {
                if($item[0] != null){
                    $matrix[$i] = $item[0];
                    $i++;
                }
            }

        }elseif($isMultiple==2) {
            $i = 0;
            $matrix = [];
            foreach ($data as $item) {
                if (!empty($item['0']) OR !empty($item['1'])) {
                    $matrix[$i] = $item['0'] + $item['1'];
                    $i++;
                }
            }

        }




        array_push($matrix, $usuario_promedio);

        $ranking= $this->CI->statics->ranking_desc($matrix);

        $pos = array_search($usuario_promedio, array_column($ranking, 'value'));
        $rank=$ranking[$pos]['ranking'];

        return $rank . '.°';



    }

    public function getComparativeAverage($usuario_promedio,$usuarios_promedio)
    {

        $vsprom='';
        if($usuario_promedio>=$usuarios_promedio){
            $vsprom = self::UP;
        }elseif($usuario_promedio<=$usuarios_promedio){
            $vsprom = self::DOWN;
        }

        return $vsprom;
    }


    public function debug($data)
    {
        echo "<pre>". print_r($data,1) . "</pre>";
    }

    public function checkNull($data)
    {


        return (count(array_filter($data)) == NULL) ? 1 : 0;
    }

    public function getReportStructure($index)
    {






        $result=[];
        $container=[

            ['index'=>'2.1','name'=>'Total Personal Profesional' ,'section'=> SELF::PROFESIONALES,'humancapital'=>[1,2,3,4,5,6,20,18,17,16,15,14,13,12,11,10,9,8,7,19,29,30,31,32,33,34],'format'=>SELF::MULTIPLE,'level'=>'2','questions'=>['main'=>['c3','c4'],'alt1'=>['c3','c4']]],
            ['index'=>'2.2','name'=>'Total Personal Administrativo' ,'section'=> SELF::ADMINISTRATIVOS,'humancapital'=>[41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61,62],'format'=>SELF::MULTIPLE,'level'=>'2','questions'=>['main'=>['c3','c4'],'alt1'=>['c3','c4']]],
            ['index'=>'2.3','name'=>'Total Staff Apoyo' ,'section'=> SELF::ADMINISTRATIVOS,'humancapital'=>[63,64,65,66,67,68,69,70,71],'format'=>SELF::MULTIPLE,'level'=>'2','questions'=>['main'=>['c3','c4'],'alt1'=>['c3','c4']]],

            ['index'=>'2.7','name'=>'Experiencia Personal Profesional(años desde la titulación)','section'=> SELF::PROFESIONALES,'humancapital'=>[1,2,3,4,5,6,20,18,17,16,15,14,13,12,11,10,9,8,7,19,29,30,31,32,33,34],'format'=>SELF::SIMPLE,'level'=>'1','questions'=>['main'=>['c13']]],
            ['index'=>'2.8','name'=>'Experiencia Personal Administrativo(años desde la titulación)','section'=> SELF::ADMINISTRATIVOS,'humancapital'=>[41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61,62],'format'=>SELF::SIMPLE,'level'=>'1','questions'=>['main'=>['c13']]],
            ['index'=>'2.10','name'=>'Antiguedad Personal Profesional','section'=> SELF::PROFESIONALES,'humancapital'=>[1,2,3,4,5,6,20,18,17,16,15,14,13,12,11,10,9,8,7,19,29,30,31,32,33,34],'format'=>SELF::SIMPLE,'level'=>'1','questions'=>['main'=>['c26']]],
            ['index'=>'2.11','name'=>'Antiguedad Personal Administrativo','section'=> SELF::ADMINISTRATIVOS,'humancapital'=>[41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61,62],'format'=>SELF::SIMPLE,'level'=>'1','questions'=>['main'=>['c26']]],
            ['index'=>'2.12','name'=>'Antiguedad Staff Apoyo','section'=> SELF::ADMINISTRATIVOS,'humancapital'=>[63,64,65,66,67,68,69,70,71],'format'=>SELF::SIMPLE,'level'=>'1','questions'=>['main'=>['c26']]],

            ['index'=>'2.16','name'=>'Edad Personal Profesional','section'=> SELF::PROFESIONALES,'humancapital'=>[1,2,3,4,5,6,20,18,17,16,15,14,13,12,11,10,9,8,7,19,29,30,31,32,33,34],'format'=>SELF::SIMPLE,'level'=>'1','questions'=>['main'=>['c14']]],
            ['index'=>'2.17','name'=>'Edad Personal Administrativo' ,'section'=> SELF::ADMINISTRATIVOS,'humancapital'=>[41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61,62],'format'=>SELF::SIMPLE,'level'=>'1','questions'=>['main'=>['c14']]],
            ['index'=>'2.18','name'=>'Edad Staff Apoyo' ,'section'=> SELF::ADMINISTRATIVOS,'humancapital'=>[63,64,65,66,67,68,69,70,71],'format'=>SELF::SIMPLE,'level'=>'1','questions'=>['main'=>['c14']]],

            ['index'=>'3.1','name'=>'Sueldo Base Promedio Mensual Personal por Tarifa Horaria','section'=> SELF::PROFESIONALES,'humancapital'=>[1,2,3,4,5,6,20,18,17,16,15,14,13,12,11,10,9,8,7,19,29,30,31,32,33,34],'format'=>SELF::SIMPLE,'level'=>'1','questions'=>['main'=>['c15']]],
            ['index'=>'3.3','name'=>'Sueldo Base Promedio Mensual Personal por Años de Experiencia','section'=> SELF::PROFESIONALES,'humancapital'=>[21,22,23,24,25,26,27,28],'format'=>SELF::SIMPLE,'level'=>'1','questions'=>['main'=>['c15']]],
            ['index'=>'3.4','name'=>'Sueldo Base Promedio Mensual Personal Administrativo','section'=> SELF::ADMINISTRATIVOS,'humancapital'=>[41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61,62],'format'=>SELF::SIMPLE,'level'=>'1','questions'=>['main'=>['c15']]],
            ['index'=>'3.5','name'=>'Sueldo Base Promedio Mensual Sfaff Apoyo','section'=> SELF::ADMINISTRATIVOS,'humancapital'=>[63,64,65,66,67,68,69,70,71],'format'=>SELF::SIMPLE,'level'=>'1','questions'=>['main'=>['c15']]],
            ['index'=>'3.6','name'=>'Sueldo Base Promedio Anual Personal Profesional por Tarifa Horaria','section'=> SELF::PROFESIONALES,'humancapital'=>[1,2,3,4,5,6,20,18,17,16,15,14,13,12,11,10,9,8,7,19,29,30,31,32,33,34],'format'=>SELF::SIMPLE,'level'=>'1','questions'=>['main'=>['c21']]],
            ['index'=>'3.7','name'=>'Sueldo Base Promedio Anual Personal Profesional por Años de Experiencia','section'=> SELF::PROFESIONALES,'humancapital'=>[21,22,23,24,25,26,27,28],'format'=>SELF::SIMPLE,'level'=>'1','questions'=>['main'=>['c21']]],
            ['index'=>'3.8','name'=>'Sueldo Base Promedio Anual Personal Administrativo','section'=> SELF::ADMINISTRATIVOS,'humancapital'=>[41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61,62],'format'=>SELF::SIMPLE,'level'=>'1','questions'=>['main'=>['c21']]],
            ['index'=>'3.9','name'=>'Sueldo Base Promedio Anual Staff Apoyo','section'=> SELF::ADMINISTRATIVOS,'humancapital'=>[63,64,65,66,67,68,69,70,71],'format'=>SELF::SIMPLE,'level'=>'1','questions'=>['main'=>['c21']]],
            ['index'=>'3.10','name'=>'Sueldo Base Promedio Anual con Conpensaciones Personal Profesional por Tarifa Horaria','section'=> SELF::PROFESIONALES,'humancapital'=>[1,2,3,4,5,6,20,18,17,16,15,14,13,12,11,10,9,8,7,19,29,30,31,32,33,34],'format'=>SELF::SIMPLE,'level'=>'1','questions'=>['main'=>['c21']]],

            ['index'=>'3.11','name'=>'Sueldo Base Promedio Anual con Conpensaciones Personal Profesional por Años de Experiencia','section'=> SELF::PROFESIONALES,'humancapital'=>[21,22,23,24,25,26,27,28],'format'=>SELF::SIMPLE,'level'=>'1','questions'=>['main'=>['c21']]],
            ['index'=>'3.12','name'=>'Sueldo Base Promedio Anual con Conpensaciones Personal Administrativo','section'=> SELF::PROFESIONALES,'humancapital'=>[41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61,62],'format'=>SELF::SIMPLE,'level'=>'1','questions'=>['main'=>['c21']]],
            ['index'=>'3.13','name'=>'Sueldo Base Promedio Anual con Conpensaciones Staff Apoyo','section'=> SELF::PROFESIONALES,'humancapital'=>[63,64,65,66,67,68,69,70,71],'format'=>SELF::SIMPLE,'level'=>'1','questions'=>['main'=>['c21']]],

            ['index'=>'3.14.1','name'=>'Sueldo Base Promedio Mensual Personal Profesional no Abogados','section'=> SELF::PROFESIONALES,'humancapital'=>[35,36,37,38,39,40],'format'=>SELF::SIMPLE,'level'=>'1','questions'=>['main'=>['c15']]],
            ['index'=>'3.14.2','name'=>'Sueldo Base Promedio Anual Personal Profesional no Abogados','section'=> SELF::PROFESIONALES,'humancapital'=>[35,36,37,38,39,40],'format'=>SELF::SIMPLE,'level'=>'1','questions'=>['main'=>['c21']]],
            ['index'=>'3.14.3','name'=>'Sueldo Base Promedio Anual Con Compensaciones Personal Profesional no Abogados','section'=> SELF::PROFESIONALES,'humancapital'=>[35,36,37,38,39,40],'format'=>SELF::SIMPLE,'level'=>'1','questions'=>['main'=>['c21']]],
            ['index'=>'3.14.3','name'=>'Sueldo Base Promedio Anual Con Compensaciones Personal Profesional no Abogados','section'=> SELF::PROFESIONALES,'humancapital'=>[35,36,37,38,39,40],'format'=>SELF::SIMPLE,'level'=>'1','questions'=>['main'=>['c21']]],


            ['index'=>'4.1.1','name'=>'Bonos e Incentivos Personal Profesional','section'=> SELF::PROFESIONALES,'humancapital'=>[20,18,17,16,15,14,13,12,11,10,9,8,7,19,29,30,31,32,33,34],'format'=>SELF::SIMPLE,'level'=>'1','questions'=>['main'=>['c18']]],
            ['index'=>'4.1.2','name'=>'Bonos e Incentivos Personal Administrativo','section'=> SELF::ADMINISTRATIVOS,'humancapital'=>[41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61,62],'format'=>SELF::SIMPLE,'level'=>'1','questions'=>['main'=>['c18']]],
            ['index'=>'4.1.2','name'=>'Bonos e Incentivos Apoyo Administrativo','section'=> SELF::ADMINISTRATIVOS,'humancapital'=>[63,64,65,66,67,68,69,70,71],'format'=>SELF::SIMPLE,'level'=>'1','questions'=>['main'=>['c18']]],

            ['index'=>'5.5','name'=>'Vacaciones Personal Profesional','section'=> SELF::PROFESIONALES,'humancapital'=>[1,2,3,4,5,6,20,18,17,16,15,14,13,12,11,10,9,8,7,19,29,30,31,32,33,34],'format'=>SELF::SIMPLE,'level'=>'1','questions'=>['main'=>['c27']]],
            ['index'=>'5.6','name'=>'Vacaciones Personal Administrativo','section'=> SELF::ADMINISTRATIVOS,'humancapital'=>[41,42,43,44,45,46,47,48,49,50,51,52,53,54,55,56,57,58,59,60,61,62],'format'=>SELF::SIMPLE,'level'=>'1','questions'=>['main'=>['c27']]],
            ['index'=>'5.7','name'=>'Vacaciones Staff Apoyo','section'=> SELF::ADMINISTRATIVOS,'humancapital'=>[63,64,65,66,67,68,69,70,71],'format'=>SELF::SIMPLE,'level'=>'1','questions'=>['main'=>['c27']]],

        ];

        for($i=0;$i<count($container);$i++){

            $data=$container[$i]['index'];

;            if ($data===$index){
                $result=$container[$i];
                break;
            }else{
                $result=NULL;
            }
        }

        return $result;


    }

    public function prepareJson($reporte)
    {

        $json_data=[];
        $json_data['meta']['page']='1';
        $json_data['meta']['pages']='1';
        $json_data['meta']['perpage']='1';
        $json_data['meta']['total']='1';
        $json_data['meta']['sort']='asc';
        $json_data['meta']['field']='promedio';
        for($i=0;$i<count($reporte);$i++) {
            $json_data['data'][$i]['humancapital']=$reporte[$i]['humancapital'];
            $json_data['data'][$i]['usuario']=$reporte[$i]['usuario']['data'];
            $json_data['data'][$i]['promedio']=$reporte[$i]['usuarios']['promedio'];
            $json_data['data'][$i]['q1']=$reporte[$i]['usuarios']['cuartiles']['q1'];
            $json_data['data'][$i]['q2']=$reporte[$i]['usuarios']['cuartiles']['q2'];
            $json_data['data'][$i]['q3']=$reporte[$i]['usuarios']['cuartiles']['q3'];
            $json_data['data'][$i]['alto']=$reporte[$i]['usuarios']['niveles']['high'];
            $json_data['data'][$i]['bajo']=$reporte[$i]['usuarios']['niveles']['low'];
            $json_data['data'][$i]['ranking']=$reporte[$i]['usuario']['ranking'];
            $json_data['data'][$i]['vsprom']=$reporte[$i]['usuario']['vsprom'];
        }


        return $json_data;

    }

    public function getHumanCapitalName($humancapital)
    {
        $description= $this->CI->model_reportes->getDescriptionbyHumanCapital2($humancapital);
        return $description;
    }


}