<h3><?php echo $titulo; ?></h3>
<div class="panel panel-default">
    <div class="panel-heading">
        
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>Asignatura</th>
                <th>Notas</th>
                <th>Promedio</th>
            </tr>
        </thead>
        <?php
        if(!empty($model)){
            foreach ($model as $asignatura){
        ?>
            <tr>
                <td><a><?php echo $asignatura->nombre; ?></a></td>
                <td>
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
