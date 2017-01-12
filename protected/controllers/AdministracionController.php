<?php

class AdministracionController extends Controller
{
    public $layout='//layouts/column2';

    public function filters()
    {
	return array(
            'accessControl', // perform access control for CRUD operations
            'postOnly + delete', // we only allow deletion via POST request
	);
    }

    public function accessRules()
    {
	return array(
            array('allow',
		'actions'=>array('reiniciarTablas'),
                		'expression'=>'Yii::app()->getSession()->get("tipoFuncionario")=="Administrador"',
            ),
            array('deny',  // deny all users
		'users'=>array('*'),
            ),
	);
    }

    public function actionReiniciarTablas()
    {
        if(!is_null(Yii::app()->request->getPost('id'))){
            switch (Yii::app()->request->getPost('id')) {
                case 'todo':
                    Administracion::reiniciarTodo();
                    break;
                case 'notas_parciales':
                    Administracion::deleteNotasParciales();
                    break;
                case 'notas_finales':
                    Administracion::deleteNotasFinales();
                    break;
                case 'ingles_tae':
                    Administracion::deleteInglesTae();
                    break;
                case 'calificacion':
                    Administracion::deleteCalificaciones();
                    break;
                case 'notas_fisica':
                    Administracion::deleteNotasFisico();
                    Administracion::deleteNivelacion();
                    break;
                case 'calificacion':
                    Administracion::deleteCalificaciones();
                    break;
                case 'francos':
                    Administracion::deleteFranco();
                    break;
                case 'asignatura':
                    Administracion::deleteNotasParciales();
                    Administracion::deleteNotasFinales();
                    Administracion::deleteResumen();
                    Administracion::deleteAsignatura();
                    break;
                case 'finanzas':
                    Administracion::deleteFinanzas();
                    break;
            }
            echo "proceso realizado...";
        }else{
            $this->render('reiniciarTablas');
        }
    }
}
