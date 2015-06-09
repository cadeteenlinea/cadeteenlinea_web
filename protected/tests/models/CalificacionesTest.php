<?php

/**
 * @group Model_Calificaciones
 */
class CalificacionesTest extends CTestCase {
    protected $object;
    protected $objectCadete;
    public $fixture = array(
        'rut'=>'11111111',
    );
    
    protected function setUp() {
        $this->object = new Calificaciones;
        $this->objectCadete = Cadete::model()->findByPk($this->fixture["rut"]);
    }

    protected function tearDown() {
        unset($this->object);
    }

    public function testGetAnoMax() {
        $ano = $this->object->getAnoMax($this->objectCadete->rut);
        if(!empty($ano))
            $this->assertStringMatchesFormat('%d',$ano);
    }

    public function testGetListAno() {
        $anos  = $this->object->getListAno($this->objectCadete->rut);
        foreach($anos as $ano){
            $this->assertStringMatchesFormat('%d',$ano);
        }
    }

}
