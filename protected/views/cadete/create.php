<?php
/* @var $this CadeteController */
/* @var $model Cadete */

$this->breadcrumbs=array(
	'Cadetes'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Cadete', 'url'=>array('index')),
	array('label'=>'Manage Cadete', 'url'=>array('admin')),
);
?>

<h1>Create Cadete</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>