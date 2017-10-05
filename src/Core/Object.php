<?php
namespace Makframework\Core;

/**
 *Object
 */
class Object
{
  public function __toString() : string
  {
    return $this->toString();
  }

  /**
   *Return Object represent in string
   *@return string
   */
  public function toString() : string
  {
    return print_r($this, true);
  }

  /**
   *Compare object
   *@return bool
   */
  public function equals(Object $object) : bool
  {
    return ($this == $object);
  }

  /**
   *Clone the object
   *@return \Makframework\Core\Object
   */
  public function clone() : Object
  {
    return clone $this;
  }

  /**
   *Get class name
   *@return string
   */
  public function getClassName() : string
  {
    return get_class($this);
  }


}
