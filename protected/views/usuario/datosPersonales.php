<br/><br/><br/>
<div class="row">
    <div class="col-lg-3 col-md-3 col-sm-4 col-xs-12">
        <div class="thumbnail"><img src="<?php echo $model->imagen(); ?>" alt="<?php echo $model->nombres; ?>"></div>
        <div style="height:100px;">
            <p class="text-center"><?php echo $model->apellidoPat.' '. $model->apellidoMat.' '. $model->nombres ;?></p>
        </div>
    </div>
    <div class="col-lg-9 col-md-9 col-sm-8 col-xs-12">
        <h3 style="margin-top: 0px;">Datos Personales</h3>
        <p>
            <b>R.U.N. : </b> <?php echo $model->getRut(); ?> <br/>
            <b>Email : </b> <?php echo $model->email; ?> &nbsp;&nbsp;&nbsp;&nbsp;<?php echo CHtml::link('editar',array('usuario/update')); ?><br/>
            
            <?php if(!empty($model->apoderado)){ ?>
            <b>Dirección : </b> <?php echo $model->apoderado->direccion;?><br/>
            <b>Ciudad : </b> <?php echo $model->apoderado->ciudad;?><br/>
            <b>Comuna : </b> <?php echo $model->apoderado->comuna;?><br/>  
            <b>Fono : </b> <?php echo $model->apoderado->fono;?><br/>
            <b>Fono Comercial : </b> <?php echo $model->apoderado->fonoComercial;?><br/>
            <?php }else if(!empty($model->cadete)){?>
            <b>Fecha Nacimiento : </b> 
                <?php echo $model->cadete->diaNacimiento . '/' .$model->cadete->mesNacimiento .'/'. $model->cadete->anoNacimiento;?><br/>  
            <b>Lugar de Nacimiento : </b> <?php echo $model->cadete->lugarNacimiento;?><br/>  
            <b>Nacionalidad : </b> <?php echo $model->cadete->nacionalidad;?><br/>  
            
        </p>
            <h3>Antecedentes académicos</h3>
        <p>
            <b>N° cadete : </b> <?php echo $model->cadete->nCadete;?><br/>  
            <b>Curso : </b> <?php echo $model->cadete->curso;?><br/>  
            <b>Año Ingreso : </b> <?php echo $model->cadete->anoIngreso;?><br/>  
            <b>Selección : </b> <?php echo $model->cadete->seleccion;?><br/>  
            <b>Nivel : </b> <?php echo $model->cadete->nivel;?><br/>  
            <b>Circulo : </b> <?php echo $model->cadete->circulo;?><br/>  
            
            <?php }?>
        </p> 
    </div>
    
    <div id="statusMsg">
        <?php if(Yii::app()->user->hasFlash('success')):?>
            <div style="margin-top: 20px;" class="flash-success col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <?php echo Yii::app()->user->getFlash('success'); ?>
            </div>
        <?php endif; ?>

        <?php if(Yii::app()->user->hasFlash('error')):?>
            <div style="margin-top: 20px;" class="flash-error col-lg-12 col-md-12 col-sm-12 col-xs-12">
                <?php echo Yii::app()->user->getFlash('error'); ?>
            </div>
        <?php endif; ?>
    </div>
</div>



