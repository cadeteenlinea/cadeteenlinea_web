<?php

/**
 * This is the model class for table "notas_fisico".
 *
 * The followings are the available columns in table 'notas_fisico':
 * @property integer $idnotas_fisico
 * @property integer $ano
 * @property integer $semestre
 * @property double $marca_100_mt
 * @property double $marca_1000_mt
 * @property double $marca_salto_largo
 * @property double $marca_bala
 * @property double $marca_100_libre
 * @property double $marca_bajo_agua
 * @property double $marca_trepa
 * @property double $marca_abdominales
 * @property double $marca_extension_brazos
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
 *
 * The followings are the available model relations:
 * @property Cadete $cadeteRut
 */
class NotasFisico extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'notas_fisico';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('idnotas_fisico, ano, semestre, cadete_rut', 'required'),
			array('idnotas_fisico, ano, semestre', 'numerical', 'integerOnly'=>true),
			array('marca_100_mt, marca_1000_mt, marca_salto_largo, marca_bala, marca_100_libre, marca_bajo_agua, marca_trepa, marca_abdominales, marca_extension_brazos, nota_100_mt, nota_1000_mt, nota_salto_largo, nota_bala, nota_100_libre, nota_bajo_agua, nota_trepa, nota_abdominales, nota_extension_brazos, nota_final', 'numerical'),
			array('cadete_rut', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idnotas_fisico, ano, semestre, marca_100_mt, marca_1000_mt, marca_salto_largo, marca_bala, marca_100_libre, marca_bajo_agua, marca_trepa, marca_abdominales, marca_extension_brazos, nota_100_mt, nota_1000_mt, nota_salto_largo, nota_bala, nota_100_libre, nota_bajo_agua, nota_trepa, nota_abdominales, nota_extension_brazos, nota_final, cadete_rut', 'safe', 'on'=>'search'),
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
			'idnotas_fisico' => 'Idnotas Fisico',
			'ano' => 'Ano',
			'semestre' => 'Semestre',
			'marca_100_mt' => 'Marca 100 Mt',
			'marca_1000_mt' => 'Marca 1000 Mt',
			'marca_salto_largo' => 'Marca Salto Largo',
			'marca_bala' => 'Marca Bala',
			'marca_100_libre' => 'Marca 100 Libre',
			'marca_bajo_agua' => 'Marca Bajo Agua',
			'marca_trepa' => 'Marca Trepa',
			'marca_abdominales' => 'Marca Abdominales',
			'marca_extension_brazos' => 'Marca Extension Brazos',
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

		$criteria->compare('idnotas_fisico',$this->idnotas_fisico);
		$criteria->compare('ano',$this->ano);
		$criteria->compare('semestre',$this->semestre);
		$criteria->compare('marca_100_mt',$this->marca_100_mt);
		$criteria->compare('marca_1000_mt',$this->marca_1000_mt);
		$criteria->compare('marca_salto_largo',$this->marca_salto_largo);
		$criteria->compare('marca_bala',$this->marca_bala);
		$criteria->compare('marca_100_libre',$this->marca_100_libre);
		$criteria->compare('marca_bajo_agua',$this->marca_bajo_agua);
		$criteria->compare('marca_trepa',$this->marca_trepa);
		$criteria->compare('marca_abdominales',$this->marca_abdominales);
		$criteria->compare('marca_extension_brazos',$this->marca_extension_brazos);
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

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return NotasFisico the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}

        public static function saveWeb($notas){
            $error = "";
            $errores = "";
            foreach ($notas as $nota){
                $model = NotasFisico::model()->findByPk($nota["idnotas_fisico"]);
                if(empty($model)){
                    $model =  new NotasFisico();
                    $model->idnotas_fisico = $nota["idnotas_fisico"];
                }
                
                $model->ano = $nota["ano"];
                $model->semestre = $nota["semestre"];
                $model->marca_100_mt = $nota["marca_100_mt"];
                $model->marca_1000_mt = $nota["marca_1000_mt"];
                $model->marca_salto_largo = $nota["marca_salto_largo"];
                $model->marca_bala = $nota["marca_bala"];
                $model->marca_100_libre = $nota["marca_100_libre"];
                $model->marca_bajo_agua = $nota["marca_bajo_agua"];
                $model->marca_trepa = $nota["marca_trepa"];
                $model->marca_abdominales = $nota["marca_abdominales"];
                $model->marca_extension_brazos = $nota["marca_extension_brazos"];
                $model->nota_100_mt = $nota["nota_100_mt"];
                $model->nota_1000_mt = $nota["nota_1000_mt"];
                $model->nota_salto_largo = $nota["nota_salto_largo"];
                $model->nota_bala = $nota["nota_bala"];
                $model->nota_100_libre = $nota["nota_100_libre"];
                $model->nota_bajo_agua = $nota["nota_bajo_agua"];
                $model->nota_trepa = $nota["nota_trepa"];
                $model->nota_abdominales = $nota["nota_abdominales"];
                $model->nota_extension_brazos = $nota["nota_extension_brazos"];
                $model->nota_final = $nota["nota_final"];
                $model->cadete_rut = $nota["cadete_rut"];
                
                try{
                    if(!$model->save()){
                        foreach($model->errors as $error){
                            $er = new Error('99999', $model->idnotas_fisico, 'notas_fisico', $error[0]);
                            $errores[] = $er;
                        }
                    }
                } catch (CDbException $e){
                    $er = new Error($e->errorInfo[1], $model->idnotas_fisico, 'notas_fisico', $e->errorInfo[2]);
                    $errores[] = $er;
                } 
            }
            return $errores;
        }
        
        public static function deleteWeb($notas){
            $error = "";
            $errores = "";
            foreach ($notas as $nota){
                $model=NotasFisico::model()->findByPk($nota["idnotas_fisico"]);
                try{
                    if(!empty($model)){
                        if(!$model->delete()){
                            $er = new Error('99998', $nota["idnotas_fisico"], 'notas_fisico', "Nota no existe en el sistema");
                            $errores[] = $er;
                        }
                    }else{
                        $er = new Error('99998', $nota["idnotas_fisico"], 'notas_fisico', "Nota no existe en el sistema");
                        $errores[] = $er;
                    }
                } catch (CDbException $e){
                    $er = new Error($e->errorInfo[1], $nota["idnotas_fisico"], 'notas_fisico', $e->errorInfo[2]);
                    $errores[] = $er;
                } 
            }
            return $errores;
        }
}

