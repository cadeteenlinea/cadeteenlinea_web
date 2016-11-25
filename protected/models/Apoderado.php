<?php

/**
 * This is the model class for table "apoderado".
 *
 * The followings are the available columns in table 'apoderado':
 * @property string $rut
 * @property string $direccion
 * @property string $comuna
 * @property string $ciudad
 * @property string $region
 * @property string $fono
 * @property string $fonoComercial
 * @property string $difunto
 *
 * The followings are the available model relations:
 * @property Usuario $usuario
 * @property CadeteApoderado[] $cadeteApoderados
 */
class Apoderado extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'apoderado';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('rut, difunto', 'required'),
			array('rut', 'length', 'max'=>10),
			array('direccion', 'length', 'max'=>100),
			array('comuna, ciudad, region, fonoComercial', 'length', 'max'=>25),
			array('fono', 'length', 'max'=>15),
			array('difunto', 'length', 'max'=>2),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('rut, direccion, comuna, ciudad, region, fono, fonoComercial, difunto', 'safe', 'on'=>'search'),
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
			'usuario' => array(self::BELONGS_TO, 'Usuario', 'rut'),
			'cadeteApoderados' => array(self::HAS_MANY, 'CadeteApoderado', 'apoderado_rut'),
                        'cadetes'=>array(self::MANY_MANY, 'Cadete','cadete_apoderado(apoderado_rut, cadete_rut)'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'rut' => 'Rut',
			'direccion' => 'Direccion',
			'comuna' => 'Comuna',
			'ciudad' => 'Ciudad',
			'region' => 'Region',
			'fono' => 'Fono',
			'fonoComercial' => 'Fono Comercial',
			'difunto' => 'Difunto',
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

		$criteria->compare('rut',$this->rut,true);
		$criteria->compare('direccion',$this->direccion,true);
		$criteria->compare('comuna',$this->comuna,true);
		$criteria->compare('ciudad',$this->ciudad,true);
		$criteria->compare('region',$this->region,true);
		$criteria->compare('fono',$this->fono,true);
		$criteria->compare('fonoComercial',$this->fonoComercial,true);
		$criteria->compare('difunto',$this->difunto,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}
        
	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Apoderado the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        function beforeDelete(){
            if( $this->cadeteApoderados !== array() )
                return false;
            if( $this->cadetes !== array() )
                return false;
            if( $this->usuario !== array() )
                return false;
            return parent::beforeDelete();
        }
        
        public function getCadetes(){
            return $this->cadetes;
        }
        
        public function seleccionarCadete($rutCadete){
            if($this->validarCadeteAsociado($rutCadete)){
                Yii::app()->getSession()->remove('rutCadete');
                Yii::app()->getSession()->add('rutCadete', $rutCadete);
                
                $model = Cadete::model()->findByPk($rutCadete);
                Yii::app()->getSession()->remove('nCadete');
                Yii::app()->getSession()->add('nCadete', $model->nCadete);
                Yii::app()->getSession()->remove('apellidoPaternoCadete');
                Yii::app()->getSession()->add('apellidoPaternoCadete', $model->usuario->apellidoPat);
                
                return true;
            }else{
                return false;
            }
        }
        
        private function validarCadeteAsociado($rutCadete){
            foreach ($this->cadeteApoderados as $item){
                if($item->cadete_rut == $rutCadete){
                    return true;
                    break;
                }
            }
            return false;
        }
        
        private function deleteRelacionCadete(){
            foreach ($this->cadeteApoderados as $cadeteApoderado) {
                $cadeteApoderado->delete();
            }
        }
        
        public function tipoApoderado($rut){
            $criteria=new CDbCriteria;
            $criteria->addCondition('cadete_rut='.$rut);
            $criteria->addCondition('apoderado_rut='.$this->rut);
            $model = CadeteApoderado::model()->find($criteria);
            return $model->tipoApoderado;
        }
        
        public static function saveWeb($apoderados){
            $error = "";
            $errores = "";
            foreach ($apoderados as $apoderado){
                $model = Apoderado::model()->findByPk($apoderado["rut"]);
                if(empty($model)){
                    $model =  new Apoderado();
                    $model->rut = $apoderado["rut"];
                }
                $model->direccion = $apoderado["direccion"];
                $model->comuna = $apoderado["comuna"];
                $model->ciudad = $apoderado["ciudad"];
                $model->region = $apoderado["ciudad"];
                $model->fono = $apoderado["fono"];
                $model->fonoComercial = $apoderado["fonoComercial"];
                $model->difunto = $apoderado["difunto"];
                
                try{
                    if(!$model->save()){
                        foreach($model->errors as $error){
                            $er = new Error('99999', $model->rut, 'apoderado', $error[0]);
                            $errores[] = $er;
                        }
                    }
                } catch (CDbException $e){
                    $er = new Error($e->errorInfo[1], $model->rut, 'apoderado', $e->errorInfo[2]);
                    $errores[] = $er;
                } 
            }
            return $errores;
        }
        
        public static function deleteWeb($apoderados){
            $error = "";
            $errores = "";
            foreach ($apoderados as $apoderado){
                $model=Apoderado::model()->findByPk($apoderado["rut"]);
                try{
                    if(!empty($model)){
                        $model->deleteRelacionCadete();
                        if(!$model->delete()){
                            $er = new Error('99998', $apoderado["rut"], 'apoderado', "Apoderado no existe en el sistema");
                            $errores[] = $er;
                        }
                    }else{
                        $er = new Error('99998', $apoderado["rut"], 'apoderado', "Apoderado no existe en el sistema");
                        $errores[] = $er;
                    }
                } catch (CDbException $e){
                    $er = new Error($e->errorInfo[1], $apoderado["rut"], 'apoderado', $e->errorInfo[2]);
                    $errores[] = $er;
                } 
            }
            return $errores;
        }
}
