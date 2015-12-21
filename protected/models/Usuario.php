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
 * @property string $email
 *
 * The followings are the available model relations:
 * @property Apoderado $apoderado
 * @property Cadete $cadete
 * @property Funcionario $funcionario
 * @property Noticia $noticias
 */
class Usuario extends CActiveRecord
{
        public $newPassword;
        public $repeatPassword;
        public $oldPassword;
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
			array('rut, apellidoPat, apellidoMat, nombres, password_2, email', 'required'),
			array('rut', 'length', 'max'=>10),
                        array('apellidoPat, apellidoMat', 'length', 'max'=>25),
                        array('email', 'length', 'max'=>50),
                        array('nombres', 'length', 'max'=>50),
			array('password_2', 'length', 'max'=>250),
			array('perfil', 'length', 'max'=>11),
                        array('codVerificacion', 'length', 'max'=>10),
                        array('email','email'),
                    
			array('rut, apellidoPat, apellidoMat, nombres, password_2, perfil', 'safe', 'on'=>'search'),
                        //Error de validación, estaba escrito requerid y no required
                        array('oldPassword, newPassword, repeatPassword', 'required', 'on' => 'changePwd'),
                        array('newPassword, repeatPassword', 'length', 'min'=>6, 'max'=>250, 'on' => 'changePwd'),
                        array('oldPassword', 'findPasswords', 'on' => 'changePwd'),
                        array('repeatPassword', 'compare', 'compareAttribute' => 'newPassword'),
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
			'noticias' => array(self::HAS_MANY, 'UsuarioNoticia', 'usuario_rut'),
                        'misNoticias'=>array(self::MANY_MANY, 'Noticia','usuario_noticia(usuario_rut, noticia_idnoticia)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'rut' => 'Rut',
                        'apellidoPat' => 'Apellido Paterno',
			'apellidoMat' => 'Apellido Materno',
			'nombres' => 'Nombres',
			'password_2' => 'Clave',
			'perfil' => 'Perfil',
                        'oldPassword'=>'Contraseña Actual',
                        'newPassword'=>'Nueva Contraseña',
                        'repeatPassword'=>'Repetir Nueva Contraseña',
                        'email'=>'Email'
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
        
        public function nombreCompleto(){
            return $this->nombres + ' '+ $this->apellidoPat + ' ' + $this->apellidoMat;
        }
        
        function beforeDelete(){
            if( $this->apoderado !== array() )
                return false;
            if( $this->cadete !== array() )
                return false;
            if( $this->funcionario !== array() )
                return false;
            return parent::beforeDelete();
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
            /*$subject='=?UTF-8?B?'.base64_encode('Por favor cambie su contraseña').'?=';
            $body = 'Nos enteramos de que usted perdió su contraseña. Lo sentimos! <br/><br/>';
            $body .= 'Pero no te preocupes, Ingresa el siguiente codigo en el enlace de mas abajo</b>';
            $body .= 'codigo: '. $this->codVerificacion.'<br/><br/>';
            $body .= '<a href="http://localhost/cadeteenlinea/site/ResetPassword">http://localhost/cadeteenlinea/site/ResetPassword</a>';
            
            
            $headers="From: ".Yii::app()->params['adminEmail']."\r\n".
		"Reply-To: ".Yii::app()->params['adminEmail']."\r\n".
		"MIME-Version: 1.0\r\n".
		"Content-Type: text/plain; charset=UTF-8";
            
            if(mail($this->email,$subject,$body,$headers))
                return true;
            return false;*/
            
            $body = '<p>Hola, '.$this->nombres.'</p>';
            $body .= '<p>Nos enteramos de que usted perdió su contraseña. Lo sentimos!<br/>';
            $body .= 'Pero no te preocupes, Ingresa el siguiente codigo en el enlace de mas abajo</p>';
            $body .= '<p>codigo: <b>'. $this->codVerificacion.'</b></p>';
            $body .= '<a href="http://localhost/cadeteenlinea/site/ResetPassword">'.Yii::app()->request->baseUrl.'/site/ResetPassword</a>';
            $body .= '<p><br/>Si usted no utiliza este código dentro de las proximas 24 horas, '
                    . 'este caducará. Para obtener un nuevo código visite '
                    . '<a href="http://localhost/cadeteenlinea/site/RecuperarContrasena">'.Yii::app()->request->baseUrl.'/site/RecuperarContrasena</a></p>';
            $body .= '<p>Atentamente.<br/>'
                    . 'Equipo de Cadete en Línea</p>';
            
            $mail=Yii::app()->Smtpmail;
            $mail->SetFrom('cadeteenlinea@gmail.com', '[Cadete en linea]');
            $mail->Subject    = 'Cambio de contraseña';
            $mail->MsgHTML($body);
            $mail->AddAddress($this->email, "");
            $sw = false;
            if($mail->Send()) {
                $sw = true;
            }
            $mail->ClearAddresses(); //clear addresses for next email sending

            return $sw;
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
            $now = strtotime(date("Y-m-d H:i:s"));
            if($fecha > $now)
                return true;  
            return false;
        }
        
        
        public static function saveWeb($usuarios){
            $errores = "";
            foreach ($usuarios as $usuario){
                $model= Usuario::model()->findByPk($usuario["rut"]);
                if(empty($model)){
                    $model =  new Usuario();
                    $model->rut = $usuario["rut"];
                    $model->password_2 = $usuario["password_2"];
                    $model->email = "cadete@escuelanaval.cl";
                }
                $model->apellidoPat = $usuario["apellidoPat"];
                $model->apellidoMat = $usuario["apellidoMat"];
                $model->nombres = $usuario["nombre"];
                $model->perfil = $usuario["perfil"];
                
                try{
                    if(!$model->save()){
                        foreach($model->errors as $error){
                            $er = new Error('99999', $model->rut, 'usuario', $error[0]);
                            $errores[] = $er;
                        }
                    }
                } catch (CDbException $e){
                    $er = new Error($e->errorInfo[1], $model->rut, 'usuario', $e->errorInfo[2]);
                    $errores[] = $er;
                } 
            }
            return $errores;
        }
        
        public static function deleteWeb($usuarios){
            $error = "";
            $errores = "";
            foreach ($usuarios as $usuario){
                $model=Usuario::model()->findByPk($usuario["rut"]);
                try{
                    if(!empty($model)){
                        if(!$model->delete()){
                            $er = new Error('99998', $usuario["rut"], 'usuario', "Usuario no existe en el sistema");
                            $errores[] = $er;
                        }
                    }else{
                        $er = new Error('99998', $usuario["rut"], 'usuario', "Usuario no existe en el sistema");
                        $errores[] = $er;
                    }
                } catch (CDbException $e){
                    $er = new Error($e->errorInfo[1], $usuario["rut"], 'usuario', $e->errorInfo[2]);
                    $errores[] = $er;
                } 
            }
            return $errores;
        }
        
        public function findPasswords($attribute, $params){
            $usuario = Usuario::model()->findByPk(Yii::app()->user->id);
            if ($usuario->password_2 != $this->oldPassword){
                $this->addError ($attribute, 'Password actual incorrecta.');
            }
        }
        
        private function generarDigitoVerificador($rut){
            while($rut[0] == "0") {
                $rut = substr($rut, 1);
            }
            $factor = 2;
            $suma = 0;
            for($i = strlen($rut) - 1; $i >= 0; $i--) {
                $suma += $factor * $rut[$i];
                $factor = $factor % 7 == 0 ? 2 : $factor + 1;
            }
            $dv = 11 - $suma % 11;
            /* Por alguna razón me daba que 11 % 11 = 11. Esto lo resuelve. */
            $dv = $dv == 11 ? 0 : ($dv == 10 ? "K" : $dv);
            return $rut . "-" . $dv;
        }
        
        public function getRut(){
            return $this->generarDigitoVerificador($this->rut);
        }
        
        public function getMisNoticias(){
            return $this->misNoticias;
        }
}
