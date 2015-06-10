<?php
/* @var $this ArchivosController */
/* @var $model Archivos */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'archivos-form',
	'htmlOptions' => array(
            'enctype' => 'multipart/form-data',
        ),
	'enableAjaxValidation'=>false,
)); ?>

	<div class="form-group">
		<?php echo $form->labelEx($model,'tipo_archivo_idtipo_archivo',array('class'=>'control-label')); ?>
		<?php echo $form->dropDownList($model, 'tipo_archivo_idtipo_archivo', TipoArchivo::model()->getListTipoArchivo(), array('empty'=>'Seleccione tipo de archivo', 'class'=>'form-control')) ?>
		<?php echo $form->error($model,'tipo_archivo_idtipo_archivo',array('class'=>'alert alert-danger')); ?>
	</div>
        
        <div class="form-group">
            <?php echo $form->labelEx($model,'archivo'); ?>
            <?php echo $form->fileField($model,'archivo'); ?>
            <?php echo $form->error($model,'archivo',array('class'=>'alert alert-danger')); ?>
        </div>

	<div class="form-group">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Ingresar' : 'Guardar',array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div>