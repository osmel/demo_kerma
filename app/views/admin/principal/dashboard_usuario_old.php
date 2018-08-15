<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $this->load->view( 'header' ); ?>
<?php $this->load->view( 'aside-menu.php' ); ?>



<div class="m-grid__item m-grid__item--fluid m-wrapper">
					<!-- BEGIN: Subheader -->
					<div class="m-subheader div-status">
						<div class="d-flex align-items-center">
							<div class="mr-auto">
								<h3 class="m-subheader__title ">Estatus general de registro de información</h3>
								<h5>Nombre de la firma</h5>
							</div>
							<div class="porcentaje">
								<h3 class="m-subheader__title">80%</h3>
							</div>
						</div>
						<div class="progress m-progress--sm">
							<div class="progress-bar m--bg-brand" role="progressbar" style="width: 80%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
						</div>
					</div>
					<!-- END: Subheader -->
					<div class="m-content">
						<div class="row titulo-contenido">
							<div class="col-md-8 col-lg-8 col-xl-8">
								<h4>Estatus por categoría</h4>
							</div>
							<!--Dropdonw año-->
							<div class="col-md-2 col-lg-2 col-xl-2">
								<p>Año:</p>
								<div class="dropdown drop-socios">
		              <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		                Seleccionar
		              </button>
		              <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
		                <button class="dropdown-item" type="button">Action</button>
		                <button class="dropdown-item" type="button">Another action</button>
		                <button class="dropdown-item" type="button">Something else here</button>
		              </div>
		            </div>
							</div>
							<!--FIN dropdonw año-->
							<!--Dropdown periodo-->
							<div class="col-md-2 col-lg-2 col-xl-2">
								<p>Período:</p>
								<div class="dropdown drop-socios">
		              <button class="btn btn-secondary dropdown-toggle" type="button" id="dropdownMenu2" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
		                Seleccionar
		              </button>
		              <div class="dropdown-menu" aria-labelledby="dropdownMenu2">
		                <button class="dropdown-item" type="button">Action</button>
		                <button class="dropdown-item" type="button">Another action</button>
		                <button class="dropdown-item" type="button">Something else here</button>
		              </div>
		            </div>
							</div>
							<!--FIN dropdown periodo-->
						</div>


						<!--Cuadros categoría -->
						<div class="row">
						<?php foreach($categorias as $key=>$cat) { ?>
						
							<div class="col-md-4 col-lg-4 col-xl-4">
								<div class="contenido-cat m-widget24">
									<div class="m-widget24__item">
										<div class="row">
											<div class="col-3 icono-cat">
												<span class="fas <?php echo $cat['icono']; ?>"></span>
											</div>
											<div class="col-9 info-cat">
												<h5><?php  echo $cat['text']; ?></h5>
												<h4 class="completo">0%</h4>
												<p class="completo">Sin registros</p>
											</div>
										</div>
										<div class="progress m-progress--sm">
											<div class="progress-bar m--bg-brand" role="progressbar" style="width: 0%;" aria-valuenow="50" aria-valuemin="0" aria-valuemax="100"></div>
										</div>



										<hr>
										<div class="botones-cat row">
											<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
												<button type="button" name="button">Editar</button>
											</div>
											<div class="col-lg-6 col-md-6 col-sm-6 col-xs-12">
												<button class="completo-btn" type="button" name="button">Asignar</button>
											</div>
										</div>
									</div>
								</div>
							</div>
							
						
                        <?php }  ?>    
                        </div>
                        <!--FIN Cuadros categoría -->

						


					</div><!--FIN m-content-->
				</div> <!--FIN m-grid-->

<?php $this->load->view( 'footer' ); ?>