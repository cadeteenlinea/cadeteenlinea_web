<div class="row" style="margin-top: 10px;">
    <div class="col-lg-6">
        <?php
        echo CHtml::ajaxSubmitButton(
                'Reiniciar Todo',
                Yii::app()->createUrl('administracion/reiniciarTablas'),
                array(
                    'type'=>'POST',
                    'data'=> 'js:{"id": "todo"}',                        
                    'success'=>'js:function(string){ $("todo").hmtl(string) }'           
                ),
                array('class'=>'btn btn-danger',));
        ?>
    </div>
    <div class="col-lg-6">
        <p id="todo"></p>
    </div>
</div>

<div class="row" style="margin-top: 10px;">
    <div class="col-lg-6">
        <?php
        echo CHtml::ajaxSubmitButton(
                'Reiniciar Asignaturas',
                Yii::app()->createUrl('administracion/reiniciarTablas'),
                array(
                    'type'=>'POST',
                    'data'=> 'js:{"id": "asignatura"}',                        
                    'success'=>'js:function(string){ alert(string); }'           
                ),
                array('class'=>'btn btn-warning',));
        ?>
    </div>
</div>

<div class="row" style="margin-top: 10px;">
    <div class="col-lg-6">
        <?php
        echo CHtml::ajaxSubmitButton(
                'Reiniciar Notas Parciales',
                Yii::app()->createUrl('administracion/reiniciarTablas'),
                array(
                    'type'=>'POST',
                        'data'=> 'js:{"id": "notas_parciales"}',                        
                    'success'=>'js:function(string){ alert(string); }'           
                ),
                array('class'=>'btn btn-primary',));
        ?>
    </div>
</div>

<div class="row" style="margin-top: 10px;">
    <div class="col-lg-6">
        <?php
        echo CHtml::ajaxSubmitButton(
                'Reiniciar Notas Finales',
                Yii::app()->createUrl('administracion/reiniciarTablas'),
                array(
                    'type'=>'POST',
                    'data'=> 'js:{"id": "notas_finales"}',                        
                    'success'=>'js:function(string){ alert(string); }'           
                ),
                array('class'=>'btn btn-primary',));
        ?>
    </div>
</div>

<div class="row" style="margin-top: 10px;">
    <div class="col-lg-6">
        <?php
        echo CHtml::ajaxSubmitButton(
                'Reiniciar Ingles TAE',
                Yii::app()->createUrl('administracion/reiniciarTablas'),
                array(
                    'type'=>'POST',
                    'data'=> 'js:{"id": "ingles_tae"}',                        
                    'success'=>'js:function(string){ alert(string); }'           
                ),
                array('class'=>'btn btn-primary',));
        ?>
    </div>
</div>

<div class="row" style="margin-top: 10px;">
    <div class="col-lg-6">
        <?php
        echo CHtml::ajaxSubmitButton(
                'Reiniciar Calificaciones',
                Yii::app()->createUrl('administracion/reiniciarTablas'),
                array(
                    'type'=>'POST',
                    'data'=> 'js:{"id": "calificacion"}',                        
                    'success'=>'js:function(string){ alert(string); }'           
                ),
                array('class'=>'btn btn-primary',));
        ?>
    </div>
</div>

<div class="row" style="margin-top: 10px;">
    <div class="col-lg-6">
        <?php
        echo CHtml::ajaxSubmitButton(
                'Reiniciar Notas Fisica',
                Yii::app()->createUrl('administracion/reiniciarTablas'),
                array(
                    'type'=>'POST',
                    'data'=> 'js:{"id": "notas_fisica"}',                        
                    'success'=>'js:function(string){ alert(string); }'           
                ),
                array('class'=>'btn btn-primary',));
        ?>
    </div>
</div>

<div class="row" style="margin-top: 10px;">
    <div class="col-lg-6">
        <?php
        echo CHtml::ajaxSubmitButton(
                'Reiniciar Francos',
                Yii::app()->createUrl('administracion/reiniciarTablas'),
                array(
                    'type'=>'POST',
                    'data'=> 'js:{"id": "francos"}',                        
                    'success'=>'js:function(string){ alert(string); }'           
                ),
                array('class'=>'btn btn-primary',));
        ?>
    </div>
</div>
