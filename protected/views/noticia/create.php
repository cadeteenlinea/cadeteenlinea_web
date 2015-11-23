<?php
/* @var $this NoticiaController */
/* @var $model Noticia */

$this->breadcrumbs=array(
	'Noticias'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'List Noticia', 'url'=>array('index')),
	array('label'=>'Manage Noticia', 'url'=>array('admin')),
);
?>

<h1>Nueva Noticia</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>