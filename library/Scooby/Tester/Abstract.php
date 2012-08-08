<?php
abstract class Scooby_Tester_Abstract
{
    protected $_result;

    /**
     * returns test execution time.
     */
    public function getDuration()
    {
        return $this->_duration;
    }

    /**
     * returns test result
     * @return Scooby_Tester_Result
     */
    public function getResult()
    {
        return $this->_result;
    }

    /**
     * @param Zend_Config $providerConfig
     */
    public function invoke(Zend_Config $providerConfig)
    {
        $startAt    = microtime(true);
        $result     = $this->_invoke($providerConfig);
        $duration   = microtime(true) - $startAt;
        if(!$result instanceof Scooby_Tester_Result) {
            throw new Scooby_Exception_UnknownResult('No result setted in ' . get_class($this));
        }
        $result->setDuration($duration);
        $this->_result = $result;

        return $result;
    }

    abstract protected function _invoke(Zend_Config $providerConfig);
}
