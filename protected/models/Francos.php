<?php

/**
 * This is the model class for table "francos".
 *
 * The followings are the available columns in table 'francos':
 * @property integer $idfrancos
 * @property string $fecha_salida
 * @property string $hora_salida
 * @property string $hora_recogida
 * @property string $fecha_recogida
 * @property string $asignatura_bajo
 * @property string $cadete_rut
 *
 * The followings are the available model relations:
 * @property Cadete $cadeteRut
 */
class Francos extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'francos';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idfrancos, cadete_rut', 'required'),
			array('idfrancos', 'numerical', 'integerOnly'=>true),
			array('fecha_salida, hora_salida, hora_recogida, fecha_recogida, asignatura_bajo', 'length', 'max'=>50),
			array('cadete_rut', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idfrancos, fecha_salida, hora_salida, hora_recogida, fecha_recogida, asignatura_bajo, cadete_rut', 'safe', 'on'=>'search'),
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
			'cadeteRut' => array(self::BELONGS_TO, 'Cadete', 'cadete_rut'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idfrancos' => 'Idfrancos',
			'fecha_salida' => 'Fecha Salida',
			'hora_salida' => 'Hora Salida',
			'hora_recogida' => 'Hora Recogida',
			'fecha_recogida' => 'Fecha Recogida',
			'asignatura_bajo' => 'Asignatura Bajo',
			'francoscol' => 'Francoscol',
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

		$criteria->compare('idfrancos',$this->idfrancos);
		$criteria->compare('fecha_salida',$this->fecha_salida,true);
		$criteria->compare('hora_salida',$this->hora_salida,true);
		$criteria->compare('hora_recogida',$this->hora_recogida,true);
		$criteria->compare('fecha_recogida',$this->fecha_recogida,true);
		$criteria->compare('asignatura_bajo',$this->asignatura_bajo,true);
		$criteria->compare('francoscol',$this->francoscol,true);
		$criteria->compare('cadete_rut',$this->cadete_rut,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Francos the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        /*
         * guardado de datos enviados por aplicación escritorio
         * son enviados por Json
         */
        public static function saveWeb($francos){
            $error = "";
            $errores = "";
            foreach ($francos as $franco){
                $model = Francos::model()->findByPk($franco["idfrancos"]);
                if(empty($model)){
                    $model =  new Francos();
                    $model->idfrancos = $franco["idfrancos"];
                }
                
                $model->fecha_salida = $franco["fecha_salida"];
                $model->hora_salida = $franco["hora_salida"];
                $model->hora_recogida = $franco["hora_recogida"];
                $model->fecha_recogida = $franco["fecha_recogida"];
                $model->asignatura_bajo = $franco["asignatura_bajo"];

                $model->cadete_rut = $franco["cadete_rut"];
                
                try{
                    if(!$model->save()){
                        foreach($model->errors as $error){
                            $er = new Error('99999', $model->idfrancos, 'franco', $error[0]);
                            $errores[] = $er;
                        }
                    }
                } catch (CDbException $e){
                    $er = new Error($e->errorInfo[1], $model->idfrancos, 'franco', $e->errorInfo[2]);
                    $errores[] = $er;
                } 
            }
            return $errores;
        }
}
