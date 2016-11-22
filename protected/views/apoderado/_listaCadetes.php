<div class="row">
    <?php foreach ($cadetes as $cadete){
        ?>
    
        <?php
            $classCss = "cadeteSelect";
            $imagenGris = "";
            if($cadete->usuario->estado_idestado == 0){
                $classCss = "cadeteSelectRetirado";
                $imagenGris = "imagenGris";
            }
        ?>
        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6 <?php echo  $classCss;?>">
            <div class="thumbnail"><img src="<?php echo $cadete->usuario->imagen(); ?>" alt="<?php echo $cadete->usuario->nombres; ?>" class="<?php echo  $imagenGris;?>"></div>
            <div style="height:100px;">
                <p class="text-center">Cadete <?php echo $cadete->nCadeteView;?></p>
                <p class="text-center"><?php echo $cadete->usuario->apellidoPat.' '. $cadete->usuario->apellidoMat.' '. $cadete->usuario->nombres ;?></p>
                <p class="text-center">Curso <?php echo $cadete->curso;?></p>
            </div>
            <?php
            if($cadete->usuario->estado_idestado == 0){
            ?>
                <p style="font-size: 24px;"><i class="glyphicon glyphicon-off pull-left" title="Retirado"></i></p>
            <?php
            }
            ?>
            <?php echo CHtml::link("seleccionar",array("apoderado/selectCadete", "rutCadete"=>$cadete->rut),
                                    array("class"=>"btn btn-default pull-right")); ?>
        </div>
    <?php } ?>
</div>

