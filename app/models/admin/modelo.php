<?php if(! defined('BASEPATH')) exit('No tienes permiso para acceder a este archivo');

  class modelo extends CI_Model{
    
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
          
          
          
 


    }


        public function buscando_entidades($data){

              //Metadatos con los valores que vienen por defecto, hacer un merge con los valores que vienen
              $datos_meta = array_merge(['pagination' => [], 'sort' => [], 'query' => []], $data);
              
              
              $filtro_identidad = isset($datos_meta['query']['id_entidad']) && is_string($datos_meta['query']['id_entidad'])
                  ? ' AND r.id_entidad='.$datos_meta['query']['id_entidad'] : '';

               if ( isset($datos_meta['query']['id_entidad']) && is_string($datos_meta['query']['id_entidad']) )   {
                     unset($datos_meta['query']['id_entidad']); //destruir filtro (quitar busquedaGeneral)
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

              //echo json_encode($filtro_campo);



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

                $this->db->select("SQL_CALC_FOUND_ROWS(u.id)", FALSE); //



                $this->db->select('u.id, u.nombre, u.calle, u.colonia, u.cp, u.id_estado, u.id_ciudad, u.telefono, u.email, u.socio, u.id_tipo_entidad, u.id_usuario');
                //$this->db->select("( CASE WHEN u.fecha_pc = 0 THEN '' ELSE DATE_FORMAT(FROM_UNIXTIME(u.fecha_pc),'%d-%m-%Y') END ) AS fecha", FALSE);  

                
                $this->db->select("DATE_FORMAT(u.fecha, '%d/%m/%Y') fecha", FALSE);  
                $this->db->select("e.nombre as estado", FALSE);  
                $this->db->select("c.nombre as ciudad", FALSE);  
                $this->db->select("t.nombre as tipo_entidad", FALSE);  
                
                 

                $this->db->from($this->op_configuracion_entidades.' as u');
                  $this->db->join($this->cat_tipo_entidad.' as t', 'u.id_tipo_entidad = t.id');
                  $this->db->join($this->cat_estados.' e', 'u.id_estado = e.id');
                  $this->db->join($this->cat_ciudades.' c', 'u.id_ciudad = c.id');





                  //(p.id >'. (int)($this->session->userdata('id_perfil') ) .') AND

                $where = '('.
                            $filtro_campo.'
                            (u.id <> "'.$id_session.'") AND 
                            (
                              ( u.nombre LIKE  "%'.$filtro_busqueda.'%" ) OR
                              ( e.nombre LIKE  "%'.$filtro_busqueda.'%" ) OR
                              ( u.cp LIKE  "%'.$filtro_busqueda.'%" ) OR
                              ( t.nombre LIKE  "%'.$filtro_busqueda.'%" ) OR

                              ( DATE_FORMAT(u.fecha, "%d/%m/%Y") LIKE  "%'.$filtro_busqueda.'%" ) OR
                              ( u.email LIKE  "%'.$filtro_busqueda.'%" ) OR

                               (  AES_DECRYPT( u.email,"{$this->key_hash}")  LIKE  "%'.$filtro_busqueda.'%") 
                              
                             )
                  )';   






                $this->db->where($where);
                //ordenacion
                $this->db->order_by($columna, $order); 
                $this->db->group_by('u.id'); 

           
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
                                          "nombre"=> $row->nombre,
                                          "calle"=>$row->calle,
                                          "colonia"=>$row->colonia,
                                          "cp"=>$row->cp,
                                          "estado"=>$row->estado,
                                          "ciudad"=>$row->ciudad,
                                          "telefono"=>$row->telefono,
                                          "email"=>$row->email,
                                          "socio"=>$row->socio,
                                          "tipo_entidad"=>$row->tipo_entidad,
                                          "fecha"=>$row->fecha,
                                          "id_tipo_entidad"=>$row->id_tipo_entidad,
                                          "id_estado"=>$row->id_estado,
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
          return json_encode($resultado);
    }




      public function check_entidades_existente($data){
        
        $this->db->select("nombre");      
        $this->db->from($this->op_configuracion_entidades);
        $this->db->where('nombre', '"'.$data['nombre'].'"' ,FALSE);
        $login = $this->db->get();
        if ($login->num_rows() > 0)
          return FALSE;
        else
          return TRUE;
        $login->free_result();
      }        
    


      public function agregar_entidad( $data ){
            //$timestamp = time();

              
            //$uuid = $this->db->query('SELECT UUID() AS uuid')->row()->uuid;


            $id_session = $this->session->userdata('id');
            //$this->db->set( 'fecha_pc',  gmt_to_local( $timestamp, $this->timezone, TRUE) );
            $this->db->set( 'id_usuario',  $id_session );
            //$this->db->set( 'id', "'".$uuid."'", FALSE);
            $this->db->set( 'nombre', $data['nombre'] );
            $this->db->set( 'calle', $data['calle'] );
            $this->db->set( 'colonia', $data['colonia'] );
            $this->db->set( 'cp', $data['cp'] );
            $this->db->set( 'id_estado', $data['id_estado'] );
            $this->db->set( 'id_ciudad', $data['id_ciudad'] );
            $this->db->set( 'telefono', $data['telefono'] );
            $this->db->set( 'email', $data['email'] );
            $this->db->set( 'socio', $data['socio'] );
            $this->db->set( 'id_tipo_entidad', $data['id_tipo_entidad'] );
            
            $this->db->insert($this->op_configuracion_entidades );

            
            

              if ($this->db->affected_rows() > 0){
                $data['id_entidad'] =   $this->db->insert_id();
                self::anadir__usuario__entidad($data); //agregar a la relacion datos
                return TRUE;
                } else {
                    return FALSE;
                }
                $result->free_result();
        }



      public function editar_entidad( $data ){
            //$timestamp = time();
            //$uuid = $this->db->query('SELECT UUID() AS uuid')->row()->uuid;
            $id_session = $this->session->userdata('id');
            //$this->db->set( 'fecha_pc',  gmt_to_local( $timestamp, $this->timezone, TRUE) );
            $this->db->set( 'id_usuario',  $id_session );
            //$this->db->set( 'id', "'".$uuid."'", FALSE);
            $this->db->set( 'nombre', $data['nombre'] );
            $this->db->set( 'calle', $data['calle'] );
            $this->db->set( 'colonia', $data['colonia'] );
            $this->db->set( 'cp', $data['cp'] );
            $this->db->set( 'id_estado', $data['id_estado'] );
            $this->db->set( 'id_ciudad', $data['id_ciudad'] );
            $this->db->set( 'telefono', $data['telefono'] );
            $this->db->set( 'email', $data['email'] );
            $this->db->set( 'socio', $data['socio'] );
            $this->db->set( 'id_tipo_entidad', $data['id_tipo_entidad'] );
            
            //$this->db->insert($this->op_configuracion_entidades );

            $this->db->where('id', $data['id_p'] );
            $this->db->update($this->op_configuracion_entidades );


            
            

              if ($this->db->affected_rows() > 0){
                $data['id_entidad'] =   $data['id_p']; //$this->db->insert_id();
                self::anadir__usuario__entidad($data); //agregar a la relacion datos
                return TRUE;
                } else {
                    return FALSE;
                }
                $result->free_result();
        }




        public function anadir__usuario__entidad( $data ){



            foreach ($data['id_usuarios'] as $key => $valor) {

                $sql = "INSERT INTO ".$this->entidades__usuarios." (id_usuario, id_entidad) VALUES ('".$valor."', ".$data['id_entidad'].") on duplicate key update id_usuario='".$valor."' , id_entidad=".$data['id_entidad'];

                  //$sql = "INSERT INTO ".$this->entidades__usuarios." (id_usuario, id_entidad) VALUES ('".$data['id_usuario']."', ".$valor.") on duplicate key update id_usuario='".$data['id_usuario']."' , id_entidad=".$valor;
                  $this->db->query($sql);
            }

            if ($this->db->affected_rows() > 0){
                return TRUE;
                } else {
                    return FALSE;
                }
                $result->free_result();
        }



      public function listado_deusuarios(   ){
            $id_session = $this->session->userdata('id');
            $this->db->select( 'u.id, u.nombre' );
            $this->db->select('( CASE WHEN (u.id_perfil >'. (int)($this->session->userdata('id_perfil') ) .') THEN 0 ELSE 1 END ) AS habilita', FALSE); 
            //$this->db->select( '(u.id_perfil >'. (int)($this->session->userdata('id_perfil') ) .') ' );
                $this->db->from($this->usuarios.' u', 'u.id = r.id_usuario');

                $where = '(
                           (u.id_perfil >'. (int)($this->session->userdata('id_perfil') ) .')
                  )';   
                //$this->db->where($where);



              $result = $this->db->get();
              if ($result->num_rows() > 0)
                return $result->result();
              else 
                return FALSE;
              $login->free_result();
      }    
    


     public function obtener_usuario_deEmpresa( $uid ){
            
            $id_session = $this->session->userdata('id');
            
            $this->db->select( 'u.id' ); //, e.nombre
            $this->db->from($this->entidades.' e');

            

                $this->db->join($this->entidades__usuarios.' r', 'e.id = r.id_entidad');
                $this->db->join($this->usuarios.' u', 'u.id = r.id_usuario');
                $where = '(
                             (e.id = "'.$uid.'") 
                  )';   
                $this->db->where($where);
           


            $result = $this->db->get( );
            if ($result->num_rows() > 0) {
              

              $arr = array(); 
              foreach ( $result->result_array() as $key => $row) {


                      $arr[] = $row['id'];
              }              

              return ($arr);
              return json_encode($arr);
            } else 
              return FALSE;
            $result->free_result();
        }  


      public function buscador_tipo_entidades(){
            $id_session = $this->session->userdata('id');
            $this->db->select( 'e.id, e.nombre' );
            $this->db->from($this->cat_tipo_entidad.' e');

            if ($this->session->userdata('id_perfil')!=1 ) {

                $this->db->join($this->entidades__usuarios.' r', 'e.id = r.id_entidad');
                $this->db->join($this->usuarios.' u', 'u.id = r.id_usuario');
                $where = '(
                            (u.id = "'.$id_session.'") 
                  )';   
                $this->db->where($where);
            }


              $result = $this->db->get();
              if ($result->num_rows() > 0)
                return $result->result();
              else 
                return FALSE;
              $login->free_result();
      }    


      public function buscador_estados(){
            $id_session = $this->session->userdata('id');
            $this->db->select( 'e.id, e.nombre' );
            $this->db->from($this->cat_estados.' e');

              $result = $this->db->get();
              if ($result->num_rows() > 0)
                return $result->result();
              else 
                return FALSE;
              $login->free_result();
      }    

      public function buscador_ciudades(){
            $id_session = $this->session->userdata('id');
            $this->db->select( 'e.id, e.nombre' );
            $this->db->from($this->cat_ciudades.' e');

              $result = $this->db->get();
              if ($result->num_rows() > 0)
                return $result->result();
              else 
                return FALSE;
              $login->free_result();
      }    
      



      public function buscador_entidades(){
            $id_session = $this->session->userdata('id');
            $this->db->select( 'e.id, e.nombre' );
            $this->db->from($this->entidades.' e');

            if ($this->session->userdata('id_perfil')!=1 ) {

                $this->db->join($this->entidades__usuarios.' r', 'e.id = r.id_entidad');
                $this->db->join($this->usuarios.' u', 'u.id = r.id_usuario');
                $where = '(
                            (u.id = "'.$id_session.'") 
                  )';   
                $this->db->where($where);
            }


              $result = $this->db->get();
              if ($result->num_rows() > 0)
                return $result->result();
              else 
                return FALSE;
              $login->free_result();
      }    









        //eliminar usuarios
        public function eliminar_entidad( $uid ){
            $this->db->delete( $this->entidades, array( 'id' => $uid ) );
            if ( $this->db->affected_rows() > 0 ) return TRUE;
            else return FALSE;
        }




     ////////////////////////////chequeos////////////////////////////////////
    
    public function check_login($data){
        $this->db->select("AES_DECRYPT(email,'{$this->key_hash}') AS email", FALSE);      
        $this->db->select("AES_DECRYPT(contrasena,'{$this->key_hash}') AS contrasena", FALSE);      
        $this->db->select('u.nombre,u.apellidos, u.especial');      
        $this->db->select('u.id,p.id id_perfil,p.nombre perfil, p.permiso');
                  
        $this->db->from($this->usuarios.' u');
        $this->db->join($this->perfiles.' p', 'u.id_perfil = p.id');
        $this->db->where('contrasena', "AES_ENCRYPT('{$data['contrasena']}','{$this->key_hash}')", FALSE);
        $this->db->where('email',"AES_ENCRYPT('{$data['email']}','{$this->key_hash}')",FALSE);

        $login = $this->db->get();

        if ($login->num_rows() > 0)
          return $login->result();
        else 
          return FALSE;
        $login->free_result();
    }

    public function check_usuario_existente($data){
        
        $this->db->select("AES_DECRYPT(email,'{$this->key_hash}') AS email", FALSE);      
        $this->db->from($this->usuarios);
        $this->db->where('email',"AES_ENCRYPT('{$data['email']}','{$this->key_hash}')",FALSE);
        $this->db->where('id !=',$data['id']);
        $login = $this->db->get();
        if ($login->num_rows() > 0)
          return FALSE;
        else
          return TRUE;
        $login->free_result();
      }     



   public function check_correo_existente($data){
        $this->db->select("AES_DECRYPT(email,'{$this->key_hash}') AS email", FALSE);      
        $this->db->from($this->usuarios);
        $this->db->where('email',"AES_ENCRYPT('{$data['email']}','{$this->key_hash}')",FALSE);
        $login = $this->db->get();
        if ($login->num_rows() > 0)
          return FALSE;
        else
          return TRUE;
        $login->free_result();
   }

   //////////////////////////////catalogos//////////////////////////////
           public function obtener_perfiles(){
            $this->db->select( 'id id_perfil, nombre perfil' );
            $this->db->from($this->perfiles );
              //(id >='. (int)($this->session->userdata('id_perfil') ) .'
                $where = '(
                           (id >'. (int)($this->session->userdata('id_perfil') ) .')
                  )';   
                $this->db->where($where);

            $perfiles = $this->db->get();

            if ($perfiles->num_rows() > 0 )
               return $perfiles->result();
            else
               return FALSE;
            $perfiles->free_result();
        }       


        public function obtener_perfiles_activo(){
            $this->db->select( 'id id_perfil, nombre perfil' );
            $this->db->from($this->perfiles );
              //(id >='. (int)($this->session->userdata('id_perfil') ) .'
                $where = '(
                           (id >='. (int)($this->session->userdata('id_perfil') ) .')
                  )';   
                $this->db->where($where);

            $perfiles = $this->db->get();

            if ($perfiles->num_rows() > 0 )
               return $perfiles->result();
            else
               return FALSE;
            $perfiles->free_result();
        }       





        public function obtener_usuario( $uid ){
            $this->db->select('id, nombre, apellidos, id_perfil');
            $this->db->select( "AES_DECRYPT( email,'{$this->key_hash}') AS email", FALSE );
            $this->db->select( "AES_DECRYPT( telefono,'{$this->key_hash}') AS telefono", FALSE );
            $this->db->select( "AES_DECRYPT( contrasena,'{$this->key_hash}') AS contrasena", FALSE );
            //$this->db->select("( CASE WHEN fecha_nac = 0 THEN '' ELSE DATE_FORMAT(FROM_UNIXTIME(fecha_nac),'%Y-%m-%d') END ) AS fecha_nac", FALSE); 
            $this->db->where('id', $uid);
            $result = $this->db->get($this->usuarios );
            if ($result->num_rows() > 0)
              return $result->row();
            else 
              return FALSE;
            $result->free_result();
        }  


        public function busca_entidad( $uid ){

                $this->db->select('u.id, u.nombre, u.calle, u.colonia, u.cp, u.id_estado, u.id_ciudad, u.telefono, u.email, u.socio, u.id_tipo_entidad, u.id_usuario');
                $this->db->select("DATE_FORMAT(u.fecha, '%d/%m/%Y') fecha", FALSE);  
                $this->db->select("e.nombre as estado", FALSE);  
                $this->db->select("c.nombre as ciudad", FALSE);  
                $this->db->select("t.nombre as tipo_entidad", FALSE);  
                
                 

                $this->db->from($this->op_configuracion_entidades.' as u');
                  $this->db->join($this->cat_tipo_entidad.' as t', 'u.id_tipo_entidad = t.id');
                  $this->db->join($this->cat_estados.' e', 'u.id_estado = e.id');
                  $this->db->join($this->cat_ciudades.' c', 'u.id_ciudad = c.id');


                  $this->db->where('u.id', $uid);
                  $result = $this->db->get( );

            if ($result->num_rows() > 0)
              return $result->row();
            else 
              return FALSE;
            $result->free_result();
        }  


        public function obtener_empresas_deusuario( $uid ){
            
            $id_session = $this->session->userdata('id');
            
            $this->db->select( 'e.id' ); //, e.nombre
            $this->db->from($this->entidades.' e');

            //if ($this->session->userdata('id_perfil')!=1 ) {

                $this->db->join($this->entidades__usuarios.' r', 'e.id = r.id_entidad');
                $this->db->join($this->usuarios.' u', 'u.id = r.id_usuario');
                $where = '(
                            (u.id = "'.$uid.'") 
                  )';   
                $this->db->where($where);
           // }


            $result = $this->db->get( );
            if ($result->num_rows() > 0) {
              //return ($result->result_array());

              $arr = array(); 
              foreach ( $result->result_array() as $key => $row) {


                      $arr[] = $row['id'];
              }              

              return ($arr);
              return json_encode($arr);
            } else 
              return FALSE;
            $result->free_result();
        }  



 //Recuperar contraseña    
      public function recuperar_contrasena($data){
        $this->db->select("AES_DECRYPT(u.email,'{$this->key_hash}') AS email", FALSE);            
        $this->db->select('u.nombre,u.apellidos');
        $this->db->select("AES_DECRYPT(u.telefono,'{$this->key_hash}') AS telefono", FALSE);      
        $this->db->select("AES_DECRYPT(u.contrasena,'{$this->key_hash}') AS contrasena", FALSE);
        $this->db->from($this->usuarios.' as u');
        $this->db->where('u.email',"AES_ENCRYPT('{$data['email']}','{$this->key_hash}')",FALSE);
        $login = $this->db->get();
        if ($login->num_rows() > 0)
          return $login->result();
        else 
          return FALSE;
        $login->free_result();    
      } 
