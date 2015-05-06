<?php
/* @var $this ApoderadoController */
/* @var $model Apoderado */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'apoderado-form',
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
		<?php echo $form->labelEx($model,'nombres'); ?>
		<?php echo $form->textField($model,'nombres',array('size'=>50,'maxlength'=>50)); ?>
		<?php echo $form->error($model,'nombres'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'direccion'); ?>
		<?php echo $form->textField($model,'direccion',array('size'=>60,'maxlength'=>100)); ?>
		<?php echo $form->error($model,'direccion'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'comuna'); ?>
		<?php echo $form->textField($model,'comuna',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'comuna'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'ciudad'); ?>
		<?php echo $form->textField($model,'ciudad',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'ciudad'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'region'); ?>
		<?php echo $form->textField($model,'region',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'region'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fono'); ?>
		<?php echo $form->textField($model,'fono',array('size'=>15,'maxlength'=>15)); ?>
		<?php echo $form->error($model,'fono'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'fonoComercial'); ?>
		<?php echo $form->textField($model,'fonoComercial',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'fonoComercial'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'email'); ?>
		<?php echo $form->textField($model,'email',array('size'=>25,'maxlength'=>25)); ?>
		<?php echo $form->error($model,'email'); ?>
	</div>

	<div class="row">
		<?php echo $form->labelEx($model,'difunto'); ?>
		<?php echo $form->textField($model,'difunto',array('size'=>2,'maxlength'=>2)); ?>
		<?php echo $form->error($model,'difunto'); ?>
	</div>

	<div class="row buttons">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Create' : 'Save'); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->