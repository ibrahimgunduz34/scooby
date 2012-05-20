<?php
class Loader
{
  public function __construct()
  {
    $this->registerAutoloader();
  }

  public function getInstance()
  {
    return new self;
  }

  private function registerAutoloader()
  {
    return spl_autoload_register(array(__CLASS__, 'includeClassFile'));
  }

  public function includeClassFile($class)
  {
    require_once(APPLICATION_PATH . 
                  DIRECTORY_SEPARATOR .
                  'library' .
                  DIRECTORY_SEPARATOR . 
                  strtr($class, '_\\', '//') . '.php');
  }
}
