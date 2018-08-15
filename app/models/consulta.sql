
/*











SELECT m.id id_principal,  m.nombre principal,  m.url url_principal,
        e.id id_hijo, e.nombre hijo, e.url url_hijo
FROM kerma_cat_view_modulos m
INNER JOIN kerma_cat_view_modulo__encabezado_pregunta r ON r.id_modulo = m.id
INNER JOIN kerma_cat_view_encabezado_pregunta e ON r.id_encabezado_pregunta = e.id
where  m.id =1

union

SELECT m.id id_principal,  m.nombre principal,  m.url url_principal,
        e.id id_hijo, e.nombre hijo, e.url url_hijo
FROM kerma_cat_view_modulos m
INNER JOIN kerma_cat_view_modulo__encabezado_pregunta r ON r.id_modulo = m.id
INNER JOIN kerma_cat_view_encabezado_pregunta e ON r.id_encabezado_pregunta = e.id
where  m.id =2

union

SELECT  
            m.id id_principal,m.nombre principal, m.url url_principal,
            cch.id id_hijo,cch.descripcion hijo, cch.url url_hijo
FROM kerma_cat_view_modulos m
  INNER JOIN kerma_cat_view_modulo__encabezado_pregunta r ON r.id_modulo = m.id
  INNER JOIN kerma_cat_view_encabezado_pregunta e ON r.id_encabezado_pregunta = e.id
  INNER JOIN kerma_cat_view_preguntas p ON r.id = p.id_modulo__encabezado_pregunta


  LEFT JOIN kerma_capital_humano_actual_por_preguntas chp ON p.id = chp.id_pregunta
  LEFT JOIN kerma_capital_humano_actual cha ON cha.id = chp.id_capital_humano_actual
  LEFT JOIN kerma_categoria_capital_humano cch ON cch.id = cha.id_categoria_capital_humano

  WHERE m.id =3 and cch.id is not null  AND p.wildcard IS NULL 
  group by cch.id

  union

SELECT m.id id_principal,  m.nombre principal,  m.url url_principal,
        e.id id_hijo, e.nombre hijo, e.url url_hijo
FROM kerma_cat_view_modulos m
INNER JOIN kerma_cat_view_modulo__encabezado_pregunta r ON r.id_modulo = m.id
INNER JOIN kerma_cat_view_encabezado_pregunta e ON r.id_encabezado_pregunta = e.id
where  m.id =4

union


SELECT  
            m.id id_principal,m.nombre principal, m.url url_principal,
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


SELECT m.id id_principal,  m.nombre principal,  m.url url_principal,
        e.id id_hijo, e.nombre hijo, e.url url_hijo
FROM kerma_cat_view_modulos m
INNER JOIN kerma_cat_view_modulo__encabezado_pregunta r ON r.id_modulo = m.id
INNER JOIN kerma_cat_view_encabezado_pregunta e ON r.id_encabezado_pregunta = e.id
where  m.id =6

union



SELECT m.id id_principal,  m.nombre principal,  m.url url_principal,
        e.id id_hijo, e.nombre hijo, e.url url_hijo
FROM kerma_cat_view_modulos m
INNER JOIN kerma_cat_view_modulo__encabezado_pregunta r ON r.id_modulo = m.id
INNER JOIN kerma_cat_view_encabezado_pregunta e ON r.id_encabezado_pregunta = e.id
where  m.id =7

union


SELECT m.id id_principal,  m.nombre principal,  m.url url_principal,
        e.id id_hijo, e.nombre hijo, e.url url_hijo
FROM kerma_cat_view_modulos m
INNER JOIN kerma_cat_view_modulo__encabezado_pregunta r ON r.id_modulo = m.id
INNER JOIN kerma_cat_view_encabezado_pregunta e ON r.id_encabezado_pregunta = e.id
where  m.id =8

union


SELECT m.id id_principal,  m.nombre principal,  m.url url_principal,
        e.id id_hijo, e.nombre hijo, e.url url_hijo
FROM kerma_cat_view_modulos m
INNER JOIN kerma_cat_view_modulo__encabezado_pregunta r ON r.id_modulo = m.id
INNER JOIN kerma_cat_view_encabezado_pregunta e ON r.id_encabezado_pregunta = e.id
where  m.id =9

union


SELECT m.id id_principal,  m.nombre principal,  m.url url_principal,
        e.id id_hijo, e.nombre hijo, e.url url_hijo
FROM kerma_cat_view_modulos m
INNER JOIN kerma_cat_view_modulo__encabezado_pregunta r ON r.id_modulo = m.id
INNER JOIN kerma_cat_view_encabezado_pregunta e ON r.id_encabezado_pregunta = e.id
where  m.id =10

union


SELECT m.id id_principal,  m.nombre principal,  m.url url_principal,
        e.id id_hijo, e.nombre hijo, e.url url_hijo
FROM kerma_cat_view_modulos m
INNER JOIN kerma_cat_view_modulo__encabezado_pregunta r ON r.id_modulo = m.id
INNER JOIN kerma_cat_view_encabezado_pregunta e ON r.id_encabezado_pregunta = e.id
where  m.id =11


union


SELECT m.id id_principal,  m.nombre principal,  m.url url_principal,
        e.id id_hijo, e.nombre hijo, e.url url_hijo
FROM kerma_cat_view_modulos m
INNER JOIN kerma_cat_view_modulo__encabezado_pregunta r ON r.id_modulo = m.id
INNER JOIN kerma_cat_view_encabezado_pregunta e ON r.id_encabezado_pregunta = e.id
where  m.id =12

























SELECT  
            m.id id_principal,m.nombre principal, m.url url_principal,
            cch.id id_hijo,cch.descripcion hijo, cch.url url_hijo
FROM kerma_cat_view_modulos m
  INNER JOIN kerma_cat_view_modulo__encabezado_pregunta r ON r.id_modulo = m.id
  INNER JOIN kerma_cat_view_encabezado_pregunta e ON r.id_encabezado_pregunta = e.id
  INNER JOIN kerma_cat_view_preguntas p ON r.id = p.id_modulo__encabezado_pregunta


  LEFT JOIN kerma_capital_humano_actual_por_preguntas chp ON p.id = chp.id_pregunta
  LEFT JOIN kerma_capital_humano_actual cha ON cha.id = chp.id_capital_humano_actual
  LEFT JOIN kerma_categoria_capital_humano cch ON cch.id = cha.id_categoria_capital_humano

  WHERE m.id =11 and cch.id is not null  AND p.wildcard IS NULL 
  group by cch.id

  





















3(profesionales), 5(administrativos), 11(prestaciones)

, 12

SELECT  
            m.id id_principal,m.nombre principal, m.url url_principal,
            cch.id id_hijo,cch.descripcion hijo, cch.url url_hijo
FROM kerma_cat_view_modulos m
  INNER JOIN kerma_cat_view_modulo__encabezado_pregunta r ON r.id_modulo = m.id
  INNER JOIN kerma_cat_view_encabezado_pregunta e ON r.id_encabezado_pregunta = e.id
  INNER JOIN kerma_cat_view_preguntas p ON r.id = p.id_modulo__encabezado_pregunta


  LEFT JOIN kerma_capital_humano_actual_por_preguntas chp ON p.id = chp.id_pregunta
  LEFT JOIN kerma_capital_humano_actual cha ON cha.id = chp.id_capital_humano_actual
  LEFT JOIN kerma_categoria_capital_humano cch ON cch.id = cha.id_categoria_capital_humano

  WHERE  cch.id is not null  AND p.wildcard IS NULL 
  group by cch.id
  



  order by cch.id






















order by m.id, e.id













limit 0,10000







////rango humano
e.id 
  5= estruectura del despacho,
   41,42,43,6,7

r.id
  15,16,17,18,19,20



r.id id_encabezado,

SELECT  cch.id,cch.descripcion nombre,m.nombre principal,
    e.id id_encabezado, e.nombre encabezado, m.url url_principal,cch.url url_hijo, 
    GROUP_CONCAT(DISTINCT(gch.descripcion) ORDER BY cha.id SEPARATOR '|') grupos,
    GROUP_CONCAT(DISTINCT(cha.id) ORDER BY cha.id SEPARATOR '|') grupos_id,

    GROUP_CONCAT(DISTINCT(e.nombre) ORDER BY e.id SEPARATOR '|') encabezados,
    GROUP_CONCAT(DISTINCT(e.id) ORDER BY e.id SEPARATOR '|') encabezado_id

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

  WHERE m.id =5 and cch.id is not null

  AND p.wildcard IS NULL 
  group by cch.id
  order by cch.id





    GROUP_CONCAT(DISTINCT(gch.descripcion) ORDER BY cha.id_grupo_capital_humano SEPARATOR '|') grupos,
    GROUP_CONCAT(DISTINCT(cha.id_grupo_capital_humano) ORDER BY cha.id_grupo_capital_humano SEPARATOR '|') grupos_id,
    e.nombre encabezado,
    e.id id_encabezado,  
    cha.id,    
     cha.id_grupo_capital_humano,
     rch.id,
     rch.id_tipo_rango,
     rch.descripcion
   GROUP_CONCAT(DISTINCT( CONCAT("id_grupo_capital_humano:", case when (cha.id_grupo_capital_humano is null) then 0 else cha.id_grupo_capital_humano end)
   ) ORDER BY cha.id SEPARATOR ",") 
    as id_grupo_capital_humano_new,



/////////////////////////////////////

SELECT  
    m.id id_principal,m.nombre principal, m.url url_principal,  
    cch.id,cch.descripcion nombre, cch.url url_hijo, 
 
    GROUP_CONCAT(DISTINCT(e.id) ORDER BY e.id SEPARATOR '|') encabezado_id,
    GROUP_CONCAT(DISTINCT(e.nombre) ORDER BY e.id SEPARATOR '|') encabezados,

    
    GROUP_CONCAT(DISTINCT(gch.id) ORDER BY gch.id SEPARATOR '|') grupos_id,
    GROUP_CONCAT(DISTINCT(gch.descripcion) ORDER BY gch.id SEPARATOR '|') grupos,
      
     CONCAT("[", GROUP_CONCAT(DISTINCT( CONCAT(
         "{'id_capital_humano':",cha.id,
         ",'id_grupo_capital_humano':", (case when (cha.id_grupo_capital_humano is null) then 'null' else cha.id_grupo_capital_humano end),

         ",'id_rango':",rch.id, 
         ",'id_tipo_rango':",rch.id_tipo_rango, 
         ",'nombre':","'",rch.descripcion, "'}"
     )) ORDER BY cha.id SEPARATOR ",") , "]")
     as     sub_seleccion

     

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

  WHERE m.id =5 and cch.id is not null

  AND p.wildcard IS NULL 
  group by cch.id
  order by cch.id




*/


     /* 
            
          $data['url_principal']       = 'administrativos';
          $data['url_hijo']      = $url_hijo;
          $data['id_hijo']      = base64_decode($id_hijo);
          $data['num_hijo']     = base64_decode($num_hijo);  //num de hijo, 0-gerente, 1-staff,2-apoyo
           $data['id_encabezado'] = base64_decode($id_encabezado);
           $data['id_seleccion'] = base64_decode($id_seleccion);
           */
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
PROFESIONALES
////////////////////////////////////////////////////////////////////////////////////////////////////////////////
////////////////////////////////////////////////////////////////////////////////////////////////////////////////

