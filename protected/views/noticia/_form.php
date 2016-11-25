<?php
/* @var $this NoticiaController */
/* @var $model Noticia */
/* @var $form CActiveForm */
?>

<div class="form">

<?php $form=$this->beginWidget('CActiveForm', array(
	'id'=>'noticia-form',
	'enableAjaxValidation'=>false,
        'htmlOptions' => array(
            'enctype' => 'multipart/form-data',
        ),
)); ?>

    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="form-group">
		<?php echo $form->labelEx($model,'titulo', array('class'=>'control-label')); ?>
                <?php echo $form->textField($model,'titulo',array('size'=>45,'maxlength'=>45,'class'=>'form-control')) ?>
		<?php echo $form->error($model,'titulo', array('class'=>'alert alert-danger')); ?>
            </div>
	</div>
        <div class="col-lg-6 col-md-6 col-sm-6">
            <?php echo $form->labelEx($model,'tipo_usuario', array('class'=>'control-label')); ?>
            <?php echo $form->dropDownList($model, 'tipo_usuario', Noticia::model()->getTipoUsuarioNoticia(),
                      array('empty'=>'seleccione tipo usuario', 'class'=>'form-control')); ?>
            <?php echo $form->error($model,'tipo_usuario', array('class'=>'alert alert-danger')); ?>
        </div>
    </div>
	
    <div class="row">
        <div class="col-lg-12 col-md-12">
            <div class="form-group">
                <?php echo $form->labelEx($model,'cuerpo', array('class'=>'control-label')); ?>
                <?php echo $form->textArea($model,'cuerpo',array('rows'=>6, 'cols'=>50,'class'=>'form-control')) ?>
		<?php echo $form->error($model,'cuerpo', array('class'=>'alert alert-danger')); ?>
            </div>
        </div>
    </div>
    
    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="form-group">
		<?php echo $form->labelEx($model,'division', array('class'=>'control-label')); ?>
                <?php echo $form->dropDownList($model, 'division', Cadete::model()->getAllDivision(),
                        array('empty'=>'seleccione división', 'class'=>'form-control')); ?>
		<?php echo $form->error($model,'division', array('class'=>'alert alert-danger')); ?>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="form-group">
		<?php echo $form->labelEx($model,'curso', array('class'=>'control-label')); ?>
                <?php echo $form->dropDownList($model, 'curso', Cadete::model()->getAllCurso(),
                        array('empty'=>'seleccione curso', 'class'=>'form-control')); ?>
		<?php echo $form->error($model,'curso', array('class'=>'alert alert-danger')); ?>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="form-group">
		<?php echo $form->labelEx($model,'documento',array('class'=>'control-label')); ?>
                <?php echo CHtml::activeFileField($model, 'documento', array('class'=>'form-control')) ?>
                <?php echo $form->error($model,'documento',array('class'=>'alert alert-danger')); ?>
            </div>
        </div>
        <div class="col-lg-6 col-md-6 col-sm-6">
            <div class="form-group">
                <?php
                if($model->documento() != null){
                ?>
                <label class="control-label" for="Noticia_extension">Documento Actual</label><br/>
                <a href="<?php echo Yii::app()->createUrl('noticia/viewFile',array('id'=>$model->idnoticia)) ?>" title="<?php echo $model->titulo ?>" target="_blank"><image src="<?php echo $model->tipoDocumento(); ?>" /></a>
                <?php
                }
                ?> 
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-lg-12 col-md-12 col-sm-12">
            <div class="form-group">
		<?php echo CHtml::submitButton($model->isNewRecord ? 'Nuevo' : 'Guardar',array('class'=>'btn btn-primary pull-right')); ?>
            </div>
        </div>
    </div>


<?php $this->endWidget(); ?>

</div><!-- form -->