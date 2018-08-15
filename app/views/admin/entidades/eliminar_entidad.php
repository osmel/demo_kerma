<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed'); ?>

<?php $hidden = array('uid_retorno'=>$uid); 
	if (!isset($retorno)) {
      	$retorno ="/kerma/entidades";
    }
?>
<?php echo form_open('validar_eliminar_entidad', array('class' => 'form-horizontal', 'id' => 'form_entidades','name'=>$retorno, 'method' => 'POST', 'role' => 'form', 'autocomplete' => 'off' ) ,   $hidden ); ?>
	<div class="modal-header">
		<a class="close" data-dismiss="modal">&times;</a>
		<h3 class="text-left">Eliminar entidad</h3>
	</div>

	<div class="modal-body">
		<p>¿Estás seguro de que deseas eliminar al entidad <b><?php echo  $nombrecompleto ; ?></b>?</p>
		<p>Recuerde, este proceso es completamente irreversible.</p>
		<div class="alert" id="messagesModal"></div>
	</div>

	
	<div class="modal-footer">
		<button class="btn btn-danger" id="deleteUserSubmit">Aceptar</button>
		<button class="btn btn-default" data-dismiss="modal">Cancelar</button>
	</div>
	<input type="hidden" id="uid" name="uid" value="<?php echo $uid; ?>">
<?php echo form_close(); ?>