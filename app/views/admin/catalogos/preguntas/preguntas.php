<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $this->load->view( 'header' ); ?>
<?php $this->load->view( 'aside-menu.php' ); ?>

	<?php
	 	if (!isset($retorno)) {
	      	$retorno ="kerma/"; //admin
	    }
	?>


<div class="m-grid__item m-grid__item--fluid m-wrapper">
	    <!-- BEGIN: Subheader -->
	    <div class="m-subheader div-status">
	      <div class="d-flex align-items-center">
	        <div class="mr-auto">
	          <h3 class="m-subheader__title ">Administrador de preguntas</h3>
	          <h5>Nombre de la firma</h5>
	        </div>
	      </div>
	    </div>
	    <!-- END: Subheader -->
	    <div class="m-content contenido-admin-usu-cat">
		      <div class="container-fluid">
			        <!--Menu admin-->
			        <div class="row menu2-socios-activo">

								<div class="col-3 item-m2-socios item-m2-socios">
									<a href="<?php echo base_url(); ?>preguntas" type="button" class="btn btn-block">Catálogo de preguntas</a>
								</div>


					          <div class="col-3 item-m2-socios item-m2-socios">
										<a href="<?php echo base_url(); ?>nuevo_pregunta" type="button" class="btn btn-block">Nueva pregunta</a>
					          </div>
			        </div>
		        <!--FIN Menu admin-->
		      </div>
		      <!--catalogo preguntas-->
	    </div><!--FIN m-content-->

	  <!-- Cuerpo regilla -->
	  <br/>
	  <input type="hidden" name="pestana" id="pestana" value="0">
	  <div class="container-fluid">
		<div class="m-grid m-grid--hor m-grid--root m-page">
				<div class="m-portlet__body">
					<div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30">
						<div class="row align-items-center">

							<div class="col-xl-12 order-2 order-xl-1">
								<div class="form-group m-form__group row align-items-center">
									<!-- Filtro de tipo pregunta -->
									<div class="col-md-4">
										<div class="m-form__group m-form__group--inline">
											<div class="m-form__label">
												<label>
													Modulos:
												</label>
											</div>
											<div class="m-form__control">
												<select class="form-control m-bootstrap-select" id="id_modulo" mod="regilla_cat_pregunta">
													<!-- <option value="0">Todos</option> -->
														<?php foreach ( $modulos as $modulo ){ ?>
																<option value="<?php echo $modulo->id; ?>"><?php echo $modulo->id.' '.$modulo->nombre; ?></option>
														<?php } ?>
												</select>
											</div>
										</div>
									</div>


									<div class="col-md-4">
										<div class="m-form__group m-form__group--inline">
											<div class="m-form__label">
												<label>
													Sub Módulos:
												</label>
											</div>
											<div class="m-form__control">
												<select class="form-control m-bootstrap-select" id="id_sub_modulo" mod="regilla_cat_pregunta">

													<option value="0">Todos</option>

													<?php foreach($sub_modulos as $key=>$elem) { ?>

															<?php 
													           $hijos = explode('|', $elem->hijos);
													           $url_hijos = explode('|', $elem->url_hijos);
													           $id_hijos = explode('|', $elem->id_hijos);
													        ?>
													       

													       <?php if  (isset($hijos)) { ?>
													            <?php foreach($hijos as $key2=>$subElemento) { ?>
																			 <option value="<?php echo $id_hijos[$key2]; ?>"><?php echo $subElemento; ?></option>
																<?php }  ?>
															<?php }  ?>
													<?php }  ?>
														

												</select>
											</div>
										</div>
									</div>

									
									<div class="col-md-4 btnes" style="display:none;">
										<div class="m-form__group m-form__group--inline">
											<div class="m-form__label">
												<label>
													Botones:
												</label>
											</div>
											<div class="m-form__control">
												<select class="form-control m-bootstrap-select" id="id_botones" mod="regilla_cat_pregunta">


												</select>
											</div>
										</div>
									</div>


									<div class="col-md-4 agrupamiento" style="display:none;">
										<div class="m-form__group m-form__group--inline">
											<div class="m-form__label">
												<label>
													Grupos:
												</label>
											</div>
											<div class="m-form__control">
												<select class="form-control m-bootstrap-select" id="id_agrupamiento" mod="regilla_cat_pregunta">


												</select>
											</div>
										</div>
									</div>									


									<div class="col-md-4 rango" style="display:none;">
										<div class="m-form__group m-form__group--inline">
											<div class="m-form__label">
												<label>
													Rango:
												</label>
											</div>
											<div class="m-form__control">
												<select class="form-control m-bootstrap-select" id="id_rango" mod="regilla_cat_pregunta">


												</select>
											</div>
										</div>
									</div>									

									


					          		<!--<div class="col-md-4"></div> -->
					          		<!-- buscador -->
									<div class="col-md-4">
										<div class="m-input-icon m-input-icon--left">
											<input type="text" class="form-control m-input" placeholder="Search..." id="busquedaGeneral">
											<span class="m-input-icon__icon m-input-icon__icon--left">
												<span>
													<i class="la la-search"></i>
												</span>
											</span>
										</div>
									</div>

							 	</div>




	<!--begin: Selected Rows Group Action Form -->
								<div class="m-form m-form--label-align-right m--margin-top-20 m--margin-bottom-30 collapse" id="selector_multiple_registro">
									<div class="row align-items-center">
										<div class="col-xl-12">
											<div class="m-form__group m-form__group--inline">
												
												<div class="m-form__label m-form__label-no-wrap">
													<label class="m--font-bold m--font-danger-">
														Seleccionado
														<span id="etiqueta_selector_multiple_registro"></span>
														registros:
													</label>
												</div>
												
												<div class="m-form__control">
													<div class="btn-toolbar">
										
															<div class="dropdown">
																
																<button type="button" class="btn btn-accent btn-sm dropdown-toggle" data-toggle="dropdown">
																	Actualizando Perfil
																</button>

																<div class="dropdown-menu" aria-labelledby="btnGroupDrop1" id="id_grupo">
																		<?php foreach ( $perfiles as $perfil ){ ?>
																				
														<button 
														    class="btn btn-sm  dropdown-item cambio_multiple_perfil" 
														    valor="<?php echo $perfil->id_perfil; ?>"
														    activo=""
														    type="button" data-toggle="modal" data-target="#modal_cambiar_multiple_perfil">
															<?php echo $perfil->perfil; ?>
														</button>

																		<?php } ?> 
																</div>

															</div>



														&nbsp;&nbsp;&nbsp;
														
														<button class="btn btn-sm btn-danger eliminar_pregunta_multiple" 
														type="button" data-toggle="modal" data-target="#modal_eliminar_pregunta_multiple">
															Eliminando todos los seleccionados
														</button>

														&nbsp;&nbsp;&nbsp;
														<button class="btn btn-sm btn-success" type="button" data-toggle="modal" data-target="#modal_obtener_registro_seleccionado">
															Obtener registros seleccionados
														</button>

													</div>
												</div>

											</div>
										</div>
									</div>
								</div>
								<!--end: Selected Rows Group Action Form -->
		<!--begin: Datatable -->












									<div class="tabla_preguntas" id="ajax_data"></div>

			        		</div>
			        	</div>


		  			</div>
			    </div>
		</div>

	    <div class="row">
	          <div class="col-sm-8 col-md-9"></div>
	          <div class="col-sm-4 col-md-3">
	           	 <a href="/<?php echo $retorno; ?>" class="blanco-btn btn"><i class="fas fa-backward"></i> Regresar</a>
	          </div>
	    </div>
	  </div>

</div> <!--FIN todo-->




<div class="modal fade bs-example-modal-lg" id="m_modal_pregunta" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
		<div class="modal-dialog" role="document">
			<div class="modal-content">
				<!-- contenido -->
			</div>
		</div>
	</div>



<?php $this->load->view('footer'); ?>

<!-- declaracion de modales-->
<?php //$this->load->view('admin/preguntas/modal_cambiar_multiple_perfil'); ?>
<?php //$this->load->view('admin/preguntas/modal_eliminar_pregunta_multiple'); ?>
<?php //$this->load->view('admin/preguntas/modal_obtener_registro_seleccionado'); ?>




		


<div class="modal fade bs-example-modal-lg" id="modalMessage2" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
        <div class="modal-content"></div>
    </div>
</div>


<div class="modal fade bs-example-modal-lg" id="modalMessage" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
	<div class="modal-dialog">
        <div class="modal-content"></div>
    </div>
</div>



