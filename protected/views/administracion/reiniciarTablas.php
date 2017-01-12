<div class="row" style="margin-top: 10px;">
    <?php
        echo CHtml::ajaxSubmitButton(
            'Reiniciar Todo',
            Yii::app()->createUrl('administracion/reiniciarTablas'),
            array(
                'beforeSend'=>'function() {if(confirm("¿Quiere limpiar todas las tablas?")) return true; return false; }',
                'type'=>'POST',
                'data'=> 'js:{"id": "todo"}',                        
                'success'=>'js:function(string){ $("#todo").text(string) }'           
            ),
            array('class'=>'btn btn-danger btn-sm col-lg-2',));
    ?>
    <div class="col-lg-4">
        <p id="todo"></p>
    </div>
    
    <?php
        echo CHtml::ajaxSubmitButton(
            'Reiniciar Asignaturas',
            Yii::app()->createUrl('administracion/reiniciarTablas'),
            array(
                'beforeSend'=>'function() {if(confirm("¿Quiere limpiar todo lo relacionado con asignaturas?")) return true; return false; }',
                'type'=>'POST',
                'data'=> 'js:{"id": "asignatura"}',                        
                'success'=>'js:function(string){ $("#asignatura").text(string) }'              
            ),
            array('class'=>'btn btn-warning btn-sm col-lg-2',));
    ?>
    <div class="col-lg-4">
        <p id="asignatura"></p>
    </div>
</div>

<div class="row" style="margin-top: 10px;">
    <?php
        echo CHtml::ajaxSubmitButton(
            'Reiniciar Notas Parciales',
            Yii::app()->createUrl('administracion/reiniciarTablas'),
            array(
                'beforeSend'=>'function() {if(confirm("¿Quiere limpiar la tabla notas parciales?")) return true; return false; }',
                'type'=>'POST',
                'data'=> 'js:{"id": "notas_parciales"}',                        
                'success'=>'js:function(string){ $("#notas_parciales").text(string) }'          
            ),
            array('class'=>'btn btn-primary btn-sm col-lg-2',));
    ?>
    <div class="col-lg-4">
        <p id="notas_parciales"></p>
    </div>
    
    <?php
        echo CHtml::ajaxSubmitButton(
            'Reiniciar Notas Finales',
            Yii::app()->createUrl('administracion/reiniciarTablas'),
            array(
                'beforeSend'=>'function() {if(confirm("¿Quiere limpiar la tabla notas finales?")) return true; return false; }',
                'type'=>'POST',
                'data'=> 'js:{"id": "notas_finales"}',                        
                'success'=>'js:function(string){ $("#notas_finales").text(string) }'             
            ),
            array('class'=>'btn btn-primary btn-sm col-lg-2',));
    ?>
    <div class="col-lg-4">
        <p id="notas_finales"></p>
    </div>
</div>


<div class="row" style="margin-top: 10px;">
    <?php
        echo CHtml::ajaxSubmitButton(
            'Reiniciar Ingles TAE',
            Yii::app()->createUrl('administracion/reiniciarTablas'),
            array(
                'beforeSend'=>'function() {if(confirm("¿Quiere limpiar la tabla ingles TAE?")) return true; return false; }',
                'type'=>'POST',
                'data'=> 'js:{"id": "ingles_tae"}',                        
                'success'=>'js:function(string){ $("#ingles_tae").text(string) }'         
            ),
            array('class'=>'btn btn-primary btn-sm col-lg-2',));
    ?>
    <div class="col-lg-4">
        <p id="ingles_tae"></p>
    </div>
    
    <?php
        echo CHtml::ajaxSubmitButton(
            'Reiniciar Calificaciones',
            Yii::app()->createUrl('administracion/reiniciarTablas'),
            array(
                'beforeSend'=>'function() {if(confirm("¿Quiere limpiar la tabla calificaciones?")) return true; return false; }',
                'type'=>'POST',
                'data'=> 'js:{"id": "calificacion"}',                        
                'success'=>'js:function(string){ $("#calificaciones").text(string) }'          
            ),
            array('class'=>'btn btn-primary btn-sm col-lg-2',));
    ?>
    <div class="col-lg-4">
        <p id="calificaciones"></p>
    </div>
</div>


<div class="row" style="margin-top: 10px;">
    <?php
        echo CHtml::ajaxSubmitButton(
            'Reiniciar Notas Fisica',
            Yii::app()->createUrl('administracion/reiniciarTablas'),
            array(
                'beforeSend'=>'function() {if(confirm("¿Quiere limpiar las tablas de notas fisicas?")) return true; return false; }',
                'type'=>'POST',
                'data'=> 'js:{"id": "notas_fisica"}',                        
                'success'=>'js:function(string){ $("#notas_fisica").text(string) }'       
            ),
            array('class'=>'btn btn-primary btn-sm col-lg-2',));
    ?>
    <div class="col-lg-4">
        <p id="notas_fisica"></p>
    </div>
    
    <?php
        echo CHtml::ajaxSubmitButton(
            'Reiniciar Francos',
            Yii::app()->createUrl('administracion/reiniciarTablas'),
            array(
                'beforeSend'=>'function() {if(confirm("¿Quiere limpiar la tabla de francos?")) return true; return false; }',
                'type'=>'POST',
                'data'=> 'js:{"id": "francos"}',                        
                'success'=>'js:function(string){ $("#francos").text(string) }'    
            ),
            array('class'=>'btn btn-primary btn-sm col-lg-2',));
    ?>
    <div class="col-lg-4">
        <p id="francos"></p>
    </div>
</div>

<div class="row" style="margin-top: 10px;">
    <?php
        echo CHtml::ajaxSubmitButton(
            'Reiniciar Finanzas',
            Yii::app()->createUrl('administracion/reiniciarTablas'),
            array(
                'beforeSend'=>'function() {if(confirm("¿Quiere limpiar las tablas de finanzas?")) return true; return false; }',
                'type'=>'POST',
                'data'=> 'js:{"id": "finanzas"}',                        
                'success'=>'js:function(string){ $("#finanzas").text(string) }'       
            ),
            array('class'=>'btn btn-primary btn-sm col-lg-2',));
    ?>
    <div class="col-lg-4">
        <p id="finanzas"></p>
    </div>
   
</div>