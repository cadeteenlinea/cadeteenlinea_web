<?php

/**
 * @group Model_Cadete
 */
class CadeteTest extends CTestCase {

    protected $object;
    public $fixture = array(
        'rut'=>'11111111',
        'ncadete'=>'3',
        'nCadeteView'=>'076',
        'asignatura'=>'12',
        'ano'=>'2013',
        'semestre'=>1,
    );

    protected function setUp() {
        $this->object = new Cadete;
    }

    protected function tearDown() {
        unset($this->object);
    }

    public function testGetnCadeteView() {
        $this->object = Cadete::model()->findByPk($this->fixture["rut"]);
        $this->assertEquals($this->fixture["nCadeteView"], $this->object->getnCadeteView());
    }

    public function testGetTransacciones() {
        $this->object = Cadete::model()->findByPk($this->fixture["rut"]);
        $model = $this->object->getTransacciones(2015, "Colegiatura");
        
        foreach($model->transacciones as $item){
            $this->assertNotEmpty($item->fechaMovimiento);
            $this->assertNotEmpty($item->tipoTransaccion);
            $this->assertNotEmpty($item->monto);
        }  
    }
    
    public function testGetNotasParcialesAsignatura() {
        $this->object = Cadete::model()->findByPk($this->fixture["rut"]);
        $notas = $this->object->getNotasParcialesAsignatura($this->fixture["asignatura"]);
        foreach($notas as $nota){
            $this->assertNotEmpty($nota->nota);
        }
    }
    
    public function testGetPromedioNotasParcialesAsignatura() {
        $this->object = Cadete::model()->findByPk($this->fixture["rut"]);
        $promedio = $this->object->getPromedioNotasParcialesAsignatura($this->fixture["asignatura"]);
        $this->assertNotEmpty($promedio);
    }
    
    public function testGetCalificacionesAnoSemestre() {
        $this->object = Cadete::model()->findByPk($this->fixture["rut"]);
        $calificacion = $this->object->getCalificacionesAnoSemestre($this->fixture["ano"], $this->fixture["semestre"]);
        $this->assertNotEmpty($calificacion->idcalificaciones);    
    }
}
