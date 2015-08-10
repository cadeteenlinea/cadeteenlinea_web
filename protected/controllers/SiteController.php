<?php

class SiteController extends Controller
{
	/**
	 * Declares class-based actions.
	 */
	public function actions()
	{
		return array(
			// captcha action renders the CAPTCHA image displayed on the contact page
			'captcha'=>array(
				'class'=>'CCaptchaAction',
				'backColor'=>0xFFFFFF,
			),
			// page action renders "static" pages stored under 'protected/views/site/pages'
			// They can be accessed via: index.php?r=site/page&view=FileName
			'page'=>array(
				'class'=>'CViewAction',
			),
                        'cadeteEnLineaDesktop'=>array(
				'class'=>'CWebServiceAction',
			),
		);
	}

	/**
	 * This is the default 'index' action that is invoked
	 * when an action is not explicitly requested by users.
	 */
	public function actionIndex()
	{
            
            /*if(!Yii::app()->user->isGuest){
                $this->render('index');
            }else{
                $this->actionLogin();
            }*/
            try{
            $client=new SoapClient('http://localhost/cadeteenlinea/site/cadeteEnLineaDesktop');
            $result =  $client->usuarios('[{"rut":72872246,"apellidoPat":"1","apellidoMat":"1","nombre":"1","password_2":"72872246","perfil":"apoderado"}]');
            print_r($result);
            }catch(SoapFault $e) {
                print_r($e->getMessage());
            }
            
	}

	/**
	 * This is the action to handle external exceptions.
	 */
	public function actionError()
	{
		if($error=Yii::app()->errorHandler->error)
		{
			if(Yii::app()->request->isAjaxRequest)
				echo $error['message'];
			else
				$this->render('error', $error);
		}
	}

	/**
	 * Displays the contact page
	 */
	public function actionContact()
	{
		$model=new ContactForm;
		if(isset($_POST['ContactForm']))
		{
			$model->attributes=$_POST['ContactForm'];
			if($model->validate())
			{
				$name='=?UTF-8?B?'.base64_encode($model->name).'?=';
				$subject='=?UTF-8?B?'.base64_encode($model->subject).'?=';
				$headers="From: $name <{$model->email}>\r\n".
					"Reply-To: {$model->email}\r\n".
					"MIME-Version: 1.0\r\n".
					"Content-Type: text/plain; charset=UTF-8";

				mail(Yii::app()->params['adminEmail'],$subject,$model->body,$headers);
				Yii::app()->user->setFlash('contact','Thank you for contacting us. We will respond to you as soon as possible.');
				$this->refresh();
			}
		}
		$this->render('contact',array('model'=>$model));
	}

