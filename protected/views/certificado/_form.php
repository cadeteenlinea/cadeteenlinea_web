<?php
/* @var $this CertificadoController */
/* @var $model Certificado */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'certificado-form',
	// Please note: When you enable ajax validation, make sure the corresponding
	// controller action is handling ajax validation correctly.
	// There is a call to performAjaxValidation() commented in generated controller code.
	// See class documentation of CActiveForm for details on this.
	'enableAjaxValidation'=>false,
)); ?>
        
        <div class="form-group">
            <b>Certificado de alumno regular: </b>
            <i>Certifica la calidad de ser alumno regular en la Escuela Naval "Arturo Prat".</i>
        </div>
    
	<div class="form-group">
		<?php echo $form->labelEx($model,'motivo_idmotivo', array('class'=>'control-label')); ?>
                <?php echo $form->dropDownList($model, 'motivo_idmotivo', Motivo::model()->getListMotivos(),
                        array('empty'=>'seleccione motivo', 'class'=>'form-control')); ?>
		<?php echo $form->error($model,'motivo_idmotivo', array('class'=>'alert alert-danger')); ?>
	</div>

	<div class="form-group">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Solicitar' : 'Solicitar', array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>

</div><!-- form -->