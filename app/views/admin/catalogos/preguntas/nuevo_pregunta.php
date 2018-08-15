<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php $this->load->view( 'header' ); ?>
<?php $this->load->view( 'aside-menu.php' ); ?>



<style>
.bootstrap-tagsinput .tag {
	color:red !important;
}

 </style>

<?php

	if (!isset($retorno)) {
      	$retorno ="/kerma/preguntas";
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
									<a href="<?php echo base_url(); ?>nuevo_pregunta" type="button" class="btn btn-block">Nuevo preguntas</a>
				          </div>
		        </div>
	        <!--FIN Menu admin-->
	      </div>
	      <!--catalogo preguntas-->


	  <!-- Cuerpo regilla -->
	  <br/>





					<!-- Contenido -->
					<div class="m-content">
						<div class="row">

					

							<!-- 2ra Columna -->
							<div class="col-xl-12 col-lg-12">
								<div class="m-portlet m-portlet--full-height m-portlet--tabs  ">
									<div class="m-portlet__head">
										<div class="m-portlet__head-tools">
											<ul class="nav nav-tabs m-tabs m-tabs-line   m-tabs-line--left m-tabs-line--primary" role="tablist">
												<li class="nav-item m-tabs__item">
													<a class="nav-link m-tabs__link active" data-toggle="tab" href="#tab_actualizar_empresa" role="tab">
														<i class="flaticon-share m--hide"></i>
														Actualizar Empresa
													</a>
												</li>
											
											</ul>
										</div>

									</div>

									<!-- Tabulaciones -->
									<div class="tab-content">
										<!-- Tab de Acualizar Empresa -->
										<div class="tab-pane active" id="tab_actualizar_empresa">

											<?php //echo $this->session->userdata('nombre_completo'); 
													/*
													id, campo, activo, version, identificador, titulo, nombre, proxima_pregunta, id_numeracion_pregunta, etiqueta_numeracion_pregunta, placeholder, id_modulo__encabezado_pregunta, id_tipo_pregunta, tooltip, wildcard
													*/

													?>


											 <!--declara formulario -->
												 <?php 

												 $hidden = array('id_p'=>$id);
  												 $attr = array('class' => 'form-horizontal m-form m-form--fit m-form--label-align-right', 'id'=>'form_preguntas','name'=>$retorno,'method'=>'POST','autocomplete'=>'off','role'=>'form');
												 echo form_open('validar_nuevo_pregunta', $attr,$hidden);
												?>

												<div class="m-portlet__body">
													<div class="form-group m-form__group row">
														<div class="col-10 ml-auto">
															<h3 class="m-form__section">
																1. Detalle Preguntas
															</h3>
														</div>
													</div>
													<!--1er bloque de campo -->

													<div class="form-group m-form__group row">
														<label for="nombre" class="col-2 col-form-label">
															Descripción de la Pregunta
														</label>
														<div class="col-7">
															
															<?php 
																$nomb_nom='';
																if (isset($pregunta->nombre)) 
																 {	$nomb_nom = $pregunta->nombre;}
															?>
															<input value="<?php echo  set_value('nombre',$nomb_nom); ?>" type="text" class="form-control m-input" name="nombre" placeholder="Nombre">

														</div>
													</div>
													<div class="form-group m-form__group row">
														<label for="campo" class="col-2 col-form-label">
															Campo
														</label>
														<div class="col-7">
															<?php 
																$nomb_nom='';
																if (isset($pregunta->campo)) 
																 {	$nomb_nom = $pregunta->campo;}
															?>
															<input value="<?php echo  set_value('campo',$nomb_nom); ?>" type="text" class="form-control m-input" name="campo" placeholder="campo (s)">
														</div>
													</div>

													<div class="form-group m-form__group row">
														<label for="placeholder" class="col-2 col-form-label">
															placeholder
														</label>
														<div class="col-7">
															<?php 
																$nomb_nom='';
																if (isset($pregunta->placeholder)) 
																 {	$nomb_nom = $pregunta->placeholder;}
															?>
															<input value="<?php echo  set_value('placeholder',$nomb_nom); ?>" type="text" class="form-control m-input" name="placeholder" placeholder="placeholder (s)">
														</div>
													</div>


													<div class="form-group m-form__group row">
														<label for="tooltip" class="col-2 col-form-label">
															tooltip
														</label>
														<div class="col-7">
															<?php 
																$nomb_nom='';
																if (isset($pregunta->tooltip)) 
																 {	$nomb_nom = $pregunta->tooltip;}
															?>
															<input value="<?php echo  set_value('tooltip',$nomb_nom); ?>" type="text" class="form-control m-input" name="tooltip" placeholder="tooltip (s)">
														</div>
													</div>



										
												    <div class="form-group m-form__group row">
														<label for="id_tipo_pregunta" class="col-md-2 control-label">Tipo Pregunta</label>
														<div class="col-7">
																<select name="id_tipo_pregunta" id="id_tipo_pregunta" class="form-control" mod="nuevo_pregunta">
																	<!--<option value="0">Selecciona una opción</option>-->
																		<?php foreach ( $tipo_preguntas as $tipo ){ ?>
																				<option value="<?php echo $tipo->id; ?>"><?php echo $tipo->nombre; ?></option>
																		<?php } ?>
																		
																</select>
																<fieldset style="display:none;"  id="bloque_tipo" >
																    <select class="selectpicker  tipo_seleccion"  id="tipo_seleccion" name="tipo_seleccion" mod="nuevo_pregunta"   data-style="btn-info" data-actions-box="true" >  

												                     </select>
											                    </fieldset> 
														</div>

	

													</div>




													

													<div class="form-group m-form__group row">
														<label for="id_modulo" class="col-md-2 control-label"  >Módulo</label>
														<div class="col-7">
															 
																	<select name="id_modulo" id="id_modulo" mod="nuevo_pregunta" class="form-control">
																		<!--<option value="0">Selecciona una opción</option>-->
																			<?php foreach ( $modulos as $modulo ){ ?>
																					<option value="<?php echo $modulo->id; ?>"><?php echo $modulo->nombre; ?></option>
																			<?php } ?>
																			<!--rol de usuario -->
																	</select>
														    
														</div>
													</div>										




												<div class="form-group m-form__group row">
														<label for="id_sub_modulo" class="col-md-2 control-label">Sub-Módulo</label>
														<div class="col-7">
															 
																	<select name="id_sub_modulo" id="id_sub_modulo" class="form-control">
																		<!--<option value="0">Selecciona una opción</option>-->
																			<?php foreach ( $sub_modulos as $sub_modulo ){ ?>
																					<option value="<?php echo $sub_modulo->id; ?>"><?php echo $sub_modulo->nombre; ?></option>
																			<?php } ?>
																			<!--rol de usuario -->
																	</select>
														    
														</div>
													</div>


												<!--Bloque categorias -->
													<div class="m-form__seperator m-form__seperator--dashed m-form__seperator--space-2x"></div>
													<div class="form-group m-form__group row">
														<div class="col-10 ml-auto">
															<h3 class="m-form__section">
																2. Categoria(s) Asociado(s)
															</h3>
														</div>

														<div class="col-10 ml-auto">
														<select class="selectpicker  multiples_categoria"  id="multiples_categoria" name="multiples_categoria" mod="nuevo_pregunta"   data-style="btn-info" data-actions-box="true" >  

										                </select>
														</div>


													</div>







													<!--2do bloque de campo -->
													<div class="m-form__seperator m-form__seperator--dashed m-form__seperator--space-2x"></div>
													<div class="form-group m-form__group row">
														<div class="col-10 ml-auto">
															<h3 class="m-form__section">
																2. Botones(s) Asociado(s)
															</h3>
														</div>

														<div class="col-10 ml-auto">
														<select class="selectpicker  multiples_btnes"  id="multiples_btnes" mod="nuevo_pregunta" multiple title="Seleccionar..." data-style="btn-info" data-actions-box="true" >  

															<?php foreach ( $botones as $btn ){ ?>
																	<option  value="<?php echo $btn->id; ?>"> <?php echo $btn->grupo_nombre.'('.$btn->categoria_nombre.')'; ?></option>
															<?php } ?>


										                </select>
														</div>


													</div>






												</div>

												<!-- Botones de salvar y cancelar -->
												<div class="m-portlet__foot m-portlet__foot--fit">
													<div class="m-form__actions">
														<div class="row">
															<div class="col-2"></div>
															<div class="col-7">
																<button type="reset" class="btn m-btn m-btn--air m-btn--custom">
																	<input type="submit" class="btn btn-replicar-info btn-block" value="Guardar"/>
																</button>
																&nbsp;&nbsp;
																<button type="reset" class="btn m-btn m-btn--air m-btn--custom">
																	<a href="<?php echo $retorno; ?>" type="button" class="blanco-btn btn">Cancelar</a>
																</button>
															</div>
														</div>
													</div>
												</div>


											<?php echo form_close(); ?>  <!--FIn declara formulario -->
										</div>

										<!-- Tab de Acualizar Perfil -->
										<div class="tab-pane " id="tab_mensaje"></div>
										<div class="tab-pane " id="tab_configuracion"></div>
									</div>


								</div>
							</div> <!-- Fin 2da Columna -->


						</div>
					</div> <!-- Fin del Contenido -->

    				</div><!--FIN m-content-->

				</div>

<?php $this->load->view( 'footer' ); ?>


<script>
    $(document ).ready(function() {



        $('.selectpicker').on('changed.bs.select', function (e) {
            console.log($(this).val());
            //var a= $('li[prueba="valor"]');
        });



    });
</script>