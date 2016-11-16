<h3><?php echo $titulo; ?></h3>
<h4>&nbsp<?php echo $model->nombre; ?></h4>

<div class="panel panel-default">
    <div class="panel-heading">
        
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>Fecha</th>
                <th>Concepto</th>
                <th>Nota</th>
            </tr>
        </thead>
        <?php
        if(!empty($notas)){
            foreach ($notas as $nota){
        ?>
            <tr>
                <td><?php echo $nota->getFecha(); ?></td>
                <td><?php echo $nota->concepto->nombre; ?></td>
                <td><?php echo $nota->nota; ?></td>
            </tr>
        <?php }} ?>
            <tr>
                <td></td>
                <td><b>Promedio</b></td>
                <td><b><?php echo $promedio; ?></b></td>
            </tr>
        <?php 
            //Visualizar notas finales de la asignatura, examenes y repeticiones
            if(!empty($notasFinales)){
        ?>    
            <tr>
                <td></td>
                <td>Examen</td>
                <td><?php echo $notasFinales->nota_examen ?></td>
            </tr>
            <tr>
                <td></td>
                <td><b>N. Final</b></td>
                <td><b><?php echo $notasFinales->nota_final ?></b></td>
            </tr>
            <tr>
                <td></td>
                <td>Examen Rep.</td>
                <td><?php echo $notasFinales->nota_examen_repeticion ?></td>
            </tr>
            <tr>
                <td></td>
                <td><b>N. final con examen Rep.</b></td>
                <td><b><?php echo $notasFinales->nota_final_repeticion ?></b></td>
            </tr>
            <tr>
                <td></td>
                <td><b>Estado</b></td>
                <td><b><?php echo $notasFinales->getEstado() ?></b></td>
            </tr>
        <?php
            }
        ?>
    </table>
</div>
