<?php
/* @var $this NoticiaController */
/* @var $model Noticia */

$this->breadcrumbs=array(
	'Noticias'=>array('index'),
	$model->idnoticia,
);

$this->menu=array(
	array('label'=>'Nueva Noticia', 'url'=>array('create')),
	array('label'=>'Actualizar Noticia', 'url'=>array('update', 'id'=>$model->idnoticia)),
	array('label'=>'Eliminar Noticia', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->idnoticia),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Mantenedor Noticias', 'url'=>array('admin')),
);
?>

<h1>View Noticia #<?php echo $model->idnoticia; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'idnoticia',
		'titulo',
		'cuerpo',
		'fecha',
	),
)); ?>
