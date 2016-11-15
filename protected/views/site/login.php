<?php
/* @var $this SiteController */
/* @var $model LoginForm */
/* @var $form CActiveForm  */

?>


    <div class="row">
        <h1 class="text-center">Iniciar sesión</h1>
        <hr class="separador_post"/>
        <?php 
        $form=$this->beginWidget('CActiveForm', array(
                'id'=>'login-form',
                'enableClientValidation'=>true,
                'clientOptions'=>array(
                        'validateOnSubmit'=>true,
                ),
        )); ?>

	<div class="form-group">
            <div class="input-group input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-user"></span></span>
		<?php echo $form->textField($model,'username',array('class'=>'form-control', 'placeholder'=>'rut de usuario')); ?>
            </div>
            <?php echo $form->error($model,'username',array('class'=>'alert alert-danger')); ?>
	</div>

	<div class="form-group">
            <div class="input-group input-group">
                <span class="input-group-addon"><span class="glyphicon glyphicon-lock"></span></span>
		<?php echo $form->passwordField($model,'password',array('class'=>'form-control', 'placeholder'=>'contraseña')); ?>
            </div>
            <?php echo $form->error($model,'password',array('class'=>'alert alert-danger')); ?>
	</div>

	<div class="form-group">
		<?php echo $form->checkBox($model,'rememberMe'); ?>
		<?php echo $form->label($model,'rememberMe',array('class'=>'control-label')); ?>
		<?php echo $form->error($model,'rememberMe',array('class'=>'alert alert-danger')); ?>
	</div>

	<div class="form-group">
		<?php echo CHtml::submitButton('Acceder',array('class'=>'btn btn-primary col-lg-12 col-md-12 col-sm-12 col-xs-12', 'id'=>'buttonLogin')); ?>
	</div>

        <?php $this->endWidget(); ?>
        
        <div class="text-center">
            <?php echo CHtml::link('¿Olvidaste tu contraseña?',array('site/recuperarContrasena')); ?>
        </div>

 </div>



<?php $this->renderPartial('_message'); ?>