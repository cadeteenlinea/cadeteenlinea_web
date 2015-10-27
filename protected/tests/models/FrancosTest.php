<?php

/**
 * @group Model_Francos
 */
class FrancoTest extends CTestCase {

    protected $objectCadete;
    public $fixture = array(
        'rut'=>'17559990',
    );
    
    protected function setUp() {
        $this->objectCadete = Cadete::model()->findByPk($this->fixture["rut"]);
    }

    protected function tearDown() {
        unset($this->object);
    }
    /*se utiliza la relación que tiene cadetes con francos, para evitar realizar otros metodos*/
    public function testGetSalidas() {
        foreach($this->objectCadete->francos as $francos){
            $this->assertNotEmpty($francos->idfrancos);
            $this->assertNotEmpty($francos->fecha_salida);
            $this->assertNotEmpty($francos->hora_salida);
            $this->assertNotEmpty($francos->fecha_recogida);
            $this->assertNotEmpty($francos->hora_recogida);
        }
    }

}
