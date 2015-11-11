
<div style=" padding-left: 100px; padding-right: 100px;">
    

<div class="col-lg-12">
    <h2 align="center">Certificado de <?php echo $model->tipoCertificado->nombre ?></h2>
</div>
<br/>
<div class="col-lg-12" style="height: 320px;">
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

<div class="col-lg-12" style="height: 100px;">
    <img style="margin-left: 70px;" align="center" src="<?php echo Yii::app()->request->baseUrl; ?>/images/qrcodes/firma.jpg" />
</div>
</div>  



<div class="col-lg-12" style="width: 350px; margin-top: 45px;">  
    <?php 
    $this->widget('application.extensions.qrcode.QRCodeGenerator',array(
        'data' => 'http://www.someurl.com',
        'filename' => $model->idcertificado.".png",
        'subfolderVar' => false,
        'displayImage'=>true,
        'errorCorrectionLevel'=>'L',
        'matrixPointSize'=>4, // 1 to 10 only
    )) 
    ?>
    
    <p style="margin-top: 5px;">
        Fecha de emisión: <?php $model->fecha_aprobacion?> 5 de diciembre de 2015
    </p>
</div>

<div style="width: 280px; height: 60px; margin-left: 400px; margin-top: -70px;" >
    <p style="text-align: right;">
        Folio: <?php $model->idcertificado;?><br/>
        ID alumno: <?php $model->cadete->usuario->rut;?><br/>
        Válido Hasta: <?php $model->idcertificado;?>
    </p>
</div>

<div class="col-lg-6" style="margin-top:15px; height: 40px; width: 670px; border-top: 1px solid #848484;">
    <p style="text-align: center; margin-top: 10px;">
        htttp://cadetes.escuelanaval.cl/certificados/validar
    </p>
</div>