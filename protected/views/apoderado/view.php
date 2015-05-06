<?php
/* @var $this ApoderadoController */
/* @var $model Apoderado */

$this->breadcrumbs=array(
	'Apoderados'=>array('index'),
	$model->rut,
);

$this->menu=array(
	array('label'=>'List Apoderado', 'url'=>array('index')),
	array('label'=>'Create Apoderado', 'url'=>array('create')),
	array('label'=>'Update Apoderado', 'url'=>array('update', 'id'=>$model->rut)),
	array('label'=>'Delete Apoderado', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->rut),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Manage Apoderado', 'url'=>array('admin')),
);
?>

<h1>View Apoderado #<?php echo $model->rut; ?></h1>

<?php $this->widget('zii.widgets.CDetailView', array(
	'data'=>$model,
	'attributes'=>array(
		'rut',
		'apellidoPat',
		'apellidoMat',
		'nombres',
		'direccion',
		'comuna',
		'ciudad',
		'region',
		'fono',
		'fonoComercial',
		'email',
		'difunto',
	),
)); ?>
