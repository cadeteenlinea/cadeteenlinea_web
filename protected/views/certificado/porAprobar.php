
<h1>Certificados por aprobar</h1>


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
	'id'=>'certificado-grid',
	'dataProvider'=>$model->search("porAprobar"),
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
                    'name'=>'fecha_solicitud',
                    'header'=>'Fecha Solicitud',
                    'value'=>'$data->fecha_solicitud',
                    'filter'=>'',
                ),
                array(
                    'name'=>'usuario_rut',
                    'header'=>'Pedido por',
                    'value'=>'$data->usuario->NombreCompleto',
                    'filter'=>'',
                ),
                array(
                    'name'=>'cadete_rut',
                    'header'=>'Cadete',
                    'value'=>'"[". $data->cadete->nCadeteView."] " . $data->cadete->usuario->NombreCompleto',
                    'filter'=>'',
                ),
                array(
                    'name'=>'motivo_idmotivo',
                    'header'=>'motivo',
                    'value'=>'$data->motivo->motivo',
                    'filter'=>Motivo::model()->getListMotivos(),
                ),
		/*
		'tipo_certificado_idtipo_certificado',
		'cadete_rut',
		*/
		array(
                        'class'=>'CButtonColumn',
                        'htmlOptions'=>array('width'=>'60px'),
                        'template'=>'{cadete}{aprobar}',
                        'buttons'=>array(
                            'cadete' => array(
                                'label'=>'<i style="font-size: 22px;" class="glyphicon glyphicon-user"></i>',
                                'imageUrl'=>false,
                                'url'=>'Yii::app()->createUrl("cadete/datosCadete/" . $data->cadete_rut)',
                                'options'=>array(
                                    'title'=>'Datos del Cadete',
                                    'class'=>'showModalButton'
                                ),
                            ),
                            'aprobar' => array
                            (
                                'label'=>'<i style="font-size: 22px;" class="glyphicon glyphicon-ok"></i>',
                                'imageUrl'=>false,
                                'url' => 'Yii::app()->createUrl("certificado/aprobar",array("id"=>$data->idcertificado))',
                                'options' => array(
                                    'confirm' => '¿Está seguro que quiere aprobar este Certificado?',
                                    'title'=>'Aprobar',
                                ),
                            ),
                        ),
                ),
	),
)); ?>
