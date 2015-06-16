<?php
/* @var $this ArchivosController */
/* @var $data Archivos */
?>

<div class="view">

	<b><?php echo CHtml::encode($data->getAttributeLabel('idarchivos')); ?>:</b>
	<?php echo CHtml::link(CHtml::encode($data->idarchivos), array('view', 'id'=>$data->idarchivos)); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('fecha')); ?>:</b>
	<?php echo CHtml::encode($data->fecha); ?>
	<br />

	<b><?php echo CHtml::encode($data->getAttributeLabel('tipo_archivo_idtipo_archivo')); ?>:</b>
	<?php echo CHtml::encode($data->tipo_archivo_idtipo_archivo); ?>
	<br />


</div>