<?php
/* @var $this NoticiaController */
/* @var $model Noticia */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'noticia-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>


	<div class="form-group">
		<?php echo $form->labelEx($model,'titulo', array('class'=>'control-label')); ?>
                <?php echo $form->textField($model,'titulo',array('size'=>45,'maxlength'=>45,'class'=>'form-control')) ?>
		<?php echo $form->error($model,'titulo', array('class'=>'alert alert-danger')); ?>
	</div>

	<div class="form-group">
		<?php echo $form->labelEx($model,'cuerpo', array('class'=>'control-label')); ?>
                <?php echo $form->textArea($model,'cuerpo',array('rows'=>6, 'cols'=>50,'class'=>'form-control')) ?>
		<?php echo $form->error($model,'cuerpo', array('class'=>'alert alert-danger')); ?>
	</div>

        
        <div class="form-group">
		<?php echo $form->labelEx($model,'tipoUsuario', array('class'=>'control-label')); ?>
                <?php echo $form->dropDownList($model, 'tipoUsuario', Noticia::model()->getTipoUsuarioNoticia(),
                        array('empty'=>'seleccione tipo usuario', 'class'=>'form-control')); ?>
		<?php echo $form->error($model,'tipoUsuario', array('class'=>'alert alert-danger')); ?>
	</div>
        
        
        <div class="form-group">
		<?php echo $form->labelEx($model,'division', array('class'=>'control-label')); ?>
                <?php echo $form->dropDownList($model, 'division', Cadete::model()->getAllDivision(),
                        array('empty'=>'seleccione división', 'class'=>'form-control')); ?>
		<?php echo $form->error($model,'division', array('class'=>'alert alert-danger')); ?>
	</div>
        
        
        <div class="form-group">
		<?php echo $form->labelEx($model,'curso', array('class'=>'control-label')); ?>
                <?php echo $form->dropDownList($model, 'curso', Cadete::model()->getAllCurso(),
                        array('empty'=>'seleccione curso', 'class'=>'form-control')); ?>
		<?php echo $form->error($model,'curso', array('class'=>'alert alert-danger')); ?>
	</div>
        
	<div class="form-group">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Nuevo' : 'Guardar',array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->