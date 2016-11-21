<?php

/**
 * This is the model class for table "cadete_apoderado".
 *
 * The followings are the available columns in table 'cadete_apoderado':
 * @property string $idcadete_apoderado
 * @property string $cadete_rut
 * @property string $apoderado_rut
 * @property string $tipoApoderado
 *
 * The followings are the available model relations:
 * @property Apoderado $apoderado
 * @property Cadete $cadete
 */
class CadeteApoderado extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'cadete_apoderado';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('cadete_rut, apoderado_rut, tipoApoderado', 'required'),
			array('cadete_rut, apoderado_rut', 'length', 'max'=>10),
			array('tipoApoderado', 'length', 'max'=>18),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idcadete_apoderado, cadete_rut, apoderado_rut, tipoApoderado', 'safe', 'on'=>'search'),
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
			'apoderado' => array(self::BELONGS_TO, 'Apoderado', 'apoderado_rut'),
			'cadete' => array(self::BELONGS_TO, 'Cadete', 'cadete_rut'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idcadete_apoderado' => 'Idcadete Apoderado',
			'cadete_rut' => 'Cadete Rut',
			'apoderado_rut' => 'Apoderado Rut',
			'tipoApoderado' => 'Tipo Apoderado',
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

		$criteria->compare('idcadete_apoderado',$this->idcadete_apoderado,true);
		$criteria->compare('cadete_rut',$this->cadete_rut,true);
		$criteria->compare('apoderado_rut',$this->apoderado_rut,true);
		$criteria->compare('tipoApoderado',$this->tipoApoderado,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return CadeteApoderado the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        public static function saveWeb($cadetes_apoderados){
            $error = "";
            $errores = "";
            foreach ($cadetes_apoderados as $cadete_apoderado){
                $model = CadeteApoderado::model()->findByPk($cadete_apoderado["idcadete_apoderado"]);
                if(empty($model)){
                    $model =  new CadeteApoderado();
                    $model->idcadete_apoderado = $cadete_apoderado["idcadete_apoderado"];
                }
                $model->cadete_rut = $cadete_apoderado["cadete_rut"];
                $model->apoderado_rut = $cadete_apoderado["apoderado_rut"];
                $model->tipoApoderado = $cadete_apoderado["tipoApoderado"];
                
                try{
                    if(!$model->save()){
                        foreach($model->errors as $error){
                            $er = new Error('99999', $model->idcadete_apoderado, 'cadete_apoderado', $error[0]);
                            $errores[] = $er;
                        }
                    }
                } catch (CDbException $e){
                    $er = new Error($e->errorInfo[1], $model->idcadete_apoderado, 'cadete_apoderado', $e->errorInfo[2]);
                    $errores[] = $er;
                } 
            }
            return $errores;
        }
        
        public static function deleteWeb($cadetes_apoderados){
            $error = "";
            $errores = "";
            foreach ($ingles as $ing){
                $model=CadeteApoderado::model()->findByPk($cadete_apoderado["idcadete_apoderado"]);
                try{
                    if(!empty($model)){
                        if(!$model->delete()){
                            $er = new Error('99998', $cadete_apoderado["idcadete_apoderado"], 'cadete_apoderado', "Relacion no existe en el sistema");
                            $errores[] = $er;
                        }
                    }else{
                        $er = new Error('99998', $cadete_apoderado["idcadete_apoderado"], 'cadete_apoderado', "Relacion no existe en el sistema");
                        $errores[] = $er;
                    }
                } catch (CDbException $e){
                    $er = new Error($e->errorInfo[1], $cadete_apoderado["idcadete_apoderado"], 'cadete_apoderado', $e->errorInfo[2]);
                    $errores[] = $er;
                } 
            }
            return $errores;
        }
}
