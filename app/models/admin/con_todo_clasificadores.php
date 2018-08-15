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



  public function listado_sub_modulos($data){

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
        	if ($data['seleccionado']=='id_sub_modulo') {

        		if ($data['pestana']==0 ) {  //normales
        				$filtro = " r.id_encabezado_pregunta = ".$data['id_sub_modulo']." and ";
        		}	else { //profesionales, administrativos
        				$filtro = " cch.id = ".$data['id_sub_modulo']." and ";
        		}
        			

        	} else {
					$filtro =" ";        		
        	}

        	$filtro =" ";        		

          $result = $this->db->query("
          	select * from (
            select id_principal,  principal,  url_principal,
                        GROUP_CONCAT(DISTINCT(id_hijo) ORDER BY id_hijo SEPARATOR '|') id_hijos,
                        GROUP_CONCAT(DISTINCT(hijo) ORDER BY id_hijo SEPARATOR '|') hijos,
                        GROUP_CONCAT(DISTINCT(url_hijo) ORDER BY id_hijo SEPARATOR '|') url_hijos,

                     	

                         icono,
                         pestanas,
                         id_encabezados,
                         encabezados
	

                         from 
                (SELECT m.id id_principal,  m.nombre principal,  m.url url_principal,m.icono,
                        e.id id_hijo, e.nombre hijo, e.url url_hijo

                        ,0 pestanas,GROUP_CONCAT(DISTINCT(e.nombre) ORDER BY e.id SEPARATOR '|') encabezados, GROUP_CONCAT(DISTINCT(e.id) ORDER BY e.id SEPARATOR '|') id_encabezados
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

                where ".$filtro." m.id  =1

                union

                SELECT m.id id_principal,  m.nombre principal,  m.url url_principal,m.icono,
                        e.id id_hijo, e.nombre hijo, e.url url_hijo
                        ,0 pestanas,GROUP_CONCAT(DISTINCT(e.nombre) ORDER BY e.id SEPARATOR '|') encabezados, GROUP_CONCAT(DISTINCT(e.id) ORDER BY e.id SEPARATOR '|') id_encabezados
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



                where ".$filtro." m.id  =2

                union

                SELECT  
                            m.id id_principal,m.nombre principal, m.url url_principal,m.icono,
                            cch.id id_hijo,cch.descripcion hijo, cch.url url_hijo
                            ,1 pestanas,GROUP_CONCAT(DISTINCT(e.nombre) ORDER BY e.id SEPARATOR '|') encabezados, GROUP_CONCAT(DISTINCT(e.id) ORDER BY e.id SEPARATOR '|') id_encabezados
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


                  where ".$filtro." m.id  =3 and cch.id is not null  AND p.wildcard IS NULL 
                  group by cch.id

                  union

                SELECT m.id id_principal,  m.nombre principal,  m.url url_principal,m.icono,
                        e.id id_hijo, e.nombre hijo, e.url url_hijo
                        ,0 pestanas,GROUP_CONCAT(DISTINCT(e.nombre) ORDER BY e.id SEPARATOR '|') encabezados, GROUP_CONCAT(DISTINCT(e.id) ORDER BY e.id SEPARATOR '|') id_encabezados
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


                where ".$filtro." m.id  =4

                union


                SELECT  
                            m.id id_principal,m.nombre principal, m.url url_principal,m.icono,
                            cch.id id_hijo,cch.descripcion hijo, cch.url url_hijo
                            ,1 pestanas,GROUP_CONCAT(DISTINCT(e.nombre) ORDER BY e.id SEPARATOR '|') encabezados, GROUP_CONCAT(DISTINCT(e.id) ORDER BY e.id SEPARATOR '|') id_encabezados
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


                  where ".$filtro." m.id  =5 and cch.id is not null  AND p.wildcard IS NULL 
                  group by cch.id

                union


                SELECT m.id id_principal,  m.nombre principal,  m.url url_principal,m.icono,
                        e.id id_hijo, e.nombre hijo, e.url url_hijo
                        ,0 pestanas,GROUP_CONCAT(DISTINCT(e.nombre) ORDER BY e.id SEPARATOR '|') encabezados, GROUP_CONCAT(DISTINCT(e.id) ORDER BY e.id SEPARATOR '|') id_encabezados
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



                where ".$filtro." m.id  =6

                union



                SELECT m.id id_principal,  m.nombre principal,  m.url url_principal,m.icono,
                        e.id id_hijo, e.nombre hijo, e.url url_hijo
                        ,0 pestanas,GROUP_CONCAT(DISTINCT(e.nombre) ORDER BY e.id SEPARATOR '|') encabezados, GROUP_CONCAT(DISTINCT(e.id) ORDER BY e.id SEPARATOR '|') id_encabezados
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



                where ".$filtro." m.id  =7

                union


                SELECT m.id id_principal,  m.nombre principal,  m.url url_principal,m.icono,
                        e.id id_hijo, e.nombre hijo, e.url url_hijo
                        ,0 pestanas,GROUP_CONCAT(DISTINCT(e.nombre) ORDER BY e.id SEPARATOR '|') encabezados, GROUP_CONCAT(DISTINCT(e.id) ORDER BY e.id SEPARATOR '|') id_encabezados
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



                where ".$filtro." m.id  =8

                union


                SELECT m.id id_principal,  m.nombre principal,  m.url url_principal,m.icono,
                        e.id id_hijo, e.nombre hijo, e.url url_hijo
                        ,0 pestanas,GROUP_CONCAT(DISTINCT(e.nombre) ORDER BY e.id SEPARATOR '|') encabezados, GROUP_CONCAT(DISTINCT(e.id) ORDER BY e.id SEPARATOR '|') id_encabezados
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



                where ".$filtro." m.id  =9

                union


                SELECT m.id id_principal,  m.nombre principal,  m.url url_principal,m.icono,
                        e.id id_hijo, e.nombre hijo, e.url url_hijo
                        ,0 pestanas,GROUP_CONCAT(DISTINCT(e.nombre) ORDER BY e.id SEPARATOR '|') encabezados, GROUP_CONCAT(DISTINCT(e.id) ORDER BY e.id SEPARATOR '|') id_encabezados
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



                where ".$filtro." m.id  =10

                union


                SELECT m.id id_principal,  m.nombre principal,  m.url url_principal,m.icono,
                        e.id id_hijo, e.nombre hijo, e.url url_hijo
                        ,0 pestanas,GROUP_CONCAT(DISTINCT(e.nombre) ORDER BY e.id SEPARATOR '|') encabezados, GROUP_CONCAT(DISTINCT(e.id) ORDER BY e.id SEPARATOR '|') id_encabezados
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



                where ".$filtro." m.id  =11


                union


                SELECT m.id id_principal,  m.nombre principal,  m.url url_principal,m.icono,
                        e.id id_hijo, e.nombre hijo, e.url url_hijo
                        ,0 pestanas,GROUP_CONCAT(DISTINCT(e.nombre) ORDER BY e.id SEPARATOR '|') encabezados, GROUP_CONCAT(DISTINCT(e.id) ORDER BY e.id SEPARATOR '|') id_encabezados
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



                where ".$filtro." m.id  =12
                ) todo ". 
                $editores."
                group by  id_principal
                order by  id_principal, id_hijo
            ) todos   where id_principal = ".$data['id_modulo']." 
       ");  

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
               /*
               	$campo = $datos_meta['query']['campo'];
                   $datos_meta['query'][$campo] = $datos_meta['query']['id_sub_modulo'];
				    unset($datos_meta['query']['id_sub_modulo']);
				    unset($datos_meta['query']['campo']);
				    */


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

              //var_dump(json_encode($filtro_campo) ); die;



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
            $this->db->select('cch.id id_hijo,cch.descripcion hijo, cch.url url_hijo');   //2- HIJOS   (Gerente, staff, apoyo    administrador  2,6,7)


			//3- encabezados (estructura del despacho, sueldo, politica de variaciones, 5,6,7)
            $this->db->select( 'GROUP_CONCAT(DISTINCT(e.id) ORDER BY e.id SEPARATOR "|") id_encabezados',false);   //encabezados_id
            $this->db->select( 'GROUP_CONCAT(DISTINCT(e.nombre) ORDER BY e.id SEPARATOR "|") encabezados',false);  //encabezados 
            
            //4- selector (grupos o valores como el caso de ofCourse)
            $this->db->select( 'GROUP_CONCAT(DISTINCT(gch.id) ORDER BY gch.id SEPARATOR "|") id_grupos',false);
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

                

	             $where = '('.
                            $filtro_campo.'
                            

                            ( (p.activo =0) )  AND 
                             (p.wildcard IS NULL) AND
                            (

                              ( p.nombre LIKE  "%'.$filtro_busqueda.'%" ) OR
                              ( p.identificador LIKE  "%'.$filtro_busqueda.'%" ) 

                             )
                  )';   


              $this->db->where($where);




               
                //ordenacion
                $this->db->order_by($columna, $order); 
                $this->db->group_by('p.id,p.id_numeracion_pregunta'); 
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
                                          
			

            							  "id_principal"=>$row->id_principal,	 //1- PRINCIPAL (Administrador  5)  
            							  "principal"=>$row->principal,	
            							  "url_principal"=>$row->url_principal,	
            							  
            							  "id_hijo"=>($row->id_hijo==null) ? $row->id_encabezados : $row->id_hijo,	             //2- HIJOS   (Gerente, staff, apoyo    administrador  2,6,7)
            							  "hijo"=> ($row->hijo==null) ? $row->encabezados : $row->hijo,
            							  "url_hijo"=>$row->url_hijo,	

                                          "encabezados"=>($row->id_hijo==null) ? '': $row->encabezados,
                                          "id_encabezados"=>($row->id_hijo==null) ? '': $row->id_encabezados,

                                          "sub_seleccion"=>$row->sub_seleccion,
                                          "grupos"=>$row->grupos,
                                          "id_grupos"=>$row->id_grupos,



                                          "pestanas"=>($row->id_hijo==null) ? 0: 1, //cuando debe usarse cch.id=0 o r.id=0





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


  } 
?>