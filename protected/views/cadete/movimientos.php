<?php
    //print_r($anos);
    $form=$this->beginWidget('CActiveForm', array(
	'id'=>'ano-view',
	'enableAjaxValidation'=>false,));

    //echo CHtml::dropDownList('year', $anos, CHtml::listData($anos, 'fechaMovimiento', 'fechaMovimiento'), 
    //        array('prompt'=>'Seleccionar año', 'onchange'=>'/site', 'class'=>'form-control', 'select'=>'2015'));
    
     echo CHtml::dropDownList('designation_id', 'designation_id',  Transaccion::model()->getListAno(Yii::app()->getSession()->get('rutCadete')),
            array('class'=>'form-control','onchange'=>Yii::app()->request->url,
                'options'=>
                             array(
                               Yii::app()->getSession()->get('ano_view')=>array('selected'=>'selected')
                                 )
     ));
    
?>

<?php $this->endWidget(); ?>


<h3><?php echo $titulo; ?></h3>

<div class="panel panel-default">
    <div class="panel-heading">
        <b>Movimientos
        <?php if($total<0){ 
            echo "<span class=\"glyphicon glyphicon-minus-sign cargo\"></span> $total ";
        }else{
            echo "<span class=\"glyphicon glyphicon-plus-sign abono\"></span> $total ";
        }?>
        </b>
    </div>
    
    <table class="table">
        <thead>
          <tr>
            <th>Fecha</th>
            <th>Descripción</th>
            <th>Monto</th>
          </tr>
        </thead>
    <?php
        if(!empty($transacciones)){
            foreach ($transacciones->transacciones as $transaccion){
        ?>
            <tr>
                <td><?php echo $transaccion->fechaMovimiento; ?></td>
                <td><?php echo $transaccion->descripcion; ?></td>
                <?php if($transaccion->tipoTransaccion == "Cargo") {?>
                    <td><span class="glyphicon glyphicon-minus-sign cargo"></span> <?php echo $transaccion->monto; ?></td>
                <?php } else {?>
                    <td><span class="glyphicon glyphicon-plus-sign abono"></span> <?php echo $transaccion->monto; ?></td>
                <?php }?>
            </tr>
        <?php }} ?>
    </table>
</div>



