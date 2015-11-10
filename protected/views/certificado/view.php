
<div style=" padding-left: 100px; padding-right: 100px;">
    

<div class="col-lg-12">
    <h2 align="center">Certificado de <?php echo $model->tipoCertificado->nombre ?></h2>
</div>
<br/>
<div class="col-lg-12">
    <p style="text-align: justify;">
        La Escuela Naval "Arturo Prat", Certifica que: don(ña) 
        <b><?php echo $model->cadete->usuario->nombres .' '.  
                $model->cadete->usuario->apellidoPat . ' '. 
                $model->cadete->usuario->apellidoMat; ?></b>, 
        RUN
        <b><?php echo $model->cadete->usuario->rut; ?></b> , es alumno regular
        de la institución, durante el periodo academico 2015
    </p>
    
    <p style="text-align: justify;">
        Se otorga el presente certificado, a petición del interesado, para 
        <?php echo $model->motivo->motivo ?>
    </p>
</div>

<br/><br/><br/><br/><br/><br/>
<br/><br/><br/><br/><br/><br/>
<div class="col-lg-12">
    <p style="text-align: center;">
        Gabriel Farias Riquelme<br/>
        Capitán de Corbeta<br/>
        Unidad de Registro Educacional
    </p>
</div>
</div>  

<br/><br/><br/><br/><br/><br/><br/>

<div class="col-lg-6">  
<?php 
$this->widget('application.extensions.qrcode.QRCode', array(
    'content' => 'localhost/cadeteenlinea/certificado/validar', // qrcode data content
    'filename' => $model->idcertificado.".png", // image name (make sure it should be .png)
    'width' => '120', // qrcode image height 
    'height' => '120', // qrcode image width 
    'encoding' => 'UTF-8', // qrcode encoding method 
    'correction' => 'H', // error correction level (L,M,Q,H)
    'watermark' => 'No' // set Yes if you want watermark image in Qrcode else 'No'. for 'Yes', you need to set watermark image $stamp in QRCode.php
));
?>
    <br/>
    Fecha de emisión: <?php $model->fecha_aprobacion?>
    
</div>
