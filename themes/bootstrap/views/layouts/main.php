<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        
        <meta name="language" content="es" />
        <meta name="author" content="Sebastian Franco Brantes - Marco Acevedo"/>
        <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
        <meta name="Keywords" content="escuela naval, cadete, armada, chile"/>
        <meta name="description" content="Cadete en Línea" />
        <meta http-equiv="X-UA-Compatible" content="IE=7,8,9" />  
        
        <!-- Bootstrap 3.0 -->
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/bootstrap.css" />
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/normalize.css" />
        
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/init.css" />
        
        <?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>
    <body>
        
        <header>
            <nav role="navigation">
                <div class="menu navbar navbar-fixed-top">
                    <div class="navbar-default navbar-collapse">
                        <div class="container">
                            <div class="navbar-header">
                                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".bs-js-navbar-collapse">
                                    <span class="sr-only">Toggle</span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                    <span class="icon-bar"></span>
                                </button>
                                <a href="<?php echo Yii::app()->createUrl('./'); ?>" class="navbar-brand">Cadete en Línea</a>
                            </div>
                            <div class="navbar-collapse bs-js-navbar-collapse collapse">
                                <?php
                                $this->widget('zii.widgets.CMenu',array(
                                    'htmlOptions' => array(
                                        'class'=>'menu nav navbar-nav navbar',
                                     ),
                                     'submenuHtmlOptions' => array(
                                        'class'=>'dropdown-menu', 
                                     ),
                                     'items'=>array(
                                         array('label'=>'Finanzas <b class="caret"></b>', 'url'=>'#', 
                                                    'linkOptions'=>array(
                                                        'class'=>'dropdown-toggle',
                                                        'data-toggle'=>'dropdown',
                                                    ),
                                                    'items'=>array(
                                                        array('label'=>'Cuenta Corriente', 'url'=>array('cadete/movimientoCuentaCorriente')),
                                                        array('label'=>'Colegiatura', 'url'=>array('transaccion/selectCadete')),
                                                        array('label'=>'Equipo Inicial', 'url'=>array('transaccion/selectCadete')),
                                                    ),                                                    
                                                    'visible'=>(!Yii::app()->user->isGuest && Yii::app()->getSession()->get('rutCadete') )),
                                    ),'encodeLabel' => false,
                                    ));
                                ?>
                                
                                <?php
                                $this->widget('zii.widgets.CMenu',array(
                                    'htmlOptions' => array(
                                        'class'=>'menu nav navbar-nav navbar-right',
                                     ),
                                     'submenuHtmlOptions' => array(
                                        'class'=>'dropdown-menu', 
                                     ),
                                     'items'=>array(
                                         
                                         array('label'=>'<span class="glyphicon glyphicon-cog"></span> Cuenta <b class="caret"></b>', 'url'=>'#', 
                                                    'linkOptions'=>array(
                                                        'class'=>'dropdown-toggle',
                                                        'data-toggle'=>'dropdown',
                                                    ),
                                                    'items'=>array(
                                                        array('label'=>'Seleccionar Cadete', 'url'=>array('apoderado/selectCadete')),
                                                        array('label'=>'Logout ('.Yii::app()->user->name.')', 'url'=>array('/site/logout')),
                                                    ),                                                    
                                                    'visible'=>!Yii::app()->user->isGuest),
                                         
                                         array('label'=>'ingresar', 'url'=>array('/site/login'), 'visible'=>Yii::app()->user->isGuest),
                                    ),'encodeLabel' => false,
                                    ));
                                ?>
                            </div>
                        </div>
                    </div>
                </div>
            </nav>
        </header>
        
        <?php echo $content; ?>
        
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap.js"></script>
        <script type="text/javascript">

        </script>
    </body>
</html>