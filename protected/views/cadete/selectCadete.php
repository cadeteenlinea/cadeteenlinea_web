

    <div class="row">
    <?php foreach ($apoderado->cadetes as $cadete){
        ?>
        <div class="col-lg-6">
            <p><?php echo $cadete->rut0->apellidoPat.' '. $cadete->rut0->apellidoMat.' '. $cadete->rut0->nombres ;?></p>
            <p><?php //echo $cadete->nCadete;?></p>
            <p><?php echo $cadete->curso;?></p>
            <?php echo CHtml::link("seleccionar",array("cadete/selectCadete", "idCadete"=>$cadete->rut),
                                    array("class"=>"btn btn-default")); ?>
        </div>
    <?php } ?>
    </div>
