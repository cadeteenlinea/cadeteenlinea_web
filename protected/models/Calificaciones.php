<?php

/**
 * This is the model class for table "calificaciones".
 *
 * The followings are the available columns in table 'calificaciones':
 * @property integer $idcalificaciones
 * @property integer $ano
 * @property integer $semestre
 * @property double $mando
 * @property double $interes_profesional
 * @property double $personalidad_madurez
 * @property double $responsabilidad
 * @property double $espiritu_militar
 * @property double $cooperacion
 * @property double $conducta
 * @property double $aptitud_fisica
 * @property double $tenida_orden_aseo
 * @property double $final
 * @property string $cadete_rut
 *
 * The followings are the available model relations:
 * @property Cadete $cadete
 */
class Calificaciones extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'calificaciones';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('semestre, mando, interes_profesional, personalidad_madurez, responsabilidad, espiritu_militar, cooperacion, conducta, aptitud_fisica, tenida_orden_aseo, final, cadete_rut', 'required'),
			array('ano, semestre', 'numerical', 'integerOnly'=>true),
			array('mando, interes_profesional, personalidad_madurez, responsabilidad, espiritu_militar, cooperacion, conducta, aptitud_fisica, tenida_orden_aseo, final', 'numerical'),
			array('cadete_rut', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idcalificaciones, ano, semestre, mando, interes_profesional, personalidad_madurez, responsabilidad, espiritu_militar, cooperacion, conducta, aptitud_fisica, tenida_orden_aseo, final, cadete_rut', 'safe', 'on'=>'search'),
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
			'cadete' => array(self::BELONGS_TO, 'Cadete', 'cadete_rut'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idcalificaciones' => 'Idcalificaciones',
			'ano' => 'Ano',
			'semestre' => 'Semestre',
			'mando' => 'Mando',
			'interes_profesional' => 'Interes Profesional',
			'personalidad_madurez' => 'Personalidad Madurez',
			'responsabilidad' => 'Responsabilidad',
			'espiritu_militar' => 'Espiritu Militar',
			'cooperacion' => 'Cooperacion',
			'conducta' => 'Conducta',
			'aptitud_fisica' => 'Aptitud Fisica',
			'tenida_orden_aseo' => 'Tenida Orden Aseo',
			'final' => 'Final',
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

		$criteria->compare('idcalificaciones',$this->idcalificaciones);
		$criteria->compare('ano',$this->ano);
		$criteria->compare('semestre',$this->semestre);
		$criteria->compare('mando',$this->mando);
		$criteria->compare('interes_profesional',$this->interes_profesional);
		$criteria->compare('personalidad_madurez',$this->personalidad_madurez);
		$criteria->compare('responsabilidad',$this->responsabilidad);
		$criteria->compare('espiritu_militar',$this->espiritu_militar);
		$criteria->compare('cooperacion',$this->cooperacion);
		$criteria->compare('conducta',$this->conducta);
		$criteria->compare('aptitud_fisica',$this->aptitud_fisica);
		$criteria->compare('tenida_orden_aseo',$this->tenida_orden_aseo);
		$criteria->compare('final',$this->final);
		$criteria->compare('cadete_rut',$this->cadete_rut,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Calificaciones the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        static function getAnoMax($rutCadete){
            $criteria=new CDbCriteria;
            $criteria->select='MAX(ano) as ano';
            $criteria->addCondition('cadete_rut='.$rutCadete);
            $model = Calificaciones::model()->find($criteria);
            if(!empty($model))
                return $model->ano;
            return null;
        }
        
        static function getListAno($rutCadete){
            $criteria=new CDbCriteria;
            $criteria->select='t.ano as ano';
            $criteria->addCondition('t.cadete_rut='.$rutCadete);
            $criteria->distinct=true;
            $model = Calificaciones::model()->findAll($criteria);
            
            return CHtml::listData($model, 'ano', 'ano');
        }
        
        public static function saveWeb($calificaciones){
            $error = "";
            $errores = "";
            foreach ($calificaciones as $calificacion){
                $model = Calificaciones::model()->findByPk($calificacion["idcalificaciones"]);
                if(empty($model)){
                    $model =  new Calificaciones();
                    $model->idcalificaciones = $calificacion["idcalificaciones"];
                }
                $model->ano = $calificacion["ano"];
                $model->semestre = $calificacion["semestre"];
                $model->mando = $calificacion["mando"];
                $model->interes_profesional = $calificacion["interes_profesional"];
                $model->personalidad_madurez = $calificacion["personalidad_madurez"];
                $model->responsabilidad = $calificacion["responsabilidad"];
                $model->espiritu_militar = $calificacion["espiritu_militar"];
                $model->cooperacion = $calificacion["cooperacion"];
                $model->conducta = $calificacion["conducta"];
                $model->aptitud_fisica = $calificacion["aptitud_fisica"];
                $model->tenida_orden_aseo = $calificacion["tenida_orden_aseo"];
                $model->final = $calificacion["final"];
                $model->cadete_rut = $calificacion["cadete_rut"];
                
                if(!$model->save()){
                    $error["idcalificaciones"] = $model->idcalificaciones;
                    $error["error"] = $model->errors;
                    $errores[] = array($error["idcalificaciones"], $error["error"]);
                }
            }
            return $errores;
        }
        
        public static function deleteWeb($calificaciones){
            $error = "";
            $errores = "";
            foreach ($calificaciones as $calificacion){
                $model=Calificaciones::model()->findByPk($calificacion["idcalificaciones"]);
                if(!empty($model)){
                    if(!$model->delete()){
                       $error["idcalificaciones"] = $calificacion["idcalificaciones"];
                       $errores[] = array($error["idcalificaciones"], "Calificacion no existe en el sistema"); 
                    }
                }else{
                    $error["idcalificaciones"] = $calificacion["idcalificaciones"];
                    $errores[] = array($error["idcalificaciones"], "Calificacion no existe en el sistema");
                }
            }
            return $errores;
        }
}
