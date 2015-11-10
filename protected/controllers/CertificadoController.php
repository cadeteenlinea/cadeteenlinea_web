<?php

class CertificadoController extends Controller
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
				'actions'=>array('view', 'Create', 'MisCertificados'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

        public function actionCreate()
	{
		$model=new Certificado;

		if(isset($_POST['Certificado']))
		{
			$model->attributes=$_POST['Certificado'];

                        //cadete a quien pertenece el certificado
                        $rutCadete = Yii::app()->getSession()->get('rutCadete');
                        $model->fecha_solicitud = date("Y-m-d H:i:s");
                        $model->tipo_certificado_idtipo_certificado = 1;
                        //usuario que pide el certificado
                        $model->usuario_rut = Yii::app()->user->id;
                        $model->cadete_rut = $rutCadete;
                        
			if($model->save())
				$this->redirect(array('MisCertificados'));
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}
        
        public function actionMisCertificados(){
            
                $model=new Certificado('search');
		$model->unsetAttributes();  // clear any default values
                
                $model->usuario_rut = Yii::app()->user->id;
		if(isset($_GET['Certificado'])){
			$model->attributes=$_GET['Certificado'];
                        $model->usuario_rut = Yii::app()->user->id;
                }

                $this->render('misCertificados',array(
			'model'=>$model,
		));
        }
        
        public function loadModel($id)
	{
		$model=Certificado::model()->findByPk($id);
		if($model===null)
			throw new CHttpException(404,'The requested page does not exist.');
		return $model;
	}
        
        public function actionView($id)
	{
            $model = $this->loadModel($id);
            $this->layout = '//layouts/pdf';
            $mPDF1 = Yii::app()->ePdf->mpdf('', 'Letter');

            # render (full page)
            $mPDF1->WriteHTML($this->render('view', array('model'=>$model), true));

            # Outputs ready PDF
            $mPDF1->Output();
	}
      
        
        public function actionGenerarPDF()
	{
            $rut = Yii::app()->user->id;
            $model = Usuario::model()->findByPk($rut);
            
            if(isset($_POST['Usuario'])){
                $this->layout = '//layouts/pdf';
                $mPDF1 = Yii::app()->ePdf->mpdf();
                $mPDF1->WriteHTML($this->render('generarPDF', array
                        ('model'=>$model), true)); 
                $mPDF1->Output('Certificaado'.date('Ymd'),'I');  
                exit;
            }
            $this->render('generarPDF');
        }
}