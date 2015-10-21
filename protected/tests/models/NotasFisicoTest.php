<?php

/**
 * @group Model_NotasFisico
 */
class NotasFisicoTest extends CTestCase {
    protected $object;
    protected $objectCadete;
    public $fixture = array(
        'rut'=>'17559990',
    );
    
    protected function setUp() {
        $this->object = new NotasFisico;
        $this->objectCadete = Cadete::model()->findByPk($this->fixture["rut"]);
    }

    protected function tearDown() {
        unset($this->object);
    }
    
    public function testGetAnoMax() {
        $ano = $this->object->getAnoMax($this->objectCadete->rut);
        if(!empty($ano)){
            $this->assertStringMatchesFormat('%d',$ano);
            $this->assertEquals(strlen($ano),4);
        }
    }
    
    public function testGetListAno() {
        $anos  = $this->object->getListAno($this->objectCadete->rut);
        foreach($anos as $ano){
            $this->assertStringMatchesFormat('%d',$ano);
            $this->assertEquals(strlen($ano),4);
        }
    }
    
    public function testGetNotasFisicoAnoSemestre() {
        $ano = $this->object->getAnoMax($this->objectCadete->rut);
        $notasSemestre1 = $this->objectCadete->getNotasFisicoAnoSemestre($ano, 1);
        $notasSemestre2 = $this->objectCadete->getNotasFisicoAnoSemestre($ano, 2);
        
        if(!empty($notasSemestre1)){
               $this->assertNotEmpty($notasSemestre1->idnotas_fisico);
        }
        
        if(!empty($notasSemestre2)){
               $this->assertNotEmpty($notasSemestre2->idnotas_fisico);
        }
    }
}
