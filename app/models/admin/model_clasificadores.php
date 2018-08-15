<?php if(! defined('BASEPATH')) exit('No tienes permiso para acceder a este archivo');

  class model_clasificadores extends CI_Model{
    
    private $key_hash;
    private $timezone;

    function __construct(){
      parent::__construct();
      $this->load->database("default");
      $this->key_hash    = $_SERVER['HASH_ENCRYPT'];
      $this->timezone    = 'UM1';

        //usuarios
          $this->usuarios             = $this->db->dbprefix('usuarios');
          $this->perfiles             = $this->db->dbprefix('perfiles');
          $this->historico_acceso     = $this->db->dbprefix('historico_acceso');

          $this->entidades     = $this->db->dbprefix('op_configuracion_entidades');

          $this->entidades__usuarios     = $this->db->dbprefix('entidades__usuarios');
          


          $this->modulos                                = $this->db->dbprefix('cat_view_modulos');          
          $this->roles                                = $this->db->dbprefix('roles');          
          $this->permisos                                = $this->db->dbprefix('permisos');          
          
          $this->relacion_modulo__encabezado_pregunta   = $this->db->dbprefix('cat_view_modulo__encabezado_pregunta');
          $this->encabezado_pregunta                    = $this->db->dbprefix('cat_view_encabezado_pregunta');
          $this->preguntas                    = $this->db->dbprefix('cat_view_preguntas');


          //empresas

          $this->op_configuracion_entidades                   = $this->db->dbprefix('op_configuracion_entidades');

          $this->cat_tipo_entidad                             = $this->db->dbprefix('cat_tipo_entidad');
          $this->cat_estados                             = $this->db->dbprefix('cat_estado');
          $this->cat_ciudades                             = $this->db->dbprefix('cat_ciudad');
          
          
   

          $this->tipo_pregunta                    = $this->db->dbprefix('cat_tipo_pregunta');         
          $this->relacion_valores_pregunta                    = $this->db->dbprefix('cat_view_valores_predefinidos_pregunta');
          $this->valores_predefinidos                    = $this->db->dbprefix('cat_valores_predefinidos');         
          $this->tipo_valores_predefinidos                    = $this->db->dbprefix('cat_tipo_valores_predefinidos');      


          $this->capital_humano_actual_por_preguntas                    = $this->db->dbprefix('capital_humano_actual_por_preguntas');      
          $this->capital_humano_actual                    = $this->db->dbprefix('capital_humano_actual');      
          $this->grupo_capital_humano                    = $this->db->dbprefix('grupo_capital_humano');      
          $this->categoria_capital_humano                    = $this->db->dbprefix('categoria_capital_humano');      
          $this->tipo_capital_humano                    = $this->db->dbprefix('tipo_capital_humano');      
          $this->rango_capital_humano                    = $this->db->dbprefix('rango_capital_humano');      

       



    }



    public function listado_subcategorias($data){
            $id_session = $this->session->userdata('id');
            
            $this->db->select('e.id, e.nombre, m.nombre principal,m.url url_principal,e.url url_hijo, r.id id_encabezado' );
            
            $this->db->from($this->modulos.' m');
            $this->db->join($this->relacion_modulo__encabezado_pregunta.' r', ' r.id_modulo = m.id');
            $this->db->join($this->encabezado_pregunta.' e', ' r.id_encabezado_pregunta = e.id');

            $where = '(
                        (m.id ='.$data['id_modulo'].') 
              )';   
            $this->db->where($where);
            
            $this->db->group_by('e.nombre'); 

              $result = $this->db->get();
              if ($result->num_rows() > 0)
                return $result->result();
              else 
                return FALSE;
              $login->free_result();
      }  



      //rch.id id_rango, rch.descripcion rango_nombre,

