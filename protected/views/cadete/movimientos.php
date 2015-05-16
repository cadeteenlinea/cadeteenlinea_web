<h3><?php echo $titulo; ?></h3>

<div class="panel panel-default">
    <div class="panel-heading">
        <b>Total
            <?php if($total<0){ 
                echo "<span class=\"glyphicon glyphicon-minus-sign cargo\"></span> $total ";
            }else{
                echo "<span class=\"glyphicon glyphicon-plus-sign abono\"></span> $total ";
            }?>
        </b>
        <?php
            //print_r($anos);
            $form=$this->beginWidget('CActiveForm', array(
                'id'=>'ano-view',
                'htmlOptions'=>array(
                    'class'=>'pull-right',
                ),
                'enableAjaxValidation'=>false,));
                /*
                 *Despliega una list con los años correspondientes a a los movimientos del cadete
                 * Yii::app()->request->url entrega la url actual del sitio
                 * la variable $anoView contiene el año seleccionado por el usuario
                 * el metodo getListAno entrega un arreglo de tipo listData para el despligue del list
                 * este arreglo esta compuesto por clave, valor, pero en este caso
                 * la clave y el valor son el mismo dato
                 */
                echo CHtml::dropDownList('fechaMovimiento', 'fechaMovimiento',  Transaccion::model()->getListAno(Yii::app()->getSession()->get('rutCadete'), $tipoCuenta),
                    array('class'=>'form-control pull-righ','style'=>'width:90px;','submit'=>Yii::app()->request->url,
                        'options'=> array($anoView=>array('selected'=>'selected'))
             ));
            $this->endWidget();
        ?>
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
                <td><?php echo $transaccion->FechaFormatoNacional; ?></td>
                <td><?php echo $transaccion->descripcion; ?></td>
                <?php if($transaccion->tipoTransaccion == "Cargo") {?>
                    <td><span class="glyphicon glyphicon-minus-sign cargo"></span> <?php echo $transaccion->MontoFormatoDinero; ?></td>
                <?php } else {?>
                    <td><span class="glyphicon glyphicon-plus-sign abono"></span> <?php echo $transaccion->MontoFormatoDinero; ?></td>
                <?php }?>
            </tr>
        <?php }} ?>
    </table>
</div>



