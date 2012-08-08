<?php
interface Scooby_Tester_Interface
{
    /**
     * @param Zend_Config $providerConfig
     * @return Scooby_Tester_Result
     */
    public function invoke(Zend_Config $providerConfig);

    /**
     * returns test result
     * @return Scooby_Tester_Result
     */
    public function getResult();
}
