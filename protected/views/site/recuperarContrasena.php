
<div class="container">
<div class="row">
    <div class="col-lg-4 col-md-3 col-sm-2"></div>
    
    <div class="col-lg-4 col-md-6 col-sm-8 ">
    <h3>Recuperar Contraseña</h3>
    <?php $form=$this->beginWidget('CActiveForm', 
            array(
                'id'=>'recuperar-form',
                'enableClientValidation'=>true,
                'clientOptions'=>array(
                'validateOnSubmit'=>true,
                ),
            )); ?>

    <div class="form-group">
        <?php echo $form->labelEx($model,'rut'); ?>
        <?php echo $form->textField($model,'rut',array('class'=>'form-control', 'placeholder'=>'99888777-6')); ?>
        <?php echo $form->error($model,'rut',array('class'=>'alert alert-danger')); ?>
    </div>

    <div class="form-group">
        <?php echo CHtml::submitButton('Enviar',array('class'=>'btn btn-primary col-lg-12')); ?>
    </div>
    </div>

    <?php $this->endWidget(); ?>

<div class="col-lg-4 col-md-3 col-sm-2"></div>    
</div>
</div>

<?php $this->renderPartial('_message'); ?>
