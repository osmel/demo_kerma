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
      	$retorno ="/kerma/usuarios";
    }

?>



<div class="m-grid__item m-grid__item--fluid m-wrapper">
    <!-- BEGIN: Subheader -->
    <div class="m-subheader div-status">
      <div class="d-flex align-items-center">
        <div class="mr-auto">
          <h3 class="m-subheader__title ">Administrador de usuarios</h3>
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
							<a href="<?php echo base_url(); ?>usuarios" type="button" class="btn btn-block">Catálogo de Usuarios</a>
						</div>

						<div class="col-3 item-m2-socios item-m2-socios">
							<a href="<?php echo base_url(); ?>historico_accesos" type="button" class="btn btn-block">Histórico de accesos</a>
						</div>


				          <div class="col-3 item-m2-socios item-m2-socios">
									<a href="<?php echo base_url(); ?>nuevo_usuario" type="button" class="btn btn-block">Nuevo usuario</a>
				          </div>
		        </div>
	        <!--FIN Menu admin-->
	      </div>
	      <!--catalogo usuarios-->


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
													<img src="/kerma/metronic/dist/default/assets/app/media/img/users/user4.jpg" alt=""/>
												</div>
											</div>
											<div class="m-card-profile__details">
												<span class="m-card-profile__name">
													<?php echo $this->session->userdata('nombre_completo'); ?>
												</span>
												<a href="" class="m-card-profile__email m-link">
													<?php echo $this->session->userdata('email'); ?>
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
															<!-- <span class="m-nav__link-badge">
																<span class="m-badge m-badge--success">
																	2
																</span>
															</span> -->
														</span>
													</span>
												</a>
											</li>
											<!-- <li class="m-nav__item">
												<a href="#" class="m-nav__link">
													<i class="m-nav__link-icon flaticon-share"></i>
													<span class="m-nav__link-text">
														Actividades
													</span>
												</a>
											</li>
											<li class="m-nav__item">
												<a href="#" class="m-nav__link">
													<i class="m-nav__link-icon flaticon-chat-1"></i>
													<span class="m-nav__link-text">
														Mensajes
													</span>
												</a>
											</li>
											<li class="m-nav__item">
												<a href="#" class="m-nav__link">
													<i class="m-nav__link-icon flaticon-graphic-2"></i>
													<span class="m-nav__link-text">
														Graficos
													</span>
												</a>
											</li>
											<li class="m-nav__item">
												<a href="#" class="m-nav__link">
													<i class="m-nav__link-icon flaticon-time-3"></i>
													<span class="m-nav__link-text">
														Eventos
													</span>
												</a>
											</li> -->

										</ul>
										<div class="m-portlet__body-separator"></div>
										<!-- <div class="m-widget1 m-widget1--paddingless">
											<div class="m-widget1__item">
												<div class="row m-row--no-padding align-items-center">
													<div class="col">
														<h3 class="m-widget1__title">
															Member Profit
														</h3>
														<span class="m-widget1__desc">
															Awerage Weekly Profit
														</span>
													</div>
													<div class="col m--align-right">
														<span class="m-widget1__number m--font-brand">
															+$17,800
														</span>
													</div>
												</div>
											</div>
											<div class="m-widget1__item">
												<div class="row m-row--no-padding align-items-center">
													<div class="col">
														<h3 class="m-widget1__title">
															Orders
														</h3>
														<span class="m-widget1__desc">
															Weekly Customer Orders
														</span>
													</div>
													<div class="col m--align-right">
														<span class="m-widget1__number m--font-danger">
															+1,800
														</span>
													</div>
												</div>
											</div>
											<div class="m-widget1__item">
												<div class="row m-row--no-padding align-items-center">
													<div class="col">
														<h3 class="m-widget1__title">
															Issue Reports
														</h3>
														<span class="m-widget1__desc">
															System bugs and issues
														</span>
													</div>
													<div class="col m--align-right">
														<span class="m-widget1__number m--font-success">
															-27,49%
														</span>
													</div>
												</div>
											</div>
										</div> -->
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
													<a class="nav-link m-tabs__link active" data-toggle="tab" href="#tab_actualizar_perfil" role="tab">
														<i class="flaticon-share m--hide"></i>
														Actualizar Perfil
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
										<!-- Tab de Acualizar Perfil -->
										<div class="tab-pane active" id="tab_actualizar_perfil">

											 <!--declara formulario -->
												 <?php $attr = array('class' => 'form-horizontal m-form m-form--fit m-form--label-align-right', 'id'=>'form_usuarios','name'=>$retorno,'method'=>'POST','autocomplete'=>'off','role'=>'form');
												 echo form_open('validar_nuevo_usuario', $attr);
												?>

												<div class="m-portlet__body">
													<div class="form-group m-form__group row">
														<div class="col-10 ml-auto">
															<h3 class="m-form__section">
																1. Detalle Personal
															</h3>
														</div>
													</div>
													<!--1er bloque de campo -->
													<div class="form-group m-form__group row">
														<label for="nombre" class="col-2 col-form-label">
															Nombre
														</label>
														<div class="col-7">
															<input type="text" class="form-control m-input" id="nombre" name="nombre" placeholder="Nombre">
														</div>
													</div>
													<div class="form-group m-form__group row">
														<label for="apellidos" class="col-2 col-form-label">
															Apellido(s)
														</label>
														<div class="col-7">
															<input type="text" class="form-control" id="apellidos" name="apellidos" placeholder="Apellido (s)">
														</div>
													</div>

													<div class="form-group m-form__group row">
														<label for="email" class="col-2 col-form-label">
															Email
														</label>
														<div class="col-7">
															<input type="email" class="form-control" id="email" name="email" placeholder="Email">
														</div>
													</div>

													<div class="form-group m-form__group row">
														<label for="telefono" class="col-2 col-form-label">
															Número Teléfono
														</label>
														<div class="col-7">
															<input type="text" class="form-control" id="telefono" name="telefono" placeholder="Número Teléfono">
														</div>
													</div>

												



													<div class="form-group m-form__group row">
														<label for="pass_1" class="col-2 col-form-label">
															Contraseña
														</label>
														<div class="col-7">
															<input type="password" class="form-control" id="pass_1" name="pass_1" placeholder="Contraseña">
														</div>
													</div>


													<div class="form-group m-form__group row">
														<label for="pass_2" class="col-2 col-form-label">
															Confirmar Contraseña
														</label>
														<div class="col-7">
															<input type="password" class="form-control" id="pass_2" name="pass_2" placeholder="Confirmar Contraseña">
														</div>
													</div>





													<div class="form-group m-form__group row">
														<label for="id_perfil" class="col-md-2 control-label">Rol de usuario</label>
														<div class="col-7">
															 
																	<select name="id_perfil" id="id_perfil" class="form-control">
																		<!--<option value="0">Selecciona una opción</option>-->
																			<?php foreach ( $perfiles as $perfil ){ ?>
																					<option value="<?php echo $perfil->id_perfil; ?>"><?php echo $perfil->perfil; ?></option>
																			<?php } ?>
																			<!--rol de usuario -->
																	</select>
														    
														</div>
													</div>






													<!--2do bloque de campo -->
													<div class="m-form__seperator m-form__seperator--dashed m-form__seperator--space-2x"></div>
													<div class="form-group m-form__group row">
														<div class="col-10 ml-auto">
															<h3 class="m-form__section">
																2. Entidad(es) Asociada(s)
															</h3>
														</div>

														<div class="col-10 ml-auto">
														<select class="selectpicker  multiples_empresas" multiple title="Seleccionar..." data-style="btn-info" data-actions-box="true" >  
															<?php foreach ( $empresas as $empresa ){ ?>
																<?php //if ( $this->session->userdata( 'id_perfil' ) == $perfil->id_perfil ){ ?>
																	<option value="<?php echo $empresa->id; ?>"><?php echo $empresa->nombre; ?></option>
																<?php //} ?>
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
																	<input style="padding:8px;" type="submit" class="btn btn-replicar-info btn-block" value="Guardar"/>
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