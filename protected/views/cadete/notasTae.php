<h3><?php echo $titulo; ?></h3>
<div class="panel panel-default">
    <div class="panel-heading">
        
    </div>
    <table class="table">
        <thead>
            <tr>
                <th>Año</th>
                <th>Mes</th>
                <th class="hidden-xs">Speaking (50%)</th>
                <th class="hidden-xs">Understanding (40%)</th>
                <th class="hidden-xs">Writing (10%)</th>
                <th>Average</th>
            </tr>
        </thead>
        <?php
        if(!empty($model)){
            foreach ($model->inglesTae as $nota){
        ?>
            <tr>
                <td><?php echo $nota->ano; ?></td>
                <td><?php echo $nota->mes; ?></td>
                <td class="hidden-xs"><?php echo $nota->speaking; ?></td>
                <td class="hidden-xs"><?php echo $nota->understanding; ?></td>
                <td class="hidden-xs"><?php echo $nota->writing; ?></td>
                <td><b><?php echo $nota->average; ?></b></td>
            </tr>
        <?php }} ?>
    </table>
</div>

<div class="alert alert-info" role="alert">
    <button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button>
    <p>* A contar Diciembre 2010, requisito mínimo de egreso 
            Escuela Naval 60 % Average TAE.</p>

</div>

