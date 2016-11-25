<?php
$this->menu=array(
	array('label'=>'Nueva', 'url'=>array('create')),
        array('label'=>'Ver', 'url'=>array('view', 'id'=>$model->idnoticia)),
	array('label'=>'Mantenedor Noticia', 'url'=>array('admin')),
);
?>

<h1>Actualizar Noticia "<?php echo $model->titulo; ?>"</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>