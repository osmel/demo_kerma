<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/


$route['default_controller']   					= 'main/index'; 
$route['404_override'] 		   					= '';


//////////////////////////////////home////////////////////////////////////////

$route['procesando_modal_usuarios']				= 'main/procesando_modal_usuarios';
$route['actualizar_roles']						= 'main/actualizar_roles';


//////////////////////////////////Administracion////////////////////////////////////////




$route['login']									= 'main/login';


$route['usuarios']								= 'main/listado_usuarios';
$route['procesando_usuarios']					= 'main/procesando_usuarios';





$route['buscador']								= 'main/buscador';



	/* necesita server de correo, para que notifique quien se da de alta*/
$route['nuevo_usuario']                 = 'main/nuevo_usuario';
$route['validar_nuevo_usuario']         = 'main/validar_nuevo_usuario';

$route['actualizar_perfil']		         = 'main/actualizar_perfil';
$route['editar_usuario/(:any)']			= 'main/actualizar_perfil/$1';
$route['validacion_edicion_usuario']    = 'main/validacion_edicion_usuario';

$route['eliminar_usuario/(:any)']		= 'main/eliminar_usuario/$1';
$route['validar_eliminar_usuario']    = 'main/validar_eliminar_usuario';


$route['salir']							= 'main/logout';

$route['validar_login']					= 'main/validar_login';

//Multiples
$route['cambiar_multiples_perfiles']					= 'main/cambiar_multiples_perfiles';
$route['eliminar_multiples_usuarios']					= 'main/eliminar_multiples_usuarios';


//recuperar contraseña /* necesita server de correo*/
$route['recuperar_contrasena']			= 'main/recuperar_contrasena';
$route['validar_recuperar_password']	= 'main/validar_recuperar_password';


//solo faltan estos modulos
			//historicos de accesos
				$route['historico_accesos']                 = 'main/historico_accesos';
	 $route['procesando_historico_accesos']                 = 'main/procesando_historico_accesos';
			
			//respaldar informacion	
			$route['respaldar']					= 'respaldo/respaldar';





////entidades
$route['entidades']								= 'main/listado_entidades';
$route['procesando_entidades']					= 'main/procesando_entidades';



$route['editar_entidad/(:any)']			= 'main/editar_entidad/$1';
$route['validacion_editar_entidad']    = 'main/validacion_editar_entidad';

$route['nuevo_entidad']                 = 'main/nuevo_entidad';
$route['validar_nuevo_entidad']         = 'main/validar_nuevo_entidad';


$route['eliminar_entidad/(:any)']		= 'main/eliminar_entidad/$1';
$route['validar_eliminar_entidad']    = 'main/validar_eliminar_entidad';


//////////////////////////////////catalogos////////////////////////////////////////
//////////////////////////////////catalogos////////////////////////////////////////

////preguntas
$route['preguntas']								= 'clasificadores/listado_preguntas';
$route['procesando_preguntas']					= 'clasificadores/procesando_preguntas';



$route['editar_pregunta/(:any)']			= 'clasificadores/editar_pregunta/$1';
$route['validacion_editar_pregunta']    = 'clasificadores/validacion_editar_pregunta';

$route['nuevo_pregunta']                 = 'clasificadores/nuevo_pregunta';
$route['validar_nuevo_pregunta']         = 'clasificadores/validar_nuevo_pregunta';


	$route['botones_pregunta']         = 'clasificadores/botones_pregunta';

$route['eliminar_pregunta/(:any)']		= 'clasificadores/eliminar_pregunta/$1';
$route['validar_eliminar_pregunta']    = 'clasificadores/validar_eliminar_pregunta';


$route['dependencia']    = 'clasificadores/dependencia';



//////////////////////////////////arbol////////////////////////////////////////
//////////////////////////////////arbol////////////////////////////////////////

//
				
$route['obtener_nodo/(:any)']						= 'main/obtener_nodo/$1';			
$route['menu_nodo/(:any)']							= 'main/menu_nodo/$1';
$route['obtener_contenido']						= 'main/obtener_contenido';
//////////////////////////////////ingresos_cobranza////////////////////////////////////////
//////////////////////////////////ingresos_cobranza////////////////////////////////////////
//////////////////////////////////ingresos_cobranza////////////////////////////////////////
$route['ingresos_cobranza']												= 'ingresos_cobranza/index';
$route['ingresos_cobranza/(:any)/(:any)']								= 'ingresos_cobranza/detalle/$1/$2';

//////////////////////////////////profesionales////////////////////////////////////////
//////////////////////////////////profesionales////////////////////////////////////////
//////////////////////////////////profesionales////////////////////////////////////////
$route['profesionales']												= 'profesionales/index';
$route['profesionales/(:any)/(:any)/(:any)']							= 'profesionales/detalle/$1/$2/$3';
//$route['guardar_selectores_marcados']									= 'administrativos/guardar_selectores_marcados';



//////////////////////////////////operacion_abogados////////////////////////////////////////
//////////////////////////////////operacion_abogados////////////////////////////////////////
//////////////////////////////////operacion_abogados////////////////////////////////////////
$route['operacion_abogados']											= 'operacion_abogados/index';
$route['operacion_abogados/(:any)/(:any)']								= 'operacion_abogados/detalle/$1/$2';


//////////////////////////////////administrativos////////////////////////////////////////
//////////////////////////////////administrativos////////////////////////////////////////
//////////////////////////////////administrativos////////////////////////////////////////
$route['administrativos']												= 'administrativos/index';
$route['administrativos/(:any)/(:any)/(:any)']							= 'administrativos/detalle/$1/$2/$3';

