
<style>
    p{
        padding: 0px;
        margin: 0px;
    }
</style>

<h2>Seleccione Cadete</h2>
<?php  ?>
<br/>
<br/>

<div class="row">
    <?php foreach ($cadetes as $cadete){
        ?>
        <div class="col-lg-3 col-md-3 col-sm-4 col-xs-6">
            <div class="thumbnail"><img src="<?php echo $cadete->usuario->imagen(); ?>" alt="<?php echo $cadete->nombres; ?>"></div>
            <div style="height:100px;">
                <p class="text-center">Cadete <?php echo $cadete->nCadeteView;?></p>
                <p class="text-center"><?php echo $cadete->apellidoPat.' '. $cadete->apellidoMat.' '. $cadete->nombres ;?></p>
                <p class="text-center">Curso <?php echo $cadete->curso;?></p>
            </div>
            <?php echo CHtml::link("seleccionar",array("apoderado/selectCadete", "rutCadete"=>$cadete->rut),
                                    array("class"=>"btn btn-default pull-right")); ?>
        </div>
    <?php } ?>
</div>
