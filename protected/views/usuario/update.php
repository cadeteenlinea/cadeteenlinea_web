<?php
$this->menu=array(
	array('label'=>'Datos Personales', 'url'=>array('datosPersonales')),
);
?>

<h1>Actualizar mis datos</h1>

<?php $this->renderPartial('_form', array('model'=>$model)); ?>