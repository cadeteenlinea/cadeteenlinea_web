<?php
/* @var $this CadeteController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Cadetes',
);

$this->menu=array(
	array('label'=>'Create Cadete', 'url'=>array('create')),
	array('label'=>'Manage Cadete', 'url'=>array('admin')),
);
?>

<h1>Cadetes</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>
