<?php
/* @var $this UsuarioController */
/* @var $model Usuario */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'usuario-form',
	'enableAjaxValidation'=>false,
)); ?>

    <div class="form-group">
        <?php echo $form->labelEx($model,'rut',array('class'=>'control-label')); ?>
	<?php echo $form->textField($model,'rut',array('size'=>10,'maxlength'=>10, 'class'=>'form-control',)) ?>
	<?php echo $form->error($model,'rut',array('class'=>'alert alert-danger')); ?>
    </div>
    
    <div class="form-group">
        <?php echo $form->labelEx($model,'apellidoPat',array('class'=>'control-label')); ?>
	<?php echo $form->textField($model,'apellidoPat',array('size'=>25,'maxlength'=>25, 'class'=>'form-control',)) ?>
	<?php echo $form->error($model,'apellidoPat',array('class'=>'alert alert-danger')); ?>
    </div>
    
    <div class="form-group">
        <?php echo $form->labelEx($model,'apellidoMat',array('class'=>'control-label')); ?>
	<?php echo $form->textField($model,'apellidoMat',array('size'=>25,'maxlength'=>25, 'class'=>'form-control',)) ?>
	<?php echo $form->error($model,'apellidoMat',array('class'=>'alert alert-danger')); ?>
    </div>
    
    <div class="form-group">
        <?php echo $form->labelEx($model,'nombres',array('class'=>'control-label')); ?>
	<?php echo $form->textField($model,'nombres',array('size'=>50,'maxlength'=>50, 'class'=>'form-control',)) ?>
	<?php echo $form->error($model,'nombres',array('class'=>'alert alert-danger')); ?>
    </div>
    
    <div class="form-group">
        <?php echo $form->labelEx($model,'password_2',array('class'=>'control-label')); ?>
	<?php echo $form->textField($model,'password_2',array('size'=>60,'maxlength'=>250, 'class'=>'form-control',)) ?>
	<?php echo $form->error($model,'password_2',array('class'=>'alert alert-danger')); ?>
    </div>
    
    <div class="form-group">
        <?php echo $form->labelEx($model,'perfil',array('class'=>'control-label')); ?>
	<?php echo $form->textField($model,'perfil',array('size'=>11,'maxlength'=>11, 'class'=>'form-control','disabled'=>'true','value'=>'funcionario')) ?>
	<?php echo $form->error($model,'perfil',array('class'=>'alert alert-danger')); ?>
    </div>
    
    <div class="form-group">
        <?php echo $form->labelEx($model,'email',array('class'=>'control-label')); ?>
	<?php echo $form->textField($model,'email',array('size'=>50,'maxlength'=>50, 'class'=>'form-control',)) ?>
	<?php echo $form->error($model,'email',array('class'=>'alert alert-danger')); ?>
    </div>
    
    <div class="form-group">
        <?php echo $form->labelEx($funcionario,'departamento_iddepartamento',array('class'=>'control-label')); ?>
	<?php echo $form->dropDownList($funcionario, 'departamento_iddepartamento', Departamento::listDepartamento(), array('class'=>'form-control',)) ?>
	<?php echo $form->error($funcionario,'departamento_iddepartamento',array('class'=>'alert alert-danger')); ?>
    </div>
    
    <div class="form-group">
        <?php echo $form->labelEx($funcionario,'tipo',array('class'=>'control-label')); ?>
	<?php echo $form->dropDownList($funcionario, 'tipo', Funcionario::getTipos(), array('class'=>'form-control',)) ?>
	<?php echo $form->error($funcionario,'tipo',array('class'=>'alert alert-danger')); ?>
    </div>


    <div class="row buttons">
	<?php echo CHtml::submitButton($model->isNewRecord ? 'Ingresar' : 'Guardar',array('class'=>'btn btn-primary')); ?>
    </div>

<?php $this->endWidget(); ?>

</div><!-- form -->