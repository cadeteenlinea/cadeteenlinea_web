<?php
/* @var $this UsuarioController */
/* @var $model Usuario */

$this->breadcrumbs=array(
	'Usuarios'=>array('index'),
	'Create',
);

$this->menu=array(
	array('label'=>'Ver Usuarios', 'url'=>array('admin')),
);
?>

<h1>Nuevo Funcionario</h1>

<?php $this->renderPartial('_form', array('model'=>$model,'funcionario'=>$funcionario)); ?>