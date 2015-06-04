<h3><?php echo $titulo; ?></h3>
<h4>&nbsp<?php echo $model->nombre; ?></h4>

<div class="panel panel-default">
    <div class="panel-heading">
        <b class="text-right">Promedio:<?php echo $promedio; ?></b>
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
                <td></td>
                <td><?php echo $nota->nota; ?></td>
            </tr>
        <?php }} ?>
    </table>
</div>
