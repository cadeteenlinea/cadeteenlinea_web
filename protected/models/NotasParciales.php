<?php

/**
 * This is the model class for table "notas_parciales".
 *
 * The followings are the available columns in table 'notas_parciales':
 * @property integer $idnotas_parciales
 * @property double $nota
 * @property integer $dia
 * @property integer $mes
 * @property integer $ano
 * @property integer $semestre
 * @property integer $asignatura_idasignatura
 * @property string $cadete_rut
 * @property integer $concepto_idconcepto
 *
 * The followings are the available model relations:
 * @property Asignatura $asignatura
 * @property Cadete $cadete
 * @property Concepto $concepto
 */
class NotasParciales extends CActiveRecord
{
	/**
	 * @return string the associated database table name
	 */
	public function tableName()
	{
		return 'notas_parciales';
	}

	/**
	 * @return array validation rules for model attributes.
	 */
	public function rules()
	{
		// NOTE: you should only define rules for those attributes that
		// will receive user inputs.
		return array(
			array('nota, dia, mes, ano, semestre, asignatura_idasignatura, cadete_rut, concepto_idconcepto', 'required'),
			array('dia, mes, ano, semestre, asignatura_idasignatura, concepto_idconcepto', 'numerical', 'integerOnly'=>true),
			array('nota', 'numerical'),
			array('cadete_rut', 'length', 'max'=>10),
			// The following rule is used by search().
			// @todo Please remove those attributes that should not be searched.
			array('idnotas_parciales, nota, dia, mes, ano, semestre, asignatura_idasignatura, cadete_rut, concepto_idconcepto', 'safe', 'on'=>'search'),
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
			'asignatura' => array(self::BELONGS_TO, 'Asignatura', 'asignatura_idasignatura'),
			'cadete' => array(self::BELONGS_TO, 'Cadete', 'cadete_rut'),
			'concepto' => array(self::BELONGS_TO, 'Concepto', 'concepto_idconcepto'),
		);
	}

	/**
	 * @return array customized attribute labels (name=>label)
	 */
	public function attributeLabels()
	{
		return array(
			'idnotas_parciales' => 'Idnotas Parciales',
			'nota' => 'Nota',
			'dia' => 'Dia',
			'mes' => 'Mes',
			'ano' => 'Ano',
			'semestre' => 'Semestre',
			'asignatura_idasignatura' => 'Asignatura Idasignatura',
			'cadete_rut' => 'Cadete Rut',
			'concepto_idconcepto' => 'Concepto Idconcepto',
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

		$criteria->compare('idnotas_parciales',$this->idnotas_parciales);
		$criteria->compare('nota',$this->nota);
		$criteria->compare('dia',$this->dia);
		$criteria->compare('mes',$this->mes);
		$criteria->compare('ano',$this->ano);
		$criteria->compare('semestre',$this->semestre);
		$criteria->compare('asignatura_idasignatura',$this->asignatura_idasignatura);
		$criteria->compare('cadete_rut',$this->cadete_rut,true);
		$criteria->compare('concepto_idconcepto',$this->concepto_idconcepto);

		return new CActiveDataProvider($this, array(
			'criteria'=>$criteria,
		));
	}

	/**
	 * Returns the static model of the specified AR class.
	 * Please note that you should have this exact method in all your CActiveRecord descendants!
	 * @param string $className active record class name.
	 * @return NotasParciales the static model class
	 */
	public static function model($className=__CLASS__)
	{
		return parent::model($className);
	}
        
        public function getFecha(){
            return $this->dia.'/'.$this->mes.'/'.$this->ano;
        }
        
        public static function saveWeb($notas){
            $error = "";
            $errores = "";
            foreach ($notas as $nota){
                $model = NotasParciales::model()->findByPk($nota["idnotas_parciales"]);
                if(empty($model)){
                    $model =  new NotasParciales();
                    $model->idnotas_parciales = $nota["idnotas_parciales"];
                }
                
                $model->nota = $nota["nota"];
                $model->dia = $nota["dia"];
                $model->mes = $nota["mes"];
                $model->ano = $nota["ano"];
                $model->semestre = $nota["semestre"];
                $model->asignatura_idasignatura = $nota["asignatura_idasignatura"];
                $model->cadete_rut = $nota["cadete_rut"];
                
                $criteria=new CDbCriteria;
                $criteria->addCondition('codigo="'.$nota["concepto"].'"');
                $concepto = Concepto::model()->find($criteria);
                if(!empty($concepto)){
                    $model->concepto_idconcepto = $concepto->idconcepto;
                }

                try{
                    if(!$model->save()){
                        foreach($model->errors as $error){
                            $er = new Error('99999', $model->idnotas_parciales, 'notas_parciales', $error[0]);
                            $errores[] = $er;
                        }
                    }
                } catch (CDbException $e){
                    $er = new Error($e->errorInfo[1], $model->idnotas_parciales, 'notas_parciales', $e->errorInfo[2]);
                    $errores[] = $er;
                } 
            }
            return $errores;
        }
        
        public static function deleteWeb($notas){
            $error = "";
            $errores = "";
            foreach ($notas as $nota){
                $model=NotasParciales::model()->findByPk($nota["idnotas_parciales"]);
                try{
                    if(!empty($model)){
                        if(!$model->delete()){
                            $er = new Error('99998', $nota["idnotas_parciales"], 'notas_parciales', "Nota no existe en el sistema");
                            $errores[] = $er;
                        }
                    }else{
                        $er = new Error('99998', $nota["idnotas_parciales"], 'notas_parciales', "Nota no existe en el sistema");
                        $errores[] = $er;
                    }
                } catch (CDbException $e){
                    $er = new Error($e->errorInfo[1], $nota["idnotas_parciales"], 'notas_parciales', $e->errorInfo[2]);
                    $errores[] = $er;
                } 
            }
            return $errores;
        }
}