	/**
	 * Displays the login page
	 */
	public function actionLogin()
	{
            if(!Yii::app()->user->isGuest){
                $this->actionIndex();
            }else{
                $this->layout = '//layouts/mainNoFooter';
		$model=new LoginForm;

		// if it is ajax validation request
		if(isset($_POST['ajax']) && $_POST['ajax']==='login-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}

		// collect user input data
		if(isset($_POST['LoginForm']))
		{
			$model->attributes=$_POST['LoginForm'];
			// validate user input and redirect to the previous page if valid
			if($model->validate() && $model->login()){
                            if(Yii::app()->getSession()->get('perfil')=='apoderado'){
                                $this->redirect(array('apoderado/selectCadete')); 
                            }else{
                                $this->redirect(Yii::app()->user->returnUrl);
                            }
                        }
		}
		// display the login form
		$this->render('login',array('model'=>$model));
            }
	}

	/**
	 * Logs out the current user and redirect to homepage.
	 */
	public function actionLogout()
	{
    		Yii::app()->user->logout();
		$this->redirect(Yii::app()->homeUrl);
	}
        
        public function actionRecuperarContrasena(){
            /* se utiliza la clase RecoverPassForm
             * para realizar las validaciones propias del formulario
             * rut válido, campo obligatorio y usuario existente en el sistema
             */
            $model = new RecoverPassForm();
            
            if(isset($_POST['RecoverPassForm']))
            {
               $model->attributes=$_POST['RecoverPassForm'];
               if($model->validate()){
                   $rut=substr(strtolower($model->rut),0,-2);
                   $usuario=Usuario::model()->findByPk($rut);
                   $codigoVerificacion = $usuario->asignarCodVerificaciónYFecha();
                   if($usuario->save()){
                        if($usuario->enviarEmailContrasena()){
                            Yii::app()->user->setFlash('success','* Te hemos 
                                enviado un correo electrónico con un enlace y 
                                código de autorización, los que le permitiran 
                                restablecer su contraseña por 
                                las próximas 24 horas');
                            $this->redirect(array('RecuperarContrasena'));
                        }
                   }
               }
            }
 
            $this->render('recuperarContrasena',array(
		'model'=>$model,
            ));
        }
        
        public function actionResetPassword(){
            $model = new ResetPassForm();
            if(isset($_POST['ResetPassForm']))
            {
                $model->attributes=$_POST['ResetPassForm'];
                if($model->validate()){
                    
                    $rut=substr(strtolower($model->rut),0,-2);
                    $usuario=Usuario::model()->findByPk($rut);
                    
                    if ($usuario->resetContrasena($model)){
                        Yii::app()->user->setFlash('success','Contraseña restablecida');
                        $this->redirect(array('login'));
                    }else{
                        $model->addError('codVerificacion', 'Código inválido o tiempo expirado');
                    }
                }
            }
            $this->render('resetPassword',array(
		'model'=>$model,
            ));
        }
        
        
        /*public function actionLoginWebService(){
            $response = array();
            try{
                $model = new LoginForm;
                if(isset($_POST['username']) && isset($_POST['password']) && isset($_POST['rememberMe'])){
                    $model->username = $_POST['username'];
                    $model->password = $_POST['password'];
                    $model->rememberMe = $_POST['rememberMe'];
                    if($model->validate() && $model->login()){
                        $response['success'] = true;
                        $response['perfil'] = Yii::app()->getSession()->get('perfil');
                    }else{
                        $response['success'] = true;
                    }
                }else{
                    $response['success'] = false;
                }
            }catch(CException $ex){
                $response['success'] = false;
            }
            
            //$cadete = Cadete::model()->findAll();
            
            //$model->password = "asdasd";
            //$model->username = "17558919-8";
            
            header('Content-type: application/json');
            
            //echo CJSON::encode($response);
            echo CJSON::encode($response);
            Yii::app()->end();
        }*/
        
        /**
	 * @param string
	 * @return string
	 * @soap
	 */
        public function usuarios($usuariosJson){
            $usuarios = CJSON::decode($usuariosJson, true);
            $error = "";
            $errores = "";
            foreach ($usuarios as $usuario){
                $model= Usuario::model()->findByPk($usuario["rut"]);
                if(empty($model)){
                    $model =  new Usuario();
                    $model->rut = $usuario["rut"];
                }
                $model->apellidoPat = $usuario["apellidoPat"];
                $model->apellidoMat = $usuario["apellidoMat"];
                $model->nombres = $usuario["nombre"];
                $model->perfil = $usuario["perfil"];
                //$model->password_2 = $usuario["password_2"];
                $model->email = "seb.frab@gmail.com";
                if(!$model->save()){
                    $error["rut"] = $model->rut;
                    $error["error"] = $model->errors;
                    $errores[] = array($error["rut"], $error["error"]);
                }
            }
            return CJSON::encode($errores);
        }
        
        
        /**
	 * @param string
	 * @return string
	 * @soap
	 */
        public function cadetes($cadetesJson){
            $cadetes = CJSON::decode($cadetesJson);
            $error = "";
            $errores = "";
            foreach ($cadetes as $cadete){
                $model= Cadete::model()->findByPk($cadete["rut"]);
                if(empty($model)){
                    $model =  new Cadete();
                    $model->rut = $cadete["rut"];
                }
                
                $model->nCadete = $cadete["rut"];
                $model->curso = $cadete["curso"];
                $model->division = $cadete["division"];
                
                $model->anoIngreso = $cadete["anoIngreso"];
                $model->anoNacimiento = $cadete["anoNacimiento"];
                $model->mesNacimiento = $cadete["mesNacimiento"];
                $model->diaNacimiento = $cadete["diaNacimiento"];
                $model->lugarNacimiento = $cadete["lugarNacimiento"];
                $model->nacionalidad = $cadete["nacionalidad"];
                $model->seleccion = $cadete["seleccion"];
                $model->nivel = $cadete["nivel"];
                $model->circulo = $cadete["circulo"];  
                
                $criteria=new CDbCriteria;
                $criteria->addCondition('codigo="'.$cadete["especialidad"].'"');
                $especialidad = Especialidad::model()->find($criteria);
                if(!empty($especialidad)){
                    $model->especialidad_idespecialidad = $especialidad->idespecialidad;
                }
                
                if(!$model->save()){
                    $error["rut"] = $model->rut;
                    $error["error"] = $model->errors;
                    $errores[] = array($error["rut"], $error["error"]);
                }
            }
            
            return CJSON::encode($errores);
        }
        
        /**
	 * @param string
	 * @return string
	 * @soap
	 */
        public function cadete_apoderado($cadete_apoderadoJson){
            $cadetes_apoderados = CJSON::decode($cadete_apoderadoJson);
            $error = "";
            $errores = "";
            foreach ($cadetes_apoderados as $cadete_apoderado){
                $model = CadeteApoderado::model()->findByPk($cadete_apoderado["id"]);
            }
        }
        
}