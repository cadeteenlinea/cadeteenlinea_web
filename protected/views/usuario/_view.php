<?php
/* @var $this UsuarioController */
/* @var $data Usuario */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('rut')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->rut), array('view', 'id'=>$data->rut)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('perfil_idperfil')); ?>:</b>
	<?php echo CHtml::encode($data->perfil_idperfil); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('password_2')); ?>:</b>
	<?php echo CHtml::encode($data->password_2); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('last_login')); ?>:</b>
	<?php echo CHtml::encode($data->last_login); ?>
	<br />


</div>