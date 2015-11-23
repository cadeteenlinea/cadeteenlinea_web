<?php
/* @var $this NoticiaController */
/* @var $model Noticia */

$this->breadcrumbs=array(
	'Noticias'=>array('index'),
	$model->idnoticia=>array('view','id'=>$model->idnoticia),
	'Update',
);

$this->menu=array(
	array('label'=>'List Noticia', 'url'=>array('index')),
	array('label'=>'Create Noticia', 'url'=>array('create')),
	array('label'=>'View Noticia', 'url'=>array('view', 'id'=>$model->idnoticia)),
	array('label'=>'Manage Noticia', 'url'=>array('admin')),
);
?>

<h1>Actualizar Noticia <?php echo $model->idnoticia; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>