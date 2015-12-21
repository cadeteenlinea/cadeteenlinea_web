<?php

class NoticiaController extends Controller
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
				'actions'=>array('index','view','create','update','admin','delete'),
				'expression'=>'Yii::app()->getSession()->get("tipoFuncionario") == "Administrador"',
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
		$model=new Noticia;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Noticia']))
		{
			$model->attributes=$_POST['Noticia'];
                        $model->division = $_POST['Noticia']['division'];
                        $model->curso = $_POST['Noticia']['curso'];
                        $model->fecha = date("Y-m-d H:i:s");

                        if($model->save()){
                            $usuarios = Noticia::model()->getAllUsuarioNoticiaInsert(
                                    $model->tipoUsuario, $model->division, $model->curso);
                            UsuarioNoticia::model()->insertNoticiaUsuario($usuarios, $model->idnoticia);
                            
                            Yii::app()->user->setFlash("success","Noticia #$model->idnoticia publicada");
                            
                            $this->redirect(array('admin'));
                        }
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

		if(isset($_POST['Noticia']))
		{
			$model->attributes=$_POST['Noticia'];
			if($model->save()){
                            Noticia::model()->deleteAllNoticiaUsuario($model->idnoticia);
                            $usuarios = Noticia::model()->getAllUsuarioNoticiaInsert(
                                $model->tipoUsuario, $model->division, $model->curso);
                            UsuarioNoticia::model()->insertNoticiaUsuario($usuarios, $model->idnoticia);
                            
                            Yii::app()->user->setFlash("success","Noticia #$model->idnoticia actualizada");
                            $this->redirect(array('admin'));
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
                Noticia::model()->deleteAllNoticiaUsuario($id);
		$this->loadModel($id)->delete();

                Yii::app()->user->setFlash("success","Noticia eliminada");
		// if AJAX request (triggered by deletion via admin grid view), we should not redirect the browser
		if(!isset($_GET['ajax']))
			$this->redirect(isset($_POST['returnUrl']) ? $_POST['returnUrl'] : array('admin'));
	}

	/**
	 * Lists all models.
	 */
	public function actionIndex()
	{
		$dataProvider=new CActiveDataProvider('Noticia');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Noticia('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Noticia']))
			$model->attributes=$_GET['Noticia'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Noticia the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Noticia::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Noticia $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='noticia-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
}
