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
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/main.css" />
        
        <?php Yii::app()->clientScript->registerCoreScript('jquery');?>

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
                                <a href="<?php echo Yii::app()->createUrl('./'); ?>" class="navbar-brand">Portal Cadete</a>
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
                                         array('label'=>'Académico <b class="caret"></b>', 'url'=>'#', 
                                                    'linkOptions'=>array(
                                                        'class'=>'dropdown-toggle',
                                                        'data-toggle'=>'dropdown',
                                                    ),
                                                    'items'=>array(
                                                        array('label'=>'Notas Parciales', 'url'=>array('cadete/notasParciales')),
                                                        array('label'=>'Notas Finales por año', 'url'=>array('cadete/notasFinales')),
                                                        array('label'=>'Resumen Final por año', 'url'=>array('cadete/resumenFinalAnos')),
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
                                                        array('label'=>'Nivelación', 'url'=>array('cadete/nivelacion')),
                                                    ),                                                    
                                                    'visible'=>(!Yii::app()->user->isGuest && Yii::app()->getSession()->get('rutCadete') )),
                                         array('label'=>'Finanzas', 'url'=>'https://www.recaudaciones.bancochile.cl/cliente/pgdr/appfront/Pag_Login.aspx?IdCon=92','linkOptions' => array('target'=>'_blank'),'visible'=>(!Yii::app()->user->isGuest && Yii::app()->getSession()->get('rutCadete'))),
                                         /*array('label'=>'Finanzas <b class="caret"></b>', 'url'=>'#', 
                                                    'linkOptions'=>array(
                                                        'class'=>'dropdown-toggle',
                                                        'data-toggle'=>'dropdown',
                                                    ),
                                                    'items'=>array(
                                                        //array('label'=>'Cuenta Corriente', 'url'=>array('cadete/movimientoCuentaCorriente')),
                                                        //array('label'=>'Colegiatura', 'url'=>array('cadete/movimientoColegiatura')),
                                                        //array('label'=>'Equipo Inicial', 'url'=>array('cadete/movimientoEquipo')),
                                                    ),                                                    
                                                    'visible'=>(!Yii::app()->user->isGuest && Yii::app()->getSession()->get('rutCadete') && Yii::app()->getSession()->get('perfil')=='apoderado' || !Yii::app()->user->isGuest && Yii::app()->getSession()->get('rutCadete') && Yii::app()->getSession()->get('tipoFuncionario')=='Administrador')),*/
                                         array('label'=>'Hora Salida', 'url'=>array('cadete/francos'),'visible'=>(!Yii::app()->user->isGuest && Yii::app()->getSession()->get('rutCadete'))),
                                         array('label'=>'Certificados <b class="caret"></b>', 'url'=>'#', 
                                                    'linkOptions'=>array(
                                                        'class'=>'dropdown-toggle',
                                                        'data-toggle'=>'dropdown',
                                                    ),
                                                    'items'=>array(
                                                        array('label'=>'Solicitar', 'url'=>array('certificado/create'), 'visible'=>(!Yii::app()->user->isGuest && Yii::app()->getSession()->get('rutCadete') )),
                                                        array('label'=>'Ver mis certificados', 'url'=>array('certificado/misCertificados'), 'visible'=>(!Yii::app()->user->isGuest && Yii::app()->getSession()->get('rutCadete') )),
                                                        array('label'=>'Certificados aprobados', 'url'=>array('certificado/aprobados'), 'visible'=>(Yii::app()->getSession()->get("tipoFuncionario") == "administrativo" || Yii::app()->getSession()->get("tipoFuncionario") == "Administrador" )),
                                                        array('label'=>'Certificados por aprobar', 'url'=>array('certificado/porAprobar'), 'visible'=>(Yii::app()->getSession()->get("tipoFuncionario") == "administrativo" || Yii::app()->getSession()->get("tipoFuncionario") == "Administrador" )),   
                                                    ),                                                    
                                                    'visible'=>(!Yii::app()->user->isGuest && Yii::app()->getSession()->get('rutCadete') || Yii::app()->getSession()->get("tipoFuncionario") == "administrativo" || Yii::app()->getSession()->get("tipoFuncionario") == "Administrador")),
                                         array('label'=>'Noticias', 'url'=>array('noticia/admin'),'visible'=>(Yii::app()->getSession()->get('tipoFuncionario')=="Administrador" || Yii::app()->getSession()->get('tipoFuncionario')=="Oficial" )),
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
                                         /*array('label'=>'<span class="glyphicon glyphicon-cog"></span> Cpanel <b class="caret"></b>', 'url'=>'#', 
                                                    'linkOptions'=>array(
                                                        'class'=>'dropdown-toggle',
                                                        'data-toggle'=>'dropdown',
                                                    ),
                                                    'items'=>array(
                                                        array('label'=>'Archivos', 'url'=>array('archivos/')),
                                                    ),                                                    
                                                    'visible'=>(!Yii::app()->user->isGuest && Yii::app()->getSession()->get('tipoFuncionario')=="Administrador" )),*/
                                         array('label'=>'<span class="glyphicon glyphicon-apple"></span><b class="caret"></b>', 'url'=>'#', 
                                                    'linkOptions'=>array(
                                                        'class'=>'dropdown-toggle',
                                                        'data-toggle'=>'dropdown',
                                                    ),
                                                    'items'=>array(
                                                        array('label'=>'Reiniciar Tablas', 'url'=>array('administracion/ReiniciarTablas')),
                                                        array('label'=>'Ver usuarios', 'url'=>array('usuario/admin')),
                                                    ),                                                    
                                                    'visible'=>(Yii::app()->getSession()->get('tipoFuncionario')=="Administrador")),
                                         array('label'=>'<span class="glyphicon glyphicon-phone"></span> Contactos <b class="caret"></b>', 'url'=>'#', 
                                                    'linkOptions'=>array(
                                                        'class'=>'dropdown-toggle',
                                                        'data-toggle'=>'dropdown',
                                                    ),
                                                    'items'=>array(
                                                        array('label'=>'Departamentos', 'url'=>array('contacto/contactoDepartamentos')),
                                                        array('label'=>'Oficiales de División', 'url'=>array('contacto/contactoOficiales')),
                                                    ),                                                    
                                                    'visible'=>(!Yii::app()->user->isGuest)),
                                         array('label'=>'<span class="glyphicon glyphicon-user"></span> Cuenta <b class="caret"></b>', 'url'=>'#', 
                                                    'linkOptions'=>array(
                                                        'class'=>'dropdown-toggle',
                                                        'data-toggle'=>'dropdown',
                                                    ),
                                                    'items'=>array(
                                                        array('label'=>'Cambiar Contraseña', 'url'=>array('usuario/cambioPassword'),'visible'=>(!Yii::app()->user->isGuest)),
                                                        array('label'=>'Datos Personales', 'url'=>array('usuario/datosPersonales'),'visible'=>(!Yii::app()->user->isGuest)),
                                                        array('label'=>'Perfiles de Egreso', 'url'=>array('cadete/perfilEgreso'),'visible'=>(!Yii::app()->user->isGuest)),
                                                        array('label'=>'Seleccionar Cadete', 'url'=>array('apoderado/selectCadete') , 
                                                            'visible'=>(Yii::app()->getSession()->get('perfil')=='apoderado') || Yii::app()->getSession()->get('tipoFuncionario')=='Oficial' || Yii::app()->getSession()->get('tipoFuncionario')=='Administrador'|| Yii::app()->getSession()->get('tipoFuncionario')=='administrativo'),
                                                        array('label'=>'Cerrar sesión ('.Yii::app()->user->name.')', 'url'=>array('/site/logout')),
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
        
        <!-- visualización del cadete seleccionado -->
        <div class="container text-right" style="height: 50px; padding-top: 70px;">
            <div class="row">
                <div class="col-lg-12">
                    <p style="color: #585858; font-style: italic;">
                        <?php
                            if(Yii::app()->getSession()->get('nCadete'))
                                echo CHtml::link('Cadete N°'. Yii::app()->getSession()->get('nCadete').' - '. Yii::app()->getSession()->get('apellidoPaternoCadete'),
                                        array('cadete/datosCadete'),
                                        array('title'=>'Datos del Cadete'));
                        ?>
                    </p>
                </div>
            </div>
        </div>
        
        <?php 
            //Validación de mensaje para solicitar cambio de correo electrónico
            if(Yii::app()->getSession()->get('email') == 'cadete@escuelanaval.cl' || Yii::app()->getSession()->get('email') == '' && !Yii::app()->user->isGuest){
        ?>
            <div class="container">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="alert alert-info pull-right" role="alert">
                            &thinsp;&thinsp;&thinsp;&thinsp;
                            Favor de actualizar correo electrónico 
                            <b>
                            <?php 
                            echo CHtml::link('Aquí',
                                            array('usuario/updateMisDatos'),
                                            array('title'=>'Actualizar correo electrónico'));
                            ?>
                            </b>
                        </div>
                    </div>
                </div>
            </div>
        <?php } ?>
        
        <?php echo $content; ?>
        
        
        <div id="modal" class="fade modal" role="dialog">
            <div class="modal-dialog modal-lg">
                <div class="modal-content">
                    <div class="modal-header">
                        <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                        <span id="modalHeaderTitle"></span>
                    </div>
                    <div class="modal-body">
                        <div id='modalContent'></div>
                    </div>
                </div>    
            </div>
        </div> 
        
        <footer>
            <div class="container-fluid">
                <div class="row">
                    <div class="col-lg-12" style="text-align: center; ">
                        <h3>
                            <a style="color: #0b0b0c !important;" href="http://escuelanaval.cl/" target="_blank">
                                www.escuelanaval.mil.cl
                            </a>
                        </h3>
                        <div class="col-lg-12">
                        <p style="font-size: 12px;">
                            <a style="color: #2b2b2c !important;" title="ver mapa" href="http://escuelanaval.cl/Esc_contacto.html" target="_blank">
                                Avda. González de Hontaneda N° 11 Playa Ancha Valparaiso.
                            </a><br/>
                            Teléfono (32) 2785240 email: <a style="color: #2b2b2c !important;" title="enviar email" href="mailto:webmaster@escuelanaval.cl">webmaster@escuelanaval.cl</a>
                        </p>
                    </div>    
                    </div>
                </div>
            </div>
        </footer>
        
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap.js"></script>
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/modal.js"></script>

        <script type="text/javascript">

        </script>
    </body>
</html>