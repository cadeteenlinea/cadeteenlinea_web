<?php
/* @var $this ApoderadoController */
/* @var $data Apoderado */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('rut')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->rut), array('view', 'id'=>$data->rut)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('apellidoPat')); ?>:</b>
	<?php echo CHtml::encode($data->apellidoPat); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('apellidoMat')); ?>:</b>
	<?php echo CHtml::encode($data->apellidoMat); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nombres')); ?>:</b>
	<?php echo CHtml::encode($data->nombres); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('direccion')); ?>:</b>
	<?php echo CHtml::encode($data->direccion); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('comuna')); ?>:</b>
	<?php echo CHtml::encode($data->comuna); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('ciudad')); ?>:</b>
	<?php echo CHtml::encode($data->ciudad); ?>
	<br />

	<?php /*
	<b><?php echo CHtml::encode($data->getAttributeLabel('region')); ?>:</b>
	<?php echo CHtml::encode($data->region); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fono')); ?>:</b>
	<?php echo CHtml::encode($data->fono); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fonoComercial')); ?>:</b>
	<?php echo CHtml::encode($data->fonoComercial); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('email')); ?>:</b>
	<?php echo CHtml::encode($data->email); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('difunto')); ?>:</b>
	<?php echo CHtml::encode($data->difunto); ?>
	<br />

	*/ ?>

</div>