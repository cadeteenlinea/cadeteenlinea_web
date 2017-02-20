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
                        array('allow', // allow authenticated user to perform 'create' and 'update' actions
				'actions'=>array('admin', 'aprobar'),
				'expression'=>'Yii::app()->getSession()->get("tipoFuncionario") == "administrativo" || '
                                    .' Yii::app()->getSession()->get("tipoFuncionario") == "Administrador"',
			),
                        array('allow',  
                                'actions'=>array('validar'),
				'users'=>array('*'),
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
                        
			if($model->save()){
                            Yii::app()->user->setFlash("success","Certificado solicitado, favor esperar aprobación para poder visualizar y/o descargar");
                            $this->redirect(array('MisCertificados'));
                        }
		}

		$this->render('create',array(
			'model'=>$model,
		));
	}
        
        public function actionMisCertificados(){
            
                $model=new Certificado('searchMisCertificados');
		$model->unsetAttributes();  // clear any default values
                
                
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
                        
            if($model->usuario_rut == Yii::app()->user->id && $model->fecha_aprobacion != null){
                $this->layout = '//layouts/pdf';
                $mPDF1 = Yii::app()->ePdf->mpdf('', 'Letter');

                # render (full page)
                $mPDF1->WriteHTML($this->render('view', array('model'=>$model), true));

                # Outputs ready PDF
                $mPDF1->Output();
            }else{
                $this->redirect(array('MisCertificados'));
            }
	}
      
        
        /*public function actionGenerarPDF()
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
        }*/
        
        
        public function actionAdmin()
	{
		$model=new Certificado('search');
		$model->unsetAttributes();  // clear any default values
		if(isset($_GET['Certificado']))
			$model->attributes=$_GET['Certificado'];

		$this->render('admin',array(
			'model'=>$model,
		));
	}
        
        public function actionAprobar($id){
            $model=$this->loadModel($id);
            $fecha = date("Y-m-d H:i:s");
            $model->fecha_aprobacion = $fecha;
 
            //certificado valido por 60 dias, excepto aquellos que superen al 31-12 del presente mes
            //esos serán validos solo hasta el 31-12 del mes en curso
            $fecha_vencimiento = date('Y-m-d H:i:s',strtotime( '+60 day' , strtotime ( $fecha ) )) ;
            $fecha_maxima = date("Y-m-d H:i:s",strtotime('31-12-'.date("Y")));
            if($fecha_vencimiento>$fecha_maxima){
                $fecha_vencimiento = $fecha_maxima;
            }
            
            $model->fecha_vencimiento =  $fecha_vencimiento;
            $model->usuario_rut_aprobado = Yii::app()->user->id;
            if($model->save()){
                $model->avisoDeAprobacion();
                Yii::app()->user->setFlash("success","Certificado Folio #$model->idcertificado a sido aprobado");
            }else{
                Yii::app()->user->setFlash("error","Certificado no pudo ser aprobado");
            }
            $this->redirect(array('admin'));
        }
        
        public function actionValidar(){
            $model=new Certificado();
            $model->setScenario('validar');
            $validacion = false;
            
            if(isset($_GET['Certificado'])){
                $model->attributes=$_GET['Certificado'];
                if($model->validate()){
                    
                    $cadete_rut=substr(strtolower($model->cadete_rut),0,-2);
                    $modelCartificado = Certificado::getCertificadoValidar($model->idcertificado, $cadete_rut);

                    if(!empty($modelCartificado)){
                        if($modelCartificado->fecha_vencimiento != null){
                            $validacion = true;
                            $model = $modelCartificado;
                        }
                    }else{
                        Yii::app()->user->setFlash("error","Certificado no encontrado");
                    }
                }        
            }
            
            $this->render('validar',array(
                'model'=>$model,
                'validacion'=>$validacion,
            ));
        }
}