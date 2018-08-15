<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>



<!--begin::Modal-->
<div class="modal fade" id="modal_cambiar_multiple_perfil" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
	<div class="modal-dialog" role="document">
		<div class="modal-content">




			<div class="modal-header">
				<h3 class="text-left">Cambiar multiples perfiles</h3>
			</div>


			<div class="modal-body">
				<p>¿Estás seguro de que deseas cambiar <b><span style="font-color:red;" class="etiq_num_registro"></span></b> perfiles</b>?</p>
				<p>Recuerde, este proceso es completamente irreversible.</p>
				<div class="m-scrollable" data-scrollbar-shown="true" data-scrollable="true" data-max-height="200">
					<ul class="m_datatable_selected_ids"></ul>
				</div>
			</div>

	
		
	



			<div class="modal-footer">
				<button class="btn btn-danger" id="aceptar_multiple_perfil">Aceptar</button>
				<button class="btn btn-default" data-dismiss="modal">Cancelar</button>
			</div>




		</div>
	</div>
</div>
<!--end::Modal-->