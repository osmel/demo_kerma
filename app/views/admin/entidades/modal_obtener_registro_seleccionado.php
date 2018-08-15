<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>


<!--begin::Modal-->
			<div class="modal fade" id="modal_obtener_registro_seleccionado" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
				<div class="modal-dialog" role="document">
					<div class="modal-content">
						<div class="modal-header">
							<h5 class="modal-title" id="exampleModalLabel">
								Modal title
							</h5>
							<button type="button" class="close" data-dismiss="modal" aria-label="Close">
								<span aria-hidden="true">
									&times;
								</span>
							</button>
						</div>
						<div class="modal-body">
							<div class="m-scrollable" data-scrollbar-shown="true" data-scrollable="true" data-max-height="200">
								<ul class="m_datatable_selected_ids"></ul>
							</div>
						</div>
						<div class="modal-footer">
							<button type="button" class="btn btn-secondary" data-dismiss="modal">
								Close
							</button>
						</div>
					</div>
				</div>
			</div>
			<!--end::Modal-->