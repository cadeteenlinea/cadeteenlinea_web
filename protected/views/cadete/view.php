<?php
/* @var $this CadeteController */
/* @var $model Cadete */

$this->breadcrumbs=array(
	'Cadetes'=>array('index'),
	$model->rut,
);

$this->menu=array(
	array('label'=>'List Cadete', 'url'=>array('index')),
	array('label'=>'Create Cadete', 'url'=>array('create')),
	array('label'=>'Update Cadete', 'url'=>array('update', 'id'=>$model->rut)),
	array('label'=>'Delete Cadete', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->rut),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Cadete', 'url'=>array('admin')),
);
?>

<h1>View Cadete #<?php echo $model->rut; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'rut',
		'nombre',
		'apellidoPat',
		'apellidoMat',
		'curso',
		'nCadete',
	),
)); ?>
