<?php
$this->menu=array(
	array('label'=>'Nueva Noticia', 'url'=>array('create')),
	array('label'=>'Mantenedor Noticia', 'url'=>array('admin')),
);
?>

<h1>Actualizar Noticia <?php echo $model->idnoticia; ?></h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>