/*








////rango humano
e.id 
  5= estruectura del despacho,
   41,42,43,6,7

r.id
  15,16,17,18,19,20



r.id id_encabezado,

SELECT  cch.id,cch.descripcion nombre,m.nombre principal,
    e.id id_encabezado, e.nombre encabezado, m.url url_principal,cch.url url_hijo, 
    GROUP_CONCAT(DISTINCT(gch.descripcion) ORDER BY cha.id_grupo_capital_humano SEPARATOR '|') grupos,
    GROUP_CONCAT(DISTINCT(cha.id_grupo_capital_humano) ORDER BY cha.id_grupo_capital_humano SEPARATOR '|') grupos_id,

    GROUP_CONCAT(DISTINCT(e.nombre) ORDER BY e.id SEPARATOR '|') encabezados,
    GROUP_CONCAT(DISTINCT(e.id) ORDER BY e.id SEPARATOR '|') encabezado_id,
    GROUP_CONCAT(DISTINCT(rch.descripcion) ORDER BY rch.id SEPARATOR "|") as sub_seleccion,
    GROUP_CONCAT(DISTINCT(rch.id) ORDER BY rch.id SEPARATOR "|") as id_sub_seleccion,
    
    case (when cha.id_grupo_capital_humano is null) then rch.descripcion  else 

    GROUP_CONCAT(DISTINCT( CONCAT(rch.descripcion,' - ',cha.id_grupo_capital_humano)) ORDER BY cha.id_grupo_capital_humano SEPARATOR "|") as sub_seleccion,
    GROUP_CONCAT(DISTINCT(cha.id) ORDER BY cha.id SEPARATOR "|") as id_sub_seleccion2
    
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

  WHERE m.id =3 and cch.id is not null

  AND p.wildcard IS NULL 
  group by cch.id
  order by cch.id




[{'id_capital_humano':14,'id_grupo_capital_humano':1,'id_rango':8,'id_tipo_rango':2,'nombre':'260_279'},{'id_capital_humano':17,'id_grupo_capital_humano':1,'id_rango':11,'id_tipo_rango':2,'nombre':'320_339'},{'id_capital_humano':19,'id_grupo_capital_humano':1,'id_rango':13,'id_tipo_rango':2,'nombre':'<120'},{'id_capital_humano':9,'id_grupo_capital_humano':1,'id_rango':3,'id_tipo_rango':2,'nombre':'160_179'},{'id_capital_humano':20,'id_grupo_capital_humano':1,'id_rango':14,'id_tipo_rango':2,'nombre':'>360'},{'id_capital_humano':10,'id_grupo_capital_humano':1,'id_rango':4,'id_tipo_rango':2,'nombre':'180_199'},{'id_capital_humano':16,'id_grupo_capital_humano':1,'id_rango':10,'id_tipo_rango':2,'nombre':'300_319'},{'id_capital_humano':15,'id_grupo_capital_humano':1,'id_rango':9,'id_tipo_rango':2,'nombre':'280_299'},{'id_capital_humano':18,'id_grupo_capital_humano':1,'id_rango':12,'id_tipo_rango':2,'nombre':'340_359'},{'id_capital_humano':13,'id_grupo_capital_humano':1,'id_rango':7,'id_tipo_rango':2,'nombre':'240_25]





cch.id,cch.descripcion nombre,m.nombre principal, m.id id_principal,
    e.id id_encabezado, e.nombre encabezado, m.url url_principal,cch.url url_hijo, 
    GROUP_CONCAT(DISTINCT(gch.descripcion) ORDER BY cha.id_grupo_capital_humano SEPARATOR '|') grupos,
    GROUP_CONCAT(DISTINCT(cha.id_grupo_capital_humano) ORDER BY cha.id_grupo_capital_humano SEPARATOR '|') grupos_id,

    GROUP_CONCAT(DISTINCT(e.nombre) ORDER BY e.id SEPARATOR '|') encabezados,
    GROUP_CONCAT(DISTINCT(e.id) ORDER BY e.id SEPARATOR '|') encabezado_id,

  GROUP_CONCAT(DISTINCT( CONCAT("id_grupo_capital_humano:", case when (cha.id_grupo_capital_humano is null) then 0 else cha.id_grupo_capital_humano end)
   ) ORDER BY cha.id SEPARATOR ",") 
    as id_grupo_capital_humano_new,




SELECT  

            m.id id_principal,m.nombre principal, m.url url_principal,
            cch.id id_hijo,cch.descripcion hijo, cch.url url_hijo,
            GROUP_CONCAT(DISTINCT(e.id) ORDER BY e.id SEPARATOR "|") id_encabezado,
            GROUP_CONCAT(DISTINCT(e.nombre) ORDER BY e.id SEPARATOR "|") encabezados,
            
            
            GROUP_CONCAT(DISTINCT(gch.id) ORDER BY gch.id SEPARATOR "|") grupos_id,
            GROUP_CONCAT(DISTINCT(gch.descripcion) ORDER BY gch.id SEPARATOR "|") grupos,
            
                            

  
 
      
     CONCAT("[", GROUP_CONCAT(DISTINCT( CONCAT(
         "{'id_capital_humano':",cha.id,
         ",'id_grupo_capital_humano':", (case when (cha.id_grupo_capital_humano is null) then 'null' else cha.id_grupo_capital_humano end),

         ",'id_rango':",rch.id, 
         ",'id_tipo_rango':",rch.id_tipo_rango, 
         ",'nombre':","'",rch.descripcion, "'}"
     )) ORDER BY cha.id SEPARATOR ",") , "]")
     as     sub_seleccion,

     cha.id,    
     cha.id_grupo_capital_humano,
     rch.id,
     rch.id_tipo_rango,
     rch.descripcion

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

  WHERE m.id =3 and cch.id is not null

  AND p.wildcard IS NULL 
  group by cch.id
  order by cch.id







*/


















