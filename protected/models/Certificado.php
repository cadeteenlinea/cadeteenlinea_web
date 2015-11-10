<?php

/**
 * This is the model class for table "certificado".
 *
 * The followings are the available columns in table 'certificado':
 * @property integer $idcertificado
 * @property string $usuario_rut
 * @property string $fecha_solicitud
 * @property string $fecha_vencimiento
 * @property string $fecha_aprobacion
 */
class Certificado extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'certificado';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idcertificado, usuario_rut, fecha_solicitud, fecha_vencimiento, fecha_aprobacion', 'required'),
			array('idcertificado', 'numerical', 'integerOnly'=>true),
			array('usuario_rut', 'length', 'max'=>10),
			array('fecha_solicitud, fecha_vencimiento, fecha_aprobacion', 'length', 'max'=>50),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idcertificado, usuario_rut, fecha_solicitud, fecha_vencimiento, fecha_aprobacion', 'safe', 'on'=>'search'),
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
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idcertificado' => 'Idcertificado',
			'usuario_rut' => 'Usuario Rut',
			'fecha_solicitud' => 'Fecha Solicitud',
			'fecha_vencimiento' => 'Fecha Vencimiento',
			'fecha_aprobacion' => 'Fecha Aprobacion',
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

		$criteria->compare('idcertificado',$this->idcertificado);
		$criteria->compare('usuario_rut',$this->usuario_rut,true);
		$criteria->compare('fecha_solicitud',$this->fecha_solicitud,true);
		$criteria->compare('fecha_vencimiento',$this->fecha_vencimiento,true);
		$criteria->compare('fecha_aprobacion',$this->fecha_aprobacion,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Certificado the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        /*static function getListAno($rutCadete){
            $criteria=new CDbCriteria;
            $criteria->select='t.ano as ano';
            $criteria->addCondition('t.cadete_rut='.$rutCadete);
            $criteria->distinct=true;
            $model = Nivelacion::model()->findAll($criteria);
            
            return CHtml::listData($model, 'ano', 'ano');
        }*/
}
