<?php

/**
 * @group Model_Asignatura
 */
class AAsignaturaTest extends CTestCase {
    protected $object;
    protected $objectCadete;
    
    public $fixture = array(
        'rut'=>'11111111',
    );
    
    protected function setUp() {
        $this->object = new Asignatura;
        $this->objectCadete = Cadete::model()->findByPk($this->fixture["rut"]);
    }

    protected function tearDown() {
        unset($this->object);
    }

    public function testGetAsignaturasAnoCursoEspecialidad() {
        $model = $this->object->getAsignaturasAnoCursoEspecialidad(2015,$this->objectCadete->getCursoNumero(), $this->objectCadete->especialidad_idespecialidad);
        
        foreach($model as $item){
            $this->assertNotEmpty($item->idasignatura);
        } 
    }

    public function testGetAsignaturasCadeteAno() {
        $model = $this->object->getAsignaturasCadeteAno(2013, $this->objectCadete->rut);
        foreach($model as $item){
            $this->assertNotEmpty($item->idasignatura);
        }
    }
    
}
