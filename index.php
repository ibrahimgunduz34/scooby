<?php
define('APPLICATION_PATH', dirname(__FILE__));
include('library/loader.php');

Loader::getInstance();

$config = new Zend_Config_Xml(APPLICATION_PATH . 
                            DIRECTORY_SEPARATOR . 'configs' . 
                            DIRECTORY_SEPARATOR . 'config.xml');

$app = new Scooby_Application($config);
$app->run();
?>
