<h3><?php echo $titulo; ?></h3>

<div class="panel panel-default">
    <div class="panel-heading">
        <?php
            //print_r($anos);
            $form=$this->beginWidget('CActiveForm', array(
                'id'=>'ano-view',
                'htmlOptions'=>array(
                    'class'=>'pull-right',
                ),
                'enableAjaxValidation'=>false,));
                /*
                 *Despliega una list con los años con calificaciones
                 * variable $ano contiene el año seleccionado por el usuario
                 */
                echo CHtml::dropDownList('ano', 'ano', Calificaciones::model()->getListAno(Yii::app()->getSession()->get('rutCadete')),
                    array('class'=>'form-control pull-righ','style'=>'width:125px;','submit'=>Yii::app()->request->url,
                        'options'=> array($ano=>array('selected'=>'selected'))
             ));
            $this->endWidget();
        ?>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th></th>
                <th>1er. Semestre</th>
                <th>2do. Semestre</th>
            </tr>
        </thead>
        <tr>
            <th>Mando</th>
            <td><?php if(!empty($semestre1)) echo $semestre1->mando; ?></td>
            <td><?php if(!empty($semestre2)) echo $semestre2->mando; ?></td>
        </tr>
        <tr>
            <th>Interés Profesional</th>
            <td><?php if(!empty($semestre1)) echo $semestre1->interes_profesional; ?></td>
            <td><?php if(!empty($semestre2)) echo $semestre2->interes_profesional; ?></td>
        </tr>
        <tr>
            <th>Personalidad y Madurez</th>
            <td><?php if(!empty($semestre1)) echo $semestre1->personalidad_madurez; ?></td>
            <td><?php if(!empty($semestre2)) echo $semestre2->personalidad_madurez; ?></td>
        </tr>
        <tr>
            <th>Responsabilidad</th>
            <td><?php if(!empty($semestre1)) echo $semestre1->responsabilidad; ?></td>
            <td><?php if(!empty($semestre2)) echo $semestre2->responsabilidad; ?></td>
        </tr>
        <tr>
            <th>Espiritu Militar</th>
            <td><?php if(!empty($semestre1)) echo $semestre1->espiritu_militar; ?></td>
            <td><?php if(!empty($semestre2)) echo $semestre2->espiritu_militar; ?></td>
        </tr>
        <tr>
            <th>Cooperación</th>
            <td><?php if(!empty($semestre1)) echo $semestre1->cooperacion; ?></td>
            <td><?php if(!empty($semestre2)) echo $semestre2->cooperacion; ?></td>
        </tr>
        <tr>
            <th>Conducta</th>
            <td><?php if(!empty($semestre1)) echo $semestre1->conducta; ?></td>
            <td><?php if(!empty($semestre2)) echo $semestre2->conducta; ?></td>
        </tr>
        <tr>
            <th>Aptitud Física</th>
            <td><?php if(!empty($semestre1)) echo $semestre1->aptitud_fisica; ?></td>
            <td><?php if(!empty($semestre2)) echo $semestre2->aptitud_fisica; ?></td>
        </tr>
        <tr>
            <th>Tenida Orden y Aseo</th>
            <td><?php if(!empty($semestre1)) echo $semestre1->tenida_orden_aseo; ?></td>
            <td><?php if(!empty($semestre2)) echo $semestre2->tenida_orden_aseo; ?></td>
        </tr>
        <tr>
            <th>Nota Final</th>
            <th><?php if(!empty($semestre1)) echo $semestre1->final; ?></th>
            <th><?php if(!empty($semestre2)) echo $semestre2->final; ?></th>
        </tr>
    </table>
    
</div>
