<?php

class UsuarioController extends Controller
{
	/**
	 * @var string the default layout for the views. Defaults to '//layouts/column2', meaning
	 * using two-column layout. See 'protected/views/layouts/column2.php'.
	 */
	public $layout='//layouts/column2';

	/**
	 * @return array action filters
	 */
	public function filters()
	{
		return array(
			'accessControl', // perform access control for CRUD operations
			'postOnly + delete', // we only allow deletion via POST request
		);
	}

	/**
	 * Specifies the access control rules.
	 * This method is used by the 'accessControl' filter.
	 * @return array access control rules
	 */
	public function accessRules()
	{
		return array(
                        array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('datosPersonales','cambioPassword', 'update'),
				'users'=>array('@'),
			),
                        array('allow',  // allow all users to perform 'index' and 'view' actions
				'actions'=>array('misNoticias'),
				'expression'=>'Yii::app()->getSession()->get("perfil") == "apoderado" || '
                                    .' Yii::app()->getSession()->get("perfil") == "cadete"',
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

	/**
	 * Displays a particular model.
	 * @param integer $id the ID of the model to be displayed
	 */
	public function actionView($id)
	{
		$this->render('view',array(
			'model'=>$this->loadModel($id),
		));
	}

	/**
	 * Creates a new model.
	 * If creation is successful, the browser will be redirected to the 'view' page.
	 */
	public function actionCreate()
	{
		$model=new Usuario;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Usuario']))
		{
			$model->attributes=$_POST['Usuario'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->rut));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}

	/**
	 * Updates a particular model.
	 * If update is successful, the browser will be redirected to the 'view' page.
	 * @param integer $id the ID of the model to be updated
	 */
	public function actionUpdate()
	{
		$model=$this->loadModel(Yii::app()->user->id);

		if(isset($_POST['Usuario']))
		{
			$model->attributes=$_POST['Usuario'];
			if($model->save()){
                                Yii::app()->getSession()->add('email', $model->email);
                                Yii::app()->user->setFlash('success','Datos personales modificados');
				$this->redirect(array('datosPersonales'));
                        }else{
                            Yii::app()->user->setFlash('error','No se pudo modificar los datos personales');
                        }
		}

		$this->render('update',array(
			'model'=>$model,
		));
	}

	/**
	 * Deletes a particular model.
	 * If deletion is successful, the browser will be redirected to the 'admin' page.
	 * @param integer $id the ID of the model to be deleted
	 */
	public function actionDelete($id)
	{
		$this->loadModel($id)->delete();

		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Usuario');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Usuario('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Usuario']))
			$model->attributes=$_GET['Usuario'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Usuario the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Usuario::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Usuario $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='usuario-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        
        public function actionDatosPersonales(){
            $rut = Yii::app()->user->id;
            $model = Usuario::model()->findByPk($rut);

            $this->render('datosPersonales',array(
                'model' => $model,
                'titulo' => 'Datos Personales',
            ));
        }
        
        public function actionCambioPassword(){
            /*Se rescata el ID del usuario que es el rut, este queda guardado
                en la atributo id del componente user*/
            $rut = Yii::app()->user->id;
            /*se debe buscar por la clave primaria que es rut, esto es mas rapido que de la otra forma*/
            $model = Usuario::model()->findByPk($rut);
            
            $model->setScenario('changePwd');
            
            if(isset($_POST['Usuario'])){
                $model->attributes = $_POST['Usuario'];

                if($model->validate()){
                    //se entrega la nueva contraseña al atributo correspondiente
                    //no se está utilizando encriptación aun
                    $model->password_2 = $model->newPassword;
                    
                    //los setFlash son para enviar mensajes que duran el cargado de la página
                    //es decir, al refrescar la página se pierden por completo
                    if($model->save()){
                        Yii::app()->user->setFlash('success','Contraseña modificada');
                        $this->redirect(array('CambioPassword'));
                    }else{
                        Yii::app()->user->setFlash('error','Contraseña no se pudo modificar');
                        $this->redirect(array('CambioPassword'));
                    }
                }
            }
            $this->render('cambioPassword', array(
                'model' => $model,
                'titulo' => 'Cambio Contraseña',
             ));
        }
        
        
        public function actionMisNoticias(){
            $usuario = $this->loadModel(Yii::app()->user->id);
            $noticias = $usuario->getMisNoticias();
            $this->render('misNoticias', array(
                'noticias' => $noticias,
             ));
        }
        
}