public function categorias($data){
     $datos = ("
      
        SELECT  cch.id id, cch.descripcion nombre
          FROM  kerma_categoria_capital_humano cch 
                  INNER JOIN kerma_tipo_capital_humano tch ON tch.id = cch.id_tipo_capital_humano
        WHERE  tch.id_modulo_temp=".$data['id_modulo']."
      "); 
    
      $result = $this->db->query($datos);

        
        if ( $result->num_rows() > 0 ) {
                  return $result->result();
              } else 
                  return false;
            $result->free_result();     
}

public function grupo_rango($data){
   $datos = ("
    SELECT  
          gch.id id_grupo, gch.descripcion grupo_nombre, gch.id_rango_temp,
          GROUP_CONCAT(DISTINCT(rch.descripcion) ORDER BY rch.id SEPARATOR '|') as rangos,
          GROUP_CONCAT(DISTINCT(rch.id) ORDER BY rch.id SEPARATOR '|') as id_rangos

     FROM  kerma_grupo_capital_humano gch 
         LEFT JOIN kerma_rango_capital_humano rch ON rch.id_tipo_rango = gch.id_rango_temp
      group by  gch.id  

    "); 
    
      $result = $this->db->query($datos);

        
        if ( $result->num_rows() > 0 ) {
                  return $result->result();
              } else 
                  return false;
            $result->free_result();     
}







public function botones($data){
   $datos = ("
    SELECT  cha.id ,  cha.id_categoria_capital_humano ,  cha.id_grupo_capital_humano,
        gch.descripcion grupo_nombre, cch.descripcion categoria_nombre, tch.descripcion, rch.descripcion

      FROM  kerma_capital_humano_actual cha  
         LEFT JOIN kerma_grupo_capital_humano gch ON gch.id = cha.id_grupo_capital_humano
         LEFT JOIN kerma_categoria_capital_humano cch ON cch.id = cha.id_categoria_capital_humano
              LEFT JOIN kerma_tipo_capital_humano tch ON tch.id = cch.id_tipo_capital_humano
         LEFT JOIN kerma_rango_capital_humano rch ON rch.id = cha.id_rango_capital_humano


    WHERE  id_rango_capital_humano IS NULL
           and tch.id_modulo_temp=".$data['id_modulo']."

    "); 
    


      $result = $this->db->query($datos);

        
        if ( $result->num_rows() > 0 ) {
                  return $result->result();
              } else 
                  return false;
            $result->free_result();     
}

  public function listado_sub_modulos($data){

        $id_session = $this->session->userdata('id'); 
        
        if ($this->session->userdata('id_perfil')==4 ) {
            $editores = "
            INNER JOIN 
            (SELECT ro.id_modulo, id_permiso
                FROM kerma_usuarios as u
                JOIN kerma_roles as ro ON u.id = ro.id_usuario 
                WHERE (u.id = '".$id_session."'  and ro.id_permiso<>0) 
            )  permisos_editores  on permisos_editores.id_modulo = id_principal";
        } else {
          $editores = "";
        }


          // pestana =1 si id_modulo=3 o 5
          $data['pestana'] = ( ($data['id_modulo']==3) || ($data['id_modulo']==5) ) ? 1 : 0;


          //
          if ($data['seleccionado']=='id_sub_modulo') {

              if ($data['pestana']==0 ) {  //normales
                  $filtro = " r.id_encabezado_pregunta = ".$data['id_sub_modulo']." and ";
              } else { //profesionales, administrativos
                  $filtro = " (cch.id = ".$data['id_sub_modulo'].") and ";

              }
              

          } else {
          $filtro =" ";           
          }

          //
          if ($data['seleccionado']=='id_agrupamiento') {

                  if  (isset($data['id_agrupamiento_campo'])) {  //normales
                      $filtro = "  ".$data['id_agrupamiento_campo']." = ".$data['id_agrupamiento']." and ";
                  }
          }           
                
          
          if ($data['pestana']==0) {
              //$this->db->group_by('p.id,p.id_numeracion_pregunta');   
              $grupos= ' group by p.id_numeracion_pregunta ';
          } else { //pestana=1 profesionales y administrador 
              //$this->db->group_by('cch.id');  
              $grupos= ' group by cch.id ';
          }


            if (($data['seleccionado']=='id_modulo') || ($data['seleccionado']=='id_botones')) {
                   $grupos= '';   
            }       

                //$grupos= '';  



          $datos = ("
            select * from (
            select 

                        id_principal,  principal,  url_principal,
                      
                         
                         pestanas,

                         (case when (pestanas=0) then hijo0 else hijo1 end) hijos, 
                         (case when (pestanas=0) then id_hijo0 else id_hijo1 end) id_hijos,

                         (case when (pestanas=0) then boton0 else boton1 end) botones, 
                         (case when (pestanas=0) then id_boton0 else id_boton1 end) id_botones,

                         sub_seleccion agrupamiento,
                         icono

   

                         from 
                (SELECT 
                          ".$data['pestana']." pestanas,

                          m.id id_principal,  m.nombre principal,  m.url url_principal,

                          GROUP_CONCAT(DISTINCT(e.nombre) ORDER BY e.id SEPARATOR '|') hijo0, 
                          GROUP_CONCAT(DISTINCT(e.id) ORDER BY e.id SEPARATOR '|') id_hijo0, 

                          GROUP_CONCAT(DISTINCT(cch.descripcion) ORDER BY cch.id SEPARATOR '|') hijo1, 
                          GROUP_CONCAT(DISTINCT(cch.id) ORDER BY cch.id SEPARATOR '|') id_hijo1, 


                        
                          GROUP_CONCAT(DISTINCT(e.nombre) ORDER BY e.id SEPARATOR '|') boton1, 
                          GROUP_CONCAT(DISTINCT(e.id) ORDER BY e.id SEPARATOR '|') id_boton1, 

                          GROUP_CONCAT(DISTINCT(gch.descripcion) ORDER BY gch.id SEPARATOR '|') boton0, 
                          GROUP_CONCAT(DISTINCT(gch.id) ORDER BY gch.id SEPARATOR '|') id_boton0,



                CONCAT('[', GROUP_CONCAT(DISTINCT( CONCAT(
                   '{`id_capital_humano`:',cha.id,
                   
                   ',`id_categoria`:', case when (cha.id_categoria_capital_humano is null) then -1 else cha.id_categoria_capital_humano end,
                   ',`nombre_categoria`:','`', case when (cha.id_categoria_capital_humano is null) then -1 else cch.descripcion end,'`',

                   ',`id_grupo`:', case when (cha.id_grupo_capital_humano is null) then -1 else cha.id_grupo_capital_humano end,
                   ',`nombre_grupo`:','`', case when (cha.id_grupo_capital_humano is null) then -1 else gch.descripcion end,'`',
                   ',`id_rango`:', case when (cha.id_rango_capital_humano is null) then -1 else cha.id_rango_capital_humano end,
                   ',`nombre_rango`:','`',case when (cha.id_rango_capital_humano is null) then -1 else rch.descripcion end,'`}'
               )) ORDER BY cha.id SEPARATOR ',') , ']') sub_seleccion,                          


              
                         m.icono

                FROM kerma_cat_view_modulos m
                     INNER JOIN kerma_cat_view_modulo__encabezado_pregunta r ON r.id_modulo = m.id
                     INNER JOIN kerma_cat_view_encabezado_pregunta e ON r.id_encabezado_pregunta = e.id
                     INNER JOIN kerma_cat_view_preguntas p ON r.id = p.id_modulo__encabezado_pregunta

                      LEFT JOIN kerma_capital_humano_actual_por_preguntas chp ON p.id = chp.id_pregunta
                      LEFT JOIN kerma_capital_humano_actual cha ON cha.id = chp.id_capital_humano_actual
                         LEFT JOIN kerma_grupo_capital_humano gch ON gch.id = cha.id_grupo_capital_humano
                         LEFT JOIN kerma_categoria_capital_humano cch ON cch.id = cha.id_categoria_capital_humano
                              LEFT JOIN kerma_tipo_capital_humano tch ON tch.id = cch.id_tipo_capital_humano
                         LEFT JOIN kerma_rango_capital_humano rch ON rch.id = cha.id_rango_capital_humano

                      INNER JOIN kerma_cat_tipo_pregunta t ON t.id = p.id_tipo_pregunta
                      LEFT JOIN kerma_cat_view_valores_predefinidos_pregunta v ON v.id_pregunta = p.id
                      LEFT JOIN kerma_cat_valores_predefinidos vp ON vp.id = v.id_valores_predefinidos
                      LEFT JOIN kerma_cat_tipo_valores_predefinidos tvp ON tvp.id = vp.id_tipo_valores_predefinidos

                where ".$filtro."  (p.activo =0) AND (e.activo=0) AND m.id  = ".$data['id_modulo']." 
                   
                         and (p.wildcard IS NULL )
                ".$grupos."

                
                ) todo ". 
                $editores."
                
            ) todos   
       ");  
        
        //return $datos;

      $result = $this->db->query($datos);


/*

              $this->db->select('
               CONCAT("[", GROUP_CONCAT(DISTINCT( CONCAT(
                   "{`id_capital_humano`:",cha.id,
                   ",`id_grupo_capital_humano`:", case when (cha.id_grupo_capital_humano is null) then 0 else cha.id_grupo_capital_humano end,
                   ",`id_rango`:",rch.id, 
                   ",`id_tipo_rango`:",rch.id_tipo_rango,
                   ",`nombre`:","`",rch.descripcion,"`}"
               )) ORDER BY cha.id SEPARATOR ",") , "]")

                    sub_seleccion
               ',false);


group by  id_principal
                order by  id_principal, id_hijo

*/
          //where id_principal = ".$data['id_modulo']." 

           if ( $result->num_rows() > 0 ) {
                  return $result->result();
              } else 
                  return false;
            $result->free_result();      

      }  


      public function listado_modulos(){
            $id_session = $this->session->userdata('id');
            $this->db->select( 'm.id, m.nombre' );
            $this->db->from($this->modulos.' m');

              $result = $this->db->get();
              if ($result->num_rows() > 0)
                return $result->result();
              else 
                return FALSE;
              $login->free_result();
      }    


        public function buscando_preguntas($data){

              //Metadatos con los valores que vienen por defecto, hacer un merge con los valores que vienen
              //var_dump(json_encode($data) ); die;
              $datos_meta = array_merge(['pagination' => [], 'sort' => [], 'query' => []], $data);
              

              
              $filtro_identidad = isset($datos_meta['query']['id_entidad']) && is_string($datos_meta['query']['id_entidad'])
                  ? ' AND r.id_entidad='.$datos_meta['query']['id_entidad'] : '';

               if ( isset($datos_meta['query']['id_entidad']) && is_string($datos_meta['query']['id_entidad']) )   {
                     unset($datos_meta['query']['id_entidad']); //destruir filtro (quitar busquedaGeneral)
               }




            if (!( isset($datos_meta['query']['id_modulo']) )) {
                  $datos_meta['query']['id_modulo']=1;
            } 
             

              // pestana =1 si id_modulo=3 o 5
            $pestana = ( ($datos_meta['query']['id_modulo']==3) || ($datos_meta['query']['id_modulo']==5) ) ? 1 : 0;
              
              // Otros filtro  "consulta de campo listbox"
              //asociarle a query las posibles consultas a filtrar
              $query = isset($datos_meta['query']) && is_array($datos_meta['query']) ? $datos_meta['query'] : null;
              
              if (is_array($query) ) { //si existen consultas entonces las convierte en array
                if (! empty($datos_meta['query'])) {
                  
                    foreach ($datos_meta['query'] as $key => $val) {
                             if  ( (int)$val<= 0){
                                unset($datos_meta['query'][$key]);
                             }

                    }


                }
              }  
              




            if ( isset($datos_meta['query']['undefined']) && is_string($datos_meta['query']['undefined']) )   {
                        unset($datos_meta['query']['undefined']);
              }



              //filtro busqueda
              $filtro_busqueda = isset($datos_meta['query']['busquedaGeneral']) && is_string($datos_meta['query']['busquedaGeneral'])
                  ? $datos_meta['query']['busquedaGeneral'] : '';

               if ( isset($datos_meta['query']['busquedaGeneral']) && is_string($datos_meta['query']['busquedaGeneral']) )   {
                     unset($datos_meta['query']['busquedaGeneral']); //destruir filtro (quitar busquedaGeneral)
               }




              // Otros filtro  "consulta de campo listbox"
              //asociarle a query las posibles consultas a filtrar
              $query = isset($datos_meta['query']) && is_array($datos_meta['query']) ? $datos_meta['query'] : null;
              $filtro_campo="";        
              if (is_array($query) ) { //si existen consultas entonces las convierte en array
                if (! empty($datos_meta['query'])) {
                  //return json_encode($query);
                    foreach ($datos_meta['query'] as $key => $val) {
                          

                        $filtro_campo.= (($filtro_campo!='') ? ' and ' : '') . '('.$key.' = '.addslashes($val).') ';
                      


                    }

                    $filtro_campo= (($filtro_campo!='') ? '('.$filtro_campo.') and ' : '') ;


                }
              }  




              //Orden
              $order  = ! empty($datos_meta['sort']['sort']) ? $datos_meta['sort']['sort'] : 'asc';
              $columna =  ! empty($datos_meta['sort']['field']) ? $datos_meta['sort']['field'] : 'id';

              //los metas para paginacion
              $meta    = [];
              $pagina_activa    = ! empty($datos_meta['pagination']['page']) ? (int)$datos_meta['pagination']['page'] : 1;
              $registro_por_pagina = ! empty($datos_meta['pagination']['perpage']) ? (int)$datos_meta['pagination']['perpage'] : -1;
              $total_registros_Xpaginas = 1;
             
              //id, nombre, calle, colonia, cp, id_estado, id_ciudad, telefono, email, socio, fecha, id_tipo_entidad, id_usuario
                $id_session = $this->session->userdata('id');

                $this->db->select("SQL_CALC_FOUND_ROWS(p.id)", FALSE); //



                $this->db->select('p.id, p.campo, p.activo, p.version, p.identificador, p.titulo, p.nombre, p.proxima_pregunta, p.id_numeracion_pregunta, p.etiqueta_numeracion_pregunta, p.placeholder, p.id_modulo__encabezado_pregunta, p.id_tipo_pregunta, p.tooltip, p.wildcard');
                

                $this->db->select('m.id id_modulo');
                $this->db->select('t.nombre tipo_pregunta');
                $this->db->select('e.nombre encabezado_pregunta');


           $this->db->select('m.id id_principal,m.nombre principal, m.url url_principal');   //1- PRINCIPAL (Administrador  5)  
            $this->db->select('cch.id id_hijo1,cch.descripcion hijo1, cch.url url_hijo1');   //2- HIJOS   (Gerente, staff, apoyo    administrador  2,6,7)
            $this->db->select('e.id id_hijo0,e.nombre hijo0, e.url url_hijo0'); 

            


      //3- encabezados (estructura del despacho, sueldo, politica de variaciones, 5,6,7) . Para profesionales y administrativos
            $this->db->select( 'GROUP_CONCAT(DISTINCT(e.id) ORDER BY e.id SEPARATOR "|") id_encabezados',false);   //encabezados_id
            $this->db->select( 'GROUP_CONCAT(DISTINCT(e.nombre) ORDER BY e.id SEPARATOR "|") encabezados',false);  //encabezados 
            
            //4- selector (grupos o valores como el caso de ofCourse). Para profesionales y administrativos
            //4- encabezados (estructura del despacho, sueldo, politica de variaciones, 5,6,7) . Para todos
            $this->db->select( 'GROUP_CONCAT(DISTINCT(gch.id) ORDER BY gch.id SEPARATOR "|") id_grupos',false);
            $this->db->select( 'GROUP_CONCAT(DISTINCT(gch.descripcion) ORDER BY gch.id SEPARATOR "|") grupos',false);



                          $this->db->select( 'GROUP_CONCAT(DISTINCT(e.nombre) ORDER BY e.id SEPARATOR "|") boton1',false); 
                          $this->db->select( 'GROUP_CONCAT(DISTINCT(e.id) ORDER BY e.id SEPARATOR "|") id_boton1',false);

                          $this->db->select( 'GROUP_CONCAT(DISTINCT(gch.descripcion) ORDER BY gch.id SEPARATOR "|") boton0',false);
                          $this->db->select( 'GROUP_CONCAT(DISTINCT(gch.id) ORDER BY gch.id SEPARATOR "|") id_boton0',false);


            //$this->db->select( 'GROUP_CONCAT(DISTINCT(gch.descripcion) ORDER BY cha.id SEPARATOR "|") as grupos',false);
            //$this->db->select( 'GROUP_CONCAT(DISTINCT(cha.id) ORDER BY cha.id SEPARATOR "|") as grupos_id',false);

            
              
              $this->db->select('
               CONCAT("[", GROUP_CONCAT(DISTINCT( CONCAT(
                   "{`id_capital_humano`:",cha.id,
                   ",`id_grupo_capital_humano`:", case when (cha.id_grupo_capital_humano is null) then 0 else cha.id_grupo_capital_humano end,
                   ",`id_rango`:",rch.id, 
                   ",`id_tipo_rango`:",rch.id_tipo_rango,
                   ",`nombre`:","`",rch.descripcion,"`}"
               )) ORDER BY cha.id SEPARATOR ",") , "]")

                    sub_seleccion
               ',false);
              
              /*
              $this->db->select('
                CONCAT("[", GROUP_CONCAT(DISTINCT( CONCAT(
                   "{`id_capital_humano`:",cha.id,
                   
                   ",`id_categoria`:", case when (cha.id_categoria_capital_humano is null) then -1 else cha.id_categoria_capital_humano end,
                   ",`nombre_categoria`:","`", case when (cha.id_categoria_capital_humano is null) then -1 else cch.descripcion end,"`",

                   ",`id_grupo`:", case when (cha.id_grupo_capital_humano is null) then -1 else cha.id_grupo_capital_humano end,
                   ",`nombre_grupo`:","`", case when (cha.id_grupo_capital_humano is null) then -1 else gch.descripcion end,"`",
                   ",`id_rango`:", case when (cha.id_rango_capital_humano is null) then -1 else cha.id_rango_capital_humano end,
                   ",`nombre_rango`:","`",case when (cha.id_rango_capital_humano is null) then -1 else rch.descripcion end,"`}"
               )) ORDER BY cha.id SEPARATOR ",") , "]") sub_seleccion   
               ',false);
                */
                
               
               $this->db->from($this->modulos.' m');
            $this->db->join($this->relacion_modulo__encabezado_pregunta.' r', ' r.id_modulo = m.id');
            $this->db->join($this->encabezado_pregunta.' e', ' r.id_encabezado_pregunta = e.id');
            $this->db->join($this->preguntas.' p', ' r.id = p.id_modulo__encabezado_pregunta');


  

              $this->db->join($this->capital_humano_actual_por_preguntas.' chp', 'p.id = chp.id_pregunta','LEFT');
              $this->db->join($this->capital_humano_actual.' cha', 'cha.id = chp.id_capital_humano_actual','LEFT');
                $this->db->join($this->grupo_capital_humano.' gch', 'gch.id = cha.id_grupo_capital_humano','LEFT');
                $this->db->join($this->categoria_capital_humano.' cch', 'cch.id = cha.id_categoria_capital_humano','LEFT');
                  $this->db->join($this->tipo_capital_humano.' tch', 'tch.id = cch.id_tipo_capital_humano','LEFT');
                $this->db->join($this->rango_capital_humano.' rch', 'rch.id = cha.id_rango_capital_humano','LEFT');

              $this->db->join($this->tipo_pregunta.' t', 't.id = p.id_tipo_pregunta');
              $this->db->join($this->relacion_valores_pregunta.' v', 'v.id_pregunta = p.id','LEFT');
              $this->db->join($this->valores_predefinidos.' vp', 'vp.id = v.id_valores_predefinidos','LEFT');
              $this->db->join($this->tipo_valores_predefinidos.' tvp', 'tvp.id = vp.id_tipo_valores_predefinidos','LEFT');

                


               $where = '('.
                            $filtro_campo.'
                            

                            ( (p.activo =0) )  AND (e.activo=0) AND 
                             (p.wildcard IS NULL) AND
                            (

                              ( p.nombre LIKE  "%'.$filtro_busqueda.'%" ) OR
                              ( p.identificador LIKE  "%'.$filtro_busqueda.'%" ) 

                             )
                  )';   


              $this->db->where($where);




               
                //ordenacion
                $this->db->order_by($columna, $order); 
                if ($pestana==0) {
                  $this->db->group_by('p.id,p.id_numeracion_pregunta');   
                } else { //pestana=1 profesionales y administrador 
                  //$this->db->group_by('cch.id,p.id_numeracion_pregunta');  
                  $this->db->group_by('p.id,p.id_numeracion_pregunta');   
                }
                //
                
                //$this->db->group_by('p.id_numeracion_pregunta');


           
             // $registro_por_pagina 0; get all data
              if ($registro_por_pagina > 0) {
                  $offset = ($pagina_activa - 1) * $registro_por_pagina;
                  $this->db->limit($registro_por_pagina,  $offset );    //$largo,$inicio
               }

               
                $result = $this->db->get();


                $total_registros = $result->num_rows(); // Total de registros en la tabla

                $dato=array();
                if ( $result->num_rows() > 0 ) {

                    $cantidad_consulta = $this->db->query("SELECT FOUND_ROWS() as cantidad");
                    $found_rows = $cantidad_consulta->row(); 
                    $registros_filtrados =  ( (int) $found_rows->cantidad);

                    $total_registros =   $registros_filtrados; // Total de registros en la tabla. Esto porque tiene en cuenta el LIMIT

                      foreach ($result->result() as $row) {
                           $dato[]= array(
                                  "id"=>$row->id,
                                  "campo"=> $row->campo,
                                  "identificador"=>$row->identificador,
                                  "nombre"=>$row->nombre,
                                  "id_numeracion_pregunta"=>$row->id_numeracion_pregunta,
                                  "placeholder"=>$row->placeholder,
                                  "id_modulo__encabezado_pregunta"=>$row->id_modulo__encabezado_pregunta,
                                  "id_tipo_pregunta"=>$row->id_tipo_pregunta,
                                  "id_modulo"=>$row->id_modulo,
                                  "tipo_pregunta"=>$row->tipo_pregunta,
                                  "encabezado_pregunta"=>$row->encabezado_pregunta,

                                  "id_principal"=>$row->id_principal,  //1- PRINCIPAL (Administrador  5)  
                                  "principal"=>$row->principal, 
                                  "url_principal"=>$row->url_principal, 
                                  
                                  //"id_hijo"=>($row->id_hijo1==null) ? $row->id_encabezados : $row->id_hijo1,   //2- HIJOS   (Gerente, staff, apoyo    administrador  2,6,7)
                                  "id_hijo"=> ($pestana==0) ?  (($row->id_hijo0==null) ? '' : $row->id_hijo0) : (($row->id_hijo1==null) ? '' : $row->id_hijo1),
                                  "hijo"=> ($pestana==0) ?  (($row->hijo0==null) ? '' : $row->hijo0) : (($row->hijo1==null) ? '' : $row->hijo1),

                                  //"encabezados"=> ($pestana==0) ?  (($row->hijo0==null) ? '' : $row->hijo0) : (($row->hijo1==null) ? '' : $row->encabezados),
                                  //"encabezados"=>($row->id_hijo1==null) ? '': $row->encabezados,
                                  "encabezados"=>($pestana==0) ? $row->boton0: $row->boton1,
                                  "id_encabezados"=>($row->id_hijo1==null) ? '': $row->id_encabezados,

                                  "sub_seleccion"=>$row->sub_seleccion,
                                  "grupos"=>$row->grupos,
                                  "id_grupos"=>$row->id_grupos,
                                //  "pestanas"=>($row->id_hijo==null) ? 0: 1, //cuando debe usarse cch.id=0 o r.id=0

                           );
                     }
                 }         



              // $registro_por_pagina 0; get all data
              if ($registro_por_pagina > 0) {
                  $total_registros_Xpaginas  = ceil($total_registros / $registro_por_pagina); // "calcular total paginas". redondear hacia arriba ceil(4.3);  // 5
                  $pagina_activa   = max($pagina_activa, 1); // coger page=1  cuando $_REQUEST['page'] <= 0
                  $pagina_activa   = min($pagina_activa, $total_registros_Xpaginas); // coger la ultima pagina cuando $_REQUEST['page'] > $total_registrosPages
                  $offset = ($pagina_activa - 1) * $registro_por_pagina; //desde que registro vamos a buscar offset
                  if ($offset < 0) {
                      $offset = 0;
                  }
               }


          //aqui conformamos la meta
          $meta = [
              'page'    => $pagina_activa,    //Pagina activa 1,....n
              'pages'   => $total_registros_Xpaginas,  //total de páginas
              'perpage' => $registro_por_pagina, //total de registro a presentar por paginas. -1 todos los registros
              'total'   => $total_registros,   //total completo de registro en la tabla
          ];


          //para todos los id, cuando seleccione
          /*
          $this->db->select("u.id");
             $this->db->from($this->op_configuracion_entidades.' as u');
                  $this->db->join($this->cat_tipo_entidad.' as t', 'u.id_tipo_entidad = t.id');
                  $this->db->join($this->cat_estados.' e', 'u.id_estado = e.id');
                  $this->db->join($this->cat_ciudades.' c', 'u.id_ciudad = c.id');




          $this->db->where($where);
          $resulta = $this->db->get();
          if ( $resulta->num_rows() > 0 ) {
                // si seleccionamos(habilitamos) todos los registros, retornaremos todos los ids en "rowIDs"
                if (isset($datos_meta['requestIds']) && filter_var($datos_meta['requestIds'], FILTER_VALIDATE_BOOLEAN)) {
                    $meta['rowIds'] = array_map(function ($row) {
                        return $row->id;
                    }, $resulta->result());
                }  
          }  
          */


          header('Content-Type: application/json');
          header('Access-Control-Allow-Origin: *');
          header('Access-Control-Allow-Methods: GET, PUT, POST, DELETE, OPTIONS');
          header('Access-Control-Allow-Headers: Content-Type, Content-Range, Content-Disposition, Content-Description');

          $resultado = [
              'meta' => $meta + [  //meta =  page, pages,  perpage, total
                      'sort'  => $order,  //asc o desc
                      'field' => $columna,  //campo a ordenar
                  ],
              'data' => $dato,
          ];
          return ($resultado);
    }







//////////////////////catalogos///////////////////
      public function modulos(){
            
            $this->db->select( 'e.id, e.nombre' );
            $this->db->from($this->modulos.' e');

              $result = $this->db->get();
              if ($result->num_rows() > 0)
                return $result->result();
              else 
                return FALSE;
              $login->free_result();
      }    


      public function sub_modulos(){
            
            $this->db->select( 'e.id, e.nombre' );
            $this->db->from($this->encabezado_pregunta.' e');

              $result = $this->db->get();
              if ($result->num_rows() > 0)
                return $result->result();
              else 
                return FALSE;
              $login->free_result();
      }    



      public function tipo_preguntas(){
            
            $this->db->select( 'e.id, e.nombre' );
            $this->db->from($this->tipo_pregunta.' e');

              $result = $this->db->get();
              if ($result->num_rows() > 0)
                return $result->result();
              else 
                return FALSE;
              $login->free_result();
      }    

  //$this->db->where('nombre', '"'.$data['nombre'].'"' ,FALSE);

  public function existe_relacion( $data ){    

        $this->db->select("id");      
        $this->db->from($this->relacion_modulo__encabezado_pregunta);
        $this->db->where('id_modulo', $data['id_modulo']);
        $this->db->where('id_encabezado_pregunta', $data['id_sub_modulo']);

        $result = $this->db->get();
        if ($result->num_rows() > 0)
          return $result->row()->id;
        else
          return false;
        $result->free_result();

      //SELECT * FROM kerma_cat_view_modulo__encabezado_pregunta WHERE id_modulo=miid_modulo and   id_encabezado_pregunta=miid_encabezado
  }


  public function crear_relacion( $data ){    

            $this->db->set( 'id_modulo', $data['id_modulo'] );
            $this->db->set( 'id_encabezado_pregunta', $data['id_sub_modulo'] );
            
            $this->db->insert($this->relacion_modulo__encabezado_pregunta );

             if ($this->db->affected_rows() > 0){
                return  $this->db->insert_id();
                
                } else {
                    return FALSE;
                }
                $result->free_result();

  }





  
 public function agregar_pregunta_pestana1( $data ){

            $id_relacion = self::existe_relacion($data);
            if ( $id_relacion==false ) {
                $id_relacion = self::crear_relacion($data);

            }
            

            $this->db->set( 'nombre', $data['nombre'] );
            $this->db->set( 'campo', $data['campo'] );
            $this->db->set( 'placeholder', $data['placeholder'] );
            $this->db->set( 'tooltip', $data['tooltip'] );
            
            $this->db->set( 'id_tipo_pregunta', $data['id_tipo_pregunta'] );
            $this->db->set( 'id_modulo__encabezado_pregunta', $id_relacion );

            
            $this->db->insert($this->preguntas);


                         

              if ($this->db->affected_rows() > 0){
                  
                  $data['id_pregunta'] =   $this->db->insert_id();

                  self::anadir__grupo_rango($data); //agregar a la relacion datos
                  return TRUE;
                } else {
                    return FALSE;
                }
                $result->free_result();


 } 


//ALTER TABLE  `kerma_cat_view_preguntas` CHANGE  `id`  `id` INT( 11 ) NOT NULL AUTO_INCREMENT ;

//CREATE UNIQUE INDEX unico_capital_humano_actual ON kerma_capital_humano_actual (id_categoria_capital_humano, id_grupo_capital_humano, id_rango_capital_humano);



    public function anadir__grupo_rango( $data ){

          foreach ($data['id_btnes'] as $key => $valor) {

              $data['id_grupo'] =  (int)$valor;
                 $rango = self::rango_de_ungrupo( $data);
                 foreach ($rango as $key1 => $valor1) {
                      //
                    $id_rango= ($valor1->id_rango) ? $valor1->id_rango : 'NULL';

                    $sql = "INSERT INTO ".$this->capital_humano_actual." (id_categoria_capital_humano, id_grupo_capital_humano, id_rango_capital_humano) VALUES (".$data['multiples_categoria'].", ".$valor1->id_grupo.", ".$id_rango.") on duplicate key update id_categoria_capital_humano=".$data['multiples_categoria']." , id_grupo_capital_humano=".$valor1->id_grupo." , id_rango_capital_humano=".$id_rango;                  
                     $this->db->query($sql);

                     //

                     $igualdad = ($id_rango!='NULL') ? ' = ' : ' is ';
                   $datos = ("
                    SELECT  
                          id
                    FROM  ".$this->capital_humano_actual."
                    where  
                     id_categoria_capital_humano=".$data['multiples_categoria']." and id_grupo_capital_humano=".$valor1->id_grupo." and id_rango_capital_humano".$igualdad.$id_rango); 
                      
                   $result = $this->db->query($datos);
                    //print_r( $datos );die;
                   //print_r( $result->row() );die;

                    //

                   $id_capital_humano_actual = $result->row()->id;

                    $sql1 = "INSERT INTO ".$this->capital_humano_actual_por_preguntas." (id_capital_humano_actual, id_pregunta) VALUES (".$id_capital_humano_actual.", ".$data['id_pregunta'].") on duplicate key update id_capital_humano_actual=".$id_capital_humano_actual." , id_pregunta=".$data['id_pregunta'];
                    $this->db->query($sql1);





                 } 
          } 



          if ($this->db->affected_rows() > 0){
            return TRUE;
            } else {
                return FALSE;
            }
            $result->free_result();

      } 



  /*
            GROUP_CONCAT(DISTINCT(rch.descripcion) ORDER BY rch.id SEPARATOR '|') as rangos,
            GROUP_CONCAT(DISTINCT(rch.id) ORDER BY rch.id SEPARATOR '|') as id_rangos


*/
public function rango_de_ungrupo($data){
  /*
gch.id id_grupo, gch.descripcion grupo_nombre, 
            gch.id_rango_temp,
            , rch.descripcion rango_nombre
  */
     $datos = ("
      SELECT  
            gch.id id_grupo,
            rch.id id_rango

       FROM  kerma_grupo_capital_humano gch 
           LEFT JOIN kerma_rango_capital_humano rch ON rch.id_tipo_rango = gch.id_rango_temp
           where  gch.id=".$data['id_grupo']."
      "); 
      
        $result = $this->db->query($datos);

          
          if ( $result->num_rows() > 0 ) {
                    return $result->result();
                } else 
                    return false;
              $result->free_result();     
}
    
  
  public function agregar_pregunta( $data ){
            //$timestamp = time();

              
            //$uuid = $this->db->query('SELECT UUID() AS uuid')->row()->uuid;


            //$id_session = $this->session->userdata('id');
            //$this->db->set( 'fecha_pc',  gmt_to_local( $timestamp, $this->timezone, TRUE) );
            //$this->db->set( 'id_usuario',  $id_session );
            //$this->db->set( 'id', "'".$uuid."'", FALSE);

            $id_relacion = self::existe_relacion($data);
            if ( $id_relacion==false ) {
                $id_relacion = self::crear_relacion($data);

            }


            

            $this->db->set( 'nombre', $data['nombre'] );
            $this->db->set( 'campo', $data['campo'] );
            $this->db->set( 'placeholder', $data['placeholder'] );
            $this->db->set( 'tooltip', $data['tooltip'] );
            
            $this->db->set( 'id_tipo_pregunta', $data['id_tipo_pregunta'] );
            $this->db->set( 'id_modulo__encabezado_pregunta', $id_relacion );

            
            $this->db->insert($this->preguntas);


              //INSERT INTO kerma_capital_humano_actual_por_preguntas (id_capital_humano_actual, id_pregunta) VALUES
              //(111, 478),


            

              if ($this->db->affected_rows() > 0){
                  
                  $data['id_pregunta'] =   $this->db->insert_id();
                  //$data['id_btnes']               = json_decode($this->input->post( 'id_btnes' ), true);
                  




                self::anadir__btones_aUna_pregunta($data); //agregar a la relacion datos
                return TRUE;
                } else {
                    return FALSE;
                }
                $result->free_result();
  }


      public function anadir__btones_aUna_pregunta( $data ){

            foreach ($data['id_btnes'] as $key => $valor) {

                $sql = "INSERT INTO ".$this->capital_humano_actual_por_preguntas." (id_capital_humano_actual, id_pregunta) VALUES (".$valor.", ".$data['id_pregunta'].") on duplicate key update id_capital_humano_actual=".$valor." , id_pregunta=".$data['id_pregunta'];

                  
                  $this->db->query($sql);
            }

            if ($this->db->affected_rows() > 0){
                return TRUE;
                } else {
                    return FALSE;
                }
                $result->free_result();


      } 





  } 
?>