//////////////////////////////actualizaciones//////////////////////////////


    
    public function anadir_usuario( $data ){
            $timestamp = time();

              
            $uuid = $this->db->query('SELECT UUID() AS uuid')->row()->uuid;


            $id_session = $this->session->userdata('id');
            $this->db->set( 'fecha_pc',  gmt_to_local( $timestamp, $this->timezone, TRUE) );
            $this->db->set( 'id_usuario',  $id_session );

            //$this->db->set( 'id', "UUID()", FALSE);
            $this->db->set( 'id', "'".$uuid."'", FALSE);
            
            $this->db->set( 'nombre', $data['nombre'] );
            $this->db->set( 'apellidos', $data['apellidos'] );
            $this->db->set( 'email', "AES_ENCRYPT('{$data['email']}','{$this->key_hash}')", FALSE );
            $this->db->set( 'telefono', "AES_ENCRYPT('{$data['telefono']}','{$this->key_hash}')", FALSE );
            $this->db->set( 'id_perfil', $data['id_perfil']);

            //$this->db->set( 'fecha_nac', strtotime(date( "d-m-Y", strtotime($data['fecha_nac']) )) ,false);
            $this->db->set( 'contrasena', "AES_ENCRYPT('{$data['contrasena']}','{$this->key_hash}')", FALSE );
            $this->db->set( 'creacion',  gmt_to_local( $timestamp, $this->timezone, TRUE) );
            $this->db->insert($this->usuarios );

            
            

            if ($this->db->affected_rows() > 0){
                //ultimo insertado
                $data['id_usuario'] = $uuid;
                self::anadir_entidad__usuario($data); //agregar a la relacion datos
                return TRUE;
                } else {
                    return FALSE;
                }
                $result->free_result();
        }



        public function anadir_entidad__usuario( $data ){



            foreach ($data['id_entidad'] as $key => $valor) {

                  $sql = "INSERT INTO ".$this->entidades__usuarios." (id_usuario, id_entidad) VALUES ('".$data['id_usuario']."', ".$valor.") on duplicate key update id_usuario='".$data['id_usuario']."' , id_entidad=".$valor;
                  $this->db->query($sql);
            }

            if ($this->db->affected_rows() > 0){
                return TRUE;
                } else {
                    return FALSE;
                }
                $result->free_result();
        }


        public function eliminar_entidad__usuario( $data ){
            $this->db->delete( $this->entidades__usuarios, array( 'id_usuario' => $data['id_usuario'] ) );
            if ( $this->db->affected_rows() > 0 ) return TRUE;
            else return FALSE;
        }


  

        public function edicion_usuario( $data ){

            $timestamp = time();

            $id_session = $this->session->userdata('id');
            $this->db->set( 'fecha_pc',  gmt_to_local( $timestamp, $this->timezone, TRUE) );
            $this->db->set( 'id_usuario',  $id_session );

            $this->db->set( 'nombre', $data['nombre'] );
            $this->db->set( 'apellidos', $data['apellidos'] );
            $this->db->set( 'email', "AES_ENCRYPT('{$data['email']}','{$this->key_hash}')", FALSE );
            $this->db->set( 'telefono', "AES_ENCRYPT('{$data['telefono']}','{$this->key_hash}')", FALSE );
            $this->db->set( 'id_perfil', $data['id_perfil']);
            $this->db->set( 'contrasena', "AES_ENCRYPT('{$data['contrasena']}','{$this->key_hash}')", FALSE );


            $this->db->where('id', $data['id'] );
            $this->db->update($this->usuarios );
            if (isset($data['id_entidad'])   || ($this->db->affected_rows() > 0) ) {

                
                //ultimo insertado
                $data['id_usuario'] = $data['id'];
                self::eliminar_entidad__usuario($data); 
                if  (isset($data['id_entidad']) ) {
                  self::anadir_entidad__usuario($data); //agregar a la relacion datos  
                }
                return TRUE;

            }  else
                return FALSE;
        }  


        public function anadir_historico_acceso($data){

            $timestamp = time();
            $ip_address = $this->input->ip_address();
            $user_agent= $this->input->user_agent();

            $this->db->set( 'email', "AES_ENCRYPT('{$data->email}','{$this->key_hash}')", FALSE );
            

            $this->db->set( 'id_usuario', $data->id);
            $this->db->set( 'fecha',  gmt_to_local( $timestamp, 'UM1', TRUE) );
            $this->db->set( 'ip_address',  $ip_address, TRUE );
            $this->db->set( 'user_agent',  $user_agent, TRUE );
            

            $this->db->insert($this->historico_acceso );

            if ($this->db->affected_rows() > 0){
                    return TRUE;
                } else {
                    return FALSE;
                }
                $result->free_result();

        }


        //eliminar usuarios
        public function eliminar_usuario( $uid ){
            $this->db->delete( $this->usuarios, array( 'id' => $uid ) );
            if ( $this->db->affected_rows() > 0 ) return TRUE;
            else return FALSE;
        }


        //cambiar multiples perfiles al mismo instante
        public function cambiar_multiples_perfiles( $data ){
            
            $filtro_campo = '';
            foreach ($data['ids'] as $key => $valor) {  //$key ->0,1,..n  y  $valor= 077e9338-6134-11e8-9341-e4580d37ed21
                 $filtro_campo.= (($filtro_campo!='') ? ' OR ' : '') . '(id = "'.addslashes($valor).'") ';
            }

            $filtro_campo= (($filtro_campo!='') ? '('.$filtro_campo.') ' : '') ;
              
              $this->db->set( 'id_perfil', $data['id_perfil'] );              
              $this->db->where($filtro_campo);
              $this->db->update( $this->usuarios );

            if ( $this->db->affected_rows() > 0 ) return TRUE;
            else return FALSE;
        }


        //Eliminar  multiples usuarios al mismo instante
        public function eliminar_multiples_usuarios( $data ){
            
            $filtro_campo = '';
            foreach ($data['ids'] as $key => $valor) {  //$key ->0,1,..n  y  $valor= 077e9338-6134-11e8-9341-e4580d37ed21
                 $filtro_campo.= (($filtro_campo!='') ? ' OR ' : '') . '(id = "'.addslashes($valor).'") ';
            }

            $filtro_campo= (($filtro_campo!='') ? '('.$filtro_campo.') ' : '') ;
              
              $this->db->where($filtro_campo);
              $this->db->delete( $this->usuarios );

            if ( $this->db->affected_rows() > 0 ) return TRUE;
            else return FALSE;
        }


