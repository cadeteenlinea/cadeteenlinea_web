<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'cadete-grid',
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
                    'name'=>'cadete_rut',
                    'value'=>'$data->cadete->usuario->nombres', 
                ),
		array(
                    'name'=>'motivo_idmotivo',
                    'header'=>'motivo',
                    'value'=>'$data->motivo->motivo',
                    'filter'=>Motivo::model()->getListMotivos(),
                ),
                'fecha_vencimiento',
                array(
                        'class'=>'CButtonColumn',
                        'htmlOptions'=>array('width'=>'50px'),
                        'template'=>'{view}',
                        'buttons'=>array(
                            'view' => array
                            (
                                'label'=>'ver',
                                'imageUrl'=>Yii::app()->request->baseUrl.'/images/iconos/ver.png',
                            ),
                        ),
                ),
	),
)); ?>