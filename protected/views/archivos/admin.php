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
                        'htmlOptions'=>array('width'=>'80px'),
                        'template'=>'{view}{delete}',
                        'afterDelete'=>'function(link,success,data){ if(success) $("#statusMsg").html(data); }',
                        'buttons'=>array(
                            'view' => array
                            (
                                'label'=>'ver - publicar',
                                'imageUrl'=>Yii::app()->request->baseUrl.'/images/iconos/ver.png',
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
