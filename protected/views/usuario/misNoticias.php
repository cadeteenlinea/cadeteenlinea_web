<h1>Noticias</h1>
<div class="row">
    <div class="col-lg-10 col-md-10">
    <?php 
    foreach ($noticias as $noticia){
    ?>
        <div id="noticia_<?php echo $noticia->idnoticia ?>" class="cadeteSelect col-lg-12">
            <div class="col-lg-12">
                <h3 style="margin-bottom: 0px;"><?php echo $noticia->titulo; ?></h3>
                <p style="font-style: italic; font-size: 12px;">
                    de: <?php echo $noticia->usuario->NombreCompleto .' - '. $noticia->usuario->funcionario->tipo ?>
                </p>
                <p style="font-size: 14px; text-align: justify;"><?php echo nl2br($noticia->getCuerpoNoticia()); ?></p>
            </div>

            <div class="col-lg-12">
                <?php
                if($noticia->documento() != null){
                ?>
                    <a class="pull-right" href="<?php echo Yii::app()->createUrl('noticia/viewFile',array('id'=>$noticia->idnoticia)) ?>" title="<?php echo $noticia->titulo ?>" target="_blank"><image src="<?php echo $noticia->tipoDocumento(); ?>" /></a>
                <?php
                }
                ?> 
            </div>   

            <div class="col-lg-12" style="margin-top:5px;">
                <?php $fecha=strftime("%d-%m-%Y", strtotime($noticia->fecha)) ; ?>
                <p style="text-align: right; font-style: italic; font-size: 12px;"><i><?php echo $fecha; ?></i></p>
            </div> 
        </div>
        
    <?php    
    }
    ?>
        </div>
</div>
