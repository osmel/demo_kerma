<?php if(! defined('BASEPATH')) exit('No tienes permiso para acceder a este archivo');

  class model_profesionales extends CI_Model{
    
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
          $this->relacion_modulo__encabezado_pregunta   = $this->db->dbprefix('cat_view_modulo__encabezado_pregunta');          
          $this->encabezado_pregunta                    = $this->db->dbprefix('cat_view_encabezado_pregunta');         
          $this->preguntas                    = $this->db->dbprefix('cat_view_preguntas');         




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



          $this->selectores_marcados                    = $this->db->dbprefix('selectores_marcados');      
          




            $this->subcategoria                    = 3;

          

    }






      public function listado_subcategorias(){
            $id_session = $this->session->userdata('id');


            
            $this->db->select('m.id id_principal,m.nombre principal, m.url url_principal');   //1- PRINCIPAL (Administrador  5)  
            $this->db->select('cch.id id_hijo,cch.descripcion hijo, cch.url url_hijo');   //2- HIJOS   (Gerente, staff, apoyo    administrador  2,6,7)


            //3- encabezados (estructura del despacho, sueldo, politica de variaciones, 5,6,7)
            $this->db->select( 'GROUP_CONCAT(DISTINCT(e.id) ORDER BY e.id SEPARATOR "|") id_encabezado',false);   //encabezados_id
            $this->db->select( 'GROUP_CONCAT(DISTINCT(e.nombre) ORDER BY e.id SEPARATOR "|") encabezados',false);  //encabezados 
            
            //4- selector (grupos o valores como el caso de ofCourse)
            $this->db->select( 'GROUP_CONCAT(DISTINCT(gch.id) ORDER BY gch.id SEPARATOR "|") grupos_id',false);
            $this->db->select( 'GROUP_CONCAT(DISTINCT(gch.descripcion) ORDER BY gch.id SEPARATOR "|") grupos',false);
            
                            

              
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



            $where = '(
                        ( (m.id ='.$this->subcategoria.')  
                         and (cch.id is not null)  
                         and (p.wildcard IS NULL ))
              )';   
            
            $this->db->where($where);
            
           $this->db->group_by('cch.id'); //cch.id,p.id_numeracion_pregunta
            $this->db->order_by('cch.id');


                $result = $this->db->get();
              if ($result->num_rows() > 0)
                return $result->result();
              else 
                return FALSE;
              $login->free_result();
      }  



 


      public function listado_sub_pregunta($data){
            $id_session = $this->session->userdata('id');

            
            $this->db->select('m.id id_principal,m.nombre principal, m.url url_principal');   //1- PRINCIPAL (Administrador  5)  
            $this->db->select('cch.id id_hijo,cch.descripcion hijo, cch.url url_hijo');   //2- HIJOS   (Gerente, staff, apoyo    administrador  2,6,7)


            $this->db->select( 'p.nombre pregunta, r.id, p.id_numeracion_pregunta, p.etiqueta_numeracion_pregunta, p.identificador, p.wildcard,vp.descripcion valor_predefinido,vp.id id_valor_predefinido,
            tvp.descripcion tipo_valor_predefinido,tvp.id id_tipo_valor_predefinido,p.placeholder' );  


            //3- encabezados (estructura del despacho, sueldo, politica de variaciones, 5,6,7)
            $this->db->select( 'GROUP_CONCAT(DISTINCT(e.id) ORDER BY e.id SEPARATOR "|") id_encabezado',false);   //encabezados_id
            $this->db->select( 'GROUP_CONCAT(DISTINCT(e.nombre) ORDER BY e.id SEPARATOR "|") encabezados',false);  //encabezados 
            
            //4- selector (grupos o valores como el caso de ofCourse)
            $this->db->select( 'GROUP_CONCAT(DISTINCT(gch.id) ORDER BY gch.id SEPARATOR "|") grupos_id',false);
            $this->db->select( 'GROUP_CONCAT(DISTINCT(gch.descripcion) ORDER BY gch.id SEPARATOR "|") grupos',false);
            
              
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



            $this->db->select('GROUP_CONCAT(DISTINCT(vp.descripcion) ORDER BY vp.id SEPARATOR "|") valores',false);
            $this->db->select('GROUP_CONCAT(DISTINCT(vp.id) ORDER BY vp.id SEPARATOR "|") valores_id',false);


              //mostrar el tipo de pregunta
               $this->db->select('tvp.id id_tipo_valores_predefinidos,tvp.descripcion descripcion_valores_predefinidos,t.id id_tipo_pregunta,t.nombre tipo_pregunta');
                
                $this->db->select( 'p.id id_preg, TRIM(p.campo) campo, p.id_tipo_pregunta tipo', false );
            
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


            $where = '(
                        ( (p.activo =0)  AND (m.id ='.$this->subcategoria.')   and (cch.id = '.$data["id_hijo"].' )  and (p.wildcard IS NULL ))
                        and (e.id ='.$data["id_encabezado"] .')
              )';   
            
            $this->db->where($where);


            //$this->db->group_by('p.id_numeracion_pregunta');
            $this->db->group_by('p.id,p.id_numeracion_pregunta');  //
            $this->db->order_by('p.id_numeracion_pregunta');


                $result = $this->db->get();
              if ($result->num_rows() > 0)
                return $result->result();
              else 
                return FALSE;
              $login->free_result();
      }  




     public function guardar_selectores_marcados( $data ){

              $sql = "INSERT INTO ".$this->selectores_marcados." (id_principal, id_hijo, num_hijo,  id_encabezado,  num_encabezado,   id_seleccion, objeto) VALUES (".$data['id_principal'].",".$data['id_hijo'].",".$data['num_hijo'].",".$data['id_encabezado'].",".$data['num_encabezado'].",".$data['id_seleccion'].", '".$data['objeto']."') on duplicate key update id_principal=".$data['id_principal']." ,id_hijo=".$data['id_hijo']." ,num_hijo=".$data['num_hijo']." ,id_encabezado=".$data['id_encabezado']." ,num_encabezado=".$data['num_encabezado']." ,id_seleccion=".$data['id_seleccion']." ,objeto='".$data['objeto']."'";
              $this->db->query($sql);

            if ($this->db->affected_rows() > 0){
                return TRUE;
                } else {
                    return FALSE;
                }
                $result->free_result();
        }


        public function  listado_selectores_marcados( $data ) {

            $this->db->select('s.id_principal, s.id_hijo, s.num_hijo, s.objeto, s.id_encabezado, s.num_encabezado, s.id_seleccion');
             $this->db->from($this->selectores_marcados.' s');

             //id_principal, id_hijo, num_hijo,
             $where = '(
                          ( (s.id_principal ='.$data["id_principal"].')  AND (s.id_hijo ='.$data["id_hijo"].')  AND (s.num_hijo ='.$data["num_hijo"].') )
             )';   
            
              $this->db->where($where);
          
              $result = $this->db->get();
              if ($result->num_rows() > 0)
                return $result->row();
              else 
                return FALSE;
              $login->free_result();



        }


      

  } 
?>