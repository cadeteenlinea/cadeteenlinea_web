<?php

/**
 * This is the model class for table "archivos".
 *
 * The followings are the available columns in table 'archivos':
 * @property integer $idarchivos
 * @property string $fecha
 * @property integer $tipo_archivo_idtipo_archivo
 *
 * The followings are the available model relations:
 * @property TipoArchivo $tipoArchivo
 */
class Archivos extends CActiveRecord
{
	public $archivo;
        
	public function tableName()
	{
		return 'archivos';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('tipo_archivo_idtipo_archivo, fecha, archivo', 'required'),
			array('tipo_archivo_idtipo_archivo', 'numerical', 'integerOnly'=>true),
                        array('archivo', 'file', 'types'=>'txt'),
			array('fecha', 'safe'),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idarchivos, fecha, tipo_archivo_idtipo_archivo', 'safe', 'on'=>'search'),
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
			'tipoArchivo' => array(self::BELONGS_TO, 'TipoArchivo', 'tipo_archivo_idtipo_archivo'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idarchivos' => 'Idarchivos',
			'fecha' => 'Fecha',
			'tipo_archivo_idtipo_archivo' => 'Tipo Archivo',
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

		$criteria->compare('idarchivos',$this->idarchivos);
		$criteria->compare('fecha',$this->fecha,true);
		$criteria->compare('tipo_archivo_idtipo_archivo',$this->tipo_archivo_idtipo_archivo);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Archivos the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
}
