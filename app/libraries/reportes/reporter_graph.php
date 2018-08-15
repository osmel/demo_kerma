<?php

class reporter_graph
{
   public function reporte_graph($data)
   {
     $graph=[];

     $graph['theme']='light';
     $graph['type']= 'serial';
     $graph[]['valueAxes']['unit']='%';
     $graph[]['valueAxes']['position']='left';
     $graph[]['valueAxes']['title']='Total Personal Profesional';
     $graph['startDuration']='1';
     $graph[]['graphs']['ballonText']='Promedio otras firmas [[category]] <b>[[value]]</b>';
     $graph[]['graphs']['fillAlphas']='0.9';
     $graph[]['graphs']['lineAlpha']='0.2';
     $graph[]['graphs']['title']='Promedio Otras Firmas';
     $graph[]['graphs']['type']='column';
     $graph[]['graphs']['valueField']='promedio_firmas';
     $graph['plotAreaFillAlphas']='0.1';
     $graph['categoryField']='datos';
     $graph['categoryAxis']['gridPosition']='start';
     $graph['export']['enabled']='true';

     $i=0;
     foreach ($data['data'] as $item) {
           $graph[$i]['dataProvider']['enabled']='true';
           $i++;

     }




   }

}