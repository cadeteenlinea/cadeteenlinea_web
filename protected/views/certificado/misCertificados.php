<h1>Mis Certificados</h1>

<?php if(Yii::app()->user->hasFlash('success')):?>
    <div style="margin-top: 20px;" class="flash-success col-lg-12 col-md-12 col-sm-12 col-xs-12">
        <?php echo Yii::app()->user->getFlash('success'); ?>
    </div>
<?php endif; ?>



<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'cadete-grid',
	'dataProvider'=>$model->search(true),
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
                'idcertificado',
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
                array(
                        'class'=>'CButtonColumn',
                        'htmlOptions'=>array('width'=>'50px'),
                        'template'=>'{view}',
                        'buttons'=>array(
                            'view' => array
                            (
                                'label'=>'ver',
                                'imageUrl'=>Yii::app()->request->baseUrl.'/images/iconos/ver.png',
                                'visible'=>'$data->fecha_aprobacion != null',
                                'options'=>array('target'=>'_blank')
                            ),
                        ),
                ),
	),
)); ?>