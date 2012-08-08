<?php
class Scooby_Application
{
    /**
     * @var Zend_Config
     */
    private $_confg;

    /**
     * class constructor
     * @param Zend_Config @config
     */
    public function __construct(Zend_Config $config)
    {
        $this->_config = $config;
    }

    private function _getConfig()
    {
        return $this->_config;
    }

    public function run()
    {
        foreach($this->_getConfig()->providers as $providerConfig) {
            $provider = new Scooby_Provider($providerConfig);
            $provider->runTest();
        }
    }
}



