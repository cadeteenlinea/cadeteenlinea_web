<?php
$this->menu=array(
	array('label'=>'Datos Personales', 'url'=>array('datosPersonales')),
);
?>

<h1>Actualizar mis datos</h1>

<?php
/* @var $this UsuarioController */
/* @var $model Usuario */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'usuario-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>


	<div class="form-group">
		<?php echo $form->labelEx($model,'apellidoPat',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'apellidoPat',array('size'=>25,'maxlength'=>25, 'class'=>'form-control', 'disabled'=>'true')) ?>
		<?php echo $form->error($model,'apellidoPat',array('class'=>'alert alert-danger')); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'apellidoMat',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'apellidoMat',array('size'=>25,'maxlength'=>25, 'class'=>'form-control', 'disabled'=>'true')) ?>
		<?php echo $form->error($model,'apellidoMat',array('class'=>'alert alert-danger')); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'nombres',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'nombres',array('size'=>50,'maxlength'=>50, 'class'=>'form-control', 'disabled'=>'true')) ?>
		<?php echo $form->error($model,'nombres',array('class'=>'alert alert-danger')); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'email',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'email',array('size'=>25,'maxlength'=>25, 'class'=>'form-control')) ?>
		<?php echo $form->error($model,'email',array('class'=>'alert alert-danger')); ?>
	</div>

	<div class="form-group">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Ingresar' : 'Guardar',array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->