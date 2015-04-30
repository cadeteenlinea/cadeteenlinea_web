<?php
/* @var $this CadeteController */
/* @var $model Cadete */

$this->breadcrumbs=array(
	'Cadetes'=>array('index'),
	$model->rut=>array('view','id'=>$model->rut),
	'Update',
);

$this->menu=array(
	array('label'=>'List Cadete', 'url'=>array('index')),
	array('label'=>'Create Cadete', 'url'=>array('create')),
	array('label'=>'View Cadete', 'url'=>array('view', 'id'=>$model->rut)),
	array('label'=>'Manage Cadete', 'url'=>array('admin')),
);
?>

<h1>Update Cadete <?php echo $model->rut; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>