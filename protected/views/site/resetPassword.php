<div class="container">
    <div class="row">
        <div class="col-lg-4 col-md-3 col-sm-2"></div>
        
        <div class="col-lg-4 col-md-6 col-sm-8 ">
        
            <h3>Reiniciar Contraseña</h3>
            
        <?php $form=$this->beginWidget('CActiveForm', 
            array(
                'id'=>'usuario-form',
                'enableClientValidation'=>true,
                'clientOptions'=>array(
                'validateOnSubmit'=>true,
                ),
        )); ?>
        
        <div class="form-group">
            <?php echo $form->labelEx($model,'rut'); ?>
            <?php echo $form->textField($model,'rut',array('class'=>'form-control',)); ?>
            <?php echo $form->error($model,'rut',array('class'=>'alert alert-danger')); ?>
        </div>
        
        <div class="form-group">
            <?php echo $form->labelEx($model,'password'); ?>
            <?php echo $form->textField($model,'password',array('class'=>'form-control',)); ?>
            <?php echo $form->error($model,'password',array('class'=>'alert alert-danger')); ?>
        </div>
        
        <div class="form-group">
            <?php echo $form->labelEx($model,'passwordRepeat'); ?>
            <?php echo $form->textField($model,'passwordRepeat',array('class'=>'form-control',)); ?>
            <?php echo $form->error($model,'passwordRepeat',array('class'=>'alert alert-danger')); ?>
        </div>
        
        <div class="form-group">
            <?php echo $form->labelEx($model,'codVerificacion'); ?>
            <?php echo $form->textField($model,'codVerificacion',array('class'=>'form-control',)); ?>
            <?php echo $form->error($model,'codVerificacion',array('class'=>'alert alert-danger')); ?>
        </div>
        
        <div class="form-group">
            <?php echo CHtml::submitButton('Enviar',array('class'=>'btn btn-primary col-lg-12')); ?>
        </div>
        
        <?php $this->endWidget(); ?>
        </div>
        
        <div class="col-lg-4 col-md-3 col-sm-2"></div>
    </div>
</div>