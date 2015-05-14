<?php
    //print_r($anos);
    
    echo CHtml::dropDownList('year', $anos, CHtml::listData($anos, 'fechaMovimiento', 'fechaMovimiento'), 
            array('prompt'=>'Seleccionar año', 'onchange'=>'form.submit()', 'class'=>'form-control'));
?>



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



