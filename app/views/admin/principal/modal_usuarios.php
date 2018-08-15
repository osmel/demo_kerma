<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<!-- <button type="button" name="button" data-toggle="modal" data-target="#ModalIngresosCobranza">Reasignar</button> -->
<!-- Modal -->
<div class="modal fade" id="modal_usuarios" tabindex="-1" role="dialog" aria-labelledby="ModalIngresosCobranzaTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      

      <div class="modal-header">  <!--Encabezado -->
        <h5 class="modal-title" id="ModalIngresosCobranzaTitle">Listado de usuarios</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      

      <div class="modal-body">  <!--cuerpo -->
			   <div class="tabla_modal_usuarios" id="ajax_data"></div>
      </div>


      <div class="modal-footer"> <!--Pie -->
        <button type="button" data-dismiss="modal" class="blanco-btn btn">Regresar</button>
        <button type="button" class="completo-btn btn_aceptar_modal" data-toggle="modal" data-target="#ModalIngresosCobranzaConfirmar">Enviar</button>
      </div>


    </div>
  </div>
</div>
<!--FIN modal-->