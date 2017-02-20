<?php

class ApoderadoController extends Controller
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
			array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('selectCadete', 'ListaCadetes'),
				'users'=>array('@'),
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
		$model=new Apoderado;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Apoderado']))
		{
			$model->attributes=$_POST['Apoderado'];
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
	public function actionUpdate($id)
	{
		$model=$this->loadModel($id);

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Apoderado']))
		{
			$model->attributes=$_POST['Apoderado'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->rut));
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
		$dataProvider=new CActiveDataProvider('Apoderado');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Apoderado('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Apoderado']))
			$model->attributes=$_GET['Apoderado'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Apoderado the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Apoderado::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Apoderado $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='apoderado-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        
        public function actionSelectCadete()
        {
            /***********SELECCIÓN PARA APODERADOS***********/
            if(Yii::app()->getSession()->get('perfil')=='apoderado'){
                if(isset($_GET['rutCadete'])){
                    if($this->loadModel(Yii::app()->user->id)->seleccionarCadete($_GET['rutCadete'])){
                        $this->redirect(array('site/index'));
                    }
                }
                $this->render('selectCadete',array(
                    'cadetes' => $apoderado = $this->loadModel(Yii::app()->user->id)->getCadetes(),
                ));
            /************SELECCIÓN PARA OFICIALES***************/    
            }else if(Yii::app()->getSession()->get('tipoFuncionario')=='Oficial' || Yii::app()->getSession()->get('tipoFuncionario')=='Administrador' || Yii::app()->getSession()->get('tipoFuncionario')=='administrativo'){
                if(isset($_GET['rutCadete'])){
                    if(Funcionario::model()->findByPk(Yii::app()->user->id)->seleccionarCadeteOficial($_GET['rutCadete'])){
                        $this->redirect(array('site/index'));
                    }
                }
                $filtro = new Cadete;
                $model = Funcionario::model()->findByPk(Yii::app()->user->id)->getCadetesOficiales();
                $this->render('selectCadete',array(
                    'cadetes'=>$model,
                    'filtro' => $filtro,
                ));
            } 
        }
        
        public function actionListaCadetes(){
            $model=new Cadete;
            $model->attributes=$_POST['Cadete'];
            
            if(Yii::app()->getSession()->get('tipoFuncionario')=='Oficial' || Yii::app()->getSession()->get('tipoFuncionario')=='Administrador'|| Yii::app()->getSession()->get('tipoFuncionario')=='administrativo'){
                $cadetes = Funcionario::model()->findByPk(Yii::app()->user->id)->getCadetesOficiales($model->nCadete);
                return $this->renderPartial('_listaCadetes', array('cadetes'=>$cadetes));
            }else{
                return false;
            }
        }
}
