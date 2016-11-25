<?php
/* @var $this NoticiaController */
/* @var $model Noticia */

$this->menu=array(
	array('label'=>'Nueva Noticia', 'url'=>array('create')),
);

?>

<h1>Mantenedor Noticias</h1>

<?php if(Yii::app()->user->hasFlash('success')):?>
    <div style="margin-top: 20px;" class="flash-success col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <?php echo Yii::app()->user->getFlash('success'); ?>
    </div>
<?php endif; ?>
 
<?php if(Yii::app()->user->hasFlash('error')):?>
    <div style="margin-top: 20px;" class="flash-error col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <?php echo Yii::app()->user->getFlash('error'); ?>
    </div>
<?php endif; ?>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'noticia-grid',
	'dataProvider'=>$model->search(),
	'filter'=>$model,
        'itemsCssClass' => 'table table-hover',
            'pager' => array(
                'header' => '',
                'hiddenPageCssClass' => 'disabled',
                'maxButtonCount' => 10,
                'cssFile' => false,
                'prevPageLabel' => '<i class="icon-chevron-left"><</i>',
                'nextPageLabel' => '<i class="icon-chevron-right">></i>',
                'firstPageLabel' => 'First',
                'lastPageLabel' => 'Last',
        ),
	'columns'=>array(
		'titulo',
                'tipo_usuario',
                'division',
                'curso',
		'fecha',
		array(
                        'class'=>'CButtonColumn',
                        'htmlOptions'=>array('width'=>'100px'),
                        'template'=>'{view}{update}{delete}',
                        'afterDelete'=>'function(link,success,data){ if(success) $("#statusMsg").html(data); }',
                        'buttons'=>array(
                            'view' => array
                            (
                                'label'=>'<i style="font-size: 22px;" class="glyphicon glyphicon-search"></i>',
                                'imageUrl'=>false,
                                'options'=>array(
                                    'title'=>'Ver',
                                ),
                            ),
                            'update' => array
                            (
                                'label'=>'<i style="font-size: 22px;" class="glyphicon glyphicon-pencil"></i>',
                                'imageUrl'=>false,
                                'options'=>array(
                                    'title'=>'Actualizar',
                                ),
                            ),
                            'delete' => array
                            (
                                'label'=>'<i style="font-size: 22px;" class="glyphicon glyphicon-remove"></i>',
                                'imageUrl'=>false,
                                'options'=>array(
                                    'title'=>'Eliminar',
                                ),
                            ),
                        ),
                ),
	),
)); ?>
