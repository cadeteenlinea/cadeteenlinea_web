<?php

$this->menu=array(
	array('label'=>'Nuevo Archivo', 'url'=>array('create')),
	array('label'=>'Eliminar Archivo', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->idarchivos),'confirm'=>'¿Está seguro que desea borrar este elemento?')),
	array('label'=>'Mantenedor Archivos', 'url'=>array('admin')),
);
?>

<h3><?php echo $titulo; ?></h3>

<div class="panel panel-default">
    <div class="panel-heading">
        <p class="text-right">Registros actualizados/Ingresados : <b><?php echo $countSuccess; ?></b></p>
        <p class="text-right">Registros con errores : <b><?php echo $countError; ?></b></p>
        
    </div>
    <table class="table">
        <thead>
          <tr>
            <th>Registro</th>
            <th>Errores</th>
          </tr>
        </thead>

        <?php
            foreach($errors as $columna){
                if(!empty($columna["error"])){
                    echo "<tr>";
                    echo "<td>".$columna["columna"]."</td>";
                    echo "<td>";
                    foreach($columna["error"] as $error){
                        echo $error[0]."<br/>";
                    }
                    echo "</td>";
                    echo "</tr>";
                }
            }
        ?>
    </table>
</div>
