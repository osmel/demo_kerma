<?php if(! defined('BASEPATH')) exit('No tienes permiso para acceder a este archivo');

  class model_informacion_general extends CI_Model{
    
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

          $this->op_configuracion_entidades     = $this->db->dbprefix('op_configuracion_entidades');

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
          
          $this->roles                                = $this->db->dbprefix('roles');          
          $this->permisos                                = $this->db->dbprefix('permisos');          



          $this->subcategoria                    = 1;

          

    }


/*
SELECT e.id, e.nombre, m.nombre principal
FROM kerma_cat_view_modulos m
INNER JOIN kerma_cat_view_modulo__encabezado_pregunta r ON r.id_modulo = m.id
INNER JOIN kerma_cat_view_encabezado_pregunta e ON r.id_encabezado_pregunta = e.id
WHERE m.id =2



SELECT e.id, e.nombre, m.nombre principal, p.nombre pregunta, r.id, p.id_numeracion_pregunta, p.identificador, p.wildcard,
t.nombre tipo_pregunta,
vp.descripcion valor_predefinido,
vp.id id_valor_predefinido,
tvp.descripcion tipo_valor_predefinido,
tvp.id id_tipo_valor_predefinido

FROM kerma_cat_view_modulos m
INNER JOIN kerma_cat_view_modulo__encabezado_pregunta r ON r.id_modulo = m.id

INNER JOIN kerma_cat_view_encabezado_pregunta e ON r.id_encabezado_pregunta = e.id
INNER JOIN kerma_cat_view_preguntas p ON r.id = p.id_modulo__encabezado_pregunta
INNER JOIN kerma_cat_tipo_pregunta t ON t.id = p.id_tipo_pregunta

LEFT JOIN kerma_cat_view_valores_predefinidos_pregunta v ON v.id_pregunta = p.id
LEFT JOIN kerma_cat_valores_predefinidos vp ON vp.id = v.id_valores_predefinidos
LEFT JOIN kerma_cat_tipo_valores_predefinidos tvp ON tvp.id = vp.id_tipo_valores_predefinidos
WHERE m.id =2 AND r.id =2
AND p.wildcard IS NULL 
group by id_numeracion_pregunta
order by id_numeracion_pregunta 

  ,
                        '' as enlace,
                        '' as children

*/



  public function listado_menu(){

        $id_session = $this->session->userdata('id'); 
        
        if ($this->session->userdata('id_perfil')==4 ) {
            $editores = "
            INNER JOIN 
            (SELECT ro.id_modulo, id_permiso
                FROM kerma_usuarios as u
                JOIN kerma_roles as ro ON u.id = ro.id_usuario 
                WHERE (u.id = '".$id_session."'  and ro.id_permiso<>0) 
            )  permisos_editores  on permisos_editores.id_modulo = id_principal
            ";
        } else {
          $editores = "";
        }

          $result = $this->db->query("
            select id_principal,  principal,  url_principal,
                        GROUP_CONCAT(DISTINCT(id_hijo) ORDER BY id_hijo SEPARATOR '|') id_hijos,
                        GROUP_CONCAT(DISTINCT(hijo) ORDER BY id_hijo SEPARATOR '|') hijos,
                        GROUP_CONCAT(DISTINCT(url_hijo) ORDER BY id_hijo SEPARATOR '|') url_hijos,

                         icono
                        

                         from 
                (SELECT m.id id_principal,  m.nombre principal,  m.url url_principal,m.icono,
                        e.id id_hijo, e.nombre hijo, e.url url_hijo
                FROM kerma_cat_view_modulos m
                INNER JOIN kerma_cat_view_modulo__encabezado_pregunta r ON r.id_modulo = m.id
                INNER JOIN kerma_cat_view_encabezado_pregunta e ON r.id_encabezado_pregunta = e.id
                where  m.id =1 and m.activo=0

                union

                SELECT m.id id_principal,  m.nombre principal,  m.url url_principal,m.icono,
                        e.id id_hijo, e.nombre hijo, e.url url_hijo
                FROM kerma_cat_view_modulos m
                INNER JOIN kerma_cat_view_modulo__encabezado_pregunta r ON r.id_modulo = m.id
                INNER JOIN kerma_cat_view_encabezado_pregunta e ON r.id_encabezado_pregunta = e.id
                where  m.id =2 and m.activo=0

                union

                SELECT  
                            m.id id_principal,m.nombre principal, m.url url_principal,m.icono,
                            cch.id id_hijo,cch.descripcion hijo, cch.url url_hijo
                FROM kerma_cat_view_modulos m
                  INNER JOIN kerma_cat_view_modulo__encabezado_pregunta r ON r.id_modulo = m.id
                  INNER JOIN kerma_cat_view_encabezado_pregunta e ON r.id_encabezado_pregunta = e.id
                  INNER JOIN kerma_cat_view_preguntas p ON r.id = p.id_modulo__encabezado_pregunta


                  LEFT JOIN kerma_capital_humano_actual_por_preguntas chp ON p.id = chp.id_pregunta
                  LEFT JOIN kerma_capital_humano_actual cha ON cha.id = chp.id_capital_humano_actual
                  LEFT JOIN kerma_categoria_capital_humano cch ON cch.id = cha.id_categoria_capital_humano

                  WHERE m.id =3 and cch.id is not null  AND p.wildcard IS NULL and m.activo=0
                  group by cch.id

                  union

                SELECT m.id id_principal,  m.nombre principal,  m.url url_principal,m.icono,
                        e.id id_hijo, e.nombre hijo, e.url url_hijo
                FROM kerma_cat_view_modulos m
                INNER JOIN kerma_cat_view_modulo__encabezado_pregunta r ON r.id_modulo = m.id
                INNER JOIN kerma_cat_view_encabezado_pregunta e ON r.id_encabezado_pregunta = e.id
                where  m.id =4 and m.activo=0

                union


                SELECT  
                            m.id id_principal,m.nombre principal, m.url url_principal,m.icono,
                            cch.id id_hijo,cch.descripcion hijo, cch.url url_hijo
                FROM kerma_cat_view_modulos m
                  INNER JOIN kerma_cat_view_modulo__encabezado_pregunta r ON r.id_modulo = m.id
                  INNER JOIN kerma_cat_view_encabezado_pregunta e ON r.id_encabezado_pregunta = e.id
                  INNER JOIN kerma_cat_view_preguntas p ON r.id = p.id_modulo__encabezado_pregunta


                  LEFT JOIN kerma_capital_humano_actual_por_preguntas chp ON p.id = chp.id_pregunta
                  LEFT JOIN kerma_capital_humano_actual cha ON cha.id = chp.id_capital_humano_actual
                  LEFT JOIN kerma_categoria_capital_humano cch ON cch.id = cha.id_categoria_capital_humano

                  WHERE m.id =5 and cch.id is not null  AND p.wildcard IS NULL 
                  group by cch.id

                union


                SELECT m.id id_principal,  m.nombre principal,  m.url url_principal,m.icono,
                        e.id id_hijo, e.nombre hijo, e.url url_hijo
                FROM kerma_cat_view_modulos m
                INNER JOIN kerma_cat_view_modulo__encabezado_pregunta r ON r.id_modulo = m.id
                INNER JOIN kerma_cat_view_encabezado_pregunta e ON r.id_encabezado_pregunta = e.id
                where  m.id =6 and m.activo=0

                union



                SELECT m.id id_principal,  m.nombre principal,  m.url url_principal,m.icono,
                        e.id id_hijo, e.nombre hijo, e.url url_hijo
                FROM kerma_cat_view_modulos m
                INNER JOIN kerma_cat_view_modulo__encabezado_pregunta r ON r.id_modulo = m.id
                INNER JOIN kerma_cat_view_encabezado_pregunta e ON r.id_encabezado_pregunta = e.id
                where  m.id =7 and m.activo=0

                union


                SELECT m.id id_principal,  m.nombre principal,  m.url url_principal,m.icono,
                        e.id id_hijo, e.nombre hijo, e.url url_hijo
                FROM kerma_cat_view_modulos m
                INNER JOIN kerma_cat_view_modulo__encabezado_pregunta r ON r.id_modulo = m.id
                INNER JOIN kerma_cat_view_encabezado_pregunta e ON r.id_encabezado_pregunta = e.id
                where  m.id =8 and m.activo=0

                union


                SELECT m.id id_principal,  m.nombre principal,  m.url url_principal,m.icono,
                        e.id id_hijo, e.nombre hijo, e.url url_hijo
                FROM kerma_cat_view_modulos m
                INNER JOIN kerma_cat_view_modulo__encabezado_pregunta r ON r.id_modulo = m.id
                INNER JOIN kerma_cat_view_encabezado_pregunta e ON r.id_encabezado_pregunta = e.id
                where  m.id =9 and m.activo=0

                union


                SELECT m.id id_principal,  m.nombre principal,  m.url url_principal,m.icono,
                        e.id id_hijo, e.nombre hijo, e.url url_hijo
                FROM kerma_cat_view_modulos m
                INNER JOIN kerma_cat_view_modulo__encabezado_pregunta r ON r.id_modulo = m.id
                INNER JOIN kerma_cat_view_encabezado_pregunta e ON r.id_encabezado_pregunta = e.id
                where  m.id =10 and m.activo=0

                union


                SELECT m.id id_principal,  m.nombre principal,  m.url url_principal,m.icono,
                        e.id id_hijo, e.nombre hijo, e.url url_hijo
                FROM kerma_cat_view_modulos m
                INNER JOIN kerma_cat_view_modulo__encabezado_pregunta r ON r.id_modulo = m.id
                INNER JOIN kerma_cat_view_encabezado_pregunta e ON r.id_encabezado_pregunta = e.id
                where  m.id =11 and m.activo=0


                union


                SELECT m.id id_principal,  m.nombre principal,  m.url url_principal,m.icono,
                        e.id id_hijo, e.nombre hijo, e.url url_hijo
                FROM kerma_cat_view_modulos m
                INNER JOIN kerma_cat_view_modulo__encabezado_pregunta r ON r.id_modulo = m.id
                INNER JOIN kerma_cat_view_encabezado_pregunta e ON r.id_encabezado_pregunta = e.id
                where  m.id =12 and m.activo=0
                ) todo ". 
                $editores."
                group by  id_principal
                order by  id_principal, id_hijo

       ");

           if ( $result->num_rows() > 0 ) {
                  return $result->result();
              } else 
                  return false;
            $result->free_result();      

      }  

      public function listado_subcategorias(){
            $id_session = $this->session->userdata('id');
            $this->db->select( 'e.id, e.nombre, m.nombre principal,m.url url_principal,e.url url_hijo, r.id id_encabezado' );
            $this->db->from($this->modulos.' m');
            $this->db->join($this->relacion_modulo__encabezado_pregunta.' r', ' r.id_modulo = m.id');
            $this->db->join($this->encabezado_pregunta.' e', ' r.id_encabezado_pregunta = e.id');

            $where = '(
                        (m.id ='.$this->subcategoria.') 
              )';   
            $this->db->where($where);
            


              $result = $this->db->get();
              if ($result->num_rows() > 0)
                return $result->result();
              else 
                return FALSE;
              $login->free_result();
      }  




      public function listado_sub_pregunta($data){
            $id_session = $this->session->userdata('id');
            

            $this->db->select( 'm.url url_principal,e.url url_hijo, r.id id_encabezado' );
            $this->db->select( 'e.id, e.nombre encabezado, m.nombre principal, p.nombre pregunta, r.id, p.id_numeracion_pregunta, p.etiqueta_numeracion_pregunta, p.identificador, p.wildcard,vp.descripcion valor_predefinido,vp.id id_valor_predefinido,
            tvp.descripcion tipo_valor_predefinido,tvp.id id_tipo_valor_predefinido,p.placeholder' );  

            
            $this->db->select( 'GROUP_CONCAT(DISTINCT(gch.descripcion) ORDER BY cha.id SEPARATOR "|") as grupos',false);
            $this->db->select( 'GROUP_CONCAT(DISTINCT(cha.id) ORDER BY cha.id SEPARATOR "|") as grupos_id',false);


            
            $this->db->select('GROUP_CONCAT(DISTINCT(vp.descripcion) ORDER BY vp.id SEPARATOR "|") valores',false);
            $this->db->select('GROUP_CONCAT(DISTINCT(vp.id) ORDER BY vp.id SEPARATOR "|") valores_id',false);
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
                        ( (p.activo =0)  AND   (m.id ='.$this->subcategoria.')   AND (r.id ='.$data["id_encabezado"].')  AND (p.wildcard IS NULL) )
              )';   
            $this->db->where($where);
              //$this->db->group_by('p.id_numeracion_pregunta');
            $this->db->group_by('p.id,p.id_numeracion_pregunta');  

            $this->db->order_by('p.id_numeracion_pregunta');

            
            


              $result = $this->db->get();
              if ($result->num_rows() > 0)
                return $result->result();
              else 
                return FALSE;
              $login->free_result();
      }  



      public function leer_datos($data){
        
            $id_session = $this->session->userdata('id');
            $this->db->select( 'm.id, m.nombre, m.calle, m.colonia, m.cp, m.id_estado, m.id_ciudad, m.telefono, m.email, m.socio, m.fecha, m.id_tipo_entidad, m.id_usuario');
            $this->db->from($this->op_configuracion_entidades.' m');
            $where = '(
                        (m.id ='.$data['id_entidad'].') 
              )';   
            $this->db->where($where);
              $result = $this->db->get();
              if ($result->num_rows() > 0)
                return $result->row();
              else 
                return FALSE;
              $login->free_result();


      }  

      public function actualizar_datos($data){
            
            $id_session = $this->session->userdata('id');
            $this->db->set( 'id_usuario_cambio',  $id_session );
            $this->db->set( $data['campo'], $data['valor'] );
            $this->db->where('id', $data['id_entidad'] );
            $this->db->update($this->op_configuracion_entidades );

              if ($this->db->affected_rows() > 0){
                    return TRUE;
                } else {
                    return FALSE;
                }
                $result->free_result();


      }  



      

  } 
?>