<?php

class ContactoController extends Controller
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
				'actions'=>array('contactoDepartamentos', 'contactoOficiales'),
				'users'=>array('@'),
			),
			array('deny',  // deny all users
				'users'=>array('*'),
			),
		);
	}

                
        public function actionContactoDepartamentos(){
            $this->render('contactoDepartamentos',array(
                'titulo' => 'Contacto Departamentos',
            ));
        }
        
        public function actionContactoOficiales(){
            $this->render('contactoOficiales',array(
                'titulo' => 'Contacto Oficiales de División',
            ));
        }
}

