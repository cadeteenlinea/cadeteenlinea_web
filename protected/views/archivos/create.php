<?php
/* @var $this ArchivosController */
/* @var $model Archivos */

$this->breadcrumbs=array(
	'Archivoses'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Mantenedor de Archivos', 'url'=>array('admin')),
);
?>

<h1>Nuevo Archivo</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>