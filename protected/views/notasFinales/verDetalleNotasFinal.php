<h3><?php echo $titulo; ?></h3>
<h4>&nbsp<?php echo $model->asignatura->nombre; ?></h4>

<ul class="list-group">
  <li class="list-group-item">
    <span class="badge"><?php echo $model->nota_presentacion; ?></span>
    Nota de presentación
  </li>
  <li class="list-group-item">
    <span class="badge"><?php echo $model->nota_examen; ?></span>
    Examen
  </li>
  <li class="list-group-item">
    <span class="badge"><?php echo $model->nota_final; ?></span>
    Nota Final
  </li>
  <li class="list-group-item">
    <span class="badge"><?php echo $model->nota_examen_repeticion; ?></span>
    Examen de repetición
  </li>
  <li class="list-group-item">
    <span class="badge"><?php echo $model->nota_final_repeticion; ?></span>
    Nota final con Examen de Rep.
  </li>
  <li class="list-group-item">
    <span class="badge"><?php echo $model->getEstado(); ?></span>
    Estado
  </li>
</ul>
