<?php /* @var $this Controller */ ?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" xml:lang="es" lang="es">
<head>
	<meta http-equiv="Content-Type" content="text/html; charset=utf-8" />
        <link rel="shortcut Icon" href="<?php echo Yii::app()->request->baseUrl; ?>/images/iconos/cadeteenlinea.ico"/>
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
        
        <?php /*Yii::app()->clientScript->registerCoreScript('jquery'); */?>

        <?php
            $cs=Yii::app()->clientScript;
            $cs->registerScriptFile(Yii::app()->baseUrl . '/js/jquery.js', CClientScript::POS_HEAD);
        ?>
        
        
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
                                         array('label'=>'Académia <b class="caret"></b>', 'url'=>'#', 
                                                    'linkOptions'=>array(
                                                        'class'=>'dropdown-toggle',
                                                        'data-toggle'=>'dropdown',
                                                    ),
                                                    'items'=>array(
                                                        array('label'=>'Notas Parciales', 'url'=>array('cadete/notasParciales')),
                                                        array('label'=>'Resumen anual', 'url'=>array('cadete/notasFinales')),
                                                        array('label'=>'Examen Inglés TAE', 'url'=>array('cadete/notasTae')),
                                                    ),                                                    
                                                    'visible'=>(!Yii::app()->user->isGuest && Yii::app()->getSession()->get('rutCadete') )),
                                         array('label'=>'Calificaciones', 'url'=>array('cadete/calificaciones'),'visible'=>(!Yii::app()->user->isGuest && Yii::app()->getSession()->get('rutCadete'))),
                                         array('label'=>'Físico <b class="caret"></b>', 'url'=>'#', 
                                                    'linkOptions'=>array(
                                                        'class'=>'dropdown-toggle',
                                                        'data-toggle'=>'dropdown',
                                                    ),
                                                    'items'=>array(
                                                        array('label'=>'Ficha Capacidad física', 'url'=>array('cadete/fichaCapacidad')),
                                                        array('label'=>'Nivelacion', 'url'=>array('cadete/nivelacion')),
                                                    ),                                                    
                                                    'visible'=>(!Yii::app()->user->isGuest && Yii::app()->getSession()->get('rutCadete') )),
                                         array('label'=>'Finanzas <b class="caret"></b>', 'url'=>'#', 
                                                    'linkOptions'=>array(
                                                        'class'=>'dropdown-toggle',
                                                        'data-toggle'=>'dropdown',
                                                    ),
                                                    'items'=>array(
                                                        array('label'=>'Cuenta Corriente', 'url'=>array('cadete/movimientoCuentaCorriente')),
                                                        array('label'=>'Colegiatura', 'url'=>array('cadete/movimientoColegiatura')),
                                                        array('label'=>'Equipo Inicial', 'url'=>array('cadete/movimientoEquipo')),
                                                    ),                                                    
                                                    'visible'=>(!Yii::app()->user->isGuest && Yii::app()->getSession()->get('rutCadete') )),
                                         array('label'=>'Hora Salida', 'url'=>array('cadete/francos'),'visible'=>(!Yii::app()->user->isGuest && Yii::app()->getSession()->get('rutCadete'))),
                                         array('label'=>'Certificados <b class="caret"></b>', 'url'=>'#', 
                                                    'linkOptions'=>array(
                                                        'class'=>'dropdown-toggle',
                                                        'data-toggle'=>'dropdown',
                                                    ),
                                                    'items'=>array(
                                                        array('label'=>'Solicitar', 'url'=>array('certificado/create')),
                                                        array('label'=>'Ver mis certificados', 'url'=>array('certificado/misCertificados')),
                                                    ),                                                    
                                                    'visible'=>(!Yii::app()->user->isGuest && Yii::app()->getSession()->get('rutCadete') )),
                                         array('label'=>'Certificados <b class="caret"></b>', 'url'=>'#', 
                                                    'linkOptions'=>array(
                                                        'class'=>'dropdown-toggle',
                                                        'data-toggle'=>'dropdown',
                                                    ),
                                                    'items'=>array(
                                                        array('label'=>'Certificados por aprobar', 'url'=>array('certificado/admin')),
                                                    ),                                                    
                                                    'visible'=>(Yii::app()->getSession()->get("tipoFuncionario") == "administrativo" || Yii::app()->getSession()->get("tipoFuncionario") == "Administrador" )),
                                         array('label'=>'Noticias', 'url'=>array('noticia/admin'),'visible'=>(Yii::app()->getSession()->get('tipoFuncionario')=="Administrador" )),
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
                                         array('label'=>'<span class="glyphicon glyphicon-cog"></span> Cpanel <b class="caret"></b>', 'url'=>'#', 
                                                    'linkOptions'=>array(
                                                        'class'=>'dropdown-toggle',
                                                        'data-toggle'=>'dropdown',
                                                    ),
                                                    'items'=>array(
                                                        array('label'=>'Archivos', 'url'=>array('archivos/')),
                                                    ),                                                    
                                                    'visible'=>(!Yii::app()->user->isGuest && Yii::app()->getSession()->get('tipoFuncionario')=="Administrador" )),
                                         array('label'=>'<span class="glyphicon glyphicon-cog"></span> Cuenta <b class="caret"></b>', 'url'=>'#', 
                                                    'linkOptions'=>array(
                                                        'class'=>'dropdown-toggle',
                                                        'data-toggle'=>'dropdown',
                                                    ),
                                                    'items'=>array(
                                                        array('label'=>'Cambio Contraseña', 'url'=>array('usuario/cambioPassword'),'visible'=>(!Yii::app()->user->isGuest)),
                                                        array('label'=>'Datos Personales', 'url'=>array('usuario/datosPersonales'),'visible'=>(!Yii::app()->user->isGuest)),
                                                        array('label'=>'Seleccionar Cadete', 'url'=>array('apoderado/selectCadete') , 'visible'=>Yii::app()->getSession()->get('perfil')=='apoderado'),
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