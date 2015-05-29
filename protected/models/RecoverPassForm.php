<?php

class RecoverPassForm extends CFormModel
{
    public $rut;
    public $usuario;
    
    public function rules()
    {
        return array(
            array('rut', 'required'),
            array('rut', 'validateRut'),
            array('rut', 'validacionUsuario'),
        ); 
    }
    
    public function attributeLabels()
    {
        return array(
            'rut'=>'Rut Usuario',
        );
    }
    
    public function validateRut($attribute, $params) {
            $data = explode('-', $this->rut);
            $evaluate = strrev($data[0]);
            $multiply = 2;
            $store = 0;
            for ($i = 0; $i < strlen($evaluate); $i++) {
                $store += $evaluate[$i] * $multiply;
                $multiply++;
                if ($multiply > 7)
                    $multiply = 2;
            }
            isset($data[1]) ? $verifyCode = strtolower($data[1]) : $verifyCode = '';
            $result = 11 - ($store % 11);
            if ($result == 10)
                $result = 'k';
            if ($result == 11)
                $result = 0;
            if ($verifyCode != $result)
                $this->addError('rut', 'Rut inválido.');
        }
    
    public function validacionUsuario($attribute,$params){
        $rut=substr(strtolower($this->rut),0,-2);
        $model=Usuario::model()->findByPk($rut);
        if($model===null){
            $this->addError('rut', 'Rut no registrado en el sistema');
        }
    }
    
    public function enviarCorreo(){
        
    }
}
?>
