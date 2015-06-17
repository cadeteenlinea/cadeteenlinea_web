<?php

class ArchivosController extends Controller
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
				'actions'=>array('create','index','admin','view', 'publicar'),
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
		$model=new Archivos;

		if(isset($_POST['Archivos']))
		{
                    $model->attributes=$_POST['Archivos'];
                    $model->fecha = date("Y-m-d H:i:s");

                    $model->archivo=CUploadedFile::getInstance($model,'archivo');
                    if($model->save()){
                        $ext = $model->archivo->getExtensionName();
                        $path="txt/$model->idarchivos.$ext";
                        if($model->archivo->saveAs($path)){
                            $this->redirect(array('view','id'=>$model->idarchivos));
                        }else{
                            $model->addError('archivo', 'Se ha producido un error al subir el archivo al servidor');
                        }
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

		if(isset($_POST['Archivos']))
		{
			$model->attributes=$_POST['Archivos'];
			if($model->save())
				$this->redirect(array('view','id'=>$model->idarchivos));
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
            $this->actionAdmin();
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Archivos('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Archivos']))
			$model->attributes=$_GET['Archivos'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Archivos the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Archivos::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Archivos $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='archivos-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        
        public function actionPublicar($id){
            $model=$this->loadModel($id);
            if(!empty($model)){
                $resultado = null;
                $resultado = $model->publicarArchivo();
            }  
            
            $this->render('publicacion',array(
                'titulo' => 'Publicación archivo '.$model->tipoArchivo->nombre,
                'errors' => $resultado[0],
                'countError' => $resultado[1],
                'countSuccess' => $resultado[2],
                'model' => $model,
            ));
        }
        
        
}
