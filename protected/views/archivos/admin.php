<?php
/* @var $this ArchivosController */
/* @var $model Archivos */

$this->breadcrumbs=array(
	'Archivoses'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Nuevo Archivo', 'url'=>array('create')),
);

?>

<h1>Mantenedor de Archivos</h1>

<div id="statusMsg">
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
</div>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'archivos-grid',
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
                array(
                    'name'=>'idarchivos',
                    'header'=>'#',
                    'value'=>'$data->idarchivos',
                    'htmlOptions'=>array(
                        'width'=>'60',
                        ),
                ),
		'fecha',
                array(
                    'name'=>'tipo_archivo_idtipo_archivo',
                    'value'=>'$data->tipoArchivo->nombre',
                    'filter'=> TipoArchivo::model()->getListTipoArchivo(),
                ),
		array(
                        'class'=>'CButtonColumn',
                        'htmlOptions'=>array('width'=>'120px'),
                        'template'=>'{view}{actualizarBase}{delete}',
                        'afterDelete'=>'function(link,success,data){ if(success) $("#statusMsg").html(data); }',
                        'buttons'=>array(
                            'view' => array
                            (
                                'label'=>'ver',
                                'imageUrl'=>Yii::app()->request->baseUrl.'/images/iconos/ver.png',
                            ),
                            'actualizarBase' => array
                            (
                                'label'=>'actualizar Base de Datos',
                                'url' => 'Yii::app()->createUrl("archivos/publicar/$data->idarchivos")',
                                'imageUrl'=>Yii::app()->request->baseUrl.'/images/iconos/actualizarBase.png',
                            ),
                            'delete' => array
                            (
                                'label'=>'eliminar',
                                'imageUrl'=>Yii::app()->request->baseUrl.'/images/iconos/eliminar.png',
                            ),
                        ),
                ),
	),
)); ?>
