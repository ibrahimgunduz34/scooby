<?php
class Scooby_Tester_Garanti_ConnectionTest extends Scooby_Tester_Abstract 
                                            implements Scooby_Tester_Interface
{
    /**
     * @param Zend_Config $providerConfig
     * @return Scooby_Tester_Result
     */
    protected function _invoke(Zend_Config $providerConfig)
    {
        $result = new Scooby_Tester_Result();
        $result->setSuccess(true);
        return $result;
    }
}
