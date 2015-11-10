<?php echo CHtml::link(CHtml::image(Yii::app()->baseUrl."/images/pdf.jpg","PDF",array(
    "title"=>"Exportar a PDF")),array("generarpdf")); 

echo CHtml::dropDownList('motivo', $motivo, 
              $list,
              array('empty' => '(Seleccionar Motivo'));


/*echo CHtml::dropDownList('ano', 'ano', Certificado::model()->getListAno(Yii::app()->getSession()->get('rutCadete')),
    array('class'=>'btn btn-default','style'=>'width:125px;','submit'=>Yii::app()->request->url,
        'options'=> array($ano=>array('selected'=>'selected'))
));*/
?>

