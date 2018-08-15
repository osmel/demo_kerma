<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');
class Statics{

    private $n=0;

    public function quartiles(array $data)
    {

        $quartiles=array();
        sort($data);
        $data=$this->order_array($data);

        $quartiles['q1']=$this->lower_quartile($data);
        $quartiles['q2']=$this->median_quartile($data);
        $quartiles['q3']=$this->upper_quartile($data);

        return $quartiles;
    }

    private function lower_quartile($data)
    {


        //var_dump($pos);
        if(is_array($data)) {
            $n = count($data);
            if($n>1) {
                $pos = floor(($n + 1) / 4);


                if ($pos >= $n) {
                    $pos--;
                } elseif ($pos < 1) {
                    $pos++;
                }


                if (is_float($pos)) {
                    $numbers[0] = $data[$pos];
                    $numbers[1] = $data[$pos + 1];
                    $q1 = $this->average($numbers);

                } else {
                    $q1 = $data[$pos];

                }
                return number_format((float)$q1, 2, '.', ',');
            }else{
                //throw new Exception('Se necesita mas de un dato en el array para realizar esta operacion');
                return 'Se necesita mas de un dato para realizar esta operación';
            }
        }else{
            //throw new Exception('No es array');
            return 'No existen Datos';

        }




    }
    private function median_quartile($data)
    {
        if(is_array($data)) {
            $n = count($data);
            $pos = ($n + 1) / 2;
            if ($n > 1) {

                if (is_float($pos)) {
                    $numbers[0] = $data[$pos];
                    $numbers[1] = $data[$pos + 1];
                    $q2 = $this->average($numbers);

                } else {
                    $q2 = $data[$pos];

                }

                return number_format((float)$q2, 2, '.', ',');
            } else {
                //throw new Exception('Se necesita mas de un dato en el array para realizar esta operacion');
                return 'Se necesita mas de un dato para realizar esta operación';
            }
        }else{
            //throw new Exception('No es array');
            return 'No existen Datos';
        }

    }
    private function upper_quartile($data)
    {
        if(is_array($data)) {
            $n = count($data);
            if ($n > 1) {
                $pos = ((3 * ($n + 1) / 4));

                //Control si el resultado de la formula (posicion) es mayor o igual al total del array hay desbordamiento
                //para  prevenir decrementamos en uno, y si es menor a 1 pasa lo mismo pues no existen posicion 0
                // en el array debido a que el array comienza en uno y no en 0
                if ($pos >= $n) {
                    $pos--;
                } elseif ($pos < 1) {
                    $pos++;
                }


                if (is_float($pos)) {
                    $numbers[0] = $data[$pos];
                    $numbers[1] = $data[$pos + 1];
                    $q3 = $this->averageWithoutFormat($numbers);

                } else {
                    $q3 = $data[$pos];

                }

                return number_format((float)$q3, 2, '.', ',');
            } else {
                //throw new Exception('Se necesita mas de un dato en el array para realizar esta operacion');
                return 'Se necesita mas de un dato para realizar esta operación';
            }
        }else{
            //throw new Exception('No es array');
            return 'No existen Datos';
        }
    }
    private function order_array($data)
    {

        //Start array from 1 instead of 0
        if( array_sum($data)!=NULL) {
            $order = array_combine(range(1, count($data)), $data);
        }else{
            $order ="No existen Datos";
        }
        return $order;
    }

    public function averageWithoutFormat($data)
    {
        if(!empty($data) && ($data !=NULL)) {
            $average = array_sum($data) / count($data);
            return $average;
        }else{
            return "NA";
        }

        //return number_format((float)$average,2,'.',',');
    }
    public function average($data)
    {



        if(!empty($data) && ($data !=NULL)) {
            $average = array_sum($data) / count($data);


            return number_format((float)$average,2,'.','');
        }else{
            return "NA";
        }




    }


    public function ranking_desc($matrix)
    {

        $ranking=[];
        $j = 0;
        $i = 1;

        foreach ($matrix as $key => $values) {
            $max = max($matrix);
            $ranking[$j]['value'] = $max;
            $ranking[$j]['ranking'] = $i;
            $keys = array_search($max, $matrix);
            unset($matrix[$keys]);
            if (sizeof($matrix) > 0) {
                if (!in_array($max, $matrix)) {
                    $i++;
                }
            }
            $j++;
        }

     return $ranking;
    }

    public function levels($data)
    {
        if( array_sum($data)!=NULL) {
            $levels['high'] = number_format((float)max($data), 2, '.', ',');
            $levels['low'] = number_format((float)min($data), 2, '.', ',');
        }else{
            $levels['high'] = 'No Existen Datos';
            $levels['low'] = 'No Existen Datos';
        }
        return $levels;
    }

}