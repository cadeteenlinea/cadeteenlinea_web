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
        Yii::import('application.controllers.*');
        $this->object = new LoginForm;
        $this->object->setAttributes($this->fixture);
    }

    protected function tearDown() {
        unset($this->object);
    }

    public function testValidateRut(){        
        $this->object->validateRut("username", null);    
        $this->assertEquals($this->object->errors,array());
    }
    
    public function testAuthenticate(){
        $this->object->authenticate("password", null);     
        $this->assertEquals($this->object->errors,array());
    }
    
    public function testLogin(){
        $result = $this->object->login();
        $this->assertEquals($result, true);
    }
}
