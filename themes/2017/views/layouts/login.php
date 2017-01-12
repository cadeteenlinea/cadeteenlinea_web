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
        <link rel="stylesheet" type="text/css" href="<?php echo Yii::app()->request->baseUrl; ?>/css/login.css" />
        
        <?php Yii::app()->clientScript->registerCoreScript('jquery'); ?>

	<title><?php echo CHtml::encode($this->pageTitle); ?></title>
        

        
</head>
    <body>
        
        <div class="container-fluid">
            <div class="row row_100">
                <div class="col-lg-1 col-md-1 col-sm-1 col-xs-1"></div>
                <div class="col-lg-4 col-md-4 col-sm-5 col-xs-10 contenedor-login">
                    <div class="row">
                        <div class="col-lg-2 col-md-2 col-sm-1 col-xs-1"></div>
                        <div class="col-lg-8 col-md-8 col-md-10 col-xs-10">
                            <?php echo $content; ?>
                        </div> 
                        <div class="col-lg-2 col-md-2 col-sm-1 col-xs-1"></div>
                    </div>
                    
                    <div class="contanido_general_medalla">
                        <image class="hidden-xs" style="margin-left:90%; height: 150px;" src="<?php echo Yii::app()->request->baseUrl; ?>/images/design/escuedo_esnaval.png" />
                    </div>
                    
                    <div class="contanido_general_redes_datos" style="bottom: 30px; position: absolute; 
                            margin-left: auto;
                            margin-right: auto;
                            left: 0;
                            right: 0;">
                        <div class="row">
                            <div class="col-lg-12 col-md-12 col-sm-12 hidden-xs">
                                <div class="col-lg-2 col-md-2"></div>
                                <a href="https://www.facebook.com/EscuelaNavalChile" target="_blank"><img style="float: left;" src="<?php echo Yii::app()->request->baseUrl; ?>/images/design/icon_face.png"    class="col-lg-2 col-md-2 col-sm-3 col-xs-3" alt="" /></a>
                                <a href="https://www.youtube.com/c/escuelanavalarturoprat" target="_blank"><img style="float: left;" src="<?php echo Yii::app()->request->baseUrl; ?>/images/design/icon_youtube.png" class="col-lg-2 col-md-2 col-sm-3 col-xs-3" alt="" /></a>
                                <a href="https://www.flickr.com/photos/escuelanaval/sets" target="_blank"><img style="float: left;" src="<?php echo Yii::app()->request->baseUrl; ?>/images/design/icon_flick.png"   class="col-lg-2 col-md-2 col-sm-3 col-xs-3" alt="" /></a>
                                <a href="mailto:webmaster@escuelanaval.cl" ><img style="float: left;" src="<?php echo Yii::app()->request->baseUrl; ?>/images/design/icon_correo.png"  class="col-lg-2 col-md-2 col-sm-3 col-xs-3" alt="" /></a>
                            </div>
                        </div>

                        <footer>
                            <div class="row">
                                <div class="col-lg-12 hidden-xs" style="text-align: center; ">
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
                        </footer>
                    </div>
                </div>
            </div>
        </div>
        
        <script type="text/javascript" src="<?php echo Yii::app()->request->baseUrl; ?>/js/bootstrap.js"></script>
        <script type="text/javascript">
            $(document).ready(function() {
                window_resize();
                $(window).resize(function() {
                  window_resize();
                });
                
                var imagen1 = '<?php echo Yii::app()->request->baseUrl; ?>/images/design/background_login_2.jpg';
                var imagen2 = '<?php echo Yii::app()->request->baseUrl; ?>/images/design/background_login.jpg';
                var img1 = 0;
                var img2 = 0;
                var changeInterval=8000;
                
                setInterval(function(){
                    var imagen = null;
                    if(img2==0){
                        imagen = imagen1;
                        img1 = 0;
                        img2 = 1;
                    }else{
                        imagen = imagen2;
                        img1 = 1;
                        img2 = 0;
                    }
                    
                    $('body').css('background', "url('"+ imagen + "')" +" no-repeat center center fixed");
                    $('body').css('-webkit-background-size', "cover");
                    $('body').css('-moz-background-size', "cover");
                    $('body').css('-o-background-size', "cover");
                    $('body').css('background', "cover");
                },changeInterval);
            });
            
            function window_resize(){
                var altura = $(window).height();
                var anchura = $(window).width();
                if(altura<620){
                    $(".contanido_general_medalla").hide();
                    $(".contanido_general_redes_datos").hide();
                }else{
                    $(".contanido_general_medalla").show();
                    $(".contanido_general_redes_datos").show();
                }
                
                if(anchura<400){
                    $(".contenedor-login").css("padding-top","80px"); 
                }else{
                    $(".contenedor-login").css("padding-top","20px");
                }
            } 
        </script>
    </body>
</html>