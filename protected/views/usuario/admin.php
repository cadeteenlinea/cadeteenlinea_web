<?php
/* @var $this UsuarioController */
/* @var $model Usuario */

$this->breadcrumbs=array(
	'Usuarios'=>array('index'),
	'Manage',
);

$this->menu=array(
	array('label'=>'Nuevo Funcionario', 'url'=>array('create')),
);
?>

<h1>Usuarios</h1>

<?php $this->widget('zii.widgets.grid.CGridView', array(
	'id'=>'usuario-grid',
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
		'rut',
		array(
                    'name'=>'nombres',
                    'header'=>'Nombre',
                    'value'=>'$data->NombreCompleto',
                ),
		'password_2',
                array(
                    'name'=>'perfil',
                    'header'=>'Perfil',
                    'value'=>'$data->perfil',
                    'filter'=>  Usuario::model()->getPerfiles(),
                ),
                'email',
		array(
                        'class'=>'CButtonColumn',
                        'htmlOptions'=>array('width'=>'100px'),
                        'template'=>'',
                        'afterDelete'=>'function(link,success,data){ if(success) $("#statusMsg").html(data); }',
                        'buttons'=>array(
                            'view' => array(
                                'label'=>'<i style="font-size: 22px;" class="glyphicon glyphicon-user"></i>',
                                'imageUrl'=>false,
                                'url'=>'Yii::app()->createUrl("cadete/datosCadete/" . $data->rut)',
                                'options'=>array(
                                    'title'=>'Datos del Usuario',
                                    'class'=>'showModalButton'
                                ),
                            ),
                        ),
                ),
	),
)); ?>
