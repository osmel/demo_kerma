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
      	$retorno ="/kerma/entidades";
    }

?>



<div class="m-grid__item m-grid__item--fluid m-wrapper">
    <!-- BEGIN: Subheader -->
    <div class="m-subheader div-status">
      <div class="d-flex align-items-center">
        <div class="mr-auto">
          <h3 class="m-subheader__title ">Administrador de entidades</h3>
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
							<a href="<?php echo base_url(); ?>entidades" type="button" class="btn btn-block">Catálogo de entidades</a>
						</div>


				          <div class="col-3 item-m2-socios item-m2-socios">
									<a href="<?php echo base_url(); ?>nuevo_entidad" type="button" class="btn btn-block">Nuevo entidad</a>
				          </div>
		        </div>
	        <!--FIN Menu admin-->
	      </div>
	      <!--catalogo entidades-->


	  <!-- Cuerpo regilla -->
	  <br/>





					<!-- Contenido -->
					<div class="m-content">
						<div class="row">

						<!-- 1ra Columna -->
							<div class="col-xl-3 col-lg-4">
								<div class="m-portlet m-portlet--full-height  ">
									<div class="m-portlet__body">
										<div class="m-card-profile">
											<div class="m-card-profile__pic">
												<div class="m-card-profile__pic-wrapper">
													<img src="/kerma/metronic/dist/default/assets/app/media/img/users/logo_pleca.png" alt=""/>
												</div>
											</div>
											<div class="m-card-profile__details">
												<span class="m-card-profile__name">
													<?php //echo $this->session->userdata('nombre_completo'); ?>
															<?php 
																$nomb_nom='';
																if (isset($entidad->nombre)) 
																 {	$nomb_nom = $entidad->nombre;}
																 echo $nomb_nom; 
															?>


												</span>
												<a href="" class="m-card-profile__email m-link">
															<?php 
																$nomb_nom='';
																if (isset($entidad->email)) 
																 {	$nomb_nom = $entidad->email;}
																 echo $nomb_nom; 
															?>
												</a>
											</div>
										</div>
										<ul class="m-nav m-nav--hover-bg m-portlet-fit--sides">
											<li class="m-nav__separator m-nav__separator--fit"></li>
											<li class="m-nav__section ">
												<span class="m-nav__section-text">
													Sección
												</span>
											</li>
											<li class="m-nav__item">
												<a href="#" class="m-nav__link" style="pointer-events: none;">
													<i class="m-nav__link-icon flaticon-profile-1"></i>
													<span class="m-nav__link-title">
														<span class="m-nav__link-wrap">
															<span class="m-nav__link-text">
																Mi Perfil
															</span>
															
														</span>
													</span>
												</a>
											</li>
											

										</ul>
										<div class="m-portlet__body-separator"></div>
										
									</div>
								</div>
							</div>

							<!-- Fin 1ra Columna -->

							<!-- 2ra Columna -->
							<div class="col-xl-9 col-lg-8">
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
												<!-- <li class="nav-item m-tabs__item">
													<a class="nav-link m-tabs__link" data-toggle="tab" href="#tab_mensaje" role="tab">
														Mensajes
													</a>
												</li>
												<li class="nav-item m-tabs__item">
													<a class="nav-link m-tabs__link" data-toggle="tab" href="#tab_configuracion" role="tab">
														Configuración
													</a>
												</li> -->
											</ul>
										</div>

									</div>

									<!-- Tabulaciones -->
									<div class="tab-content">
										<!-- Tab de Acualizar Empresa -->
										<div class="tab-pane active" id="tab_actualizar_empresa">

											 <!--declara formulario -->
												 <?php 

												 $hidden = array('id_p'=>$id);
  												 $attr = array('class' => 'form-horizontal m-form m-form--fit m-form--label-align-right', 'id'=>'form_entidades','name'=>$retorno,'method'=>'POST','autocomplete'=>'off','role'=>'form');
												 echo form_open('validar_nuevo_entidad', $attr,$hidden);
												?>

												<div class="m-portlet__body">
													<div class="form-group m-form__group row">
														<div class="col-10 ml-auto">
															<h3 class="m-form__section">
																1. Detalle Empresa
															</h3>
														</div>
													</div>
													<!--1er bloque de campo -->
													<div class="form-group m-form__group row">
														<label for="nombre" class="col-2 col-form-label">
															Nombre de la firma
														</label>
														<div class="col-7">
															
															<?php 
																$nomb_nom='';
																if (isset($entidad->nombre)) 
																 {	$nomb_nom = $entidad->nombre;}
															?>
															<input value="<?php echo  set_value('nombre',$nomb_nom); ?>" type="text" class="form-control m-input" name="nombre" placeholder="Nombre">

														</div>
													</div>
													<div class="form-group m-form__group row">
														<label for="calle" class="col-2 col-form-label">
															Calle y número
														</label>
														<div class="col-7">
															<?php 
																$nomb_nom='';
																if (isset($entidad->calle)) 
																 {	$nomb_nom = $entidad->calle;}
															?>
															<input value="<?php echo  set_value('calle',$nomb_nom); ?>" type="text" class="form-control m-input" name="calle" placeholder="calle (s)">
														</div>
													</div>

													<div class="form-group m-form__group row">
														<label for="colonia" class="col-2 col-form-label">
															Colonia
														</label>
														<div class="col-7">
															<?php 
																$nomb_nom='';
																if (isset($entidad->colonia)) 
																 {	$nomb_nom = $entidad->colonia;}
															?>
															<input value="<?php echo  set_value('colonia',$nomb_nom); ?>" type="text" class="form-control m-input" name="colonia" placeholder="colonia (s)">
														</div>
													</div>


													<div class="form-group m-form__group row">
														<label for="cp" class="col-2 col-form-label">
															Código Postal
														</label>
														<div class="col-7">
															<?php 
																$nomb_nom='';
																if (isset($entidad->cp)) 
																 {	$nomb_nom = $entidad->cp;}
															?>
															<input value="<?php echo  set_value('cp',$nomb_nom); ?>" type="text" class="form-control m-input" name="cp" placeholder="cp (s)">
														</div>
													</div>

													<!-- id_estado, id_ciudad-->


													<div class="form-group m-form__group row">
														<label for="id_perfil" class="col-md-2 control-label">Estado</label>
														<div class="col-7">
																<select name="id_estado" id="id_estado" class="form-control">
																	<?php foreach ( $estados as $estado ){ ?>
																		<?php 
																		   if  ($entidad->id_estado==$estado->id)
																			 {$seleccionado='selected';} else {$seleccionado='';}
																		?>
																		<option value="<?php echo $estado->id; ?>" <?php echo $seleccionado; ?> ><?php echo $estado->nombre; ?></option>
																	<?php } ?>
																</select>
														</div>
													</div>



													<div class="form-group m-form__group row">
														<label for="id_perfil" class="col-md-2 control-label">Ciudad</label>
														<div class="col-7">
																<select name="id_ciudad" id="id_ciudad" class="form-control">
																	<?php foreach ( $ciudades as $ciudad ){ ?>
																		<?php 
																		   if  ($entidad->id_ciudad==$ciudad->id)
																			 {$seleccionado='selected';} else {$seleccionado='';}
																		?>
																		<option value="<?php echo $ciudad->id; ?>" <?php echo $seleccionado; ?> ><?php echo $ciudad->nombre; ?></option>
																	<?php } ?>
																</select>
														</div>
													</div>


													<div class="form-group m-form__group row">
														<label for="telefono" class="col-2 col-form-label">
															Teléfono
														</label>
														<div class="col-7">
															<?php 
																$nomb_nom='';
																if (isset($entidad->telefono)) 
																 {	$nomb_nom = $entidad->telefono;}
															?>
															<input value="<?php echo  set_value('telefono',$nomb_nom); ?>" type="text" class="form-control m-input" name="telefono" placeholder="telefono (s)">
														</div>
													</div>





													<div class="form-group m-form__group row">
														<label for="email" class="col-2 col-form-label">
															Correo electrónico
														</label>
														<div class="col-7">
															<?php 
																$nomb_nom='';
																if (isset($entidad->email)) 
																 {	$nomb_nom = $entidad->email;}
															?>
															<input value="<?php echo  set_value('email',$nomb_nom); ?>" type="text" class="form-control m-input" name="email" placeholder="Email">
														</div>
													</div>


													<div class="form-group m-form__group row">
														<label for="socio" class="col-2 col-form-label">
															Socio responsable
														</label>
														<div class="col-7">
															<?php 
																$nomb_nom='';
																if (isset($entidad->socio)) 
																 {	$nomb_nom = $entidad->socio;}
															?>
															<input value="<?php echo  set_value('socio',$nomb_nom); ?>" type="text" class="form-control m-input" name="socio" placeholder="socio (s)">
														</div>
													</div>




													<div class="form-group m-form__group row">
														<label for="id_perfil" class="col-md-2 control-label">Tipo de entidad</label>
														<div class="col-7">
																<select name="id_tipo_entidad" id="id_tipo_entidad" class="form-control">
																	<?php foreach ( $tipos_entidades as $tipo_entidad ){ ?>
																		<?php 
																		   if  ($entidad->id_tipo_entidad==$tipo_entidad->id)
																			 {$seleccionado='selected';} else {$seleccionado='';}
																		?>
																		<option value="<?php echo $tipo_entidad->id; ?>" <?php echo $seleccionado; ?> ><?php echo $tipo_entidad->nombre; ?></option>
																	<?php } ?>
																</select>
														</div>
													</div>






													<!--2do bloque de campo -->
													<div class="m-form__seperator m-form__seperator--dashed m-form__seperator--space-2x"></div>
													<div class="form-group m-form__group row">
														<div class="col-10 ml-auto">
															<h3 class="m-form__section">
																2. Usuario(s) Asociado(s)
															</h3>
														</div>

														<div class="col-10 ml-auto">
														<select class="selectpicker  multiples_usuarios" multiple title="Seleccionar..." data-style="btn-info" data-actions-box="true" >  

															<?php foreach ( $losusuarios as $user ){ ?>
																
																<?php 
																   if  ( in_array($user->id ,  $usuarios_asociados  ) )
																	 {$seleccionado='selected';} else {$seleccionado='';}
																?>
																	<option  value="<?php echo $user->id; ?>" <?php echo $seleccionado; ?>
																	<?php echo ( $user->habilita ? 'disabled' : ''); ?> ><?php echo $user->nombre; ?></option>
																
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