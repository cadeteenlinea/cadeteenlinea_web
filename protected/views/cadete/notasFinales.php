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
                 *Despliega una list con los años con notas finales
                 * variable $ano contiene el año seleccionado por el usuario
                 */
                echo CHtml::dropDownList('ano', 'ano', NotasFinales::model()->getListAno(Yii::app()->getSession()->get('rutCadete')),
                    array('class'=>'form-control pull-righ','style'=>'width:125px;','submit'=>Yii::app()->request->url,
                        'options'=> array($ano=>array('selected'=>'selected'))
             ));
            $this->endWidget();
        ?>
    </div>
    
    <table class="table">
        <thead>
          <tr>
            <th>Asignatura</th>
            <th class="hidden-sm hidden-xs">N. Presentación</th>
            <th class="hidden-sm hidden-xs">Examen</th>
            <th class="hidden-sm hidden-xs">N. Final</th>
            <th class="hidden-sm hidden-xs">Examen Rep.</th>
            <th class="hidden-sm hidden-xs">Examen 3ra. Opción</th>
            <th class="hidden-sm hidden-xs">N. final con examen Rep.</th>
            <th class="">Estado</th>
          </tr>
        </thead>
        <?php
            if(!empty($model)){
                foreach ($model as $asignatura){
            ?>
            <tr>
                <?php
                    $nota = NotasFinales::model()->getNotaAnoCadete(Yii::app()->getSession()->get('rutCadete'), $asignatura->idasignatura);
                    if(!empty($nota)){
                ?>
                    <td><a href="<?php echo Yii::app()->createUrl("notasFinales/verDetalleNotasFinal/",array("id"=>$nota->idnotas_finales)); ?>" title="ver detalle"><?php echo $asignatura->nombre; ?></a></td>
                
                    <td class="hidden-sm hidden-xs"><b> <?php echo Nota::deleteZero($nota->nota_presentacion); ?></b></td>
                    <td class="hidden-sm hidden-xs">    <?php echo Nota::deleteZero($nota->nota_examen); ?></td>
                    <td class="hidden-sm hidden-xs"><b> <?php echo Nota::deleteZero($nota->nota_final); ?></b></td>
                    <td class="hidden-sm hidden-xs">    <?php echo Nota::deleteZero($nota->nota_examen_repeticion); ?></td>
                    <td class="hidden-sm hidden-xs">    <?php echo Nota::deleteZero($nota->nota_tercera_opcion); ?></td>
                    <td class="hidden-sm hidden-xs"><b> <?php echo Nota::deleteZero($nota->nota_final_repeticion); ?></b></td>
                    <td class="hidden-sm hidden-xs"><b> <?php echo $nota->getEstado(); ?></b></td>
                    <td class="visible-sm visible-xs"><b><?php echo $nota->estado; ?></b></td>
                <?php }else{ ?>
                    <td class="hidden-sm hidden-xs"><?php echo $asignatura->nombre; ?></td>
                    <td class="hidden-sm hidden-xs"></td>
                    <td class="hidden-sm hidden-xs"></td>
                    <td class="hidden-sm hidden-xs"></td>
                    <td class="hidden-sm hidden-xs"></td>
                    <td class="hidden-sm hidden-xs"></td>
                    <td class="hidden-sm hidden-xs"></td>
                    <td class=""></td>
                <?php }?>
            </tr>
        <?php }} ?>
    </table>
</div>