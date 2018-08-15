 /*if ( isset($datos_meta['query']['id_modulo']) && is_string($datos_meta['query']['id_modulo']) )   {
                if  ($datos_meta['query']['id_modulo'] ==0) {
                     unset($datos_meta['query']['id_modulo']);
                }     
              }

              if ( isset($datos_meta['query']['gch.id']) && is_string($datos_meta['query']['gch.id']) )   {
                   if  ($datos_meta['query']['gch.id'] ==0) {
                        unset($datos_meta['query']['gch.id']);
                   }
                        
              }

              if ( isset($datos_meta['query']['e.id']) && is_string($datos_meta['query']['e.id']) )   {
                   if  ($datos_meta['query']['e.id'] ==0) {
                        unset($datos_meta['query']['e.id']);
                   }
              }

              
              if ( isset($datos_meta['query']['pestana']) && is_string($datos_meta['query']['pestana']) )   {
                  $pestana = $datos_meta['query']['pestana'];
                   unset($datos_meta['query']['pestana']);
              }

              */
              
              //todos los query que envien con valor a cero, excepto pestana se quitaran

              /*id_modulo
              r.id_encabezado_pregunta , cch.id 
              gch.id, e.id
              pestana
              rch.id
              gch.id
              */