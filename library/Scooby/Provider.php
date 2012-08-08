<?php
class Scooby_Provider 
{
    const EVENT_CRITICAL_LEVEL  = 'criticalLevel';
    const EVENT_STABLE          = 'stable';

    private $_config;
    private $_tester;

    public function __construct(Zend_Config $config)
    {
        $this->_config = $config;
    }

    /**
     * @return Scooby_Tester_Interface
     */
    private function _getTester()
    {
        if(!$this->_tester) {
            $this->_tester = new Scooby_Tester();
        }
        return $this->_tester;
    }

    private function _loadTester()
    {
        foreach(  $this->_config->testers->tester as $tester) {
            $testClass = $this->_getTestClass($tester);
            $this->_getTester()->attach($testClass);
        }
    }

    /**
     * @param string $eventName
     * @return Scooby_Event_Interface
     */
    private function _getEventClass($eventName)
    {
        $className = implode('_', array('Scooby', 'Event', $eventName));
        if(!class_exists($className)) {
            throw new Scooby_Exception_UnknownEvent('Unknown event: ' . $eventName);
        }
        return new $className;
    }

    /**
     * @param string $testerName
     * @return Scooby_Tester_Interface
     */
    private function _getTestClass($testerName)
    {
        $className = implode('_', array('Scooby', 'Tester', $testerName));
        if(!class_exists($className)) {
            throw new Scooby_Exception_UnknownTester('Unknown tester : ' . $testerName);
        }
        return new $className;
    }

    /**
     * @param string                    $eventName
     * @param Scooby_Tester_Interface   $source
     */
    private function _triggerEvent($eventName, $source)
    {
        if(!isset($this->_config->events->{$eventName})) {
            return false;
        }

        $eventClassName     = $this->_config->events->{$eventName};
        $event              = $this->_getEventClass($eventClassName);
        $parameter          = new Scooby_Event();
        
        $parameter->setSource($source);
        $event->trigger($parameter);       
    }

    /**
     * @param Scooby_Tester_Result $result
     */
    private function _processResult(Scooby_Tester_Result $result)
    {
        $eventType = ($result->getSuccess()) ? self::EVENT_STABLE : self::EVENT_CRITICAL_LEVEL;
        $this->_triggerEvent($eventType, $this->_getTester() );
    }

    public function runTest()
    {
        $this->_loadTester();
        $result = $this->_getTester()->invoke($this->_config);
        $this->_processResult($result);
    }
}
