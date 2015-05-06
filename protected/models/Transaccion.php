<?php

/**
 * This is the model class for table "transaccion".
 *
 * The followings are the available columns in table 'transaccion':
 * @property string $idtransaccion
 * @property string $cadete_rut
 * @property string $tipoTransaccion
 * @property string $monto
 * @property string $fechaMovimiento
 * @property string $descripcion
 * @property string $tipoCuenta
 *
 * The followings are the available model relations:
 * @property Cadete $cadete
 */
class Transaccion extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'transaccion';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cadete_rut, tipoTransaccion, monto, fechaMovimiento, descripcion, tipoCuenta', 'required'),
			array('cadete_rut, monto', 'length', 'max'=>10),
			array('tipoTransaccion', 'length', 'max'=>5),
			array('descripcion', 'length', 'max'=>150),
			array('tipoCuenta', 'length', 'max'=>11),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idtransaccion, cadete_rut, tipoTransaccion, monto, fechaMovimiento, descripcion, tipoCuenta', 'safe', 'on'=>'search'),
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
			'idtransaccion' => 'Idtransaccion',
			'cadete_rut' => 'Cadete Rut',
			'tipoTransaccion' => 'Tipo Transaccion',
			'monto' => 'Monto',
			'fechaMovimiento' => 'Fecha Movimiento',
			'descripcion' => 'Descripcion',
			'tipoCuenta' => 'Tipo Cuenta',
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

		$criteria->compare('idtransaccion',$this->idtransaccion,true);
		$criteria->compare('cadete_rut',$this->cadete_rut,true);
		$criteria->compare('tipoTransaccion',$this->tipoTransaccion,true);
		$criteria->compare('monto',$this->monto,true);
		$criteria->compare('fechaMovimiento',$this->fechaMovimiento,true);
		$criteria->compare('descripcion',$this->descripcion,true);
		$criteria->compare('tipoCuenta',$this->tipoCuenta,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Transaccion the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        public function getSumTransaccionesTipoTran($rutCadete, $tipoCuenta, $ano, $tipoTransaccion){
            
            $command=Yii::app()->db->createCommand();
            $command->select('SUM(monto) AS sum');
            $command->from('Transaccion');
            $command->where('cadete_rut=:rutCadete and YEAR(fechaMovimiento)=:ano and tipoCuenta=:tipoCuenta and tipoTransaccion=:tipoTransaccion', 
                array(':rutCadete'=>$rutCadete,
                    ':ano'=>$ano,
                    'tipoCuenta'=>$tipoCuenta,
                    'tipoTransaccion'=>$tipoTransaccion
                    ));
            return $command->queryScalar();;
            /*$criteria = new CDbCriteria;
            $criteria->select="SUM(monto) as sum";
            return $this->find($criteria);*/
        }    
}
