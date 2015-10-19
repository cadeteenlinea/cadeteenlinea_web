<?php

/**
 * This is the model class for table "nivelacion".
 *
 * The followings are the available columns in table 'nivelacion':
 * @property integer $idnivelacion
 * @property integer $ano
 * @property integer $semestre
 * @property integer $etapa
 * @property double $marca_100_mt
 * @property double $marca_1000_mt
 * @property double $marca_salto_largo
 * @property double $marca_bala
 * @property double $marca_100_libre
 * @property double $marca_bajo_agua
 * @property double $marca_trepa
 * @property double $marca_abdominales
 * @property double $marca_extension_brazos
 * @property double $marca_cooper
 * @property double $nota_100_mt
 * @property double $nota_1000_mt
 * @property double $nota_salto_largo
 * @property double $nota_bala
 * @property double $nota_100_libre
 * @property double $nota_bajo_agua
 * @property double $nota_trepa
 * @property double $nota_abdominales
 * @property double $nota_extension_brazos
 * @property double $nota_final
 * @property string $cadete_rut
 * @property string $observacion
 *
 * The followings are the available model relations:
 * @property Cadete $cadeteRut
 */
class Nivelacion extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'nivelacion';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idnivelacion, ano, semestre, cadete_rut', 'required'),
			array('idnivelacion, ano, semestre, etapa', 'numerical', 'integerOnly'=>true),
			array('marca_100_mt, marca_1000_mt, marca_salto_largo, marca_bala, marca_100_libre, marca_bajo_agua, marca_trepa, marca_abdominales, marca_extension_brazos, marca_cooper, nota_100_mt, nota_1000_mt, nota_salto_largo, nota_bala, nota_100_libre, nota_bajo_agua, nota_trepa, nota_abdominales, nota_extension_brazos, nota_final', 'numerical'),
			array('cadete_rut', 'length', 'max'=>10),
			array('observacion', 'length', 'max'=>30),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idnivelacion, ano, semestre, etapa, marca_100_mt, marca_1000_mt, marca_salto_largo, marca_bala, marca_100_libre, marca_bajo_agua, marca_trepa, marca_abdominales, marca_extension_brazos, marca_cooper, nota_100_mt, nota_1000_mt, nota_salto_largo, nota_bala, nota_100_libre, nota_bajo_agua, nota_trepa, nota_abdominales, nota_extension_brazos, nota_final, cadete_rut, observacion', 'safe', 'on'=>'search'),
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
			'idnivelacion' => 'Idnivelacion',
			'ano' => 'Ano',
			'semestre' => 'Semestre',
			'etapa' => 'Etapa',
			'marca_100_mt' => 'Marca 100 Mt',
			'marca_1000_mt' => 'Marca 1000 Mt',
			'marca_salto_largo' => 'Marca Salto Largo',
			'marca_bala' => 'Marca Bala',
			'marca_100_libre' => 'Marca 100 Libre',
			'marca_bajo_agua' => 'Marca Bajo Agua',
			'marca_trepa' => 'Marca Trepa',
			'marca_abdominales' => 'Marca Abdominales',
			'marca_extension_brazos' => 'Marca Extension Brazos',
			'marca_cooper' => 'Marca Cooper',
			'nota_100_mt' => 'Nota 100 Mt',
			'nota_1000_mt' => 'Nota 1000 Mt',
			'nota_salto_largo' => 'Nota Salto Largo',
			'nota_bala' => 'Nota Bala',
			'nota_100_libre' => 'Nota 100 Libre',
			'nota_bajo_agua' => 'Nota Bajo Agua',
			'nota_trepa' => 'Nota Trepa',
			'nota_abdominales' => 'Nota Abdominales',
			'nota_extension_brazos' => 'Nota Extension Brazos',
			'nota_final' => 'Nota Final',
			'cadete_rut' => 'Cadete Rut',
			'observacion' => 'Observacion',
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

		$criteria->compare('idnivelacion',$this->idnivelacion);
		$criteria->compare('ano',$this->ano);
		$criteria->compare('semestre',$this->semestre);
		$criteria->compare('etapa',$this->etapa);
		$criteria->compare('marca_100_mt',$this->marca_100_mt);
		$criteria->compare('marca_1000_mt',$this->marca_1000_mt);
		$criteria->compare('marca_salto_largo',$this->marca_salto_largo);
		$criteria->compare('marca_bala',$this->marca_bala);
		$criteria->compare('marca_100_libre',$this->marca_100_libre);
		$criteria->compare('marca_bajo_agua',$this->marca_bajo_agua);
		$criteria->compare('marca_trepa',$this->marca_trepa);
		$criteria->compare('marca_abdominales',$this->marca_abdominales);
		$criteria->compare('marca_extension_brazos',$this->marca_extension_brazos);
		$criteria->compare('marca_cooper',$this->marca_cooper);
		$criteria->compare('nota_100_mt',$this->nota_100_mt);
		$criteria->compare('nota_1000_mt',$this->nota_1000_mt);
		$criteria->compare('nota_salto_largo',$this->nota_salto_largo);
		$criteria->compare('nota_bala',$this->nota_bala);
		$criteria->compare('nota_100_libre',$this->nota_100_libre);
		$criteria->compare('nota_bajo_agua',$this->nota_bajo_agua);
		$criteria->compare('nota_trepa',$this->nota_trepa);
		$criteria->compare('nota_abdominales',$this->nota_abdominales);
		$criteria->compare('nota_extension_brazos',$this->nota_extension_brazos);
		$criteria->compare('nota_final',$this->nota_final);
		$criteria->compare('cadete_rut',$this->cadete_rut,true);
		$criteria->compare('observacion',$this->observacion,true);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return Nivelacion the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        /*
         * guardado de datos enviados por aplicación escritorio
         * son enviados por Json
         */
        public static function saveWeb($nivelaciones){
            $error = "";
            $errores = "";
            foreach ($nivelaciones as $nivela){
                $model = Nivelacion::model()->findByPk($nivela["idnivelacion"]);
                if(empty($model)){
                    $model =  new Nivelacion();
                    $model->idnivelacion = $nivela["idnivelacion"];
                }
                
                $model->ano = $nivela["ano"];
                $model->semestre = $nivela["semestre"];
                $model->etapa = $nivela["etapa"];
                $model->marca_100_mt = $nivela["marca_100_mt"];
                $model->marca_1000_mt = $nivela["marca_1000_mt"];
                $model->marca_salto_largo = $nivela["marca_salto_largo"];
                $model->marca_bala = $nivela["marca_bala"];
                $model->marca_100_libre = $nivela["marca_100_libre"];
                $model->marca_bajo_agua = $nivela["marca_bajo_agua"];
                $model->marca_trepa = $nivela["marca_trepa"];
                $model->marca_abdominales = $nivela["marca_abdominales"];
                $model->marca_cooper = $nivela["marca_cooper"];
                $model->marca_extension_brazos = $nivela["marca_extension_brazos"];
                $model->nota_100_mt = $nivela["nota_100_mt"];
                $model->nota_1000_mt = $nivela["nota_1000_mt"];
                $model->nota_salto_largo = $nivela["nota_salto_largo"];
                $model->nota_bala = $nivela["nota_bala"];
                $model->nota_100_libre = $nivela["nota_100_libre"];
                $model->nota_bajo_agua = $nivela["nota_bajo_agua"];
                $model->nota_trepa = $nivela["nota_trepa"];
                $model->nota_abdominales = $nivela["nota_abdominales"];
                $model->nota_extension_brazos = $nivela["nota_extension_brazos"];
                $model->nota_final = $nivela["nota_final"];
                $model->observacion = $nivela["observacion"];
                $model->cadete_rut = $nivela["cadete_rut"];
                
                try{
                    if(!$model->save()){
                        foreach($model->errors as $error){
                            $er = new Error('99999', $model->idnivelacion, 'nivelacion', $error[0]);
                            $errores[] = $er;
                        }
                    }
                } catch (CDbException $e){
                    $er = new Error($e->errorInfo[1], $model->idnivelacion, 'nivelacion', $e->errorInfo[2]);
                    $errores[] = $er;
                } 
            }
            return $errores;
        }
        
        public static function deleteWeb($nivelaciones){
            $error = "";
            $errores = "";
            foreach ($nivelaciones as $nivela){
                $model=  Nivelacion::model()->findByPk($nivela["idnivelacion"]);
                try{
                    if(!empty($model)){
                        if(!$model->delete()){
                            $er = new Error('99998', $nivela["idnivelacion"], 'nivelacion', "Nivelacion no existe en el sistema");
                            $errores[] = $er;
                        }
                    }else{
                        $er = new Error('99998', $nivela["idnivelacion"], 'nivelacion', "Nivelacion no existe en el sistema");
                        $errores[] = $er;
                    }
                } catch (CDbException $e){
                    $er = new Error($e->errorInfo[1], $nivela["idnivelacion"], 'nivelacion', $e->errorInfo[2]);
                    $errores[] = $er;
                } 
            }
            return $errores;
        }
        
        static function getAnoMax($rutCadete){
            $criteria=new CDbCriteria;
            $criteria->select='MAX(ano) as ano';
            $criteria->addCondition('cadete_rut='.$rutCadete);
            $model = Nivelacion::model()->find($criteria);
            if(!empty($model))
                return $model->ano;
            return null;
        }
        
        static function getListAno($rutCadete){
            $criteria=new CDbCriteria;
            $criteria->select='t.ano as ano';
            $criteria->addCondition('t.cadete_rut='.$rutCadete);
            $criteria->distinct=true;
            $model = Nivelacion::model()->findAll($criteria);
            
            return CHtml::listData($model, 'ano', 'ano');
        }
}
