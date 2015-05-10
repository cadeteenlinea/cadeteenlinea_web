<?php
Yii::import('application.controllers.*');
/**
 * @group Controller_Site
 */

class SiteControllerTest extends CTestCase {

    protected $object;
    
    public $fixture = array(
        'users'=>'User'
    );
    
    protected function setUp() {
        $this->object =  new SiteController('site');
    }
    
    protected function tearDown() {
        unset($this->object);
    }
    
    /*public function testActionLogin() {
        $_POST[''] = ""
        $this->object->actionLogin();
    }*/

}
