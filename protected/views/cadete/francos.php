<h3><?php echo $titulo; ?></h3>


<?php foreach ($model->francos as $franco) {?>

<div class="panel panel-default">
    <table class="table">
        <tr>
            <td>Cadete</td>
            <td><?php echo $model->usuario->apellidoPat.' '. 
            $model->usuario->apellidoMat.' '. $model->usuario->nombres ;?></td>
        </tr>
        <tr>
            <td>Fecha Salida</td>
            <td><?php echo $franco->fecha_salida . ' ' . $franco->hora_salida;?></td>
        </tr>
        <tr>
            <td>Fecha Recogida</td>
            <td><?php echo $franco->fecha_recogida . ' ' . $franco->hora_recogida;?></td>
        </tr>
        
        <tr>
            <td>Asignaturas con nota bajo 6.0 (escala 0 a 10)</td>
            <td><?php echo $franco->asignatura_bajo;?></td>
        </tr>
    </table>
</div>
<?php }?>






