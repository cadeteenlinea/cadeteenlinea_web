<h3><?php echo $titulo; ?></h3>
<div class="panel panel-default">
    <div class="panel-heading">
        
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>Asignatura</th>
                <th class="hidden-xs">Notas</th>
                <th class="hidden-xs">Promedio</th>
                <th class="visible-xs">Prom.</th>
            </tr>
        </thead>
        <?php
        if(!empty($model)){
            foreach ($model as $asignatura){
        ?>
            <tr>
                <td><a href="<?php echo Yii::app()->createUrl("asignatura/verDetalleNotasParciales/",array("id"=>$asignatura->idasignatura)); ?>" title="ver detalle"><?php echo $asignatura->nombre; ?></a></td>
                <td class="hidden-xs">
                <?php 
                    $sw=false;
                    $texto = '';
                    foreach ($usuario->cadete->getNotasParcialesAsignatura($asignatura->idasignatura) as $nota){
                        if($sw==true){
                            $texto = ' - ';
                        }else{
                            $sw = true;
                        }
                     ?>
                    <?php echo ($texto.$nota->nota);?>
                <?php }?>
                </td>
                <td><?php echo $usuario->cadete->getPromedioNotasParcialesAsignatura($asignatura->idasignatura); ?></td>
            </tr>
        <?php }} ?>
    </table>
</div>
