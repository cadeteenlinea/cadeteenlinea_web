<?php

/**
 * This is the model class for table "notas_finales".
 *
 * The followings are the available columns in table 'notas_finales':
 * @property integer $idnotas_finales
 * @property double $nota_presentacion
 * @property double $nota_examen
 * @property double $nota_final
 * @property double $nota_examen_repeticion
 * @property double $nota_final_repeticion
 * @property string $estado
 * @property integer $asignatura_idasignatura
 * @property string $cadete_rut
 *
 * The followings are the available model relations:
 * @property Asignatura $asignatura
 * @property Cadete $cadete
 */
class NotasFinales extends CActiveRecord
{
        public $ano;
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'notas_finales';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nota_presentacion, nota_final, estado, asignatura_idasignatura, cadete_rut', 'required'),
			array('asignatura_idasignatura', 'numerical', 'integerOnly'=>true),
			array('nota_presentacion, nota_examen, nota_final, nota_examen_repeticion, nota_final_repeticion', 'numerical'),
			array('estado', 'length', 'max'=>1),
			array('cadete_rut', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idnotas_finales, nota_presentacion, nota_examen, nota_final, nota_examen_repeticion, nota_final_repeticion, estado, asignatura_idasignatura, cadete_rut', 'safe', 'on'=>'search'),
		);
	}

	/**
	 * @return array relational rules.
	 */
	public function relations()
	{
		// NOTE: you may need to adjust the relation name and the related
		// class name for the relations automatically generated below.
		return array(
			'asignatura' => array(self::BELONGS_TO, 'Asignatura', 'asignatura_idasignatura'),
			'cadete' => array(self::BELONGS_TO, 'Cadete', 'cadete_rut'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idnotas_finales' => 'Idnotas Finales',
			'nota_presentacion' => 'Nota Presentacion',
			'nota_examen' => 'Nota Examen',
			'nota_final' => 'Nota Final',
			'nota_examen_repeticion' => 'Nota Examen Repeticion',
			'nota_final_repeticion' => 'Nota Final Repeticion',
			'estado' => 'Estado',
			'asignatura_idasignatura' => 'Asignatura Idasignatura',
			'cadete_rut' => 'Cadete Rut',
		);
	}

	/**
	 * Retrieves a list of models based on the current search/filter conditions.
	 *
	 * Typical usecase:
	 * - Initialize the model fields with values from filter form.
	 * - Execute this method to get CActiveDataProvider instance which will filter
	 * models according to data in model fields.
	 * - Pass data provider to CGridView, CListView or any similar widget.
	 *
	 * @return CActiveDataProvider the data provider that can return the models
	 * based on the search/filter conditions.
	 */
	public function search()
	{
		// @todo Please modify the following code to remove attributes that should not be searched.

		$criteria=new CDbCriteria;

		$criteria->compare('idnotas_finales',$this->idnotas_finales);
		$criteria->compare('nota_presentacion',$this->nota_presentacion);
		$criteria->compare('nota_examen',$this->nota_examen);
		$criteria->compare('nota_final',$this->nota_final);
		$criteria->compare('nota_examen_repeticion',$this->nota_examen_repeticion);
		$criteria->compare('nota_final_repeticion',$this->nota_final_repeticion);
		$criteria->compare('estado',$this->estado,true);
		$criteria->compare('asignatura_idasignatura',$this->asignatura_idasignatura);
		$criteria->compare('cadete_rut',$this->cadete_rut,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return NotasFinales the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        public function getEstado(){
            if($this->estado == 'A'){
                return 'aprobado';
            }elseif ($this->estado == 'E') {
                return 'eximido';
            }else{
                return 'reprobado';
            }
        }
        
        static function getAnoMax($rutCadete){
            $criteria=new CDbCriteria;
            $criteria->with = 'asignatura';
            $criteria->select='MAX(asignatura.ano) as ano';
            $criteria->addCondition('t.cadete_rut='.$rutCadete);
            $model = NotasFinales::model()->find($criteria);
            if(!empty($model))
                return $model->ano;
            return null;
        }
        
        static function getListAno($rutCadete){
            $criteria=new CDbCriteria;
            $criteria->with = 'asignatura';
            $criteria->select='asignatura.ano as ano';
            $criteria->addCondition('t.cadete_rut='.$rutCadete);
            $criteria->distinct=true;
            $model = NotasFinales::model()->findAll($criteria);
            
            return CHtml::listData($model, 'asignatura.ano', 'asignatura.ano');
        }
        
        static function getNotaAnoCadete($rutCadete, $idAsignatura){
            $criteria=new CDbCriteria;
            $criteria->addCondition('cadete_rut = '. $rutCadete);
            $criteria->addCondition('asignatura_idasignatura='.$idAsignatura);
            $model = NotasFinales::model()->find($criteria);
            return $model;
        }
        
        public static function saveWeb($notas){
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
            return $errores;
        }
        
        public static function deleteWeb($notas){
            $error = "";
            $errores = "";
            foreach ($notas as $nota){
                $model=NotasFinales::model()->findByPk($nota["idnotas_finales"]);
                if(!$model->delete()){
                   $error["idnotas_finales"] = $nota["idnotas_finales"];
                   $errores[] = array($error["idnotas_finales"], "Nota Ingles no existe en el sistema"); 
                }
            }
            return $errores;
        }
}
