<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $this->load->view( 'header' ); ?>
<?php $this->load->view( 'aside-menu.php' ); ?>



				
	
				<div class="osmel m-grid__item m-grid__item--fluid m-wrapper">

					<!-- BEGIN: Subheader -->
					<div class="m-subheader div-status">
						<div class="d-flex align-items-center">
							<div class="mr-auto">
								<h3 class="m-subheader__title ">Mi Perfil</h3>
								<h5>Datos, Estatus del Usuario</h5>
							</div>
							<div class="porcentaje">
								<h3 class="m-subheader__title">80%</h3>
							</div>
						</div>
						<div class="progress m-progress--sm">
							<div class="progress-bar m--bg-brand" role="progressbar" style="width: 80%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
						</div>
					</div>
				





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
												<a href="#" class="m-nav__link">
													<i class="m-nav__link-icon flaticon-profile-1"></i>
													<span class="m-nav__link-title">
														<span class="m-nav__link-wrap">
															<span class="m-nav__link-text">
																Mi Perfil
															</span>
															<span class="m-nav__link-badge">
																<span class="m-badge m-badge--success">
																	2
																</span>
															</span>
														</span>
													</span>
												</a>
											</li>
											<li class="m-nav__item">
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
											</li>
											
										</ul>
										<div class="m-portlet__body-separator"></div>
										<div class="m-widget1 m-widget1--paddingless">
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
										</div>
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
												<li class="nav-item m-tabs__item">
													<a class="nav-link m-tabs__link" data-toggle="tab" href="#tab_mensaje" role="tab">
														Mensajes
													</a>
												</li>
												<li class="nav-item m-tabs__item">
													<a class="nav-link m-tabs__link" data-toggle="tab" href="#tab_configuracion" role="tab">
														Configuración
													</a>
												</li>
											</ul>
										</div>
										
									</div>

									<!-- Tabulaciones -->
									<div class="tab-content">
										<!-- Tab de Acualizar Perfil -->
										<div class="tab-pane active" id="tab_actualizar_perfil">
											
											<form class="m-form m-form--fit m-form--label-align-right"> <!--declara formulario -->
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
														<label for="example-text-input" class="col-2 col-form-label">
															Nombre
														</label>
														<div class="col-7">
															<input class="form-control m-input" type="text" value="Mark Andre">
														</div>
													</div>
													<div class="form-group m-form__group row">
														<label for="example-text-input" class="col-2 col-form-label">
															Apellidos
														</label>
														<div class="col-7">
															<input class="form-control m-input" type="text" value="Mark Andre">
														</div>
													</div>


													<div class="form-group m-form__group row">
														<label for="example-text-input" class="col-2 col-form-label">
															Ocupación
														</label>
														<div class="col-7">
															<input class="form-control m-input" type="text" value="CTO">
														</div>
													</div>
													<div class="form-group m-form__group row">
														<label for="example-text-input" class="col-2 col-form-label">
															Compañia
														</label>
														<div class="col-7">
															<input class="form-control m-input" type="text" value="Keenthemes">
														</div>
													</div>

													<div class="form-group m-form__group row">
														<label for="example-text-input" class="col-2 col-form-label">
															Teléfono
														</label>
														<div class="col-7">
															<input class="form-control m-input" type="text" value="+456669067890">
														</div>
													</div>

													<div class="form-group m-form__group row">
														<label for="example-text-input" class="col-2 col-form-label">
															Dirección
														</label>
														<div class="col-7">
															<input class="form-control m-input" type="text" value="L-12-20 Vertex, Cybersquare">
														</div>
													</div>

													<!--2do bloque de campo -->
													<div class="m-form__seperator m-form__seperator--dashed m-form__seperator--space-2x"></div>
													<div class="form-group m-form__group row">
														<div class="col-10 ml-auto">
															<h3 class="m-form__section">
																2. Permisos
															</h3>
														</div>
													</div>
													
													<div class="form-group m-form__group row">
														<label for="example-text-input" class="col-2 col-form-label">
															uno
														</label>
														<div class="col-7">
															<input class="form-control m-input" type="text" value="San Francisco">
														</div>
													</div>
													
													
												</div>

												<!-- Botones de salvar y cancelar -->
												<div class="m-portlet__foot m-portlet__foot--fit">
													<div class="m-form__actions">
														<div class="row">
															<div class="col-2"></div>
															<div class="col-7">
																<button type="reset" class="btn btn-accent m-btn m-btn--air m-btn--custom">
																	Save changes
																</button>
																&nbsp;&nbsp;
																<button type="reset" class="btn btn-secondary m-btn m-btn--air m-btn--custom">
																	Cancel
																</button>
															</div>
														</div>
													</div>
												</div>


											</form>  <!--FIn declara formulario -->
										</div>

										<!-- Tab de Acualizar Perfil -->
										<div class="tab-pane " id="tab_mensaje"></div>
										<div class="tab-pane " id="tab_configuracion"></div>
									</div>


								</div>
							</div> <!-- Fin 2da Columna -->


						</div>
					</div> <!-- Fin del Contenido -->

				</div>

<?php $this->load->view( 'footer' ); ?>