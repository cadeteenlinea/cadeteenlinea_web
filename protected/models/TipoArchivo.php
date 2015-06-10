<?php

/**
 * This is the model class for table "tipo_archivo".
 *
 * The followings are the available columns in table 'tipo_archivo':
 * @property integer $idtipo_archivo
 * @property string $nombre
 * @property string $tabla_sincronizar
 *
 * The followings are the available model relations:
 * @property Archivos[] $archivos
 */
class TipoArchivo extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'tipo_archivo';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nombre, tabla_sincronizar', 'required'),
			array('nombre, tabla_sincronizar', 'length', 'max'=>45),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idtipo_archivo, nombre, tabla_sincronizar', 'safe', 'on'=>'search'),
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
			'archivos' => array(self::HAS_MANY, 'Archivos', 'tipo_archivo_idtipo_archivo'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idtipo_archivo' => 'Idtipo Archivo',
			'nombre' => 'Nombre',
			'tabla_sincronizar' => 'Tabla Sincronizar',
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

		$criteria->compare('idtipo_archivo',$this->idtipo_archivo);
		$criteria->compare('nombre',$this->nombre,true);
		$criteria->compare('tabla_sincronizar',$this->tabla_sincronizar,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return TipoArchivo the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        public static function getListTipoArchivo(){
            return CHtml::listData(TipoArchivo::model()->findAll(),'idtipo_archivo','nombre');
        }
}
