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
                $this->render('index');
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
                $model->password_2 = $usuario["password_2"];
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
                
                $model->nCadete = $cadete["nCadete"];
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
        public function apoderados($apoderadoJson){
            $apoderados = CJSON::decode($apoderadoJson);
            $error = "";
            $errores = "";
            foreach ($apoderados as $apoderado){
                $model = Apoderado::model()->findByPk($apoderado["rut"]);
                if(empty($model)){
                    $model =  new Apoderado();
                    $model->rut = $apoderado["rut"];
                }
                $model->direccion = $apoderado["direccion"];
                $model->comuna = $apoderado["comuna"];
                $model->ciudad = $apoderado["ciudad"];
                $model->region = $apoderado["ciudad"];
                $model->fono = $apoderado["fono"];
                $model->fonoComercial = $apoderado["fonoComercial"];
                $model->difunto = $apoderado["difunto"];
                
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
                $model = CadeteApoderado::model()->findByPk($cadete_apoderado["idcadete_apoderado"]);
                if(empty($model)){
                    $model =  new CadeteApoderado();
                    $model->idcadete_apoderado = $cadete_apoderado["idcadete_apoderado"];
                }
                $model->cadete_rut = $cadete_apoderado["cadete_rut"];
                $model->apoderado_rut = $cadete_apoderado["apoderado_rut"];
                $model->tipoApoderado = $cadete_apoderado["tipoApoderado"];
                
                if(!$model->save()){
                    $error["idcadete_apoderado"] = $model->idcadete_apoderado;
                    $error["error"] = $model->errors;
                    $errores[] = array($error["idcadete_apoderado"], $error["error"]);
                }
            }
            return CJSON::encode($errores);
       }
       
       
       /**
	 * @param string
	 * @return string
	 * @soap
	 */
        public function calificaciones($calificacionesJson){
            $calificaciones = CJSON::decode($calificacionesJson);
            $error = "";
            $errores = "";
            foreach ($calificaciones as $calificacion){
                $model = Calificaciones::model()->findByPk($calificacion["idcalificaciones"]);
                if(empty($model)){
                    $model =  new Calificaciones();
                    $model->idcalificaciones = $calificacion["idcalificaciones"];
                }
                $model->ano = $calificacion["ano"];
                $model->semestre = $calificacion["semestre"];
                $model->mando = $calificacion["mando"];
                $model->interes_profesional = $calificacion["interes_profesional"];
                $model->personalidad_madurez = $calificacion["personalidad_madurez"];
                $model->responsabilidad = $calificacion["responsabilidad"];
                $model->espiritu_militar = $calificacion["espiritu_militar"];
                $model->cooperacion = $calificacion["cooperacion"];
                $model->conducta = $calificacion["conducta"];
                $model->aptitud_fisica = $calificacion["aptitud_fisica"];
                $model->tenida_orden_aseo = $calificacion["tenida_orden_aseo"];
                $model->final = $calificacion["final"];
                $model->cadete_rut = $calificacion["cadete_rut"];
                
                if(!$model->save()){
                    $error["idcalificaciones"] = $model->idcalificaciones;
                    $error["error"] = $model->errors;
                    $errores[] = array($error["idcalificaciones"], $error["error"]);
                }
            }
            return CJSON::encode($errores);
       }
       
       
       /**
	 * @param string
	 * @return string
	 * @soap
	 */
        public function ingles($inglesJson){
            $ingles = CJSON::decode($inglesJson);
            $error = "";
            $errores = "";
            foreach ($ingles as $ing){
                $model = InglesTae::model()->findByPk($ing["idingles_tae"]);
                if(empty($model)){
                    $model =  new InglesTae();
                    $model->idingles_tae = $ing["idingles_tae"];
                }
                
                $model->ano = $ing["ano"];
                $model->mes = $ing["mes"];
                $model->speaking = $ing["speaking"];
                $model->understanding = $ing["understanding"];
                $model->writing = $ing["writing"];
                $model->average = $ing["average"];
                $model->cadete_rut = $ing["cadete_rut"];
                
                if(!$model->save()){
                    $error["idingles_tae"] = $model->idingles_tae;
                    $error["error"] = $model->errors;
                    $errores[] = array($error["idingles_tae"], $error["error"]);
                }
            }
            return CJSON::encode($errores);
       }
       
       
       /**
	 * @param string
	 * @return string
	 * @soap
	 */
        public function asignaturas($asignaturasJson){
            $asignaturas = CJSON::decode($asignaturasJson);
            $error = "";
            $errores = "";
            foreach ($asignaturas as $asignatura){
                $model = Asignatura::model()->findByPk($asignatura["idasignatura"]);
                if(empty($model)){
                    $model =  new Asignatura();
                    $model->idasignatura = $asignatura["idasignatura"];
                }
                
                $model->codigo = $asignatura["codigo"];
                $model->ano = $asignatura["ano"];
                $model->semestre = $asignatura["semestre"];
                $model->curso = $asignatura["curso"];
                $model->nombre = $asignatura["nombre"];
                
                $criteria=new CDbCriteria;
                $criteria->addCondition('codigo="'.$asignatura["especialidad"].'"');
                $especialidad = Especialidad::model()->find($criteria);
                if(!empty($especialidad)){
                    $model->especialidad_idespecialidad = $especialidad->idespecialidad;
                }
                
                if(!$model->save()){
                    $error["idasignatura"] = $model->idasignatura;
                    $error["error"] = $model->errors;
                    $errores[] = array($error["idasignatura"], $error["error"]);
                }
            }
            return CJSON::encode($errores);
       }
       
       
       /**
	 * @param string
	 * @return string
	 * @soap
	 */
        public function notasParciales($notasParcialesJson){
            $notas = CJSON::decode($notasParcialesJson);
            $error = "";
            $errores = "";
            foreach ($notas as $nota){
                $model = NotasParciales::model()->findByPk($nota["idnotas_parciales"]);
                if(empty($model)){
                    $model =  new NotasParciales();
                    $model->idnotas_parciales = $nota["idnotas_parciales"];
                }
                
                $model->nota = $nota["nota"];
                $model->dia = $nota["dia"];
                $model->mes = $nota["mes"];
                $model->ano = $nota["ano"];
                $model->semestre = $nota["semestre"];
                $model->asignatura_idasignatura = $nota["asignatura_idasignatura"];
                $model->cadete_rut = $nota["cadete_rut"];
                
                $criteria=new CDbCriteria;
                $criteria->addCondition('codigo="'.$nota["concepto"].'"');
                $concepto = Concepto::model()->find($criteria);
                if(!empty($concepto)){
                    $model->concepto_idconcepto = $concepto->idconcepto;
                }
                
                if(!$model->save()){
                    $error["idnotas_parciales"] = $model->idnotas_parciales;
                    $error["error"] = $model->errors;
                    $errores[] = array($error["idnotas_parciales"], $error["error"]);
                }
            }
            return CJSON::encode($errores);
       }
       
       
       /**
	 * @param string
	 * @return string
	 * @soap
	 */
       public function notasFinales($notasFinalesJson){
            $notas = CJSON::decode($notasFinalesJson);
            $error = "";
            $errores = "";
            foreach ($notas as $nota){
                $model = NotasFinales::model()->findByPk($nota["idnotas_finales"]);
                if(empty($model)){
                    $model =  new NotasFinales();
                    $model->idnotas_finales = $nota["idnotas_finales"];
                }
                
                $model->nota_presentacion = $nota["nota_presentacion"];
                $model->nota_examen = $nota["nota_examen"];
                $model->nota_final = $nota["nota_final"];
                $model->nota_examen_repeticion = $nota["nota_examen_repeticion"];
                $model->nota_final_repeticion = $nota["nota_final_repeticion"];
                $model->estado = $nota["estado"];
                $model->asignatura_idasignatura = $nota["asignatura_idasignatura"];
                $model->cadete_rut = $nota["cadete_rut"];
                
                if(!$model->save()){
                    $error["idnotas_finales"] = $model->idnotas_finales;
                    $error["error"] = $model->errors;
                    $errores[] = array($error["idnotas_finales"], $error["error"]);
                }
            }
            return CJSON::encode($errores);
       }
       
       /**
	 * @param string
	 * @return string
	 * @soap
	 */
       public function transacciones($transaccionesJson){
            $transacciones = CJSON::decode($transaccionesJson);
            $error = "";
            $errores = "";
            foreach ($transacciones as $transaccion){
                $model = Transaccion::model()->findByPk($transaccion["idtransaccion"]);
                
                if(empty($model)){
                    $model =  new Transaccion();
                    $model->idtransaccion = $transaccion["idtransaccion"];
                }
                
                $model->cadete_rut = $transaccion["cadete_rut"];
                $model->tipoTransaccion = $transaccion["tipoTransaccion"];
                $model->monto = $transaccion["monto"];
                $model->fechaMovimiento = $transaccion["fechaMovimiento"];
                $model->descripcion = $transaccion["descripcion"];
                $model->tipoCuenta = $transaccion["tipoCuenta"];
                
                if(!$model->save()){
                    $error["idtransaccion"] = $model->idtransaccion;
                    $error["error"] = $model->errors;
                    $errores[] = array($error["idtransaccion"], $error["error"]);
                }
                
            }
            return CJSON::encode($errores);
       }
        
}