<?php

/**
 * This is the model class for table "certificado".
 *
 * The followings are the available columns in table 'certificado':
 * @property integer $idcertificado
 * @property string $fecha_solicitud
 * @property string $fecha_vencimiento
 * @property string $fecha_aprobacion
 * @property integer $motivo_idmotivo
 * @property string $usuario_rut
 * @property integer $tipo_certificado_idtipo_certificado
 * @property string $cadete_rut
 *
 * The followings are the available model relations:
 * @property Cadete $cadete
 * @property Motivo $motivo
 * @property TipoCertificado $tipoCertificado
 * @property Usuario $usuario
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
			array('fecha_solicitud, motivo_idmotivo, usuario_rut, tipo_certificado_idtipo_certificado, cadete_rut', 'required'),
			array('idcertificado, motivo_idmotivo, tipo_certificado_idtipo_certificado', 'numerical', 'integerOnly'=>true),
			array('fecha_solicitud, fecha_vencimiento, fecha_aprobacion', 'length', 'max'=>50),
			array('usuario_rut, cadete_rut', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idcertificado, fecha_solicitud, fecha_vencimiento, fecha_aprobacion, motivo_idmotivo, usuario_rut, tipo_certificado_idtipo_certificado, cadete_rut', 'safe', 'on'=>'search'),
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
			'motivo' => array(self::BELONGS_TO, 'Motivo', 'motivo_idmotivo'),
			'tipoCertificado' => array(self::BELONGS_TO, 'TipoCertificado', 'tipo_certificado_idtipo_certificado'),
			'usuario' => array(self::BELONGS_TO, 'Usuario', 'usuario_rut'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idcertificado' => 'Idcertificado',
			'fecha_solicitud' => 'Fecha Solicitud',
			'fecha_vencimiento' => 'Fecha Vencimiento',
			'fecha_aprobacion' => 'Fecha Aprobacion',
			'motivo_idmotivo' => 'Motivo',
			'usuario_rut' => 'Usuario',
			'tipo_certificado_idtipo_certificado' => 'Tipo Certificado',
			'cadete_rut' => 'Cadete',
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
		$criteria->compare('fecha_solicitud',$this->fecha_solicitud,true);
		$criteria->compare('fecha_vencimiento',$this->fecha_vencimiento,true);
		$criteria->compare('fecha_aprobacion',$this->fecha_aprobacion,true);
		$criteria->compare('motivo_idmotivo',$this->motivo_idmotivo);
		$criteria->compare('usuario_rut',$this->usuario_rut,true);
		$criteria->compare('tipo_certificado_idtipo_certificado',$this->tipo_certificado_idtipo_certificado);
		$criteria->compare('cadete_rut',$this->cadete_rut,true);

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
        
        
        public static function getAllCertificadosCadete(){
            
            $criteria=new CDbCriteria;
            $criteria->addCondition('t.usuario_rut='.Yii::app()->user->id);
            $model = Certificado::model()->findAll($criteria);
            
            return $model;
        }
}
