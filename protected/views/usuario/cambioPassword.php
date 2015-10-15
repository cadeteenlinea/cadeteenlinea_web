<h3><?php echo $titulo; ?></h3>

<div class="panel panel-default">
    <div class="panel-heading">
        
        <?php $form=$this->beginWidget('CActiveForm', 
            array(
                'id'=>'change-password-form',
                'enableClientValidation'=>true,
                'clientOptions'=>array(
                'validateOnSubmit'=>true,
                ),
        )); ?>
        
        
    <div class="form-group">
        <?php echo $form->labelEx($model,'old_password'); ?> 
        <?php echo $form->passwordField($model,'old_password',array('class'=>'form-control',)); ?>
        <?php echo $form->error($model,'old_password',array('class'=>'alert alert-danger')); ?>
    </div>
 
    <div class="form-group">
        <?php echo $form->labelEx($model,'new_password'); ?> 
        <?php echo $form->passwordField($model,'new_password',array('class'=>'form-control',)); ?>
        <?php echo $form->error($model,'new_password',array('class'=>'alert alert-danger')); ?>
    </div>
 
    <div class="form-group">
        <?php echo $form->labelEx($model,'repeat_password'); ?> 
        <?php echo $form->passwordField($model,'repeat_password',array('class'=>'form-control',)); ?>
        <?php echo $form->error($model,'repeat_password',array('class'=>'alert alert-danger')); ?>
    </div>
 
    <div class="form-group">
        <?php echo CHtml::submitButton('Cambiar',array('class'=>'btn btn-primary col-lg-12')); ?>
    </div>
    <?php $this->endWidget(); ?>
</div>
</div>