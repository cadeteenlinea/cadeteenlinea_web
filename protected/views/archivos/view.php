<?php

$this->menu=array(
	array('label'=>'Nuevo Archivo', 'url'=>array('create')),
	array('label'=>'Eliminar Archivo', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->idarchivos),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Mantenedor Archivos', 'url'=>array('admin')),
);
?>

<h1>Publicar Archivo #<?php echo $model->idarchivos; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'fecha',
		'tipoArchivo.nombre',
	),
)); ?>

<div class="container">
    <div class="row">
        <div class="col-lg-12">
            <?php echo CHtml::link('Publicar',array('archivos/publicar/'.$model->idarchivos),array("class"=>'btn btn-primary')); ?>
        </div>
    </div>
</div>

