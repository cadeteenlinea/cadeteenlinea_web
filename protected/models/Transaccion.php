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
			array('tipoCuenta', 'length', 'max'=>16),
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
        
        //retorna la suma de las transacciones del cadete, según
        //cadete, tipo cuenta, ano y tipo de transaccion
        public function getSumTransaccionesTipoTran($rutCadete, $tipoCuenta, $ano=null, $tipoTransaccion){
            $command=Yii::app()->db->createCommand();
            $command->select('SUM(monto) AS sum');
            $command->from('transaccion');
            if($ano!=null){
                $command->where('cadete_rut=:rutCadete and YEAR(fechaMovimiento)=:ano and tipoCuenta=:tipoCuenta and tipoTransaccion=:tipoTransaccion', 
                    array(':rutCadete'=>$rutCadete,
                        ':ano'=>$ano,
                        'tipoCuenta'=>$tipoCuenta,
                        'tipoTransaccion'=>$tipoTransaccion
                        ));
            }else{
                $command->where('cadete_rut=:rutCadete and tipoCuenta=:tipoCuenta and tipoTransaccion=:tipoTransaccion', 
                    array(':rutCadete'=>$rutCadete,
                        'tipoCuenta'=>$tipoCuenta,
                        'tipoTransaccion'=>$tipoTransaccion
                        ));
            }
            return $command->queryScalar();;
        }
        
        //Despliega todos los años de las transacciones correspondientes al cadete
        //según el tipo de cuenta pedido
        static function getListAno($rutCadete, $tipoCuenta){
            $criteria=new CDbCriteria;
            $criteria->select='YEAR(t.fechaMovimiento) as fechaMovimiento';
            $criteria->addCondition("t.cadete_rut=$rutCadete");
            $criteria->addCondition("t.tipoCuenta='$tipoCuenta'");
            $criteria->distinct=true;
            $model = Transaccion::model()->findAll($criteria);
            
            return CHtml::listData($model, 
                'fechaMovimiento', 'fechaMovimiento');
        }
        
        //retorna el atributo monto con formato de dinero
        public function getMontoFormatoDinero(){
            return Yii::app()->numberFormatter->format("#,##0", $this->monto);
        }
        
        //retorna el campo fechamovimiento con el formato dd/mm/yyyy
        public function getFechaFormatoNacional(){
            return Yii::app()->dateFormatter->format("dd/MM/yyyy", $this->fechaMovimiento);
        }
        
        public static function saveWeb($transacciones){
            $error = "";
            $errores = "";
            foreach ($transacciones as $transaccion){
                $model = Transaccion::model()->findByPk($transaccion["idtransaccion"]);
                
                if(empty($model)){
                    $model =  new Transaccion();
                    $model->idtransaccion = $transaccion["idtransaccion"];
                }
                if(isset($transaccion["cadete_rut"]))
                    $model->cadete_rut = $transaccion["cadete_rut"];
                if(isset($transaccion["tipoTransaccion"]))
                    $model->tipoTransaccion = $transaccion["tipoTransaccion"];
                if(isset($transaccion["monto"]))
                    $model->monto = $transaccion["monto"];
                if(isset($transaccion["fechaMovimiento"])){
                    //Falta corregir ingreso de fecha de sistema
                    //$date = new DateTime(($transaccion["fechaMovimiento"]/1000));
                    /*list($d,$m,$y) = explode("-", $transaccion["fechaMovimiento"]);
                    $y = substr($y, 0,4); 
                    $timestamp = mktime(0,0,0,$m,$d,$y);
                    $fecha = date("Y-m-d H:i:s",$timestamp);
                    $model->fechaMovimiento = $fecha;*/
                    $fecha = substr($transaccion["fechaMovimiento"], 0,10);
                    list($d,$m,$y) = explode("-", $fecha);
                    $timestamp = mktime(0,0,0,$m,$d,$y);
                    $fecha = date("Y-m-d",$timestamp);
                    $model->fechaMovimiento = date("Y-m-d");
                }else{
                    $model->fechaMovimiento = date('Y-m-d H:i:s');
                }
                if(isset($transaccion["descripcion"]))
                    $model->descripcion = $transaccion["descripcion"];
                if(isset($transaccion["tipoCuenta"]))
                    $model->tipoCuenta = $transaccion["tipoCuenta"];
                
                try{
                    if(!$model->save()){
                        foreach($model->errors as $error){
                            $er = new Error('99999', $model->idtransaccion, 'transaccion', $error[0]);
                            $errores[] = $er;
                        }
                    }
                } catch (CDbException $e){
                    $er = new Error($e->errorInfo[1], $model->idtransaccion, 'transaccion', $e->errorInfo[2]);
                    $errores[] = $er;
                } 
            }
            return $errores;
        }
        
        public static function deleteWeb($transacciones){
            $error = "";
            $errores = "";
            foreach ($transacciones as $transaccion){
                $model=Transaccion::model()->findByPk($transaccion["idtransaccion"]);                
                try{
                    if(!empty($model)){
                        if(!$model->delete()){
                            $er = new Error('99998', $transaccion["idtransaccion"], 'cadete', "Transaccion no existe en el sistema");
                            $errores[] = $er;
                        }
                    }else{
                        $er = new Error('99998', $transaccion["idtransaccion"], 'cadete', "Transaccion no existe en el sistema");
                        $errores[] = $er;
                    }
                } catch (CDbException $e){
                    $er = new Error($e->errorInfo[1], $transaccion["idtransaccion"], 'cadete', $e->errorInfo[2]);
                    $errores[] = $er;
                } 
            }
            return $errores;
        }
}
