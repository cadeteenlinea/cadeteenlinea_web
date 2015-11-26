<?php


$this->menu=array(
	array('label'=>'Mantenedor Noticias', 'url'=>array('admin')),
);
?>

<h1>Nueva Noticia</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>