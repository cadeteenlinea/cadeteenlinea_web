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
                <th class="hidden-sm hidden-xs">Examen</th>
                <th class="hidden-sm hidden-xs">N. Final</th>
                <th class="hidden-sm hidden-xs">Examen Rep.</th>
                <th class="hidden-sm hidden-xs">N. final con examen Rep.</th>
                <th class="">Estado</th>
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
                <td><b><?php echo $usuario->cadete->getPromedioNotasParcialesAsignatura($asignatura->idasignatura); ?></b></td>
                
                <?php
                    //Detalle de examenes, alojado en la tabla notas finales
                    $nota = NotasFinales::model()->getNotaAnoCadete(Yii::app()->getSession()->get('rutCadete'), $asignatura->idasignatura);
                    if(!empty($nota)){
                ?>
                    <td class="hidden-sm hidden-xs">    <?php echo Nota::deleteZero($nota->nota_examen); ?></td>
                    <td class="hidden-sm hidden-xs"><b> <?php echo Nota::deleteZero($nota->nota_final); ?></b></td>
                    <td class="hidden-sm hidden-xs">    <?php echo Nota::deleteZero($nota->nota_examen_repeticion); ?></td>
                    <td class="hidden-sm hidden-xs"><b> <?php echo Nota::deleteZero($nota->nota_final_repeticion); ?></b></td>
                    <td class="hidden-sm hidden-xs"><b> <?php echo Nota::deleteZero($nota->getEstado()); ?></b></td>
                    <td class="visible-sm visible-xs"><b><?php echo Nota::deleteZero($nota->estado); ?></b></td>
                <?php }else{ ?>
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
