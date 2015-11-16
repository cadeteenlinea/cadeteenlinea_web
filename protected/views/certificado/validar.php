<h1>Validación de Certificado</h1>
<?php 
if(!$validacion){
?>
<p>Para validar un Certificado, ingrese los siguientes datos y haz click en "Validar"</p>


<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'certificado-form',
	'enableClientValidation'=>true,
        'method' => 'get',
        'clientOptions'=>array(
            'validateOnSubmit'=>true,
        ),
)); ?>

        <div class="form-group">
		<?php echo $form->labelEx($model,'idcertificado',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'idcertificado',array('class'=>'form-control')) ?>
		<?php echo $form->error($model,'idcertificado',array('class'=>'alert alert-danger')); ?>
	</div>

        <div class="form-group">
		<?php echo $form->labelEx($model,'cadete_rut',array('class'=>'control-label')); ?>
		<?php echo $form->textField($model,'cadete_rut',array('class'=>'form-control')) ?>
		<?php echo $form->error($model,'cadete_rut',array('class'=>'alert alert-danger')); ?>
	</div>


	<div class="form-group">
		<?php echo CHtml::submitButton('Validar', array('class'=>'btn btn-primary')); ?>
	</div>

<?php $this->endWidget(); ?>


<?php if(Yii::app()->user->hasFlash('error')):?>
    <div style="margin-top: 20px;" class="flash-error col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <?php echo Yii::app()->user->getFlash('error'); ?>
    </div>
<?php endif; ?>

<?php }else{?>

    <?php if(!$model->validacion()){ ?>
        <div style="margin-top: 20px;" class="flash-error col-lg-12 col-md-12 col-sm-12 col-xs-12">
            Este Certificado tuvo vigencia hasta <b><?php echo $model->fecha_vencimiento; ?></b>, 
            por lo que se considera <b>fuera de vigencia.
            Se recomienda obtener un nuevo certificado, para garantizar la entrega de la 
            información más reciente disponible</b>
        </div>
    <?php }else{ ?>
        <div style="margin-top: 20px;" class="flash-success col-lg-12 col-md-12 col-sm-12 col-xs-12">
            Este certificado tiene vigencía hasta <b><?php echo $model->fecha_vencimiento; ?></b>
        </div>
    <?php } ?>
<?php } ?>