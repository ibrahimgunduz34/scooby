<?php
class Scooby_Provider
{
    /**
     * @var Zend_Config
     */
    private $_config;

    /**
     * @var array
     */
    private $_testers = array();

    /**
     * object constructor
     * @param Zend_Config $config
     */
    public function __construct($config)
    {
        $this->_config = $config;
    }

    /**
     * attach tester class to object 
     * @param Scooby_Tester_Interface $test
     */
    public function attach(Scooby_Tester_Interface $test)
    {
        $this->_testers[ get_class($test) ] = $test;
    }

    /**
     * executes test classes
     */
    public function execute()
    {
        foreach($this->_testers as $tester) {
            

        }
    }

    private function getRequest()
    {

    }

}
