<?php

class CadeteController extends Controller
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
        
        public function actions() {
            return array(
                'cadetes'=>array(
                    'class'=>'CWebServiceAction',
		),
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
				'actions'=>array('movimientoCuentaCorriente', 
                                    'movimientoColegiatura', 'movimientoEquipo', 
                                    'notasParciales','notasFinales','notasTae',
                                    'calificaciones','datosPersonales','fichaCapacidad',
                                    'Nivelacion', 'Francos'),
				'users'=>array('@'),
			),
                        array('allow',
                            'actions'=>array('cadetes'),
				'users'=>array('*'),
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
		$model=new Cadete;

		// Uncomment the following line if AJAX validation is needed
		// $this->performAjaxValidation($model);

		if(isset($_POST['Cadete']))
		{
			$model->attributes=$_POST['Cadete'];
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

		if(isset($_POST['Cadete']))
		{
			$model->attributes=$_POST['Cadete'];
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
		$dataProvider=new CActiveDataProvider('Cadete');
		$this->render('index',array(
			'dataProvider'=>$dataProvider,
		));
	}

	/**
	 * Manages all models.
	 */
	public function actionAdmin()
	{
		$model=new Cadete('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Cadete']))
			$model->attributes=$_GET['Cadete'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
      

	/**
	 * Returns the data model based on the primary key given in the GET variable.
	 * If the data model is not found, an HTTP exception will be raised.
	 * @param integer $id the ID of the model to be loaded
	 * @return Cadete the loaded model
	 * @throws CHttpException
	 */
	public function loadModel($id)
	{
		$model=Cadete::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}

	/**
	 * Performs the AJAX validation.
	 * @param Cadete $model the model to be validated
	 */
	protected function performAjaxValidation($model)
	{
		if(isset($_POST['ajax']) && $_POST['ajax']==='cadete-form')
		{
			echo CActiveForm::validate($model);
			Yii::app()->end();
		}
	}
        
        public function actionMovimientoCuentaCorriente(){ 
            //Validación de año, por defecto se carga con el año actual
            //si la variable $_POST trae valor, el año es cambiado por el valor seleccionado
            $ano = '';
            if(isset($_POST['fechaMovimiento'])){
                $ano = $_POST['fechaMovimiento'];
            }
            
            $rutCadete = Yii::app()->getSession()->get('rutCadete');
            $tipoCuenta = "Cuenta Corriente";
            
            //isntancia de la clase cadete, para obtener todas sus transacciones
            //hace uso del metodo getTransacciones
            $model = $this->loadModel($rutCadete);
            
            //entrega el total de transacciones (SUM)
            $transacciones = new Transaccion;
            $total = $transacciones->getSumTransaccionesTipoTran($rutCadete, $tipoCuenta, $ano, "Abono") - $transacciones->getSumTransaccionesTipoTran($rutCadete, $tipoCuenta, $ano, 'Cargo');

            $this->render('movimientos',array(
                'transacciones' =>  $model->getTransacciones($ano, $tipoCuenta),
                'total' => Yii::app()->numberFormatter->format("#,##0",$total),
                'titulo' => 'Cuenta Corriente',
                'anoView' => $ano,
                'tipoCuenta'=>$tipoCuenta
            ));
        }
        
        public function actionMovimientoColegiatura(){ 
            $ano = '';
            if(isset($_POST['fechaMovimiento'])){
                $ano = $_POST['fechaMovimiento'];
            }           
            $rutCadete = Yii::app()->getSession()->get('rutCadete');
            $tipoCuenta = "Colegiatura";
            
            $model = $this->loadModel($rutCadete);
            $transacciones = new Transaccion;
            $total = $transacciones->getSumTransaccionesTipoTran($rutCadete, $tipoCuenta, $ano, "Abono") - $transacciones->getSumTransaccionesTipoTran($rutCadete, $tipoCuenta, $ano, 'Cargo');
            $this->render('movimientos',array(
                'transacciones' =>  $model->getTransacciones($ano, $tipoCuenta),
                'total' => Yii::app()->numberFormatter->format("#,##0",$total),
                'titulo' => $tipoCuenta,
                'anoView' => $ano,
                'tipoCuenta'=>$tipoCuenta
            ));
        }
        
        public function actionMovimientoEquipo(){ 
            $ano = '';
            if(isset($_POST['fechaMovimiento'])){
                $ano = $_POST['fechaMovimiento'];
            }            
            $rutCadete = Yii::app()->getSession()->get('rutCadete');
            $tipoCuenta = "Equipo";
            
            $model = $this->loadModel($rutCadete);
            $transacciones = new Transaccion;
            $total = $transacciones->getSumTransaccionesTipoTran($rutCadete, $tipoCuenta, $ano, "Abono") - $transacciones->getSumTransaccionesTipoTran($rutCadete, $tipoCuenta, $ano, 'Cargo');
            $this->render('movimientos',array(
                'transacciones' =>  $model->getTransacciones($ano, $tipoCuenta),
                'total' => Yii::app()->numberFormatter->format("#,##0",$total),
                'titulo' => 'Equipo Inicial',
                'anoView' => $ano,
                'tipoCuenta'=>$tipoCuenta
            ));
        }
        
        public function actionNotasParciales(){
            $rutCadete = Yii::app()->getSession()->get('rutCadete');
            $usuario = Usuario::model()->findByPk($rutCadete);
            $ano = date("Y");
            $model = Asignatura::model()->getAsignaturasAnoCursoEspecialidad($ano, $usuario->cadete->getCursoNumero(), $usuario->cadete->especialidad->idespecialidad);
            
            $this->render('notasParciales',array(
                'model'=>$model,
                'usuario'=>$usuario,
                'titulo' => 'Notas Parciales',
            ));
        }
        
        public function  actionNotasFinales(){
            $ano = '';
            if(isset($_POST['ano'])){
                $ano = $_POST['ano'];
            }else{
                $ano = NotasFinales::model()->getAnoMax(Yii::app()->getSession()->get('rutCadete'));
            }
            $rutCadete = Yii::app()->getSession()->get('rutCadete');
            $usuario = Usuario::model()->findByPk($rutCadete);
            $model = null;
            if(!empty($ano))
                $model = Asignatura::model()->getAsignaturasCadeteAno($ano, $usuario->rut);
            
            $this->render('notasFinales',array(
                'model'=>$model,
                'ano'=>$ano,
                'titulo' => 'Resumen Anual',
            ));
        }
        
        public function actionNotasTae(){
            $rutCadete = Yii::app()->getSession()->get('rutCadete');
            $model = Cadete::model()->findByPk($rutCadete);
            
            $this->render('notasTae',array(
                'model' => $model,
                'titulo' => 'Examen Inglés TAE',
            ));
        }
        
        public function actionCalificaciones(){
            $ano = '';
            if(isset($_POST['ano'])){
                $ano = $_POST['ano'];
            }else{
                $ano = Calificaciones::model()->getAnoMax(Yii::app()->getSession()->get('rutCadete'));
            }
            $rutCadete = Yii::app()->getSession()->get('rutCadete');
            $model = $this->loadModel($rutCadete);
            
            $semestre1 = null;
            $semestre2 = null;
            if(!empty($ano)){
                $semestre1 = $model->getCalificacionesAnoSemestre($ano,1);
                $semestre2 = $model->getCalificacionesAnoSemestre($ano,2);
            }
            
            $this->render('calificaciones', array(
                'semestre1' => $semestre1,
                'semestre2' => $semestre2,
                'ano' => $ano,
                'titulo' => 'Calificaciones',
            ));
        }
        
        public function actionFichaCapacidad(){
            $ano = '';
            if(isset($_POST['ano'])){
                $ano = $_POST['ano'];
            }else{
                $ano = NotasFisico::model()->getAnoMax(Yii::app()->getSession()->get('rutCadete'));
            }
            
            $rutCadete = Yii::app()->getSession()->get('rutCadete');
            $model = $this->loadModel($rutCadete);
            
            $semestre1 = null;
            $semestre2 = null;
            if(!empty($ano)){
                $semestre1 = $model->getNotasFisicoAnoSemestre($ano, 1);
                $semestre2 = $model->getNotasFisicoAnoSemestre($ano, 2);
            }
            $this->render('notasFisico', array(
                'semestre1' => $semestre1,
                'semestre2' => $semestre2,
                'ano' => $ano,
                'titulo' => 'Ficha Capacidad Física',
            ));
        }
       
        public function actionNivelacion(){
            $ano = 0;
            $semestre = 0;
            $etapa = 0;
            if(isset($_POST['ano'])){
                if($_POST['ano'] != Yii::app()->getSession()->get('ano')){
                    $ano = $_POST['ano'];
                    Yii::app()->getSession()->add('ano', $ano);
                    $semestre = Nivelacion::model()->getSemestreMin(Yii::app()->getSession()->get('rutCadete'), $ano);
                    Yii::app()->getSession()->add('semestre', $semestre);
                    $etapa = Nivelacion::model()->getEtapaMin(Yii::app()->getSession()->get('rutCadete'), $ano, $semestre);
                    Yii::app()->getSession()->add('etapa', $etapa);
                }elseif($_POST['semestre'] != Yii::app()->getSession()->get('semestre')){
                    $ano = $_POST['ano'];
                    $semestre = $_POST['semestre'];
                    Yii::app()->getSession()->add('semestre', $semestre);
                    $etapa = Nivelacion::model()->getEtapaMin(Yii::app()->getSession()->get('rutCadete'), $ano, $semestre);
                    Yii::app()->getSession()->add('etapa', $etapa);
                }else{
                    $ano = $_POST['ano'];
                    $semestre = $_POST['semestre'];
                    $etapa = $_POST['etapa'];
                    Yii::app()->getSession()->add('etapa', $etapa);
                }
            }else{
                $ano = Nivelacion::model()->getAnoMax(Yii::app()->getSession()->get('rutCadete'));
                if($ano!=0){
                    Yii::app()->getSession()->add('ano', $ano);
                    $semestre = Nivelacion::model()->getSemestreMin(Yii::app()->getSession()->get('rutCadete'), $ano);
                    Yii::app()->getSession()->add('semestre', $semestre);
                    $etapa = Nivelacion::model()->getEtapaMin(Yii::app()->getSession()->get('rutCadete'), $ano, $semestre);
                    Yii::app()->getSession()->add('etapa', $etapa);
                }
            }
            
            
            $rutCadete = Yii::app()->getSession()->get('rutCadete');
            $model = $this->loadModel($rutCadete);
            
            $resultado = $model->getNivelacionAnoSemestreEtapa($ano, $semestre, $etapa);
            
            
            $this->render('nivelacion', array(
                'ano' => $ano,
                'semestre' => $semestre,
                'etapa' => $etapa,
                'resultado' => $resultado,
                'titulo' => 'Nivelacion',
            ));
        }
        
        public function actionFrancos(){
            $rutCadete = Yii::app()->getSession()->get('rutCadete');
            $model = $this->loadModel($rutCadete);
            
            $this->render('francos', array(
                'model' => $model,
                'titulo' => 'Papeleta de Salida del Cadete',
            ));
        }
}
