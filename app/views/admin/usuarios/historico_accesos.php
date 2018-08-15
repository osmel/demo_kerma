<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $this->load->view( 'header' ); ?>
<?php $this->load->view( 'aside-menu.php' ); ?>

	<?php
	 	if (!isset($retorno)) {
	      	$retorno ="/kerma/usuarios"; //admin
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

		  <div class="container-fluid">


				<div class="row">

					<br>
					<div class="col-xs-12 col-sm-12 col-md-12 marginbuttom">
						<div class="col-xs-12 col-sm-12 col-md-12"><h4>Histórico de accesos</h4></div>
					</div>

				</div>
				<br>
				<div class="col-12">
					<div class="panel panel-primary">
						<div class="panel-heading"></div>
						<div class="panel-body" style="margin-bottom: 30px;">
						<div >

							<div class="table-responsive">
								<div class="col-lg-12">
									<div class="row">
										<div class="col-md-4 offset-md-8" style="padding-bottom: 15px;">
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
								</div>


							<div class="tabla_historico_acceso"></div>
								<!--<section>
									<table id="tabla_acceso_usuario" class="display table table-striped table-bordered table-responsive" cellspacing="0" width="100%">
										<thead>
											<tr>
												<th class="text-center cursora" width="50%">Usuario</th>
												<th class="text-center cursora" width="10%">Perfil </th>
												<th class="text-center cursora" width="10%">Email </th>
												<th class="text-center " width="10%"><strong>Acceso</strong></th>
												<th class="text-center " width="10%"><strong>Dirección IP</strong></th>
												<th class="text-center " width="10%"><strong>Navegador</strong></th>
											</tr>
										</thead>
									</table>
								</section>
								-->
							</div>
						</div>
					</div>
					</div>

					<div class="row">

						<div class="col-sm-8 col-md-9"></div>
						<div class="col-sm-4 col-md-3">
							<a href="<?php echo $retorno; ?>" class="blanco-btn btn"><i class="fas fa-backward"></i> Regresar</a>
						</div>

					</div>
					<br/>
			</div>




		  </div><!--FIN m-content-->
	</div> <!--FIN m-grid-->
</div> <!--FIN m-grid-->

<!-- end:: m-body -->


<?php $this->load->view('footer'); ?>


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
