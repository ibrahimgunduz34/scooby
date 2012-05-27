<?php
abstract class Scooby_ObjectAbstract
{
  /**
   * @var array
   */
  private $_actions = array('get', 'set');
  
  /**
   * @var array
   */
  protected $_attributes = array();
  
  /**
   * parses and returns action name from input value.
   * @param string $name
   * @return string 
   */
  private function _getAction( $name ) 
  {
    return substr( $name, 0, 3 );
  }
  
  /**
   * parses and returns attribute name from input value.
   * @param type $name
   * @return type 
   */
  private function _getAttribute( $name )
  {
    return substr( $name, 3 );
  }
  
  /**
   * check for is action allowed
   * @param string $name
   * @return boolean
   */
  private function _isAllowedAction( $name )
  {
    return in_array($this->_getAction( $name ), $this->_actions );
  }
  
  /**
   * check for is attribute allowed
   * @param string $name
   * @return boolean
   */
  private function _isAllowedAttribute( $name )
  {
    return array_key_exists( $this->_getAttribute( $name ), $this->_attributes );
  }
  
  /**
   * check for is method allowed
   * @param string $name
   * @return mixed (boolean | array)
   */
  private function _isAllowedMethod( $name ) 
  {
    if( !$this->_isAllowedAction( $name ) 
            || !$this->_isAllowedAttribute( $name ) ) {
      return false;
    }
    
    return array(
        'key'     => $this->_getAttribute( $name ),
        'action'  => $this->_getAction( $name )
    );
  }
  
  /**
   * sets value to attribute of class
   * @param string $key
   * @param string $value 
   */
  private function _setValue( $key, $value )
  {
    $this->{$key} = $value;
    return $this;
  }
  
  /**
   * returns value of attribute
   * @param string $key
   * @return string 
   */
  private function _getValue( $key )
  {
    return $this->{$key};
  }
  
  /**
   * call get/set methods of class
   * @param string $methodName
   * @param array $arguments
   * @return mixed 
   */
  public function __call( $methodName, array $arguments )
  {
    $result = $this->_isAllowedMethod( $methodName );
    
    switch( $result['action'] ) {
      case 'get':
        return $this->_getValue( $result['key'] );
        break;
      
      case 'set':
        return $this->_setValue( $result['key'], $arguments[0] );
        break;
      
      default:
        throw new Exception( sprintf("Invalid method '%s' called from class '%s'", $methodName, get_class($this) ) );
        break;
    }
  }
  
  public function __construct()
  {
    $this->setCreatedAt( time() );
  }
}
?>