////////////////////////////////////////////////regillas/////////////////////////////////////////////////////////////////

      public function buscando_usuarios($data){
            $this->db->select( 'id' );
            $this->db->select("nombre", FALSE);  
            $this->db->from($this->usuarios);
            $this->db->where("activo" ,1);
            $this->db->like("nombre" ,$data['key'],FALSE);

              $result = $this->db->get();
              if ( $result->num_rows() > 0 ) {
                  foreach ($result->result()  as $key => $row) 
                      {
                            $dato[]= array("id"=>$row->id, 
                                            "nombre"=>$row->nombre, 
                                            //"num"=>(int)$data["num"], 
                                    );
                      }
                      return json_encode($dato);
              }   
              else 
                 return False;
              $result->free_result();
      }    











        public function buscador_usuarios($data){

              //Metadatos con los valores que vienen por defecto, hacer un merge con los valores que vienen
              $datos_meta = array_merge(['pagination' => [], 'sort' => [], 'query' => []], $data);
              
              
              $filtro_identidad = isset($datos_meta['query']['id_entidad']) && is_string($datos_meta['query']['id_entidad'])
                  ? ' AND r.id_entidad='.$datos_meta['query']['id_entidad'] : '';

               if ( isset($datos_meta['query']['id_entidad']) && is_string($datos_meta['query']['id_entidad']) )   {
                     unset($datos_meta['query']['id_entidad']); //destruir filtro (quitar busquedaGeneral)
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

              //echo json_encode($filtro_campo);



              //Orden
              $order  = ! empty($datos_meta['sort']['sort']) ? $datos_meta['sort']['sort'] : 'asc';
              $columna =  ! empty($datos_meta['sort']['field']) ? $datos_meta['sort']['field'] : 'id';

              //los metas para paginacion
              $meta    = [];
              $pagina_activa    = ! empty($datos_meta['pagination']['page']) ? (int)$datos_meta['pagination']['page'] : 1;
              $registro_por_pagina = ! empty($datos_meta['pagination']['perpage']) ? (int)$datos_meta['pagination']['perpage'] : -1;
              $total_registros_Xpaginas = 1;
             
              //consulta***
              //////65350f88-d031-11e5-b036-04015a6da711
                $id_session = $this->session->userdata('id');

                $this->db->select("SQL_CALC_FOUND_ROWS(u.id)", FALSE); //
                $this->db->select('u.id, u.nombre, u.apellidos, u.id_perfil');
                $this->db->select( "AES_DECRYPT( u.email,'{$this->key_hash}') AS email", FALSE );
                $this->db->select( "AES_DECRYPT( u.telefono,'{$this->key_hash}') AS telefono", FALSE );
                $this->db->select( "AES_DECRYPT( u.contrasena,'{$this->key_hash}') AS contrasena", FALSE );
                $this->db->select('p.nombre perfil');
                $this->db->select("( CASE WHEN u.fecha_pc = 0 THEN '' ELSE DATE_FORMAT(FROM_UNIXTIME(u.fecha_pc),'%d-%m-%Y') END ) AS fecha", FALSE);  

                $this->db->select('group_concat(e.nombre) entidad');  //GROUP_CONCAT(DISTINCT cate_id)
                
                 //$this->db->select("sum(ro.id_permiso=1) as lectura", FALSE); 
                 //$this->db->select("sum(ro.id_permiso=2) as escritura", FALSE); 

                // $this->db->select("id_permiso"); 
                 

                $this->db->from($this->usuarios.' as u');
                $this->db->join($this->perfiles.' as p', 'u.id_perfil = p.id');
                    $this->db->join($this->entidades__usuarios.' r', 'u.id = r.id_usuario');
                    $this->db->join($this->entidades.' e', 'e.id = r.id_entidad'.$filtro_identidad);

                // $this->db->join($this->roles.' as ro', 'u.id = ro.id_usuario', 'LEFT');   
                // $this->db->join($this->modulos.' as m', 'ro.id_modulo = m.id', 'LEFT');
                // $this->db->join($this->permisos.' as per', 'ro.id_permiso = per.id', 'LEFT');


                $where = '('.
                            $filtro_campo.'
                            (u.id <> "'.$id_session.'") AND 
                            (p.id >'. (int)($this->session->userdata('id_perfil') ) .') AND
                            
                            
                            (
                              ( u.nombre LIKE  "%'.$filtro_busqueda.'%" ) OR (u.apellidos LIKE  "%'.$filtro_busqueda.'%") OR (p.nombre LIKE  "%'.$filtro_busqueda.'%") 
                              OR (  AES_DECRYPT( u.email,"{$this->key_hash}")  LIKE  "%'.$filtro_busqueda.'%") 
                              
                             )
                  )';   






                $this->db->where($where);
                //ordenacion
                $this->db->order_by($columna, $order); 
                $this->db->group_by('u.id'); 

           
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
                                          "id_perfil"=>$row->id_perfil,
                                          "perfil"=>$row->perfil,
                                          "nombre"=> $row->nombre,
                                          "apellidos"=>$row->apellidos,
                                          "email"=>$row->email,
                                          "telefono"=>$row->telefono,
                                          "direccion"=>"aa",//$row->direccion,
                                          "fecha"=>$row->fecha,
                                          "entidad"=>$row->entidad,
                                          //"lectura"=>($row->id_permiso & 1) ? 1 : 0, // ? $row->lectura : 0,
                                          //"escritura"=>($row->id_permiso & 2) ? 1 : 0, //? $row->escritura : 0,
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
          $this->db->select("u.id");
          $this->db->from($this->usuarios.' as u');
          $this->db->join($this->perfiles.' as p', 'u.id_perfil = p.id');
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
          return json_encode($resultado);
    }


  public function permiso_usuario_actual($id_modulo){
      $id_session = $this->session->userdata('id'); 

      $this->db->select("ro.id_permiso");
      
      $this->db->from($this->usuarios.' u');
      $this->db->join($this->roles.' ro', ' u.id = ro.id_usuario');
      
      $where = '(
                        (u.id = "'.$id_session.'") 
                        and (ro.id_modulo='.$id_modulo.')

              )';   
      $this->db->where($where);
          
       $result = $this->db->get();
        
        if ( $result->num_rows() > 0 )
           return $result->row()->id_permiso;
        else
           return false;
        $result->free_result();
   

  }       

  public function buscador_modal_usuarios($data){

              $id_modulo = isset($data["id_modulo"]) ? $data["id_modulo"] : 0;
              //Metadatos con los valores que vienen por defecto, hacer un merge con los valores que vienen
              $datos_meta = array_merge(['pagination' => [], 'sort' => [], 'query' => []], $data);
              
              
              $filtro_identidad = isset($datos_meta['query']['id_entidad']) && is_string($datos_meta['query']['id_entidad'])
                  ? ' AND r.id_entidad='.$datos_meta['query']['id_entidad'] : '';

               if ( isset($datos_meta['query']['id_entidad']) && is_string($datos_meta['query']['id_entidad']) )   {
                     unset($datos_meta['query']['id_entidad']); //destruir filtro (quitar busquedaGeneral)
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
             
              //consulta***
              //////65350f88-d031-11e5-b036-04015a6da711
                $id_session = $this->session->userdata('id');

                $this->db->select("SQL_CALC_FOUND_ROWS(u.id)", FALSE); //
                $this->db->select('u.id, u.nombre, u.apellidos, u.id_perfil');
                $this->db->select( "AES_DECRYPT( u.email,'{$this->key_hash}') AS email", FALSE );
                $this->db->select( "AES_DECRYPT( u.telefono,'{$this->key_hash}') AS telefono", FALSE );
                $this->db->select( "AES_DECRYPT( u.contrasena,'{$this->key_hash}') AS contrasena", FALSE );
                $this->db->select('p.nombre perfil');
                $this->db->select("( CASE WHEN u.fecha_pc = 0 THEN '' ELSE DATE_FORMAT(FROM_UNIXTIME(u.fecha_pc),'%d-%m-%Y') END ) AS fecha", FALSE);  

                $this->db->select('group_concat(e.nombre) entidad');  //GROUP_CONCAT(DISTINCT cate_id)
                $this->db->select("max(ro.id_permiso*(ro.id_modulo=".$id_modulo.")) as id_permiso", FALSE); 

                $this->db->from($this->usuarios.' as u');
                $this->db->join($this->perfiles.' as p', 'u.id_perfil = p.id');
                    $this->db->join($this->entidades__usuarios.' r', 'u.id = r.id_usuario');
                    $this->db->join($this->entidades.' e', 'e.id = r.id_entidad'.$filtro_identidad);

                 $this->db->join($this->roles.' as ro', 'u.id = ro.id_usuario', 'LEFT' ); 
           
                $where = '('.
                            $filtro_campo.' 
                            
                            (u.id <> "'.$id_session.'") AND 
                            (u.id_perfil = 4) AND 
                            (p.id >'. (int)($this->session->userdata('id_perfil') ) .') AND
                            
                            
                            (
                              ( u.nombre LIKE  "%'.$filtro_busqueda.'%" ) OR (u.apellidos LIKE  "%'.$filtro_busqueda.'%") OR (p.nombre LIKE  "%'.$filtro_busqueda.'%") 
                              OR (  AES_DECRYPT( u.email,"{$this->key_hash}")  LIKE  "%'.$filtro_busqueda.'%") 
                              
                             )
                  )';   






                $this->db->where($where);
                //ordenacion
                $this->db->order_by($columna, $order); 
                $this->db->group_by('u.id'); 

           
             // $registro_por_pagina 0; get all data
              if ($registro_por_pagina > 0) {
                  $offset = ($pagina_activa - 1) * $registro_por_pagina;
                  $this->db->limit($registro_por_pagina,  $offset );    //$largo,$inicio
               }

               
               //$this->db->get();
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
                                          "id_perfil"=>$row->id_perfil,
                                          "perfil"=>$row->perfil,
                                          "nombre"=> $row->nombre,
                                          "apellidos"=>$row->apellidos,
                                          "email"=>$row->email,
                                          "telefono"=>$row->telefono,
                                          "direccion"=>"aa",//$row->direccion,
                                          "fecha"=>$row->fecha,
                                          "entidad"=>$row->entidad,
                                          "lectura"=>($row->id_permiso & 1) ? 1 : 0, // ? $row->lectura : 0,
                                          "escritura"=>($row->id_permiso & 2) ? 1 : 0, //? $row->escritura : 0,
                                          "id_permiso"=>$row->id_permiso
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

          /*
          //para todos los id, cuando seleccione
          $this->db->select("u.id");
          $this->db->from($this->usuarios.' as u');
          $this->db->join($this->perfiles.' as p', 'u.id_perfil = p.id');
          $this->db->where($where);
          $resulta = $this->db->get();
          if ( $resulta->num_rows() > 0 ) {
                // si seleccionamos(habilitamos) todos los registros, retornaremos todos los ids en "rowIDs"
                if (isset($datos_meta['requestIds']) && filter_var($datos_meta['requestIds'], FILTER_VALIDATE_BOOLEAN)) {
                    $meta['rowIds'] = array_map(function ($row) {
                        return $row->id;
                    }, $resulta->result());
                }  
          }  */



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
          return json_encode($resultado);
    }



    public function actualizar_roles($data){

        //foreach ($data['id_entidad'] as $key => $valor) {
            foreach ($data['arreglo_general'] as $key => $valor) {  
                  

                  $sql = "INSERT INTO ".$this->roles." (id_usuario, id_modulo,id_permiso) VALUES ('".$valor['id_usuario']."', ".$valor['id_modulo'].", ".($valor['lectura']+$valor['escritura']).") on duplicate key update id_usuario='".$valor['id_usuario']."' , id_modulo=".$valor['id_modulo'].", id_permiso=".($valor['lectura']+$valor['escritura']);
                  $this->db->query($sql);
                  //var_dump($this->db);die;

            }

            if ($this->db->affected_rows() > 0){
                return TRUE;
                } else {
                    return FALSE;
                }
                $result->free_result();
  }


   public function historico_acceso($data){

              //Metadatos con los valores que vienen por defecto, hacer un merge con los valores que vienen
              $datos_meta = array_merge(['pagination' => [], 'sort' => [], 'query' => []], $data);
              
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

              //echo json_encode($filtro_campo);



              //Orden
              $order  = ! empty($datos_meta['sort']['sort']) ? $datos_meta['sort']['sort'] : 'asc';
              $columna =  ! empty($datos_meta['sort']['field']) ? $datos_meta['sort']['field'] : 'u.nombre';

              //los metas para paginacion
              $meta    = [];
              $pagina_activa    = ! empty($datos_meta['pagination']['page']) ? (int)$datos_meta['pagination']['page'] : 1;
              $registro_por_pagina = ! empty($datos_meta['pagination']['perpage']) ? (int)$datos_meta['pagination']['perpage'] : -1;
              $total_registros_Xpaginas = 1;
             
              //consulta***
              //////
                $id_session = $this->session->userdata('id');

                  $this->db->select('SQL_CALC_FOUND_ROWS *', false);

                    
                  $this->db->select("AES_DECRYPT(u.email,'{$this->key_hash}') AS email", FALSE);            
                  $this->db->select('p.id id_perfil, p.nombre perfil');
                  $this->db->select('u.nombre,u.apellidos');         
                  $this->db->select('( CASE WHEN h.fecha = 0 THEN "" ELSE DATE_FORMAT(FROM_UNIXTIME(h.fecha),"%d-%m-%Y %H:%i:%s") END ) AS fecha', FALSE);  
                  $this->db->select('h.ip_address, h.user_agent, h.id_usuario');
                  


                  $this->db->from($this->historico_acceso.' As h');
                  $this->db->join($this->usuarios.' As u' , 'u.id = h.id_usuario');
                  $this->db->join($this->perfiles.' As p', 'u.id_perfil = p.id','LEFT');

           
       
                
                //filtro de busqueda
             //$filtro_campo='';
             
                $where = '('.
                             $filtro_campo.'
                             (p.id >'. (int)($this->session->userdata('id_perfil') ) .') AND

                            (
                              ( u.nombre LIKE  "%'.$filtro_busqueda.'%" ) OR (u.apellidos LIKE  "%'.$filtro_busqueda.'%") OR (p.nombre LIKE  "%'.$filtro_busqueda.'%") 
                              OR (  AES_DECRYPT( h.email,"{$this->key_hash}")  LIKE  "%'.$filtro_busqueda.'%") 
                              OR (  DATE_FORMAT(FROM_UNIXTIME(h.fecha),"%d-%m-%Y %H:%i:%s")     LIKE  "%'.$filtro_busqueda.'%") 
                              OR (h.ip_address LIKE  "%'.$filtro_busqueda.'%")
                              OR (h.user_agent LIKE  "%'.$filtro_busqueda.'%")
                             )
                  )';   





                $this->db->where($where);
                //ordenacion
                $this->db->order_by($columna, $order); 

                $this->db->group_by('h.id_usuario'); 
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
                                          
                                          "id_perfil"=>$row->id_perfil,
                                          "perfil"=>$row->perfil,
                                          "nombre"=> $row->nombre,
                                          "apellidos"=>$row->apellidos,
                                          "email"=>$row->email,
                                          "fecha"=>$row->fecha,
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
          return json_encode($resultado);
    }






      
      


      

////////////////////////////////////////////////regillas/////////////////////////////////////////////////////////////////

      



//////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////
//////////////////////////////////////////////////////////////////////////////////////////        
//////////////////////////////////////////////////////////////////////////////////////////



















      



       


    
   

  
  
   
                 //var_dump($dato);
                  //return json_encode( $dato);



                //$sql = $this->db->last_query();
                //return "aaa".$sql;







 





      

  } 
?>