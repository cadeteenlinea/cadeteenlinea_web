<h3><?php echo $titulo; ?></h3>

<div class="panel panel-default">
    <div class="panel-heading">

    </div>
    
    <table class="table">
        <thead>
          <tr>
            <th>Año</th>
            <th class="hidden-sm hidden-xs">Curso y Especialidad</th>
            <th class="hidden-sm hidden-xs">Calif. 1er. Sem</th>
            <th class="hidden-sm hidden-xs">Calif. 2do. Sem</th>
            <th class="hidden-sm hidden-xs">Prom Calif.</th>
            <th class="hidden-sm hidden-xs">Prom Acad.</th>
            <th class="hidden-sm hidden-xs">Prom Fin.</th>
            <th class="hidden-sm hidden-xs">Antiguedad</th>
          </tr>
        </thead>
        <?php
            if(!empty($model)){
                foreach ($model->getResumenFinalAnos() as $resumen){
            ?>
            <tr>
                <td class="hidden-sm hidden-xs"><b><?php echo $resumen->ano; ?></b></td>
                <td class="hidden-sm hidden-xs"><?php echo $resumen->curso.' '.$resumen->especialidad->nombre; ?></td>
                <td class="hidden-sm hidden-xs"><?php echo $resumen->calificacion_primer_semestre; ?></td>
                <td class="hidden-sm hidden-xs"><?php echo $resumen->calificacion_segundo_semestre; ?></td>
                <td class="hidden-sm hidden-xs"><?php echo $resumen->promedio_calificacion; ?></td>
                <td class="hidden-sm hidden-xs"><?php echo $resumen->promedio_academico; ?></td>
                <td class="hidden-sm hidden-xs"><?php echo $resumen->promedio_final; ?></td>
                <td class="hidden-sm hidden-xs"><?php echo $resumen->antiguedad; ?></td>
            </tr>
        <?php }} ?>
    </table>
</div>

