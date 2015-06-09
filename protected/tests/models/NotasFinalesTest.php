<?php

/**
 * @group Model_NotasFinales
 */
class NotasFinalesTest extends CTestCase {
    protected $object;
    protected $objectCadete;
    
    public $fixture = array(
        'rut'=>'11111111',
        'asignatura' => '3'
    );

    protected function setUp() {
        $this->object = new NotasFinales;
        $this->objectCadete = Cadete::model()->findByPk($this->fixture["rut"]);
    }

    protected function tearDown() {
        unset($this->object);
    }
    
    public function testGetAnoMax() {
        $ano = $this->object->getAnoMax($this->objectCadete->rut);
        $this->assertStringMatchesFormat('%d',$ano);
    }

    public function testGetListAno() {
        $anos  = $this->object->getListAno($this->objectCadete->rut);
        foreach($anos as $ano){
            $this->assertStringMatchesFormat('%d',$ano);
        }
    }

    public function testGetNotaAnoCadete() {
        $nota = $this->object->getNotaAnoCadete($this->objectCadete->rut, $this->fixture["asignatura"]);
        if(!empty($nota)){
            $this->assertNotEmpty($nota->nota_presentacion); 
            $this->assertNotEmpty($nota->nota_examen); 
            $this->assertNotEmpty($nota->nota_final); 
            $this->assertNotEmpty($nota->estado); 
        }
    }
}
