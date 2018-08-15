<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<!-- <button type="button" name="button" data-toggle="modal" data-target="#ModalIngresosCobranza">Reasignar</button> -->
<!-- Modal -->
<div class="modal fade" id="modal_usuarios" tabindex="-1" role="dialog" aria-labelledby="ModalIngresosCobranzaTitle" aria-hidden="true">
  <div class="modal-dialog modal-dialog-centered" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="ModalIngresosCobranzaTitle">Listado de usuarios</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
				<!--Fila encabezado listado usuarios-->
        <div style="background: #cacacb; font-weight: bold; color: #313f45" class="row">
        	<div style="text-align:left" class="col-6">
        		Nombres
        	</div>
					<div class="col-3">
						Lectura
					</div>
					<div class="col-3">
						Escritura
					</div>
        </div>
				<!--FIN Fila encabezado listado usuarios-->
				<!--Filas listado usuarios-->
				<!--Usuario 1-->
				<div style="background: #f9f9f9; color: #313f45" class="row">
					<div style="text-align:left" class="col-6">
						Usuario 1
					</div>
					<div class="col-3">
						<div class="form-check">
							<input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
						</div>
					</div>
					<div class="col-3">
						<div class="form-check">
							<input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
						</div>
					</div>
				</div>
				<!--FIN Usuario 1-->
				<!--Usuario 2-->
				<div style="background: #f9f9f9; color: #313f45" class="row">
					<div style="text-align:left" class="col-6">
						Usuario 2
					</div>
					<div class="col-3">
						<div class="form-check">
							<input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
						</div>
					</div>
					<div class="col-3">
						<div class="form-check">
							<input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
						</div>
					</div>
				</div>
				<!--FIN Usuario 2-->
				<!--Usuario 3-->
				<div style="background: #f9f9f9; color: #313f45" class="row">
					<div style="text-align:left" class="col-6">
						Usuario 3
					</div>
					<div class="col-3">
						<div class="form-check">
							<input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
						</div>
					</div>
					<div class="col-3">
						<div class="form-check">
							<input class="form-check-input" type="checkbox" value="" id="defaultCheck1">
						</div>
					</div>
				</div>
				<!--FIN Usuario 3-->
				<!--FIN Filas listado usuarios-->
      </div>
      <div class="modal-footer">
        <button type="button" data-dismiss="modal">Regresar</button>
        <button type="button" class="completo-btn" data-toggle="modal" data-target="#ModalIngresosCobranzaConfirmar">Enviar</button>
				<!-- Modal confirmar-->
				<div class="modal fade" id="ModalIngresosCobranzaConfirmar" tabindex="-1" role="dialog" aria-labelledby="ModalIngresosCobranzaConfirmarTitle" aria-hidden="true">
					<div class="modal-dialog modal-dialog-centered" role="document">
					<div class="modal-content">
						<!-- <div class="modal-header">
								<button type="button" class="close" data-dismiss="modal" aria-label="Close">
							<span aria-hidden="true">&times;</span>
						</button>
							</div> -->
							<div class="modal-confirmar">
								<i class="fas fa-exclamation-circle"></i>
								<h5>Estas seguro de asignar:</h5>
								<h5>Ingresos Cobranza</h5>

							<div class="modal-body">
							<p>Usuarios:</p>
									<p>Usuario 1 (lectura)</p>
									<p>Usuario 2 (lectura, escritura)</p>
									<p>Usuario 3 (escritura)</p>
							</div>
							</div>
						<div class="modal-footer">
						<button type="button" data-dismiss="modal">Regresar</button>
						<button type="button" class="completo-btn">Confirmar</button>
						</div>
					</div>
					</div>
				</div>
				<!--FIN modal confirmar-->
      </div>
    </div>
  </div>
</div>
<!--FIN modal-->