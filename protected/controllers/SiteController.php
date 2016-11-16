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
            if(!Yii::app()->user->isGuest){
                if(Yii::app()->getSession()->get("perfil") == 'apoderado' || Yii::app()->getSession()->get("perfil") == 'cadete'){
                    $this->redirect(array('usuario/Misnoticias'));
                }else{
                    $this->render('index');
                }
            }else{
                $this->actionLogin();
            }
            
            /*try{
            $client=new SoapClient('http://localhost/cadeteenlinea/site/cadeteEnLineaDesktop');
            $result =  $client->transacciones('[{"idtransaccion":6,"cadete_rut":18577069,"tipoTransaccion":"Abono","monto":96726,"fechaMovimiento":"\/Date(1342666800000)\/","descripcion":"TRASPASO SALDO A FAVOR EQUIPO","tipoCuenta":"Cuenta Corriente"},{"idtransaccion":12,"cadete_rut":18299964,"tipoTransaccion":"Abono","monto":25336,"fechaMovimiento":"\/Date(1343271600000)\/","descripcion":"PAGO PORTAL BANCO CHILE","tipoCuenta":"Cuenta Corriente"},{"idtransaccion":108,"cadete_rut":18144267,"tipoTransaccion":"Abono","monto":25336,"fechaMovimiento":"\/Date(1342148400000)\/","descripcion":"PAGO PORTAL BANCO CHILE","tipoCuenta":"Cuenta Corriente"}]');
            print_r($result);
            }catch(SoapFault $e) {
                print_r($e->getMessage());
            }*/
            
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
                $this->layout = '//layouts/login';
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
                            if(Yii::app()->getSession()->get('perfil')=='apoderado' || Yii::app()->getSession()->get('tipoFuncionario')=='Oficial'){
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
                        }else{
                            Yii::app()->user->setFlash('error','* Ha surgido un '
                                    . 'problema al realizar el envío de correo');
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
	 * @param string $usuariosJson
         * @param string $estado
	 * @return string
	 * @soap
	 */
        public function usuarios($usuariosJson, $estado){
            $result = '';
            if(!empty($usuariosJson) && !empty($estado)){
                $usuarios = CJSON::decode($usuariosJson, true);
                if (is_null($usuarios)) {
                    $result = "No es un objeto JSON";
                }  else {
                    switch ($estado){
                        case 1:
                            $result = Usuario::saveWeb($usuarios);
                            break;
                        case 2:
                            $result = Usuario::saveWeb($usuarios);
                            break;
                        case 3:
                            $result = Usuario::deleteWeb($usuarios);
                            break;
                        default:
                            $result = "Opción solicitada se desconoce";
                    }
                } 
            }else{
                $result = "Datos enviado no deben estar vacios";
            }
            return CJSON::encode($result);
        }
        
        
        /**
	 * @param string $cadetesJson
         * @param string $estado
	 * @return string
	 * @soap
	 */
        public function cadetes($cadetesJson, $estado){
            $result = '';
            if(!empty($cadetesJson) && !empty($estado)){
                $cadetes = CJSON::decode($cadetesJson);
                if (is_null($cadetes)) {
                    $result = "No es un objeto JSON";
                }  else {
                    switch ($estado){
                        case 1:
                            $result = Cadete::saveWeb($cadetes);
                            break;
                        case 2:
                            $result = Cadete::saveWeb($cadetes);
                            break;
                        case 3:
                            $result = Cadete::deleteWeb($cadetes);
                            break;
                        default:
                            $result = "Opción solicitada se desconoce";
                    }
                } 
            }else{
                $result = "Datos enviado no deben estar vacios";
            }
            return CJSON::encode($result);
        }
        
        /**
	 * @param string $apoderadoJson
         * @param string $estado
	 * @return string
	 * @soap
	 */
        public function apoderados($apoderadoJson, $estado){
            $result = '';
            if(!empty($apoderadoJson) && !empty($estado)){
                $apoderados = CJSON::decode($apoderadoJson);
                if (is_null($apoderados)) {
                    $result = "No es un objeto JSON";
                }  else {
                    switch ($estado){
                        case 1:
                            $result = Apoderado::saveWeb($apoderados);
                            break;
                        case 2:
                            $result = Apoderado::saveWeb($apoderados);
                            break;
                        case 3:
                            $result = Apoderado::deleteWeb($apoderados);
                            break;
                        default:
                            $result = "Opción solicitada se desconoce";
                    }
                } 
            }else{
                $result = "Datos enviado no deben estar vacios";
            }
            return CJSON::encode($result);
        }
        
        
        /**
	 * @param string $cadete_apoderadoJson
         * @param string $estado
	 * @return string
	 * @soap
	 */
        public function cadete_apoderado($cadete_apoderadoJson, $estado){
            $result = '';
            if(!empty($cadete_apoderadoJson) && !empty($estado)){
                $cadetes_apoderados = CJSON::decode($cadete_apoderadoJson);
                if (is_null($cadetes_apoderados)) {
                    $result = "No es un objeto JSON";
                }  else {
                    switch ($estado){
                        case 1:
                            $result = CadeteApoderado::saveWeb($cadetes_apoderados);
                            break;
                        case 2:
                            $result = CadeteApoderado::saveWeb($cadetes_apoderados);
                            break;
                        case 3:
                            $result = CadeteApoderado::deleteWeb($cadetes_apoderados);
                            break;
                        default:
                            $result = "Opción solicitada se desconoce";
                    }
                } 
            }else{
                $result = "Datos enviado no deben estar vacios";
            }
            return CJSON::encode($result);
            
       }
       
       
       /**
	 * @param string $calificacionesJson
         * @param string $estado
	 * @return string
	 * @soap
	 */
        public function calificaciones($calificacionesJson, $estado){
            $result = '';
            if(!empty($calificacionesJson) && !empty($estado)){
                $calificaciones = CJSON::decode($calificacionesJson);
                if (is_null($calificaciones)) {
                    $result = "No es un objeto JSON";
                }  else {
                    switch ($estado){
                        case 1:
                            $result = Calificaciones::saveWeb($calificaciones);
                            break;
                        case 2:
                            $result = Calificaciones::saveWeb($calificaciones);
                            break;
                        case 3:
                            $result = Calificaciones::deleteWeb($calificaciones);
                            break;
                        default:
                            $result = "Opción solicitada se desconoce";
                    }
                } 
            }else{
                $result = "Datos enviado no deben estar vacios";
            }
            return CJSON::encode($result);
       }
       
       
       /**
	 * @param string $inglesJson
         * @param string $estado
	 * @return string
	 * @soap
	 */
        public function ingles($inglesJson, $estado){
            $result = '';
            if(!empty($inglesJson) && !empty($estado)){
                $ingles = CJSON::decode($inglesJson);
                if (is_null($ingles)) {
                    $result = "No es un objeto JSON";
                }  else {
                    switch ($estado){
                        case 1:
                            $result = InglesTae::saveWeb($ingles);
                            break;
                        case 2:
                            $result = InglesTae::saveWeb($ingles);
                            break;
                        case 3:
                            $result = InglesTae::deleteWeb($ingles);
                            break;
                        default:
                            $result = "Opción solicitada se desconoce";
                    }
                } 
            }else{
                $result = "Datos enviado no deben estar vacios";
            }
            return CJSON::encode($result);
       }
       
       
       /**
	 * @param string $asignaturasJson
         * @param string $estado
	 * @return string
	 * @soap
	 */
        public function asignaturas($asignaturasJson, $estado){
            $result = '';
            if(!empty($asignaturasJson) && !empty($estado)){
                $asignaturas = CJSON::decode($asignaturasJson);
                if (is_null($asignaturas)) {
                    $result = "No es un objeto JSON";
                }  else {
                    switch ($estado){
                        case 1:
                            $result = Asignatura::saveWeb($asignaturas);
                            break;
                        case 2:
                            $result = Asignatura::saveWeb($asignaturas);
                            break;
                        case 3:
                            $result = Asignatura::deleteWeb($asignaturas);
                            break;
                        default:
                            $result = "Opción solicitada se desconoce";
                    }
                } 
            }else{
                $result = "Datos enviado no deben estar vacios";
            }
            return CJSON::encode($result);
       }
       
       
       /**
	 * @param string $notasParcialesJson
         * @param string $estado
	 * @return string
	 * @soap
	 */
        public function notasParciales($notasParcialesJson, $estado){
            $result = '';
            if(!empty($notasParcialesJson) && !empty($estado)){
                $notas = CJSON::decode($notasParcialesJson);
                if (is_null($notas)) {
                    $result = "No es un objeto JSON";
                }  else {
                    switch($estado){
                        case 1:
                            $result = NotasParciales::saveWeb($notas);
                            break;
                        case 2:
                            $result = NotasParciales::saveWeb($notas);
                            break;
                        case 3:
                            $result = NotasParciales::deleteWeb($notas);
                            break;
                        default:
                            $result = "Opción solicitada se desconoce";
                    }
                } 
            }else{
                $result = "Datos enviado no deben estar vacios";
            }
            return CJSON::encode($result);
       }
       
       /**
	 * @param string $notasFinalesJson
         * @param string $estado
	 * @return string
	 * @soap
	 */
       public function notasFinales($notasFinalesJson, $estado){
            $result = '';
            if(!empty($notasFinalesJson) && !empty($estado)){
                $notas = CJSON::decode($notasFinalesJson);
                if (is_null($notas)) {
                    $result = "No es un objeto JSON";
                }  else {
                    switch($estado){
                        case 1:
                            $result = NotasFinales::saveWeb($notas);
                            break;
                        case 2:
                            $result = NotasFinales::saveWeb($notas);
                            break;
                        case 3:
                            $result = NotasFinales::deleteWeb($notas);
                            break;
                        default:
                            $result = "Opción solicitada se desconoce";
                    }
                } 
            }else{
                $result = "Datos enviado no deben estar vacios";
            }
            return CJSON::encode($result);
       }
       
       /**
	 * @param string $transaccionesJson
         * @param string $estado
	 * @return string 
	 * @soap
	 */
        public function transacciones($transaccionesJson = '', $estado = ''){
            $result = '';
            if(!empty($transaccionesJson) && !empty($estado)){
                $transacciones = CJSON::decode($transaccionesJson);
                if (is_null($transacciones)) {
                    $result = "No es un objeto JSON";
                }  else {
                    switch ($estado){
                        case 1:
                            $result = Transaccion::saveWeb($transacciones);
                            break;
                        case 2:
                            $result = Transaccion::saveWeb($transacciones);
                            break;
                        case 3:
                            $result = Transaccion::deleteWeb($transacciones);
                            break;
                        default:
                            $result = "Opción solicitada se desconoce";
                    }
                } 
            }else{
                $result = "Datos enviado no deben estar vacios";
            }
            return CJSON::encode($result);
       }
        
       
       /**
	 * @param string $notasFisicoJson
         * @param string $estado
	 * @return string
	 * @soap
	 */
        public function notasFisicos($notasFisicoJson, $estado){
            $result = '';
            if(!empty($notasFisicoJson) && !empty($estado)){
                $notas = CJSON::decode($notasFisicoJson);
                if (is_null($notas)) {
                    $result = "No es un objeto JSON";
                }  else {
                    switch($estado){
                        case 1:
                            $result = NotasFisico::saveWeb($notas);
                            break;
                        case 2:
                            $result = NotasFisico::saveWeb($notas);
                            break;
                        case 3:
                            $result = NotasFisico::deleteWeb($notas);
                            break;
                        default:
                            $result = "Opción solicitada se desconoce";
                    }
                } 
            }else{
                $result = "Datos enviado no deben estar vacios";
            }
            return CJSON::encode($result);
       }
       
       /**
	 * @param string $nivelacionJson
         * @param string $estado
	 * @return string
	 * @soap
	 */
        public function nivelaciones($nivelacionJson, $estado){
           $result = '';
            if(!empty($nivelacionJson) && !empty($estado)){
                $nivelaciones = CJSON::decode($nivelacionJson);
                if (is_null($nivelaciones)) {
                    $result = "No es un objeto JSON";
                }  else {
                    switch($estado){
                        case 1:
                            $result = Nivelacion::saveWeb($nivelaciones);
                            break;
                        case 2:
                            $result = Nivelacion::saveWeb($nivelaciones);
                            break;
                        case 3:
                            $result = Nivelacion::deleteWeb($nivelaciones);
                            break;
                        default:
                            $result = "Opción solicitada se desconoce";
                    }
                } 
            }else{
                $result = "Datos enviado no deben estar vacios";
            }
            return CJSON::encode($result);
        }
       
        /**
	 * @param string $francosJson
         * @param string $estado
	 * @return string
	 * @soap
	 */
        public function francos($francosJson, $estado){
           $result = '';
            if(!empty($francosJson) && !empty($estado)){
                $francos = CJSON::decode($francosJson);
                if (is_null($francos)) {
                    $result = "No es un objeto JSON";
                }  else {
                    switch($estado){
                        case 1:
                            $result = Francos::saveWeb($francos);
                            break;
                        case 2:
                            $result = Francos::saveWeb($francos);
                            break;
                        /*case 3:
                            $result = Nivelacion::deleteWeb($nivelaciones);
                            break;*/
                        default:
                            $result = "Opción solicitada se desconoce";
                    }
                } 
            }else{
                $result = "Datos enviado no deben estar vacios";
            }
            return CJSON::encode($result);
        }
        
        /**
	 * @param string $resumenJson
	 * @return string
	 * @soap
	 */
        public function resumen($resumenJson){
            $result = '';
            if(!empty($resumenJson)){
                $resumen = CJSON::decode($resumenJson);
                if (is_null($resumen)) {
                    $result = "No es un objeto JSON";
                }  else {
                    $result = Resumen::saveWeb($resumen);
                } 
            }else{
                $result = "Datos enviado no deben estar vacios";
            }
            return CJSON::encode($result);
        }
        
}