<?php
/* @var $this NoticiaController */
/* @var $model Noticia */

$this->breadcrumbs=array(
	'Noticias'=>array('index'),
	$model->idnoticia,
);

$this->menu=array(
	array('label'=>'Nueva', 'url'=>array('create')),
	array('label'=>'Actualizar', 'url'=>array('update', 'id'=>$model->idnoticia)),
	array('label'=>'Eliminar', 'url'=>'#', 'linkOptions'=>array('submit'=>array('delete','id'=>$model->idnoticia),'confirm'=>'Are you sure you want to delete this item?')),
	array('label'=>'Mantenedor Noticias', 'url'=>array('admin')),
);
?>

<div id="noticia_<?php echo $model->idnoticia ?>" class="cadeteSelect col-lg-12">
    <div class="col-lg-12">
        <h3 style="margin-bottom: 0px;"><?php echo $model->titulo; ?></h3>
        <p style="font-style: italic; font-size: 12px;">
            de: <?php echo $model->usuario->NombreCompleto .' - '. $model->usuario->funcionario->tipo ?>
        </p>
        <p style="font-size: 14px; text-align: justify;"><?php echo nl2br($model->getCuerpoNoticia()); ?></p>
    </div>

    <div class="col-lg-12">
        <?php
            if($model->documento() != null){
        ?>
                <a class="pull-right" href="<?php echo Yii::app()->createUrl('noticia/viewFile',array('id'=>$model->idnoticia)) ?>" title="<?php echo $model->titulo ?>" target="_blank"><image src="<?php echo $model->tipoDocumento(); ?>" /></a>
        <?php
            }
        ?> 
    </div>   

    <div class="col-lg-12" style="margin-top:5px;">
        <?php $fecha=strftime("%d-%m-%Y", strtotime($model->fecha)) ; ?>
        <p style="text-align: right; font-style: italic; font-size: 12px;"><i><?php echo $fecha; ?></i></p>
    </div> 
</div>
