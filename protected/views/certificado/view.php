
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
    
    
