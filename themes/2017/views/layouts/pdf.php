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
        
        <?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
</head>
    <body>
        
        <div class="container" style="border: 2px solid #848484; height: 1000px;">
            <div class="row">                
                <br/>
                <?php echo $content; ?>
            </div>
        </div>
        
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap.js"></script>
    </body>
</html>