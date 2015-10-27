<h3><?php echo $titulo; ?></h3>

<div id="statusMsg">
<?php if(Yii::app()->user->hasFlash('success')):?>
    <div style="margin-top: 20px;" class="flash-success col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <?php echo Yii::app()->user->getFlash('success'); ?>
    </div>
<?php endif; ?>
 
<?php if(Yii::app()->user->hasFlash('error')):?>
    <div style="margin-top: 20px;" class="flash-error col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <?php echo Yii::app()->user->getFlash('error'); ?>
    </div>
<?php endif; ?>
</div>

<div class="form">
<?php $form=$this->beginWidget('CActiveForm', array(
        'id'=>'chnage-password-form',
	'enableClientValidation' => true,
        'clientOptions' => array(
            'validateOnSubmit' => true,
        ),
)); ?> 
 
  <div class="form-group">
      <?php echo $form->labelEx($model,'oldPassword',array('class'=>'control-label')); ?>
      <?php echo $form->passwordField($model,'oldPassword',array('class'=>'form-control')) ?>
      <?php echo $form->error($model,'oldPassword',array('class'=>'alert alert-danger')); ?>
  </div>
 
  <div class="form-group">
      <?php echo $form->labelEx($model,'newPassword',array('class'=>'control-label')); ?>
      <?php echo $form->passwordField($model,'newPassword',array('class'=>'form-control')) ?>
      <?php echo $form->error($model,'newPassword',array('class'=>'alert alert-danger')); ?>
  </div>
 
  <div class="form-group">
      <?php echo $form->labelEx($model,'repeatPassword',array('class'=>'control-label')); ?>
      <?php echo $form->passwordField($model,'repeatPassword',array('class'=>'form-control')) ?>
      <?php echo $form->error($model,'repeatPassword',array('class'=>'alert alert-danger')); ?>
  </div>
    
  <div class="form-group">
    <?php echo CHtml::submitButton('Cambiar Contraseña',array('class'=>'btn btn-primary')); ?>
  </div>

  <?php $this->endWidget(); ?>
</div>