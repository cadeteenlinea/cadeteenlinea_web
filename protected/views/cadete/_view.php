<?php
/* @var $this CadeteController */
/* @var $data Cadete */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('rut')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->rut), array('view', 'id'=>$data->rut)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nombre')); ?>:</b>
	<?php echo CHtml::encode($data->nombre); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('apellidoPat')); ?>:</b>
	<?php echo CHtml::encode($data->apellidoPat); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('apellidoMat')); ?>:</b>
	<?php echo CHtml::encode($data->apellidoMat); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('curso')); ?>:</b>
	<?php echo CHtml::encode($data->curso); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('nCadete')); ?>:</b>
	<?php echo CHtml::encode($data->nCadete); ?>
	<br />


</div>