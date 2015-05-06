<?php
/* @var $this ApoderadoController */
/* @var $model Apoderado */

$this->breadcrumbs=array(
	'Apoderados'=>array('index'),
	$model->rut=>array('view','id'=>$model->rut),
	'Update',
);

$this->menu=array(
	array('label'=>'List Apoderado', 'url'=>array('index')),
	array('label'=>'Create Apoderado', 'url'=>array('create')),
	array('label'=>'View Apoderado', 'url'=>array('view', 'id'=>$model->rut)),
	array('label'=>'Manage Apoderado', 'url'=>array('admin')),
);
?>

<h1>Update Apoderado <?php echo $model->rut; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>