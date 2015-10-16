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
                <th ></th>
                <th colspan="2" class="visible-xs text-center">1er.</th>
                <th colspan="2" class="visible-xs text-center">2do.</th>
                <th colspan="2" class="hidden-xs text-center">1er. Semestre</th>
                <th colspan="2" class="hidden-xs text-center">2do. Semestre</th>
            </tr>
            <tr>
                <th></th>
                <th >marca</th>
                <th >nota</th>
                <th >marca</th>
                <th >nota</th>
            </tr>
        </thead>
        
        <tr>
            <th>100 mts.</th>
            <td><?php if(!empty($semestre1)) echo $semestre1->marca_100_mt; ?></td>
            <td><?php if(!empty($semestre1)) echo $semestre1->nota_100_mt; ?></td>
            <td><?php if(!empty($semestre2)) echo $semestre2->marca_100_mt; ?></td>
            <td><?php if(!empty($semestre2)) echo $semestre2->nota_100_mt; ?></td>
        </tr>
        
        <tr>
            <th>1000 mts.</th>
            <td><?php if(!empty($semestre1)) echo $semestre1->marca_1000_mt; ?></td>
            <td><?php if(!empty($semestre1)) echo $semestre1->nota_1000_mt; ?></td>
            <td><?php if(!empty($semestre2)) echo $semestre2->marca_1000_mt; ?></td>
            <td><?php if(!empty($semestre2)) echo $semestre2->nota_1000_mt; ?></td>
        </tr>
        
        <tr>
            <th>Salto Largo</th>
            <td><?php if(!empty($semestre1)) echo $semestre1->marca_salto_largo; ?></td>
            <td><?php if(!empty($semestre1)) echo $semestre1->nota_salto_largo; ?></td>
            <td><?php if(!empty($semestre2)) echo $semestre2->marca_salto_largo; ?></td>
            <td><?php if(!empty($semestre2)) echo $semestre2->nota_salto_largo; ?></td>
        </tr>
        
        <tr>
            <th>Lanzamiento Bala</th>
            <td><?php if(!empty($semestre1)) echo $semestre1->marca_bala; ?></td>
            <td><?php if(!empty($semestre1)) echo $semestre1->nota_bala; ?></td>
            <td><?php if(!empty($semestre2)) echo $semestre2->marca_bala; ?></td>
            <td><?php if(!empty($semestre2)) echo $semestre2->nota_bala; ?></td>
        </tr>
        
        <tr>
            <th>100 mts. libres</th>
            <td><?php if(!empty($semestre1)) echo $semestre1->marca_100_libre; ?></td>
            <td><?php if(!empty($semestre1)) echo $semestre1->nota_100_libre; ?></td>
            <td><?php if(!empty($semestre2)) echo $semestre2->marca_100_libre; ?></td>
            <td><?php if(!empty($semestre2)) echo $semestre2->nota_100_libre; ?></td>
        </tr>
        
        <tr>
            <th>Bajo Agua</th>
            <td><?php if(!empty($semestre1)) echo $semestre1->marca_bajo_agua; ?></td>
            <td><?php if(!empty($semestre1)) echo $semestre1->nota_bajo_agua; ?></td>
            <td><?php if(!empty($semestre2)) echo $semestre2->marca_bajo_agua; ?></td>
            <td><?php if(!empty($semestre2)) echo $semestre2->nota_bajo_agua; ?></td>
        </tr>
        
        <tr>
            <th>Trepa</th>
            <td><?php if(!empty($semestre1)) echo $semestre1->marca_trepa; ?></td>
            <td><?php if(!empty($semestre1)) echo $semestre1->nota_trepa; ?></td>
            <td><?php if(!empty($semestre2)) echo $semestre2->marca_trepa; ?></td>
            <td><?php if(!empty($semestre2)) echo $semestre2->nota_trepa; ?></td>
        </tr>
        
        <tr>
            <th>Abdominales</th>
            <td><?php if(!empty($semestre1)) echo $semestre1->marca_abdominales; ?></td>
            <td><?php if(!empty($semestre1)) echo $semestre1->nota_abdominales; ?></td>
            <td><?php if(!empty($semestre2)) echo $semestre2->marca_abdominales; ?></td>
            <td><?php if(!empty($semestre2)) echo $semestre2->nota_abdominales; ?></td>
        </tr>
        
        <tr>
            <th>Extensión de Brazos</th>
            <td><?php if(!empty($semestre1)) echo $semestre1->marca_extension_brazos; ?></td>
            <td><?php if(!empty($semestre1)) echo $semestre1->nota_extension_brazos; ?></td>
            <td><?php if(!empty($semestre2)) echo $semestre2->marca_extension_brazos; ?></td>
            <td><?php if(!empty($semestre2)) echo $semestre2->nota_extension_brazos; ?></td>
        </tr>
        
        <tr>
            <th></th>
            <td>Prom.</td>
            <td><?php if(!empty($semestre1)) echo $semestre1->nota_final; ?></td>
            <td>Prom.</td>
            <td><?php if(!empty($semestre2)) echo $semestre2->nota_final; ?></td>
        </tr>
        
    </table>
    
</div>
