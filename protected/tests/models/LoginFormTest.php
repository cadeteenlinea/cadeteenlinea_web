<?php
ob_start();
/**
 * @group Model_LoginForm
 */
class LoginFormTest extends CTestCase {
    protected $object;

    public $fixture = array(
        'username'=>'17558919-8',
        'password'=>'asdasd',
        'rememberMe'=>true,
    );
    
    protected function setUp() {
        $this->object = new LoginForm;
        $this->object->setAttributes($this->fixture);
    }

    protected function tearDown() {
        unset($this->object);
    }

    /*
    *Rut valido o invalido, se verifica con el digito ingresado,
    * Formato del rut 11222333-4
    */
    public function testValidateRut(){        
        $this->object->validateRut("username", null);    
        $this->assertEquals($this->object->errors,array());
    }
    /*
     *Validación realizada para verificar que el password sea el correspondientes
     * al rut ingresado, todo esto se consulta en la BD
     */
    public function testAuthenticate(){
        $this->object->authenticate("password", null);     
        $this->assertEquals($this->object->errors,array());
    }
    
    /*
     *Generación de la sesión para el usuario.
     * Si se ingresa true en el campo rememberMe, debera generar una sesión
     * duradera por 30 días.
     */
    public function testLogin(){
        $result = $this->object->login();
        $this->assertEquals($result, true);
    }
    
    public function testFull(){
        $this->assertEquals($this->object->validate() && $this->object->login(), true);
    }
}
