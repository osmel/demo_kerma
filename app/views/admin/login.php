<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>
<?php $this->load->view( 'admin/header' ); ?>
 
<style type="text/css">
	body
	{
		background-image: url(<?php echo base_url(); ?>img/bg-login.jpg);
		background-repeat: no-repeat;
		background-size: cover;
	}
	#bar_salir
	{
		display: none;
	}
	.welcome-header
	{
		display: none;
	}
</style>
	<div class="container">
		<div class="row">
			<h3 class="text-center"><strong><?php echo $this->session->userdata('c2'); ?></strong></h3>
		</div>
		<br>
		<br>
		<div class="row">
			<div class="col-md-3"></div>
			<div class="col-md-6">				
				
				<div class="formulario-fondos">
					<div class="col-md-12 logo">
						<!-- <img src="<?php echo $this->session->userdata('c4'); ?>"> -->
						<img src="<?php echo base_url(); ?>img/logo-login.png">
					</div>

					<?php
 					 $attr = array( 'id' => 'form_login','name'=>'form_login', 'class' => 'form-horizontal', 'method' => 'POST', 'autocomplete' => 'off', 'role' => 'form' );
					 echo form_open('validar_login', $attr);
					?>
						<div class="form-group">
							
							<div class="col-md-12">
								<hr>
								<input type="email" class="form-control" id="email" name="email" placeholder="Usuario">
							</div>
						</div>
						<div class="form-group">
							<div class="col-md-12">
								<input type="password" class="form-control" id="contrasena" name="contrasena" placeholder="Contraseña">
								
								<hr>
							</div>
							
						</div>
						<div class="form-group">

							<div class="col-md-8">
								<a style="color: #999999" href="<?php echo base_url(); ?>recuperar_contrasena">¿Olvidaste tu contraseña?</a>
							</div>

							<div class="col-md-4">								
								<button style="background: #af204e !important; border: none; border-radius: 30px" type="submit" class="btn btn-primary col-md-12 btn-block">INGRESAR <i class="glyphicon glyphicon-log-in"></i></button>
							</div>
						</div>
					<?php echo form_close(); ?>
				</div>
			</div>
			<div class="col-md-3"></div>
		</div>
	</div>
<?php $this->load->view( 'admin/footer' ); ?>