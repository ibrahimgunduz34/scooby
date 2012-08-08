<?php
class Scooby_Tester extends Scooby_Tester_Abstract 
                    implements Scooby_Tester_Interface
{
    /**
     * @var array
     */
    protected $_testers = array();

    /**
     * @var float
     */
    private $_score = 0.00;

    /**
     * @var int
     */
    private $_step = 0;


    /**
     * @param string $testerName
     * @return Scooby_Tester_Interface
     */
    private function _getTestClass($testerName)
    {
        $className = implode('_', array('Scooby', 'Tester', $testerName));
        if(!class_exists($className, false)) {
            throw new Scooby_Exception_UnknownTester('Unknown tester : ' . $testerName);
        }
        return new $className;
    }

    /**
     * @param Scooby_Tester_Interface $tester
     */
    public function attach(Scooby_Tester_Interface $tester)
    {
        $className =  get_class($tester);
        if( !isset($this->_testers[$className]) ) {
            $this->_testers[$className] = $tester;
        }
    }

    /**
     * returns attached tester classes
     * @return array
     */
    public function getTesters()
    {
        return $this->_tester;
    }

    /**
     * @param Zend_Config $providerConfig
     * @return Scooby_Tester_Result
     */
    protected function _invoke(Zend_Config $providerConfig)
    {
        $success    = 0;
        $fail       = 0;

        foreach($this->_testers as $tester) {
            $result = $tester->invoke($providerConfig);
            if( $result->getSuccess() ) {
                $success ++;
            } else {
                $fail ++;
            }
        }
        
        $this->_score += $success / ($success + $fail);
        $this->_step++;
        if($this->_step == $providerConfig->parameters->period) {
                $this->_score       = $this->_score / $this->_step;

                $result = new Scooby_Tester_Result();
                $result->setSource($this);
                if( $this->_score < $providerConfig->parameters->criticalLevel ) {
                    $result->setSuccess(true);
                } else {
                    $result->setSuccess(false)
                        ->setMessage('api success score is greater than critical error level.');
                }
                return $result;
        } else {
            usleep($providerConfig->parameters->delay);
            return $this->_invoke($providerConfig);
        }
    }
}
