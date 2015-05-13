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
}
