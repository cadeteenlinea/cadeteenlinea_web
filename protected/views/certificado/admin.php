
<h1>Certificados</h1>


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
	'dataProvider'=>$model->search(false),
	'filter'=>$model,
	'columns'=>array(
		'idcertificado',
		'fecha_solicitud',
		array(
                    'name'=>'motivo_idmotivo',
                    'header'=>'motivo',
                    'value'=>'$data->motivo->motivo',
                    'filter'=>Motivo::model()->getListMotivos(),
                ),
		'usuario_rut',
		/*
		'tipo_certificado_idtipo_certificado',
		'cadete_rut',
		*/
		array(
                        'class'=>'CButtonColumn',
                        'htmlOptions'=>array('width'=>'50px'),
                        'template'=>'{aprobar}',
                        'buttons'=>array(
                            'aprobar' => array
                            (
                                'label'=>'aprobar',
                                'imageUrl'=>Yii::app()->request->baseUrl.'/images/iconos/vistoBueno.png',
                                'url' => 'Yii::app()->createUrl("certificado/aprobar",array("id"=>$data->idcertificado))',
                                'options' => array(
                                    'confirm' => '¿Está seguro que quiere aprobar este Certificado?',
                                 ),
                            ),
                        ),
                ),
	),
)); ?>
