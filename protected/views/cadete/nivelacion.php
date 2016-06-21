<h3><?php echo $titulo; ?></h3>

<div class="panel panel-default">
    <div class="panel-heading">
        <div class="btn-group" role="group" aria-label="...">
        <?php
            //print_r($anos);
            $form=$this->beginWidget('CActiveForm', array(
                'id'=>'ano-view',
                'htmlOptions'=>array(
                    'class'=>'pull-right',
                    'style'=>'width: 500px;'
                ),
                'enableAjaxValidation'=>false,));
                /*
                 *Despliega una list con los años con calificaciones
                 * variable $ano contiene el año seleccionado por el usuario
                 */
            ?>
            
            <div class="col-lg-4 col-md-4">
                <label style="width: 70px;">Año</label>
                <?php
                echo CHtml::dropDownList('ano', 'ano', Nivelacion::model()->getListAno(Yii::app()->getSession()->get('rutCadete')),
                    array('class'=>'btn btn-default','style'=>'width:125px;','submit'=>Yii::app()->request->url,
                        'options'=> array($ano=>array('selected'=>'selected'))
                ));
                ?>
            </div>
            
            <div class="col-lg-4 col-md-4">
                <label style="width: 70px;">Semestre</label>
                <?php
                echo CHtml::dropDownList('semestre', 'semestre', Nivelacion::model()->getListAnoSemestre(Yii::app()->getSession()->get('rutCadete'), $ano),
                    array('class'=>'btn btn-default','style'=>'width:125px;','submit'=>Yii::app()->request->url,
                        'options'=> array($semestre=>array('selected'=>'selected'))
                ));
                ?>
            </div>  
            <div class="col-lg-4 col-md-4">  
                <label style="width: 70px;">Etapa</label>
                <?php
                echo CHtml::dropDownList('etapa', 'etapa', Nivelacion::model()->getListAnoSemestreEtapa(Yii::app()->getSession()->get('rutCadete'), $ano, $semestre),
                    array('class'=>'btn btn-default','style'=>'width:125px;','submit'=>Yii::app()->request->url,
                        'options'=> array($etapa=>array('selected'=>'selected'))
                ));
                ?>
            </div>    
            <?php   
            $this->endWidget();
        ?>
        </div>
    </div>
    <table class="table">
        <thead>
            <tr>
                <th colspan="3" class="text-center">Atletismo</th>
            </tr>
            <tr>
                <th></th>
                <th>marca</th>
                <th>nota</th>
            </tr>
        </thead>
        <tr>
            <td>100 mts.</td>
            <td><?php if(!empty($resultado)) echo $resultado->marca_100_mt; ?></td>
            <td><?php if(!empty($resultado)) echo $resultado->nota_100_mt; ?></td>
        </tr>
        <tr>
            <td>1000 mts.</td>
            <td><?php if(!empty($resultado)) echo $resultado->marca_1000_mt; ?></td>
            <td><?php if(!empty($resultado)) echo $resultado->nota_1000_mt; ?></td>
        </tr>
        <tr>
            <td>Salto Largo</td>
            <td><?php if(!empty($resultado)) echo $resultado->marca_salto_largo; ?></td>
            <td><?php if(!empty($resultado)) echo $resultado->nota_salto_largo; ?></td>
        </tr>
        <tr>
            <td>Lanzamiento Bala</td>
            <td><?php if(!empty($resultado)) echo $resultado->marca_bala; ?></td>
            <td><?php if(!empty($resultado)) echo $resultado->nota_bala; ?></td>
        </tr>
       
        <thead>
            <tr>
                <th colspan="3" class="text-center">Natación</th>
            </tr>
        </thead>
        
        <tr>
            <td>100 mts. libres</td>
            <td><?php if(!empty($resultado)) echo $resultado->marca_100_libre; ?></td>
            <td><?php if(!empty($resultado)) echo $resultado->nota_100_libre; ?></td>
        </tr>
        <tr>
            <td>Bajo Agua</td>
            <td><?php if(!empty($resultado)) echo $resultado->marca_bajo_agua; ?></td>
            <td><?php if(!empty($resultado)) echo $resultado->nota_bajo_agua; ?></td>
        </tr>

        <thead>
            <tr>
                <th colspan="3" class="text-center">Gimnasia</th>
            </tr>
        </thead>
        
        <tr>
            <td>Trepa</td>
            <td><?php if(!empty($resultado)) echo $resultado->marca_trepa; ?></td>
            <td><?php if(!empty($resultado)) echo $resultado->nota_trepa; ?></td>
        </tr>
        <tr>
            <td>Abdominales</td>
            <td><?php if(!empty($resultado)) echo $resultado->marca_abdominales; ?></td>
            <td><?php if(!empty($resultado)) echo $resultado->nota_abdominales; ?></td>
        </tr>
        <tr>
            <td>Extensión de Brazos</td>
            <td><?php if(!empty($resultado)) echo $resultado->marca_extension_brazos; ?></td>
            <td><?php if(!empty($resultado)) echo $resultado->nota_extension_brazos; ?></td>
        </tr>

        <thead>
            <tr>
                <th colspan="3" class="text-center">Otros</th>
            </tr>
        </thead>
        
        <tr>
            <td>Marca Cooper</td>
            <td><?php if(!empty($resultado)) echo $resultado->marca_cooper; ?></td>
            <td></td>
        </tr>
        
        
        <thead>
            <tr>
                <th colspan="2">Nota Final Etapa</th>
                <th><?php if(!empty($resultado)) echo $resultado->nota_final; ?></th>
            </tr>
        </thead>
        
    </table>
    
</div>

<div class="panel panel-default">
    <div class="panel-heading">
        <b>Observación</b>
    </div>
    <table class="table">
        <tr>
            <td><?php if(!empty($resultado)) echo $resultado->observacion; ?></td>
        </tr>
    </table>
</div>