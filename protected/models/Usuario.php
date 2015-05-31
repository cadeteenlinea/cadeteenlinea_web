<?php

/**
 * This is the model class for table "usuario".
 *
 * The followings are the available columns in table 'usuario':
 * @property string $rut
 * @property string $apellidoPat
 * @property string $apellidoMat
 * @property string $nombres
 * @property string $password_2
 * @property string $perfil
 * @property string $codVerificacion
 * @property string $fechaVerificacion
 *
 * The followings are the available model relations:
 * @property Apoderado $apoderado
 * @property Cadete $cadete
 * @property Funcionario $funcionario
 */
class Usuario extends CActiveRecord
{
        public $newPassword;
        public $passwordRepeat;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'usuario';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('rut, apellidoPat, apellidoMat, nombres, password_2', 'required'),
			array('rut', 'length', 'max'=>10),
                        array('apellidoPat, apellidoMat', 'length', 'max'=>25),
                        array('nombres', 'length', 'max'=>50),
			array('password_2', 'length', 'max'=>250),
			array('perfil', 'length', 'max'=>11),
                        array('codVerificacion', 'length', 'max'=>10),
                    
			array('rut, apellidoPat, apellidoMat, nombres, password_2, perfil', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'apoderado' => array(self::HAS_ONE, 'Apoderado', 'rut'),
			'cadete' => array(self::HAS_ONE, 'Cadete', 'rut'),
			'funcionario' => array(self::HAS_ONE, 'Funcionario', 'rut'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'rut' => 'Rut',
                        'apellidoPat' => 'Apellido Pat',
			'apellidoMat' => 'Apellido Mat',
			'nombres' => 'Nombres',
			'password_2' => 'Clave',
			'perfil' => 'Perfil',
                        'newPassword'=>'Nueva Contraseña',
                        'passwordRepeat'=>'Repetir Nueva Contraseña'
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('rut',$this->rut,true);
                $criteria->compare('apellidoPat',$this->apellidoPat,true);
		$criteria->compare('apellidoMat',$this->apellidoMat,true);
		$criteria->compare('nombres',$this->nombres,true);
		$criteria->compare('password_2',$this->password_2,true);
		$criteria->compare('perfil',$this->perfil,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Usuario the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        
        //Valida que la clave enviada por el usuario sea la misma que se encuentra
        //en la base de datos
        public function validatePassword($password){
            //return $this->hashPassword($password)===$this->password_2;
            return $this->password_2 === $password;
        }
        
        //Genera la clave encriptada guardada en la base de datos
        //se utiliza el hash MD5
        public function hashPassword($password){
            return md5($password);
        }
        
        //valida la ubicación de la imagen a utilizar por el cadete
        //en caso de que no exista, retorna una por defecto
        public function imagen(){
            if(file_exists(Yii::getPathOfAlias('webroot.images.usuario')."/".$this->rut.".jpg")){
            //if(file_exists(Yii::app()->request->baseUrl."/images/usuario/".$this->rut.".jpg")){
                return Yii::app()->request->baseUrl."/images/usuario/".$this->rut.".jpg";
            }else{
                return Yii::app()->request->baseUrl."/images/usuario/000.jpg";
            }
        }
        
        public function asignarCodVerificaciónYFecha(){
            $random = '';
            for ($i = 0; $i < 10; $i++) {
              $random .= chr(mt_rand(33, 126));
            }
            $this->codVerificacion = $random;
            $this->fechaVerificacion = date("Y-m-d H:i:s");
            return $random;
        } 
        
        public function enviarEmailContrasena(){
            if(mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers))
                return true;
            return false;
        }   
        
        public function resetContrasena($model){
            //código de verificación vacio, nunca se solicito reset de contraseña
            if($this->codVerificacion!=null){
                //Codigo de verificación no coinciden
                if($this->codVerificacion === $model->codVerificacion){
                    if($this->validarFechaTiempo()){
                        $this->password_2 = $model->password;
                        $this->codVerificacion = null;
                        $this->fechaVerificacion = null;
                        if($this->save()){
                            return true;
                        }  
                    }
                }
            }
            return false;
        }
        
        public function validarFechaTiempo(){
            $fecha = $this->fechaVerificacion;
            $fecha = strtotime ( '+24 hour' , strtotime ( $fecha ) ) ;
            $now = date("Y-m-d H:i:s");
            if($fecha > $now)
                return true;
                
            return false;
        }
        
}
