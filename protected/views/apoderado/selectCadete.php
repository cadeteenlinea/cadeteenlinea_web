
<style>
    p{
        padding: 0px;
        margin: 0px;
    }
</style>

<h2>Seleccione Cadete</h2>
<?php  ?>
<br/>

<div class="row">
    <?php 
        if(Yii::app()->getSession()->get('tipoFuncionario')=='Oficial' || Yii::app()->getSession()->get('tipoFuncionario')=='Administrador'){
        $form=$this->beginWidget('CActiveForm', array(
            'id'=>'cadete-form',
            'enableAjaxValidation'=>false,
            'enableClientValidation' => true,
            'clientOptions' => array(
                'validateOnSubmit' => true,
            ),
            'htmlOptions'=>array(
                'onsubmit'=>'
                    str = $("#cadete-form").serialize() + "&ajax=cadete-form";
                    $.ajax({
                        type: "POST",
                        url: "' . Yii::app()->createUrl('apoderado/listaCadetes/') . '",
                        data: str,
                        success: function(data) {
                            $("#lista_cadetes").html(data);
                        },
                    });
                    return false;
                ',
            )
    )); ?>

        <div class="col-lg-2 col-md-4 col-sm-4 col-xs-12">
            <?php echo $form->textField($filtro,'nCadete',array('size'=>10,'maxlength'=>4, 'class'=>'form-control', 'placeholder'=>'N° cadete')) ?>
        </div> 
        <div class="col-lg-4 col-md-4 col-sm-6 col-xs-12">
            <?php echo $form->textField($filtro,'seleccion',array('size'=>10,'maxlength'=>10, 'class'=>'form-control', 'placeholder'=>'Apellido Paterno')) ?>
        </div> 
        <div class="col-lg-2 col-md-2 col-sm-2 col-xs-12">
            <?php echo CHtml::submitButton('buscar', array('class'=>'btn btn-primary')); ?>
        </div>
            

    <?php 
        $this->endWidget(); 
        }
    ?>
</div>

<br/>

<div id="lista_cadetes">
    <?php $this->renderPartial('_listaCadetes', array('cadetes'=>$cadetes)); ?>
</div>

