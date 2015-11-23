<?php
/* @var $this NoticiaController */
/* @var $dataProvider CActiveDataProvider */

$this->breadcrumbs=array(
	'Noticias',
);

$this->menu=array(
	array('label'=>'Create Noticia', 'url'=>array('create')),
	array('label'=>'Manage Noticia', 'url'=>array('admin')),
);
?>

<h1>Noticias</h1>

<?php $this->widget('zii.widgets.CListView', array(
	'dataProvider'=>$dataProvider,
	'itemView'=>'_view',
)); ?>



<?php 
    $model = Noticia::model()->getAllUsuarioNoticiaInsert('cadete', 'B', '');
    $i = 1;
    foreach ($model as $m){
        echo $i.' '.$m->rut.' --- '.$m->perfil.'<br/>';
        $i++;
    }
?>