//este procedimiento va a servir tanto para profesionales como administrativos, guardar sus selectores
$route['guardar_selectores_marcados']									= 'administrativos/guardar_selectores_marcados';


//////////////////////////////////estructura_admin////////////////////////////////////////
//////////////////////////////////estructura_admin////////////////////////////////////////
//////////////////////////////////estructura_admin////////////////////////////////////////
$route['estructura_admin']												= 'estructura_admin/index';
$route['estructura_admin/(:any)/(:any)']								= 'estructura_admin/detalle/$1/$2';


//////////////////////////////////bonos_incentivos////////////////////////////////////////
//////////////////////////////////bonos_incentivos////////////////////////////////////////
//////////////////////////////////bonos_incentivos////////////////////////////////////////
$route['bonos_incentivos']												= 'bonos_incentivos/index';
$route['bonos_incentivos/(:any)/(:any)']								= 'bonos_incentivos/detalle/$1/$2';



//////////////////////////////////merca_promocion////////////////////////////////////////
//////////////////////////////////merca_promocion////////////////////////////////////////
//////////////////////////////////merca_promocion////////////////////////////////////////
$route['merca_promocion']											= 'merca_promocion/index';
$route['merca_promocion/(:any)/(:any)']								= 'merca_promocion/detalle/$1/$2';



//////////////////////////////////ti////////////////////////////////////////
//////////////////////////////////ti////////////////////////////////////////
//////////////////////////////////ti////////////////////////////////////////
$route['ti']											= 'ti/index';
$route['ti/(:any)/(:any)']								= 'ti/detalle/$1/$2';





//////////////////////////////////informacion_general////////////////////////////////////////
//////////////////////////////////informacion_general////////////////////////////////////////
//////////////////////////////////informacion_general////////////////////////////////////////
$route['informacion_general']											= 'informacion_general/index';
$route['informacion_general/(:any)/(:any)']								= 'informacion_general/detalle/$1/$2';
$route['leer_datos_general']    										= 'informacion_general/leer_datos_general';

$route['actualizar_datos_general']    										= 'informacion_general/actualizar_datos_general';



//////////////////////////////////ti////////////////////////////////////////
//////////////////////////////////ti////////////////////////////////////////
//////////////////////////////////ti////////////////////////////////////////
$route['incrementos']											= 'incrementos/index';
$route['incrementos/(:any)/(:any)']								= 'incrementos/detalle/$1/$2';



//////////////////////////////////prestaciones////////////////////////////////////////
//////////////////////////////////prestaciones////////////////////////////////////////
//////////////////////////////////prestaciones////////////////////////////////////////
$route['prestaciones']											= 'prestaciones/index';
$route['prestaciones/(:any)/(:any)/(:any)/(:any)']							= 'prestaciones/detalle/$1/$2/$3/$4';


//////////////////////////////////otras_prestaciones////////////////////////////////////////
//////////////////////////////////otras_prestaciones////////////////////////////////////////
//////////////////////////////////otras_prestaciones////////////////////////////////////////
$route['otras_prestaciones']												= 'otras_prestaciones/index';
$route['otras_prestaciones/(:any)/(:any)/(:any)/(:any)']							= 'otras_prestaciones/detalle/$1/$2/$3/$4';












//////////////////////////////////catalogos////////////////////////////////////////
//////////////////////////////////catalogos////////////////////////////////////////
//////////////////////////////////catalogos////////////////////////////////////////



//seccion
$route['secciones']					     = 'catalogos/listado_secciones';

$route['nuevo_seccion']                  = 'catalogos/nuevo_seccion';
$route['validar_nuevo_seccion']          = 'catalogos/validar_nuevo_seccion';

$route['editar_seccion/(:any)']			 = 'catalogos/editar_seccion/$1';
$route['validacion_edicion_seccion']     = 'catalogos/validacion_edicion_seccion';

$route['eliminar_seccion/(:any)/(:any)'] = 'catalogos/eliminar_seccion/$1/$2';
$route['validar_eliminar_seccion']    	 = 'catalogos/validar_eliminar_seccion';
$route['procesando_cat_secciones']    = 'catalogos/procesando_cat_secciones';

//grupo
$route['grupos']					     = 'catalogos/listado_grupos';

$route['nuevo_grupo']                  = 'catalogos/nuevo_grupo';
$route['validar_nuevo_grupo']          = 'catalogos/validar_nuevo_grupo';

$route['editar_grupo/(:any)']			 = 'catalogos/editar_grupo/$1';
$route['validacion_edicion_grupo']     = 'catalogos/validacion_edicion_grupo';

$route['eliminar_grupo/(:any)/(:any)'] = 'catalogos/eliminar_grupo/$1/$2';
$route['validar_eliminar_grupo']    	 = 'catalogos/validar_eliminar_grupo';
$route['procesando_cat_grupos']    = 'catalogos/procesando_cat_grupos';


//////////////////////////////////alumnos////////////////////////////////////////
//////////////////////////////////alumnos////////////////////////////////////////
//////////////////////////////////alumnos////////////////////////////////////////

$route['confirmar_asistencia']    = 'alumnos/confirmar_asistencia';
/*$route['confirmar_asistencia']    = 'alumnos/confirmar_asistencia';*/


/* End of file routes.php */
/* Location: ./application/config/routes.php */