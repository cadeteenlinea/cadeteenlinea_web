<h3><?php echo $titulo; ?></h3>
<div class="media">
    <div class="media-left">
        <a href="#">
        <img width="80" class="media-object" src="<?php echo $model->usuario->imagen();?>" alt="...">
        </a>
    </div>
    <div class="media-body">
        <p>
            <b>Cadete: </b> <?php echo $model->usuario->apellidoPat.' '. $model->usuario->apellidoMat.' '. $model->usuario->nombres ?> <br/>
            <b>Curso: </b> <?php echo $model->curso; ?><br/>
            <b>División: </b> <?php echo $model->division; ?>
        </p>
        
        <?php 
            foreach($model->francos as $franco){
        ?>
            <p>
                <b>Fecha Salida : </b> <?php echo $franco->fecha_salida; ?> <br/>
                <b>Hora Salida : </b> <?php echo $franco->hora_salida; ?> <br/>
                <b>Fecha Recogida : </b> <?php echo $franco->fecha_recogida; ?> <br/>
                <b>Hora Recogida : </b> <?php echo $franco->hora_recogida; ?> <br/>
            </p>
        
        
        <?php
            }
        ?>
    </div>
</div>
