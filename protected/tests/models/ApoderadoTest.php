<?php

/**
 * @group Model_Apoderado
 */
class ApoderadoTest extends CTestCase {

    protected $object;
    public $fixture = array(
        'rut'=>'17558919',
        'rutCadeteValido1'=>'11111111',
        'rutCadeteValido2'=>'22222222',
        'rutCadeteInvalido'=>'99999999',
    );

    protected function setUp() {
        $this->object = new Apoderado;
        $this->object->setAttributes($this->fixture);
    }

    protected function tearDown() {
        unset($this->object);
    }
    
    /*
     *Despliega todo los cadetes asignados al apoderado
     * Se valida que todos los cadetes desplegados sean lo correspondientes
     * que esten asignados.
     */
    public function testGetCadetes() {
        $this->object = Apoderado::model()->findByPk($this->fixture["rut"]);
        $model = $this->object->getCadetes();
        $cont=1;
        foreach($model as $obj){
            $this->assertEquals($obj->rut,$this->fixture["rutCadeteValido$cont"]);
            $cont++;
        }
    }

    /*
     *Validación sobre el cadete seleccionado, true para cadete asignado al Apoderado
     */
    public function testSeleccionarCadete() {
        $this->object = Apoderado::model()->findByPk($this->fixture["rut"]);
        $this->assertEquals($this->object->seleccionarCadete($this->fixture["rutCadeteValido1"]), true);
    }
    
    /*
     *Validación, sobre el cadete seleccionado no existe o no está asignado al apoderado 
     */
    public function testSeleccionarCadeteInvalido() {
        $this->object = Apoderado::model()->findByPk($this->fixture["rut"]);
        $this->assertEquals($this->object->seleccionarCadete($this->fixture["rutCadeteInvalido"]), false);
    }
}
