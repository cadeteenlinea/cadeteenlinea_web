<?php
/* @var $this CadeteController */
/* @var $model Cadete */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'cadete-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>

	<p class="note">Fields with <span class="required">*</span> are required.</p>

	<?php echo $form->errorSummary($model); ?>

	<div class="row">
		<?php echo $form->labelEx($model,'rut'); ?>
		<?php echo $form->textField($model,'rut',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'rut'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nombre'); ?>
		<?php echo $form->textField($model,'nombre',array('size'=>60,'maxlength'=>75)); ?>
		<?php echo $form->error($model,'nombre'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'apellidoPat'); ?>
		<?php echo $form->textField($model,'apellidoPat',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'apellidoPat'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'apellidoMat'); ?>
		<?php echo $form->textField($model,'apellidoMat',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'apellidoMat'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'curso'); ?>
		<?php echo $form->textField($model,'curso',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'curso'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'nCadete'); ?>
		<?php echo $form->textField($model,'nCadete',array('size'=>10,'maxlength'=>10)); ?>
		<?php echo $form->error($model,'nCadete'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->