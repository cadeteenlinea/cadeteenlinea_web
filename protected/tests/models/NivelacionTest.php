<?php

/**
 * @group Model_Nivelacion
 */
class NivelacionTest extends CTestCase {
    protected $object;
    protected $objectCadete;
    public $fixture = array(
        'rut'=>'17559990',
    );
    
    protected function setUp() {
        $this->object = new Nivelacion;
        $this->objectCadete = Cadete::model()->findByPk($this->fixture["rut"]);
    }

    protected function tearDown() {
        unset($this->object);
    }

    /*se comprueba el correcto retorno del año maximo y el largo de este*/
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
    
    public function testGetSemestre(){
        $ano = $this->object->getAnoMax($this->objectCadete->rut);
        $semestre = $this->object->getSemestreMin($this->objectCadete->rut, $ano);
        
        if(!empty($semestre)){
            $this->assertStringMatchesFormat('%d',$semestre);
            $this->assertEquals(strlen($semestre),1);
        }
    }
    
    public function testGetListSemestre() {
        $ano = $this->object->getAnoMax($this->objectCadete->rut);
        $semestres = $this->object->getListAnoSemestre($this->objectCadete->rut, $ano);
        foreach($semestres as $semestre){
            $this->assertStringMatchesFormat('%d',$semestre);
            $this->assertEquals(strlen($semestre),1);
        }
    }
    
    public function testGetEtapa(){
        $ano = $this->object->getAnoMax($this->objectCadete->rut);
        $semestre = $this->object->getSemestreMin($this->objectCadete->rut, $ano);
        $etapa = $this->object->getEtapaMin($this->objectCadete->rut, $ano, $semestre);
        if(!empty($etapa)){
            $this->assertStringMatchesFormat('%d',$etapa);
            $this->assertEquals(strlen($etapa),0);
        }
    }
    
    public function testGetListEtapa() {
        $ano = $this->object->getAnoMax($this->objectCadete->rut);
        $semestre = $this->object->getSemestreMin($this->objectCadete->rut, $ano);
        $etapas = $this->object->getListAnoSemestreEtapa($this->objectCadete->rut, $ano, $semestre);
        foreach($etapas as $etapa){
            $this->assertStringMatchesFormat('%d',$etapa);
            $this->assertEquals(strlen($etapa),1);
        }
    }
    
    
    public function testGetNivelacionAnoSemestreEtapa() {
        $ano = $this->object->getAnoMax($this->objectCadete->rut);
        $semestre = $this->object->getSemestreMin($this->objectCadete->rut, $ano);
        $etapa = $this->object->getEtapaMin($this->objectCadete->rut, $ano, $semestre);
        
        $nivelacion = $this->objectCadete->getNivelacionAnoSemestreEtapa($ano, $semestre, $etapa);
        
        if(!empty($nivelacion)){
               $this->assertNotEmpty($nivelacion->idnivelacion);
        }
    }

}
