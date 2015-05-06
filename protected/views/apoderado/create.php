<?php
/* @var $this ApoderadoController */
/* @var $model Apoderado */

$this->breadcrumbs=array(
	'Apoderados'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Apoderado', 'url'=>array('index')),
	array('label'=>'Manage Apoderado', 'url'=>array('admin')),
);
?>

<h1>Create Apoderado</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>